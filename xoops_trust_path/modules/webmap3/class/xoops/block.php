<?php
// $Id: block.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_block
//=========================================================
class webmap3_xoops_block extends webmap3_lib_handler_basic
{
    public $_module_mid      = 0;
    public $_newblocks_table = null;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct();
        $this->_module_mid      = $this->get_module_mid_by_dirname($dirname);
        $this->_newblocks_table = $this->db_prefix('newblocks');
    }

    // webmap3_inc_xoops_version_base
    public static function getSingleton($dirname)
    {
        static $singletons;
        if (!isset($singletons[$dirname])) {
            $singletons[$dirname] = new webmap3_xoops_block($dirname);
        }
        return $singletons[$dirname];
    }

    //---------------------------------------------------------
    // xoops block table
    //---------------------------------------------------------
    public function keep_option($blocks)
    {
        // Keep Block option values when update (by nobunobu) for XOOPS 2.0.x

        $local_msgs = array();

        $count = count($blocks);

        $rows = $this->get_newblocks_rows($count);
        foreach ($rows as $row) {
            $local_msgs[] = 'Non Defined Block <b>' . $row['name'] . '</b> will be deleted';
            $iret         = $this->delete_newblocks($row['bid']);
        }

        for ($i = 1; $i <= $count; ++$i) {
            $fblock = $this->get_newblocks_row($i, $blocks[$i]['show_func'], $blocks[$i]['file']);

            if (isset($fblock['options'])) {
                $old_vals = explode('|', $fblock['options']);
                $def_vals = explode('|', $blocks[$i]['options']);

                if (count($old_vals) == count($def_vals)) {
                    $blocks[$i]['options'] = $fblock['options'];
                    $local_msgs[]          = "Option's values of the block <b>" . $fblock['name'] . '</b> will be kept. (value = <b>' . $fblock['options'] . '</b>)';
                } elseif (count($old_vals) < count($def_vals)) {
                    for ($j = 0; $j < count($old_vals); ++$j) {
                        $def_vals[$j] = $old_vals[$j];
                    }

                    $blocks[$i]['options'] = implode('|', $def_vals);
                    $local_msgs[]          = "Option's values of the block <b>" . $fblock['name'] . '</b> will be kept and new option(s) are added. (value = <b>' . $blocks[$i]['options'] . '</b>)';
                } else {
                    $local_msgs[] =
                        "Option's values of the block <b>" . $fblock['name'] . '</b> will be reset to the default, because of some decrease of options. (value = <b>' . $blocks[$i]['options']
                        . '</b>)';
                }
            }
        }

        $this->blocks_msg($local_msgs);

        return $blocks;
    }

    public function get_newblocks_rows($func_num, $limit = 0, $offset = 0)
    {
        $sql = 'SELECT * FROM ' . $this->_newblocks_table;
        $sql .= ' WHERE mid=' . (int)$this->_module_mid;
        $sql .= " AND block_type <>'D' ";
        $sql .= ' AND func_num > ' . (int)$func_num;
        return $this->get_rows_by_sql($sql, $limit, $offset);
    }

    public function delete_newblocks($bid)
    {
        $sql = 'DELETE FROM ' . $this->_newblocks_table;
        $sql .= ' WHERE bid=' . (int)$bid;
        return $this->query($sql);
    }

    public function get_newblocks_row($func_num, $show_func, $func_file)
    {
        $sql = 'SELECT * FROM ' . $this->_newblocks_table;
        $sql .= ' WHERE mid=' . (int)$this->_module_mid;
        $sql .= ' AND func_num=' . (int)$func_num;
        $sql .= ' AND show_func=' . $this->quote($show_func);
        $sql .= ' AND func_file=' . $this->quote($func_file);
        return $this->get_row_by_sql($sql);
    }

    public function blocks_msg($local_msgs)
    {
        global $msgs, $myblocksadmin_parsed_updateblock;
        if (!empty($msgs) && !empty($local_msgs) && empty($myblocksadmin_parsed_updateblock)) {
            $msgs                             = array_merge($msgs, $local_msgs);
            $myblocksadmin_parsed_updateblock = true;
        }
    }

    //---------------------------------------------------------
    // module handler
    //---------------------------------------------------------
    public function get_module_mid_by_dirname($dirname)
    {
        $module_handler = xoops_getHandler('module');
        $module         = $module_handler->getByDirname($dirname);
        if (is_object($module)) {
            return $module->getVar('mid');
        }
        return 0;
    }

    // --- class end ---
}
