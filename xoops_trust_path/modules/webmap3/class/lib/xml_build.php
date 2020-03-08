<?php
// $Id: xml_build.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
// this file include 4 classes
//   webmap3_lib_xml_base
//   webmap3_lib_xml_single_object
//   webmap3_lib_xml_iterate_object
//   webmap3_lib_xml_build
//=========================================================

//=========================================================
// class webmap3_lib_xml_base
//=========================================================

/**
 * Class webmap3_lib_xml_base
 */
class webmap3_lib_xml_base extends webmap3_lib_xml
{
    // replace control code
    public $_FLAG_REPLACE_CONTROL_CODE = true;
    public $_REPLACE_CHAR              = ' ';  // space

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_multibyte_class = new webmap3_lib_multibyte();
    }

    /**
     * @return \webmap3_lib_xml_base
     */
    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new self();
        }

        return $instance;
    }

    //-----------------------------------------------
    // convert to utf
    //-----------------------------------------------

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_utf8($str)
    {
        $str = $this->convert_to_utf8($str, _CHARSET);
        if ($this->_FLAG_REPLACE_CONTROL_CODE) {
            $str = $this->str_replace_control_code($str, $this->_REPLACE_CHAR);
        }

        return $str;
    }

    /**
     * @param        $str
     * @param string $encoding
     * @return null|string|string[]
     */
    public function convert_to_utf8($str, $encoding = _CHARSET)
    {
        return $this->_multibyte_class->convert_to_utf8($str, $encoding);
    }

    /**
     * @param        $str
     * @param string $replace
     * @return null|string|string[]
     */
    public function str_replace_control_code($str, $replace = ' ')
    {
        return $this->_multibyte_class->str_replace_control_code($str, $replace);
    }

    /**
     * @param null $encoding
     * @return bool|string
     */
    public function http_output($encoding = null)
    {
        return $this->_multibyte_class->m_mb_http_output($encoding);
    }

    //--------------------------------------------------------
    // xoops param
    //--------------------------------------------------------

    /**
     * @return mixed
     */
    public function get_xoops_sitename()
    {
        global $xoopsConfig;

        return $xoopsConfig['sitename'];
    }

    /**
     * @param        $dirname
     * @param string $format
     * @return bool
     */
    public function get_xoops_module_name($dirname, $format = 'n')
    {
        $moduleHandler = xoops_getHandler('module');
        $obj           = $moduleHandler->getByDirname($dirname);
        if (is_object($obj)) {
            return $obj->getVar('name', $format);
        }

        return false;
    }

    // --- class end ---
}

//=========================================================
// class webmap3_lib_xml_single_object
//=========================================================

/**
 * Class webmap3_lib_xml_single_object
 */
class webmap3_lib_xml_single_object extends webmap3_lib_xml_base
{
    public $_vars    = [];
    public $_TPL_KEY = 'single';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    //---------------------------------------------------------
    // set & get
    //---------------------------------------------------------
    public function clear_vars()
    {
        $this->_vars = [];
    }

    /**
     * @param $val
     */
    public function set_vars($val)
    {
        if (is_array($val) && count($val)) {
            $this->_vars = $val;
        }
    }

    /**
     * @return array
     */
    public function get_vars()
    {
        return $this->_vars;
    }

