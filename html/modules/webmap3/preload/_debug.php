<?php
// $Id: _debug.php,v 1.1.1.1 2012/03/17 09:28:53 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// optional parameter for debug
//---------------------------------------------------------

$MY_DIRNAME = basename(dirname(__DIR__));
$constpref  = strtoupper('_P_' . $MY_DIRNAME . '_');

// === á define begin ===
if (!defined('_' . $constpref . 'DEBUG_LOADED')) {
    define('_' . $constpref . 'DEBUG_LOADED', 1);

    error_reporting(E_ALL);

    define($constpref . 'DEBUG_SQL', 0);
    define($constpref . 'DEBUG_INCLUDE', 0);
    define($constpref . 'DEBUG_ERROR', 1);

    define($constpref . 'DEBUG_INC_SQL', 0);
    define($constpref . 'DEBUG_INC_ERROR', 1);

    define($constpref . 'TIME_SUCCESS', 1000);
    define($constpref . 'TIME_FAIL', 1000);

    // === define end ===
}
