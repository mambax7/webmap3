<?php
// $Id: geocoding.php,v 1.1 2012/04/09 11:54:05 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-04-02 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

webmap3_include_once('main/header.php');
webmap3_include_once('include/api.php');
webmap3_include_once('class/main/geocoding.php');

//=========================================================
// main
//=========================================================
$manage = webmap3_main_geocoding::getInstance(WEBMAP3_DIRNAME);

$xoopsOption['template_main'] = WEBMAP3_DIRNAME . '_main_geocoding.html';
include XOOPS_ROOT_PATH . '/header.php';

$xoopsTpl->assign($manage->main());

include(XOOPS_ROOT_PATH . '/footer.php');
