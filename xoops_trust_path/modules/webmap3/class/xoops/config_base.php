<?php
// $Id: config_base.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_config_base
//=========================================================
class webmap3_xoops_config_base
{

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_config_handler = xoops_getHandler('config');
    }

    //---------------------------------------------------------
    // config handler
    //---------------------------------------------------------
    public function get_config_by_dirname($dirname)
    {
        $mid = $this->get_module_mid_by_dirname($dirname);
        return $this->get_config_by_mid($mid);
    }

    public function get_config_by_mid($mid)
    {
        return $this->_config_handler->getConfigsByCat(0, $mid);
    }

    public function get_search_config()
    {
        return $this->_config_handler->getConfigsByCat(XOOPS_CONF_SEARCH);
    }

    //---------------------------------------------------------
    // module handler
    //---------------------------------------------------------
    public function get_module_mid_by_dirname($dirname)
    {
        $module_handler = xoops_getHandler('module');
        $module         = $module_handler->getByDirname($dirname);
        if (is_object($module)) {
            return $module->getVar('mid');
        }
        return 0;
    }

    // --- class end ---
}
