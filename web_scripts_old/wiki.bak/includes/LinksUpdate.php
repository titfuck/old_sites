<?php
/**
 * See deferred.txt
 * @package MediaWiki
 */

/**
 * @todo document
 * @package MediaWiki
 */
class LinksUpdate {

	/**#@+
	 * @access private
	 */
	var $mId,            # Page ID of the article linked from
		$mTitle,         # Title object of the article linked from
		$mLinks,         # Map of title strings to IDs for the links in the document
		$mImages,        # DB keys of the images used, in the array key only
		$mTemplates,     # Map of title strings to IDs for the template references, including broken ones
		$mExternals,     # URLs of external links, array key only
		$mCategories,    # Map of category names to sort keys
		$mDb,            # Database connection reference
		$mOptions,       # SELECT options to be used (array)
		$mRecursive;     # Whether to queue jobs for recursive updates
	/**#@-*/

	/**
	 * Constructor
	 * Initialize private variables
	 * @param integer $id
	 * @param string $title
	 */
	function LinksUpdate( $title, $parserOutput, $recursive = true ) {
		global $wgAntiLockFlags;

		if ( $wgAntiLockFlags & ALF_NO_LINK_LOCK ) {
			$this->mOptions = array();
		} else {
			$this->mOptions = array( 'FOR UPDATE' );
		}
		$this->mDb =& wfGetDB( DB_MASTER );

		if ( !is_object( $title ) ) {
			wfDebugDieBacktrace( "The calling convention to LinksUpdate::LinksUpdate() has changed. " .
				"Please see Article::editUpdates() for an invocation example.\n" );
		}
		$this->mTitle = $title;
		$this->mId = $title->getArticleID();

		$this->mLinks = $parserOutput->getLinks();
		$this->mImages = $parserOutput->getImages();
		$this->mTemplates = $parserOutput->getTemplates();
		$this->mExternals = $parserOutput->getExternalLinks();
		$this->mCategories = $parserOutput->getCategories();
		$this->mRecursive = $recursive;

	}

	/**
	 * Update link tables with outgoing links from an updated article
	 */
	function doUpdate() {
		global $wgUseDumbLinkUpdate;
		if ( $wgUseDumbLinkUpdate ) {
			$this->doDumbUpdate();
		} else {
			$this->doIncrementalUpdate();
		}
	}

	function doIncrementalUpdate() {
		$fname = 'LinksUpdate::doIncrementalUpdate';
		wfProfileIn( $fname );

		# Page links
		$existing = $this->getExistingLinks();
		$this->incrTableUpdate( 'pagelinks', 'pl', $this->getLinkDeletions( $existing ),
			$this->getLinkInsertions( $existing ) );

		# Image links
		$existing = $this->getExistingImages();
		$this->incrTableUpdate( 'imagelinks', 'il', $this->getImageDeletions( $existing ),
			$this->getImageInsertions( $existing ) );

		# Invalidate all image description pages which had links added or removed
		$imageUpdates = array_diff_key( $existing, $this->mImages ) + array_diff_key( $this->mImages, $existing );
		$this->invalidateImageDescriptions( $imageUpdates );

		# External links
		$existing = $this->getExistingExternals();
		$this->incrTableUpdate( 'externallinks', 'el', $this->getExternalDeletions( $existing ),
			$this->getExternalInsertions( $existing ) );

		# Template links
		$existing = $this->getExistingTemplates();
		$this->incrTableUpdate( 'templatelinks', 'tl', $this->getTemplateDeletions( $existing ),
			$this->getTemplateInsertions( $existing ) );

		# Refresh links of all pages including this page
		if ( $this->mRecursive ) {
			$tlto = $this->mTitle->getTemplateLinksTo();
			if ( count( $tlto ) ) {
				require_once( 'JobQueue.php' );
				Job::queueLinksJobs( $tlto );
			}
		}

		# Category links
		$existing = $this->getExistingCategories();
		$this->incrTableUpdate( 'categorylinks', 'cl', $this->getCategoryDeletions( $existing ),
			$this->getCategoryInsertions( $existing ) );

		# Invalidate all categories which were added, deleted or changed (set symmetric difference)
		$categoryUpdates = array_diff_assoc( $existing, $this->mCategories ) + array_diff_assoc( $this->mCategories, $existing );
		$this->invalidateCategories( $categoryUpdates );

		wfProfileOut( $fname );
	}

