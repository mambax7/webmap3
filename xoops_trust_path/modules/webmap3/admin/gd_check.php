<?php
// $Id: gd_check.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
webmap3_include_once( 'class/admin/gd_check_base.php' );
webmap3_include_once( 'class/admin/gd_check.php' );
webmap3_include_language( 'admin.php' );

//=========================================================
// main
//=========================================================
$manager =& webmap3_admin_gd_check::getInstance();
$manager->main();
exit();

?>