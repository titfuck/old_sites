<?php

/**
 * Version 1.0 (Works out of box with MW 1.7.1)
 *
 * Authentication Plugin for Apache2 mod_ssl
 * Derived from AuthPlugin.php and
 * http://meta.wikimedia.org/wiki/Shibboleth_Authentication
 *
 * Much of the commenting comes straight from AuthPlugin.php
 *
 * Copyright 2006 Martin Johnson
 * Released under the GNU General Public License
 *
 * Documentation at http://www.mediawiki.org/wiki/Extension:SSL_authentication
 */

require_once('AuthPlugin.php');

class SSLAuthPlugin extends AuthPlugin {
    /**
     * See AuthPlugin.php for specific information
     */
    function userExists( $username ) {
        return true;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function authenticate( $username, $password ) {
        global $ssl_UN;

        if($username == $ssl_UN)
            return true;
        else
            return false;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function modifyUITemplate( &$template ) {
        $template->set( 'usedomain', false );
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function setDomain( $domain ) {
        $this->domain = $domain;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function validDomain( $domain ) {
        return true;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function updateUser( &$user ) {
        global $ssl_map_info;
        global $ssl_email;
        global $ssl_RN;

        if($ssl_email != null)
            $user->setEmail($ssl_email);

        if($ssl_RN != null)
            $user->setRealName($ssl_RN);
/*
        //For security, scramble the password to confuse the enemy.
        //This set the password to a 15 byte random string.
        $pass = null;
        for($i = 0; $i < 15; ++$i)
            $pass .= chr(mt_rand(0,255));
        $user->setPassword($pass);
*/
		if (!is_null($ssl_email) || !is_null($ssl_RN))
			$user->saveSettings();
        return true;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function autoCreate() {
        return false;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function allowPasswordChange() {
        return true;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function setPassword( $password ) {
        return true;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function updateExternalDB( $user ) {
        //Not really, but wiki thinks we did...
        return true;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function canCreateAccounts() {
        return false;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function addUser( $user, $password ) {
        return false;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function strict() {
        return false;
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function initUser( &$user ) {
            //Update MW with new user information
        $this->updateUser($user);
    }

    /**
     * See AuthPlugin.php for specific information
     */
    function getCanonicalName( $username ) {
        return $username;
    }
}

/**
 * End of AuthPlugin Code, beginning of hook code and auth functions
 */

/**
 * Some extension information init
 */
$wgExtensionFunctions[] = 'SSLAuthSetup';
$wgExtensionCredits['other'][] = array(
   'name' => 'SSLAuth',
   'version' => '1.0',
   'author' => 'Martin Johnson',
   'description' => 'Automagic login with certificates using Apache2 mod_ssl clientside',
   'url' => 'http://www.mediawiki.org/wiki/Extension:SSL_authentication'
);

/**
 * Setup extensionfunctions
 */
function SSLAuthSetup()
{
    global $ssl_UN;
    global $wgHooks;
    global $wgAuth;

    if($ssl_UN != null)
    {
        $wgHooks['AutoAuthenticate'][] = 'SSLAuth'; /* Hook for magical authN */
        $wgHooks['PersonalUrls'][] = 'NoLogout'; /* Disallow logout link */
        $wgAuth = new SSLAuthPlugin();
    }
/**
* Hooks looks funny in Special:Version
* Written twice. Whats wrong with this code?
*/
}

/* No logout link in MW */
function NoLogout(&$personal_urls, $title)
{
    $personal_urls['logout'] = null;
}

/* Tries to be magical about when to log in users and when not to. */
function SSLAuth(&$user)
{
    global $ssl_UN;
    global $wgUser;
    global $wgContLang;

    //Give us a user, see if we're around
    $tmpuser = User::newFromSession();

    //They already with us?  If so, quit this function.
    if($tmpuser->isLoggedIn())
        return;

    //Is the user already in the database?
    $tmpuser = User::newFromName($ssl_UN);

    //If exists, log them in
    if($tmpuser->getID() != 0)
    {
        $user = &$tmpuser;
		$user->setCookies();
		$user->setupSession();
		global $wgOut;
		$wgOut->redirect($_SERVER['REQUEST_URI']);
        return;
    }
/*
    //Okay, kick this up a notch then...
    $wgUser = &$tmpuser;
    $wgUser->setName($wgContLang->ucfirst($ssl_UN));

     require_once('SpecialUserlogin.php');

     //This section contains a silly hack for MW
     global $wgLang;
     global $wgContLang;
     global $wgRequest;
     if(!isset($wgLang))
     {
         $wgLang = $wgContLang;
         $wgLangUnset = true;
     }

     //This creates our form that'll do black magic
     $lf = new loginForm($wgRequest);

     //And now we clean up our hack
     if($wgLangUnset == true)
     {
         unset($wgLang);
         unset($wgLangUnset);
     }

     //Now we _do_ the black magic
     $lf->initUser($wgUser);

     //Finish it off
     $wgUser->saveSettings();
     $wgUser->setupSession();
     $wgUser->setCookies();
*/
}
?>
