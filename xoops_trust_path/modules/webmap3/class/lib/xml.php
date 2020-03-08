<?php
// $Id: xml.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_xml
//=========================================================

/**
 * Class webmap3_lib_xml
 */
class webmap3_lib_xml
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        // dummy
    }

    // --------------------------------------------------------
    // htmlspecialchars
    // http://www.w3.org/TR/REC-xml/#dt-markup
    // http://www.fxis.co.jp/xmlcafe/tmp/rec-xml.html#dt-markup
    //   &  -> &amp;    // without html entity
    //   <  -> &lt;
    //   >  -> &gt;
    //   "  -> &quot;
    //   '  -> &apos;
    // --------------------------------------------------------

    /**
     * @param $str
     * @return mixed|null|string|string[]
     */
    public function xml_text($str)
    {
        return $this->xml_htmlspecialchars_strict($str);
    }

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_url($str)
    {
        return $this->xml_htmlspecialchars_url($str);
    }

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_htmlspecialchars($str)
    {
        $str = $this->replace_control_code($str, '');
        $str = $this->replace_return_code($str);
        $str = htmlspecialchars($str, ENT_QUOTES | ENT_HTML5);
        $str = preg_replace("/'/", '&apos;', $str);

        return $str;
    }

    /**
     * @param $str
     * @return mixed|null|string|string[]
     */
    public function xml_htmlspecialchars_strict($str)
    {
        $str = $this->xml_strip_html_entity_char($str);
        $str = $this->xml_htmlspecialchars($str);
        $str = str_replace('?', '&#063;', $str);

        return $str;
    }

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_htmlspecialchars_url($str)
    {
        $str = preg_replace('/&amp;/sU', '&', $str);
        $str = $this->xml_strip_html_entity_char($str);
        $str = $this->xml_htmlspecialchars($str);

        return $str;
    }

    /**
     * @param      $str
     * @param bool $flag_control
     * @param bool $flag_undo
     * @return null|string|string[]
     */
    public function xml_cdata($str, $flag_control = true, $flag_undo = true)
    {
        $str = $this->replace_control_code($str, '');
        $str = $this->xml_undo_html_special_chars($str);

        // not sanitize
        $str = $this->xml_convert_cdata($str);

        return $str;
    }

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_convert_cdata($str)
    {
        return preg_replace('/]]>/', ']]&gt;', $str);
    }

    // --------------------------------------------------------
    // strip html entities
    //   &abc; -> ' '
    // --------------------------------------------------------

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_strip_html_entity_char($str)
    {
        return preg_replace('/&[0-9a-zA-z]+;/sU', ' ', $str);
    }

    // --------------------------------------------------------
    // strip html entities
    //   &#123; -> ' '
    // --------------------------------------------------------

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_strip_html_entity_numeric($str)
    {
        return preg_replace('/&amp;#([0-9a-fA-F]+);/sU', '&#\\1;', $str);
    }

    // --------------------------------------------------------
    // undo XOOPS HtmlSpecialChars
    //   &lt;   -> <
    //   &gt;   -> >
    //   &quot; -> "
    //   &#039; -> '
    //   &amp;  -> &
    //   &amp;nbsp; -> &nbsp;
    // --------------------------------------------------------

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_undo_html_special_chars($str)
    {
        $str = preg_replace('/&gt;/i', '>', $str);
        $str = preg_replace('/&lt;/i', '<', $str);
        $str = preg_replace('/&quot;/i', '"', $str);
        $str = preg_replace('/&#039;/i', "'", $str);
        $str = preg_replace('/&amp;nbsp;/i', '&nbsp;', $str);

        return $str;
    }

    // --------------------------------------------------------
    // undo html entities
    //   &amp;abc;  -> &abc;
    // --------------------------------------------------------

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_undo_html_entity_char($str)
    {
        return preg_replace('/&amp;([0-9a-zA-z]+);/sU', '&\\1;', $str);
    }

    // --------------------------------------------------------
    // undo html entities
    //   &amp;#123; -> &#123;
    // --------------------------------------------------------

    /**
     * @param $str
     * @return null|string|string[]
     */
    public function xml_undo_html_entity_numeric($str)
    {
        return preg_replace('/&amp;#([0-9a-fA-F]+);/sU', '&#\\1;', $str);
    }

    //---------------------------------------------------------
    // TAB \x09 \t
    // LF  \xOA \n
    // CR  \xOD \r
    //---------------------------------------------------------

    /**
     * @param        $str
     * @param string $replace
     * @return null|string|string[]
     */
    public function replace_control_code($str, $replace = ' ')
    {
        $str = preg_replace('/[\x00-\x08]/', $replace, $str);
        $str = preg_replace('/[\x0B-\x0C]/', $replace, $str);
        $str = preg_replace('/[\x0E-\x1F]/', $replace, $str);
        $str = preg_replace('/[\x7F]/', $replace, $str);

        return $str;
    }

    /**
     * @param        $str
     * @param string $replace
     * @return null|string|string[]
     */
    public function replace_return_code($str, $replace = ' ')
    {
        $str = preg_replace("/\n/", $replace, $str);
        $str = preg_replace("/\r/", $replace, $str);

        return $str;
    }

    // --- class end ---
}
