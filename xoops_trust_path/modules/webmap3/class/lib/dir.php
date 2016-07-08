<?php
// $Id: dir.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_dir
//=========================================================
class webmap3_lib_dir
{
    public $_MKDIR_MODE = 0777;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        //
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_lib_dir();
        }
        return $instance;
    }

    //---------------------------------------------------------
    // get files
    //---------------------------------------------------------
    public function get_files_in_dir($path, $ext = null, $flag_dir = false, $flag_sort = false, $id_as_key = false)
    {
        $arr = array();

        $lists = $this->get_lists_in_dir($path);
        if (!is_array($lists)) {
            return false;
        }

        $pattern = "/\." . preg_quote($ext) . "$/";

        foreach ($lists as $list) {
            $path_list = $path . '/' . $list;

            // check is file
            if (is_dir($path_list) || !is_file($path_list)) {
                continue;
            }

            // check ext
            if ($ext && !preg_match($pattern, $list)) {
                continue;
            }

            $list_out = $list;
            if ($flag_dir) {
                $list_out = $path_list;
            }
            if ($id_as_key) {
                $arr[$list] = $list_out;
            } else {
                $arr[] = $list_out;
            }
        }

        if ($flag_sort) {
            asort($arr);
            reset($arr);
        }

        return $arr;
    }

    public function get_dirs_in_dir($path, $flag_dir = false, $flag_sort = false, $id_as_key = false)
    {
        $arr = array();

        $lists = $this->get_lists_in_dir($path);
        if (!is_array($lists)) {
            return false;
        }

        foreach ($lists as $list) {
            $path_list = $path . '/' . $list;

            // check is dir
            if (!is_dir($path_list)) {
                continue;
            }

            // myself
            if ($list == '.') {
                continue;
            }

            // parent
            if ($list == '..') {
                continue;
            }

            $list_out = $list;
            if ($flag_dir) {
                $list_out = $path_list;
            }
            if ($id_as_key) {
                $arr[$list] = $list_out;
            } else {
                $arr[] = $list_out;
            }
        }

        if ($flag_sort) {
            asort($arr);
            reset($arr);
        }

        return $arr;
    }

    public function get_lists_in_dir($path)
    {
        $arr = array();

        $path = $this->strip_slash_from_tail($path);

        // check is dir
        if (!is_dir($path)) {
            return false;
        }

        // open
        $dh = opendir($path);
        if (!$dh) {
            return false;
        }

        // read
        while (false !== ($list = readdir($dh))) {
            $arr[] = $list;
        }

        // close
        closedir($dh);

        return $arr;
    }

    //---------------------------------------------------------
    // make dir
    //---------------------------------------------------------
    public function make_dir($dir, $check_writable = true)
    {
        $not_dir = true;
        if (is_dir($dir)) {
            $not_dir = false;
            if ($check_writable && is_writable($dir)) {
                return '';
            } elseif (!$check_writable) {
                return '';
            }
        }

        if (ini_get('safe_mode')) {
            return $this->highlight('At first create & chmod 777 "' . $dir . '" by ftp or shell.') . "<br />\n";
        }

        if ($not_dir) {
            $ret = mkdir($dir, $this->_MKDIR_MODE);
            if (!$ret) {
                return $this->highlight('can not create directory : <b>' . $dir . '</b>') . "<br />\n";
            }
        }

        $ret = chmod($dir, $this->_MKDIR_MODE);
        if (!$ret) {
            return $this->highlight('can not change mode directory : <b>' . $dir . '</b> ', $this->_MKDIR_MODE) . "<br />\n";
        }

        $msg = 'create directory: <b>' . $dir . '</b>' . "<br />\n";
        return $msg;
    }

    public function check_dir($dir)
    {
        if ($dir && is_dir($dir) && is_writable($dir) && is_readable($dir)) {
            return true;
        }
        return false;
    }

    //---------------------------------------------------------
    // utility
    //---------------------------------------------------------
    public function highlight($str)
    {
        $val = '<span style="color:#ff0000;">' . $str . '</span>';
        return $val;
    }

    // --- class end ---
}
