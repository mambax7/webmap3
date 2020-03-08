<?php
// $Id: location.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

webmap3_include_once('main/header.php');
webmap3_include_once('class/main/location.php');

//=========================================================
// main
//=========================================================
$manage = webmap3_main_location::getInstance(WEBMAP3_DIRNAME);

$GLOBALS['xoopsOption']['template_main'] = WEBMAP3_DIRNAME . '_main_location.tpl';
include XOOPS_ROOT_PATH . '/header.php';

$xoopsTpl->assign($manage->main());

include XOOPS_ROOT_PATH . '/footer.php';
