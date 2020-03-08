<?php
// $Id: base.php,v 1.1 2012/04/09 11:55:33 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-04-02 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_view_base
//=========================================================

/**
 * Class webmap3_view_base
 */
class webmap3_view_base
{
    public $_xoops_param;
    public $_language_class;
    public $_header_class;

    public $_DIRNAME;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_view_base constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_DIRNAME        = $dirname;
        $this->_xoops_param    = webmap3_xoops_param::getInstance();
        $this->_language_class = webmap3_d3_language::getSingleton($dirname);
        $this->_header_class   = webmap3_xoops_header::getSingleton($dirname);
    }

    //---------------------------------------------------------
    // main
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function build_base()
    {
        $this->_header_class->assign_or_get_default_css(true);

        $arr = [
            'xoops_dirname'   => $this->_DIRNAME,
            'mydirname'       => $this->_DIRNAME,
            'module_name'     => $this->_xoops_param->get_module_name(),
            'is_module_admin' => $this->_xoops_param->is_module_admin(),

            'lang_title_search'         => $this->get_lang('TITLE_SEARCH'),
            'lang_title_search_desc'    => $this->get_lang('TITLE_SEARCH_DESC'),
            'lang_title_location'       => $this->get_lang('TITLE_LOCATION'),
            'lang_title_location_desc'  => $this->get_lang('TITLE_LOCATION_DESC'),
            'lang_title_georss'         => $this->get_lang('TITLE_GEORSS'),
            'lang_title_geocoding'      => $this->get_lang('TITLE_GEOCODING'),
            'lang_title_geocoding_desc' => $this->get_lang('TITLE_GEOCODING_DESC'),
            'lang_title_get_location'   => $this->get_lang('TITLE_GET_LOCATION'),
            'lang_title_demo'           => $this->get_lang('TITLE_DEMO'),
            'lang_search'               => $this->get_lang('SEARCH'),
            'lang_search_list'          => $this->get_lang('SEARCH_LIST'),
            'lang_current_location'     => $this->get_lang('CURRENT_LOCATION'),
            'lang_current_address'      => $this->get_lang('CURRENT_ADDRESS'),
            'lang_no_match_place'       => $this->get_lang('NO_MATCH_PLACE'),
            'lang_address'              => $this->get_lang('ADDRESS'),
            'lang_latitude'             => $this->get_lang('LATITUDE'),
            'lang_longitude'            => $this->get_lang('LONGITUDE'),
            'lang_zoom'                 => $this->get_lang('ZOOM'),
            'lang_js_invalid'           => $this->get_lang('JS_INVALID'),
            'lang_not_compatible'       => $this->get_lang('NOT_COMPATIBLE'),
            'lang_download_kml'         => $this->get_lang('DOWNLOAD_KML'),
            'lang_get_location'         => $this->get_lang('GET_LOCATION'),
            'lang_look_google_map'      => $this->get_lang('LOOK_GOOGLE_MAP'),
        ];

        return $arr;
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
    // config
    //---------------------------------------------------------

    /**
     * @param $name
     */
    public function get_config($name)
    {
        return $this->_xoops_param->get_module_config_by_name($name);
    }

    /**
     * @param $name
     * @return mixed|null|string
     */
    public function get_config_text($name)
    {
        return $this->_xoops_param->get_module_config_text_by_name($name);
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

    // --- class end ---
}
