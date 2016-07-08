<?php
// $Id: index.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
webmap3_include_once( 'admin/header.php' );
webmap3_include_once( 'class/lib/gd.php' );
webmap3_include_once( 'class/lib/server_info.php' );
webmap3_include_once( 'class/admin/server_check.php' );
webmap3_include_once( 'class/admin/index.php' );

//=========================================================
// main
//=========================================================
$manager =& webmap3_admin_index::getInstance( WEBMAP3_DIRNAME, WEBMAP3_TRUST_DIRNAME );
$manager->main();
exit();

?>