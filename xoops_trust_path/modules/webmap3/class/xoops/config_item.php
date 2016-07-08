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
class webmap3_xoops_config_item
{
    public $_config_handler;
    public $_module_mid = 0;
    public $_conf_objs  = array();

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        $this->_config_handler = xoops_getHandler('ConfigItem');
        $this->_module_mid     = $this->get_module_mid_by_dirname($dirname);
    }

    public static function getInstance($dirname = null)
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_xoops_config_item($dirname);
        }
        return $instance;
    }

    //---------------------------------------------------------
    // save module config
    //---------------------------------------------------------
    public function get_objects()
    {
        $this->_conf_objs = array();

        $criteria = new CriteriaCompo(new Criteria('conf_modid', $this->_module_mid));
        $objs     = $this->_config_handler->getObjects($criteria);

        if (is_array($objs)) {
            foreach ($objs as $obj) {
                $this->_conf_objs[$obj->getVar('conf_name')] = $obj;
            }
        }
    }

    public function save($name, $val)
    {
        $obj = $this->get_obj($name);
        if (is_object($obj)) {
            $obj->setVar('conf_value', $val);
            $this->_config_handler->insert($obj);
        }
    }

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
