<?php
// $Id: optional.php,v 1.1.1.1 2012/03/17 09:28:10 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// optional functions
// do not replace this file
//=========================================================
function webmap3_fct()
{
	$d3_class =& webmap3_d3_optional::getInstance();
	return $d3_class->get_fct();
}

function webmap3_include_once_trust( $file, $debug=true )
{
	$d3_class =& webmap3_d3_optional::getInstance();
	$d3_class->init_trust( WEBMAP3_TRUST_DIRNAME );
	return $d3_class->include_once_trust_file( $file, $debug );
}

function webmap3_include_once( $file, $dirname=null, $debug=true )
{
	$d3_class =& webmap3_d3_optional::getInstance();
	$d3_class->init( webmap3_get_dirname( $dirname ), WEBMAP3_TRUST_DIRNAME );
	return $d3_class->include_once_file( $file, $debug );
}

function webmap3_include_once_language( $file, $dirname=null, $language=null )
{
	$d3_class =& webmap3_d3_optional::getInstance();
	$d3_class->init( webmap3_get_dirname( $dirname ), WEBMAP3_TRUST_DIRNAME );
	return $d3_class->include_once_language( $file );
}

function webmap3_include_language( $file, $dirname=null, $language=null )
{
	$d3_class =& webmap3_d3_optional::getInstance();
	$d3_class->init( webmap3_get_dirname( $dirname ), WEBMAP3_TRUST_DIRNAME );
	return $d3_class->include_language( $file );
}

function webmap3_debug_msg( $file, $dirname=null )
{
	$d3_class =& webmap3_d3_optional::getInstance();
	$d3_class->init( webmap3_get_dirname( $dirname ), WEBMAP3_TRUST_DIRNAME );
	return $d3_class->debug_msg_include_file( $file );
}

function webmap3_include_once_preload( $dirname=null )
{
	$preload_class =& webmap3_d3_preload::getInstance();
	$preload_class->init( webmap3_get_dirname( $dirname ), WEBMAP3_TRUST_DIRNAME );
	return $preload_class->include_once_preload_files();
}

function webmap3_include_once_preload_trust()
{
	$preload_class =& webmap3_d3_preload::getInstance();
	$preload_class->init_trust( WEBMAP3_TRUST_DIRNAME );
	return $preload_class->include_once_preload_trust_files();
}

function webmap3_get_dirname( $dirname )
{
	if ( ! defined("WEBMAP3_TRUST_DIRNAME") ) {
//		debug_print_backtrace();
		die( 'not permit' );
	}

	if ( empty($dirname) ) {
		if ( defined("WEBMAP3_DIRNAME") ) {
			$dirname = WEBMAP3_DIRNAME ;
		} else {
//			debug_print_backtrace();
			die( 'not permit' );
		}
	}

	return $dirname;
}

?>