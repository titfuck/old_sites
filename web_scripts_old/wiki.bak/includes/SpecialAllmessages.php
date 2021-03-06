<?php
/**
 * Provide functions to generate a special page
 * @package MediaWiki
 * @subpackage SpecialPage
 */

/**
 *
 */
function wfSpecialAllmessages() {
	global $wgOut, $wgAllMessagesEn, $wgRequest, $wgMessageCache, $wgTitle;
	global $wgUseDatabaseMessages;

	if(!$wgUseDatabaseMessages) {
		$wgOut->addHTML(wfMsg('allmessagesnotsupportedDB'));
		return;
	}

	$fname = "wfSpecialAllMessages";
	wfProfileIn( $fname );

	wfProfileIn( "$fname-setup");
	$ot = $wgRequest->getText( 'ot' );

	$navText = wfMsg( 'allmessagestext' );


	$first = true;
	$sortedArray = array_merge( $wgAllMessagesEn, $wgMessageCache->mExtensionMessages );
	ksort( $sortedArray );
	$messages = array();
	$wgMessageCache->disableTransform();

	foreach ( $sortedArray as $key => $enMsg ) {
		$messages[$key]['enmsg'] = $enMsg;
		$messages[$key]['statmsg'] = wfMsgNoDb( $key );
		$messages[$key]['msg'] = wfMsg ( $key );
	}

	$wgMessageCache->enableTransform();
	wfProfileOut( "$fname-setup" );

	wfProfileIn( "$fname-output" );
	if ($ot == 'php') {
		$navText .= makePhp($messages);
		$wgOut->addHTML('PHP | <a href="'.$wgTitle->escapeLocalUrl('ot=html').'">HTML</a><pre>'.htmlspecialchars($navText).'</pre>');
	} else {
		$wgOut->addHTML( '<a href="'.$wgTitle->escapeLocalUrl('ot=php').'">PHP</a> | HTML' );
		$wgOut->addWikiText( $navText );
		$wgOut->addHTML( makeHTMLText( $messages ) );
	}
	wfProfileOut( "$fname-output" );

	wfProfileOut( $fname );
}

/**
 *
 */
function makePhp($messages) {
	global $wgLanguageCode;
	$txt = "\n\n".'$wgAllMessages'.ucfirst($wgLanguageCode).' = array('."\n";
	foreach( $messages as $key => $m ) {
		if(strtolower($wgLanguageCode) != 'en' and $m['msg'] == $m['enmsg'] ) {
			//if (strstr($m['msg'],"\n")) {
			//	$txt.='/* ';
			//	$comment=' */';
			//} else {
			//	$txt .= '#';
			//	$comment = '';
			//}
			continue;
		} elseif ($m['msg'] == '&lt;'.$key.'&gt;'){
			$m['msg'] = '';
			$comment = ' #empty';
		} else {
			$comment = '';
		}
		$txt .= "'$key' => '" . preg_replace( "/(?<!\\\\)'/", "\'", $m['msg']) . "',$comment\n";
	}
	$txt .= ');';
	return $txt;
}

/**
 *
 */
