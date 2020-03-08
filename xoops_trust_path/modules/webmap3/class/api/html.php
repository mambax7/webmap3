<?php
// $Id: html.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-04 K.OHWADA
// build_display_style_js()

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_api_html
//=========================================================

/**
 * Class webmap3_api_html
 */
class webmap3_api_html
{
    public $_multibyte_class;
    public $_language_class;
    public $_form_class;
    public $_header_class;

    public $_WEBMAP3_DIRNAME;
    public $_dirname = 'webmap3';

    public $_map_div_id = '';
    public $_map_func   = '';

    // Yokohama, Japan
    public $_address   = _C_WEBMAP3_CFG_ADDRESS;
    public $_latitude  = _C_WEBMAP3_CFG_LATITUDE;
    public $_longitude = _C_WEBMAP3_CFG_LONGITUDE;
    public $_zoom      = _C_WEBMAP3_CFG_ZOOM;

    // display
    public $_display_iframe_url;
    public $_display_iframe_width    = '95%';
    public $_display_iframe_height   = '650px';
    public $_display_src             = '';
    public $_display_url_desc        = '';
    public $_display_url_opener      = '';
    public $_display_anchor          = 'google_map';
    public $_display_open_name       = 'webmap3_window';
    public $_display_open_width      = 800;
    public $_display_open_height     = 850;
    public $_display_div_id          = 'webmap3_map_iframe';
    public $_display_div_style       = 'display:block;';
    public $_display_func_popup      = 'webmap3_display_popup';
    public $_display_func_style_show = 'webmap3_display_style_show';
    public $_display_func_style_hide = 'webmap3_display_style_hide';
    public $_display_func_html_show  = 'webmap3_display_html_show';
    public $_display_func_html_hide  = 'webmap3_display_html_hide';

    // gicon
    public $_gicon_select_id   = 'webmap3_gicon_id';
    public $_gicon_select_name = 'webmap3_gicon_id';
    public $_gicon_select_func = 'webmap3_gicon_onchange';
    public $_gicon_img_id      = 'webmap3_gicon_img';
    public $_gicon_img_src     = '';
    public $_gicon_img_alt     = 'gicon';
    public $_gicon_img_border  = 0;
    public $_gicon_id          = 0;
    public $_gicon_options     = '';
    public $_gicon_icon        = '';

    // get location
    public $_head_js              = '';
    public $_map_js               = '';
    public $_map_width            = '95%';
    public $_map_height           = '300px';
    public $_map_style_option     = 'border:1px solid #909090; margin-bottom:6px;';
    public $_show_close           = false;
    public $_show_hide_map        = false;
    public $_show_set_address     = false;
    public $_show_innerhtml       = false;
    public $_show_search_reverse  = false;
    public $_show_current_address = false;

    // element id
    public $_map_ele_id_list             = 'webmap3_map_list';
    public $_map_ele_id_search           = 'webmap3_map_search';
    public $_map_ele_id_current_location = 'webmap3_map_current_location';
    public $_map_ele_id_current_address  = 'webmap3_map_current_address';

    // template
    public $_template_display_style_js  = '';
    public $_template_display_html_js   = '';
    public $_template_set_location_form = '';
    public $_template_get_location      = '';

    // lang
    public $_lang_latitude           = 'Latitude';
    public $_lang_longitude          = 'Longitude';
    public $_lang_zoom               = 'Zoom';
    public $_lang_edit               = 'Edit';
    public $_lang_search             = 'Search';
    public $_lang_search_reverse     = 'Search Address from current location';
    public $_lang_search_list        = 'Search Result List';
    public $_lang_get_location       = 'Get Location';
    public $_lang_get_address        = 'Get Address';
    public $_lang_display_hide       = 'Disp Off';
    public $_lang_close              = 'Close';
    public $_lang_display_desc       = 'Get location with google maps';
    public $_lang_display_new        = 'Show new window';
    public $_lang_display_popup      = 'Show popup';
    public $_lang_display_inline     = 'Show inline';
    public $_lang_title_set_location = 'Set Location';
    public $_lang_title_get_location = 'Get Location';
    public $_lang_current_location   = 'Current Location';
    public $_lang_not_iframe_support = 'This brawser not suppot iframe';
    public $_lang_not_js_support     = 'This brawser not suppot javascrip';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_api_html constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_WEBMAP3_DIRNAME = $dirname;

