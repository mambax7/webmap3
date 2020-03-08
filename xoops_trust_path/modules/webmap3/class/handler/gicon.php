<?php
// $Id: gicon.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_handler_gicon
//=========================================================

/**
 * Class webmap3_handler_gicon
 */
class webmap3_handler_gicon extends webmap3_lib_handler_dirname
{
    public $_utility_class;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_handler_gicon constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        parent::__construct($dirname);
        $this->set_table_prefix_dirname('gicon');
        $this->set_id_name('gicon_id');

        $this->_utility_class = webmap3_lib_utility::getInstance();

        $constpref = mb_strtoupper('_P_' . $dirname . '_');
        $this->set_debug_sql_by_const_name($constpref . 'DEBUG_SQL');
        $this->set_debug_error_by_const_name($constpref . 'DEBUG_ERROR');
    }

    /**
     * @param $dirname
     * @return mixed
     */
    public static function getSingleton($dirname)
    {
        static $singletons;
        if (!isset($singletons[$dirname])) {
            $singletons[$dirname] = new self($dirname);
        }

        return $singletons[$dirname];
    }

    //---------------------------------------------------------
    // create
    //---------------------------------------------------------

    /**
     * @param bool $flag_new
     * @return array|void
     */
    public function create($flag_new = false)
    {
        $time_create = 0;
        $time_update = 0;

        if ($flag_new) {
            $time        = time();
            $time_create = $time;
            $time_update = $time;
        }

        $arr = [
            'gicon_id'            => 0,
            'gicon_time_create'   => $time_create,
            'gicon_time_update'   => $time_update,
            'gicon_title'         => '',
            'gicon_image_path'    => '',
            'gicon_image_name'    => '',
            'gicon_image_ext'     => '',
            'gicon_shadow_path'   => '',
            'gicon_shadow_name'   => '',
            'gicon_shadow_ext'    => '',
            'gicon_image_width'   => 0,
            'gicon_image_height'  => 0,
            'gicon_shadow_width'  => 0,
            'gicon_shadow_height' => 0,
            'gicon_anchor_x'      => 0,
            'gicon_anchor_y'      => 0,
            'gicon_info_x'        => 0,
            'gicon_info_y'        => 0,
        ];

        return $arr;
    }

    //---------------------------------------------------------
    // insert
    //---------------------------------------------------------

    /**
     * @param $row
     * @return bool|void
     */
    public function insert($row)
    {
        extract($row);

        $sql = 'INSERT INTO ' . $this->_table . ' (';

        $sql .= 'gicon_time_create, ';
        $sql .= 'gicon_time_update, ';
        $sql .= 'gicon_title, ';
        $sql .= 'gicon_image_path, ';
        $sql .= 'gicon_image_name, ';
        $sql .= 'gicon_image_ext, ';
        $sql .= 'gicon_shadow_path, ';
        $sql .= 'gicon_shadow_name, ';
        $sql .= 'gicon_shadow_ext, ';
        $sql .= 'gicon_image_width, ';
        $sql .= 'gicon_image_height, ';
        $sql .= 'gicon_shadow_width, ';
        $sql .= 'gicon_shadow_height, ';
        $sql .= 'gicon_anchor_x, ';
        $sql .= 'gicon_anchor_y, ';
        $sql .= 'gicon_info_x, ';
        $sql .= 'gicon_info_y ';

        $sql .= ') VALUES ( ';

        $sql .= (int)$gicon_time_create . ', ';
        $sql .= (int)$gicon_time_update . ', ';
        $sql .= $this->quote($gicon_title) . ', ';
        $sql .= $this->quote($gicon_image_path) . ', ';
        $sql .= $this->quote($gicon_image_name) . ', ';
        $sql .= $this->quote($gicon_image_ext) . ', ';
        $sql .= $this->quote($gicon_shadow_path) . ', ';
        $sql .= $this->quote($gicon_shadow_name) . ', ';
        $sql .= $this->quote($gicon_shadow_ext) . ', ';
        $sql .= (int)$gicon_image_width . ', ';
        $sql .= (int)$gicon_image_height . ', ';
        $sql .= (int)$gicon_shadow_width . ', ';
        $sql .= (int)$gicon_shadow_height . ', ';
        $sql .= (int)$gicon_anchor_x . ', ';
        $sql .= (int)$gicon_anchor_y . ', ';
        $sql .= (int)$gicon_info_x . ', ';
        $sql .= (int)$gicon_info_y . ' ';

        $sql .= ')';

        $ret = $this->query($sql);
        if (!$ret) {
            return false;
        }

        return $this->_db->getInsertId();
    }

    //---------------------------------------------------------
    // update
    //---------------------------------------------------------

    /**
     * @param $row
     * @return mixed
     */
    public function update($row)
    {
        extract($row);

        $sql = 'UPDATE ' . $this->_table . ' SET ';

        $sql .= 'gicon_time_create=' . (int)$gicon_time_create . ', ';
        $sql .= 'gicon_time_update=' . (int)$gicon_time_update . ', ';
        $sql .= 'gicon_title=' . $this->quote($gicon_title) . ', ';
        $sql .= 'gicon_image_path=' . $this->quote($gicon_image_path) . ', ';
        $sql .= 'gicon_image_name=' . $this->quote($gicon_image_name) . ', ';
        $sql .= 'gicon_image_ext=' . $this->quote($gicon_image_ext) . ', ';
        $sql .= 'gicon_shadow_path=' . $this->quote($gicon_shadow_path) . ', ';
        $sql .= 'gicon_shadow_name=' . $this->quote($gicon_shadow_name) . ', ';
        $sql .= 'gicon_shadow_ext=' . $this->quote($gicon_shadow_ext) . ', ';
        $sql .= 'gicon_image_width=' . (int)$gicon_image_width . ', ';
        $sql .= 'gicon_image_height=' . (int)$gicon_image_height . ', ';
        $sql .= 'gicon_shadow_width=' . (int)$gicon_shadow_width . ', ';
        $sql .= 'gicon_shadow_height=' . (int)$gicon_shadow_height . ', ';
        $sql .= 'gicon_anchor_x=' . (int)$gicon_anchor_x . ', ';
        $sql .= 'gicon_anchor_y=' . (int)$gicon_anchor_y . ', ';
        $sql .= 'gicon_info_x=' . (int)$gicon_info_x . ', ';
        $sql .= 'gicon_info_y=' . (int)$gicon_info_y . ' ';

        $sql .= 'WHERE gicon_id=' . (int)$gicon_id;

        return $this->query($sql);
    }

    //---------------------------------------------------------
    // get rows
    //---------------------------------------------------------

    /**
     * @param bool $flag_none
     * @return array|null
     */
    public function get_sel_options($flag_none = false)
    {
        $rows = $this->get_rows_all_asc();
        if (!is_array($rows) || !count($rows)) {
            return null;
        }

        $arr = [];
        if ($flag_none) {
            $arr[0] = '(default)';
        }

        foreach ($rows as $row) {
            $arr[$row['gicon_id']] = $row['gicon_title'];
        }

        return $arr;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array|null
     */
    public function get_icons($limit = 0, $offset = 0)
    {
        $rows = $this->get_rows_all_asc($limit, $offset);
        if (!is_array($rows) || !count($rows)) {
            return null;
        }

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->build_single_icon($row);
        }

        return $arr;
    }

    /**
     * @param $row
     * @return array
     */
    public function build_single_icon($row)
    {
        $image_url  = $this->build_icon_url($row['gicon_image_path']);
        $shadow_url = $this->build_icon_url($row['gicon_shadow_path']);

        $arr = [
            'id'            => $row['gicon_id'],
            'image_url'     => $image_url,
            'image_width'   => $row['gicon_image_width'],
            'image_height'  => $row['gicon_image_height'],
            'anchor_x'      => $row['gicon_anchor_x'],
            'anchor_y'      => $row['gicon_anchor_y'],
            'info_x'        => $row['gicon_info_x'],
            'info_y'        => $row['gicon_info_y'],
            'shadow_url'    => $shadow_url,
            'shadow_width'  => $row['gicon_shadow_width'],
            'shadow_height' => $row['gicon_shadow_height'],
        ];

        return $arr;
    }

    /**
     * @param      $path
     * @param bool $flag_sanitize
     * @return string
     */
    public function build_icon_url($path, $flag_sanitize = false)
    {
        if (empty($path)) {
            return '';
        }

        $path = $this->_utility_class->strip_slash_from_head($path);
        $url  = XOOPS_URL . '/' . $path;

        if ($flag_sanitize) {
            $url = $this->sanitize($url);
        }

        return $url;
    }

    /**
     * @param $path
     * @return string
     */
    public function build_icon_full_path($path)
    {
        if (empty($path)) {
            return '';
        }

        $path = $this->_utility_class->strip_slash_from_head($path);
        $full = XOOPS_ROOT_PATH . '/' . $path;

        return $full;
    }

    /**
     * @param $str
     * @return string
     */
    public function sanitize($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    // --- class end ---
}
