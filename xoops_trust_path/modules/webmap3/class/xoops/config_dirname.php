<?php
// $Id: config_dirname.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_config_dirname
//=========================================================
class webmap3_xoops_config_dirname extends webmap3_xoops_config_base
{
    public $_cached = null;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct();

        $config = $this->get_config_by_dirname($dirname);
        if (is_array($config)) {
            $this->_cached = $config;
        }
    }

    //---------------------------------------------------------
    // function
    //---------------------------------------------------------
    public function get_value_by_name($name)
    {
        if (isset($this->_cached[$name])) {
            return $this->_cached[$name];
        }
        return false;
    }

    // --- class end ---
}
