<?php
// $Id: xoops_version.php,v 1.3 2012/04/10 00:15:02 ohwada Exp $

// 2012-04-02 K.OHWADA
// region

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_inc_xoops_version
//=========================================================

/**
 * Class webmap3_inc_xoops_version
 */
class webmap3_inc_xoops_version extends webmap3_inc_xoops_version_base
{
    public $_HAS_MAIN      = true;
    public $_HAS_ADMIN     = true;
    public $_HAS_CONFIG    = true;
    public $_HAS_ONINSATLL = true;
    public $_HAS_BLOCKS    = true;

    public $_CFG_ADDRESS         = _C_WEBMAP3_CFG_ADDRESS;
    public $_CFG_LATITUDE        = _C_WEBMAP3_CFG_LATITUDE;
    public $_CFG_LONGITUDE       = _C_WEBMAP3_CFG_LONGITUDE;
    public $_CFG_ZOOM            = _C_WEBMAP3_CFG_ZOOM;
    public $_CFG_LOC_MARKER_INFO = _C_WEBMAP3_CFG_LOC_MARKER_INFO;
    public $_CFG_GEO_URL         = _C_WEBMAP3_CFG_GEO_URL;
    public $_CFG_GEO_TITLE       = _C_WEBMAP3_CFG_GEO_TITLE;
    public $_CFG_GICON_FSIZE     = _C_WEBMAP3_CFG_GICON_FSIZE;
    public $_CFG_GICON_WIDTH     = _C_WEBMAP3_CFG_GICON_WIDTH;
    public $_CFG_GICON_QUALITY   = _C_WEBMAP3_CFG_GICON_QUALITY;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_inc_xoops_version constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        parent::__construct($dirname);
        $this->_CFG_GICON_PATH = 'uploads/' . $dirname;
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

    /**
     * @return array
     */
    public function modversion()
    {
        return $this->build_modversion();
    }

    /**
     * @return null|string
     */
    public function get_version()
    {
        return _C_WEBMAP3_VERSION;
    }

    //---------------------------------------------------------
    // Config Settings
    //---------------------------------------------------------

