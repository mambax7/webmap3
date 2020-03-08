<?php
// $Id: oninstall.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_inc_oninstall
//=========================================================

/**
 * Class webmap3_inc_oninstall
 */
class webmap3_inc_oninstall extends webmap3_inc_oninstall_base
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->set_trust_dirname(WEBMAP3_TRUST_DIRNAME);
    }

    /**
     * @return \webmap3_inc_oninstall
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
