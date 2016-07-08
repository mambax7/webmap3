<?php
// $Id: main.php,v 1.1.1.1 2012/03/17 09:28:10 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/webmap3/init.php';

if( !defined("WEBMAP3_DIRNAME") ) {
	  define("WEBMAP3_DIRNAME", $MY_DIRNAME );
}
if( !defined("WEBMAP3_ROOT_PATH") ) {
	  define("WEBMAP3_ROOT_PATH", XOOPS_ROOT_PATH.'/modules/'.WEBMAP3_DIRNAME );
}

webmap3_include_once( 'preload/debug.php' );

// fork each pages
$WEBMAP3_FCT       = webmap3_fct() ;
$file_trust_fct   = WEBMAP3_TRUST_PATH .'/main/'. $WEBMAP3_FCT .'.php' ;
$file_root_fct    = WEBMAP3_ROOT_PATH  .'/main/'. $WEBMAP3_FCT .'.php' ;
$file_trust_index = WEBMAP3_TRUST_PATH .'/main/index.php' ;
$file_root_index  = WEBMAP3_ROOT_PATH  .'/main/index.php' ;

if ( file_exists( $file_root_fct ) ) {
	webmap3_debug_msg( $file_root_fct );
	include_once $file_root_fct;

} elseif ( file_exists( $file_trust_fct ) ) {
	webmap3_debug_msg( $file_trust_fct );
	include_once $file_trust_fct;

} elseif ( file_exists( $file_root_index ) ) {
	webmap3_debug_msg( $file_root_index );
	include_once $file_root_index;

} elseif ( file_exists( $file_trust_index ) ) {
	webmap3_debug_msg( $file_trust_index );
	include_once $file_trust_index;

} else {
	die( 'wrong request' ) ;
}

?>