        $this->_dirname = $dirname;

        $this->_display_iframe_url = XOOPS_URL . '/modules/' . $dirname . '/index.php?fct=get_location';
        $this->_display_src        = XOOPS_URL . '/modules/' . $dirname . '/images/google_maps.png';
        $this->_display_url_opener = XOOPS_URL . '/modules/' . $dirname . '/index.php?fct=get_location&mode=opener';
        $this->_display_url_desc   = $this->_display_url_opener;

        $this->_form_class      = webmap3_lib_form::getInstance();
        $this->_multibyte_class = webmap3_lib_multibyte::getInstance();
        $this->_header_class    = webmap3_xoops_header::getSingleton($dirname);
        $this->_language_class  = webmap3_d3_language::getSingleton($dirname);

        $this->_map_div_id = $dirname . '_map_get_location';
        $this->_map_func   = $dirname . '_load_map_get_location';

        $this->_map_ele_id_list             = $dirname . '_map_list';
        $this->_map_ele_id_search           = $dirname . '_map_search';
        $this->_map_ele_id_current_location = $dirname . '_map_current_location';
        $this->_map_ele_id_current_address  = $dirname . '_map_current_address';

        $this->_template_display_style_js  = 'db:' . $dirname . '_inc_display_style_js.tpl';
        $this->_template_display_html_js   = 'db:' . $dirname . '_inc_display_html_js.tpl';
        $this->_template_set_location_form = 'db:' . $dirname . '_inc_set_location_form.tpl';
        $this->_template_get_location      = 'db:' . $dirname . '_inc_get_location.tpl';

        $this->_lang_latitude           = $this->get_lang('LATITUDE');
        $this->_lang_longitude          = $this->get_lang('LONGITUDE');
        $this->_lang_zoom               = $this->get_lang('ZOOM');
        $this->_lang_search             = $this->get_lang('SEARCH');
        $this->_lang_search_reverse     = $this->get_lang('SEARCH_REVERSE');
        $this->_lang_search_list        = $this->get_lang('SEARCH_LIST');
        $this->_lang_zoom               = $this->get_lang('ZOOM');
        $this->_lang_get_location       = $this->get_lang('GET_LOCATION');
        $this->_lang_get_address        = $this->get_lang('GET_ADDRESS');
        $this->_lang_display_desc       = $this->get_lang('DISPLAY_DESC');
        $this->_lang_display_new        = $this->get_lang('DISPLAY_NEW');
        $this->_lang_display_popup      = $this->get_lang('DISPLAY_POPUP');
        $this->_lang_display_inline     = $this->get_lang('DISPLAY_INLINE');
        $this->_lang_display_hide       = $this->get_lang('DISPLAY_HIDE');
        $this->_lang_edit               = _EDIT;
        $this->_lang_close              = _CLOSE;
        $this->_lang_title_set_location = $this->get_lang('TITLE_SET_LOCATION');
        $this->_lang_title_get_location = $this->get_lang('TITLE_GET_LOCATION');
        $this->_lang_current_location   = $this->get_lang('CURRENT_LOCATION');
        $this->_lang_current_address    = $this->get_lang('CURRENT_ADDRESS');
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
    // function
    //---------------------------------------------------------
    public function header_content_type()
    {
        header('Content-Type:text/html; charset=UTF-8');
    }

