<?php
// $Id: api.php,v 1.3 2012/04/10 00:32:20 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-04-02 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// xoops system files
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/class/template.php';
include_once XOOPS_ROOT_PATH.'/class/snoopy.php';

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/webmap3/init.php';

if ( !isset($MY_DIRNAME) && isset($GLOBALS['MY_DIRNAME']) ) {
	$MY_DIRNAME = $GLOBALS['MY_DIRNAME'];
}

webmap3_include_once( 'include/constants.php',          $MY_DIRNAME );
webmap3_include_once( 'class/lib/handler_basic.php',    $MY_DIRNAME );
webmap3_include_once( 'class/lib/handler_dirname.php',  $MY_DIRNAME );
webmap3_include_once( 'class/lib/utility.php',          $MY_DIRNAME );
webmap3_include_once( 'class/lib/multibyte.php',        $MY_DIRNAME );
webmap3_include_once( 'class/lib/form.php',             $MY_DIRNAME );
webmap3_include_once( 'class/lib/xml.php',              $MY_DIRNAME );
webmap3_include_once( 'class/lib/xml_build.php',        $MY_DIRNAME );
webmap3_include_once( 'class/lib/kml_build.php',        $MY_DIRNAME );
webmap3_include_once( 'class/xoops/config_base.php',    $MY_DIRNAME );
webmap3_include_once( 'class/xoops/config_dirname.php', $MY_DIRNAME );
webmap3_include_once( 'class/xoops/config.php',         $MY_DIRNAME );
webmap3_include_once( 'class/xoops/header_base.php',    $MY_DIRNAME );
webmap3_include_once( 'class/xoops/header.php',         $MY_DIRNAME );
webmap3_include_once( 'class/d3/language_base.php',     $MY_DIRNAME );
webmap3_include_once( 'class/d3/language.php',          $MY_DIRNAME );
webmap3_include_once( 'class/inc/config.php',           $MY_DIRNAME );
webmap3_include_once( 'class/handler/gicon.php',        $MY_DIRNAME );
webmap3_include_once( 'class/api/map.php',              $MY_DIRNAME );
webmap3_include_once( 'class/api/html.php',             $MY_DIRNAME );
webmap3_include_once( 'class/api/gicon.php',            $MY_DIRNAME );
webmap3_include_once( 'class/api/form.php',             $MY_DIRNAME );
webmap3_include_once( 'class/api/get_location.php',     $MY_DIRNAME );
webmap3_include_once( 'class/api/kml.php',              $MY_DIRNAME );
webmap3_include_once( 'class/api/geocoding.php',        $MY_DIRNAME );
webmap3_include_language( 'main.php',                   $MY_DIRNAME );

?>