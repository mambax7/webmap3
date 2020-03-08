<?php
// $Id: gicon_form.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
// gicon_info_x gicon_info_y
//---------------------------------------------------------

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_admin_gicon_form
//=========================================================

/**
 * Class webmap3_admin_gicon_form
 */
class webmap3_admin_gicon_form extends webmap3_lib_form_lang
{
    public $_gicon_handler;

    public $_xoops_param;

    public $_cfg_gicon_fsize;
    public $_cfg_gicon_width;

    public $_FILED_COUNTER_1 = 1;
    public $_FILED_COUNTER_2 = 2;

    public $_THIS_FCT = 'gicon_manager';
    public $_THIS_URL;

    public $_URL_SIZE = 80;

    public $_IMAGE_FIELD_NAME  = 'gicon';
    public $_SHADOW_FIELD_NAME = 'gshadow';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * webmap3_admin_gicon_form constructor.
     * @param $dirname
     * @param $trust_dirname
     */
    public function __construct($dirname, $trust_dirname)
    {
        parent::__construct($dirname, $trust_dirname);

        $this->_gicon_handler = webmap3_handler_gicon::getSingleton($dirname);
        $this->_xoops_param   = webmap3_xoops_param::getInstance();

        $this->_cfg_gicon_fsize = $this->_xoops_param->get_module_config_by_name('gicon_fsize');
        $this->_cfg_gicon_width = $this->_xoops_param->get_module_config_by_name('gicon_width');

        $this->_THIS_URL = $this->_MODULE_URL . '/admin/index.php?fct=' . $this->_THIS_FCT;
    }

