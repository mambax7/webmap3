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
class webmap3_d3_language extends webmap3_d3_language_base
{

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct($dirname, WEBMAP3_TRUST_DIRNAME);
        $this->get_lang_array();
    }

    public static function getSingleton($dirname)
    {
        static $singletons;
        if (!isset($singletons[$dirname])) {
            $singletons[$dirname] = new webmap3_d3_language($dirname);
        }
        return $singletons[$dirname];
    }

    //----- class end -----
}
