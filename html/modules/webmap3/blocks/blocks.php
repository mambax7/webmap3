<?php
// $Id: blocks.php,v 1.1.1.1 2012/03/17 09:28:52 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('set XOOPS_TRUST_PATH into mainfile.php');
}

$MY_DIRNAME = basename(dirname(__DIR__));

require XOOPS_ROOT_PATH . '/modules/' . $MY_DIRNAME . '/include/mytrustdirname.php'; // set $mytrustdirname
require XOOPS_TRUST_PATH . '/modules/' . $MY_TRUST_DIRNAME . '/blocks.php';
