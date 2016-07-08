<?php
// $Id: mytrustdirname.php,v 1.1.1.1 2012/03/17 09:28:52 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// main
//=========================================================
$GLOBALS['MY_DIRNAME'] = $MY_DIRNAME;

$MY_TRUST_DIRNAME = 'webmap3' ;

// xoops_virsion.php call many times
if ( !defined("WEBMAP3_TIME_START") ) {
	list($usec, $sec) = explode(" ",microtime()); 
	$time = floatval($sec) + floatval($usec); 
	define("WEBMAP3_TIME_START", $time );
}
if ( !defined("WEBMAP3_TRUST_DIRNAME") ) {
	define("WEBMAP3_TRUST_DIRNAME", $MY_TRUST_DIRNAME );
}
if ( !defined("WEBMAP3_TRUST_PATH") ) {
	define("WEBMAP3_TRUST_PATH", XOOPS_TRUST_PATH.'/modules/'.WEBMAP3_TRUST_DIRNAME );
}

?>