    /**
     * @return string
     */
    public function build_display_iframe()
    {
        $text = '<iframe src="' . $this->sanitize($this->_display_iframe_url) . '" ';
        $text .= 'width="' . $this->sanitize($this->_display_iframe_width) . '" ';
        $text .= 'height="' . $this->sanitize($this->_display_iframe_height) . '" ';
        $text .= 'frameborder="0" scrolling="yes" >';
        $text .= "\n";
        $text .= $this->_lang_not_iframe_support;
        $text .= '</iframe>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_anchor()
    {
        $text = '<a name="' . $this->_display_anchor . '"></a>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_logo()
    {
        $src_s = $this->sanitize($this->_display_src);

        $text = '<img src="' . $src_s . '" border="0" alt="google map" >';
        $text .= "\n";

        return $text;
    }

    /**
     * @return mixed|string
     */
    public function build_display_desc()
    {
        $text = $this->_lang_display_desc;
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_new()
    {
        $href = $this->sanitize($this->_display_url_opener);

        $text = '<a href="' . $href . '" target="_blank">';
        $text .= "\n";
        $text .= $this->_lang_display_new;
        $text .= '</a>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_popup()
    {
        $text = '<a href="#' . $this->_display_anchor . '" ';
        $text .= 'onclick="' . $this->_display_func_popup . '()">';
        $text .= "\n";
        $text .= $this->_lang_display_popup;
        $text .= '</a>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_style_show()
    {
        return $this->build_display_show($this->_display_func_style_show);
    }

    /**
     * @return string
     */
    public function build_display_style_hide()
    {
        return $this->build_display_hide($this->_display_func_style_hide);
    }

    /**
     * @return string
     */
    public function build_display_html_show()
    {
        return $this->build_display_show($this->_display_func_html_show);
    }

    /**
     * @return string
     */
    public function build_display_html_hide()
    {
        return $this->build_display_hide($this->_display_func_html_hide);
    }

    /**
     * @param $func
     * @return string
     */
    public function build_display_show($func)
    {
        $text = '<a href="#' . $this->_display_anchor . '" ';
        $text .= 'onclick="' . $func . '()">';
        $text .= "\n";
        $text .= $this->_lang_display_inline;
        $text .= '</a>';
        $text .= "\n";

        return $text;
    }

    /**
     * @param $func
     * @return string
     */
    public function build_display_hide($func)
    {
        $text = '<a href="#' . $this->_display_anchor . '" ';
        $text .= 'onclick="' . $func . '()">';
        $text .= "\n";
        $text .= $this->_lang_display_hide;
        $text .= '</a>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_div_style_begin()
    {
        $text = '<div ';
        $text .= 'id="' . $this->_display_div_id . '" ';
        $text .= 'style="' . $this->_display_div_style . '">';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_div_begin()
    {
        $text = '<div ';
        $text .= 'id="' . $this->_display_div_id . '">';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_display_div_end()
    {
        $text = '</div>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_gicon_icon()
    {
        $icon = '';
        if (isset($this->_gicon_options[$this->_gicon_id])) {
            $icon = $this->_gicon_options[$this->_gicon_id];
        }
        $icon_s = $this->sanitize($icon);

        return $icon_s;
    }

    /**
     * @return string
     */
    public function build_gicon_select()
    {
        $options = $this->_form_class->build_form_select_options($this->_gicon_id, $this->_gicon_options);

        $text = '<select ';
        $text .= 'id="' . $this->_gicon_select_id . '" ';
        $text .= 'name="' . $this->_gicon_select_name . '" ';
        $text .= 'onChange="';
        $text .= $this->_gicon_select_func;
        $text .= '(this,';
        $text .= "'" . $this->_gicon_img_id . "'";
        $text .= ')">';
        $text .= "\n";
        $text .= $options;
        $text .= "\n";
        $text .= '</select>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return string
     */
    public function build_gicon_img()
    {
        $src_s  = $this->sanitize($this->_gicon_img_src);
        $alt_s  = $this->sanitize($this->_gicon_img_alt);
        $border = (int)$this->_gicon_img_border;

        $text = '<img ';
        $text .= 'id="' . $this->_gicon_img_id . '" ';
        $text .= 'src="' . $src_s . '" ';
        $text .= 'alt="' . $alt_s . '" ';
        $text .= 'border="' . $border . '" ';
        $text .= '>';
        $text .= "\n";

        return $text;
    }

    /**
     * @return mixed|string|void
     */
    public function build_display_style_js()
    {
        $param = $this->build_param_display_js();

        $tpl = new XoopsTpl();
        $tpl->assign($param);

        return $tpl->fetch($this->_template_display_style_js);
    }

    /**
     * @return mixed|string|void
     */
    public function build_display_html_js()
    {
        $param = $this->build_param_display_js();

        $tpl = new XoopsTpl();
        $tpl->assign($param);

        return $tpl->fetch($this->_template_display_html_js);
    }

    /**
     * @return mixed|string|void
     */
    public function build_set_location()
    {
        $param = $this->build_param_set_location();

        $tpl = new XoopsTpl();
        $tpl->assign($param);

        return $tpl->fetch($this->_template_set_location_form);
    }

    /**
     * @param $param
     * @return mixed|string|void
     */
    public function fetch_get_location($param)
    {
        $tpl = new XoopsTpl();
        $tpl->assign($param);

        return $tpl->fetch($this->_template_get_location);
    }

    /**
     * @return array
     */
    public function build_param_display_js()
    {
        $arr = [
            'func_popup'      => $this->_display_func_popup,
            'func_style_show' => $this->_display_func_style_show,
            'func_style_hide' => $this->_display_func_style_hide,
            'open_url'        => $this->_display_url_opener,
            'open_name'       => $this->_display_open_name,
            'open_width'      => $this->_display_open_width,
            'open_height'     => $this->_display_open_height,
            'div_id'          => $this->_display_div_id,

            // innerHTML
            'func_html_show'  => $this->_display_func_html_show,
            'func_html_hide'  => $this->_display_func_html_hide,
            'ancher'          => $this->_display_anchor,
            'iframe_url'      => $this->_display_iframe_url,
            'iframe_width'    => $this->_display_iframe_width,
            'iframe_height'   => $this->_display_iframe_height,
            'lang_hide'       => $this->_lang_display_hide,
        ];

        return $arr;
    }

    /**
     * @return array
     */
    public function build_param_set_location()
    {
        $arr = [
            'dirname'        => $this->_dirname,
            'ticket'         => $this->_ticket,
            'latitude'       => $this->_latitude,
            'longitude'      => $this->_longitude,
            'zoom'           => $this->_zoom,
            'id_latitude'    => $this->_id_latitude,
            'id_longitude'   => $this->_id_longitude,
            'id_zoom'        => $this->_id_zoom,
            'name_latitude'  => $this->_name_latitude,
            'name_longitude' => $this->_name_longitude,
            'name_zoom'      => $this->_name_zoom,
            'lang_title'     => $this->_lang_title_set_location,
            'lang_latitude'  => $this->_lang_latitude,
            'lang_longitude' => $this->_lang_longitude,
            'lang_zoom'      => $this->_lang_zoom,
            'lang_edit'      => $this->_lang_edit,
        ];

        return $arr;
    }

    /**
     * @return array
     */
    public function build_param_get_location()
    {
        $map_style = 'width:' . $this->_map_width . '; ';
        $map_style .= 'height:' . $this->_map_height . '; ';
        $map_style .= $this->_map_style_option;

        $arr = [
            'webmap3_dirname' => $this->_WEBMAP3_DIRNAME,
            'map_div_id'      => $this->_map_div_id,
            'map_func'        => $this->_map_func,

            'head_js'       => $this->_head_js,
            'map_style'     => $map_style,
            'func_hide_map' => $this->_display_func_style_hide,
            'address'       => $this->_address,

            'ele_id_list'             => $this->_map_ele_id_list,
            'ele_id_search'           => $this->_map_ele_id_search,
            'ele_id_current_location' => $this->_map_ele_id_current_location,
            'ele_id_current_address'  => $this->_map_ele_id_current_address,

            'show_close'           => $this->_show_close,
            'show_hide_map'        => $this->_show_hide_map,
            'show_set_address'     => $this->_show_set_address,
            'show_search_reverse'  => $this->_show_search_reverse,
            'show_current_address' => $this->_show_current_address,

            'lang_title'            => $this->_lang_title_get_location,
            'lang_search'           => $this->_lang_search,
            'lang_search_reverse'   => $this->_lang_search_reverse,
            'lang_search_list'      => $this->_lang_search_list,
            'lang_get_location'     => $this->_lang_get_location,
            'lang_get_address'      => $this->_lang_get_address,
            'lang_display_hide'     => $this->_lang_display_hide,
            'lang_close'            => $this->_lang_close,
            'lang_current_address'  => $this->_lang_current_address,
            'lang_current_location' => $this->_lang_current_location,
            'lang_not_js_support'   => $this->_lang_not_js_support,
        ];

        $ret = $this->utf8_array($arr);

        return $ret;
    }

    //---------------------------------------------------------
    // utility
    //---------------------------------------------------------

    /**
     * @param $str
     * @return string
     */
    public function sanitize($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    //---------------------------------------------------------
    // language
    //---------------------------------------------------------

    /**
     * @param $name
     * @return mixed
     */
    public function get_lang($name)
    {
        return $this->_language_class->get_constant($name);
    }

    /**
     * @param $arr
     * @return array
     */
    public function utf8_array($arr)
    {
        $ret = [];
        foreach ($arr as $k => $v) {
            $ret[$k] = $this->utf8($v);
        }

        return $ret;
    }

    //---------------------------------------------------------
    // multibyte
    //---------------------------------------------------------

    /**
     * @param string $encoding
     * @return bool|string
     */
    public function http_output($encoding = 'pass')
    {
        return $this->_multibyte_class->m_mb_http_output($encoding);
    }

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function utf8($str)
    {
        return $this->_multibyte_class->convert_to_utf8($str);
    }

    //---------------------------------------------------------
    // header
    //---------------------------------------------------------

    /**
     * @param $var
     */
    public function assign_to_header($var)
    {
        $this->_header_class->assign_xoops_module_header($var);
    }

    //---------------------------------------------------------
    // setter
    //---------------------------------------------------------

    /**
     * @param $v
     */
    public function set_dirname($v)
    {
        $this->_dirname = $v;
    }

    /**
     * @param $v
     */
    public function set_template($v)
    {
        $this->_template = $v;
    }

    /**
     * @param $v
     */
    public function set_latitude($v)
    {
        $this->_latitude = (float)$v;
    }

    /**
     * @param $v
     */
    public function set_longitude($v)
    {
        $this->_longitude = (float)$v;
    }

    /**
     * @param $v
     */
    public function set_zoom($v)
    {
        $this->_zoom = (int)$v;
    }

    /**
     * @param $v
     */
    public function set_address($v)
    {
        $this->_address = $v;
    }

    /**
     * @param $v
     */
    public function set_ticket($v)
    {
        $this->_ticket = $v;
    }

    /**
     * @param $v
     */
    public function set_display_iframe_url($v)
    {
        $this->_display_iframe_url = $v;
    }

    /**
     * @param        $v
     * @param string $u
     */
    public function set_display_iframe_width($v, $u = 'px')
    {
        $this->_display_iframe_width = (int)$v . $u;
    }

    /**
     * @param        $v
     * @param string $u
     */
    public function set_display_iframe_height($v, $u = 'px')
    {
        $this->_display_iframe_height = (int)$v . $u;
    }

    /**
     * @param $v
     */
    public function set_display_anchor($v)
    {
        $this->_display_anchor = $v;
    }

    /**
     * @param $v
     */
    public function set_display_url_opener($v)
    {
        $this->_display_url_opener = $v;
    }

    /**
     * @param $v
     */
    public function set_display_func_inline($v)
    {
        $this->_display_func_inline = $v;
    }

    /**
     * @param $v
     */
    public function set_display_func_popup($v)
    {
        $this->_display_func_popup = $v;
    }

    /**
     * @param $v
     */
    public function set_display_func_hide($v)
    {
        $this->_display_func_hide = $v;
    }

    /**
     * @param $v
     */
    public function set_display_open_name($v)
    {
        $this->_display_open_name = $v;
    }

    /**
     * @param $v
     */
    public function set_display_open_width($v)
    {
        $this->_display_open_width = (int)$v;
    }

    /**
     * @param $v
     */
    public function set_display_open_height($v)
    {
        $this->_display_open_height = (int)$v;
    }

    /**
     * @param $v
     */
    public function set_display_div_id($v)
    {
        $this->_display_div_id = $v;
    }

    /**
     * @param $v
     */
    public function set_display_div_style($v)
    {
        $this->_display_div_style = $v;
    }

    /**
     * @param $v
     */
    public function set_gicon_select_id($v)
    {
        $this->_gicon_select_id = $v;
    }

    /**
     * @param $v
     */
    public function set_gicon_select_name($v)
    {
        $this->_gicon_select_name = $v;
    }

    /**
     * @param $v
     */
    public function set_gicon_img_id($v)
    {
        $this->_gicon_img_id = $v;
    }

    /**
     * @param $v
     */
    public function set_gicon_img_src($v)
    {
        $this->_gicon_img_src = $v;
    }

    /**
     * @param $v
     */
    public function set_gicon_img_alt($v)
    {
        $this->_gicon_img_alt = $v;
    }

    /**
     * @param $v
     */
    public function set_gicon_img_border($v)
    {
        $this->_gicon_img_border = (int)$v;
    }

    /**
     * @param $v
     */
    public function set_gicon_id($v)
    {
        $this->_gicon_id = (int)$v;
    }

    /**
     * @param $v
     */
    public function set_gicon_options($v)
    {
        $this->_gicon_options = $v;
    }

    /**
     * @param $v
     */
    public function set_head_js($v)
    {
        $this->_head_js = $v;
    }

    /**
     * @param $v
     */
    public function set_map_js($v)
    {
        $this->_map_js = $v;
    }

    /**
     * @param $v
     */
    public function set_map_style_option($v)
    {
        $this->_map_style_option = $v;
    }

    /**
     * @param        $v
     * @param string $u
     */
    public function set_map_width($v, $u = 'px')
    {
        $this->_map_width = (int)$v . $u;
    }

    /**
     * @param        $v
     * @param string $u
     */
    public function set_map_height($v, $u = 'px')
    {
        $this->_map_height = (int)$v . $u;
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
     * @param $v
     */
    public function set_map_ele_id_list($v)
    {
        $this->_map_ele_id_list = $v;
    }

    /**
     * @param $v
     */
    public function set_map_ele_id_search($v)
    {
        $this->_map_ele_id_search = $v;
    }

    /**
     * @param $v
     */
    public function set_map_ele_id_current_location($v)
    {
        $this->_map_ele_id_current_location = $v;
    }

    /**
     * @param $v
     */
    public function set_map_ele_id_current_address($v)
    {
        $this->_map_ele_id_current_address = $v;
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
    public function set_show_close($v)
    {
        $this->_show_close = (bool)$v;
    }

    /**
     * @param $v
     */
    public function set_show_hide_map($v)
    {
        $this->_show_hide_map = (bool)$v;
    }

    /**
     * @param $v
     */
    public function set_show_search_reverse($v)
    {
        $this->_show_search_reverse = (bool)$v;
    }

    /**
     * @param $v
     */
    public function set_show_current_address($v)
    {
        $this->_show_current_address = (bool)$v;
    }

    /**
     * @param $v
     */
    public function set_template_display_style_js($v)
    {
        $this->_template_display_style_js = $v;
    }

    /**
     * @param $v
     */
    public function set_template_display_html_js($v)
    {
        $this->_template_display_html_js = $v;
    }

    /**
     * @param $v
     */
    public function set_template_set_location_form($v)
    {
        $this->_template_set_location_form = $v;
    }

    /**
     * @param $v
     */
    public function set_template_get_location($v)
    {
        $this->_template_get_location = $v;
    }

    /**
     * @param $v
     */
    public function set_lang_latitude($v)
    {
        $this->_lang_latitude = $v;
    }

    /**
     * @param $v
     */
    public function set_lang_longitude($v)
    {
        $this->_lang_longitude = $v;
    }

    /**
     * @param $v
     */
    public function set_lang_zoom($v)
    {
        $this->_lang_zoom = $v;
    }

    /**
     * @param $v
     */
    public function set_lang_title_set_location($v)
    {
        $this->_lang_title_set_location = $v;
    }

    /**
     * @param $v
     */
    public function set_lang_edit($v)
    {
        $this->_lang_edit = $v;
    }

    /**
     * @param $v
     */
    public function set_lang_not_iframe_support($v)
    {
        $this->_lang_not_iframe_support = $v;
    }

    public function set_lang_title_get_location()
    {
        $this->_lang_title_get_location = $v;
    }

    public function set_lang_search()
    {
        $this->_lang_search = $v;
    }

    public function set_lang_search_reverse()
    {
        $this->_lang_search_reverse = $v;
    }

    public function set_lang_search_list()
    {
        $this->_lang_search_list = $v;
    }

    public function set_lang_get_location()
    {
        $this->_lang_get_location = $v;
    }

    public function set_lang_display_hide()
    {
        $this->_lang_display_hide = $v;
    }

    public function set_lang_current_location()
    {
        $this->_lang_current_location = $v;
    }

    public function set_lang_display_desc()
    {
        $this->_lang_display_desc = $v;
    }

    public function set_lang_display_new()
    {
        $this->_lang_display_new = $v;
    }

    public function set_lang_display_inline()
    {
        $this->_lang_display_inline = $v;
    }

    // --- class end ---
}
