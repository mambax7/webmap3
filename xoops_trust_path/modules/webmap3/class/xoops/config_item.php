<?php
// $Id: config_item.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_config_item
//=========================================================

/**
 * Class webmap3_xoops_config_item
 */
class webmap3_xoops_config_item
{
    public $_configHandler;
    public $_module_mid = 0;
    public $_conf_objs  = [];

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_xoops_config_item constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_configHandler = xoops_getHandler('ConfigItem');
        $this->_module_mid    = $this->get_module_mid_by_dirname($dirname);
    }

    /**
     * @param null $dirname
     * @return \webmap3_xoops_config_item
     */
    public static function getInstance($dirname = null)
    {
        static $instance;
        if (null === $instance) {
            $instance = new self($dirname);
        }

        return $instance;
    }

    //---------------------------------------------------------
    // save module config
    //---------------------------------------------------------
    public function get_objects()
    {
        $this->_conf_objs = [];

        $criteria = new CriteriaCompo(new Criteria('conf_modid', $this->_module_mid));
        $objs     = $this->_configHandler->getObjects($criteria);

        if (is_array($objs)) {
            foreach ($objs as $obj) {
                $this->_conf_objs[$obj->getVar('conf_name')] = $obj;
            }
        }
    }

    /**
     * @param $name
     * @param $val
     */
    public function save($name, $val)
    {
        $obj = $this->get_obj($name);
        if (is_object($obj)) {
            $obj->setVar('conf_value', $val);
            $this->_configHandler->insert($obj);
        }
    }

    /**
     * @param $name
     * @return bool|mixed
     */
    public function get_obj($name)
    {
        $ret = false;
        if (isset($this->_conf_objs[$name])) {
            return $this->_conf_objs[$name];
        }

        return false;
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
