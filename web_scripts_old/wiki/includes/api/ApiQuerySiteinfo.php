<?php


/*
 * Created on Sep 25, 2006
 *
 * API for MediaWiki 1.8+
 *
 * Copyright (C) 2006 Yuri Astrakhan <FirstnameLastname@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

if (!defined('MEDIAWIKI')) {
	// Eclipse helper - will be ignored in production
	require_once ('ApiQueryBase.php');
}

class ApiQuerySiteinfo extends ApiQueryBase {

	public function __construct($query, $moduleName) {
		parent :: __construct($query, $moduleName, 'si');
	}

	public function execute() {
		$prop = null;
		extract($this->extractRequestParams());

		foreach ($prop as $p) {
			switch ($p) {

				case 'general' :

					global $wgSitename, $wgVersion, $wgCapitalLinks, $wgRightsCode, $wgRightsText;
					$data = array ();
					$mainPage = Title :: newFromText(wfMsgForContent('mainpage'));
					$data['mainpage'] = $mainPage->getText();
					$data['base'] = $mainPage->getFullUrl();
					$data['sitename'] = $wgSitename;
					$data['generator'] = "MediaWiki $wgVersion";
					$data['case'] = $wgCapitalLinks ? 'first-letter' : 'case-sensitive'; // 'case-insensitive' option is reserved for future
					if (isset($wgRightsCode))
						$data['rightscode'] = $wgRightsCode;
					$data['rights'] = $wgRightsText;
					$this->getResult()->addValue('query', $p, $data);
					break;

				case 'namespaces' :

					global $wgContLang;
					$data = array ();
					foreach ($wgContLang->getFormattedNamespaces() as $ns => $title) {
						$data[$ns] = array (
							'id' => $ns
						);
						ApiResult :: setContent($data[$ns], $title);
					}
					$this->getResult()->setIndexedTagName($data, 'ns');
					$this->getResult()->addValue('query', $p, $data);
					break;
					
				default :
					ApiBase :: dieDebug(__METHOD__, "Unknown prop=$p");
			}
		}
	}

	protected function getAllowedParams() {
		return array (
			'prop' => array (
				ApiBase :: PARAM_DFLT => 'general',
				ApiBase :: PARAM_ISMULTI => true,
				ApiBase :: PARAM_TYPE => array (
					'general',
					'namespaces'
				)
			)
		);
	}

	protected function getParamDescription() {
		return array (
			'prop' => array (
				'Which sysinfo properties to get:',
				' "general"    - Overall system information',
				' "namespaces" - List of registered namespaces (localized)'
			)
		);
	}

	protected function getDescription() {
		return 'Return general information about the site.';
	}

	protected function getExamples() {
		return 'api.php?action=query&meta=siteinfo&siprop=general|namespaces';
	}

	public function getVersion() {
		return __CLASS__ . ': $Id: ApiQuerySiteinfo.php 17265 2006-10-27 03:50:34Z yurik $';
	}
}
?>