    /**
     * @param $dirname
     * @param $trust_dirname
     * @return \webmap3_admin_gicon_form|\webmap3_lib_form
     */
    public static function getInstance($dirname = null, $trust_dirname = null)
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new self($dirname, $trust_dirname);
        }

        return $instance;
    }

    //---------------------------------------------------------
    // print form
    //---------------------------------------------------------

    /**
     * @param $mode
     * @param $row
     */
    public function print_form($mode, $row)
    {
        switch ($mode) {
            case 'edit':
                $title  = _AM_WEBMAP3_GICON_MENU_EDIT;
                $action = 'update';
                break;
            case 'new':
            default:
                $title  = _AM_WEBMAP3_GICON_MENU_NEW;
                $action = 'insert';
                break;
        }

        $this->set_row($row);

        echo $this->build_form_upload('upload_gicon');
        echo $this->build_html_token();

        echo $this->build_input_hidden('fct', 'gicon_manager');
        echo $this->build_input_hidden('action', $action);
        echo $this->build_row_hidden('gicon_id');

        echo $this->build_input_hidden('max_file_size', $this->_cfg_gicon_fsize);
        echo $this->build_input_hidden('fieldCounter', $this->_FILED_COUNTER_2);

        echo $this->build_table_begin();
        echo $this->build_line_title($title);

        echo $this->build_comp_text('gicon_title');

        echo $this->_build_line_image_file();
        echo $this->_build_line_shadow_file();

        echo $this->build_comp_text('gicon_anchor_x');
        echo $this->build_comp_text('gicon_anchor_y');

        // TODO
        //  echo $this->build_comp_text( 'gicon_info_x' );
        //  echo $this->build_comp_text( 'gicon_info_y' );

        echo $this->build_line_ele('', $this->_build_ele_button());

        echo $this->build_table_end();
        echo $this->build_form_end();
    }

    /**
     * @return string
     */
    public function _build_line_image_file()
    {
        $desc = _AM_WEBMAP3_CAP_MAXPIXEL . ' ';
        $desc .= $this->_cfg_gicon_width . ' x ';
        $desc .= $this->_cfg_gicon_width . ' px';
        $desc .= "<br >\n";
        $desc .= _AM_WEBMAP3_DSC_RESIZE . ' ';

        $ele = $this->_build_ele_image_file();

        return $this->build_line_cap_ele(_AM_WEBMAP3_GICON_IMAGE_SEL, $desc, $ele);
    }

    /**
     * @return string
     */
    public function _build_ele_image_file()
    {
        $path = $this->get_row_by_key('gicon_image_path');

        $text = $this->build_form_file($this->_IMAGE_FIELD_NAME);
        $text .= "<br >\n";

        if ($path) {
            $text .= $this->_build_image_link($path);
        }

        return $text;
    }

    /**
     * @return string
     */
    public function _build_line_shadow_file()
    {
        return $this->build_line_ele(_AM_WEBMAP3_GICON_SHADOW_SEL, $this->_build_ele_shadow_file());
    }

    /**
     * @return string
     */
    public function _build_ele_shadow_file()
    {
        $path = $this->get_row_by_key('gicon_shadow_path');

        $text = $this->build_form_file($this->_SHADOW_FIELD_NAME);
        $text .= "<br >\n";

        if ($path) {
            $del_name  = 'shadow_del';
            $del_value = $this->_post_class->get_post_int($del_name);
            $del_opts  = [_AM_WEBMAP3_GICON_SHADOW_DEL => $this->_C_YES];

            $text .= $this->build_form_checkbox($del_name, $del_value, $del_opts);
            $text .= "<br >\n";
            $text .= $this->_build_image_link($path);
        }

        return $text;
    }

    /**
     * @param $path
     * @return string
     */
    public function _build_image_link($path)
    {
        $url_s = $this->_gicon_handler->build_icon_url($path, true);
        $text  = '<a href="' . $url_s . '" target="_blank">';
        $text  .= $url_s;
        $text  .= "<br >\n";
        $text  .= '<img src="' . $url_s . '" border="0" >';
        $text  .= "</a><br >\n";

        return $text;
    }

    /**
     * @return string
     */
    public function _build_ele_button()
    {
        $str = $this->build_input_submit('submit', _SUBMIT);
        $str .= ' ';
        $str .= $this->build_input_reset('reset', _CANCEL);

        return $str;
    }

    //---------------------------------------------------------
    // list
    //---------------------------------------------------------

    /**
     * @param $rows
     */
    public function print_list($rows)
    {
        // --- form ---
        echo "<form name='MainForm' action='' method='post' style='margin:10px;'>\n";
        echo $this->build_html_token();
        echo $this->build_input_hidden('delgicon', '');

        // --- table ---
        echo "<table width='100%' class='outer' cellpadding='4' cellspacing='1'>\n";

        echo "<tr valign='middle'>";
        echo '<th>' . _WEBMAP3_GICON_ID . '</th>';
        echo '<th>' . _WEBMAP3_GICON_TITLE . '</th>';
        echo '<th>' . _AM_WEBMAP3_GICON_LIST_IMAGE . '</th>';
        echo '<th>' . _AM_WEBMAP3_GICON_LIST_SHADOW . '</th>';
        echo '<th>' . _AM_WEBMAP3_GICON_ANCHOR . '</th>';

        //  echo "<th>". _AM_WEBMAP3_GICON_WINANC ."</th>";

        echo '<th>' . _AM_WEBMAP3_GICON_LIST_EDIT . '</th>';
        echo "</tr>\n";

        foreach ($rows as $row) {
            $this->_print_line($row);
        }

        echo "</table></form>\n";
        // --- table form end ---
    }

    /**
     * @param $row
     */
    public function _print_line($row)
    {
        $oddeven = $this->get_alternate_class();

        $gicon_id      = (int)$row['gicon_id'];
        $title_s       = $this->sanitize($row['gicon_title']);
        $del_confirm   = 'confirm("' . sprintf(_AM_WEBMAP3_GICON_DELCONFIRM, $title_s) . '")';
        $onclick       = 'if (' . $del_confirm . ') { document.MainForm.delgicon.value="' . $gicon_id . '"; submit(); }';
        $button_delete = "<input type='button' value='" . _DELETE . "' onclick='" . $onclick . "' >";

        echo '<tr>';

        echo '<td class="' . $oddeven . '">';
        echo $gicon_id;
        echo "</td>\n";

        echo '<td class="' . $oddeven . '">';
        echo $title_s;
        echo "</td>\n";

        echo '<td class="' . $oddeven . '">';
        if ($row['gicon_image_path']) {
            $image_url_s = $this->_gicon_handler->build_icon_url($row['gicon_image_path'], true);
            echo '<img src="' . $image_url_s . '" valign="middle" >';
            echo ' ( ' . (int)$row['gicon_image_width'] . ' x ' . (int)$row['gicon_image_height'] . ' )';
        }
        echo "</td>\n";

        echo '<td class="' . $oddeven . '">';
        if ($row['gicon_shadow_path']) {
            $shadow_url_s = $this->_gicon_handler->build_icon_url($row['gicon_shadow_path'], true);
            echo '<img src="' . $shadow_url_s . '" valign="middle" >';
            echo ' ( ' . (int)$row['gicon_shadow_width'] . ' x ' . (int)$row['gicon_shadow_height'] . ' )';
        }
        echo "</td>\n";

        echo '<td class="' . $oddeven . '"> ';
        echo (int)$row['gicon_anchor_x'] . ' x ' . (int)$row['gicon_anchor_y'];
        echo " </td>\n";

        // TODO
        //  echo '<td class="'. $oddeven .'"> ';
        //  echo intval( $row['gicon_info_x'] ) .' x '. intval( $row['gicon_info_y'] ) ;
        //  echo " </td>\n";

        echo '<td class="' . $oddeven . '" nowrap="nowrap" align="center">';
        echo '[<a href="' . $this->_THIS_URL . '&amp;disp=edit&amp;gicon_id=' . $gicon_id . '">';
        echo _EDIT;
        echo '</a>] &nbsp; ';
        echo $button_delete . "\n";
        echo "</td>\n";

        echo "</tr>\n";
    }

    // --- class end ---
}
