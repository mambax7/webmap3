<?php
// $Id: kml.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// remove api_kml.php

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
webmap3_include_once( 'admin/header.php' );
webmap3_include_once( 'class/view/kml.php' );
webmap3_include_once( 'class/admin/kml.php' );

//=========================================================
// main
//=========================================================
$manager =& webmap3_admin_kml::getInstance( WEBMAP3_DIRNAME );
$manager->main();
exit();

?>