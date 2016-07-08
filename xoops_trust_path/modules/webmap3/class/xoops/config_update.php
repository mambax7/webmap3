<?php
// $Id: config_update.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_config_update
//=========================================================
class webmap3_xoops_config_update extends webmap3_lib_handler_basic
{

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_xoops_config_update();
        }
        return $instance;
    }

    //---------------------------------------------------------
    // xoops config table
    // conf_name:  25 -> 255
    // conf_title: 32 -> 255
    // conf_desc:  32 -> 255
    //---------------------------------------------------------
    public function update()
    {
        // configs (Though I know it is not a recommended way...)
        $this->_table_config = $this->db_prefix('config');

        $check1 = $this->check_type_length('conf_name', 250);
        $check2 = $this->check_type_length('conf_title', 250);
        $check3 = $this->check_type_length('conf_desc', 250);

        if ($check1 && $check2 && $check3) {
            return true;
        }

        $sql = 'ALTER TABLE ' . $this->_table_config;
        $sql .= " MODIFY `conf_name`  varchar(255) NOT NULL default '', ";
        $sql .= " MODIFY `conf_title` varchar(255) NOT NULL default '', ";
        $sql .= " MODIFY `conf_desc`  varchar(255) NOT NULL default '' ";

        return $this->query($sql);
    }

    public function check_type_length($field_name, $length)
    {
        $check_sql = 'SHOW COLUMNS FROM ' . $this->_table_config . " LIKE '" . $field_name . "'";
        $row       = $this->get_row_by_sql($check_sql);
        if (!is_array($row)) {
            return false;
        }

        if (preg_match('/varchar\((\d+)\)/i', $row['Type'], $matches)) {
            if ($matches[1] > $length) {
                return true;
            }
        }

        return false;
    }

    // --- class end ---
}
