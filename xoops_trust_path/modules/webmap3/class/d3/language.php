<?php
// $Id: language.php,v 1.1.1.1 2012/03/17 09:28:16 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_d3_language
//=========================================================

/**
 * Class webmap3_d3_language
 */
class webmap3_d3_language extends webmap3_d3_language_base
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_d3_language constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        parent::__construct($dirname, WEBMAP3_TRUST_DIRNAME);
        $this->get_lang_array();
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

    //----- class end -----
}
