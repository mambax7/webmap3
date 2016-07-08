<?php
// $Id: language_base.php,v 1.2 2012/04/11 05:35:56 ohwada Exp $

// 2012-04-02 K.OHWADA
// typo

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_d3_language_base
//=========================================================
class webmap3_d3_language_base
{
    public $_DIRNAME;
    public $_TRUST_DIRNAME;
    public $_MODULE_DIR;
    public $_TRUST_DIR;

    public $_DEBUG_ERROR = false;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname, $trust_dirname)
    {
        $this->_DIRNAME       = $dirname;
        $this->_TRUST_DIRNAME = $trust_dirname;

        $this->_MODULE_DIR = XOOPS_ROOT_PATH . '/modules/' . $dirname;
        $this->_TRUST_DIR  = XOOPS_TRUST_PATH . '/modules/' . $trust_dirname;

        $this->set_debug_error_by_const_name($dirname . '_C_DEBUG_ERROR');
    }

    public static function getInstance($dirname, $trust_dirname)
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_d3_language_base($dirname, $trust_dirname);
        }
        return $instance;
    }

    //---------------------------------------------------------
    // public
    //---------------------------------------------------------
    public function get_lang_array()
    {
        $arr1 = array();
        $arr2 = array();

        $needle1      = strtoupper('_' . $this->_TRUST_DIRNAME . '_');
        $needle2      = strtolower($this->_DIRNAME . '_');
        $constant_arr = get_defined_constants();

        foreach ($constant_arr as $k => $v) {
            if (strpos($k, $needle1) !== 0) {
                continue;
            }

            $key        = strtolower(str_replace($needle1, '', $k));
            $arr1[$key] = $v;
        }

        foreach ($arr1 as $k => $v) {
            if (strpos($k, $needle2) !== 0) {
                continue;
            }

            // overwrite
            $key        = str_replace($needle2, '', $k);
            $arr1[$key] = $v;
        }

        foreach ($arr1 as $k => $v) {
            $arr2['lang_' . $k] = $v;
        }

        return $arr2;
    }

    public function get_constant($name)
    {
        $cont_name_1 = $this->build_constant_name_1($name);
        $cont_name_2 = $this->build_constant_name_2($name);
        $cont_name_3 = $this->build_constant_name_3($name);

        // typo
        $cont_name_4 = $this->build_constant_name_4($name);

        if (defined($cont_name_1)) {
            return constant($cont_name_1);
        } elseif (defined($cont_name_2)) {
            return constant($cont_name_2);
        } elseif (defined($cont_name_3)) {
            return constant($cont_name_3);
        }

        if ($this->_DEBUG_ERROR) {
            echo $this->highlight('CANNOT get constant ' . $name) . "<br />\n";
        }
        return $cont_name_4;
    }

    public function set_debug_error($val)
    {
        $this->_DEBUG_ERROR = (bool)$val;
    }

    public function set_debug_error_by_const_name($name)
    {
        $name = strtoupper($name);
        if (defined($name)) {
            $this->set_debug_error(constant($name));
        }
    }

    //---------------------------------------------------------
    // private
    //---------------------------------------------------------
    public function build_constant_name_1($name)
    {
        $str = '_' . $this->_TRUST_DIRNAME . '_' . $this->_DIRNAME . '_' . $name;
        return strtoupper($str);
    }

    public function build_constant_name_2($name)
    {
        $str = '_' . $this->_DIRNAME . '_' . $name;
        return strtoupper($str);
    }

    public function build_constant_name_3($name)
    {
        $str = '_' . $this->_TRUST_DIRNAME . '_' . $name;
        return strtoupper($str);
    }

    public function build_constant_name_4($name)
    {
        $str = '_' . $name;
        return strtoupper($str);
    }

    public function highlight($str)
    {
        $val = '<span style="color:#ff0000;">' . $str . '</span>';
        return $val;
    }

    //----- class end -----
}
