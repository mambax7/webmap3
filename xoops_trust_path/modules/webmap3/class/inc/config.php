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

/**
 * Class webmap3_inc_config
 */
class webmap3_inc_config
{
    public $_cached_config = [];
    public $_DIRNAME;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_inc_config constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_DIRNAME       = $dirname;
        $this->_cached_config = $this->get_config_by_dirname($dirname);
    }

    /**
     * @param $dirname
     * @return mixed
     */
    public static function getSingleton($dirname)
    {
        static $singletons;
        if (!isset($singletons[$dirname])) {
            $singletons[$dirname] = new self($dirname);
        }

        return $singletons[$dirname];
    }

    //---------------------------------------------------------
    // cache
    //---------------------------------------------------------

    /**
     * @param $name
     * @return bool|mixed
     */
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

    /**
     * @param $dirname
     * @return mixed
     */
    public function get_config_by_dirname($dirname)
    {
        $modid = $this->get_modid_by_dirname($dirname);

        return $this->get_config_by_modid($modid);
    }

    /**
     * @param $modid
     * @return mixed
     */
    public function get_config_by_modid($modid)
    {
        $configHandler = xoops_getHandler('config');

        return $configHandler->getConfigsByCat(0, $modid);
    }

    /**
     * @param $dirname
     * @return bool
     */
    public function get_modid_by_dirname($dirname)
    {
        $moduleHandler = xoops_getHandler('module');
        $module        = $moduleHandler->getByDirname($dirname);
        if (!is_object($module)) {
            return false;
        }

        return $module->getVar('mid');
    }

    // --- class end ---
}
