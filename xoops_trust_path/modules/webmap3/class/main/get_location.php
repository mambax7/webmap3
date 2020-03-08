<?php
// $Id: get_location.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// webmap3_api_get_location

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//---------------------------------------------------------
// myself:     default
// new window: mode=opener
// inline:     mode=parent
//---------------------------------------------------------

//=========================================================
// class webmap3_main_get_location
//=========================================================

/**
 * Class webmap3_main_get_location
 */
class webmap3_main_get_location
{
    public $_xoops_param;
    public $_api_class;

    // config field
    public $_ELE_ID_PARENT_LATITUDE  = 'webmap3_latitude';
    public $_ELE_ID_PARENT_LONGITUDE = 'webmap3_longitude';
    public $_ELE_ID_PARENT_ZOOM      = 'webmap3_zoom';
    public $_ELE_ID_PARENT_ADDRESS   = 'webmap3_address';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_main_get_location constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_xoops_param = webmap3_xoops_param::getInstance();
        $this->_api_class   = webmap3_api_get_location::getSingleton($dirname);
    }

    /**
     * @param null $dirname
     * @return \webmap3_main_get_location
     */
    public static function getInstance($dirname = null)
    {
        static $instance;
        if (null === $instance) {
            $instance = new self($dirname);
        }

        return $instance;
    }

    //---------------------------------------------------------
    // main
    //---------------------------------------------------------
    public function main()
    {
        $this->_api_class->set_map_type_control($this->get_config('map_type_control'));
        $this->_api_class->set_zoom_control($this->get_config('zoom_control'));
        $this->_api_class->set_pan_control($this->get_config('pan_control'));
        $this->_api_class->set_street_view_control($this->get_config('street_view_control'));
        $this->_api_class->set_scale_control($this->get_config('scale_control'));
        $this->_api_class->set_overview_map_control($this->get_config('overview_map_control'));
        $this->_api_class->set_overview_map_control_opened($this->get_config('overview_map_opened'));
        $this->_api_class->set_map_type_control_style($this->get_config('map_type_control_style'));
        $this->_api_class->set_zoom_control_style($this->get_config('zoom_control_style'));
        $this->_api_class->set_map_type($this->get_config('map_type'));

        $this->_api_class->set_latitude($this->get_config('latitude'));
        $this->_api_class->set_longitude($this->get_config('longitude'));
        $this->_api_class->set_zoom($this->get_config('zoom'));
        $this->_api_class->set_address($this->get_config('address'));

        $this->_api_class->set_ele_id_parent_latitude($this->_ELE_ID_PARENT_LATITUDE);
        $this->_api_class->set_ele_id_parent_longitude($this->_ELE_ID_PARENT_LONGITUDE);
        $this->_api_class->set_ele_id_parent_zoom($this->_ELE_ID_PARENT_ZOOM);
        $this->_api_class->set_ele_id_parent_address($this->_ELE_ID_PARENT_ADDRESS);

        $this->_api_class->display_get_location();
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

    // --- class end ---
}
