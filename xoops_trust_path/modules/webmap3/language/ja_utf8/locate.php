<?php
// $Id: locate.php,v 1.2 2012/04/10 00:15:52 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-04-02 K.OHWADA
//=========================================================

// test
if (defined('FOR_XOOPS_LANG_CHECKER')) {
    $MY_DIRNAME = 'webmap3';

    // normal
} elseif (isset($GLOBALS['MY_DIRNAME'])) {
    $MY_DIRNAME = $GLOBALS['MY_DIRNAME'];

    // call by altsys/mytplsadmin.php
} elseif ($mydirname) {
    $MY_DIRNAME = $mydirname;

    // probably error
} else {
    echo 'not set dirname in ' . __FILE__ . " <br />\n";
    $MY_DIRNAME = 'webmap3';
}

$constpref = strtoupper('_L_' . $MY_DIRNAME . '_');

// === define begin ===
if (!defined($constpref . 'LANG_LOADED')) {
    define($constpref . 'LANG_LOADED', 1);

    // geocoding: Japan
    define($constpref . 'REGION', 'jp');
}// === define begin ===
;
