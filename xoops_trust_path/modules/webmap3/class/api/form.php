<?php
// $Id: form.php,v 1.1 2012/04/09 11:55:33 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-04-02 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_api_form
//=========================================================
class webmap3_api_form
{
	var $_gicon_class;
	var $_html_class;

// setter
	var $_gicon_select_name;
	var $_gicon_select_id;
	var $_gicon_img_id;
	var $_display_url_iframe;
	var $_display_url_opener;

	var $_DIRNAME;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_api_form( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->_gicon_class =& webmap3_api_gicon::getSingleton( $dirname );
	$this->_html_class  =& webmap3_api_html::getSingleton(  $dirname );
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new webmap3_api_form( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function build_form_js( $flag_header )
{
	$js1 = $this->_gicon_class->get_gicons_js();
	list($show, $js2) = $this->_gicon_class->assign_gicon_js_to_head( $flag_header );

	$js = $js1;
	if ( !$flag_header ) {
		$js .= $js2;
	}
	return $js."\n";
}

function build_display_style_js()
{
	return $this->_html_class->build_display_style_js()."\n";
}

function build_display_html_js()
{
	return $this->_html_class->build_display_html_js()."\n";
}

function build_ele_gicon( $id )
{
	$options = $this->_gicon_class->get_sel_options( true );
	$img_src = $this->_gicon_class->get_image_url( $id ) ;

	$this->_html_class->set_gicon_id( $id );
	$this->_html_class->set_gicon_options( $options );
	$this->_html_class->set_gicon_img_src( $img_src );
	$this->_html_class->set_gicon_select_name( $this->_gicon_select_name );
	$this->_html_class->set_gicon_select_id(   $this->_gicon_select_id );
	$this->_html_class->set_gicon_img_id(      $this->_gicon_img_id );

	$text  = $this->_html_class->build_gicon_select();
	$text .= "<br />\n";
	$text .= $this->_html_class->build_gicon_img();

	return $text;
}

function build_form_desc_style()
{
	return $this->build_form_desc( 
		$this->_html_class->build_display_style_show() , 
		$this->_html_class->build_display_style_hide()
	);
}

function build_form_desc_html( $flag_show=false )
{
//	$this->_html_class->set_display_div_html_display( $flag_show );

	return $this->build_form_desc( 
		$this->_html_class->build_display_html_show() , 
		$this->_html_class->build_display_html_hide()
	);
}

function build_form_desc( $show, $hide )
{
	$text  = $this->_html_class->build_display_anchor();
	$text .= $this->_html_class->build_display_logo();
	$text .= " &nbsp; ";
	$text .= $this->_html_class->build_display_desc();
	$text .= "<br />\n";
	$text .= $this->_html_class->build_display_popup();
	$text .= "<br />\n";
	$text .= $show;
	$text .= " &nbsp; ";
	$text .= $hide;
	$text .= "<br />\n";

	return $text;
}

function build_div_iframe()
{
	$text  = $this->_html_class->build_display_div_style_begin();
	$text .= $this->_html_class->build_display_iframe();
	$text .= $this->_html_class->build_display_div_end();

	return $text;
}

function build_div_html()
{
	$text  = $this->_html_class->build_display_div_begin();
	$text .= $this->_html_class->build_display_div_end();

	return $text;
}

function build_gicon_icon()
{
	return $this->_html_class->build_gicon_icon();
}

//---------------------------------------------------------
// setter
//---------------------------------------------------------
function set_gicon_select_name( $v )
{
	$this->_gicon_select_name = $v;
}

function set_gicon_select_id( $v )
{
	$this->_gicon_select_id = $v;
}

function set_gicon_img_id( $v )
{
	$this->_gicon_img_id = $v;
}

function set_display_url_iframe( $v )
{
	$this->_display_url_iframe = $v;
	$this->_html_class->set_display_iframe_url( $v );
}

function set_display_url_opener( $v )
{
	$this->_display_url_opener = $v;
	$this->_html_class->set_display_url_opener( $v );
}

// --- class end ---
}

?>