function makeHTMLText( $messages ) {
	global $wgLang, $wgUser, $wgLanguageCode, $wgContLanguageCode;
	$fname = "makeHTMLText";
	wfProfileIn( $fname );

	$sk =& $wgUser->getSkin();
	$talk = $wgLang->getNsText( NS_TALK );
	$mwnspace = $wgLang->getNsText( NS_MEDIAWIKI );
	$mwtalk = $wgLang->getNsText( NS_MEDIAWIKI_TALK );

	$input = wfElement( 'input', array(
		'type'    => 'text',
		'id'      => 'allmessagesinput',
		'onkeyup' => 'allmessagesfilter()',),
		'');
	$checkbox = wfElement( 'input', array(
		'type'    => 'button',
		'value'   => wfMsgHtml( 'allmessagesmodified' ),
		'id'      => 'allmessagescheckbox',
		'onclick' => 'allmessagesmodified()',),
		'');

	$txt = '<span id="allmessagesfilter" style="display:none;">' .
		wfMsgHtml('allmessagesfilter') . " {$input}{$checkbox} " . '</span>';

	$txt .= "
<table border='1' cellspacing='0' width='100%' id='allmessagestable'>
	<tr>
		<th rowspan='2'>" . wfMsgHtml('allmessagesname') . "</th>
		<th>" . wfMsgHtml('allmessagesdefault') . "</th>
	</tr>
	<tr>
		<th>" . wfMsgHtml('allmessagescurrent') . "</th>
	</tr>";

	wfProfileIn( "$fname-check" );
	# This is a nasty hack to avoid doing independent existence checks
	# without sending the links and table through the slow wiki parser.
	$pageExists = array(
		NS_MEDIAWIKI => array(),
		NS_MEDIAWIKI_TALK => array()
	);
	$dbr =& wfGetDB( DB_SLAVE );
	$page = $dbr->tableName( 'page' );
	$sql = "SELECT page_namespace,page_title FROM $page WHERE page_namespace IN (" . NS_MEDIAWIKI . ", " . NS_MEDIAWIKI_TALK . ")";
	$res = $dbr->query( $sql );
	while( $s = $dbr->fetchObject( $res ) ) {
		$pageExists[$s->page_namespace][$s->page_title] = true;
	}
	$dbr->freeResult( $res );
	wfProfileOut( "$fname-check" );

	wfProfileIn( "$fname-output" );

	$i = 0;

	foreach( $messages as $key => $m ) {

		$title = $wgLang->ucfirst( $key );
		if($wgLanguageCode != $wgContLanguageCode)
			$title.="/$wgLanguageCode";

		$titleObj =& Title::makeTitle( NS_MEDIAWIKI, $title );
		$talkPage =& Title::makeTitle( NS_MEDIAWIKI_TALK, $title );

		$changed = ($m['statmsg'] != $m['msg']);
		$message = htmlspecialchars( $m['statmsg'] );
		$mw = htmlspecialchars( $m['msg'] );

		#$pageLink = $sk->makeLinkObj( $titleObj, htmlspecialchars( $key ) );
		#$talkLink = $sk->makeLinkObj( $talkPage, htmlspecialchars( $talk ) );
		if( isset( $pageExists[NS_MEDIAWIKI][$title] ) ) {
			$pageLink = $sk->makeKnownLinkObj( $titleObj, "<span id='sp-allmessages-i-$i'>" .  htmlspecialchars( $key ) . "</span>" );
		} else {
			$pageLink = $sk->makeBrokenLinkObj( $titleObj, "<span id='sp-allmessages-i-$i'>" .  htmlspecialchars( $key ) . "</span>" );
		}
		if( isset( $pageExists[NS_MEDIAWIKI_TALK][$title] ) ) {
			$talkLink = $sk->makeKnownLinkObj( $talkPage, htmlspecialchars( $talk ) );
		} else {
			$talkLink = $sk->makeBrokenLinkObj( $talkPage, htmlspecialchars( $talk ) );
		}
		
		$anchor = htmlspecialchars( strtolower( $title ) );
		$anchor = "<a id=\"$anchor\" name=\"$anchor\"></a>";

		if($changed) {

			$txt .= "
	<tr class='orig' id='sp-allmessages-r1-$i'>
		<td rowspan='2'>
			$anchor$pageLink<br />$talkLink
		</td><td>
$message
		</td>
	</tr><tr class='new' id='sp-allmessages-r2-$i'>
		<td>
$mw
		</td>
	</tr>";
		} else {

			$txt .= "
	<tr class='def' id='sp-allmessages-r1-$i'>
		<td>
			$anchor$pageLink<br />$talkLink
		</td><td>
$mw
		</td>
	</tr>";

		}
	$i++;
	}
	$txt .= "</table>";
	wfProfileOut( "$fname-output" );

	wfProfileOut( $fname );
	return $txt;
}

?>
