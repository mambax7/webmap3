<?php
// $Id: config.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_inc_config
//=========================================================
//---------------------------------------------------------
// caller inc_blocks
//---------------------------------------------------------

class webmap3_inc_config
{
    public $_cached_config = array();
    public $_DIRNAME;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        $this->_DIRNAME       = $dirname;
        $this->_cached_config = $this->get_config_by_dirname($dirname);
    }

    public static function getSingleton($dirname)
    {
        static $singletons;
        if (!isset($singletons[$dirname])) {
            $singletons[$dirname] = new webmap3_inc_config($dirname);
        }
        return $singletons[$dirname];
    }

    //---------------------------------------------------------
    // cache
    //---------------------------------------------------------
    public function get_by_name($name)
    {
        if (isset($this->_cached_config[$name])) {
            return $this->_cached_config[$name];
        }
        return false;
    }

    //---------------------------------------------------------
    // xoops class
    //---------------------------------------------------------
    public function get_config_by_dirname($dirname)
    {
        $modid = $this->get_modid_by_dirname($dirname);
        return $this->get_config_by_modid($modid);
    }

    public function get_config_by_modid($modid)
    {
        $config_handler = xoops_getHandler('config');
        return $config_handler->getConfigsByCat(0, $modid);
    }

    public function get_modid_by_dirname($dirname)
    {
        $module_handler = xoops_getHandler('module');
        $module         = $module_handler->getByDirname($dirname);
        if (!is_object($module)) {
            return false;
        }
        return $module->getVar('mid');
    }

    // --- class end ---
}
