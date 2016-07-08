<?php
// $Id: init.php,v 1.2 2012/04/10 00:15:02 ohwada Exp $

// 2012-04-02 K.OHWADA
// $GLOBALS['MY_DIRNAME']

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------
if ( !isset($MY_DIRNAME) && isset($GLOBALS['MY_DIRNAME']) ) {
	$MY_DIRNAME = $GLOBALS['MY_DIRNAME'];
}

//---------------------------------------------------------
// $MY_TRUST_DIRNAME
//---------------------------------------------------------
if ( !isset($MY_TRUST_DIRNAME) ) {
	$MY_TRUST_DIRNAME = basename( dirname( __FILE__ ) ) ;
}
if ( !defined("WEBMAP3_TRUST_DIRNAME") ) {
	define("WEBMAP3_TRUST_DIRNAME", $MY_TRUST_DIRNAME );
}
if ( !defined("WEBMAP3_TRUST_PATH") ) {
	define("WEBMAP3_TRUST_PATH", XOOPS_TRUST_PATH.'/modules/'.WEBMAP3_TRUST_DIRNAME );
}

include_once WEBMAP3_TRUST_PATH.'/class/d3/optional.php';
include_once WEBMAP3_TRUST_PATH.'/class/d3/preload.php';
include_once WEBMAP3_TRUST_PATH.'/include/optional.php';

?>