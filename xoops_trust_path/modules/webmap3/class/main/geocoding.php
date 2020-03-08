<?php
// $Id: geocoding.php,v 1.2 2012/04/11 05:35:57 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-04-02 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_main_geocoding
//=========================================================

/**
 * Class webmap3_main_geocoding
 */
class webmap3_main_geocoding extends webmap3_view_base
{
    public $_api_class;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_main_geocoding constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        parent::__construct($dirname);
        $this->_api_class = webmap3_api_geocoding::getSingleton($dirname);
    }

    /**
     * @param null $dirname
     * @return \webmap3_main_geocoding
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
        $arr1                  = $this->build_base();
        $arr1['lang_language'] = $this->get_lang_modinfo('CFG_LANGUAGE');
        $arr1['lang_region']   = $this->get_lang_modinfo('CFG_REGION');
        $arr1['language_s']    = $this->get_config_text('language', 's');
        $arr1['region_s']      = $this->get_config_text('region', 's');

        if (isset($_GET['address'])) {
            $arr2 = $this->fetch($_GET['address']);
            $arr  = $arr1 + $arr2;
        } else {
            $arr = $arr1;
        }

        return $arr;
    }

    /**
     * @param $address
     * @return array
     */
    public function fetch($address)
    {
        $this->_api_class->set_search_address($address);
        $ret = $this->_api_class->fetch();
        if (!$ret) {
            $arr = [
                'address' => $address,
                'error'   => $this->_api_class->get_error(),
            ];

            return $arr;
        }

        $results = $this->_api_class->get_results();
        if (!is_array($results) || !count($results)) {
            $arr = [
                'address' => $address,
                'error'   => 'No results',
            ];

            return $arr;
        }

        $arr = [
            'address'   => $address,
            'results'   => $results,
            'latitude'  => $results[0]['lat'],
            'longitude' => $results[0]['lng'],
        ];

        return $arr;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get_lang_modinfo($name)
    {
        $lang_name = mb_strtoupper('_MI_' . $this->_DIRNAME . '_' . $name);

        return constant($lang_name);
    }

    // --- class end ---
}
