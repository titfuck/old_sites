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
 * @version $Revision: 1.34 $ $Date: 2005/09/10 20:28:15 $
 * @package Slideshow
 * @author Alan Harder <alan.harder@sun.com>
 */

/**
 * The implementation of the Slideshow module
 *
 * @package Slideshow
 */
class SlideshowModule extends GalleryModule {

    function SlideshowModule() {
	global $gallery;
	$this->setId('slideshow');
	$this->setName($gallery->i18n('Slideshow'));
	$this->setDescription($gallery->i18n('Slideshow'));
	$this->setVersion('1.0.0');
	$this->setGroup('display', $this->translate('Display'));
	$this->setCallbacks('getItemLinks');
	$this->setRequiredCoreApi(array(6, 0));
	$this->setRequiredModuleApi(array(2, 0));
    }

    /**
     * @see GalleryModule::performFactoryRegistrations()
     */
    function performFactoryRegistrations() {
	$ret = GalleryCoreApi::registerFactoryImplementation(
	    'SlideshowInterface_1_0', 'SlideshowImpl', 'Slideshow',
	    'modules/slideshow/classes/SlideshowImpl.class', 'slideshow', null);
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
     * @see GalleryModule::getItemLinks()
     */
    function getItemLinks($items, $wantsDetailedLinks, $permissions) {
	$links = array();
	foreach ($items as $item) {
	    $itemId = $item->getId();
	    if (isset($wantsDetailedLinks[$itemId])) {
		$links[$itemId][] =
		    array('text' => $this->translate('View Slideshow'),
			  'params' => array(
			      'view' => 'slideshow.Slideshow',
			      'itemId' => $itemId));
	    }
	}
	return array(GalleryStatus::success(), $links);
    }

    /**
     * @see GalleryModule::getRewriteRules
     */
    function getRewriteRules() {
	$rules = array();
	
	$rule = array();
	$rule['comment'] = $this->translate('View Slideshow');
	$rule['match'] = array('view' => 'slideshow.Slideshow');
	$rule['pattern'] = 'v/%path%/slideshow.html';
        $rule['keywords'] = array(
            'path' => array(
                'pattern' => '([^?]+)',
                'help' => $this->translate('Path to an item (eg, /album/image.jpg.html)')));
	$rules[] = $rule;

	return $rules;
    }
}
?>
