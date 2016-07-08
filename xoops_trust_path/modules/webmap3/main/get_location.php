<?php
// $Id: get_location.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// include/api.php

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webphoto files
//---------------------------------------------------------
webmap3_include_once( 'include/api.php' );
webmap3_include_once( 'class/xoops/param.php' );
webmap3_include_once( 'class/main/get_location.php' );

//=========================================================
// main
//=========================================================
$manage =& webmap3_main_get_location::getInstance( WEBMAP3_DIRNAME );
$manage->main();
exit();

?>