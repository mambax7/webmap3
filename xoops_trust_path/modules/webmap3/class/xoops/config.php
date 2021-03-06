<?php
// $Id: config.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_xoops_config
//=========================================================

/**
 * Class webmap3_xoops_config
 */
class webmap3_xoops_config extends webmap3_xoops_config_dirname
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_xoops_config constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        parent::__construct($dirname);
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

    // --- class end ---
}
