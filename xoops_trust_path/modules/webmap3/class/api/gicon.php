<?php
// $Id: gicon.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_api_gicon
//=========================================================
class webmap3_api_gicon
{
	var $_gicon_handler;
	var $_header_class;

	var $_DIRNAME;
	var $_URL_ICON_DEFAULT;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_api_gicon( $dirname )
{
	$this->_DIRNAME = $dirname;
	$this->_gicon_handler  =& webmap3_handler_gicon::getSingleton( $dirname );
	$this->_header_class   =& webmap3_xoops_header::getSingleton(  $dirname );

	$this->_URL_ICON_DEFAULT = XOOPS_URL.'/modules/'.$dirname.'/images/markers/marker.png';
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new webmap3_api_gicon( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// get_image_url
//---------------------------------------------------------
function get_image_url( $id )
{
	if ( $id == 0 ) {
		return $this->_URL_ICON_DEFAULT ;
	}

	$row = $this->_gicon_handler->get_row_by_id( $id );
	if ( ! isset( $row['gicon_image_path'] ) ) {
		return '';
	}
	return $this->_gicon_handler->build_icon_url( $row['gicon_image_path'] );
}

//---------------------------------------------------------
// get_sel_options
//---------------------------------------------------------
function get_sel_options( $flag_none=false, $flag_flip=false )
{
	$arr = $this->_gicon_handler->get_sel_options( $flag_none );
	if ( $flag_flip && is_array($arr)  ) {
		$arr = array_flip( $arr );
	}
	return $arr;
}

//---------------------------------------------------------
// get gicons js
//---------------------------------------------------------
function get_gicons_js( $id=0 )
{
	$param = $this->build_gicons( $id );
	return $this->fetch_gicons( $param );
}

function build_gicons( $id=0 )
{
	$show_gicon_js = false;
	$gicon_js      = null;

	$icon_0 = array(
		'id'        => 0,
		'image_url' => $this->_URL_ICON_DEFAULT ,
	);

	$gicon_icons = $this->_gicon_handler->get_icons();
	$gicon_icons[] = $icon_0;

	$arr = array(
		'xoops_dirname' => $this->_DIRNAME ,
		'id'            => $id ,
		'gicon_icons'   => $gicon_icons ,
	);

	return $arr;
}

function fetch_gicons( $param )
{
	$tmplate = 'db:'. $this->_DIRNAME .'_inc_gicon_js.html' ;
	$tpl = new XoopsTpl();
	$tpl->assign( $param );
	return $tpl->fetch( $tmplate );
}

//---------------------------------------------------------
// header
//---------------------------------------------------------
function assign_gicon_js_to_head( $flag_header=true )
{
	return $this->_header_class->assign_or_get_js( 'gicon', $flag_header ) ;
}

// --- class end ---
}

?>