	/**
	  * Link update which clears the previous entries and inserts new ones
	  * May be slower or faster depending on level of lock contention and write speed of DB
	  * Also useful where link table corruption needs to be repaired, e.g. in refreshLinks.php
	 */
	function doDumbUpdate() {
		$fname = 'LinksUpdate::doDumbUpdate';
		wfProfileIn( $fname );

		# Refresh category pages and image description pages
		$existing = $this->getExistingCategories();
		$categoryUpdates = array_diff_assoc( $existing, $this->mCategories ) + array_diff_assoc( $this->mCategories, $existing );
		$existing = $this->getExistingImages();
		$imageUpdates = array_diff_key( $existing, $this->mImages ) + array_diff_key( $this->mImages, $existing );

		# Refresh links of all pages including this page
		if ( $this->mRecursive ) {
			$tlto = $this->mTitle->getTemplateLinksTo();
			if ( count( $tlto ) ) {
				require_once( 'JobQueue.php' );
				Job::queueLinksJobs( $tlto );
			}
		}

		$this->dumbTableUpdate( 'pagelinks',     $this->getLinkInsertions(),     'pl_from' );
		$this->dumbTableUpdate( 'imagelinks',    $this->getImageInsertions(),    'il_from' );
		$this->dumbTableUpdate( 'categorylinks', $this->getCategoryInsertions(), 'cl_from' );
		$this->dumbTableUpdate( 'templatelinks', $this->getTemplateInsertions(), 'tl_from' );
		$this->dumbTableUpdate( 'externallinks', $this->getExternalInsertions(), 'el_from' );

		# Update the cache of all the category pages and image description pages which were changed
		$this->invalidateCategories( $categoryUpdates );
		$this->invalidateImageDescriptions( $imageUpdates );

		wfProfileOut( $fname );
	}

	function invalidateCategories( $cats ) {
		$fname = 'LinksUpdate::invalidateCategories';
		if ( count( $cats ) ) {
			$this->mDb->update( 'page', array( 'page_touched' => $this->mDb->timestamp() ),
				array(
					'page_namespace' => NS_CATEGORY,
					'page_title IN (' . $this->mDb->makeList( array_keys( $cats ) ) . ')'
				), $fname
			);
		}
	}

	function invalidateImageDescriptions( $images ) {
		$fname = 'LinksUpdate::invalidateImageDescriptions';
		if ( count( $images ) ) {
			$this->mDb->update( 'page', array( 'page_touched' => $this->mDb->timestamp() ),
				array(
					'page_namespace' => NS_IMAGE,
					'page_title IN (' . $this->mDb->makeList( array_keys( $images ) ) . ')'
				), $fname
			);
		}
	}

	function dumbTableUpdate( $table, $insertions, $fromField ) {
		$fname = 'LinksUpdate::dumbTableUpdate';
		$this->mDb->delete( $table, array( $fromField => $this->mId ), $fname );
		if ( count( $insertions ) ) {
			# The link array was constructed without FOR UPDATE, so there may be collisions
			# This may cause minor link table inconsistencies, which is better than
			# crippling the site with lock contention.
			$this->mDb->insert( $table, $insertions, $fname, array( 'IGNORE' ) );
		}
	}

	/**
	 * Make a WHERE clause from a 2-d NS/dbkey array
	 *
	 * @param array $arr 2-d array indexed by namespace and DB key
	 * @param string $prefix Field name prefix, without the underscore
	 */
	function makeWhereFrom2d( &$arr, $prefix ) {
		$lb = new LinkBatch;
		$lb->setArray( $arr );
		return $lb->constructSet( $prefix, $this->mDb );
	}

