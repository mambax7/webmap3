<?php
// $Id: blocks.php,v 1.3 2012/04/10 01:55:04 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

$constpref = mb_strtoupper('_BL_' . $GLOBALS['MY_DIRNAME'] . '_');

// === define begin ===
if (!defined($constpref . 'LANG_LOADED')) {
    define($constpref . 'LANG_LOADED', 1);

    //---------------------------------------------------------
    // v1.10
    //---------------------------------------------------------
    define($constpref . 'HEIGHT', 'ɽ���ι⤵');
    define($constpref . 'TIMEOUT', 'ɽ�����ٱ����');
    define($constpref . 'TIMEOUT_DSC', '�ߥ���');
    // === define end ===
}
