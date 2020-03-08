<?php
// $Id: kml.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_main_kml
//=========================================================

/**
 * Class webmap3_main_kml
 */
class webmap3_main_kml
{
    public $_builder;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_main_kml constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $this->_builder = webmap3_view_kml::getInstance($dirname);
    }

    /**
     * @param null $dirname
     * @return \webmap3_main_kml
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
        $this->_builder->build_webmap3_kml();
    }

    // --- class end ---
}
