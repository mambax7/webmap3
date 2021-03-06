<?php
// $Id: gd.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_gd
//=========================================================

/**
 * Class webmap3_lib_gd
 */
class webmap3_lib_gd
{
    public $_is_gd2    = false;
    public $_force_gd2 = false;

    public $_JPEG_QUALITY = 75;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_is_gd2 = $this->is_gd2();
    }

    /**
     * @return \webmap3_lib_gd
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
    // main
    //---------------------------------------------------------

    /**
     * @param     $src_file
     * @param     $dst_file
     * @param int $max_width
     * @param int $max_height
     * @param int $rotate
     * @return bool
     */
    public function resize_rotate($src_file, $dst_file, $max_width = 0, $max_height = 0, $rotate = 0)
    {
        $image_size = getimagesize($src_file);
        if (!is_array($image_size)) {
            return false;
        }

        $src_width  = $image_size[0];
        $src_height = $image_size[1];
        $src_type   = $image_size[2];

        $src_img = $this->image_create($src_file, $src_type);
        if (!is_resource($src_img)) {
            return false;
        }

        $dst_img = $src_img;
        $rot_img = $src_img;

        if (($max_width > 0) && ($max_height > 0)) {
            list($new_width, $new_height) = $this->image_adjust($src_width, $src_height, $max_width, $max_height);

            $img = $this->image_resize($src_img, $src_width, $src_height, $new_width, $new_height);
            if (is_resource($img)) {
                $dst_img = $img;
                $rot_img = $img;
            }
        }

        if ($rotate > 0) {
            $img = $this->image_rotate($rot_img, 360 - $rotate);
            if (is_resource($img)) {
                $dst_img = $img;
            }
        }

        if (is_resource($dst_img)) {
            $this->image_output($dst_img, $dst_file, $src_type);
            imagedestroy($dst_img);
            $ret = true;
        } else {
            $ret = true;
        }

        if (is_resource($src_img)) {
            imagedestroy($src_img);
        }

        if (is_resource($rot_img)) {
            imagedestroy($rot_img);
        }

        return $ret;
    }

    /**
     * @param $src_file
     * @param $src_type
     * @return null|resource
     */
    public function image_create($src_file, $src_type)
    {
        $img = null;

        switch ($src_type) {
            // GIF
            // GD 2.0.28 or later
            case 1:
                if (function_exists('imagecreatefromgif')) {
                    $img = imagecreatefromgif($src_file);
                }
                break;
            // JPEG
            // GD 1.8 or later
            case 2:
                if (function_exists('imagecreatefromjpeg')) {
                    $img = imagecreatefromjpeg($src_file);
                }
                break;
            // PNG
            case 3:
                $img = imagecreatefrompng($src_file);
                break;
        }

        return $img;
    }

    /**
     * @param $src_img
     * @param $dst_file
     * @param $src_type
     */
    public function image_output($src_img, $dst_file, $src_type)
    {
        switch ($src_type) {
            // GIF
            // GD 2.0.28 or later
            case 1:
                if (function_exists('imagegif')) {
                    imagegif($src_img, $dst_file);
                }
                break;
            // JPEG
            // GD 1.8 or later
            case 2:
                if (function_exists('imagejpeg')) {
                    imagejpeg($src_img, $dst_file, $this->_JPEG_QUALITY);
                }
                break;
            // PNG
            case 3:
                imagepng($src_img, $dst_file);
                break;
        }
    }

    /**
     * @param $src_img
     * @param $angle
     * @return null|resource
     */
    public function image_rotate($src_img, $angle)
    {
        // PHP 4.3.0
        if ($this->can_rotate()) {
            return imagerotate($src_img, $angle, 0);
        }

        return null;
    }

    /**
     * @param $src_img
     * @param $src_width
     * @param $src_height
     * @param $new_width
     * @param $new_height
     * @return resource
     */
    public function image_resize($src_img, $src_width, $src_height, $new_width, $new_height)
    {
        if ($this->can_truecolor()) {
            $img = imagecreatetruecolor($new_width, $new_height);
        } else {
            $img = imagecreate($new_width, $new_height);
        }

        // PHP 4.0.6
        if (function_exists('imagecopyresampled')) {
            $ret = imagecopyresampled($img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $src_width, $src_height);
        } else {
            imagecopyresized($img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $src_width, $src_height);
        }

        return $img;
    }

    /**
     * @return bool
     */
    public function is_gd2()
    {
        // PHP 4.3.0
        if (function_exists('gd_info')) {
            $gd_info = gd_info();
            if ('bundled (2' == mb_substr($gd_info['GD Version'], 0, 10)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $width
     * @param $height
     * @param $max_width
     * @param $max_height
     * @return array
     */
    public function image_adjust($width, $height, $max_width, $max_height)
    {
        if ($width > $max_width) {
            $mag    = $max_width / $width;
            $width  = $max_width;
            $height *= $mag;
        }

        if ($height > $max_height) {
            $mag    = $max_height / $height;
            $height = $max_height;
            $width  *= $mag;
        }

        return [(int)$width, (int)$height];
    }

    //---------------------------------------------------------
    // set & get param
    //---------------------------------------------------------

    /**
     * @param $val
     */
    public function set_force_gd2($val)
    {
        // force to use imagecreatetruecolor
        $this->_force_gd2 = (bool)$val;
    }

    /**
     * @param $val
     */
    public function set_jpeg_quality($val)
    {
        $this->_JPEG_QUALITY = (int)$val;
    }

    /**
     * @return bool
     */
    public function can_rotate()
    {
        // PHP 4.3.0
        if (function_exists('imagerotate')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function can_truecolor()
    {
        // PHP 4.0.6 and GD 2.0.1
        // fatal error in PHP 4.0.6 through 4.1.x without GD2
        // http://www.php.net/manual/en/function.imagecreatetruecolor.php

        if (($this->_is_gd2 || $this->_force_gd2) && function_exists('imagecreatetruecolor')) {
            return true;
        }

        return false;
    }

    //---------------------------------------------------------
    // version
    //---------------------------------------------------------

    /**
     * @return array
     */
    public function version()
    {
        if (function_exists('gd_info')) {
            $ret     = true;
            $gd_info = gd_info();
            $str     = 'GD Version: ' . $gd_info['GD Version'];
        } else {
            $ret = false;
            $str = 'not loaded';
        }

        return [$ret, $str];
    }

    // --- class end ---
}
