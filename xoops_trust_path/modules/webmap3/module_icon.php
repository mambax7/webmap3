<?php
// $Id: module_icon.php,v 1.1.1.1 2012/03/17 09:28:10 ohwada Exp $

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

webmap3_include_once( 'class/d3/module_icon.php', $MY_DIRNAME );

//---------------------------------------------------------
// main
//---------------------------------------------------------
$webmap3_module_icon = new webmap3_d3_module_icon( $MY_DIRNAME, WEBMAP3_TRUST_DIRNAME );
$webmap3_module_icon->output_image();

?>