    /**
     * @param $key
     * @param $val
     */
    public function set($key, $val)
    {
        $this->_vars[$key] = $val;
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    public function get($key)
    {
        $ret = false;
        if (isset($this->_vars[$key])) {
            $ret = $this->_vars[$key];
        }

        return $ret;
    }

    /**
     * @param $val
     */
    public function set_tpl_key($val)
    {
        $this->_TPL_KEY = $val;
    }

    /**
     * @return string
     */
    public function get_tpl_key()
    {
        return $this->_TPL_KEY;
    }

    //---------------------------------------------------------
    // build
    //---------------------------------------------------------
    public function build()
    {
        $arr  = [];
        $vars = $this->get_vars();
        if (is_array($vars) && count($vars)) {
            $this->set_vars($this->_build($vars));
        }
    }

    /**
     * @param $arr
     * @return array
     */
    public function _build(&$arr)
    {
        return $this->_build_text($arr);
    }

    /**
     * @param $arr
     * @return array
     */
    public function _build_text($arr)
    {
        $ret = [];
        foreach ($arr as $k => $v) {
            if (!is_array($v)) {
                $ret[$k] = $this->xml_text($v);
            }
        }

        return $ret;
    }

    //---------------------------------------------------------
    // utf8
    //---------------------------------------------------------
    public function to_utf8()
    {
        $arr  = [];
        $vars = $this->get_vars();
        if (is_array($vars) && count($vars)) {
            $this->set_vars($this->_to_utf8($vars));
        }
    }

    /**
     * @param $arr
     * @return array
     */
    public function _to_utf8($arr)
    {
        $ret = [];
        foreach ($arr as $k => $v) {
            if (!is_array($v)) {
                $ret[$k] = $this->xml_utf8($v);
            }
        }

        return $ret;
    }

    //---------------------------------------------------------
    // assign
    //---------------------------------------------------------

    /**
     * @param $tpl
     */
    public function assign(&$tpl)
    {
        $this->_assign($tpl, $this->_TPL_KEY, $this->get_vars());
    }

    /**
     * @param $tpl
     */
    public function append(&$tpl)
    {
        $this->_append($tpl, $this->_TPL_KEY, $this->get_vars());
    }

    /**
     * @param $tpl
     * @param $key
     * @param $val
     */
    public function _assign($tpl, $key, $val)
    {
        $tpl->assign($key, $val);
    }

    /**
     * @param $tpl
     * @param $key
     * @param $val
     */
    public function _append($tpl, $key, $val)
    {
        $tpl->append($key, $val);
    }

    // --- class end ---
}

//=========================================================
// class webmap3_lib_xml_iterate_object
//=========================================================

/**
 * Class webmap3_lib_xml_iterate_object
 */
class webmap3_lib_xml_iterate_object extends webmap3_lib_xml_single_object
{
    public $_TPL_KEY = 'iterate';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    //---------------------------------------------------------
    // build
    //---------------------------------------------------------
    public function build_iterate()
    {
        $vars = $this->get_vars();
        if (is_array($vars) && count($vars)) {
            $arr = [];
            foreach ($vars as $var) {
                $arr[] = $this->_build($var);
            }
            $this->set_vars($arr);
        }
    }

    //---------------------------------------------------------
    // utf8
    //---------------------------------------------------------
    public function to_utf8_iterate()
    {
        $vars = $this->get_vars();
        if (is_array($vars) && count($vars)) {
            $arr = [];
            foreach ($vars as $var) {
                $arr[] = $this->_to_utf8($var);
            }
            $this->set_vars($arr);
        }
    }

    //---------------------------------------------------------
    // append
    //---------------------------------------------------------

    /**
     * @param $tpl
     */
    public function append_iterate(&$tpl)
    {
        $tpl_key = $this->get_tpl_key();
        $vars    = $this->get_vars();

        if (is_array($vars) && count($vars)) {
            foreach ($vars as $var) {
                $this->_append($tpl, $tpl_key, $var);
            }
        }
    }

    // --- class end ---
}

//=========================================================
// class webmap3_lib_xml_build
//=========================================================

/**
 * Class webmap3_lib_xml_build
 */
class webmap3_lib_xml_build extends webmap3_lib_xml_base
{
    public $_CONTENT_TYPE_HTML = 'Content-Type:text/html; charset=utf-8';
    public $_CONTENT_TYPE_XML  = 'Content-Type:text/xml;  charset=utf-8';

    // override
    public $_TEMPLATE_XML = null;

    // set param
    public $_view_title      = 'View XML';
    public $_view_goto_title = 'goto index';
    public $_view_goto_url   = null;

