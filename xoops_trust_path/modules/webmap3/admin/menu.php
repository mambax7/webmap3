<?php
// $Id: menu.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/webmap3/init.php';

$MY_DIRNAME= $GLOBALS['MY_DIRNAME'];
webmap3_include_once( 'class/inc/admin_menu_base.php', $MY_DIRNAME );
webmap3_include_once( 'class/inc/admin_menu.php',      $MY_DIRNAME );
webmap3_include_language( 'modinfo.php',               $MY_DIRNAME );

//=========================================================
// main
//=========================================================
$manager =& webmap3_inc_admin_menu::getSingleton( $MY_DIRNAME );
$adminmenu = $manager->build_main_menu();

?>