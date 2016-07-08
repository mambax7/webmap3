<?php
// $Id: xoops_version.php,v 1.3 2012/04/10 00:15:02 ohwada Exp $

// 2012-04-02 K.OHWADA
// locate.php

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

webmap3_include_once( 'preload/debug.php',                  $MY_DIRNAME );
webmap3_include_once( 'include/constants.php',              $MY_DIRNAME );
webmap3_include_once( 'include/version.php',                $MY_DIRNAME );
webmap3_include_once( 'class/lib/handler_basic.php',        $MY_DIRNAME );
webmap3_include_once( 'class/xoops/block.php',              $MY_DIRNAME );
webmap3_include_once( 'class/xoops/config_update.php',      $MY_DIRNAME );
webmap3_include_once( 'class/inc/xoops_version_base.php',   $MY_DIRNAME );
webmap3_include_once( 'class/inc/xoops_version.php',        $MY_DIRNAME );
webmap3_include_language( 'modinfo.php',                    $MY_DIRNAME );
webmap3_include_language( 'locate.php',                     $MY_DIRNAME );

//---------------------------------------------------------
// main
//---------------------------------------------------------
$webmap3_inc_xoops_version =& webmap3_inc_xoops_version::getSingleton( $MY_DIRNAME );
$modversion = $webmap3_inc_xoops_version->modversion();

?>