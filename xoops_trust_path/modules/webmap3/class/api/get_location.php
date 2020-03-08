<?php
// $Id: get_location.php,v 1.1 2012/04/09 11:55:33 ohwada Exp $

// 2012-04-02 K.OHWADA
// set_use_center_marker()

//=========================================================
// webmap3 module
// 2012-03-31 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_api_get_location
//=========================================================

/**
 * Class webmap3_api_get_location
 */
class webmap3_api_get_location
{
    public $_map_class;
    public $_html_class;

    // center
    public $_latitude  = 0;
    public $_longitude = 0;
    public $_zoom      = 0;
    public $_address   = '';

    // element id
    public $_ele_id_parent_latitude  = '';
    public $_ele_id_parent_longitude = '';
    public $_ele_id_parent_zoom      = '';
    public $_ele_id_parent_address   = '';

    public $_ele_id_list             = '';
    public $_ele_id_search           = '';
    public $_ele_id_current_location = '';
    public $_ele_id_current_address  = '';

    // map param
    public $_map_type_control            = true;
    public $_zoom_control                = true;
    public $_pan_control                 = true;
    public $_street_view_control         = true;
    public $_scale_control               = false;
    public $_overview_map_control        = true;
    public $_overview_map_control_opened = true;

    public $_map_type_control_style = _C_WEBMAP3_GOOGLE_MAP_TYPE_CONTROL_STYLE;
    public $_zoom_control_style     = _C_WEBMAP3_GOOGLE_ZOOM_CONTROL_STYLE;
    public $_map_type               = _C_WEBMAP3_GOOGLE_MAP_TYPE;

    public $_use_draggable_marker = true;
    public $_use_center_marker    = false;
    public $_use_search_marker    = true;
    public $_use_current_location = true;
    public $_use_current_address  = true;

    // map
    public $_map_div_id = '';
    public $_map_func   = '';

    // html
    public $_show_set_address     = true;
    public $_show_current_address = true;

    // direname ;
    public $_WEBMAP3_DIRNAME;

    // default
    public $_OPENER_MODE_DEFAULT = 'parent';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_api_get_location constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_WEBMAP3_DIRNAME = $dirname;

        $this->_map_class  = webmap3_api_map::getSingleton($dirname);
        $this->_html_class = webmap3_api_html::getSingleton($dirname);

        $this->_map_div_id = $dirname . '_map_get_location';
        $this->_map_func   = $dirname . '_load_map_get_location';

        $this->_ele_id_list             = $dirname . '_map_list';
        $this->_ele_id_search           = $dirname . '_map_search';
        $this->_ele_id_current_location = $dirname . '_map_current_location';
        $this->_ele_id_current_address  = $dirname . '_map_current_address';
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
    // main
    //---------------------------------------------------------
    public function display_get_location()
    {
        $opener_mode = $this->get_get('mode', $this->_OPENER_MODE_DEFAULT);

        $param = $this->build_param($opener_mode);

        $this->_html_class->http_output();
        $this->_html_class->header_content_type();
        echo $this->_html_class->fetch_get_location($param);
    }

    /**
     * @param $opener_mode
     * @return mixed
     */
    public function build_param($opener_mode)
    {
        $param   = $this->build_map($opener_mode);
        $head_js = $param['head_js'];

        $this->_html_class->set_head_js($head_js);
        $this->_html_class->set_map_div_id($this->_map_div_id);
        $this->_html_class->set_map_func($this->_map_func);
        $this->_html_class->set_address($this->_address);
        $this->_html_class->set_show_set_address($this->_show_set_address);
        $this->_html_class->set_show_current_address($this->_show_current_address);
        $this->_html_class->set_map_ele_id_list($this->_ele_id_list);
        $this->_html_class->set_map_ele_id_search($this->_ele_id_search);
        $this->_html_class->set_map_ele_id_current_location($this->_ele_id_current_location);
        $this->_html_class->set_map_ele_id_current_address($this->_ele_id_current_address);

        if ('opener' == $opener_mode) {
            $this->_html_class->set_show_close(true);
        }

        return $this->_html_class->build_param_get_location();
    }

