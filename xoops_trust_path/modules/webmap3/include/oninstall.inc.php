<?php
// $Id: oninstall.inc.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// xoops system files
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php' ;
include_once XOOPS_ROOT_PATH.'/class/template.php' ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/webmap3/init.php';

webmap3_include_once( 'include/constants.php',         $MY_DIRNAME );
webmap3_include_once( 'class/lib/handler_basic.php',   $MY_DIRNAME );
webmap3_include_once( 'class/xoops/config_update.php', $MY_DIRNAME );
webmap3_include_once( 'class/inc/oninstall_base.php',  $MY_DIRNAME );
webmap3_include_once( 'class/inc/oninstall.php',       $MY_DIRNAME );

webmap3_include_once_trust( 'preload/constants.php' );

//=========================================================
// onInstall function
//=========================================================
// --- eval begin ---
eval( '

function xoops_module_install_'.$MY_DIRNAME.'( &$module ) 
{
	return webmap3_oninstall_base( $module ) ; 
} 

function xoops_module_update_'.$MY_DIRNAME.'( &$module ) {
	return webmap3_onupdate_base( $module ) ; 
} 

function xoops_module_uninstall_'.$MY_DIRNAME.'( &$module ) {
	return webmap3_onuninstall_base( $module ) ; 
} 

' ) ;
// --- eval end ---

// === function begin ===
if( ! function_exists( 'webmap3_oninstall_base' ) ) 
{

function webmap3_oninstall_base( &$module )
{
	$inc_class =& webmap3_inc_oninstall::getInstance();
	return $inc_class->install( $module );
}

function webmap3_onupdate_base( &$module )
{
	$inc_class =& webmap3_inc_oninstall::getInstance();
	return $inc_class->update( $module );
}

function webmap3_onuninstall_base( &$module )
{
	$inc_class =& webmap3_inc_oninstall::getInstance();
	return  $inc_class->uninstall( $module );
}

function webmap3_message_append_oninstall( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['ret'] ) ) {
		foreach( $GLOBALS['ret'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

function webmap3_message_append_onupdate( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['msgs'] ) ) {
		foreach( $GLOBALS['msgs'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

function webmap3_message_append_onuninstall( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['ret'] ) ) {
		foreach( $GLOBALS['ret'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

// === function begin ===
}

?>