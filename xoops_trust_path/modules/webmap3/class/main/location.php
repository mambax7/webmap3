<?php
// $Id: location.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// changed build_map()

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_main_location
//=========================================================
class webmap3_main_location extends webmap3_view_map
{

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct($dirname);
    }

    public static function getInstance($dirname = null)
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_main_location($dirname);
        }
        return $instance;
    }

    //---------------------------------------------------------
    // main
    //---------------------------------------------------------
    public function main()
    {
        $param              = $this->build_main();
        $param['address_s'] = $this->get_config_text('address', 's');
        $param['latitude']  = $this->get_config('latitude');
        $param['longitude'] = $this->get_config('longitude');
        $param['zoom']      = $this->get_config('zoom');

        $this->build_map();

        return $param;
    }

    public function build_map()
    {
        $marker = array(
            'latitude'  => $this->get_config('latitude'),
            'longitude' => $this->get_config('longitude'),
            'info'      => $this->get_config_text('loc_marker_info', 'textarea'),
            'icon_id'   => $this->get_config('marker_gicon'),
        );

        $markers = array($marker);

        $this->init_map();
        $this->_map_class->assign_gicon_array_to_head();

        $param = $this->_map_class->build_markers($markers);
        $this->_map_class->fetch_markers_head($param);
    }

    // --- class end ---
}
