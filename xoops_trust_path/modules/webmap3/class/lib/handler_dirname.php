<?php
// $Id: handler_dirname.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_handler_dirname
//=========================================================

/**
 * Class webmap3_lib_handler_dirname
 */
class webmap3_lib_handler_dirname extends webmap3_lib_handler_basic
{
    public $_DIRNAME;

    public $_table;
    public $_id_name;
    public $_pid_name;
    public $_title_name;

    public $_id           = 0;
    public $_xoops_groups = null;

    public $_use_prefix  = false;
    public $_NONE_VALUE  = '---';
    public $_PREFIX_NAME = 'prefix';
    public $_PREFIX_MARK = '.';
    public $_PREFIX_BAR  = '--';

    public $_PERM_ALLOW_ALL = '*';
    public $_PERM_DENOY_ALL = 'x';
    public $_PERM_SEPARATOR = '&';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_lib_handler_dirname constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_DIRNAME = $dirname;

        parent::__construct();

        $this->_xoops_groups = $this->get_xoops_groups();
    }

    /**
     * @param $name
     */
    public function set_table_prefix_dirname($name)
    {
        $this->set_table($this->prefix_dirname($name));
    }

    /**
     * @param $name
     */
    public function set_table_prefix($name)
    {
        $this->set_table($this->db_prefix($name));
    }

    /**
     * @param $val
     */
    public function set_table($val)
    {
        $this->_table = $val;
    }

    /**
     * @return mixed
     */
    public function get_table()
    {
        return $this->_table;
    }

    /**
     * @param $val
     */
    public function set_id_name($val)
    {
        $this->_id_name = $val;
    }

    /**
     * @return mixed
     */
    public function get_id_name()
    {
        return $this->_id_name;
    }

    /**
     * @param $val
     */
    public function set_pid_name($val)
    {
        $this->_pid_name = $val;
    }

    /**
     * @return mixed
     */
    public function get_pid_name()
    {
        return $this->_pid_name;
    }

    /**
     * @param $val
     */
    public function set_title_name($val)
    {
        $this->_title_name = $val;
    }

    /**
     * @return mixed
     */
    public function get_title_name()
    {
        return $this->_title_name;
    }

    /**
     * @return int
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * @param $name
     * @return string
     */
    public function prefix_dirname($name)
    {
        return $this->db_prefix($this->_DIRNAME . '_' . $name);
    }

    /**
     * @param $val
     */
    public function set_use_prefix($val)
    {
        $this->_use_prefix = (bool)$val;
    }

    //---------------------------------------------------------
    // insert
    //---------------------------------------------------------

    /**
     * @param $row
     */
    public function insert($row)
    {
        // dummy
    }

    //---------------------------------------------------------
    // update
    //---------------------------------------------------------

    /**
     * @param $row
     */
    public function update($row)
    {
        // dummy
    }

    //---------------------------------------------------------
    // delete
    //---------------------------------------------------------

    /**
     * @param      $row
     * @param bool $force
     * @return mixed
     */
    public function delete($row, $force = false)
    {
        return $this->delete_by_id($this->get_id_from_row($row), $force);
    }

    /**
     * @param      $id
     * @param bool $force
     * @return mixed
     */
    public function delete_by_id($id, $force = false)
    {
        $sql = 'DELETE FROM ' . $this->_table;
        $sql .= ' WHERE ' . $this->_id_name . '=' . (int)$id;

        return $this->query($sql, 0, 0, $force);
    }

    /**
     * @param $id_array
     * @return bool
     */
    public function delete_by_id_array($id_array)
    {
        if (!is_array($id_array) || !count($id_array)) {
            return true;    // no action
        }

        $in  = implode(',', $id_array);
        $sql = 'DELETE FROM ' . $this->_table;
        $sql .= ' WHERE ' . $this->_id_name . ' IN (' . $in . ')';

        return $this->query($sql);
    }

    /**
     * @param $row
     * @return int|null
     */
    public function get_id_from_row($row)
    {
        if (isset($row[$this->_id_name])) {
            $this->_id = $row[$this->_id_name];

            return $this->_id;
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function truncate_table()
    {
        $sql = 'TRUNCATE TABLE ' . $this->_table;

        return $this->query($sql);
    }

    //---------------------------------------------------------
    // count
    //---------------------------------------------------------

    /**
     * @return bool
     */
    public function exists_record()
    {
        if ($this->get_count_all() > 0) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function get_count_all()
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this->_table;

        return $this->get_count_by_sql($sql);
    }

    /**
     * @param $where
     * @return int
     */
    public function get_count_by_where($where)
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this->_table;
        $sql .= ' WHERE ' . $where;

        return $this->get_count_by_sql($sql);
    }

    //---------------------------------------------------------
    // row
    //---------------------------------------------------------

    /**
     * @param $id
     * @return bool
     */
    public function get_row_by_id($id)
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $sql .= ' WHERE ' . $this->_id_name . '=' . (int)$id;

        return $this->get_row_by_sql($sql);
    }

    /**
     * @param $id
     * @return bool|void
     */
    public function get_row_by_id_or_default($id)
    {
        $row = $this->get_row_by_id($id);
        if (!is_array($row)) {
            $row = $this->create();
        }

        return $row;
    }

    public function create()
    {
        // dummy
    }

    //---------------------------------------------------------
    // rows
    //---------------------------------------------------------

    /**
     * @param int  $limit
     * @param int  $offset
     * @param null $key
     * @return array|bool
     */
    public function get_rows_all_asc($limit = 0, $offset = 0, $key = null)
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $sql .= ' ORDER BY ' . $this->_id_name . ' ASC';

        return $this->get_rows_by_sql($sql, $limit, $offset, $key);
    }

    /**
     * @param int  $limit
     * @param int  $offset
     * @param null $key
     * @return array|bool
     */
    public function get_rows_all_desc($limit = 0, $offset = 0, $key = null)
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $sql .= ' ORDER BY ' . $this->_id_name . ' DESC';

        return $this->get_rows_by_sql($sql, $limit, $offset, $key);
    }

    /**
     * @param     $where
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public function get_rows_by_where($where, $limit = 0, $offset = 0)
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $sql .= ' WHERE ' . $where;
        $sql .= ' ORDER BY ' . $this->_id_name . ' ASC';

        return $this->get_rows_by_sql($sql, $limit, $offset);
    }

    /**
     * @param     $orderby
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public function get_rows_by_orderby($orderby, $limit = 0, $offset = 0)
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $sql .= ' ORDER BY ' . $orderby;

        return $this->get_rows_by_sql($sql, $limit, $offset);
    }

    /**
     * @param     $where
     * @param     $orderby
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public function get_rows_by_where_orderby($where, $orderby, $limit = 0, $offset = 0)
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $sql .= ' WHERE ' . $where;
        $sql .= ' ORDER BY ' . $orderby;

        return $this->get_rows_by_sql($sql, $limit, $offset);
    }

    /**
     * @param     $groupby
     * @param     $orderby
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public function get_rows_by_groupby_orderby($groupby, $orderby, $limit = 0, $offset = 0)
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $sql .= ' GROUP BY ' . $groupby;
        $sql .= ' ORDER BY ' . $orderby;

        return $this->get_rows_by_sql($sql, $limit, $offset);
    }

    //---------------------------------------------------------
    // id array
    //---------------------------------------------------------

    /**
     * @param     $where
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public function get_id_array_by_where($where, $limit = 0, $offset = 0)
    {
        $sql = 'SELECT ' . $this->_id_name . ' FROM ' . $this->_table;
        $sql .= ' WHERE ' . $where;
        $sql .= ' ORDER BY ' . $this->_id_name . ' ASC';

        return $this->get_first_rows_by_sql($sql, $limit, $offset);
    }

    /**
     * @param     $where
     * @param     $orderby
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public function get_id_array_by_where_orderby($where, $orderby, $limit = 0, $offset = 0)
    {
        $sql = 'SELECT ' . $this->_id_name . ' FROM ' . $this->_table;
        $sql .= ' WHERE ' . $where;
        $sql .= ' ORDER BY ' . $orderby;

        return $this->get_first_rows_by_sql($sql, $limit, $offset);
    }

    //---------------------------------------------------------
    // search
    //---------------------------------------------------------

    /**
     * @param        $keyword_array
     * @param        $name
     * @param string $andor
     * @return null|string
     */
    public function build_where_by_keyword_array($keyword_array, $name, $andor = 'AND')
    {
        if (!is_array($keyword_array) || !count($keyword_array)) {
            return null;
        }

        switch (mb_strtolower($andor)) {
            case 'exact':
                $where = $this->build_where_keyword_single($keyword_array[0], $name);

                return $where;
            case 'or':
                $andor_glue = 'OR';
                break;
            case 'and':
            default:
                $andor_glue = 'AND';
                break;
        }

        $arr = [];

        foreach ($keyword_array as $keyword) {
            $keyword = trim($keyword);
            if ($keyword) {
                $arr[] = $this->build_where_keyword_single($keyword, $name);
            }
        }

        if (is_array($arr) && count($arr)) {
            $glue  = ' ' . $andor_glue . ' ';
            $where = ' ( ' . implode($glue, $arr) . ' ) ';

            return $where;
        }

        return null;
    }

    /**
     * @param $str
     * @param $name
     * @return string
     */
    public function build_where_keyword_single($str, $name)
    {
        $text = $name . " LIKE '%" . addslashes($str) . "%'";

        return $text;
    }

    //---------------------------------------------------------
    // permission
    //---------------------------------------------------------

    /**
     * @param      $id_array
     * @param      $name
     * @param null $groups
     * @return array
     */
    public function build_id_array_with_perm($id_array, $name, $groups = null)
    {
        $arr = [];
        foreach ($id_array as $id) {
            if ($this->check_perm_by_id_name_groups($id, $name, $groups)) {
                $arr[] = $id;
            }
        }

        return $arr;
    }

    /**
     * @param      $rows
     * @param      $name
     * @param null $groups
     * @return array
     */
    public function build_rows_with_perm($rows, $name, $groups = null)
    {
        $arr = [];
        foreach ($rows as $row) {
            if ($this->check_perm_by_row_name_groups($row, $name, $groups)) {
                $arr[] = $row;
            }
        }

        return $arr;
    }

    /**
     * @param      $id
     * @param      $name
     * @param null $groups
     * @return bool
     */
    public function check_perm_by_id_name_groups($id, $name, $groups = null)
    {
        $row = $this->get_cached_row_by_id($id);

        return $this->check_perm_by_row_name_groups($row, $name, $groups);
    }

    /**
     * @param      $row
     * @param      $name
     * @param null $groups
     * @return bool
     */
    public function check_perm_by_row_name_groups($row, $name, $groups = null)
    {
        if (!isset($row[$name])) {
            return false;
        }

        $val = $row[$name];

        if ($this->_PERM_ALLOW_ALL && ($val == $this->_PERM_ALLOW_ALL)) {
            return true;
        }

        if ($this->_PERM_DENOY_ALL && ($val == $this->_PERM_DENOY_ALL)) {
            return false;
        }

        $perms = $this->str_to_array($val, $this->_PERM_SEPARATOR);

        return $this->check_perms_in_groups($perms, $groups);
    }

    /**
     * @param      $perm
     * @param null $groups
     * @return bool
     */
    public function check_perm_by_perm_groups($perm, $groups = null)
    {
        if ($this->_PERM_ALLOW_ALL && ($perm == $this->_PERM_ALLOW_ALL)) {
            return true;
        }

        if ($this->_PERM_DENOY_ALL && ($perm == $this->_PERM_DENOY_ALL)) {
            return false;
        }

        $perms = $this->str_to_array($perm, $this->_PERM_SEPARATOR);

        return $this->check_perms_in_groups($perms, $groups);
    }

    /**
     * @param      $perms
     * @param null $groups
     * @return bool
     */
    public function check_perms_in_groups($perms, $groups = null)
    {
        if (!is_array($perms) || !count($perms)) {
            return false;
        }

        if (empty($groups)) {
            $groups = $this->_xoops_groups;
        }

        $arr = array_intersect($groups, $perms);
        if (is_array($arr) && count($arr)) {
            return true;
        }

        return false;
    }

    /**
     * @param $row
     * @param $name
     * @return array
     */
    public function get_perm_array_by_row_name($row, $name)
    {
        if (isset($row[$name])) {
            return $this->get_perm_array($row[$name]);
        }

        return [];
    }

    /**
     * @param $val
     * @return array
     */
    public function get_perm_array($val)
    {
        return $this->str_to_array($val, $this->_PERM_SEPARATOR);
    }

    //---------------------------------------------------------
    // selbox
    //---------------------------------------------------------

    /**
     * @param string $name
     * @param int    $value
     * @param int    $none
     * @param string $onchange
     * @return string
     */
    public function build_form_selbox($name = '', $value = 0, $none = 0, $onchange = '')
    {
        return $this->build_form_select_list($this->get_rows_by_orderby($this->_title_name), $this->_title_name, $value, $none, $name, $onchange);
    }

    /**
     * @param        $rows
     * @param string $title_name
     * @param int    $preset_id
     * @param int    $none
     * @param string $sel_name
     * @param string $onchange
     * @return string
     */
    public function build_form_select_list($rows, $title_name = '', $preset_id = 0, $none = 0, $sel_name = '', $onchange = '')
    {
        if (empty($title_name)) {
            $title_name = $this->_title_name;
        }

        if (empty($sel_name)) {
            $sel_name = $this->_id_name;
        }

        $str = '<select name="' . $sel_name . '" ';
        if ('' != $onchange) {
            $str .= ' onchange="' . $onchange . '" ';
        }
        $str .= ">\n";

        if ($none) {
            $str .= '<option value="0">';
            $str .= $this->_NONE_VALUE;
            $str .= "</option>\n";
        }

        // Warning : Invalid argument supplied for foreach()
        if (is_array($rows) && count($rows)) {
            foreach ($rows as $row) {
                $id     = $row[$this->_id_name];
                $title  = $row[$title_name];
                $prefix = '';

                if ($this->_use_prefix) {
                    $prefix = $row[$this->_PREFIX_NAME];

                    if ($prefix) {
                        $prefix = str_replace($this->_PREFIX_MARK, $this->_PREFIX_BAR, $prefix) . ' ';
                    }
                }

                $sel = '';
                if ($id == $preset_id) {
                    $sel = ' selected="selected" ';
                }

                $str .= '<option value="' . $id . '" ' . $sel . '>';
                $str .= $prefix . $this->sanitize($title);
                $str .= "</option>\n";
            }
        }

        $str .= "</select>\n";

        return $str;
    }

    //---------------------------------------------------------
    // utility
    //---------------------------------------------------------

    /**
     * @param $str
     * @param $pattern
     * @return array
     */
    public function str_to_array($str, $pattern)
    {
        $arr1 = explode($pattern, $str);
        $arr2 = [];
        foreach ($arr1 as $v) {
            $v = trim($v);
            if ('' == $v) {
                continue;
            }
            $arr2[] = $v;
        }

        return $arr2;
    }

    /**
     * @param $arr
     * @param $glue
     * @return bool|string
     */
    public function array_to_str($arr, $glue)
    {
        $val = false;
        if (is_array($arr) && count($arr)) {
            $val = implode($glue, $arr);
        }

        return $val;
    }

    /**
     * @param $arr
     * @param $glue
     * @return bool|string
     */
    public function array_to_perm($arr, $glue)
    {
        $val = $this->array_to_str($arr, $glue);
        if ($val) {
            $val = $glue . $val . $glue;
        }

        return $val;
    }

    /**
     * @param $arr_in
     * @return array|null
     */
    public function sanitize_array_int($arr_in)
    {
        if (!is_array($arr_in) || !count($arr_in)) {
            return null;
        }

        $arr_out = [];
        foreach ($arr_in as $in) {
            $arr_out[] = (int)$in;
        }

        return $arr_out;
    }

    //---------------------------------------------------------
    // xoops groups
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function get_xoops_groups()
    {
        global $xoopsUser;
        if (is_object($xoopsUser)) {
            return $xoopsUser->getGroups();
        }

        return [XOOPS_GROUP_ANONYMOUS];
    }

    //----- class end -----
}
