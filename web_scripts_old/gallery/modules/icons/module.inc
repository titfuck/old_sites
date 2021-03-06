<?php
/*
 * $RCSfile: module.inc,v $
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
 * @version $Revision: 1.11 $ $Date: 2005/09/10 20:28:12 $
 * @package Icons
 * @author Jesse Mullan <jmullan@visi.com>
 */

/**
 * The implementation of the Icons module
 *
 * @package Icons
 */
class IconsModule extends GalleryModule {

    function IconsModule() {
	global $gallery;
	$this->setId('icons');
	$this->setName($gallery->i18n('Icons'));
	$this->setDescription($gallery->i18n('Display icons for links'));
	$this->setVersion('1.0.0'); /* Update upgrade() function below too */
	$this->setGroup('display', $this->translate('Display'));
	$this->setCallbacks('getSiteAdminViews');
	$this->setRequiredCoreApi(array(6, 0));
	$this->setRequiredModuleApi(array(2, 0));
    }

    /**
     * @see GalleryModule::upgrade()
     */
    function upgrade($currentVersion) {
	list ($ret, $params) = GalleryCoreApi::fetchAllPluginParameters('module', 'icons');
	if ($ret->isError()) {
	    return $ret->wrap(__FILE__, __LINE__);
	}
	foreach (array('iconpack' => '') as $key => $value) {
	    if (!isset($params[$key])) {
		$ret = $this->setParameter($key, $value);
		if ($ret->isError()) {
		    return $ret->wrap(__FILE__, __LINE__);
		}
	    }
	}

	if (empty($currentVersion)) {
	    $currentVersion = '0';
	}

	switch ($currentVersion) {
	case '0':
	    $ret = $this->setParameter('iconpack', 'paularmstrongdesigns');
	    if ($ret->isError()) {
		    return $ret->wrap(__FILE__, __LINE__);
	    }
	    break;

	case '0.9.0':
	case '0.9.1':
	case '0.9.2':
	    if (isset($params['iconpack']) && $params['iconpack'] == 'paularmstrongdesigns.com') {
		/* Removed ".com" from paularmstrongdesigns.com dir, IIS 5.1 didn't like it */
		$ret = $this->setParameter('iconpack', 'paularmstrongdesigns');
		if ($ret->isError()) {
		    return $ret->wrap(__FILE__, __LINE__);
		}
	    }

	case '0.9.3':
	case '0.9.4':
	case '0.9.5':

	case 'end of upgrade path':
	    break;

	default:
	    return GalleryStatus::error(ERROR_BAD_PLUGIN, __FILE__, __LINE__,
					sprintf('Unknown module version %s', $currentVersion));
	}

	return GalleryStatus::success();
    }

    /**
     * @see GalleryModule::performFactoryRegistrations()
     */
    function performFactoryRegistrations() {
	$ret = GalleryCoreApi::registerFactoryImplementation(
	    'IconsInterface_1_0', 'IconsImpl', 'Icons',
	    'modules/icons/classes/IconsImpl.class', 'icons', null);
	if ($ret->isError()) {
	    return $ret->wrap(__FILE__, __LINE__);
	}

	return GalleryStatus::success();
    }

    /**
     * @see GalleryModule::isRecommendedDuringInstall()
     */
    function isRecommendedDuringInstall() {
	return true;
    }

    /**
     * @see GalleryModule::autoConfigure()
     */
    function autoConfigure() {
	/* We don't require any special configuration */
	return array(GalleryStatus::success(), true);
    }

    /**
     * @see GalleryModule::getSiteAdminViews()
     */
    function getSiteAdminViews() {
	return array(GalleryStatus::success(),
		     array(array('name' => $this->translate('Icons'),
				 'view' => 'icons.IconsSiteAdmin')));
    }
}
?>
