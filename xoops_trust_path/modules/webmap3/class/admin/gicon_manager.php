<?php
// $Id: gicon_manager.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webphoto module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webphoto_admin_gicon_manager
//=========================================================
class webmap3_admin_gicon_manager extends webmap3_admin_base
{
    public $_gicon_handler;
    public $_uploader_class;
    public $_gd_class;
    public $_utility_class;
    public $_config_class;
    public $_image_mime;

    public $_cfg_gicon_fsize;
    public $_cfg_gicon_width;
    public $_cfg_gicon_quality;

    public $_post_gicon_id;
    public $_post_delgicon;

    // token
    public $_token_errors     = null;
    public $_token_error_flag = false;

    public $_THIS_FCT = 'gicon_manager';
    public $_THIS_URL;

    public $_ERR_ALLOW_EXTS = null;

    public $_IMAGE_FIELD_NAME  = 'gicon';
    public $_SHADOW_FIELD_NAME = 'gshadow';

    public $_INFO_Y_DEFAULT = 3;

    public $_UPLOADER_PREFIX = 'tmp_';

    public $_TIME_SUCCESS = 1;
    public $_TIME_FAIL    = 5;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname, $trust_dirname)
    {
        parent::__construct($dirname, $trust_dirname);

        $this->_gicon_handler = webmap3_handler_gicon::getSingleton($dirname);
        $this->_image_mime    = webmap3_lib_image_mime::getInstance();
        $this->_post_class    = webmap3_lib_post::getInstance();
        $this->_utility_class = webmap3_lib_utility::getInstance();

        $this->_cfg_gicon_fsize   = $this->_xoops_param->get_module_config_by_name('gicon_fsize');
        $this->_cfg_gicon_width   = $this->_xoops_param->get_module_config_by_name('gicon_width');
        $this->_cfg_gicon_quality = $this->_xoops_param->get_module_config_by_name('gicon_quality');

        $this->_init_gd();
        $this->_init_uploader();

        $image_exts            = $this->_image_mime->get_exts();
        $this->_ERR_ALLOW_EXTS = 'allowed file type is ' . implode(',', $image_exts);

        $this->_ADMIN_INDEX_URL = $this->_MODULE_URL . '/admin/index.php';
        $this->_THIS_URL        = $this->_ADMIN_INDEX_URL . '?fct=' . $this->_THIS_FCT;
    }

    public static function getInstance($dirname, $trust_dirname)
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_admin_gicon_manager($dirname, $trust_dirname);
        }
        return $instance;
    }

    //---------------------------------------------------------
    // main
    //---------------------------------------------------------
    public function main()
    {
        $this->_check();

        switch ($this->_get_action()) {
            case 'insert':
                $this->_insert();
                exit();

            case 'update':
                $this->_update();
                exit();

            case 'delete':
                $this->_delete();
                exit();

            default:
                break;
        }

        xoops_cp_header();

        echo $this->build_admin_menu();
        echo $this->build_admin_title('GICON_MANAGER');

        switch ($this->_get_disp()) {
            case 'edit_form':
                $this->_print_edit_form();
                break;

            case 'new_form':
                $this->_print_new_form();
                break;

            case 'list':
            default:
                $this->_print_list();
                break;
        }

        xoops_cp_footer();
        exit();
    }

    public function _get_action()
    {
        $this->_post_gicon_id = $this->_post_class->get_post_get_int('gicon_id');
        $this->_post_delgicon = $this->_post_class->get_post_int('delgicon');
        $post_action          = $this->_post_class->get_post_text('action');

        if ($post_action == 'insert') {
            return 'insert';
        } elseif (($post_action == 'update') && ($this->_post_gicon_id > 0)) {
            return 'update';
        } elseif ($this->_post_delgicon > 0) {
            return 'delete';
        }

        return 'list';
    }

    public function _get_disp()
    {
        $get_disp = $this->_post_class->get_get_text('disp');

        if (($get_disp == 'edit') && ($this->_post_gicon_id > 0)) {
            return 'edit_form';
        } elseif ($get_disp == 'new') {
            return 'new_form';
        }

        return 'list';
    }

    //---------------------------------------------------------
    // check
    //---------------------------------------------------------
    public function _check()
    {
        $ret = $this->_exec_check();
        switch ($ret) {
            case _C_WEBMAP3_ERR_CHECK_DIR :
                redirect_header($this->_ADMIN_INDEX_URL, $this->_TIME_FAIL, $this->get_format_error());
                exit();

            case 0:
            default;
                break;
        }
    }

    public function _exec_check()
    {
        $ret1 = $this->check_dir($this->_TMP_DIR);
        if ($ret1 < 0) {
            return $ret1;
        }

        $ret2 = $this->check_dir($this->_GICONS_DIR);
        if ($ret2 < 0) {
            return $ret2;
        }

        return 0;
    }

    //---------------------------------------------------------
    // insert
    //---------------------------------------------------------
    public function _insert()
    {
        if (!$this->check_token()) {
            redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $this->get_token_errors());
            exit();
        }

        $ret = $this->_excute_insert();
        switch ($ret) {
            case _C_WEBMAP3_ERR_DB:
                $msg = 'DB error <br />';
                $msg .= $this->get_format_error();
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $msg);
                exit();

            case _C_WEBMAP3_ERR_UPLOAD;
                $msg = 'File Upload Error';
                $msg .= '<br />' . $this->get_format_error(false);
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $msg);
                exit();

            case _C_WEBMAP3_ERR_FILEREAD:
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, _WEBMAP3_ERR_FILEREAD);
                exit();

            case _C_WEBMAP3_ERR_NO_IMAGE;
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, _WEBMAP3_ERR_NOIMAGESPECIFIED);
                exit();

            case _C_WEBMAP3_ERR_NOT_ALLOWED_EXT:
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $this->_ERR_ALLOW_EXTS);
                exit();

            default:
                break;
        }

        redirect_header($this->_THIS_URL, $this->_TIME_SUCCESS, _WEBMAP3_DBUPDATED);
        exit();
    }

    public function _excute_insert()
    {
        $shadow_tmp_name = null;

        $ret1 = $this->_fetch_image(true);
        if ($ret1 < 0) {
            return $ret1;
        }

        $image_tmp_name   = $this->_uploader_get_file_name();
        $image_media_name = $this->_uploader_get_media_name();

        // check image tmp name
        if (empty($image_tmp_name)) {
            return _C_WEBMAP3_ERR_NO_IMAGE;
        }

        $ret2 = $this->_fetch_shadow();
        if ($ret2 < 0) {
            return $ret2;
        } elseif ($ret2 == 1) {
            $shadow_tmp_name = $this->_uploader_get_file_name();
        }

        $row   = $this->_gicon_handler->create();
        $newid = $this->_gicon_handler->insert($row);
        if (!$newid) {
            return $newid;
        }

        $row['gicon_id']          = $newid;
        $row['gicon_time_create'] = time();

        $ret4 = $this->_update_common($row, $image_tmp_name, $shadow_tmp_name, $image_media_name);
        if (!$ret4) {
            return $ret4;
        }

        return 0;
    }

    public function _fetch_image($need_upload)
    {
        return $this->_uploader_fetch($this->_IMAGE_FIELD_NAME, $need_upload);
    }

    public function _fetch_shadow()
    {
        return $this->_uploader_fetch($this->_SHADOW_FIELD_NAME, false);
    }

    public function _update_common($row, $image_tmp_name, $shadow_tmp_name, $image_media_name = null)
    {
        $gicon_id = $row['gicon_id'];

        $title = $this->_post_class->get_post_text('gicon_title');

        // create image if upload
        if ($image_tmp_name) {
            $row = $this->create_main_row($row, $image_tmp_name);

            if (empty($title)) {
                $title = $image_media_name;
            }
        }

        // create shadow if upload
        if ($shadow_tmp_name) {
            $row = $this->create_shadow_row($row, $shadow_tmp_name);
        }

        if ($title) {
            $row['gicon_title'] = $title;
        }

        $row['gicon_time_update'] = time();

        $ret3 = $this->_gicon_handler->update($row);
        if (!$ret3) {
            $this->set_error($this->_gicon_handler->get_errors());
            return _C_WEBMAP3_ERR_DB;
        }

        return 0;
    }

    //---------------------------------------------------------
    // update
    //---------------------------------------------------------
    public function _update()
    {
        if (!$this->check_token()) {
            redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $this->get_token_errors());
            exit();
        }

        $ret = $this->_excute_update();
        switch ($ret) {
            case _C_WEBMAP3_ERR_NO_RECORD:
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, _AM_WEBMAP3_ERR_NO_RECORD);
                exit();

            case _C_WEBMAP3_ERR_DB:
                $msg = 'DB error <br />';
                $msg .= $this->get_format_error();
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $msg);
                exit();

            case _C_WEBMAP3_ERR_UPLOAD;
                $msg = 'File Upload Error';
                $msg .= '<br />' . $this->get_format_error(false);
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $msg);
                exit();

            case _C_WEBMAP3_ERR_FILEREAD:
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, _WEBMAP3_ERR_FILEREAD);
                exit();

            case _C_WEBMAP3_ERR_NOT_ALLOWED_EXT:
                redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $this->_ERR_ALLOW_EXTS);
                exit();

            default:
                break;
        }

        redirect_header($this->_THIS_URL, $this->_TIME_SUCCESS, _WEBMAP3_DBUPDATED);
        exit();
    }

    public function _excute_update()
    {
        $image_tmp_name  = null;
        $shadow_tmp_name = null;

        $post_shadow_del = $this->_post_class->get_post_int('shadow_del');

        $row = $this->_gicon_handler->get_row_by_id($this->_post_gicon_id);
        if (!is_array($row)) {
            return _C_WEBMAP3_ERR_NO_RECORD;
        }

        // set by post
        $row['gicon_anchor_x'] = $this->_post_class->get_post_int('gicon_anchor_x');
        $row['gicon_anchor_y'] = $this->_post_class->get_post_int('gicon_anchor_y');
        $row['gicon_info_x']   = $this->_post_class->get_post_int('gicon_info_x');
        $row['gicon_info_y']   = $this->_post_class->get_post_int('gicon_info_y');

        $ret1 = $this->_fetch_image(false);
        if ($ret1 < 0) {
            return $ret1;
        } elseif ($ret1 == 1) {
            $image_tmp_name = $this->_uploader_get_file_name();
        }

        $ret2 = $this->_fetch_shadow();
        if ($ret2 < 0) {
            return $ret2;
        } elseif ($ret2 == 1) {
            $shadow_tmp_name = $this->_uploader_get_file_name();
        }

        //delete old files
        if ($post_shadow_del || $shadow_tmp_name) {

            // default icons have no name value
            if ($row['gicon_shadow_path'] && $row['gicon_shadow_name']) {
                $this->_unlink_path($row['gicon_shadow_path']);
                $row['gicon_shadow_path']   = '';
                $row['gicon_shadow_name']   = '';
                $row['gicon_shadow_ext']    = '';
                $row['gicon_shadow_width']  = 0;
                $row['gicon_shadow_height'] = 0;
            }
        }

        $ret4 = $this->_update_common($row, $image_tmp_name, $shadow_tmp_name);
        if (!$ret4) {
            return $ret4;
        }

        return 0;
    }

    public function _unlink_path($path)
    {
        $file = XOOPS_ROOT_PATH . $path;
        if ($path && is_file($file)) {
            unlink($file);
        }
    }

    //---------------------------------------------------------
    // delete
    //---------------------------------------------------------
    public function _delete()
    {
        $gicon_id = $this->_post_delgicon;

        if (!$this->check_token()) {
            redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $this->get_token_errors());
            exit();
        }

        $row = $this->_gicon_handler->get_row_by_id($gicon_id);
        if (!is_array($row)) {
            redirect_header($this->_THIS_URL, $this->_TIME_FAIL, _AM_WEBMAP3_ERR_NO_RECORD);
            exit();
        }

        // delete image files
        // default icons have no name value
        if ($row['gicon_image_path'] && $row['gicon_image_name']) {
            $this->_unlink_path($row['gicon_image_path']);
        }
        if ($row['gicon_shadow_path'] && $row['gicon_shadow_name']) {
            $this->_unlink_path($row['gicon_shadow_path']);
        }

        $ret = $this->_gicon_handler->delete_by_id($gicon_id);
        if (!$ret) {
            $this->set_error($this->_gicon_handler->get_errors());
            $msg = 'DB error <br />';
            $msg .= $this->get_format_error();
            redirect_header($this->_THIS_URL, $this->_TIME_FAIL, $msg);
            exit();
        }

        redirect_header($this->_THIS_URL, $this->_TIME_SUCCESS, _WEBMAP3_DBUPDATED);
        exit();
    }

    //---------------------------------------------------------
    // form
    //---------------------------------------------------------
    public function _print_edit_form()
    {
        $row = $this->_gicon_handler->get_row_by_id($this->_post_gicon_id);
        if (!is_array($row)) {
            redirect_header($this->_THIS_URL, $this->_TIME_FAIL, _AM_WEBMAP3_ERR_NO_RECORD);
        }

        $this->_print_gicon_form('edit', $row);
    }

    public function _print_new_form()
    {
        $row = $this->_gicon_handler->create();

        $this->_print_gicon_form('new', $row);
    }

    //---------------------------------------------------------
    // list
    //---------------------------------------------------------
    public function _print_list()
    {
        echo '<p><a href="' . $this->_THIS_URL . '&amp;disp=new">';
        echo _AM_WEBMAP3_GICON_ADD;
        echo '</a></p>' . "\n";

        $rows = $this->_gicon_handler->get_rows_all_asc();

        $this->_print_gicon_list($rows);
    }

    //---------------------------------------------------------
    // create image
    //---------------------------------------------------------
    public function create_main_row($row, $tmp_name)
    {
        if (empty($tmp_name)) {
            return $row;
        }

        $gicon_id   = $row['gicon_id'];
        $image_info = $this->resize_image($gicon_id, $tmp_name, $this->_SUB_DIR_GICONS);

        if (!is_array($image_info) || !$image_info['is_image']) {
            return $row;
        }

        $image_width  = $image_info['width'];
        $image_height = $image_info['height'];

        $row['gicon_image_path']   = $image_info['path'];
        $row['gicon_image_name']   = $image_info['name'];
        $row['gicon_image_ext']    = $image_info['ext'];
        $row['gicon_image_width']  = $image_width;
        $row['gicon_image_height'] = $image_height;
        $row['gicon_anchor_x']     = $image_width / 2;
        $row['gicon_anchor_y']     = $image_height;
        $row['gicon_info_x']       = $image_width / 2;
        $row['gicon_info_y']       = $this->_INFO_Y_DEFAULT;

        return $row;
    }

    public function create_shadow_row($row, $tmp_name)
    {
        if (empty($tmp_name)) {
            return $row;
        }

        $gicon_id   = $row['gicon_id'];
        $image_info = $this->resize_image($gicon_id, $tmp_name, $this->_SUB_DIR_GSHADOWS);

        if (!is_array($image_info) || !$image_info['is_image']) {
            return $row;
        }

        $row['gicon_shadow_path']   = $image_info['path'];
        $row['gicon_shadow_name']   = $image_info['name'];
        $row['gicon_shadow_ext']    = $image_info['ext'];
        $row['gicon_shadow_width']  = $image_info['width'];
        $row['gicon_shadow_height'] = $image_info['height'];

        return $row;
    }

    public function resize_image($gicon_id, $tmp_name, $sub_dir)
    {
        $max_width  = $this->_cfg_gicon_width;
        $max_height = $this->_cfg_gicon_width;

        $width    = 0;
        $height   = 0;
        $is_image = false;

        $ext      = $this->parse_ext($tmp_name);
        $tmp_file = $this->_TMP_DIR . '/' . $tmp_name;

        $name = 'g' . sprintf('%05d', $gicon_id) . '.' . $ext;
        $path = $this->_UPLOADS_PATH . '/' . $sub_dir . '/' . $name;

        $file = $this->_gicon_handler->build_icon_full_path($path);
        $url  = $this->_gicon_handler->build_icon_url($path);

        if ($this->check_resize($tmp_file, $max_width, $max_height)) {
            $ret = $this->_gd_resize_rotate($tmp_file, $file, $max_width, $max_height);
            if (!$ret) {
                return null;
            }
        } else {
            copy($tmp_file, $file);
        }

        $size = getimagesize($file);
        if (is_array($size)) {
            $width    = $size[0];
            $height   = $size[1];
            $is_image = true;
        }

        $arr = array(
            'url'      => $url,
            'path'     => $path,
            'name'     => $name,
            'ext'      => $ext,
            'width'    => $width,
            'height'   => $height,
            'is_image' => $is_image,
        );

        return $arr;
    }

    public function check_resize($file, $max_width, $max_height)
    {
        $size = getimagesize($file);
        if (!is_array($size)) {
            return false;
        }
        $width  = $size[0];
        $height = $size[1];
        if ($width > $max_width) {
            return true;
        }
        if ($height > $max_height) {
            return true;
        }
        return false;
    }

    //---------------------------------------------------------
    // gd class
    //---------------------------------------------------------
    public function _init_gd()
    {
        $this->_gd_class = new webmap3_lib_gd();
        $this->_gd_class->set_jpeg_quality($this->_cfg_gicon_quality);
    }

    public function _gd_resize_rotate($src_file, $dst_file, $max_width, $max_height, $rotate = 0)
    {
        return $this->_gd_class->resize_rotate($src_file, $dst_file, $max_width, $max_height, $rotate);
    }

    //---------------------------------------------------------
    // uploader
    //---------------------------------------------------------
    public function _init_uploader()
    {
        $this->_uploader_class = new webmap3_lib_uploader_lang($this->_DIRNAME, $this->_TRUST_DIRNAME);

        $this->_uploader_class->setPrefix($this->_UPLOADER_PREFIX);
        $this->_uploader_class->setUploadDir($this->_TMP_DIR);
        $this->_uploader_class->setAllowedExtensions($this->_image_mime->get_exts());
        $this->_uploader_class->setAllowedMimeTypes($this->_image_mime->get_mimes());
        $this->_uploader_class->setMaxFileSize($this->_cfg_gicon_fsize);
        $this->_uploader_class->init_errors();
    }

    public function _uploader_fetch($field, $need_upload)
    {
        $this->clear_errors();

        $ret = $this->_uploader_class->fetchMedia($field);
        if (!$ret) {
            $error_num = $this->_uploader_class->getMediaError();
            if ($error_num == UPLOAD_ERR_NO_FILE) {
                if ($need_upload) {
                    return _C_WEBMAP3_ERR_NO_IMAGE;
                }
                return 0;   // no action
            }

            $this->set_error($this->_uploader_class->build_uploader_errors());
            return _C_WEBMAP3_ERR_UPLOAD;
        }

        $ret = $this->_uploader_class->upload();
        if (!$ret) {
            $this->set_error($this->_uploader_class->build_uploader_errors());
            return _C_WEBMAP3_ERR_UPLOAD;
        }

        return 1;  // success
    }

    public function _uploader_get_file_name()
    {
        return $this->_uploader_class->getSavedFileName();
    }

    public function _uploader_get_media_name()
    {
        return $this->_uploader_class->getMediaName();
    }

    //---------------------------------------------------------
    // token
    //---------------------------------------------------------
    public function check_token($allow_repost = false)
    {
        global $xoopsGTicket;
        if (is_object($xoopsGTicket)) {
            if (!$xoopsGTicket->check(true, '', $allow_repost)) {
                $this->_token_error_flag = true;
                $this->_token_errors     = $xoopsGTicket->getErrors();
                return false;
            }
        }
        $this->_token_error_flag = false;
        return true;
    }

    //---------------------------------------------------------
    // utility
    //---------------------------------------------------------
    public function parse_ext($file)
    {
        return $this->_utility_class->parse_ext($file);
    }

    //---------------------------------------------------------
    // admin_gicon_form
    //---------------------------------------------------------
    public function _print_gicon_form($mode, $row)
    {
        $form = webmap3_admin_gicon_form::getInstance($this->_DIRNAME, $this->_TRUST_DIRNAME);
        $form->print_form($mode, $row);
    }

    public function _print_gicon_list($rows)
    {
        $form = webmap3_admin_gicon_form::getInstance($this->_DIRNAME, $this->_TRUST_DIRNAME);
        $form->print_list($rows);
    }

    // --- class end ---
}
