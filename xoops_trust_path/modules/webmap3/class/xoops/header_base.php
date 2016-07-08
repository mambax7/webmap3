<?php
// $Id: header_base.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_xoops_header_base
//=========================================================
class webmap3_xoops_header_base
{
	var $_prefix ;

	var $_DIRNAME    ;
	var $_MODULE_URL ;
	var $_TRUST_DIRNAME ;
	var $_TRUST_DIR ;
	var $_LIBS_URL  ;

	var $_XOOPS_MODULE_HADER = 'xoops_module_header';
	var $_FLAG_ASSIGN_HEADER = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_xoops_header_base( $dirname , $trust_dirname )
{
	$this->_DIRNAME       = $dirname;
	$this->_MODULE_URL    = XOOPS_URL.'/modules/'.$dirname;
	$this->_TRUST_DIRNAME = $trust_dirname;
	$this->_TRUST_DIR     = XOOPS_TRUST_PATH .'/modules/'. $trust_dirname;
	$this->_LIBS_URL      = $this->_MODULE_URL .'/libs';

// preload
	$const_name = '_C_'. $trust_dirname .'_XOOPS_MODULE_HEADER' ;
	if ( defined($const_name) ) {
		$this->_XOOPS_MODULE_HADER = constant($const_name) ;
	}

	$const_name = '_C_'. $trust_dirname .'_PRELOAD_FLAG_ASSIGN_HEADER' ;
	if ( defined($const_name) ) {
		$this->_FLAG_ASSIGN_HEADER = (bool)constant($const_name) ;
	}

	$this->_prefix = '_C_'. $trust_dirname.'_HEADER_LOADED_' ;
}

//--------------------------------------------------------
// utility
//--------------------------------------------------------
function check_once_name( $name )
{
	return $this->check_once( $this->build_const_name( $name ) );
}

function build_const_name( $name )
{
	$str = strtoupper( $this->_prefix . $name );
	return $str;
}

function check_once( $const_name )
{
	if ( !defined( $const_name ) ) {
		define( $const_name, 1 );
		return true ;
	}
	return false ;
}

function build_link_css_libs( $css )
{
	return $this->build_link_css( $this->_LIBS_URL .'/'. $css );
}

function build_link_css( $herf )
{
	$str = '<link id="lnkStyleSheet" rel="stylesheet" type="text/css" href="'. $herf .'" />'."\n";
	return $str;
}

function build_script_js_libs( $js )
{
	return $this->build_script_js( $this->_LIBS_URL .'/'. $js ) ;
}

function build_script_js( $src )
{
	$str = '<script src="'. $src .'" type="text/javascript"></script>'."\n";
	return $str;
}

function build_envelop_js( $text )
{
	$str  = '<script type="text/javascript">'."\n";
	$str .= '//<![CDATA['."\n";
	$str .= $text ."\n";
	$str .= '//]]>'."\n";
	$str .= '</script>'."\n";
	return $str;
}

function build_link_rss( $url )
{
	$str = '<link rel="alternate" type="application/rss+xml" title="RSS" href="'. $url .'" />'."\n";
	return $str;
}

function check_name_js( $name )
{
	return $this->check_once_name( $name.'_js' );
}

function build_name_js( $name )
{
	return $this->build_script_js_libs( $name.'.js' );
}

//--------------------------------------------------------
// template
//--------------------------------------------------------
function assign_xoops_module_header( $var )
{
	global $xoopsTpl;
	if ( $var ) {
		$xoopsTpl->assign(
			$this->_XOOPS_MODULE_HADER , 
			$this->get_xoops_module_header()."\n". $var
		);
	}
}

function get_xoops_module_header()
{
	global $xoopsTpl;
	return $xoopsTpl->get_template_vars( $this->_XOOPS_MODULE_HADER );
}

// --- class end ---
}

?>