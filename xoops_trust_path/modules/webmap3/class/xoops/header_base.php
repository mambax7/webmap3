<?php
// $Id: header_base.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_header_base
//=========================================================

/**
 * Class webmap3_xoops_header_base
 */
class webmap3_xoops_header_base
{
    public $_prefix;

    public $_DIRNAME;
    public $_MODULE_URL;
    public $_TRUST_DIRNAME;
    public $_TRUST_DIR;
    public $_LIBS_URL;

    public $_XOOPS_MODULE_HADER = 'xoops_module_header';
    public $_FLAG_ASSIGN_HEADER = true;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_xoops_header_base constructor.
     * @param $dirname
     * @param $trust_dirname
     */
    public function __construct($dirname, $trust_dirname)
    {
        $this->_DIRNAME       = $dirname;
        $this->_MODULE_URL    = XOOPS_URL . '/modules/' . $dirname;
        $this->_TRUST_DIRNAME = $trust_dirname;
        $this->_TRUST_DIR     = XOOPS_TRUST_PATH . '/modules/' . $trust_dirname;
        $this->_LIBS_URL      = $this->_MODULE_URL . '/libs';

        // preload
        $const_name = '_C_' . $trust_dirname . '_XOOPS_MODULE_HEADER';
        if (defined($const_name)) {
            $this->_XOOPS_MODULE_HADER = constant($const_name);
        }

        $const_name = '_C_' . $trust_dirname . '_PRELOAD_FLAG_ASSIGN_HEADER';
        if (defined($const_name)) {
            $this->_FLAG_ASSIGN_HEADER = (bool)constant($const_name);
        }

        $this->_prefix = '_C_' . $trust_dirname . '_HEADER_LOADED_';
    }

    //--------------------------------------------------------
    // utility
    //--------------------------------------------------------

    /**
     * @param $name
     * @return bool
     */
    public function check_once_name($name)
    {
        return $this->check_once($this->build_const_name($name));
    }

    /**
     * @param $name
     * @return string
     */
    public function build_const_name($name)
    {
        $str = mb_strtoupper($this->_prefix . $name);

        return $str;
    }

    /**
     * @param $const_name
     * @return bool
     */
    public function check_once($const_name)
    {
        if (!defined($const_name)) {
            define($const_name, 1);

            return true;
        }

        return false;
    }

    /**
     * @param $css
     * @return string
     */
    public function build_link_css_libs($css)
    {
        return $this->build_link_css($this->_LIBS_URL . '/' . $css);
    }

    /**
     * @param $herf
     * @return string
     */
    public function build_link_css($herf)
    {
        $str = '<link id="lnkStyleSheet" rel="stylesheet" type="text/css" href="' . $herf . '" >' . "\n";

        return $str;
    }

    /**
     * @param $js
     * @return string
     */
    public function build_script_js_libs($js)
    {
        return $this->build_script_js($this->_LIBS_URL . '/' . $js);
    }

    /**
     * @param $src
     * @return string
     */
    public function build_script_js($src)
    {
        $str = '<script src="' . $src . '" type="text/javascript"></script>' . "\n";

        return $str;
    }

    /**
     * @param $text
     * @return string
     */
    public function build_envelop_js($text)
    {
        $str = '<script type="text/javascript">' . "\n";
        $str .= '//<![CDATA[' . "\n";
        $str .= $text . "\n";
        $str .= '//]]>' . "\n";
        $str .= '</script>' . "\n";

        return $str;
    }

    /**
     * @param $url
     * @return string
     */
    public function build_link_rss($url)
    {
        $str = '<link rel="alternate" type="application/rss+xml" title="RSS" href="' . $url . '" >' . "\n";

        return $str;
    }

    /**
     * @param $name
     * @return bool
     */
    public function check_name_js($name)
    {
        return $this->check_once_name($name . '_js');
    }

    /**
     * @param $name
     * @return string
     */
    public function build_name_js($name)
    {
        return $this->build_script_js_libs($name . '.js');
    }

    //--------------------------------------------------------
    // template
    //--------------------------------------------------------

    /**
     * @param $var
     */
    public function assign_xoops_module_header($var)
    {
        global $xoopsTpl;
        if ($var) {
            $xoopsTpl->assign($this->_XOOPS_MODULE_HADER, $this->get_xoops_module_header() . "\n" . $var);
        }
    }

    /**
     * @return array
     */
    public function get_xoops_module_header()
    {
        global $xoopsTpl;

        return $xoopsTpl->get_template_vars($this->_XOOPS_MODULE_HADER);
    }

    // --- class end ---
}
