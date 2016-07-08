<?php
// $Id: gicon_table_manage.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
webmap3_include_once( 'admin/header.php' );
webmap3_include_once( 'class/lib/handler_basic.php' );
webmap3_include_once( 'class/lib/handler_dirname.php' );
webmap3_include_once( 'class/lib/utility.php' );
webmap3_include_once( 'class/lib/post.php' );
webmap3_include_once( 'class/lib/footer.php' );
webmap3_include_once( 'class/lib/form.php' );
webmap3_include_once( 'class/lib/form_lang.php' );
webmap3_include_once( 'class/lib/pagenavi.php' );
webmap3_include_once( 'class/lib/admin_manage.php' );
webmap3_include_once( 'class/handler/gicon.php' );
webmap3_include_once( 'class/admin/gicon_table_manage.php' );

//=========================================================
// main
//=========================================================
$manage =& webmap3_admin_gicon_table_manage::getInstance( WEBMAP3_DIRNAME, WEBMAP3_TRUST_DIRNAME );
$manage->main();

exit();
// --- main end ---

?>