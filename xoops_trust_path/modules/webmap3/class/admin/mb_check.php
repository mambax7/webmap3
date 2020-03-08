<?php
// $Id: mb_check.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_admin_mb_check
//=========================================================

/**
 * Class webmap3_admin_mb_check
 */
class webmap3_admin_mb_check extends webmap3_admin_mb_check_base
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->set_lang_success(_AM_WEBMAP3_CHK_MB_SUCCESS);
    }

    /**
     * @return \webmap3_admin_mb_check|\webmap3_lib_multibyte
     */
    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    // --- class end ---
}
