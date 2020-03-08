<?php
// $Id: blocks.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// height timeout

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_inc_blocks
//=========================================================

/**
 * Class webmap3_inc_blocks
 */
class webmap3_inc_blocks
{
    public $_DIRNAME;

    public $_cache_time       = 0;
    public $_disable_renderer = false;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_inc_blocks constructor.
     * @param $dirname
     * @param $trust_dirname
     */
    public function __construct($dirname, $trust_dirname)
    {
        $this->_DIRNAME = $dirname;

        $this->_configHandler = webmap3_inc_config::getSingleton($dirname);
        $this->_map_class     = webmap3_api_map::getSingleton($dirname);

        $this->_template_location = 'db:' . $dirname . '_block_location.tpl';

        $this->_map_div_id = $dirname . '_map_block_0';
        $this->_map_func   = $dirname . '_load_map_block_0';
    }

    /**
     * @param $dirname
     * @param $trust_dirname
     * @return mixed
     */
    public static function getSingleton($dirname, $trust_dirname)
    {
        static $singletons;
        if (!isset($singletons[$dirname])) {
            $singletons[$dirname] = new self($dirname, $trust_dirname);
        }

        return $singletons[$dirname];
    }

    //---------------------------------------------------------
    // location
    //---------------------------------------------------------

    /**
     * @param $options
     * @return array
     */
    public function location_show($options)
    {
        $cache_time       = $this->_cache_time;
        $template         = $this->_template_location;
        $disable_renderer = $this->_disable_renderer;

        $tpl = new XoopsTpl();

        // set cache time
        if ($cache_time > 0) {
            $tpl->xoops_setCaching(2);
            $tpl->xoops_setCacheTime($cache_time);
        }

        // build block if cache time over
        if (!$tpl->is_cached($template) || (0 == $cache_time)) {
            $block = $this->build_block($options);

            // return orinal block
            if ($disable_renderer) {
                return $block;
            }

            $tpl->assign('block', $block);
        }

        $ret            = [];
        $ret['content'] = $tpl->fetch($template);

        return $ret;
    }

    /**
     * @param $options
     * @return string
     */
    public function location_edit($options)
    {
        $ret = '<table border="0">';
        $ret .= '<tr><td>' . "\n";
        $ret .= 'dirname';
        $ret .= '</td><td>' . "\n";
        $ret .= $options[0];
        $ret .= '<input type="hidden" name="options[0]" value="' . $options[0] . '" >' . "\n";
        $ret .= '</td></tr>' . "\n";
        $ret .= '<tr><td>' . "\n";
        $ret .= $this->constant('HEIGHT');
        $ret .= '</td><td>' . "\n";
        $ret .= '<input type="text" name="options[1]" value="' . (int)$options[1] . '" >' . "\n";
        $ret .= 'px';
        $ret .= '</td></tr>' . "\n";
        $ret .= '<tr><td>' . "\n";
        $ret .= $this->constant('TIMEOUT');
        $ret .= '</td><td>' . "\n";
        $ret .= '<input type="text" name="options[2]" value="' . (int)$options[2] . '" >' . "\n";
        $ret .= $this->constant('TIMEOUT_DSC');
        $ret .= '</td></tr>' . "\n";
        $ret .= '</table>' . "\n";

        return $ret;
    }

    //---------------------------------------------------------
    // block
    //---------------------------------------------------------

    /**
     * @param $options
     * @return array
     */
    public function build_block($options)
    {
        $this->build_map();

        $block = [
            'dirname'   => $options[0],
            'height'    => (int)$options[1],
            'timeout'   => (int)$options[2],
            'func'      => $this->_map_func,
            'div_id'    => $this->_map_div_id,
            'lang_more' => 'more...',
        ];

        return $block;
    }

    //---------------------------------------------------------
    // map
    //---------------------------------------------------------
    public function build_map()
    {
        $latitude  = $this->_configHandler->get_by_name('latitude');
        $longitude = $this->_configHandler->get_by_name('longitude');
        $zoom      = $this->_configHandler->get_by_name('zoom');
        $info      = $this->_configHandler->get_by_name('loc_marker_info');

        $marker = [
            'latitude'  => $latitude,
            'longitude' => $longitude,
            'info'      => $info,
            'icon_id'   => 0,
        ];

        $markers = [$marker];

        // head
        $this->_map_class->init();
        $this->_map_class->assign_google_map_js_to_head();
        $this->_map_class->assign_map_js_to_head();
        $this->_map_class->assign_gicon_array_to_head();

        // map
        $this->_map_class->set_map_div_id($this->_map_div_id);
        $this->_map_class->set_map_func($this->_map_func);

        $this->_map_class->set_latitude($latitude);
        $this->_map_class->set_longitude($longitude);
        $this->_map_class->set_zoom($zoom);

        $param = $this->_map_class->build_markers($markers);
        $this->_map_class->fetch_markers_head($param);
    }

    //---------------------------------------------------------
    // langauge
    //---------------------------------------------------------

    /**
     * @param $name
     * @return mixed|string
     */
    public function constant($name)
    {
        $const_name = $this->constant_name($name);
        if (defined($const_name)) {
            return constant($const_name);
        }

        return $const_name;
    }

    /**
     * @param $name
     * @return string
     */
    public function constant_name($name)
    {
        return mb_strtoupper('_BL_' . $this->_DIRNAME . '_' . $name);
    }

    // --- class end ---
}
