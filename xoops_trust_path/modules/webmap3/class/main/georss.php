<?php
// $Id: georss.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

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
// class webmap3_main_georss
//=========================================================

/**
 * Class webmap3_main_georss
 */
class webmap3_main_georss extends webmap3_view_map
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_main_georss constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        parent::__construct($dirname);
    }

    /**
     * @param null $dirname
     * @return \webmap3_main_georss
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

    /**
     * @return array
     */
    public function main()
    {
        $param                = $this->build_main();
        $param['geo_url_s']   = $this->get_config_text('geo_url', 's');
        $param['geo_title_s'] = $this->get_config_text('geo_title', 's');

        $this->build_map();

        return $param;
    }

    public function build_map()
    {
        $this->init_map();
        $param = $this->_map_class->build_geoxml($this->get_config_text('geo_url'), true);
        $this->_map_class->fetch_geoxml_head($param);
    }

    // --- class end ---
}
