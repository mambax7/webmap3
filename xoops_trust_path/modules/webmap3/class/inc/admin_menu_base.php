<?php
// $Id: admin_menu_base.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_inc_admin_menu_base
//=========================================================

/**
 * Class webmap3_inc_admin_menu_base
 */
class webmap3_inc_admin_menu_base
{
    public $_prefix_mi;

    public $_DIRNAME;
    public $_PREFIX = 'ADMENU';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_inc_admin_menu_base constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_DIRNAME   = $dirname;
        $this->_prefix_mi = '_MI_' . $dirname . '_' . $this->_PREFIX . '_';
    }

    //---------------------------------------------------------
    // main
    //---------------------------------------------------------
    public function define_main_menu()
    {
        // dummy
    }

    public function define_sub_menu()
    {
        // dummy
    }

    /**
     * @return array|null
     */
    public function build_main_menu()
    {
        return $this->build_menu_common($this->define_main_menu());
    }

    /**
     * @return array|null
     */
    public function build_sub_menu()
    {
        return $this->build_menu_common($this->define_sub_menu());
    }

    /**
     * @param $menu
     * @return array|null
     */
    public function build_menu_common($menu)
    {
        if (!is_array($menu) || !count($menu)) {
            return null;
        }

        $arr = [];
        foreach ($menu as $k => $v) {
            $title  = $this->get_lang_mi($v['title']);
            $link   = 'admin/index.php';
            $target = '';
            if (isset($v['fct']) && $v['fct']) {
                $link .= '?fct=' . $v['fct'];
            }
            if (isset($v['target']) && $v['target']) {
                $target = $v['target'];
            }
            $arr[$k] = [
                'title'  => $title,
                'link'   => $link,
                'target' => $target,
            ];
        }

        return $arr;
    }

    //---------------------------------------------------------
    // langauge
    //---------------------------------------------------------

    /**
     * @param $name
     * @return mixed|string
     */
    public function get_lang_mi($name)
    {
        $const_name = mb_strtoupper($this->_prefix_mi . $name);
        if (defined($const_name)) {
            return constant($const_name);
        }

        return $const_name;
    }

    // --- class end ---
}
