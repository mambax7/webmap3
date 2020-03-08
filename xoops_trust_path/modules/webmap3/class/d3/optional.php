<?php
// $Id: optional.php,v 1.1.1.1 2012/03/17 09:28:16 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_d3_optional
// NOT replace this file
//=========================================================

/**
 * Class webmap3_d3_optional
 */
class webmap3_d3_optional
{
    public $_DIRNAME;
    public $_TRUST_DIRNAME;
    public $_MODULE_DIR;
    public $_TRUST_DIR;

    public $_xoops_language = null;

    public $_DEBUG_INCLUDE = false;
    public $_DEBUG_ERROR   = false;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_xoops_language = $this->get_xoops_config('language');
    }

    /**
     * @return \webmap3_d3_optional
     */
    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new self();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // init
    //---------------------------------------------------------

    /**
     * @param $dirname
     * @param $trust_dirname
     */
    public function init($dirname, $trust_dirname)
    {
        $this->init_trust($trust_dirname);

        $this->_DIRNAME    = $dirname;
        $this->_MODULE_DIR = XOOPS_ROOT_PATH . '/modules/' . $dirname;

        $constpref = mb_strtoupper('_P_' . $dirname . '_');
        $this->set_debug_include_by_const_name($constpref . 'DEBUG_INCLUDE');
        $this->set_debug_error_by_const_name($constpref . 'DEBUG_ERROR');
    }

    /**
     * @param $trust_dirname
     */
    public function init_trust($trust_dirname)
    {
        $this->_TRUST_DIRNAME = $trust_dirname;
        $this->_TRUST_DIR     = XOOPS_TRUST_PATH . '/modules/' . $trust_dirname;
    }

    //---------------------------------------------------------
    // public
    //---------------------------------------------------------

    /**
     * @param null $page_array
     * @return null|string|string[]
     */
    public function get_fct($page_array = null)
    {
        $fct = preg_replace('/[^a-zA-Z0-9_-]/', '', $this->_try_to_get_fct($page_array));

        return $fct;
    }

    /**
     * @param null $page_array
     * @return mixed|null
     */
    public function _try_to_get_fct($page_array = null)
    {
        // POST
        $fct = isset($_POST['fct']) ? $_POST['fct'] : null;
        if ($fct) {
            return $fct;
        }

        // GET
        $fct = isset($_GET['fct']) ? $_GET['fct'] : null;
        if ($fct) {
            return $fct;
        }

        // PATH_INFO
        $fct       = null;
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null;
        if ($path_info) {
            $path_arr = explode('/', $path_info);
            if (is_array($path_arr) && count($path_arr)) {
                foreach ($path_arr as $path) {
                    // first valid string
                    if ($path) {
                        $fct = $path;
                        break;
                    }
                }
            }
        }
        if ($fct) {
            return $fct;
        }

        // for xoops comment & notification
        $fct = null;
        if (is_array($page_array) && count($page_array)) {
            foreach ($page_array as $item => $page) {
                $val = isset($_GET[$item]) ? (int)$_GET[$item] : 0;
                if ($val > 0) {
                    $fct = $page;
                    break;
                }
            }
        }

        return $fct;
    }

    /**
     * @param $file
     * @return bool
     */
    public function include_once_trust_file($file)
    {
        $file_trust = $this->_TRUST_DIR . '/' . $file;

        if (file_exists($file_trust)) {
            $this->debug_msg_include_file($file_trust);
            include_once $file_trust;

            return true;
        }

        $this->debug_msg_error('CANNOT include ' . $file_trust);

        return false;
    }

    /**
     * @param $file
     * @return bool
     */
    public function include_once_file($file)
    {
        $file_trust = $this->_TRUST_DIR . '/' . $file;
        $file_root  = $this->_MODULE_DIR . '/' . $file;

        if (file_exists($file_root)) {
            $this->debug_msg_include_file($file_root);
            include_once $file_root;

            return true;
        } elseif (file_exists($file_trust)) {
            $this->debug_msg_include_file($file_trust);
            include_once $file_trust;

            return true;
        }

        $this->debug_msg_error('CANNOT include ' . $file . ' in ' . $this->_DIRNAME);

        return false;
    }

    /**
     * @param $file
     * @param $debug
     * @return bool
     */
    public function include_once_language($file, $debug)
    {
        $file_trust_lang = $this->_TRUST_DIR . '/language/' . $this->_xoops_language . '/' . $file;
        $file_trust_eng  = $this->_TRUST_DIR . '/language/english/' . $file;
        $file_root_lang  = $this->_MODULE_DIR . '/language/' . $this->_xoops_language . '/' . $file;
        $file_root_eng   = $this->_MODULE_DIR . '/language/english/' . $file;

        if (file_exists($file_root_lang)) {
            $this->debug_msg_include_file($file_root_lang, $debug);
            include_once $file_root_lang;

            return true;
        } elseif (file_exists($file_trust_lang)) {
            $this->debug_msg_include_file($file_trust_lang, $debug);
            include_once $file_trust_lang;

            return true;
        } elseif (file_exists($file_root_eng)) {
            $this->debug_msg_include_file($file_root_eng, $debug);
            include_once $file_root_eng;

            return true;
        } elseif (file_exists($file_trust_eng)) {
            $this->debug_msg_include_file($file_trust_eng, $debug);
            include_once $file_trust_eng;

            return true;
        }

        $this->debug_msg_error('CANNOT include ' . $file . ' in ' . $this->_DIRNAME);

        return false;
    }

    /**
     * @param $file
     * @return bool
     */
    public function include_language($file)
    {
        $GLOBALS['MY_DIRNAME'] = $this->_DIRNAME;

        $file_trust_lang = $this->_TRUST_DIR . '/language/' . $this->_xoops_language . '/' . $file;
        $file_trust_eng  = $this->_TRUST_DIR . '/language/english/' . $file;
        $file_root_lang  = $this->_MODULE_DIR . '/language/' . $this->_xoops_language . '/' . $file;
        $file_root_eng   = $this->_MODULE_DIR . '/language/english/' . $file;

        if (file_exists($file_root_lang)) {
            $this->debug_msg_include_file($file_root_lang);
            include $file_root_lang;

            return true;
        } elseif (file_exists($file_trust_lang)) {
            $this->debug_msg_include_file($file_trust_lang);
            include $file_trust_lang;

            return true;
        } elseif (file_exists($file_root_eng)) {
            $this->debug_msg_include_file($file_root_eng);
            include $file_root_eng;

            return true;
        } elseif (file_exists($file_trust_eng)) {
            $this->debug_msg_include_file($file_trust_eng);
            include $file_trust_eng;

            return true;
        }

        $this->debug_msg_error('CANNOT include ' . $file . ' in ' . $this->_DIRNAME);

        return false;
    }

    /**
     * @param      $file
     * @param bool $debug
     */
    public function debug_msg_include_file($file, $debug = true)
    {
        $file_win = str_replace('/', '\\', $file);

        if ($this->_DEBUG_INCLUDE && $debug
            && !in_array($file, get_included_files())
            && !in_array($file_win, get_included_files())) {
            echo 'include ' . $file . "<br >\n";
        }
    }

    /**
     * @param $str
     */
    public function debug_msg_error($str)
    {
        if ($this->_DEBUG_ERROR) {
            echo $this->highlight($str) . "<br >\n";
        }
    }

    /**
     * @param $val
     */
    public function set_debug_error($val)
    {
        $this->_DEBUG_ERROR = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_debug_include($val)
    {
        $this->_DEBUG_INCLUDE = (bool)$val;
    }

    /**
     * @param $name
     */
    public function set_debug_error_by_const_name($name)
    {
        $name = mb_strtoupper($name);
        if (defined($name)) {
            $this->set_debug_error(constant($name));
        }
    }

    /**
     * @param $name
     */
    public function set_debug_include_by_const_name($name)
    {
        $name = mb_strtoupper($name);
        if (defined($name)) {
            $this->set_debug_include(constant($name));
        }
    }

    //---------------------------------------------------------
    // private
    //---------------------------------------------------------

    /**
     * @param $str
     * @return string
     */
    public function highlight($str)
    {
        $val = '<span style="color:#ff0000;">' . $str . '</span>';

        return $val;
    }

    //---------------------------------------------------------
    // xoops param
    //---------------------------------------------------------

    /**
     * @param $name
     * @return bool
     */
    public function get_xoops_config($name)
    {
        global $xoopsConfig;
        if (isset($xoopsConfig[$name])) {
            return $xoopsConfig[$name];
        }

        return false;
    }

    //----- class end -----
}
