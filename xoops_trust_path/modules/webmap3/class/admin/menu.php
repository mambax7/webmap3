<?php
// $Id: menu.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_admin_menu
//=========================================================
class webmap3_admin_menu
{
    public $_lib_class;
    public $_inc_class;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname, $trust_dirname)
    {
        $this->_lib_class = webmap3_lib_admin_menu::getInstance($dirname, $trust_dirname);
        $this->_inc_class = webmap3_inc_admin_menu::getSingleton($dirname);
    }

    public static function getInstance($dirname, $trust_dirname)
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_admin_menu($dirname, $trust_dirname);
        }
        return $instance;
    }

    //---------------------------------------------------------
    // menu
    //---------------------------------------------------------
    public function build_menu()
    {
        $this->_lib_class->set_main_menu($this->_inc_class->build_main_menu());
        $menu = $this->_lib_class->build_menu_with_sub();
        return $menu;
    }

    // --- class end ---
}
