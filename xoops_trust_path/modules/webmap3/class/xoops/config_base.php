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

/**
 * Class webmap3_xoops_config_base
 */
class webmap3_xoops_config_base
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_configHandler = xoops_getHandler('config');
    }

    //---------------------------------------------------------
    // config handler
    //---------------------------------------------------------

    /**
     * @param $dirname
     * @return mixed
     */
    public function get_config_by_dirname($dirname)
    {
        $mid = $this->get_module_mid_by_dirname($dirname);

        return $this->get_config_by_mid($mid);
    }

    /**
     * @param $mid
     * @return mixed
     */
    public function get_config_by_mid($mid)
    {
        return $this->_configHandler->getConfigsByCat(0, $mid);
    }

    /**
     * @return mixed
     */
    public function get_search_config()
    {
        return $this->_configHandler->getConfigsByCat(XOOPS_CONF_SEARCH);
    }

    //---------------------------------------------------------
    // module handler
    //---------------------------------------------------------

    /**
     * @param $dirname
     * @return int
     */
    public function get_module_mid_by_dirname($dirname)
    {
        $moduleHandler = xoops_getHandler('module');
        $module        = $moduleHandler->getByDirname($dirname);
        if (is_object($module)) {
            return $module->getVar('mid');
        }

        return 0;
    }

    // --- class end ---
}
