<?php
// $Id: index.php,v 1.1.1.1 2012/03/17 09:28:53 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

require '../../../mainfile.php';
if (!defined('XOOPS_TRUST_PATH')) {
    die('set XOOPS_TRUST_PATH in mainfile.php');
}

$MY_DIRNAME = basename(dirname(__DIR__));

require XOOPS_ROOT_PATH . '/modules/' . $MY_DIRNAME . '/include/mytrustdirname.php'; // set $mytrustdirname
require XOOPS_TRUST_PATH . '/modules/' . $MY_TRUST_DIRNAME . '/admin.php';
