<?php
// $Id: handler_basic.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// change log
// 2009-05-17 K.OHWADA
// Notice [PHP]: Undefined variable: offse
//---------------------------------------------------------

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_handler_basic
//=========================================================

/**
 * Class webmap3_lib_handler_basic
 */
class webmap3_lib_handler_basic
{
    public $_db;

    public $_cached = [];

    public $_DEBUG_SQL   = false;
    public $_DEBUG_ERROR = 0;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_db = XoopsDatabaseFactory::getDatabaseConnection();
    }

    //---------------------------------------------------------
    // get query
    //---------------------------------------------------------

    /**
     * @param $sql
     * @return int
     */
    public function get_count_by_sql($sql)
    {
        return (int)$this->get_first_row_by_sql($sql);
    }

    /**
     * @param $sql
     * @return bool
     */
    public function get_first_row_by_sql($sql)
    {
        $res = $this->query($sql);
        if (!$res) {
            return false;
        }

        $row = $this->_db->fetchRow($res);
        if (isset($row[0])) {
            return $row[0];
        }

        return false;
    }

    /**
     * @param $sql
     * @return bool
     */
    public function get_row_by_sql($sql)
    {
        $res = $this->query($sql);
        if (!$res) {
            return false;
        }

        $row = $this->_db->fetchArray($res);

        return $row;
    }

    /**
     * @param      $sql
     * @param int  $limit
     * @param int  $offset
     * @param null $key
     * @return array|bool
     */
    public function get_rows_by_sql($sql, $limit = 0, $offset = 0, $key = null)
    {
        $arr = [];

        $res = $this->query($sql, $limit, $offset);
        if (!$res) {
            return false;
        }

        while (false !== ($row = $this->_db->fetchArray($res))) {
            if ($key && isset($row[$key])) {
                $arr[$row[$key]] = $row;
            } else {
                $arr[] = $row;
            }
        }

        return $arr;
    }

    /**
     * @param     $sql
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public function get_first_rows_by_sql($sql, $limit = 0, $offset = 0)
    {
        $res = $this->query($sql, $limit, $offset);
        if (!$res) {
            return false;
        }

        $arr = [];

        while (false !== ($row = $this->_db->fetchRow($res))) {
            $arr[] = $row[0];
        }

        return $arr;
    }

    //---------------------------------------------------------
    // cached
    //---------------------------------------------------------

    /**
     * @param $id
     * @return mixed|null
     */
    public function get_cached_row_by_id($id)
    {
        if (isset($this->_cached[$id])) {
            return $this->_cached[$id];
        }

        $row = $this->get_row_by_id($id);
        if (is_array($row)) {
            $this->_cached[$id] = $row;

            return $row;
        }

        return null;
    }

    /**
     * @param      $id
     * @param      $name
     * @param bool $flag_sanitize
     * @return null|string
     */
    public function get_cached_value_by_id_name($id, $name, $flag_sanitize = false)
    {
        $row = $this->get_cached_row_by_id($id);
        if (isset($row[$name])) {
            $val = $row[$name];
            if ($flag_sanitize) {
                $val = $this->sanitize($val);
            }

            return $val;
        }

        return null;
    }

    //---------------------------------------------------------
    // update
    //---------------------------------------------------------

    /**
     * @param $table
     * @return bool
     */
    public function exists_table($table)
    {
        $sql = 'SHOW TABLES LIKE ' . $this->quote($table);

        $res = $this->query($sql);
        if (!$res) {
            return false;
        }

        while (false !== ($row = $this->_db->fetchRow($res))) {
            if (mb_strtolower($row[0]) == mb_strtolower($table)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $table
     * @param $column
     * @return bool
     */
    public function exists_column($table, $column)
    {
        $row = $this->get_column_row($table, $column);
        if (is_array($row)) {
            return true;
        }

        return false;
    }

    /**
     * @param $table
     * @param $column
     * @return bool
     */
    public function get_column_row($table, $column)
    {
        $sql = 'SHOW COLUMNS FROM ' . $table . ' LIKE ' . $this->quote($column);

        $res = $this->query($sql);
        if (!$res) {
            return false;
        }

        while (false !== ($row = $this->_db->fetchArray($res))) {
            if ($row['Field'] == $column) {
                return $row;
            }
        }

        return false;
    }

    //---------------------------------------------------------
    // query
    //---------------------------------------------------------

    /**
     * @param      $sql
     * @param int  $limit
     * @param int  $offset
     * @param bool $force
     * @return mixed
     */
    public function query($sql, $limit = 0, $offset = 0, $force = false)
    {
        if ($force) {
            return $this->queryF($sql, $limit, $offset);
        }

        $this->print_sql_full_when_debug_sql($sql, $limit, $offset);

        $res = $this->_db->query($sql, $limit, $offset);
        if (!$res) {
            $this->print_db_error($sql, $limit, $offset);
        }

        return $res;
    }

    /**
     * @param     $sql
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function queryF($sql, $limit = 0, $offset = 0)
    {
        $this->print_sql_full_when_debug_sql($sql, $limit, $offset);

        $res = $this->_db->queryF($sql, $limit, $offset);
        if (!$res) {
            $this->print_db_error($sql, $limit, $offset);
        }

        return $res;
    }

    /**
     * @param $str
     * @return string
     */
    public function quote($str)
    {
        $str = "'" . addslashes($str) . "'";

        return $str;
    }

    /**
     * @param $name
     * @return string
     */
    public function db_prefix($name)
    {
        return $this->_db->prefix($name);
    }

    /**
     * @return mixed
     */
    public function get_db_error()
    {
        return $this->_db->error();
    }

    //---------------------------------------------------------
    // error
    //---------------------------------------------------------

    /**
     * @param $sql
     * @param $limit
     * @param $offset
     */
    public function print_sql_full_when_debug_sql($sql, $limit, $offset)
    {
        if ($this->_DEBUG_SQL) {
            $sql = $this->print_sql_full($sql, $limit, $offset);
        }
    }

    /**
     * @param $sql
     * @param $limit
     * @param $offset
     */
    public function print_sql_full($sql, $limit, $offset)
    {
        $sql = $this->build_sql_full($sql, $limit, $offset);
        echo $this->sanitize($sql) . "<br >\n";
    }

    /**
     * @param $sql
     * @param $limit
     * @param $offset
     */
    public function print_db_error($sql, $limit, $offset)
    {
        if (!$this->_DEBUG_SQL) {
            $this->print_sql_full($sql, $limit, $offset);
        }
        if ($this->_DEBUG_ERROR) {
            echo $this->highlight($this->get_db_error()) . "<br >\n";
        }
        if ($this->_DEBUG_ERROR > 1) {
            debug_print_backtrace();
        }
    }

    /**
     * @param $sql
     * @param $limit
     * @param $offset
     * @return string
     */
    public function build_sql_full($sql, $limit, $offset)
    {
        $str = $sql . ': limit=' . $limit . ' :offset=' . $offset;

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

    /**
     * @param $str
     * @return string
     */
    public function highlight($str)
    {
        $val = '<span style="color:#ff0000;">' . $str . '</span>';

        return $val;
    }

    //---------------------------------------------------------
    // debug
    //---------------------------------------------------------

    /**
     * @param $val
     */
    public function set_debug_sql($val)
    {
        $this->_DEBUG_SQL = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_debug_error($val)
    {
        $this->_DEBUG_ERROR = (int)$val;
    }

    /**
     * @param $name
     */
    public function set_debug_sql_by_const_name($name)
    {
        $name = mb_strtoupper($name);
        if (defined($name)) {
            $this->set_debug_sql(constant($name));
        }
    }

    /**
     * @param $name
     */
    public function set_debug_error_by_const_name($name)
    {
        $name = mb_strtoupper($name);
        if (defined($name)) {
            $this->set_debug_error(constant($name));
        }
    }

    // --- class end ---
}
