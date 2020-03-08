<?php
// $Id: admin.php,v 1.1.1.1 2012/03/17 09:28:10 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH . '/modules/webmap3/init.php';

if (!defined('WEBMAP3_DIRNAME')) {
    define('WEBMAP3_DIRNAME', $MY_DIRNAME);
}
if (!defined('WEBMAP3_ROOT_PATH')) {
    define('WEBMAP3_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . WEBMAP3_DIRNAME);
}

//---------------------------------------------------------
// check permission
//---------------------------------------------------------
global $xoopsUser;

// environment
require_once XOOPS_ROOT_PATH . '/class/template.php';
$moduleHandler     = xoops_getHandler('module');
$xoopsModule       = $moduleHandler->getByDirname($MY_DIRNAME);
$configHandler     = xoops_getHandler('config');
$xoopsModuleConfig = $configHandler->getConfigsByCat(0, $xoopsModule->getVar('mid'));

// check permission of 'module_admin' of this module
$modulepermHandler = xoops_getHandler('groupperm');
if (!is_object(@$xoopsUser) || !$modulepermHandler->checkRight('module_admin', $xoopsModule->getVar('mid'), $xoopsUser->getGroups())) {
    die('only admin can access this area');
}

$xoopsOption['pagetype'] = 'admin';
require_once XOOPS_ROOT_PATH . '/include/cp_functions.php';

//---------------------------------------------------------
// altsys
//---------------------------------------------------------
$mytrustdirname = WEBMAP3_TRUST_DIRNAME;
$mytrustdirpath = XOOPS_TRUST_PATH . '/modules/' . $mytrustdirname;
$mydirname      = $MY_DIRNAME;
$mydirpath      = XOOPS_ROOT_PATH . '/modules/' . $MY_DIRNAME;

if (!empty($_GET['lib'])) {
    // initialize language manager
    $langmanpath = XOOPS_TRUST_PATH . '/libs/altsys/class/D3LanguageManager.class.php';
    if (!file_exists($langmanpath)) {
        die('install the latest altsys');
    }

    require_once $langmanpath;
    $langman = D3LanguageManager::getInstance();

    // common libs (eg. altsys)
    $lib  = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['lib']);
    $page = preg_replace('/[^a-zA-Z0-9_-]/', '', @$_GET['page']);

    // check the page can be accessed (make controllers.php just under the lib)
    $controllers = [];
    if (file_exists(XOOPS_TRUST_PATH . '/libs/' . $lib . '/controllers.php')) {
        require XOOPS_TRUST_PATH . '/libs/' . $lib . '/controllers.php';
        if (!in_array($page, $controllers)) {
            $page = $controllers[0];
        }
    }

    if (file_exists(XOOPS_TRUST_PATH . '/libs/' . $lib . '/' . $page . '.php')) {
        include XOOPS_TRUST_PATH . '/libs/' . $lib . '/' . $page . '.php';
    } elseif (file_exists(XOOPS_TRUST_PATH . '/libs/' . $lib . '/index.php')) {
        include XOOPS_TRUST_PATH . '/libs/' . $lib . '/index.php';
    } else {
        die('wrong request');
    }

    exit();
}

// load language files (main.php & admin.php)
//  $langman->read( 'admin.php' , $mydirname , $mytrustdirname ) ;
//  $langman->read( 'main.php' , $mydirname , $mytrustdirname ) ;

//---------------------------------------------------------
// webmap3
//---------------------------------------------------------
webmap3_include_once('preload/debug.php');

// fork each pages
$get_fct  = isset($_GET['fct']) ? $_GET['fct'] : null;
$post_fct = isset($_POST['fct']) ? $_POST['fct'] : $get_fct;
$fct      = preg_replace('/[^a-zA-Z0-9_-]/', '', $post_fct);

$file_trust_fct   = WEBMAP3_TRUST_PATH . '/admin/' . $fct . '.php';
$file_root_fct    = WEBMAP3_ROOT_PATH . '/admin/' . $fct . '.php';
$file_trust_index = WEBMAP3_TRUST_PATH . '/admin/index.php';
$file_root_index  = WEBMAP3_ROOT_PATH . '/admin/index.php';
$file_root_main   = WEBMAP3_ROOT_PATH . '/admin/main.php';

if (file_exists($file_root_fct)) {
    webmap3_debug_msg($file_root_fct);
    include_once $file_root_fct;
} elseif (file_exists($file_trust_fct)) {
    webmap3_debug_msg($file_trust_fct);
    include_once $file_trust_fct;

    //} elseif ( file_exists( $file_root_index ) ) {
    //  webmap3_debug_msg( $file_root_index );
    //  include_once $file_root_index;
} elseif (file_exists($file_root_main)) {
    webmap3_debug_msg($file_root_main);
    include_once $file_root_main;
} elseif (file_exists($file_trust_index)) {
    webmap3_debug_msg($file_trust_index);
    include_once $file_trust_index;
} else {
    die('wrong request');
}
