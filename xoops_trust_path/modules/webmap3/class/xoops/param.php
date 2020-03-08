<?php
// $Id: param.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_param
//=========================================================

/**
 * Class webmap3_xoops_param
 */
class webmap3_xoops_param
{
    public $_module_mid;
    public $_language;

    public $_JPAPANESE_ARRAY = ['japanese', 'japaneseutf', 'ja_utf8'];

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_module_mid = $this->get_module_mid();
        $this->_language   = $this->get_config_by_name('language');
    }

    /**
     * @return \webmap3_xoops_param
     */
    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // config
    //---------------------------------------------------------

    /**
     * @param $name
     * @return bool
     */
    public function get_config_by_name($name)
    {
        global $xoopsConfig;
        if (isset($xoopsConfig[$name])) {
            return $xoopsConfig[$name];
        }

        return false;
    }

    /**
     * @return bool
     */
    public function is_japanese()
    {
        if (in_array($this->_language, $this->_JPAPANESE_ARRAY)) {
            return true;
        }

        return false;
    }

    //---------------------------------------------------------
    // module config
    //---------------------------------------------------------

    /**
     * @param        $name
     * @param string $format
     * @return mixed|null|string
     */
    public function get_module_config_text_by_name($name, $format = 'n')
    {
        $val = $this->get_module_config_by_name($name);
        if (empty($val)) {
            return null;
        }

        switch ($format) {
            case 's':
                $ret = $this->sanitize($val);
                break;
            case 'textarea':
                $ret = str_replace('"', "'", $val);
                break;
            case 'n':
            default:
                $ret = $val;
                break;
        }

        return $ret;
    }

    /**
     * @param $name
     */
    public function get_module_config_by_name($name)
    {
        global $xoopsModuleConfig;
        if (isset($xoopsModuleConfig[$name])) {
            return $xoopsModuleConfig[$name];
        }

        return null;
    }

    //---------------------------------------------------------
    // my module
    //---------------------------------------------------------

    /**
     * @param string $format
     * @return bool|mixed
     */
    public function get_module_mid($format = 's')
    {
        return $this->get_module_value_by_name('mid', $format);
    }

    /**
     * @param string $format
     * @return bool|mixed
     */
    public function get_module_name($format = 's')
    {
        return $this->get_module_value_by_name('name', $format);
    }

    /**
     * @param        $name
     * @param string $format
     * @return bool|mixed
     */
    public function get_module_value_by_name($name, $format = 's')
    {
        global $xoopsModule;
        if (is_object($xoopsModule)) {
            return $xoopsModule->getVar($name, $format);
        }

        return false;
    }

    //---------------------------------------------------------
    // my user
    //---------------------------------------------------------

    /**
     * @param string $format
     * @return bool|mixed
     */
    public function get_user_uid($format = 's')
    {
        return $this->get_user_value_by_name('uid', $format);
    }

    /**
     * @param string $format
     * @return bool|mixed
     */
    public function get_user_uname($format = 's')
    {
        return $this->get_user_value_by_name('uname', $format);
    }

    /**
     * @param        $name
     * @param string $format
     * @return bool|mixed
     */
    public function get_user_value_by_name($name, $format = 's')
    {
        global $xoopsUser;
        if (is_object($xoopsUser)) {
            return $xoopsUser->getVar($name, $format);
        }

        return false;
    }

    /**
     * @return array
     */
    public function get_user_groups()
    {
        global $xoopsUser;
        if (is_object($xoopsUser)) {
            return $xoopsUser->getGroups();
        }

        return [XOOPS_GROUP_ANONYMOUS];
    }

    /**
     * @return bool
     */
    public function get_user_is_login()
    {
        global $xoopsUser;
        if (is_object($xoopsUser)) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function get_user_is_module_admin()
    {
        global $xoopsUser;
        if (is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($this->_module_mid)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function is_login_user()
    {
        return $this->get_user_is_login();
    }

    /**
     * @return bool
     */
    public function is_module_admin()
    {
        return $this->get_user_is_module_admin();
    }

    //---------------------------------------------------------
    // timestamp
    //---------------------------------------------------------

    /**
     * @param     $time
     * @param int $default
     * @return float|int
     */
    public function user_to_server_time($time, $default = 0)
    {
        if ($time <= 0) {
            return $default;
        }

        global $xoopsConfig, $xoopsUser;
        if ($xoopsUser) {
            $timeoffset = $xoopsUser->getVar('timezone_offset');
        } else {
            $timeoffset = $xoopsConfig['default_TZ'];
        }
        $timestamp = $time - (($timeoffset - $xoopsConfig['server_TZ']) * 3600);

        return $timestamp;
    }

    //---------------------------------------------------------
    // utility
    //---------------------------------------------------------

    /**
     * @param $str
     * @return string
     */
    public function sanitize($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    // --- class end ---
}
