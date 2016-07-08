<?php
// $Id: location.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// remove api_map.php

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
webmap3_include_once( 'admin/header.php' );
webmap3_include_once( 'class/lib/form.php' );
webmap3_include_once( 'class/lib/gtickets.php' );
webmap3_include_once( 'class/xoops/config_item.php' );
webmap3_include_once( 'class/admin/location.php' );

//=========================================================
// main
//=========================================================
$manager =& webmap3_admin_location::getInstance( WEBMAP3_DIRNAME, WEBMAP3_TRUST_DIRNAME );
$manager->main();
exit();

?>