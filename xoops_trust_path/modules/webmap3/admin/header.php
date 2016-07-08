<?php
// $Id: header.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// api.php

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
webmap3_include_once( 'include/api.php' );

webmap3_include_once( 'class/lib/dir.php' );
webmap3_include_once( 'class/lib/utility.php' );
webmap3_include_once( 'class/lib/admin_base.php' );
webmap3_include_once( 'class/lib/admin_menu.php' );
webmap3_include_once( 'class/xoops/param.php' );
webmap3_include_once( 'class/inc/admin_menu_base.php' );
webmap3_include_once( 'class/inc/admin_menu.php' );
webmap3_include_once( 'class/admin/base.php' );
webmap3_include_once( 'class/admin/menu.php' );

webmap3_include_language( 'modinfo.php' );
webmap3_include_language( 'main.php' );
webmap3_include_language( 'admin.php' );

webmap3_include_once_preload_trust();
webmap3_include_once_preload();

?>