    /**
     * @param $opener_mode
     * @return array
     */
    public function build_map($opener_mode)
    {
        $this->_map_class->init();

        $this->_map_class->set_opener_mode($opener_mode);

        $this->_map_class->set_map_div_id($this->_map_div_id);
        $this->_map_class->set_map_func($this->_map_func);

        $this->_map_class->set_map_type_control($this->_map_type_control);
        $this->_map_class->set_zoom_control($this->_zoom_control);
        $this->_map_class->set_pan_control($this->_pan_control);
        $this->_map_class->set_street_view_control($this->_street_view_control);
        $this->_map_class->set_scale_control($this->_scale_control);
        $this->_map_class->set_overview_map_control($this->_overview_map_control);
        $this->_map_class->set_overview_map_control_opened($this->_overview_map_control_opened);
        $this->_map_class->set_map_type_control_style($this->_map_type_control_style);
        $this->_map_class->set_zoom_control_style($this->_zoom_control_style);
        $this->_map_class->set_map_type($this->_map_type);

        $this->_map_class->set_latitude($this->_latitude);
        $this->_map_class->set_longitude($this->_longitude);
        $this->_map_class->set_zoom($this->_zoom);

        $this->_map_class->set_ele_id_list($this->_ele_id_list);
        $this->_map_class->set_ele_id_search($this->_ele_id_search);
        $this->_map_class->set_ele_id_current_location($this->_ele_id_current_location);
        $this->_map_class->set_ele_id_current_address($this->_ele_id_current_address);

        $this->_map_class->set_ele_id_parent_latitude($this->_ele_id_parent_latitude);
        $this->_map_class->set_ele_id_parent_longitude($this->_ele_id_parent_longitude);
        $this->_map_class->set_ele_id_parent_zoom($this->_ele_id_parent_zoom);
        $this->_map_class->set_ele_id_parent_address($this->_ele_id_parent_address);

        $this->_map_class->set_use_draggable_marker($this->_use_draggable_marker);
        $this->_map_class->set_use_center_marker($this->_use_center_marker);
        $this->_map_class->set_use_search_marker($this->_use_search_marker);
        $this->_map_class->set_use_current_location($this->_use_current_location);
        $this->_map_class->set_use_current_address($this->_use_current_address);

        $param   = $this->_map_class->build_get_location();
        $head_js = $this->_map_class->fetch_get_location_head($param, false);

        $arr = [
            'head_js' => $head_js,
        ];

        return $arr;
    }

    //---------------------------------------------------------
    // $_GET
    //---------------------------------------------------------

    /**
     * @param      $key
     * @param null $default
     */
    public function get_get($key, $default = null)
    {
        $str = isset($_GET[$key]) ? $_GET[$key] : $default;

        return $str;
    }

    //---------------------------------------------------------
    // set param
    //---------------------------------------------------------

    /**
     * @param $val
     */
    public function set_latitude($val)
    {
        $this->_latitude = (float)$val;
    }

    /**
     * @param $val
     */
    public function set_longitude($val)
    {
        $this->_longitude = (float)$val;
    }

    /**
     * @param $val
     */
    public function set_zoom($val)
    {
        $this->_zoom = (int)$val;
    }

    /**
     * @param $val
     */
    public function set_address($val)
    {
        $this->_address = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_parent_latitude($val)
    {
        $this->_ele_id_parent_latitude = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_parent_longitude($val)
    {
        $this->_ele_id_parent_longitude = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_parent_zoom($val)
    {
        $this->_ele_id_parent_zoom = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_parent_address($val)
    {
        $this->_ele_id_parent_address = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_list($val)
    {
        $this->_ele_id_list = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_search($val)
    {
        $this->_ele_id_search = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_current_location($val)
    {
        $this->_ele_id_current_location = $val;
    }

    /**
     * @param $val
     */
    public function set_ele_id_current_address($val)
    {
        $this->_ele_id_current_address = $val;
    }

    /**
     * @param $val
     */
    public function set_map_type_control($val)
    {
        $this->_map_type_control = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_zoom_control($val)
    {
        $this->_zoom_control = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_pan_control($val)
    {
        $this->_pan_control = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_street_view_control($val)
    {
        $this->_street_view_control = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_scale_control($val)
    {
        $this->_scale_control = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_overview_map_control($val)
    {
        $this->_overview_map_control = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_overview_map_control_opened($val)
    {
        $this->_overview_map_control_opened = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_map_type_control_style($val)
    {
        $this->_map_type_control_style = $val;
    }

    /**
     * @param $val
     */
    public function set_zoom_control_style($val)
    {
        $this->_zoom_control_style = $val;
    }

    /**
     * @param $val
     */
    public function set_map_type($val)
    {
        $this->_map_type = $val;
    }

    /**
     * @param $v
     */
    public function set_map_div_id($v)
    {
        $this->_map_div_id = $v;
    }

    /**
     * @param $v
     */
    public function set_map_func($v)
    {
        $this->_map_func = $v;
    }

    /**
     * @param $val
     */
    public function set_use_draggable_marker($val)
    {
        $this->_use_draggable_marker = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_use_center_marker($val)
    {
        $this->_use_center_marker = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_use_search_marker($val)
    {
        $this->_use_search_marker = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_use_current_location($val)
    {
        $this->_use_current_location = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_use_current_address($val)
    {
        $this->_use_current_address = (bool)$val;
    }

    /**
     * @param $v
     */
    public function set_show_set_address($v)
    {
        $this->_show_set_address = (bool)$v;
    }

    /**
     * @param $v
     */
    public function set_show_current_address($v)
    {
        $this->_show_current_address = (bool)$v;
    }

    // --- class end ---
}
