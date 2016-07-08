<?php
// $Id: gicon_manager.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
webmap3_include_once('admin/header.php');

webmap3_include_once('class/lib/gd.php');
webmap3_include_once('class/lib/image_mime.php');
webmap3_include_once('class/lib/post.php');
webmap3_include_once('class/lib/utility.php');
webmap3_include_once('class/lib/handler_basic.php');
webmap3_include_once('class/lib/handler_dirname.php');
webmap3_include_once('class/lib/uploader.php');
webmap3_include_once('class/lib/uploader_lang.php');
webmap3_include_once('class/lib/form.php');
webmap3_include_once('class/lib/form_lang.php');
webmap3_include_once('class/handler/gicon.php');
webmap3_include_once('class/admin/gicon_form.php');
webmap3_include_once('class/admin/gicon_manager.php');

//=========================================================
// main
//=========================================================
$manager = webmap3_admin_gicon_manager::getInstance(WEBMAP3_DIRNAME, WEBMAP3_TRUST_DIRNAME);
$manager->main();
exit();