    //  object ( dummy )
    //  var $_obj_single  = null;
    //  var $_obj_iterate = null;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \webmap3_lib_xml_base|\webmap3_lib_xml_build
     */
    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new self();
        }

        return $instance;
    }

    //=========================================================
    // public
    //=========================================================
    public function build_xml()
    {
        // header
        webmap3_http_output('pass');
        header($this->_CONTENT_TYPE_XML);

        echo $this->_build_template($this->_get_template());
    }

    public function view_xml()
    {
        // header
        header($this->_CONTENT_TYPE_HTML);

        $template = $this->_get_template();
        if ($template) {
            $xml  = $this->_build_template($template);
            $body = htmlspecialchars($xml, ENT_QUOTES);
        } else {
            $body = $this->build_highlight('No Template');
        }

        echo $this->build_html_header($this->_view_title);

        echo '<pre>';
        echo $body;
        echo '</pre>';
        echo "<br >\n";

        echo $this->build_html_footer();
    }

    /**
     * @param null $title
     * @param bool $flag
     * @return string
     */
    public function build_html_header($title = null, $flag = true)
    {
        if (empty($title)) {
            $title = $this->_view_title;
        }

        $text = '<html><head>' . "\n";
        $text .= '<meta http-equiv="content-type" content="text/html; charset=utf-8" >' . "\n";
        $text .= '<title>' . $title . '</title>' . "\n";
        $text .= '</head>' . "\n";
        $text .= '<body>' . "\n";
        $text .= '<h3>' . $title . '</h3>' . "\n";
        if ($flag) {
            $text .= 'This is debug mode <br ><br >' . "\n";
        }
        $text .= '<hr>' . "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_html_footer()
    {
        $lang_close = $this->xml_utf8(_CLOSE);

        $goto = '';
        if ($this->_view_goto_url && $this->_view_goto_title) {
            $goto = '<a href="' . $this->_view_goto_url . '">';
            $goto .= $this->xml_utf8($this->_view_goto_title) . "</a>\n";
        }

        $text = '<hr>' . "\n";
        $text .= $goto;
        $text .= '<br >' . "\n";
        $text .= '<div style="text-align:center;">' . "\n";
        $text .= '<input value="' . $lang_close . '" type="button" onclick="javascript:window.close();" >' . "\n";
        $text .= '</div>' . "\n";
        $text .= '</body></html>' . "\n";

        return $text;
    }

    /**
     * @param $str
     * @return string
     */
    public function build_highlight($str)
    {
        $text = '<span style="color: #ff0000;">' . $str . '</span><br >' . "\n";

        return $text;
    }

    // --------------------------------------------------------
    // set param
    // --------------------------------------------------------

    /**
     * @param $val
     */
    public function set_template($val)
    {
        $this->set_template_xml($val);
    }

    /**
     * @param $val
     */
    public function set_template_xml($val)
    {
        $this->_TEMPLATE_XML = $val;
    }

    /**
     * @param $val
     */
    public function set_view_title($val)
    {
        $this->_view_title = $val;
    }

    /**
     * @param $val
     */
    public function set_view_goto_title($val)
    {
        $this->_view_goto_title = $val;
    }

    /**
     * @param $val
     */
    public function set_view_goto_url($val)
    {
        $this->_view_goto_url = $val;
    }

    //=========================================================
    // private
    //=========================================================

    public function _get_template()
    {
        return $this->_get_template_xml();
    }

    public function _get_template_xml()
    {
        return $this->_TEMPLATE_XML;
    }

    //=========================================================
    // override for caller
    //=========================================================
    public function _init_obj()
    {
        //  dummy
    }

    /**
     * @param $val
     */
    public function _set_single($val)
    {
        //  dummy
    }

    /**
     * @param $val
     */
    public function _set_iterate($val)
    {
        //  dummy
    }

    /**
     * @param $template
     */
    public function _build_template($template)
    {
        //  dummy
    }

    // --- class end ---
}
