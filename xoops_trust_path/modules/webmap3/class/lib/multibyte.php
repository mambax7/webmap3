<?php
// $Id: multibyte.php,v 1.1.1.1 2012/03/17 09:28:16 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_multibyte
//=========================================================
class webmap3_lib_multibyte
{
    public $_language;
    public $_is_japanese;

    public $_JA_KUTEN   = null;
    public $_JA_DOKUTEN = null;
    public $_JA_PERIOD  = null;
    public $_JA_COMMA   = null;

    public $_JPAPANESE_ARRAY = array('japanese', 'japaneseutf', 'ja_utf8');

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->set_internal_encoding(_CHARSET);
        $this->_language    = $this->get_config_by_name('language');
        $this->_is_japanese = $this->is_japanese();
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_lib_multibyte();
        }
        return $instance;
    }

    //---------------------------------------------------------
    // encoding
    //---------------------------------------------------------
    public function set_internal_encoding($charset)
    {
        if (function_exists('iconv_get_encoding')
            && function_exists('iconv_set_encoding')
        ) {
            $current = iconv_get_encoding('internal_encoding');
            if (PHP_VERSION_ID < 50600) {
                $ret = iconv_set_encoding('internal_encoding', $charset);
            } else {
                $ret = ini_set('default_charset', $charset);
            }
            if ($ret === false) {
                if (PHP_VERSION_ID < 50600) {
                    iconv_set_encoding('internal_encoding', $current);
                } else {
                    ini_set('default_charset', $current);
                }
            }
            return $ret;
        }

        if (function_exists('mb_internal_encoding')) {
            $current = mb_internal_encoding();
            $ret     = mb_internal_encoding($charset);
            if ($ret === false) {
                mb_internal_encoding($current);
            }
            return $ret;
        }

        return true;    // dummy
    }

    public function i_iconv_get_encoding($type)
    {
        if (function_exists('iconv_get_encoding')) {
            return iconv_get_encoding($type);
        }
        return null;    // dummy
    }

    public function i_iconv_set_encoding($type, $charset)
    {
        if (function_exists('iconv_set_encoding')) {
            return iconv_set_encoding($type, $charset);
        }
        return true;    // dummy
    }

    public function m_mb_internal_encoding($encoding = null)
    {
        if (function_exists('mb_internal_encoding')) {
            if ($encoding) {
                return mb_internal_encoding($encoding);
            } else {
                return mb_internal_encoding();
            }
        }
        return true;    // dummy
    }

    public function m_mb_language($language = null)
    {
        if (function_exists('mb_language')) {
            if ($language) {
                return mb_language($language);
            } else {
                return mb_language();
            }
        }
    }

    public function m_mb_detect_encoding($str, $encoding_list = null, $strict = null)
    {
        if (function_exists('mb_detect_encoding')) {
            if ($encoding_list && $strict) {
                return mb_detect_encoding($str, $encoding_list, $strict);
            } elseif ($encoding_list) {
                return mb_detect_encoding($str, $encoding_list);
            }
            return mb_detect_encoding($str);
        }
        return false;
    }

    public function exists_convert_encoding()
    {
        if (function_exists('iconv')) {
            return true;
        }
        if (function_exists('mb_convert_encoding')) {
            return true;
        }
        return false;
    }

    //---------------------------------------------------------
    // convert
    //---------------------------------------------------------
    public function convert_to_utf8($str, $encoding = _CHARSET)
    {
        if (function_exists('iconv')) {
            return $this->i_iconv($encoding, 'UTF-8', $str);
        }
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($str, $encoding, 'UTF-8');
        }
        $str = utf8_encode($str);
    }

    public function convert_from_utf8($str, $encoding = _CHARSET)
    {
        if (function_exists('iconv')) {
            return $this->i_iconv('UTF-8', $encoding, $str);
        }
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($str, 'UTF-8', $encoding);
        }
        $str = utf8_decode($str);
    }

    public function convert_encoding($str, $to, $from)
    {
        if ($to == $from) {
            return $str;
        }
        if (function_exists('iconv')) {
            return $this->i_iconv($from, $to, $str);
        }
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($str, $to, $from);
        }
        return $str;
    }

    public function i_iconv($from, $to, $str, $extra = '//IGNORE')
    {
        if (function_exists('iconv')) {
            return iconv($from, $to . $extra, $str);
        }
        return $str;
    }

    public function m_mb_convert_encoding($str, $to, $from = null)
    {
        if (function_exists('mb_convert_encoding')) {
            if ($from) {
                return mb_convert_encoding($str, $to, $from);
            } else {
                return mb_convert_encoding($str, $to);
            }
        }
        return $str;
    }

    public function convert_space_zen_to_han($str)
    {
        if (function_exists('mb_convert_kana')) {
            return mb_convert_kana($str, 's');
        }
        return $str;
    }

    public function m_mb_convert_kana($str, $option = 'KV', $encoding = null)
    {
        if (function_exists('mb_convert_kana')) {
            if ($encoding) {
                return mb_convert_kana($str, $option, $encoding);
            } else {
                return mb_convert_kana($str, $option);
            }
        }
        return $str;
    }

    //---------------------------------------------------------
    // strlen
    //---------------------------------------------------------
    public function str_len($str, $charset = null)
    {
        if (function_exists('iconv_strlen')) {
            return $this->i_iconv_strlen($str, $charset);
        }
        if (function_exists('mb_strlen')) {
            return $this->m_mb_strlen($str, $charset);
        }
        return strlen($str);
    }

    public function i_iconv_strlen($str, $charset = null)
    {
        if (function_exists('iconv_strlen')) {
            if ($charset) {
                return iconv_strlen($str, $charset);
            } else {
                return iconv_strlen($str);
            }
        }
        return strlen($str);
    }

    public function m_mb_strlen($str, $encoding = null)
    {
        if (function_exists('mb_strlen')) {
            if ($encoding) {
                return mb_strlen($str, $encoding);
            } else {
                return mb_strlen($str);
            }
        }
        return strlen($str);
    }

    //---------------------------------------------------------
    // strpos
    //---------------------------------------------------------
    public function str_pos($haystack, $needle, $offset = 0, $charset = null)
    {
        if (function_exists('iconv_strpos')) {
            return $this->i_iconv_strpos($haystack, $needle, $offset, $charset);
        }
        if (function_exists('mb_strpos')) {
            return $this->m_mb_strpos($haystack, $needle, $offset, $charset);
        }
        return strpos($haystack, $needle, $offset);
    }

    public function i_iconv_strpos($haystack, $needle, $offset = 0, $charset = null)
    {
        if (function_exists('iconv_strpos')) {
            if ($charset) {
                return iconv_strpos($haystack, $needle, $offset, $charset);
            } elseif ($offset) {
                return iconv_strpos($haystack, $needle, $offset);
            } else {
                return iconv_strpos($haystack, $needle);
            }
        }
        return strpos($haystack, $needle, $offset);
    }

    public function m_mb_strpos($haystack, $needle, $offset = 0, $encoding = null)
    {
        if (function_exists('mb_strpos')) {
            if ($encoding) {
                return mb_strpos($haystack, $needle, $offset, $encoding);
            } elseif ($offset) {
                return mb_strpos($haystack, $needle, $offset);
            } else {
                return mb_strpos($haystack, $needle);
            }
        }
        return strpos($haystack, $needle, $offset);
    }

    //---------------------------------------------------------
    // strrpos
    //---------------------------------------------------------
    public function str_rpos($haystack, $needle, $offset = 0, $charset = null)
    {
        if (function_exists('iconv_strrpos')) {
            return $this->i_iconv_strrpos($haystack, $needle, $offset, $charset);
        }
        if (function_exists('mb_strrpos')) {
            return $this->m_mb_strrpos($haystack, $needle, $offset, $charset);
        }
        return strrpos($haystack, $needle, $offset);
    }

    public function i_iconv_strrpos($haystack, $needle, $offset = 0, $charset = null)
    {
        if (function_exists('iconv_strrpos')) {
            if ($charset) {
                return iconv_strrpos($haystack, $needle, $offset, $charset);
            } else {
                return iconv_strrpos($haystack, $needle, $offset);
            }
        }
        return strrpos($haystack, $needle, $offset);
    }

    public function m_mb_strrpos($haystack, $needle, $offset = 0, $encoding = null)
    {
        if (function_exists('mb_strrpos')) {
            if ($encoding) {
                return mb_strrpos($haystack, $needle, $offset, $encoding);
            } else {
                return mb_strrpos($haystack, $needle, $offset);
            }
        }
        return strrpos($haystack, $needle, $offset);
    }

    //---------------------------------------------------------
    // substr
    //---------------------------------------------------------
    public function sub_str($str, $start, $length = 0, $charset = null)
    {
        if (function_exists('iconv_substr')) {
            return $this->i_iconv_substr($str, $start, $length, $charset);
        }
        if (function_exists('mb_substr')) {
            return $this->m_mb_substr($str, $start, $length, $charset);
        }
        return substr($str, $start, $length);
    }

    public function i_iconv_substr($str, $start, $length = 0, $charset = null)
    {
        if (function_exists('iconv_substr')) {
            if ($charset) {
                return iconv_substr($str, $start, $length, $charset);
            } else {
                return iconv_substr($str, $start, $length);
            }
        }
        return substr($str, $start, $length);
    }

    public function m_mb_substr($str, $start, $length = 0, $encoding = null)
    {
        if (function_exists('mb_substr')) {
            if ($encoding) {
                return mb_substr($str, $start, $length, $encoding);
            } else {
                return mb_substr($str, $start, $length);
            }
        }
        return substr($str, $start, $length);
    }

    //---------------------------------------------------------
    // other
    //---------------------------------------------------------
    public function m_mb_http_output($encoding = null)
    {
        if (function_exists('mb_http_output')) {
            if ($encoding) {
                return mb_http_output($encoding);
            } else {
                return mb_http_output();
            }
        }
        return false;
    }

    public function m_mb_send_mail($mailto, $subject, $message, $headers = null, $parameter = null)
    {
        if (function_exists('mb_send_mail')) {
            if ($parameter) {
                return mb_send_mail($mailto, $subject, $message, $headers, $parameter);
            } elseif ($headers) {
                return mb_send_mail($mailto, $subject, $message, $headers);
            } else {
                return mb_send_mail($mailto, $subject, $message);
            }
        }
        if ($parameter) {
            return mail($mailto, $subject, $message, $headers, $parameter);
        } elseif ($headers) {
            return mail($mailto, $subject, $message, $headers);
        }
        return mail($mailto, $subject, $message);
    }

    public function m_mb_ereg_replace($pattern, $replace, $string, $option = null)
    {
        if (function_exists('mb_ereg_replace')) {
            if ($option) {
                return mb_ereg_replace($pattern, $replace, $string, $option);
            } else {
                return mb_ereg_replace($pattern, $replace, $string);
            }
        }
    }

    //---------------------------------------------------------
    // shorten strings
    // max: plus=shorten, 0=null, -1=unlimited
    //---------------------------------------------------------
    public function shorten($str, $max, $tail = ' ...')
    {
        $text = $str;
        if (($max > 0) && (strlen($str) > $max)) {
            $text = $this->sub_str($str, 0, $max) . $tail;
        } elseif ($max == 0) {
            $text = null;
        }
        return $text;
    }

    //---------------------------------------------------------
    // build summary
    //---------------------------------------------------------
    public function build_summary($str, $max, $tail = ' ...')
    {
        $str = $this->build_plane_text($str);
        $str = $this->str_replace_return_code($str);
        $str = $this->str_replace_continuous_space_code($str);
        $str = $this->str_set_empty_if_only_space($str);
        $str = $this->shorten($str, $max, $tail);
        return $str;
    }

    public function build_plane_text($str)
    {
        if ($this->_is_japanese) {
            $str = $this->convert_space_zen_to_han($str);
            $str = $this->str_add_space_after_punctuation_ja($str);
        }

        $str = $this->str_add_space_after_tag($str);
        $str = strip_tags($str);
        $str = $this->str_replace_control_code($str);
        $str = $this->str_replace_tab_code($str);
        $str = $this->str_replace_return_to_nl_code($str);
        $str = $this->str_replace_html_space_code($str);
        $str = $this->str_replace_continuous_space_code($str);
        $str = $this->str_replace_space_return_code($str);
        $str = $this->str_replace_continuous_return_code($str);
        return $str;
    }

    public function str_add_space_after_tag($str)
    {
        return $this->str_add_space_after_str('>', $str);
    }

    public function str_add_space_after_punctuation($str)
    {
        $str = $this->str_add_space_after_str(',', $str);
        $str = $this->str_add_space_after_str('.', $str);
        return $str;
    }

    public function str_add_space_after_str($word, $string)
    {
        return str_replace($word, $word . ' ', $string);
    }

    public function str_set_empty_if_only_space($str)
    {
        $temp = $this->str_replace_space_code($str, '');
        if (strlen($temp) == 0) {
            $str = '';
        }
        return $str;
    }

    //---------------------------------------------------------
    // TAB \x09 \t
    // LF  \xOA \n
    // CR  \xOD \r
    //---------------------------------------------------------
    public function str_replace_control_code($str, $replace = ' ')
    {
        $str = preg_replace('/[\x00-\x08]/', $replace, $str);
        $str = preg_replace('/[\x0B-\x0C]/', $replace, $str);
        $str = preg_replace('/[\x0E-\x1F]/', $replace, $str);
        $str = preg_replace('/[\x7F]/', $replace, $str);
        return $str;
    }

    public function str_replace_tab_code($str, $replace = ' ')
    {
        return preg_replace("/\t/", $replace, $str);
    }

    public function str_replace_return_code($str, $replace = ' ')
    {
        $str = preg_replace("/\n/", $replace, $str);
        $str = preg_replace("/\r/", $replace, $str);
        return $str;
    }

    public function str_replace_return_to_nl_code($str, $replace = "\n")
    {
        $str = preg_replace("/\r/", $replace, $str);
        return $str;
    }

    public function str_replace_continuous_return_code($str, $replace = "\n")
    {
        return preg_replace("/[\n|\r]+/", $replace, $str);
    }

    public function str_replace_space_return_code($str, $replace = "\n")
    {
        return preg_replace("/[\x20][\n|\r]/", $replace, $str);
    }

    public function str_replace_html_space_code($str, $replace = ' ')
    {
        return preg_replace('/&nbsp;/i', $replace, $str);
    }

    public function str_replace_space_code($str, $replace = ' ')
    {
        return preg_replace("/[\x20]/", $replace, $str);
    }

    public function str_replace_continuous_space_code($str, $replace = ' ')
    {
        return preg_replace("/[\x20]+/", $replace, $str);
    }

    //---------------------------------------------------------
    // summary
    //---------------------------------------------------------
    public function build_summary_with_search($text, $words, $l = 255, $tail = ' ...')
    {
        if (!is_array($words)) {
            $words = array();
        }

        $ret    = '';
        $q_word = str_replace(' ', '|', preg_quote(implode(' ', $words), '/'));

        if (preg_match("/$q_word/i", $text, $match)) {
            $ret = ltrim(preg_replace('/\s+/', ' ', $text));
            list($pre, $aft) = preg_split("/$q_word/i", $ret, 2);
            $m   = (int)($l / 2);
            $ret = (strlen($pre) > $m) ? $tail : '';
            $ret .= $this->sub_str($pre, max(strlen($pre) - $m + 1, 0), $m);
            $ret .= $match[0];
            $m = $l - strlen($ret);
            $ret .= $this->sub_str($aft, 0, min(strlen($aft), $m));
            if (strlen($aft) > $m) {
                $ret .= $tail;
            }
        }

        if (!$ret) {
            $ret = $this->sub_str($text, 0, $l);
        }

        return $ret;
    }

    //---------------------------------------------------------
    // wordwrap
    //---------------------------------------------------------
    public function build_summary_with_wordwrap($str, $max, $width, $break, $flag_sanitize)
    {
        $str = $this->build_plane_text($str);
        $str = $this->shorten($str, $max);
        $arr = preg_split("/[\n|\r]/", $str);

        $ret = '';
        foreach ($arr as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            $ret .= $this->mb_wordwrap($line, $width, $break, $flag_sanitize);
        }
        return $ret;
    }

    public function mb_wordwrap($str, $width, $break, $flag_sanitize)
    {
        if (!function_exists('mb_strlen')) {
            return wordwrap($str, $width, $break);
        }
        if (!function_exists('mb_substr')) {
            return wordwrap($str, $width, $break);
        }

        if (($width <= 0)
            || (mb_strlen($str) <= $width)
        ) {
            if ($flag_sanitize) {
                $str = $this->sanitize($str);
            }
            $ret = $str . $break;
            return $ret;
        }

        $ret = '';
        for ($i = 0; $i < mb_strlen($str); $i += $len) {
            for ($j = 1; $j <= $width; ++$j) {
                $wk = mb_substr($str, $i, $j);
                if (mb_strlen($wk) >= $width) {
                    break;
                }
            }
            $len = mb_strlen($wk);
            if ($flag_sanitize) {
                $wk = $this->sanitize($wk);
            }
            $ret .= $wk . $break;
        }
        return $ret;
    }

    // single quote (') -> &#039;
    public function sanitize($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    //---------------------------------------------------------
    // config
    //---------------------------------------------------------
    public function get_config_by_name($name)
    {
        global $xoopsConfig;
        if (isset($xoopsConfig[$name])) {
            return $xoopsConfig[$name];
        }
        return false;
    }

    public function is_japanese()
    {
        if (in_array($this->_language, $this->_JPAPANESE_ARRAY)) {
            return true;
        }
        return false;
    }

    //---------------------------------------------------------
    // for japanese
    //---------------------------------------------------------
    public function str_add_space_after_punctuation_ja($str)
    {
        $str = $this->add_space_after_str_ja($str, $this->_JA_KUTEN);
        $str = $this->add_space_after_str_ja($str, $this->_JA_DOKUTEN);
        $str = $this->add_space_after_str_ja($str, $this->_JA_PERIOD);
        $str = $this->add_space_after_str_ja($str, $this->_JA_COMMA);
        return $str;
    }

    public function add_space_after_str_ja($str, $word)
    {
        if ($word) {
            return $this->m_mb_ereg_replace($word, $word . ' ', $str);
        }
        return $str;
    }

    public function set_ja_kuten($val)
    {
        $this->_JA_KUTEN = $val;
    }

    public function set_ja_dokuten($val)
    {
        $this->_JA_DOKUTEN = $val;
    }

    public function set_ja_period($val)
    {
        $this->_JA_PERIOD = $val;
    }

    public function set_ja_comma($val)
    {
        $this->_JA_COMMA = $val;
    }

    // --- class end ---
}
