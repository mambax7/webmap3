<?php
// $Id: image_mime.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_image_mime
//=========================================================

/**
 * Class webmap3_lib_image_mime
 */
class webmap3_lib_image_mime
{
    public $_EXTS  = ['gif', 'jpg', 'jpeg', 'png'];
    public $_MIMES = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png'];

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
    }

    /**
     * @return \webmap3_lib_image_mime
     */
    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // get param
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function get_exts()
    {
        return $this->_EXTS;
    }

    /**
     * @return array
     */
    public function get_mimes()
    {
        return $this->_MIMES;
    }

    // --- class end ---
}