	/**
	 * Update a table by doing a delete query then an insert query
	 * @access private
	 */
	function incrTableUpdate( $table, $prefix, $deletions, $insertions ) {
		$fname = 'LinksUpdate::incrTableUpdate';
		$where = array( "{$prefix}_from" => $this->mId );
		if ( $table == 'pagelinks' || $table == 'templatelinks' ) {
			$clause = $this->makeWhereFrom2d( $deletions, $prefix );
			if ( $clause ) {
				$where[] = $clause;
			} else {
				$where = false;
			}
		} else {
			if ( count( $deletions ) ) {
				$where[] = "{$prefix}_to IN (" . $this->mDb->makeList( array_keys( $deletions ) ) . ')';
			} else {
				$where = false;
			}
		}
		if ( $where ) {
			$this->mDb->delete( $table, $where, $fname );
		}
		if ( count( $insertions ) ) {
			$this->mDb->insert( $table, $insertions, $fname, 'IGNORE' );
		}
	}


	/**
	 * Get an array of pagelinks insertions for passing to the DB
	 * Skips the titles specified by the 2-D array $existing
	 * @access private
	 */
	function getLinkInsertions( $existing = array() ) {
		$arr = array();
		foreach( $this->mLinks as $ns => $dbkeys ) {
			# array_diff_key() was introduced in PHP 5.1, there is a compatibility function
			# in GlobalFunctions.php
			$diffs = isset( $existing[$ns] ) ? array_diff_key( $dbkeys, $existing[$ns] ) : $dbkeys;
			foreach ( $diffs as $dbk => $id ) {
				$arr[] = array(
					'pl_from'      => $this->mId,
					'pl_namespace' => $ns,
					'pl_title'     => $dbk
				);
			}
		}
		return $arr;
	}

	/**
	 * Get an array of template insertions. Like getLinkInsertions()
	 * @access private
	 */
	function getTemplateInsertions( $existing = array() ) {
		$arr = array();
		foreach( $this->mTemplates as $ns => $dbkeys ) {
			$diffs = isset( $existing[$ns] ) ? array_diff_key( $dbkeys, $existing[$ns] ) : $dbkeys;
			foreach ( $diffs as $dbk => $id ) {
				$arr[] = array(
					'tl_from'      => $this->mId,
					'tl_namespace' => $ns,
					'tl_title'     => $dbk
				);
			}
		}
		return $arr;
	}

	/**
	 * Get an array of image insertions
	 * Skips the names specified in $existing
	 * @access private
	 */
	function getImageInsertions( $existing = array() ) {
		$arr = array();
		$diffs = array_diff_key( $this->mImages, $existing );
		foreach( $diffs as $iname => $dummy ) {
			$arr[] = array(
				'il_from' => $this->mId,
				'il_to'   => $iname
			);
		}
		return $arr;
	}

	/**
	 * Get an array of externallinks insertions. Skips the names specified in $existing
	 * @access private
	 */
	function getExternalInsertions( $existing = array() ) {
		$arr = array();
		$diffs = array_diff_key( $this->mExternals, $existing );
		foreach( $diffs as $url => $dummy ) {
			$arr[] = array(
				'el_from'   => $this->mId,
				'el_to'     => $url,
				'el_index'  => wfMakeUrlIndex( $url ),
			);
		}
		return $arr;
	}

	/**
	 * Get an array of category insertions
	 * @param array $existing Array mapping existing category names to sort keys. If both
	 * match a link in $this, the link will be omitted from the output
	 * @access private
	 */
	function getCategoryInsertions( $existing = array() ) {
		$diffs = array_diff_assoc( $this->mCategories, $existing );
		$arr = array();
		foreach ( $diffs as $name => $sortkey ) {
			$arr[] = array(
				'cl_from'    => $this->mId,
				'cl_to'      => $name,
				'cl_sortkey' => $sortkey,
				'cl_timestamp' => $this->mDb->timestamp()
			);
		}
		return $arr;
	}

	/**
	 * Given an array of existing links, returns those links which are not in $this
	 * and thus should be deleted.
	 * @access private
	 */
	function getLinkDeletions( $existing ) {
		$del = array();
		foreach ( $existing as $ns => $dbkeys ) {
			if ( isset( $this->mLinks[$ns] ) ) {
				$del[$ns] = array_diff_key( $existing[$ns], $this->mLinks[$ns] );
			} else {
				$del[$ns] = $existing[$ns];
			}
		}
		return $del;
	}

