<?php
// $Id: uploader_lang.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webbase module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

define("_C_WEBMAP3_UPLOADER_NOT_FOUND"         , 1 ) ;
define("_C_WEBMAP3_UPLOADER_INVALID_FILE_SIZE" , 2 ) ;
define("_C_WEBMAP3_UPLOADER_EMPTY_FILE_NAME"   , 3 ) ;
define("_C_WEBMAP3_UPLOADER_NO_FILE"           , 4 ) ;
define("_C_WEBMAP3_UPLOADER_NOT_SET_DIR"       , 5 ) ;
define("_C_WEBMAP3_UPLOADER_NOT_ALLOWED_EXT"   , 6 ) ;
define("_C_WEBMAP3_UPLOADER_PHP_OCCURED"       , 7 ) ;
define("_C_WEBMAP3_UPLOADER_NOT_OPEN_DIR"      , 8 ) ;
define("_C_WEBMAP3_UPLOADER_NO_PERM_DIR"       , 9 ) ;
define("_C_WEBMAP3_UPLOADER_NOT_ALLOWED_MIME"  , 10 ) ;
define("_C_WEBMAP3_UPLOADER_LARGE_FILE_SIZE"   , 11 ) ;
define("_C_WEBMAP3_UPLOADER_LARGE_WIDTH"       , 12 ) ;
define("_C_WEBMAP3_UPLOADER_LARGE_HEIGHT"      , 13 ) ;
define("_C_WEBMAP3_UPLOADER_UPLOAD"            , 14 ) ;

//=========================================================
// class webmap3_lib_uploader_lang
//=========================================================
class webmap3_lib_uploader_lang extends webmap3_lib_uploader
{
	var $_language_class;

	var $_php_upload_errors = array();
	var $_uploader_errors   = array();
	var $_errors            = array();

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_lib_uploader_lang( $dirname , $trust_dirname )
{
	$this->webmap3_lib_uploader();
	$this->_language_class =& webmap3_d3_language_base::getInstance( $dirname , $trust_dirname );
}

function &getInstance( $dirname , $trust_dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_lib_uploader_lang( $dirname , $trust_dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// build error
//---------------------------------------------------------
function build_uploader_errors()
{
	$codes = array_unique( $this->errorCodes );
	foreach ( $codes as $code ) {
		$this->build_uploader_error_single( $code );
	}
	return $this->get_errors();
}

function build_uploader_error_single( $code )
{
	$err1 = $this->get_uploader_error_msg( $code );
	$err2 = '';

	switch ( $code )
	{
		case 7:
			$err2 = $this->get_php_upload_error_msg( $this->mediaError );
			break;

		case 8:
		case 9:
			$err2 = $this->uploadDir ;
			break;

		case 10:
			$err2 = $this->mediaType ;
			break;

		case 11:
			$err1 .= ' : '. $this->mediaSize ;
			$err1 .= ' > '. $this->maxFileSize ;
			break;

		case 12:
			$err1 .= ' : '. $this->mediaWidth ;
			$err1 .= ' > '. $this->maxWidth ;
			break;

		case 13:
			$err1 .= ' : '. $this->mediaHeight ;
			$err1 .= ' > '. $this->maxHeight ;
			break;

		case 14:
			$err2 = $this->mediaName ;
			break;

		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
		default:
			break;
	}

	$this->set_error( $err1 );
	if ( $err2 ) {
		$this->set_error( $err2 );
	}
}

//---------------------------------------------------------
// error msg
//---------------------------------------------------------
function init_errors()
{
	$err_2 = sprintf( $this->get_lang('UPLOADER_PHP_ERR_FORM_SIZE'), 
		$this->format_filesize( $this->maxFileSize ) );

// http://www.php.net/manual/en/features.file-upload.errors.php
	$this->_php_upload_errors = array(
//		0 => $this->get_lang('UPLOADER_PHP_ERR_OK') ,
		1 => $this->get_lang('UPLOADER_PHP_ERR_INI_SIZE') ,
		2 => $err_2 ,
		3 => $this->get_lang('UPLOADER_PHP_ERR_PARTIAL') ,
		4 => $this->get_lang('UPLOADER_PHP_ERR_NO_FILE') ,
		6 => $this->get_lang('UPLOADER_PHP_ERR_NO_TMP_DIR') ,
		7 => $this->get_lang('UPLOADER_PHP_ERR_CANT_WRITE') ,
		8 => $this->get_lang('UPLOADER_PHP_ERR_EXTENSION') ,
	);

	$this->_uploader_errors = array(
		1  => $this->get_lang('UPLOADER_ERR_NOT_FOUND') ,
		2  => $this->get_lang('UPLOADER_ERR_INVALID_FILE_SIZE') ,
		3  => $this->get_lang('UPLOADER_ERR_EMPTY_FILE_NAME') ,
		4  => $this->get_lang('UPLOADER_ERR_NO_FILE') ,
		5  => $this->get_lang('UPLOADER_ERR_NOT_SET_DIR') ,
		6  => $this->get_lang('UPLOADER_ERR_NOT_ALLOWED_EXT') ,
		7  => $this->get_lang('UPLOADER_ERR_PHP_OCCURED') , // mediaError
		8  => $this->get_lang('UPLOADER_ERR_NOT_OPEN_DIR') , // uploadDir
		9  => $this->get_lang('UPLOADER_ERR_NO_PERM_DIR') , // uploadDir
		10 => $this->get_lang('UPLOADER_ERR_NOT_ALLOWED_MIME') , // mediaType
		11 => $this->get_lang('UPLOADER_ERR_LARGE_FILE_SIZE') , // mediaSize
		12 => $this->get_lang('UPLOADER_ERR_LARGE_WIDTH') , // maxWidth
		13 => $this->get_lang('UPLOADER_ERR_LARGE_HEIGHT') , // maxHeight
		14 => $this->get_lang('UPLOADER_ERR_UPLOAD') , // mediaName
	);
}

function get_php_upload_error_msg( $num )
{
	if ( isset( $this->_php_upload_errors[ $num ] ) ) {
		return  $this->_php_upload_errors[ $num ];
	}
	return 'Other Error';
}

function get_uploader_error_msg( $num )
{
	if ( isset( $this->_uploader_errors[ $num ] ) ) {
		return  $this->_uploader_errors[ $num ];
	}
	return 'Other Error';
}

//---------------------------------------------------------
// format
//---------------------------------------------------------
function format_filesize( $size, $precision=2 ) 
{
	$format = '%.'. intval($precision) .'f';
	$bytes  = array('B','KB','MB','GB','TB');
	foreach ( $bytes as $unit ) 
	{
		if ( $size > 1000 ) {
			$size = $size / 1024;
		} else {
			break;
		}
	}
	$str = sprintf( $format, $size ).' '.$unit;
	return $str;
}

//---------------------------------------------------------
// language
//---------------------------------------------------------
function get_lang( $name )
{
	return $this->_language_class->get_constant( $name );
}

//---------------------------------------------------------
// error
//---------------------------------------------------------
function set_error( $msg )
{
// array type
	if ( is_array($msg) ) {
		foreach ( $msg as $m ) {
			$this->_errors[] = $m;
		}

// string type
	} else {
		$arr = explode("\n", $msg);
		foreach ( $arr as $m ) {
			$this->_errors[] = $m;
		}
	}
}

function get_errors()
{
	return $this->_errors;
}

function clear_errors()
{
	$this->_errors = array();
}

// --- class end ---
}

?>