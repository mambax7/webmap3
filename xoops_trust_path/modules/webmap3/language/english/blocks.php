<?php
// $Id: blocks.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

$constpref = strtoupper('_BL_' . $GLOBALS['MY_DIRNAME'] . '_');

// === define begin ===
if (!defined($constpref . 'LANG_LOADED')) {
    define($constpref . 'LANG_LOADED', 1);

    //---------------------------------------------------------
    // v1.10
    //---------------------------------------------------------
    define($constpref . 'HEIGHT', 'Map Height');
    define($constpref . 'TIMEOUT', 'Timeout');
    define($constpref . 'TIMEOUT_DSC', 'msec');

    // === define end ===
}
