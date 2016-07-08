<?php
// $Id: form_lang.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webbase module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_lib_form_lang
//=========================================================
class webmap3_lib_form_lang extends webmap3_lib_form
{
	var $_post_class;
	var $_utility_class;
	var $_language_class;
	var $_xoops_class;

// xoops param
	var $_is_login_user    = false;
	var $_is_module_admin  = false;
	var $_xoops_language;
	var $_xoops_sitename;
	var $_xoops_uid    = 0;
	var $_xoops_uname  = null;
	var $_xoops_groups = null ;

	var $_DIRNAME       = null;
	var $_TRUST_DIRNAME = null;
	var $_MODULE_DIR;
	var $_MODULE_URL;
	var $_TRUST_DIR;

	var $_MODULE_NAME  = null;
	var $_MODULE_ID    = 0;
	var $_TIME_START  = 0;

	var $_THIS_FCT_URL;

	var $_LANG_MUST_LOGIN = 'You must login';
	var $_LANG_TIME_SET   = 'Set Time';

	var $_FLAG_ADMIN_SUB_MENU = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_lib_form_lang( $dirname, $trust_dirname )
{
	$this->_DIRNAME       = $dirname;
	$this->_MODULE_DIR    = XOOPS_ROOT_PATH .'/modules/'. $dirname;
	$this->_MODULE_URL    = XOOPS_URL       .'/modules/'. $dirname;
	$this->_MODULE_NAME   = $dirname;
	$this->_TRUST_DIRNAME = $trust_dirname;
	$this->_TRUST_DIR     = XOOPS_TRUST_PATH .'/modules/'. $trust_dirname;

	$this->webmap3_lib_form();
	$this->set_form_name(    $dirname.'_form' );
	$this->set_title_header( $dirname );

	$this->_xoops_class    = new webmap3_xoops_param();
	$this->_post_class     = new webmap3_lib_post();
	$this->_utility_class  = new webmap3_lib_utility();
	$this->_language_class = new webmap3_d3_language_base( $dirname , $trust_dirname );

	$this->_xoops_language  = $this->_xoops_class->get_config_by_name( 'language' );
	$this->_xoops_sitename  = $this->_xoops_class->get_config_by_name( 'sitename' );
	$this->_module_mid      = $this->_xoops_class->get_module_mid();
	$this->_module_name     = $this->_xoops_class->get_module_name( 'n' );
	$this->_xoops_uid       = $this->_xoops_class->get_user_uid();
	$this->_xoops_uname     = $this->_xoops_class->get_user_uname( 'n' );
	$this->_xoops_groups    = $this->_xoops_class->get_user_groups();
	$this->_is_login_user   = $this->_xoops_class->is_login_user();
	$this->_is_module_admin = $this->_xoops_class->is_module_admin();

	$this->_init_this_fct();

}

function _init_this_fct()
{
	$this->_THIS_FCT_URL = $this->_THIS_URL;
	$get_fct = $this->_post_class->get_post_get_text('fct');
	if ( $get_fct ) {
		$this->_THIS_FCT_URL .= '?fct='.$get_fct;
	}
}

//---------------------------------------------------------
// build comp
//---------------------------------------------------------
function build_comp_label( $name )
{
	return $this->build_row_label( $this->get_lang( $name ), $name );
}

function build_comp_label_time( $name )
{
	return $this->build_row_label_time( $this->get_lang( $name ), $name );
}

function build_comp_text( $name, $size=50 )
{
	return $this->build_row_text( $this->get_lang( $name ), $name, $size );
}

function build_comp_url( $name, $size=50, $flag_link=false )
{
	return $this->build_row_url( $this->get_lang( $name ), $name, $size, $flag_link );
}

function build_comp_textarea( $name, $rows=5, $cols=50 )
{
	return $this->build_row_textarea( $this->get_lang( $name ), $name, $rows, $cols );
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function get_post_js_checkbox_array()
{
	$name = $this->_FORM_NAME . '_id';
	return $this->_post_class->get_post( $name );
}

//---------------------------------------------------------
// utility class
//---------------------------------------------------------
function str_to_array( $str, $pattern )
{
	return $this->_utility_class->str_to_array( $str, $pattern );
}

function array_to_str( $arr, $glue )
{
	return $this->_utility_class->array_to_str( $arr, $glue );
}

function format_filesize( $size )
{
	return $this->_utility_class->format_filesize( $size );
}

function parse_ext( $file )
{
	return $this->_utility_class->parse_ext( $file );
}

function mysql_datetime_to_str( $datetime )
{
	return $this->_utility_class->mysql_datetime_to_str( $datetime );
}

function get_mysql_date_today()
{
	return $this->_utility_class->get_mysql_date_today();
}

function build_error_msg( $msg, $title='', $flag_sanitize=true )
{
	return $this->_utility_class->build_error_msg( $msg, $title, $flag_sanitize );
}

//---------------------------------------------------------
// xoops timestamp
//---------------------------------------------------------
function format_timestamp( $time, $format="l", $timeoffset="" )
{
	return formatTimestamp( $time, $format, $timeoffset );
}

//---------------------------------------------------------
// xoops 
//---------------------------------------------------------
function get_xoops_group_objs()
{
	return $this->_xoops_class->get_group_obj();
}

function get_cached_xoops_db_groups()
{
	return $this->_xoops_class->get_cached_groups();
}

function get_xoops_user_name( $uid, $usereal=0 )
{
	return $this->_xoops_class->get_user_uname_from_id( $uid, $usereal );
}

function build_xoops_userinfo( $uid, $usereal=0 )
{
	return $this->_xoops_class->build_userinfo( $uid, $usereal );
}

function get_xoops_user_list( $limit=0, $start=0 )
{
	return $this->_xoops_class->get_member_user_list( $limit, $start );
}

//---------------------------------------------------------
// d3 language
//---------------------------------------------------------
function get_lang_array()
{
	return $this->_language_class->get_lang_array();
}

function get_lang( $name )
{
	return $this->_language_class->get_constant( $name );
}

// --- class end ---
}

?>