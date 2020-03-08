<?php
// $Id: footer.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_footer
//=========================================================

/**
 * Class webmap3_lib_footer
 */
class webmap3_lib_footer
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        // dummy
    }

    /**
     * @return \webmap3_lib_footer
     */
    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new self();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // footer
    //---------------------------------------------------------

    /**
     * @param int $time_start
     * @return string
     */
    public function build_execution_time($time_start = 0)
    {
        $str = 'execution time : ';
        $str .= $this->get_execution_time($time_start);
        $str .= ' sec' . "<br >\n";

        return $str;
    }

    /**
     * @return null|string
     */
    public function build_memory_usage()
    {
        $usage = $this->get_memory_usage();
        if ($usage) {
            $str = 'memory usage : ' . $usage . ' MB' . "<br >\n";

            return $str;
        }

        return null;
    }

    /**
     * @param int $time_start
     * @return string
     */
    public function get_execution_time($time_start = 0)
    {
        list($usec, $sec) = explode(' ', microtime());
        $time = (float)$sec + (float)$usec - $time_start;
        $exec = sprintf('%6.3f', $time);

        return $exec;
    }

    /**
     * @return null|string
     */
    public function get_memory_usage()
    {
        if (function_exists('memory_get_usage')) {
            $usage = sprintf('%6.3f', memory_get_usage() / 1000000);

            return $usage;
        }

        return null;
    }

    /**
     * @param bool $is_japanese
     * @return string
     */
    public function get_happy_linux_url($is_japanese = false)
    {
        if ($is_japanese) {
            return 'http://linux.ohwada.jp/';
        }

        return 'http://linux2.ohwada.net/';
    }

    /**
     * @return string
     */
    public function get_powered_by()
    {
        $str = '<div align="right">';
        $str .= '<a href="http://linux2.ohwada.net/" target="_blank">';
        $str .= '<span style="font-size : 80%;">Powered by Happy Linux</span>';
        $str .= "</a></div>\n";

        return $str;
    }

    // --- class end ---
}
