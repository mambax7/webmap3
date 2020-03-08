<?php
// $Id: base.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_admin_base
//=========================================================

/**
 * Class webmap3_admin_base
 */
class webmap3_admin_base extends webmap3_lib_admin_base
{
    public $_dir_class;
    public $_xoops_param;
    public $_language_class;
    public $_menu_class;

    public $_SUB_DIR_GICONS   = 'gicons';
    public $_SUB_DIR_GSHADOWS = 'gshadows';
    public $_SUB_DIR_TMP      = 'tmp';

    public $_UPLOADS_PATH;
    public $_UPLOADS_DIR;
    public $_GICONS_DIR;
    public $_GSHADOWS_DIR;
    public $_TMP_DIR;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_admin_base constructor.
     * @param $dirname
     * @param $trust_dirname
     */
    public function __construct($dirname, $trust_dirname)
    {
        parent::__construct($dirname, $trust_dirname);

        $this->_dir_class      = webmap3_lib_dir::getInstance();
        $this->_xoops_param    = webmap3_xoops_param::getInstance();
        $this->_language_class = webmap3_d3_language::getSingleton($dirname);
        $this->_menu_class     = webmap3_admin_menu::getInstance($dirname, $trust_dirname);

        $this->_UPLOADS_PATH = $this->_xoops_param->get_module_config_by_name('gicon_path');
        $this->_UPLOADS_DIR  = XOOPS_ROOT_PATH . '/' . $this->_UPLOADS_PATH;
        $this->_GICONS_DIR   = $this->_UPLOADS_DIR . '/' . $this->_SUB_DIR_GICONS;
        $this->_GSHADOWS_DIR = $this->_UPLOADS_DIR . '/' . $this->_SUB_DIR_GSHADOWS;
        $this->_TMP_DIR      = $this->_UPLOADS_DIR . '/' . $this->_SUB_DIR_TMP;
    }

    /**
     * @param $dirname
     * @param $trust_dirname
     * @return \webmap3_admin_base|\webmap3_lib_admin_base
     */
    public static function getInstance($dirname, $trust_dirname)
    {
        static $instance;
        if (null === $instance) {
            $instance = new self($dirname, $trust_dirname);
        }

        return $instance;
    }

    //---------------------------------------------------------
    // admin_menu
    //---------------------------------------------------------

    /**
     * @return null|string
     */
    public function build_admin_menu()
    {
        return $this->_menu_class->build_menu();
    }

    //---------------------------------------------------------
    // dir
    //---------------------------------------------------------

    /**
     * @param $dir
     * @return string
     */
    public function make_dir($dir)
    {
        return $this->_dir_class->make_dir($dir);
    }

    /**
     * @param $dir
     * @return int
     */
    public function check_dir($dir)
    {
        if ($this->_dir_class->check_dir($dir)) {
            return 0;
        }
        $this->set_error('dir error : ' . $dir);

        return _C_WEBMAP3_ERR_CHECK_DIR;
    }

    //---------------------------------------------------------
    // config
    //---------------------------------------------------------

    /**
     * @param $name
     */
    public function get_config($name)
    {
        return $this->_xoops_param->get_module_config_by_name($name);
    }

    /**
     * @param $name
     * @return mixed|null|string
     */
    public function get_config_text($name)
    {
        return $this->_xoops_param->get_module_config_text_by_name($name);
    }

    //---------------------------------------------------------
    // language
    //---------------------------------------------------------

    /**
     * @param $name
     * @return mixed
     */
    public function get_lang($name)
    {
        return $this->_language_class->get_constant($name);
    }

    // --- class end ---
}
