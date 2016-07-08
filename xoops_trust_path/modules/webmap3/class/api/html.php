<?php
// $Id: html.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-04 K.OHWADA
// build_display_style_js()

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_api_html
//=========================================================
class webmap3_api_html
{
	var $_multibyte_class;
	var $_language_class;
	var $_form_class;
	var $_header_class;

	var $_WEBMAP3_DIRNAME;
	var $_dirname = 'webmap3';

	var $_map_div_id = "";
	var $_map_func   = "";

// Yokohama, Japan
	var $_address   = _C_WEBMAP3_CFG_ADDRESS;
	var $_latitude  = _C_WEBMAP3_CFG_LATITUDE;
	var $_longitude = _C_WEBMAP3_CFG_LONGITUDE;
	var $_zoom      = _C_WEBMAP3_CFG_ZOOM;

// display
	var $_display_iframe_url ;
	var $_display_iframe_width  = '95%';
	var $_display_iframe_height = '650px';
	var $_display_src           = '';
	var $_display_url_desc      = '';
	var $_display_url_opener    = '';
	var $_display_anchor        = 'google_map';
	var $_display_open_name     = 'webmap3_window';
	var $_display_open_width    = 800;
	var $_display_open_height   = 850;
	var $_display_div_id        = 'webmap3_map_iframe' ;
	var $_display_div_style     = 'display:block;' ;
	var $_display_func_popup       = 'webmap3_display_popup';
	var $_display_func_style_show  = 'webmap3_display_style_show';
	var $_display_func_style_hide  = 'webmap3_display_style_hide';
	var $_display_func_html_show   = 'webmap3_display_html_show';
	var $_display_func_html_hide   = 'webmap3_display_html_hide';

// gicon
	var $_gicon_select_id   = "webmap3_gicon_id";
	var $_gicon_select_name = "webmap3_gicon_id";
	var $_gicon_select_func = "webmap3_gicon_onchange";
	var $_gicon_img_id      = "webmap3_gicon_img";
	var $_gicon_img_src     = '';
	var $_gicon_img_alt     = 'gicon';
	var $_gicon_img_border  = 0;
	var $_gicon_id          = 0;
	var $_gicon_options     = '';
	var $_gicon_icon        = '';

// get location
	var $_head_js    = '';
	var $_map_js     = '';
	var $_map_width  = '95%';
	var $_map_height = '300px';
	var $_map_style_option = 'border:1px solid #909090; margin-bottom:6px;' ;
	var $_show_close       = false;
	var $_show_hide_map    = false;
	var $_show_set_address = false;
	var $_show_innerhtml   = false;
	var $_show_search_reverse  = false;
	var $_show_current_address = false;

// element id
	var $_map_ele_id_list   = "webmap3_map_list";
	var $_map_ele_id_search = "webmap3_map_search";
	var $_map_ele_id_current_location = "webmap3_map_current_location";
	var $_map_ele_id_current_address  = "webmap3_map_current_address";

// template
	var $_template_display_style_js  = '';
	var $_template_display_html_js   = '';
	var $_template_set_location_form = '' ;
	var $_template_get_location      = '' ;

// lang
	var $_lang_latitude       = 'Latitude';
	var $_lang_longitude      = 'Longitude';
	var $_lang_zoom           = 'Zoom';
	var $_lang_edit           = 'Edit' ;
	var $_lang_search         = 'Search';
	var $_lang_search_reverse = 'Search Address from current location';
	var $_lang_search_list    = 'Search Result List';
	var $_lang_get_location   = 'Get Location';
	var $_lang_get_address    = 'Get Address';
	var $_lang_display_hide       = 'Disp Off';
	var $_lang_close          = 'Close' ;
	var $_lang_display_desc   = 'Get location with google maps';
	var $_lang_display_new    = 'Show new window';
	var $_lang_display_popup  = 'Show popup';
	var $_lang_display_inline = 'Show inline';
	var $_lang_title_set_location = 'Set Location' ;
	var $_lang_title_get_location = 'Get Location' ;
	var $_lang_current_location   = 'Current Location';
	var $_lang_not_iframe_support = 'This brawser not suppot iframe';
	var $_lang_not_js_support     = 'This brawser not suppot javascrip';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_api_html( $dirname )
{
	$this->_WEBMAP3_DIRNAME = $dirname;

	$this->_dirname    = $dirname;

	$this->_display_iframe_url  = XOOPS_URL.'/modules/'.$dirname.'/index.php?fct=get_location';
	$this->_display_src = XOOPS_URL.'/modules/'.$dirname.'/images/google_maps.png';
	$this->_display_url_opener = XOOPS_URL.'/modules/'.$dirname.'/index.php?fct=get_location&mode=opener';
	$this->_display_url_desc   = $this->_display_url_opener;

	$this->_form_class      =& webmap3_lib_form::getInstance();
	$this->_multibyte_class =& webmap3_lib_multibyte::getInstance();
	$this->_header_class    =& webmap3_xoops_header::getSingleton($dirname );
	$this->_language_class  =& webmap3_d3_language::getSingleton( $dirname );

	$this->_map_div_id = $dirname.'_map_get_location' ;
	$this->_map_func   = $dirname.'_load_map_get_location' ;

	$this->_map_ele_id_list   = $dirname."_map_list";
	$this->_map_ele_id_search = $dirname."_map_search";
	$this->_map_ele_id_current_location = $dirname."_map_current_location";
	$this->_map_ele_id_current_address  = $dirname."_map_current_address";

	$this->_template_display_style_js  = 'db:'.$dirname.'_inc_display_style_js.html' ;
	$this->_template_display_html_js   = 'db:'.$dirname.'_inc_display_html_js.html' ;
	$this->_template_set_location_form = 'db:'.$dirname.'_inc_set_location_form.html' ;
	$this->_template_get_location      = 'db:'.$dirname.'_inc_get_location.html' ;

	$this->_lang_latitude       = $this->get_lang('LATITUDE') ;
	$this->_lang_longitude      = $this->get_lang('LONGITUDE') ;
	$this->_lang_zoom           = $this->get_lang('ZOOM') ;
	$this->_lang_search         = $this->get_lang('SEARCH') ;
	$this->_lang_search_reverse = $this->get_lang('SEARCH_REVERSE') ;
	$this->_lang_search_list    = $this->get_lang('SEARCH_LIST') ;
	$this->_lang_zoom           = $this->get_lang('ZOOM') ;
	$this->_lang_get_location   = $this->get_lang('GET_LOCATION');
	$this->_lang_get_address    = $this->get_lang('GET_ADDRESS');
	$this->_lang_display_desc   = $this->get_lang('DISPLAY_DESC');
	$this->_lang_display_new    = $this->get_lang('DISPLAY_NEW');
	$this->_lang_display_popup  = $this->get_lang('DISPLAY_POPUP');
	$this->_lang_display_inline = $this->get_lang('DISPLAY_INLINE');
	$this->_lang_display_hide   = $this->get_lang('DISPLAY_HIDE');
	$this->_lang_edit           = _EDIT ;
	$this->_lang_close          = _CLOSE ;
	$this->_lang_title_set_location = $this->get_lang('TITLE_SET_LOCATION') ;
	$this->_lang_title_get_location = $this->get_lang('TITLE_GET_LOCATION') ;
	$this->_lang_current_location   = $this->get_lang('CURRENT_LOCATION') ;
	$this->_lang_current_address    = $this->get_lang('CURRENT_ADDRESS') ;
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new webmap3_api_html( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function header_content_type()
{
	header('Content-Type:text/html; charset=UTF-8');
}

function build_display_iframe()
{
	$text  = '<iframe src="'. $this->sanitize( $this->_display_iframe_url ) .'" ';
	$text .= 'width="'.  $this->sanitize( $this->_display_iframe_width ) .'" ';
	$text .= 'height="'. $this->sanitize( $this->_display_iframe_height ) .'" ';
	$text .= 'frameborder="0" scrolling="yes" >';
	$text .= "\n";
	$text .= $this->_lang_not_iframe_support ;
	$text .= '</iframe>';
	$text .= "\n";

	return $text;
}

function build_display_anchor()
{
	$text  = '<a name="'. $this->_display_anchor .'"></a>';
	$text .= "\n";
	return $text;
}

function build_display_logo()
{
	$src_s = $this->sanitize( $this->_display_src );

	$text  = '<img src="'. $src_s .'" border="0" alt="google map" />';
	$text .= "\n";
	return $text;
}

function build_display_desc()
{
	$text  = $this->_lang_display_desc;
	$text .= "\n";
	return $text;
}

function build_display_new()
{
	$href = $this->sanitize( $this->_display_url_opener );

	$text  = '<a href="'. $href .'" target="_blank">';
	$text .= "\n";
	$text .= $this->_lang_display_new ;
	$text .= '</a>';
	$text .= "\n";
	return $text;
}

function build_display_popup()
{
	$text  = '<a href="#'. $this->_display_anchor .'" ';
	$text .= 'onclick="'. $this->_display_func_popup .'()">';
	$text .= "\n";
	$text .= $this->_lang_display_popup ;
	$text .= '</a>';
	$text .= "\n";
	return $text;
}

function build_display_style_show()
{
	return $this->build_display_show( $this->_display_func_style_show );
}

function build_display_style_hide()
{
	return $this->build_display_hide( $this->_display_func_style_hide );
}

function build_display_html_show()
{
	return $this->build_display_show( $this->_display_func_html_show );
}

function build_display_html_hide()
{
	return $this->build_display_hide( $this->_display_func_html_hide );
}

function build_display_show( $func )
{
	$text  = '<a href="#'. $this->_display_anchor .'" ';
	$text .= 'onclick="'. $func .'()">';
	$text .= "\n";
	$text .= $this->_lang_display_inline ;
	$text .= '</a>';
	$text .= "\n";
	return $text;
}

function build_display_hide( $func )
{
	$text  = '<a href="#'. $this->_display_anchor .'" ';
	$text .= 'onclick="'. $func .'()">';
	$text .= "\n";
	$text .= $this->_lang_display_hide ;
	$text .= '</a>';
	$text .= "\n";
	return $text;
}

function build_display_div_style_begin()
{
	$text  = '<div ';
	$text .= 'id="'.    $this->_display_div_id .'" ';
	$text .= 'style="'. $this->_display_div_style .'">';
	$text .= "\n";
	return $text;
}

function build_display_div_begin()
{
	$text  = '<div ';
	$text .= 'id="'. $this->_display_div_id .'">';
	$text .= "\n";
	return $text;
}

function build_display_div_end()
{
	$text  = '</div>';
	$text .= "\n";
	return $text;
}

function build_gicon_icon()
{
	$icon = '';
	if ( isset( $this->_gicon_options[ $this->_gicon_id ] ) ) {
		$icon = $this->_gicon_options[ $this->_gicon_id ] ;
	}
	$icon_s = $this->sanitize( $icon );
	return $icon_s;
}

function build_gicon_select()
{
	$options = $this->_form_class->build_form_select_options( $this->_gicon_id, $this->_gicon_options );

	$text  = '<select ';
	$text .= 'id="'.   $this->_gicon_select_id .'" ';
	$text .= 'name="'. $this->_gicon_select_name .'" ';
	$text .= 'onChange="';
	$text .= $this->_gicon_select_func;
	$text .= '(this,';
	$text .= "'". $this->_gicon_img_id ."'";
	$text .= ')">' ;
	$text .= "\n";
	$text .= $options ;
	$text .= "\n";
	$text .= "</select>";
	$text .= "\n";

	return $text;
}

function build_gicon_img()
{
	$src_s  = $this->sanitize( $this->_gicon_img_src );
	$alt_s  = $this->sanitize( $this->_gicon_img_alt );
	$border = intval( $this->_gicon_img_border );

	$text  = '<img ';
	$text .= 'id="'. $this->_gicon_img_id .'" ';
	$text .= 'src="'. $src_s .'" ';
	$text .= 'alt="'. $alt_s .'" ';
	$text .= 'border="'. $border .'" ';
	$text .= '/>';
	$text .= "\n";

	return $text;
}

function build_display_style_js()
{
	$param = $this->build_param_display_js();

	$tpl = new XoopsTpl();
	$tpl->assign( $param );
	return $tpl->fetch( $this->_template_display_style_js );
}

function build_display_html_js()
{
	$param = $this->build_param_display_js();

	$tpl = new XoopsTpl();
	$tpl->assign( $param );
	return $tpl->fetch( $this->_template_display_html_js );
}

function build_set_location()
{
	$param = $this->build_param_set_location();

	$tpl = new XoopsTpl();
	$tpl->assign( $param );
	return $tpl->fetch( $this->_template_set_location_form );
}

function fetch_get_location( $param )
{
	$tpl = new XoopsTpl();
	$tpl->assign( $param );
	return $tpl->fetch( $this->_template_get_location );
}

function build_param_display_js()
{
	$arr = array(
		'func_popup'      => $this->_display_func_popup ,
		'func_style_show' => $this->_display_func_style_show ,
		'func_style_hide' => $this->_display_func_style_hide ,
		'open_url'        => $this->_display_url_opener ,
		'open_name'       => $this->_display_open_name ,
		'open_width'      => $this->_display_open_width ,
		'open_height'     => $this->_display_open_height ,
		'div_id'          => $this->_display_div_id ,

// innerHTML
		'func_html_show'  => $this->_display_func_html_show ,
		'func_html_hide'  => $this->_display_func_html_hide ,
		'ancher'          => $this->_display_anchor ,
		'iframe_url'      => $this->_display_iframe_url , 
		'iframe_width'    => $this->_display_iframe_width ,
		'iframe_height'   => $this->_display_iframe_height ,
		'lang_hide'       => $this->_lang_display_hide ,
	);

	return $arr;
}

function build_param_set_location()
{
	$arr = array(
		'dirname'         => $this->_dirname ,
		'ticket'          => $this->_ticket ,
		'latitude'        => $this->_latitude ,
		'longitude'       => $this->_longitude ,
		'zoom'            => $this->_zoom ,
		'id_latitude'     => $this->_id_latitude ,
		'id_longitude'    => $this->_id_longitude ,
		'id_zoom'         => $this->_id_zoom ,
		'name_latitude'   => $this->_name_latitude ,
		'name_longitude'  => $this->_name_longitude ,
		'name_zoom'       => $this->_name_zoom ,
		'lang_title'      => $this->_lang_title_set_location ,
		'lang_latitude'   => $this->_lang_latitude ,
		'lang_longitude'  => $this->_lang_longitude ,
		'lang_zoom'       => $this->_lang_zoom ,
		'lang_edit'       => $this->_lang_edit,
	);

	return $arr;
}

function build_param_get_location()
{
	$map_style  = 'width:'.  $this->_map_width .'; ';
	$map_style .= 'height:'. $this->_map_height .'; ';
	$map_style .= $this->_map_style_option ;

	$arr = array(
		'webmap3_dirname' => $this->_WEBMAP3_DIRNAME ,
		'map_div_id'    => $this->_map_div_id ,
		'map_func'      => $this->_map_func ,

		'head_js'       => $this->_head_js ,
		'map_style'     => $map_style ,
		'func_hide_map' => $this->_display_func_style_hide,
		'address'       => $this->_address ,

		'ele_id_list'   => $this->_map_ele_id_list ,
		'ele_id_search' => $this->_map_ele_id_search ,
		'ele_id_current_location' => $this->_map_ele_id_current_location ,
		'ele_id_current_address'  => $this->_map_ele_id_current_address ,

		'show_close'           => $this->_show_close ,
		'show_hide_map'        => $this->_show_hide_map ,
		'show_set_address'     => $this->_show_set_address ,
		'show_search_reverse'  => $this->_show_search_reverse ,
		'show_current_address' => $this->_show_current_address ,

		'lang_title'            => $this->_lang_title_get_location ,
		'lang_search'           => $this->_lang_search ,
		'lang_search_reverse'   => $this->_lang_search_reverse ,
		'lang_search_list'      => $this->_lang_search_list ,
		'lang_get_location'     => $this->_lang_get_location ,
		'lang_get_address'      => $this->_lang_get_address , 
		'lang_display_hide'     => $this->_lang_display_hide ,
		'lang_close'            => $this->_lang_close ,
		'lang_current_address'	=> $this->_lang_current_address ,
		'lang_current_location' => $this->_lang_current_location ,
		'lang_not_js_support'	=> $this->_lang_not_js_support ,

	);

	$ret = $this->utf8_array( $arr );
	return $ret;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function sanitize( $str )
{
	return htmlspecialchars( $str, ENT_QUOTES );
}

//---------------------------------------------------------
// language
//---------------------------------------------------------
function get_lang( $name )
{
	return $this->_language_class->get_constant( $name );
}

function utf8_array( $arr )
{
	$ret = array();
	foreach ( $arr as $k => $v ) {
		$ret[ $k ] = $this->utf8( $v );
	}
	return $ret;
}

//---------------------------------------------------------
// multibyte
//---------------------------------------------------------
function http_output( $encoding='pass' )
{
	return $this->_multibyte_class->m_mb_http_output( $encoding );
}

function utf8( $str )
{
	return $this->_multibyte_class->convert_to_utf8( $str );
}

//---------------------------------------------------------
// header
//---------------------------------------------------------
function assign_to_header( $var )
{
	$this->_header_class->assign_xoops_module_header( $var );
}

//---------------------------------------------------------
// setter
//---------------------------------------------------------
function set_dirname( $v )
{
	$this->_dirname = $v;
}

function set_template( $v )
{
	$this->_template = $v;
}

function set_latitude( $v )
{
	$this->_latitude = floatval($v);
}

function set_longitude( $v )
{
	$this->_longitude = floatval($v);
}

function set_zoom( $v )
{
	$this->_zoom = intval($v);
}

function set_address( $v )
{
	$this->_address = $v;
}

function set_ticket( $v )
{
	$this->_ticket = $v;
}

function set_display_iframe_url( $v )
{
	$this->_display_iframe_url = $v;
}

function set_display_iframe_width( $v, $u='px' )
{
	$this->_display_iframe_width = intval($v).$u;
}

function set_display_iframe_height( $v, $u='px' )
{
	$this->_display_iframe_height = intval($v).$u;
}

function set_display_anchor( $v )
{
	$this->_display_anchor = $v;
}

function set_display_url_opener( $v )
{
	$this->_display_url_opener = $v;
}

function set_display_func_inline( $v )
{
	$this->_display_func_inline = $v;
}

function set_display_func_popup( $v )
{
	$this->_display_func_popup = $v;
}

function set_display_func_hide( $v )
{
	$this->_display_func_hide = $v;
}

function set_display_open_name( $v )
{
	$this->_display_open_name = $v;
}

function set_display_open_width( $v )
{
	$this->_display_open_width = intval($v);
}

function set_display_open_height( $v )
{
	$this->_display_open_height = intval($v);
}

function set_display_div_id( $v )
{
	$this->_display_div_id = $v;
}

function set_display_div_style( $v )
{
	$this->_display_div_style = $v;
}

function set_gicon_select_id( $v )
{
	$this->_gicon_select_id = $v;
}

function set_gicon_select_name( $v )
{
	$this->_gicon_select_name = $v;
}

function set_gicon_img_id( $v )
{
	$this->_gicon_img_id = $v;
}

function set_gicon_img_src( $v )
{
	$this->_gicon_img_src = $v;
}

function set_gicon_img_alt( $v )
{
	$this->_gicon_img_alt = $v;
}

function set_gicon_img_border( $v )
{
	$this->_gicon_img_border = intval($v);
}

function set_gicon_id( $v )
{
	$this->_gicon_id = intval($v);
}

function set_gicon_options( $v )
{
	$this->_gicon_options = $v;
}

function set_head_js( $v )
{
	$this->_head_js = $v;
}

function set_map_js( $v )
{
	$this->_map_js = $v;
}

function set_map_style_option( $v )
{
	$this->_map_style_option = $v;
}

function set_map_width( $v, $u='px' )
{
	$this->_map_width = intval($v).$u;
}

function set_map_height( $v, $u='px' )
{
	$this->_map_height = intval($v).$u;
}

function set_map_div_id( $v )
{
	$this->_map_div_id = $v;
}
function set_map_func( $v )
{
	$this->_map_func = $v;
}

function set_map_ele_id_list( $v )
{
	$this->_map_ele_id_list = $v;
}

function set_map_ele_id_search( $v )
{
	$this->_map_ele_id_search = $v;
}

function set_map_ele_id_current_location( $v )
{
	$this->_map_ele_id_current_location = $v;
}

function set_map_ele_id_current_address( $v )
{
	$this->_map_ele_id_current_address = $v;
}

function set_show_set_address( $v )
{
	$this->_show_set_address = (boolean)$v;
}

function set_show_close( $v )
{
	$this->_show_close = (boolean)$v;
}

function set_show_hide_map( $v )
{
	$this->_show_hide_map = (boolean)$v;
}

function set_show_search_reverse( $v )
{
	$this->_show_search_reverse = (boolean)$v;
}

function set_show_current_address( $v )
{
	$this->_show_current_address = (boolean)$v;
}

function set_template_display_style_js( $v )
{
	$this->_template_display_style_js = $v;
}

function set_template_display_html_js( $v )
{
	$this->_template_display_html_js = $v;
}

function set_template_set_location_form( $v )
{
	$this->_template_set_location_form = $v;
}

function set_template_get_location( $v )
{
	$this->_template_get_location = $v;
}

function set_lang_latitude( $v )
{
	$this->_lang_latitude = $v;
}

function set_lang_longitude( $v )
{
	$this->_lang_longitude = $v;
}

function set_lang_zoom( $v )
{
	$this->_lang_zoom = $v;
}

function set_lang_title_set_location( $v )
{
	$this->_lang_title_set_location = $v;
}

function set_lang_edit( $v )
{
	$this->_lang_edit = $v;
}

function set_lang_not_iframe_support( $v )
{
	$this->_lang_not_iframe_support = $v;
}

function set_lang_title_get_location()
{
	$this->_lang_title_get_location = $v;
}

function set_lang_search()
{
	$this->_lang_search = $v;
}

function set_lang_search_reverse()
{
	$this->_lang_search_reverse = $v;
}

function set_lang_search_list()
{
	$this->_lang_search_list = $v;
}

function set_lang_get_location()
{
	$this->_lang_get_location = $v;
}

function set_lang_display_hide()
{
	$this->_lang_display_hide = $v;
}

function set_lang_current_location()
{
	$this->_lang_current_location = $v;
}

function set_lang_display_desc()
{
	$this->_lang_display_desc = $v;
}

function set_lang_display_new()
{
	$this->_lang_display_new = $v;
}

function set_lang_display_inline()
{
	$this->_lang_display_inline = $v;
}

// --- class end ---
}

?>