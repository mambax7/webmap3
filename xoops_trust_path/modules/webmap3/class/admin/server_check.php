<?php
// $Id: server_check.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_admin_server_check
//=========================================================
class webmap3_admin_server_check extends webmap3_lib_server_info
{
	var $_ini_safe_mode = 0;
	var $_prefix_am;

	var $_DIRNAME;
	var $_MODULE_URL;
	var $_MODULE_DIR;
	var $_TRUST_DIRNAME;
	var $_TRUST_DIR;

	var $_MKDIR_MODE = 0777;
	var $_CHAR_SLASH = '/';
	var $_HEX_SLASH  = 0x2f;	// 0x2f = slash '/'
	var $_PREFIX     = 'CHK' ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_admin_server_check( $dirname, $trust_dirname )
{
	$this->_DIRNAME       = $dirname ;
	$this->_MODULE_URL    = XOOPS_URL       .'/modules/'. $dirname;
	$this->_MODULE_DIR    = XOOPS_ROOT_PATH .'/modules/'. $dirname;
	$this->_TRUST_DIRNAME = $trust_dirname;
	$this->_TRUST_DIR     = XOOPS_TRUST_PATH .'/modules/'. $trust_dirname;

	$this->webmap3_lib_server_info();

	$this->_ini_safe_mode = ini_get( "safe_mode" );

	$this->_prefix_am = '_AM_'. $this->_TRUST_DIRNAME .'_'.$this->_PREFIX.'_' ;

	$this->set_lang_need_on(       $this->get_lang( 'NEED_ON' ) );
	$this->set_lang_recommend_off( $this->get_lang( 'RECOMMEND_OFF' ) );
}

function &getInstance( $dirname, $trust_dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_admin_server_check( $dirname, $trust_dirname );
	}
	return $instance;
}
//---------------------------------------------------------
// main
//---------------------------------------------------------
function build_mulitibyte_link( $flag_sjis=false )
{
	$str  = '<a href="'. $this->_MODULE_URL .'/admin/index.php?fct=mb_check&amp;charset=UTF-8" target="_blank">';
	$str .= $this->get_lang('MB_LINK');
	$str .= ' (UTF-8) </a><br />'."\n";
	if ( $flag_sjis ) {
		$str .= '<a href="'. $this->_MODULE_URL .'/admin/index.php?fct=mb_check&amp;charset=Shift_JIS" target="_blank">';
		$str .= $this->get_lang('MB_LINK');
		$str .= ' (Shift_JIS) </a><br />'."\n";
	}
	$str .= " ".$this->get_lang('MB_DSC')."<br />\n" ;
	return $str;
}

function build_pathinfo_link()
{
	$str  = '<a href="'. $this->_MODULE_URL .'/admin/index.php/abc/" target="_blank">';
	$str .= $this->get_lang('PATHINFO_LINK');
	$str .= '</a><br />'."\n";
	$str .= " ".$this->get_lang('PATHINFO_DSC')."<br />\n" ;
	return $str;
}

function build_gd()
{
	$gd_class =& webmap3_lib_gd::getInstance();

	$str = "<b>GD</b><br />\n";
	list( $ret, $msg ) = $gd_class->version();
	$str .= $this->build_ret_msg( $ret , $msg );
	$str .= "<br />\n";
	if ( $ret ) {
		$str .= '<a href="'. $this->_MODULE_URL .'/admin/index.php?fct=gd_check" target="_blank">';
		$str .= $this->get_lang('GD_LINK');
		$str .= '</a><br />'."\n";
		$str .= " ".$this->get_lang('GD_DSC')."<br />\n" ;
	}
	$str .= "<br />\n";
	return $str;
}

function build_qr_code()
{
	$str  = '<a href="'. $this->_MODULE_URL .'/admin/index.php?fct=build_qr" target="_blank">';
	$str .= $this->get_lang('QR_LINK') ;
	$str .= '</a><br />'."\n";
	$str .= " &nbsp; ".$this->get_lang('QR_DSC')."<br />\n" ;
	return $str;
}

function build_path( $path, $need_first_slash=false, $need_last_slash=false, $flag_root_path=false )
{
// first char is slash
	if ( ord( $path ) == $this->_HEX_SLASH ) {
		if ( $need_first_slash ) {
			$dir = XOOPS_ROOT_PATH.$path;
		} else {
			return $this->highlight_red( $this->get_lang('ERR_CHAR_FIRST_NOT') );
		}

// first char is NOT slash
	} else {
		if ( $need_first_slash ) {
			return $this->highlight_red( $this->get_lang('ERR_CHAR_FIRST_NEED') );
		} else {
			$dir = XOOPS_ROOT_PATH.'/'.$path;
		}
	}

	return $this->build_path_full( $dir, $need_last_slash, $flag_root_path );
}

function build_path_full( $dir, $need_last_slash=false, $flag_root_path=false )
{
// last char is slash
	if ( substr( $dir , -1 ) == $this->_CHAR_SLASH ) {
		if ( ! $need_last_slash ) {
			return $this->highlight_red( $this->get_lang('ERR_CHAR_LAST_NOT') );
		}

// first char is NOT slash
	} else {
		if ( $need_last_slash ) {
			return $this->highlight_red( $this->get_lang('ERR_CHAR_LAST_NEED') );
		}
	}
	return $this->build_path_dir( $dir, $flag_root_path ) ;
}

function build_path_dir( $dir, $flag_root_path=false )
{
	$flag = false ;
	$str  = '';

	if ( ! is_dir( $dir ) ) {
		if ( $this->_ini_safe_mode ) {
			$str .= $this->highlight_red( $this->get_lang('ERR_DIR_PERM') );

		} else {
			$str .= $this->highlight_red( $this->get_lang('ERR_DIR_NOT') );
		}

	} elseif ( ! is_writable( $dir ) || ! is_readable( $dir ) ) {
		$str .= $this->highlight_red( $this->get_lang('ERR_DIR_WRITE') );

	} elseif ( $flag_root_path ) {
		if ( strpos( $dir, XOOPS_ROOT_PATH ) === 0 ) {
			$str .= "<br />\n";
			$str .= $this->highlight_red( $this->get_lang('WARN_DIR_GEUST') );
			$str .= $this->get_lang('WARN_DIR_RECOMMEND') ."<br />\n" ;

		} else {
			$flag = true ;
		}

	} else {
		$flag = true ;
	}

	if ( $flag ) {
		$str .= $this->highlight_green( 'ok' );
	}
	$str .= "<br />\n";
	return $str ;
}

//---------------------------------------------------------
// language
//---------------------------------------------------------
function get_lang( $name )
{
	$const_name = strtoupper( $this->_prefix_am . $name );
	$lang = defined( $const_name ) ? constant( $const_name ) : $name ;
	return $lang;
}

// --- class end ---
}

?>