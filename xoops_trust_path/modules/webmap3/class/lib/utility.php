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

/**
 * Class webmap3_lib_utility
 */
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

    /**
     * @return \webmap3_lib_utility
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
    // utility
    //---------------------------------------------------------

    /**
     * @param $str
     * @param $pattern
     * @return array
     */
    public function str_to_array($str, $pattern)
    {
        $arr1 = explode($pattern, $str);
        $arr2 = [];
        foreach ($arr1 as $v) {
            $v = trim($v);
            if ('' == $v) {
                continue;
            }
            $arr2[] = $v;
        }

        return $arr2;
    }

    /**
     * @param $arr
     * @param $glue
     * @return bool|string
     */
    public function array_to_str($arr, $glue)
    {
        $val = false;
        if (is_array($arr) && count($arr)) {
            $val = implode($glue, $arr);
        }

        return $val;
    }

    /**
     * @param $file
     * @return string
     */
    public function parse_ext($file)
    {
        return mb_strtolower(mb_substr(mb_strrchr($file, '.'), 1));
    }

    /**
     * @param $file
     * @return mixed
     */
    public function strip_ext($file)
    {
        return str_replace(mb_strrchr($file, '.'), '', $file);
    }

    /**
     * @param $url
     * @return mixed|null
     */
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

    /**
     * @param $str
     * @return string
     */
    public function add_slash_to_head($str)
    {
        // ord : the ASCII value of the first character of string
        // 0x2f slash

        if (0x2f != ord($str)) {
            $str = '/' . $str;
        }

        return $str;
    }

    /**
     * @param $str
     * @return bool|string
     */
    public function strip_slash_from_head($str)
    {
        // ord : the ASCII value of the first character of string
        // 0x2f slash

        if (0x2f == ord($str)) {
            $str = mb_substr($str, 1);
        }

        return $str;
    }

    /**
     * @param $str
     * @return string
     */
    public function add_separator_to_tail($str)
    {
        // Check the path to binaries of imaging packages
        // DIRECTORY_SEPARATOR is defined by PHP

        if ('' != trim($str) && DIRECTORY_SEPARATOR != mb_substr($str, -1)) {
            $str .= DIRECTORY_SEPARATOR;
        }

        return $str;
    }

    /**
     * @param $str
     * @return bool|string
     */
    public function strip_slash_from_tail($str)
    {
        if ('/' == mb_substr($str, -1, 1)) {
            $str = mb_substr($str, 0, -1);
        }

        return $str;
    }

    // Checks if string is started from HTTP

    /**
     * @param $str
     * @return bool
     */
    public function check_http_start($str)
    {
        if (preg_match('|^https?://|', $str)) {
            return true;    // include HTTP
        }

        return false;
    }

    // Checks if string is HTTP only

    /**
     * @param $str
     * @return bool
     */
    public function check_http_only($str)
    {
        if (('http://' == $str) || ('https://' == $str)) {
            return true;    // http only
        }

        return false;
    }

    /**
     * @param $str
     * @return bool
     */
    public function check_http_null($str)
    {
        if (('' == $str) || ('http://' == $str) || ('https://' == $str)) {
            return true;
        }

        return false;
    }

    /**
     * @param $str
     * @return bool
     */
    public function check_http_fill($str)
    {
        $ret = !$this->check_http_null($str);

        return $ret;
    }

    /**
     * @param      $array
     * @param      $key
     * @param null $default
     */
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

    /**
     * @param     $size
     * @param int $precision
     * @return string
     */
    public function format_filesize($size, $precision = 2)
    {
        $format = '%.' . (int)$precision . 'f';
        $bytes  = ['B', 'KB', 'MB', 'GB', 'TB'];
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

    /**
     * @param      $time
     * @param      $str_hour
     * @param      $str_min
     * @param      $str_sec
     * @param bool $flag_zero
     * @return null|string
     */
    public function format_time($time, $str_hour, $str_min, $str_sec, $flag_zero = false)
    {
        return $this->build_time($this->parse_time($time), $str_hour, $str_min, $str_sec, $flag_zero);
    }

    /**
     * @param      $time_array
     * @param      $str_hour
     * @param      $str_min
     * @param      $str_sec
     * @param bool $flag_zero
     * @return null|string
     */
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

    /**
     * @param $time
     * @return array
     */
    public function parse_time($time)
    {
        $hour = (int)($time / 3600);
        $min  = ($time - 3600 * $hour);
        $sec  = $time - 3600 * $hour - 60 * $min;

        return [$hour, $min, $sec];
    }

    //---------------------------------------------------------
    // file
    //---------------------------------------------------------

    /**
     * @param $file
     * @return bool
     */
    public function unlink_file($file)
    {
        if ($this->check_file($file)) {
            return unlink($file);
        }

        return false;
    }

    /**
     * @param      $src
     * @param      $dst
     * @param bool $flag_chmod
     * @return bool
     */
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

    /**
     * @param $old
     * @param $new
     * @return bool
     */
    public function rename_file($old, $new)
    {
        if ($this->check_file($old)) {
            return rename($old, $new);
        }

        return false;
    }

    /**
     * @param $file
     * @return bool
     */
    public function check_file($file)
    {
        if ($file && file_exists($file) && is_file($file) && !is_dir($file)) {
            return true;
        }

        return false;
    }

    /**
     * @param        $file
     * @param string $mode
     * @return bool|string
     */
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

    /**
     * @param        $file
     * @param string $mode
     * @return array|bool
     */
    public function read_file_cvs($file, $mode = 'r')
    {
        $lines = [];

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

    /**
     * @param        $file
     * @param        $data
     * @param string $mode
     * @param bool   $flag_chmod
     * @return bool|int
     */
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

    /**
     * @param $file
     * @param $interval
     * @return bool
     */
    public function check_file_time($file, $interval)
    {
        // if passing interval time
        if (file_exists($file)) {
            $time = (int)trim(file_get_contents($file));
            if (($time > 0)
                && (time() > ($time + $interval))) {
                return true;
            }
            // if not exists file ( at first time )
        } else {
            return true;
        }

        return false;
    }

    /**
     * @param $file
     * @param $chmod
     */
    public function renew_file_time($file, $chmod)
    {
        $this->write_file($file, time(), 'w', $chmod);
    }

    //---------------------------------------------------------
    // image
    //---------------------------------------------------------

    /**
     * @param      $width
     * @param      $height
     * @param      $max_width
     * @param      $max_height
     * @param bool $flag_zero
     * @return array
     */
    public function adjust_image_size($width, $height, $max_width, $max_height, $flag_zero = false)
    {
        if ($flag_zero && ((0 == $width) || (0 == $height))) {
            return [$max_width, 0];
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

        return [(int)$width, (int)$height];
    }

    //---------------------------------------------------------
    // encode
    //---------------------------------------------------------

    /**
     * @param $str
     * @return mixed
     */
    public function encode_slash($str)
    {
        return str_replace('/', $this->_HTML_SLASH, $str);
    }

    /**
     * @param $str
     * @return mixed
     */
    public function encode_colon($str)
    {
        return str_replace(':', $this->_HTML_COLON, $str);
    }

    /**
     * @param $str
     * @return mixed
     */
    public function decode_slash($str)
    {
        return str_replace($this->_HTML_SLASH, '/', $str);
    }

    /**
     * @param $str
     * @return mixed
     */
    public function decode_colon($str)
    {
        return str_replace($this->_HTML_COLON, ':', $str);
    }

    //---------------------------------------------------------
    // group perms
    //---------------------------------------------------------

    /**
     * @param        $perms
     * @param string $glue
     * @return bool|string
     */
    public function convert_group_perms_array_to_str($perms, $glue = '&')
    {
        $arr = $this->arrenge_group_perms_array($perms);

        return $this->array_to_perm($arr, $glue);
    }

    /**
     * @param $perms
     * @return array|null
     */
    public function arrenge_group_perms_array($perms)
    {
        if (!is_array($perms) || !count($perms)) {
            return null;
        }

        $arr = [];
        foreach ($perms as $k => $v) {
            if ($v == $this->_C_YES) {
                $arr[] = (int)$k;
            }
        }

        return $arr;
    }

    /**
     * @param $arr
     * @param $glue
     * @return bool|string
     */
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

    /**
     * @param $str
     * @return false|int
     */
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

    /**
     * @return false|string
     */
    public function get_mysql_date_today()
    {
        return date($this->_MYSQL_FMT_DATE);
    }

    /**
     * @param $time
     * @return false|string
     */
    public function time_to_mysql_datetime($time)
    {
        return date($this->_MYSQL_FMT_DATETIME, $time);
    }

    /**
     * @param $datetime
     * @return mixed|null
     */
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

    /**
     * @param $datetime
     * @return mixed|null
     */
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

    /**
     * @param $datetime
     * @return mixed|null
     */
    public function mysql_datetime_to_year_month($datetime)
    {
        // like yyyy-mm
        if (preg_match("/^(\d{4}\-\d{2})/", $datetime, $match)) {
            // yyyy-00 -> yyyy
            return str_replace('-00', '', $match[1]);
        }

        return null;
    }

    /**
     * @param $datetime
     */
    public function mysql_datetime_to_year($datetime)
    {
        // like yyyy
        if (preg_match("/^(\d{4})/", $datetime, $match)) {
            return $match[1];
        }

        return null;
    }

    /**
     * @param $date
     * @return mixed
     */
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

        if (' ' == $date) {
            $date = '';
        }

        return $date;
    }

    /**
     * @param $str
     * @return bool|string
     */
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

    /**
     * @param $str
     * @return bool|string
     */
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

    /**
     * @param $str
     * @return bool|string
     */
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

    /**
     * @param $hour
     * @param $min
     * @param $sec
     * @return bool
     */
    public function check_time($hour, $min, $sec)
    {
        $hour = (int)$hour;
        $min  = (int)$min;
        $sec  = (int)$sec;

        if (($hour >= 0) && ($hour <= 24)
            && ($min >= 0)
            && ($min <= 60)
            && ($sec >= 0)
            && ($sec <= 60)) {
            return true;
        }

        return false;
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return string
     */
    public function build_mysql_date($year, $month, $day)
    {
        $str = $year . '-' . $month . '-' . $day;

        return $str;
    }

    /**
     * @param $hour
     * @param $min
     * @param $sec
     * @return string
     */
    public function build_mysql_time($hour, $min, $sec)
    {
        $str = $hour . ':' . $min . ':' . $sec;

        return $str;
    }

    //---------------------------------------------------------
    // base on core's xoops_error
    // XLC do not support 'errorMsg' style class in admin cp
    //---------------------------------------------------------

    /**
     * @param        $msg
     * @param string $title
     * @param bool   $flag_sanitize
     * @return string
     */
    public function build_error_msg($msg, $title = '', $flag_sanitize = true)
    {
        $str = '<div style="' . $this->_STYLE_ERROR_MSG . '">';
        if ('' != $title) {
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
                $str .= $m . "<br >\n";
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

    /**
     * @param $str
     * @return string
     */
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

    /**
     * @param $str
     * @return string
     */
    public function undo_htmlspecialchars($str)
    {
        $arr = [
            '&amp;'  => '&',
            '&lt;'   => '<',
            '&gt;'   => '>',
            '&quot;' => '"',
            '&#39;'  => "'",
            '&#039;' => "'",
            '&apos;' => "'",
        ];

        return strtr($str, $arr);
    }

    // --- class end ---
}