	/**
	 * Given an array of existing templates, returns those templates which are not in $this
	 * and thus should be deleted.
	 * @access private
	 */
	function getTemplateDeletions( $existing ) {
		$del = array();
		foreach ( $existing as $ns => $dbkeys ) {
			if ( isset( $this->mTemplates[$ns] ) ) {
				$del[$ns] = array_diff_key( $existing[$ns], $this->mTemplates[$ns] );
			} else {
				$del[$ns] = $existing[$ns];
			}
		}
		return $del;
	}

	/**
	 * Given an array of existing images, returns those images which are not in $this
	 * and thus should be deleted.
	 * @access private
	 */
	function getImageDeletions( $existing ) {
		return array_diff_key( $existing, $this->mImages );
	}

	/** 
	 * Given an array of existing external links, returns those links which are not
	 * in $this and thus should be deleted.
	 * @access private
	 */
	function getExternalDeletions( $existing ) {
		return array_diff_key( $existing, $this->mExternals );
	}

	/**
	 * Given an array of existing categories, returns those categories which are not in $this
	 * and thus should be deleted.
	 * @access private
	 */
	function getCategoryDeletions( $existing ) {
		return array_diff_assoc( $existing, $this->mCategories );
	}

	/**
	 * Get an array of existing links, as a 2-D array
	 * @access private
	 */
	function getExistingLinks() {
		$fname = 'LinksUpdate::getExistingLinks';
		$res = $this->mDb->select( 'pagelinks', array( 'pl_namespace', 'pl_title' ),
			array( 'pl_from' => $this->mId ), $fname, $this->mOptions );
		$arr = array();
		while ( $row = $this->mDb->fetchObject( $res ) ) {
			if ( !isset( $arr[$row->pl_namespace] ) ) {
				$arr[$row->pl_namespace] = array();
			}
			$arr[$row->pl_namespace][$row->pl_title] = 1;
		}
		$this->mDb->freeResult( $res );
		return $arr;
	}

	/**
	 * Get an array of existing templates, as a 2-D array
	 * @access private
	 */
	function getExistingTemplates() {
		$fname = 'LinksUpdate::getExistingTemplates';
		$res = $this->mDb->select( 'templatelinks', array( 'tl_namespace', 'tl_title' ),
			array( 'tl_from' => $this->mId ), $fname, $this->mOptions );
		$arr = array();
		while ( $row = $this->mDb->fetchObject( $res ) ) {
			if ( !isset( $arr[$row->tl_namespace] ) ) {
				$arr[$row->tl_namespace] = array();
			}
			$arr[$row->tl_namespace][$row->tl_title] = 1;
		}
		$this->mDb->freeResult( $res );
		return $arr;
	}

	/**
	 * Get an array of existing images, image names in the keys
	 * @access private
	 */
	function getExistingImages() {
		$fname = 'LinksUpdate::getExistingImages';
		$res = $this->mDb->select( 'imagelinks', array( 'il_to' ),
			array( 'il_from' => $this->mId ), $fname, $this->mOptions );
		$arr = array();
		while ( $row = $this->mDb->fetchObject( $res ) ) {
			$arr[$row->il_to] = 1;
		}
		$this->mDb->freeResult( $res );
		return $arr;
	}

	/**
	 * Get an array of existing external links, URLs in the keys
	 * @access private
	 */
	function getExistingExternals() {
		$fname = 'LinksUpdate::getExistingExternals';
		$res = $this->mDb->select( 'externallinks', array( 'el_to' ),
			array( 'el_from' => $this->mId ), $fname, $this->mOptions );
		$arr = array();
		while ( $row = $this->mDb->fetchObject( $res ) ) {
			$arr[$row->el_to] = 1;
		}
		$this->mDb->freeResult( $res );
		return $arr;
	}

	/**
	 * Get an array of existing categories, with the name in the key and sort key in the value.
	 * @access private
	 */
	function getExistingCategories() {
		$fname = 'LinksUpdate::getExistingCategories';
		$res = $this->mDb->select( 'categorylinks', array( 'cl_to', 'cl_sortkey' ),
			array( 'cl_from' => $this->mId ), $fname, $this->mOptions );
		$arr = array();
		while ( $row = $this->mDb->fetchObject( $res ) ) {
			$arr[$row->cl_to] = $row->cl_sortkey;
		}
		$this->mDb->freeResult( $res );
		return $arr;
	}
}
?>
