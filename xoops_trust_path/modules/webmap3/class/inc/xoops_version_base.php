<?php
// $Id: xoops_version_base.php,v 1.2 2012/04/10 00:15:02 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_inc_xoops_version_base
//=========================================================

/**
 * Class webmap3_inc_xoops_version_base
 */
class webmap3_inc_xoops_version_base
{
    public $_module_mid      = 0;
    public $_is_module_admin = false;

    public $_DIRNAME;
    public $_MODULE_URL;
    public $_MODULE_DIR;

    public $_HAS_ONINSATLL    = true;
    public $_HAS_MAIN         = false;
    public $_HAS_ADMIN        = false;
    public $_HAS_SEARCH       = false;
    public $_HAS_COMMENTS     = false;
    public $_HAS_SUB          = false;
    public $_HAS_BLOCKS       = false;
    public $_HAS_CONFIG       = false;
    public $_HAS_NOTIFICATION = false;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_inc_xoops_version_base constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_DIRNAME    = $dirname;
        $this->_MODULE_URL = XOOPS_URL . '/modules/' . $dirname;
        $this->_MODULE_DIR = XOOPS_ROOT_PATH . '/modules/' . $dirname;

        $this->_module_mid      = $this->get_module_mid_by_dirname($dirname);
        $this->_is_module_admin = $this->get_user_is_module_admin($this->_module_mid);
    }

    //---------------------------------------------------------
    // main
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function build_modversion()
    {
        $this->modify_config_title_length();

        $arr = $this->build_basic();

        if ($this->_HAS_MAIN) {
            $arr['hasMain'] = 1;
        } else {
            $arr['hasMain'] = 0;
        }

        if ($this->_HAS_ADMIN) {
            $arr['hasAdmin']   = 1;
            $arr['system_menu']   = 1;
            $arr['adminindex'] = 'admin/index.php';
            $arr['adminmenu']  = 'admin/menu.php';
        } else {
            $arr['hasAdmin'] = 0;
        }

        if ($this->_HAS_SEARCH) {
            $arr['hasSearch'] = 1;
            $arr['search']    = $this->build_search();
        } else {
            $arr['hasSearch'] = 0;
        }

        if ($this->_HAS_COMMENTS) {
            $arr['hasComments'] = 1;
            $arr['comments']    = $this->build_comments();
        } else {
            $arr['hasComments'] = 0;
        }

        if ($this->_HAS_NOTIFICATION) {
            $arr['hasNotification'] = 1;
            $arr['notification']    = $this->build_notification();
        } else {
            $arr['hasNotification'] = 0;
        }

        if ($this->_HAS_SUB) {
            $arr['sub'] = $this->build_sub();
        }

        if ($this->_HAS_BLOCKS) {
            $arr['blocks'] = $this->build_blocks();
        }

        if ($this->_HAS_CONFIG) {
            $arr['config'] = $this->build_config();
        }

        if ($this->_HAS_ONINSATLL) {
            $arr['onInstall']   = 'include/oninstall.inc.php';
            $arr['onUpdate']    = 'include/oninstall.inc.php';
            $arr['onUninstall'] = 'include/oninstall.inc.php';
        }

        return $arr;
    }

    public function modify_config_title_length()
    {
        if (!$this->_is_module_admin) {
            return;
        }
        if (!$this->check_post_fct_modulesadmin()) {
            return;
        }
        if (!$this->check_post_dirname()) {
            return;
        }

        $config = webmap3_xoops_config_update::getInstance();
        $config->update();
    }

    /**
     * @return bool
     */
    public function check_post_fct_modulesadmin()
    {
        if (isset($_POST['fct']) && ('modulesadmin' == $_POST['fct'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function check_post_dirname()
    {
        if (isset($_POST['dirname']) && ($_POST['dirname'] == $this->_DIRNAME)) {
            return true;
        }

        return false;
    }

    //---------------------------------------------------------
    // Basic Defintion
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function build_basic()
    {
        $module_icon = 'module_icon.php';
        if (file_exists($this->_MODULE_DIR . '/images/module_icon.png')) {
            $module_icon = 'images/module_icon.png';
        }

        $arr = [];

        $arr['name']        = $this->lang('NAME') . ' (' . $this->_DIRNAME . ')';
        $arr['description'] = $this->lang('DESC');
        $arr['author']      = 'Kenichi Ohwada';
        $arr['credits']     = 'Kenichi Ohwada';
        $arr['help']        = '';
        $arr['license']     = 'GPL see LICENSE';
        $arr['official']    = 0;
        $arr['image']       = $module_icon;
        $arr['dirname']     = $this->_DIRNAME;
        $arr['version']     = $this->get_version();

        // Any tables can't be touched by modulesadmin.
        $arr['sqlfile'] = false;
        $arr['tables']  = [];

        return $arr;
    }

    public function get_version()
    {
        return null;
    }

    //---------------------------------------------------------
    // Search
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function build_search()
    {
        $arr         = [];
        $arr['file'] = 'include/search.inc.php';
        $arr['func'] = $this->_DIRNAME . '_search';

        return $arr;
    }

    //---------------------------------------------------------
    // Comments
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function build_comments()
    {
        $arr = [];

        // Comments
        $arr['pageName'] = 'index.php';
        $arr['itemName'] = 'item_id';

        // Comment callback functions
        $arr['callbackFile']        = 'include/comment.inc.php';
        $arr['callback']['approve'] = $this->_DIRNAME . '_comments_approve';
        $arr['callback']['update']  = $this->_DIRNAME . '_comments_update';

        return $arr;
    }

    //---------------------------------------------------------
    // Notification
    //---------------------------------------------------------
    public function build_notification()
    {
        // dummy
    }

    //---------------------------------------------------------
    // Sub Menu
    //---------------------------------------------------------
    public function build_sub()
    {
        // dummy
    }

    //---------------------------------------------------------
    // Blocks
    //---------------------------------------------------------
    public function build_blocks()
    {
        // dummy
    }

    /**
     * @return bool
     */
    public function check_keep_blocks()
    {
        if (!$this->_is_module_admin) {
            return false;
        }
        if (!$this->check_post_fct_modulesadmin()) {
            return false;
        }
        if (!$this->check_post_dirname()) {
            return false;
        }
        if (defined('XOOPS_CUBE_LEGACY')) {
            return false;
        }
        if (mb_substr(XOOPS_VERSION, 6, 3) >= 2.1) {
            return false;
        }
        if ('update_ok' != $_POST['op']) {
            return false;
        }

        return true;
    }

    /**
     * @param $blocks
     * @return mixed
     */
    public function build_keep_blocks($blocks)
    {
        $block = webmap3_xoops_block::getSingleton($this->_DIRNAME);

        return $block->keep_option($blocks);
    }

    //---------------------------------------------------------
    // Config
    //---------------------------------------------------------
    public function build_config()
    {
        // dummy
    }

    //---------------------------------------------------------
    // langauge
    //---------------------------------------------------------

    /**
     * @param $name
     * @return mixed
     */
    public function lang($name)
    {
        return constant($this->lang_name($name));
    }

    /**
     * @param $name
     * @return string
     */
    public function lang_name($name)
    {
        return mb_strtoupper('_MI_' . $this->_DIRNAME . '_' . $name);
    }

    //---------------------------------------------------------
    // xoops param
    //---------------------------------------------------------

    /**
     * @param $mid
     * @return bool
     */
    public function get_user_is_module_admin($mid)
    {
        global $xoopsUser;
        if (is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($mid)) {
                return true;
            }
        }

        return false;
    }

    //---------------------------------------------------------
    // module handler
    //---------------------------------------------------------

    /**
     * @param $dirname
     * @return int
     */
    public function get_module_mid_by_dirname($dirname)
    {
        $moduleHandler = xoops_getHandler('module');
        $module        = $moduleHandler->getByDirname($dirname);
        if (is_object($module)) {
            return $module->getVar('mid');
        }

        return 0;
    }

    // --- class end ---
}
