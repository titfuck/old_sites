<?php
/*
 * $RCSfile: UserAdmin.inc,v $
 *
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2005 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * @version $Revision: 1.24 $ $Date: 2005/08/23 03:49:02 $
 * @package GalleryCore
 * @subpackage UserInterface
 * @author Bharat Mediratta <bharat@menalto.com>
 */

/**
 * This view will present the available options to administer a user
 *
 * @package GalleryCore
 * @subpackage UserInterface
 *
 */
class UserAdminView extends GalleryView {

    /**
     * @see GalleryView::loadTemplate
     */
    function loadTemplate(&$template, &$form) {
	global $gallery;
	$user = $gallery->getActiveUser();

	/* Load the module list */
	list ($ret, $moduleStatus) = GalleryCoreApi::fetchPluginStatus('module');
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}

	/* Get a list of all the admin views for each module */
	$subViewChoices = array();
	foreach ($moduleStatus as $moduleId => $status) {
	    if (empty($status['active'])) {
		continue;
	    }

	    /* Get the selected module's admin view */
	    if (in_array('getUserAdminViews', explode('|', $status['callbacks']))) {
		list($ret, $module) = GalleryCoreApi::loadPlugin('module', $moduleId);
		if ($ret->isError()) {
		    if ($ret->getErrorCode() & ERROR_PLUGIN_VERSION_MISMATCH) {
			continue;
		    }
		    return array($ret->wrap(__FILE__, __LINE__), null);
		}

		list ($ret, $moduleViews) = $module->getUserAdminViews($user);
		if ($ret->isError()) {
		    return array($ret->wrap(__FILE__, __LINE__), null);
		}

		$subViewChoices = array_merge($subViewChoices, $moduleViews);
	    }
	}

	/* If we have a specific sub view, load it now */
	$subViewName = GalleryUtilities::getRequestVariables('subView');
	if ($subViewName == 'core.UserAdmin') {
	    return array(GalleryStatus::error(ERROR_BAD_PARAMETER, __FILE__, __LINE__), null);
	}
	if (empty($subViewName) && !empty($subViewChoices)) {
	    $subViewName = $subViewChoices[0]['view'];
	}

	list ($ret, $isSiteAdmin) = GalleryCoreApi::isUserInSiteAdminGroup();
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}

	/* Our sub view may have set some hints, like the encoding type */
	if ($template->hasVariable('UserAdmin')) {
	    $UserAdmin =& $template->getVariableByReference('UserAdmin');
	} else {
	    $UserAdmin = array();
	    $template->setVariableByReference('UserAdmin', $UserAdmin);
	}

	/* Get the links for navigating back to where we came from */
	$urlGenerator =& $gallery->getUrlGenerator();
	list ($ret, $navigationLinks) = $urlGenerator->getNavigationLinks();
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}

	/* Bring in the root album information for the breadcrumb */
	list ($ret, $rootAlbumId) =
	    GalleryCoreApi::getPluginParameter('module', 'core', 'id.rootAlbum');
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}
	list ($ret, $rootAlbum) = GalleryCoreApi::loadEntitiesById($rootAlbumId);
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}

	list($ret, $module) = GalleryCoreApi::loadPlugin('module', 'core');
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}

	/* Set up my view parameters */
	$UserAdmin['navigationLinks'] = $navigationLinks;
	$UserAdmin['subViewChoices'] = $subViewChoices;
	$UserAdmin['subViewName'] = $subViewName;
	$UserAdmin['isSiteAdmin'] = $isSiteAdmin;
	$UserAdmin['rootAlbum'] = $rootAlbum->getMemberData();

	if (!empty($subViewName)) {
	    list ($ret, $subView) = GalleryView::loadView($subViewName);
	    if ($ret->isError()) {
		return array($ret->wrap(__FILE__, __LINE__), null);
	    }

	    list ($ret, $results) = $subView->loadTemplate($template, $form);
	    if ($ret->isError()) {
		return array($ret->wrap(__FILE__, __LINE__), null);
	    }

	    if (isset($results['redirect'])) {
		return array(GalleryStatus::success(), $results);
	    }

	    $UserAdmin['viewBodyFile'] = $results['body'];
	    $UserAdmin['viewL10Domain'] = $subView->getL10Domain();
	}

	$template->setVariable('UserAdmin', $UserAdmin);
	$template->title($module->translate('Gallery User Administration'));
	return array(GalleryStatus::success(),
		     array('body' => 'modules/core/templates/UserAdmin.tpl'));
    }

    /**
     * @see GalleryView::getViewDescription()
     */
    function getViewDescription() {
	global $gallery;

	/* Get the description from the current subView */
	$subViewName = GalleryUtilities::getRequestVariables('subView');
	if (empty($subViewName)) {
	    $subViewName = 'core.ItemEdit';
	}
	list ($ret, $subView) = GalleryView::loadView($subViewName);
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}

	list ($ret, $description) = $subView->getViewDescription();
	if ($ret->isError()) {
	    return array($ret->wrap(__FILE__, __LINE__), null);
	}

	return array(GalleryStatus::success(), $description);
    }
}
?>
