<?php
// $Id: utility.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_utility
//=========================================================
class webmap3_lib_utility
{
    public $_MYSQL_FMT_DATE     = 'Y-m-d';
    public $_MYSQL_FMT_DATETIME = 'Y-m-d H:i:s';

    public $_HTML_SLASH = '&#047;';
    public $_HTML_COLON = '&#058;';

    public $_C_YES = 1;

    // base on style sheet of default theme
    public $_STYLE_ERROR_MSG = 'background-color: #FFCCCC; text-align: center; border-top: 1px solid #DDDDFF; border-left: 1px solid #DDDDFF; border-right: 1px solid #AAAAAA; border-bottom: 1px solid #AAAAAA; font-weight: bold; padding: 10px; ';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        // dummy
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_lib_utility();
        }
        return $instance;
    }

    //---------------------------------------------------------
    // utility
    //---------------------------------------------------------
    public function str_to_array($str, $pattern)
    {
        $arr1 = explode($pattern, $str);
        $arr2 = array();
        foreach ($arr1 as $v) {
            $v = trim($v);
            if ($v == '') {
                continue;
            }
            $arr2[] = $v;
        }
        return $arr2;
    }

    public function array_to_str($arr, $glue)
    {
        $val = false;
        if (is_array($arr) && count($arr)) {
            $val = implode($glue, $arr);
        }
        return $val;
    }

    public function parse_ext($file)
    {
        return strtolower(substr(strrchr($file, '.'), 1));
    }

    public function strip_ext($file)
    {
        return str_replace(strrchr($file, '.'), '', $file);
    }

    public function parse_url_to_filename($url)
    {
        $parsed = parse_url($url);
        if (isset($parsed['path'])) {
            $arr = explode('/', $parsed['path']);
            if (is_array($arr) && count($arr)) {
                return array_pop($arr);
            }
        }
        return null;
    }

    public function add_slash_to_head($str)
    {
        // ord : the ASCII value of the first character of string
        // 0x2f slash

        if (ord($str) != 0x2f) {
            $str = '/' . $str;
        }
        return $str;
    }

    public function strip_slash_from_head($str)
    {
        // ord : the ASCII value of the first character of string
        // 0x2f slash

        if (ord($str) == 0x2f) {
            $str = substr($str, 1);
        }
        return $str;
    }

    public function add_separator_to_tail($str)
    {
        // Check the path to binaries of imaging packages
        // DIRECTORY_SEPARATOR is defined by PHP

        if (trim($str) != '' && substr($str, -1) != DIRECTORY_SEPARATOR) {
            $str .= DIRECTORY_SEPARATOR;
        }
        return $str;
    }

    public function strip_slash_from_tail($str)
    {
        if (substr($str, -1, 1) == '/') {
            $str = substr($str, 0, -1);
        }
        return $str;
    }

    // Checks if string is started from HTTP
    public function check_http_start($str)
    {
        if (preg_match('|^https?://|', $str)) {
            return true;    // include HTTP
        }
        return false;
    }

    // Checks if string is HTTP only
    public function check_http_only($str)
    {
        if (($str == 'http://') || ($str == 'https://')) {
            return true;    // http only
        }
        return false;
    }

    public function check_http_null($str)
    {
        if (($str == '') || ($str == 'http://') || ($str == 'https://')) {
            return true;
        }
        return false;
    }

    public function check_http_fill($str)
    {
        $ret = !$this->check_http_null($str);
        return $ret;
    }

    public function get_array_value_by_key($array, $key, $default = null)
    {
        if (isset($array[$key])) {
            return $array[$key];
        }
        return $default;
    }

    //---------------------------------------------------------
    // format
    //---------------------------------------------------------
    public function format_filesize($size, $precision = 2)
    {
        $format = '%.' . (int)$precision . 'f';
        $bytes  = array('B', 'KB', 'MB', 'GB', 'TB');
        foreach ($bytes as $unit) {
            if ($size > 1000) {
                $size = $size / 1024;
            } else {
                break;
            }
        }
        $str = sprintf($format, $size) . ' ' . $unit;
        return $str;
    }

    public function format_time($time, $str_hour, $str_min, $str_sec, $flag_zero = false)
    {
        return $this->build_time($this->parse_time($time), $str_hour, $str_min, $str_sec, $flag_zero);
    }

    public function build_time($time_array, $str_hour, $str_min, $str_sec, $flag_zero = false)
    {
        list($hour, $min, $sec) = $time_array;

        $str = null;
        if ($hour > 0) {
            $str = "$hour $str_hour $min $str_min $sec $str_sec";
        } elseif ($min > 0) {
            $str = "$min $str_min $sec $str_sec";
        } elseif (($sec > 0) || $flag_zero) {
            $str = "$sec $str_sec";
        }
        return $str;
    }

    public function parse_time($time)
    {
        $hour = (int)($time / 3600);
        $min  = (int)($time - 3600 * $hour);
        $sec  = $time - 3600 * $hour - 60 * $min;
        return array($hour, $min, $sec);
    }

    //---------------------------------------------------------
    // file
    //---------------------------------------------------------
    public function unlink_file($file)
    {
        if ($this->check_file($file)) {
            return unlink($file);
        }
        return false;
    }

    public function copy_file($src, $dst, $flag_chmod = false)
    {
        if ($this->check_file($src)) {
            $ret = copy($src, $dst);

            // the user can delete this file which apache made.
            if ($ret && $flag_chmod) {
                chmod($dst, 0777);
            }

            return $ret;
        }
        return false;
    }

    public function rename_file($old, $new)
    {
        if ($this->check_file($old)) {
            return rename($old, $new);
        }
        return false;
    }

    public function check_file($file)
    {
        if ($file && file_exists($file) && is_file($file) && !is_dir($file)) {
            return true;
        }
        return false;
    }

    public function read_file($file, $mode = 'r')
    {
        $fp = fopen($file, $mode);
        if (!$fp) {
            return false;
        }

        $date = fread($fp, filesize($file));
        fclose($fp);
        return $date;
    }

    public function read_file_cvs($file, $mode = 'r')
    {
        $lines = array();

        $fp = fopen($file, $mode);
        if (!$fp) {
            return false;
        }

        while (!feof($fp)) {
            $lines[] = fgetcsv($fp, 1024);
        }

        fclose($fp);
        return $lines;
    }

    public function write_file($file, $data, $mode = 'w', $flag_chmod = false)
    {
        $fp = fopen($file, $mode);
        if (!$fp) {
            return false;
        }

        $byte = fwrite($fp, $data);
        fclose($fp);

        // the user can delete this file which apache made.
        if (($byte > 0) && $flag_chmod) {
            chmod($file, 0777);
        }

        return $byte;
    }

    public function check_file_time($file, $interval)
    {
        // if passing interval time
        if (file_exists($file)) {
            $time = (int)trim(file_get_contents($file));
            if (($time > 0)
                && (time() > ($time + $interval))
            ) {
                return true;
            }

            // if not exists file ( at first time )
        } else {
            return true;
        }

        return false;
    }

    public function renew_file_time($file, $chmod)
    {
        $this->write_file($file, time(), 'w', $chmod);
    }

    //---------------------------------------------------------
    // image
    //---------------------------------------------------------
    public function adjust_image_size($width, $height, $max_width, $max_height, $flag_zero = false)
    {
        if ($flag_zero && (($width == 0) || ($height == 0))) {
            return array($max_width, 0);
        }

        if ($width > $max_width) {
            $mag    = $max_width / $width;
            $width  = $max_width;
            $height = $height * $mag;
        }

        if ($height > $max_height) {
            $mag    = $max_height / $height;
            $height = $max_height;
            $width  = $width * $mag;
        }

        return array((int)$width, (int)$height);
    }

    //---------------------------------------------------------
    // encode
    //---------------------------------------------------------
    public function encode_slash($str)
    {
        return str_replace('/', $this->_HTML_SLASH, $str);
    }

    public function encode_colon($str)
    {
        return str_replace(':', $this->_HTML_COLON, $str);
    }

    public function decode_slash($str)
    {
        return str_replace($this->_HTML_SLASH, '/', $str);
    }

    public function decode_colon($str)
    {
        return str_replace($this->_HTML_COLON, ':', $str);
    }

    //---------------------------------------------------------
    // group perms
    //---------------------------------------------------------
    public function convert_group_perms_array_to_str($perms, $glue = '&')
    {
        $arr = $this->arrenge_group_perms_array($perms);
        return $this->array_to_perm($arr, $glue);
    }

    public function arrenge_group_perms_array($perms)
    {
        if (!is_array($perms) || !count($perms)) {
            return null;
        }

        $arr = array();
        foreach ($perms as $k => $v) {
            if ($v == $this->_C_YES) {
                $arr[] = (int)$k;
            }
        }

        return $arr;
    }

    public function array_to_perm($arr, $glue)
    {
        $val = $this->array_to_str($arr, $glue);
        if ($val) {
            $val = $glue . $val . $glue;
        }
        return $val;
    }

    //---------------------------------------------------------
    // time
    //---------------------------------------------------------
    public function str_to_time($str)
    {
        $str = trim($str);
        if ($str) {
            $time = strtotime($str);
            if ($time > 0) {
                return $time;
            }
            return -1;  // failed to convert
        }
        return 0;
    }

    //---------------------------------------------------------
    // mysql date
    //---------------------------------------------------------
    public function get_mysql_date_today()
    {
        return date($this->_MYSQL_FMT_DATE);
    }

    public function time_to_mysql_datetime($time)
    {
        return date($this->_MYSQL_FMT_DATETIME, $time);
    }

    public function mysql_datetime_to_day_or_month_or_year($datetime)
    {
        $val = $this->mysql_datetime_to_year_month_day($datetime);
        if (empty($val)) {
            $val = $this->mysql_datetime_to_year_month($datetime);
        }
        if (empty($val)) {
            $val = $this->mysql_datetime_to_year($datetime);
        }
        return $val;
    }

    public function mysql_datetime_to_year_month_day($datetime)
    {
        // like yyyy-mm-dd
        if (preg_match("/^(\d{4}\-\d{2}\-\d{2})/", $datetime, $match)) {

            // yyyy-00-00 -> yyyy
            $str = str_replace('-00-00', '', $match[1]);

            // yyyy-mm-00 -> yyyy-mm
            $str = str_replace('-00', '', $str);
            return $str;
        }
        return null;
    }

    public function mysql_datetime_to_year_month($datetime)
    {
        // like yyyy-mm
        if (preg_match("/^(\d{4}\-\d{2})/", $datetime, $match)) {

            // yyyy-00 -> yyyy
            return str_replace('-00', '', $match[1]);
        }
        return null;
    }

    public function mysql_datetime_to_year($datetime)
    {
        // like yyyy
        if (preg_match("/^(\d{4})/", $datetime, $match)) {
            return $match[1];
        }
        return null;
    }

    public function mysql_datetime_to_str($date)
    {
        $date = str_replace('0000-00-00 00:00:00', '', $date);
        $date = str_replace('-00-00 00:00:00', '', $date);
        $date = str_replace('-00 00:00:00', '', $date);
        $date = str_replace(' 00:00:00', '', $date);
        $date = str_replace('0000-00-00', '', $date);
        $date = str_replace('-00-00', '', $date);
        $date = str_replace('-00', '', $date);

        // BUG: 12:00:52 -> 12:52
        // 01:02:00 -> 01:02
        // 01:00:00 -> 01:00
        $date = preg_replace('/(.*\d+:\d+):00/', '$1', $date);

        if ($date == ' ') {
            $date = '';
        }
        return $date;
    }

    public function str_to_mysql_datetime($str)
    {
        $date = '';
        $time = '';

        $arr = explode(' ', $str);
        if (isset($arr[0])) {
            $date = $this->str_to_mysql_date($arr[0]);
        }
        if (isset($arr[1])) {
            $time = $this->str_to_mysql_time($arr[1]);
        }

        if ($date && $time) {
            $val = $date . ' ' . $time;
            return $val;
        } elseif ($date) {
            return $date;
        }
        return false;
    }

    public function str_to_mysql_date($str)
    {
        // 2008-01-01
        $year  = 2008;
        $month = 01;
        $day   = 01;

        // 0000-00-00
        $mysql_year  = '0000';
        $mysql_month = '00';
        $mysql_day   = '00';
        $mysql_hour  = '00';
        $mysql_min   = '00';
        $mysql_sec   = '00';

        $arr = explode('-', $str);

        // ex) 2008-02-03
        if (isset($arr[0]) && isset($arr[1]) && isset($arr[2])) {
            $year        = (int)trim($arr[0]);
            $month       = (int)trim($arr[1]);
            $day         = (int)trim($arr[2]);
            $mysql_year  = $year;
            $mysql_month = $month;
            $mysql_day   = $day;

            // ex) 2008-02 -> 2008-02-00
        } elseif (isset($arr[0]) && isset($arr[1])) {
            $year        = (int)trim($arr[0]);
            $month       = (int)trim($arr[1]);
            $mysql_year  = $year;
            $mysql_month = $month;

            // ex) 2008 -> 2008-00-00
        } elseif (isset($arr[0])) {
            $year       = (int)trim($arr[0]);
            $mysql_year = $year;
        } else {
            return false;
        }

        if (checkdate($month, $day, $year)) {
            return $this->build_mysql_date($mysql_year, $mysql_month, $mysql_day);
        }
        return false;
    }

    public function str_to_mysql_time($str)
    {
        // 0000-00-00
        $mysql_hour = '00';
        $mysql_min  = '00';
        $mysql_sec  = '00';

        $arr = explode(':', $str);

        // ex) 01:02:03
        if (isset($arr[0]) && isset($arr[1]) && isset($arr[2])) {
            $mysql_hour = (int)trim($arr[0]);
            $mysql_min  = (int)trim($arr[1]);
            $mysql_sec  = (int)trim($arr[2]);

            // ex) 01:02 -> 01:02:00
        } elseif (isset($arr[0]) && isset($arr[1])) {
            $mysql_hour = (int)trim($arr[0]);
            $mysql_min  = (int)trim($arr[1]);

            // ex) 01 -> 01:00:00
        } elseif (isset($arr[0])) {
            $mysql_hour = (int)trim($arr[0]);
        } else {
            return false;
        }

        if ($this->check_time($mysql_hour, $mysql_min, $mysql_sec)) {
            return $this->build_mysql_time($mysql_hour, $mysql_min, $mysql_sec);
        }
        return false;
    }

    public function check_time($hour, $min, $sec)
    {
        $hour = (int)$hour;
        $min  = (int)$min;
        $sec  = (int)$sec;

        if (($hour >= 0) && ($hour <= 24)
            && ($min >= 0)
            && ($min <= 60)
            && ($sec >= 0)
            && ($sec <= 60)
        ) {
            return true;
        }
        return false;
    }

    public function build_mysql_date($year, $month, $day)
    {
        $str = $year . '-' . $month . '-' . $day;
        return $str;
    }

    public function build_mysql_time($hour, $min, $sec)
    {
        $str = $hour . ':' . $min . ':' . $sec;
        return $str;
    }

    //---------------------------------------------------------
    // base on core's xoops_error
    // XLC do not support 'errorMsg' style class in admin cp
    //---------------------------------------------------------
    public function build_error_msg($msg, $title = '', $flag_sanitize = true)
    {
        $str = '<div style="' . $this->_STYLE_ERROR_MSG . '">';
        if ($title != '') {
            if ($flag_sanitize) {
                $title = $this->sanitize($title);
            }
            $str .= '<h4>' . $title . "</h4>\n";
        }
        if (is_array($msg)) {
            foreach ($msg as $m) {
                if ($flag_sanitize) {
                    $m = $this->sanitize($msg);
                }
                $str .= $m . "<br />\n";
            }
        } else {
            if ($flag_sanitize) {
                $msg = $this->sanitize($msg);
            }
            $str .= $msg;
        }
        $str .= "</div>\n";
        return $str;
    }

    //---------------------------------------------------------
    // sanitize
    //---------------------------------------------------------
    public function sanitize($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    // --------------------------------------------------------
    // Invert special characters from HTML entities
    //   &amp;   =>  &
    //   &lt;    =>  <
    //   &gt;    =>  >
    //   &quot;  =>  "
    //   &#39;   =>  '
    //   &#039;  =>  '
    //   &apos;  =>  ' (xml format)
    // --------------------------------------------------------
    public function undo_htmlspecialchars($str)
    {
        $arr = array(
            '&amp;'  => '&',
            '&lt;'   => '<',
            '&gt;'   => '>',
            '&quot;' => '"',
            '&#39;'  => "'",
            '&#039;' => "'",
            '&apos;' => "'",
        );
        return strtr($str, $arr);
    }

    // --- class end ---
}