    /**
     * @return array|void
     */
    public function build_config()
    {
        $arr = [];

        $arr[] = [
            'name'        => 'map_type_control',
            'title'       => $this->lang_name('CFG_MAP_TYPE_CONTROL'),
            'description' => $this->lang_name('CFG_MAP_TYPE_CONTROL_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'map_type_control_style',
            'title'       => $this->lang_name('CFG_MAP_TYPE_CONTROL_STYLE'),
            'description' => $this->lang_name('CFG_MAP_TYPE_CONTROL_STYLE_DSC'),
            'formtype'    => 'select',
            'valuetype'   => 'text',
            'default'     => 'default',
            'options'     => [
                $this->lang_name('OPT_MAP_TYPE_CONTROL_STYLE_DEFAULT')    => 'default',
                $this->lang_name('OPT_MAP_TYPE_CONTROL_STYLE_HORIZONTAL') => 'horizontal',
                $this->lang_name('OPT_MAP_TYPE_CONTROL_STYLE_DROPDOWN')   => 'dropdown',
            ],
        ];

        $arr[] = [
            'name'        => 'map_type',
            'title'       => $this->lang_name('CFG_MAP_TYPE'),
            'description' => $this->lang_name('CFG_MAP_TYPE_DSC'),
            'formtype'    => 'select',
            'valuetype'   => 'text',
            'default'     => 'roadmap',
            'options'     => [
                $this->lang_name('OPT_MAP_TYPE_ROADMAP')   => 'roadmap',
                $this->lang_name('OPT_MAP_TYPE_SATELLITE') => 'satellite',
                $this->lang_name('OPT_MAP_TYPE_HYBRID')    => 'hybrid',
                $this->lang_name('OPT_MAP_TYPE_TERRAIN')   => 'terrain',
            ],
        ];

        $arr[] = [
            'name'        => 'zoom_control',
            'title'       => $this->lang_name('CFG_ZOOM_CONTROL'),
            'description' => $this->lang_name('CFG_ZOOM_CONTROL_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'zoom_control_style',
            'title'       => $this->lang_name('CFG_ZOOM_CONTROL_STYLE'),
            'description' => $this->lang_name('CFG_ZOOM_CONTROL_STYLE_DSC'),
            'formtype'    => 'select',
            'valuetype'   => 'text',
            'default'     => 'default',
            'options'     => [
                $this->lang_name('OPT_ZOOM_CONTROL_STYLE_DEFAULT') => 'default',
                $this->lang_name('OPT_ZOOM_CONTROL_STYLE_SMALL')   => 'small',
                $this->lang_name('OPT_ZOOM_CONTROL_STYLE_LARGE')   => 'large',
            ],
        ];

        $arr[] = [
            'name'        => 'overview_map_control',
            'title'       => $this->lang_name('CFG_OVERVIEW_MAP_CONTROL'),
            'description' => $this->lang_name('CFG_OVERVIEW_MAP_CONTROL_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '0',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'overview_map_opened',
            'title'       => $this->lang_name('CFG_OVERVIEW_MAP_CONTROL_OPENED'),
            'description' => $this->lang_name('CFG_OVERVIEW_MAP_CONTROL_OPENED_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '0',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'pan_control',
            'title'       => $this->lang_name('CFG_PAN_CONTROL'),
            'description' => $this->lang_name('CFG_PAN_CONTROL_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'street_view_control',
            'title'       => $this->lang_name('CFG_STREET_VIEW_CONTROL'),
            'description' => $this->lang_name('CFG_STREET_VIEW_CONTROL_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'scale_control',
            'title'       => $this->lang_name('CFG_SCALE_CONTROL'),
            'description' => $this->lang_name('CFG_SCALE_CONTROL_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '0',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'use_draggable_marker',
            'title'       => $this->lang_name('CFG_USE_DRAGGABLE_MARKER'),
            'description' => $this->lang_name('CFG_USE_DRAGGABLE_MARKER_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'use_search_marker',
            'title'       => $this->lang_name('CFG_USE_SEARCH_MARKER'),
            'description' => $this->lang_name('CFG_USE_SEARCH_MARKER_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'use_loc_marker',
            'title'       => $this->lang_name('CFG_USE_LOC_MARKER'),
            'description' => $this->lang_name('CFG_USE_LOC_MARKER_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'use_loc_marker_click',
            'title'       => $this->lang_name('CFG_USE_LOC_MARKER_CLICK'),
            'description' => $this->lang_name('CFG_USE_LOC_MARKER_CLICK_DSC'),
            'formtype'    => 'yesno',
            'valuetype'   => 'int',
            'default'     => '1',
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'loc_marker_info',
            'title'       => $this->lang_name('CFG_LOC_MARKER_INFO'),
            'description' => $this->lang_name('CFG_LOC_MARKER_INFO_DSC'),
            'formtype'    => 'textarea',
            'valuetype'   => 'other',
            'default'     => $this->_CFG_LOC_MARKER_INFO,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'geo_url',
            'title'       => $this->lang_name('CFG_GEO_URL'),
            'description' => $this->lang_name('CFG_GEO_URL_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'text',
            'default'     => $this->_CFG_GEO_URL,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'geo_title',
            'title'       => $this->lang_name('CFG_GEO_TITLE'),
            'description' => $this->lang_name('CFG_GEO_TITLE_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'text',
            'default'     => $this->_CFG_GEO_TITLE,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'gicon_path',
            'title'       => $this->lang_name('CFG_GICON_PATH'),
            'description' => $this->lang_name('CFG_GICON_PATH_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'text',
            'default'     => $this->_CFG_GICON_PATH,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'gicon_fsize',
            'title'       => $this->lang_name('CFG_GICON_FSIZE'),
            'description' => $this->lang_name('CFG_GICON_FSIZE_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'int',
            'default'     => $this->_CFG_GICON_FSIZE,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'gicon_width',
            'title'       => $this->lang_name('CFG_GICON_WIDTH'),
            'description' => $this->lang_name('CFG_GICON_WIDTH_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'int',
            'default'     => $this->_CFG_GICON_WIDTH,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'gicon_quality',
            'title'       => $this->lang_name('CFG_GICON_QUALITY'),
            'description' => $this->lang_name('CFG_GICON_QUALITY_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'int',
            'default'     => $this->_CFG_GICON_QUALITY,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'language',
            'title'       => $this->lang_name('CFG_LANGUAGE'),
            'description' => $this->lang_name('CFG_LANGUAGE_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'text',
            'default'     => _LANGCODE,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'region',
            'title'       => $this->lang_name('CFG_REGION'),
            'description' => $this->lang_name('CFG_REGION_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'text',
            'default'     => $this->locate('REGION'),
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'address',
            'title'       => $this->lang_name('CFG_ADDRESS'),
            'description' => $this->lang_name('CFG_CONFIG_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'text',
            'default'     => $this->_CFG_ADDRESS,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'latitude',
            'title'       => $this->lang_name('CFG_LATITUDE'),
            'description' => $this->lang_name('CFG_CONFIG_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'float',
            'default'     => $this->_CFG_LATITUDE,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'longitude',
            'title'       => $this->lang_name('CFG_LONGITUDE'),
            'description' => $this->lang_name('CFG_CONFIG_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'float',
            'default'     => $this->_CFG_LONGITUDE,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'zoom',
            'title'       => $this->lang_name('CFG_ZOOM'),
            'description' => $this->lang_name('CFG_CONFIG_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'int',
            'default'     => $this->_CFG_ZOOM,
            'options'     => [],
        ];

        $arr[] = [
            'name'        => 'marker_gicon',
            'title'       => $this->lang_name('CFG_MARKER_GICON'),
            'description' => $this->lang_name('CFG_CONFIG_DSC'),
            'formtype'    => 'textbox',
            'valuetype'   => 'int',
            'default'     => 0,
            'options'     => [],
        ];

        return $arr;
    }

    //---------------------------------------------------------
    // Blocks
    //---------------------------------------------------------

    /**
     * @return array|mixed|void
     */
    public function build_blocks()
    {
        $arr = [];

        $arr[1] = [
            'file'        => 'blocks.php',
            'name'        => $this->lang('BNAME_LOCATION') . ' (' . $this->_DIRNAME . ')',
            'description' => 'Shows map',
            'show_func'   => 'b_webmap3_location_show',
            'edit_func'   => 'b_webmap3_location_edit',
            'options'     => $this->_DIRNAME . '|300|1000',
            'template'    => '',
            'can_clone'   => true,
        ];

        // keep block's options
        if ($this->check_keep_blocks()) {
            $arr = $this->build_keep_blocks($arr);
        }

        return $arr;
    }

    //---------------------------------------------------------
    // locate
    //---------------------------------------------------------

    /**
     * @param $name
     * @return mixed
     */
    public function locate($name)
    {
        $constant_name = mb_strtoupper('_L_' . $this->_DIRNAME . '_' . $name);

        return constant($constant_name);
    }

    // --- class end ---
}
