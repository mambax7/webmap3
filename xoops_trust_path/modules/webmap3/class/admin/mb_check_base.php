<?php
// $Id: mb_check_base.php,v 1.2 2012/03/17 12:05:48 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_admin_mb_check_base
//=========================================================

/**
 * Class webmap3_admin_mb_check_base
 */
class webmap3_admin_mb_check_base
{
    public $_multibyte_class;

    public $_lang_title   = 'Multibyte Check';
    public $_lang_success = 'Success';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_multibyte_class = webmap3_lib_multibyte::getInstance();
    }

    /**
     * @return \webmap3_lib_multibyte
     */
    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_lib_multibyte();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // main
    //---------------------------------------------------------
    public function main()
    {
        restore_error_handler();
        error_reporting(E_ALL);

        $charset = isset($_POST['charset']) ? $_POST['charset'] : _CHARSET;

        $this->http_output('pass');
        header('Content-Type:text/html; charset=' . $charset);

        $str = $this->build_head($this->_lang_title, $charset);
        $str .= $this->build_body_begin();
        $str .= 'charset : ' . $charset . "<br >\n";
        $str .= $this->_lang_success;
        $str .= "<br ><br >\n";
        $str .= '<input class="formButton" value="' . _CLOSE . '" type="button" onclick="javascript:window.close();" >';
        $str .= $this->build_body_end();

        echo $this->conv($str, $charset);
    }

    /**
     * @param $val
     */
    public function set_lang_title($val)
    {
        $this->_lang_title = $val;
    }

    /**
     * @param $val
     */
    public function set_lang_success($val)
    {
        $this->_lang_success = $val;
    }

    //---------------------------------------------------------
    // head
    //---------------------------------------------------------

    /**
     * @param null $title
     * @param null $charset
     * @return string
     */
    public function build_head($title = null, $charset = null)
    {
        if (empty($charset)) {
            $charset = _CHARSET;
        }

        $str = '<html><head>' . "\n";
        $str .= '<meta http-equiv="Content-Type" content="text/html; charset=' . $this->sanitize($charset) . '" >' . "\n";
        $str .= '<title>' . $this->sanitize($title) . '</title>' . "\n";
        $str .= '</head>' . "\n";

        return $str;
    }

    /**
     * @return string
     */
    public function build_body_begin()
    {
        $str = '<body>' . "\n";

        return $str;
    }

    /**
     * @return string
     */
    public function build_body_end()
    {
        $str = '</body></html>' . "\n";

        return $str;
    }

    /**
     * @param $str
     * @return string
     */
    public function sanitize($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    //---------------------------------------------------------
    // multibyte
    //---------------------------------------------------------

    /**
     * @param $encoding
     * @return bool|string
     */
    public function http_output($encoding)
    {
        return $this->_multibyte_class->m_mb_http_output($encoding);
    }

    /**
     * @param $str
     * @param $charset
     * @return null|string|string[]
     */
    public function conv($str, $charset)
    {
        return $this->_multibyte_class->convert_encoding($str, $charset, _CHARSET);
    }

    // --- class end ---
}
