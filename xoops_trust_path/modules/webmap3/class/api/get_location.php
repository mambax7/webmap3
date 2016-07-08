<?php
// $Id: get_location.php,v 1.1 2012/04/09 11:55:33 ohwada Exp $

// 2012-04-02 K.OHWADA
// set_use_center_marker()

//=========================================================
// webmap3 module
// 2012-03-31 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_api_get_location
//=========================================================
class webmap3_api_get_location
{
	var $_map_class;
	var $_html_class;

// center
	var $_latitude  = 0;
	var $_longitude = 0;
	var $_zoom      = 0;
	var $_address   = '';

// element id
	var $_ele_id_parent_latitude  = '';
	var $_ele_id_parent_longitude = '';
	var $_ele_id_parent_zoom      = '';
	var $_ele_id_parent_address   = '';

	var $_ele_id_list             = '';
	var $_ele_id_search           = '';
	var $_ele_id_current_location = '';
	var $_ele_id_current_address  = '';

// map param
	var $_map_type_control            = true;
	var $_zoom_control                = true;
	var $_pan_control                 = true;
	var $_street_view_control         = true;
	var $_scale_control               = false;
	var $_overview_map_control        = true;
	var $_overview_map_control_opened = true;

	var $_map_type_control_style = _C_WEBMAP3_GOOGLE_MAP_TYPE_CONTROL_STYLE;
	var $_zoom_control_style     = _C_WEBMAP3_GOOGLE_ZOOM_CONTROL_STYLE; 
	var $_map_type               = _C_WEBMAP3_GOOGLE_MAP_TYPE;

	var $_use_draggable_marker = true;
	var $_use_center_marker    = false;
	var $_use_search_marker    = true;
	var $_use_current_location = true;
	var $_use_current_address  = true;

// map
	var $_map_div_id = '';
	var $_map_func   = '' ;

// html
	var $_show_set_address     = true;
	var $_show_current_address = true;

// direname ;
	var $_WEBMAP3_DIRNAME ;

// default
	var $_OPENER_MODE_DEFAULT = 'parent';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_api_get_location( $dirname )
{
	$this->_WEBMAP3_DIRNAME = $dirname;

	$this->_map_class   =& webmap3_api_map::getSingleton(  $dirname );
	$this->_html_class  =& webmap3_api_html::getSingleton( $dirname );

	$this->_map_div_id = $dirname."_map_get_location";
	$this->_map_func   = $dirname.'_load_map_get_location' ;

	$this->_ele_id_list   = $dirname."_map_list";
	$this->_ele_id_search = $dirname."_map_search";
	$this->_ele_id_current_location = $dirname."_map_current_location";
	$this->_ele_id_current_address  = $dirname."_map_current_address";
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new webmap3_api_get_location( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function display_get_location()
{
	$opener_mode = $this->get_get( 'mode', $this->_OPENER_MODE_DEFAULT );

	$param = $this->build_param( $opener_mode );

	$this->_html_class->http_output();
	$this->_html_class->header_content_type();
	echo $this->_html_class->fetch_get_location( $param );
}

function build_param( $opener_mode )
{
	$param   = $this->build_map( $opener_mode );
	$head_js = $param['head_js'];

	$this->_html_class->set_head_js( $head_js );
	$this->_html_class->set_map_div_id( $this->_map_div_id );
	$this->_html_class->set_map_func(   $this->_map_func ) ;
	$this->_html_class->set_address(    $this->_address );
	$this->_html_class->set_show_set_address(     $this->_show_set_address );
	$this->_html_class->set_show_current_address( $this->_show_current_address );
	$this->_html_class->set_map_ele_id_list(             $this->_ele_id_list );
	$this->_html_class->set_map_ele_id_search(           $this->_ele_id_search );
	$this->_html_class->set_map_ele_id_current_location( $this->_ele_id_current_location );
	$this->_html_class->set_map_ele_id_current_address(  $this->_ele_id_current_address );

	if ( $opener_mode == 'opener' ) {
		$this->_html_class->set_show_close( true );
	}

	return $this->_html_class->build_param_get_location();
}

function build_map( $opener_mode )
{
	$this->_map_class->init();

	$this->_map_class->set_opener_mode( $opener_mode );

	$this->_map_class->set_map_div_id( $this->_map_div_id ) ;
	$this->_map_class->set_map_func(   $this->_map_func ) ;

	$this->_map_class->set_map_type_control(            $this->_map_type_control );	
	$this->_map_class->set_zoom_control(                $this->_zoom_control );	
	$this->_map_class->set_pan_control(                 $this->_pan_control );
	$this->_map_class->set_street_view_control(         $this->_street_view_control );
	$this->_map_class->set_scale_control(               $this->_scale_control );
	$this->_map_class->set_overview_map_control(        $this->_overview_map_control );
	$this->_map_class->set_overview_map_control_opened( $this->_overview_map_control_opened );
	$this->_map_class->set_map_type_control_style(      $this->_map_type_control_style );
	$this->_map_class->set_zoom_control_style(          $this->_zoom_control_style );
	$this->_map_class->set_map_type(                    $this->_map_type );

	$this->_map_class->set_latitude(  $this->_latitude );
	$this->_map_class->set_longitude( $this->_longitude );
	$this->_map_class->set_zoom(      $this->_zoom );

	$this->_map_class->set_ele_id_list(             $this->_ele_id_list );
	$this->_map_class->set_ele_id_search(           $this->_ele_id_search );
	$this->_map_class->set_ele_id_current_location( $this->_ele_id_current_location );
	$this->_map_class->set_ele_id_current_address(  $this->_ele_id_current_address );

	$this->_map_class->set_ele_id_parent_latitude(  $this->_ele_id_parent_latitude );
	$this->_map_class->set_ele_id_parent_longitude( $this->_ele_id_parent_longitude );
	$this->_map_class->set_ele_id_parent_zoom(      $this->_ele_id_parent_zoom );
	$this->_map_class->set_ele_id_parent_address(   $this->_ele_id_parent_address );

	$this->_map_class->set_use_draggable_marker( $this->_use_draggable_marker );
	$this->_map_class->set_use_center_marker(    $this->_use_center_marker );
	$this->_map_class->set_use_search_marker(    $this->_use_search_marker );
	$this->_map_class->set_use_current_location( $this->_use_current_location );
	$this->_map_class->set_use_current_address(  $this->_use_current_address );

	$param   = $this->_map_class->build_get_location();
	$head_js = $this->_map_class->fetch_get_location_head( $param, false );

	$arr = array(
		'head_js' => $head_js ,
	);

	return $arr;
}

//---------------------------------------------------------
// $_GET
//---------------------------------------------------------
function get_get( $key, $default=null )
{
	$str = isset( $_GET[ $key ] ) ? $_GET[ $key ] : $default;
	return $str;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_latitude( $val )
{
	$this->_latitude = floatval($val);
}

function set_longitude( $val )
{
	$this->_longitude = floatval($val);
}

function set_zoom( $val )
{
	$this->_zoom = intval($val);
}

function set_address( $val )
{
	$this->_address = $val;
}

function set_ele_id_parent_latitude( $val )
{
	$this->_ele_id_parent_latitude = $val;
}

function set_ele_id_parent_longitude( $val )
{
	$this->_ele_id_parent_longitude = $val;
}

function set_ele_id_parent_zoom( $val )
{
	$this->_ele_id_parent_zoom = $val;
}

function set_ele_id_parent_address( $val )
{
	$this->_ele_id_parent_address = $val;
}

function set_ele_id_list( $val )
{
	$this->_ele_id_list = $val;
}

function set_ele_id_search( $val )
{
	$this->_ele_id_search = $val;
}

function set_ele_id_current_location( $val )
{
	$this->_ele_id_current_location = $val;
}

function set_ele_id_current_address( $val )
{
	$this->_ele_id_current_address = $val;
}

function set_map_type_control( $val )
{
	$this->_map_type_control = (bool)$val;
}

function set_zoom_control( $val )
{
	$this->_zoom_control = (bool)$val;
}

function set_pan_control( $val )
{
	$this->_pan_control = (bool)$val;
}

function set_street_view_control( $val )
{
	$this->_street_view_control = (bool)$val;
}

function set_scale_control( $val )
{
	$this->_scale_control = (bool)$val;
}

function set_overview_map_control( $val )
{
	$this->_overview_map_control = (bool)$val;
}

function set_overview_map_control_opened( $val )
{
	$this->_overview_map_control_opened = (bool)$val;
}

function set_map_type_control_style( $val )
{
	$this->_map_type_control_style = $val;
}

function set_zoom_control_style( $val )
{
	$this->_zoom_control_style = $val;
}

function set_map_type( $val )
{
	$this->_map_type = $val;
}

function set_map_div_id( $v )
{
	$this->_map_div_id = $v;
}

function set_map_func( $v )
{
	$this->_map_func = $v;
}

function set_use_draggable_marker( $val )
{
	$this->_use_draggable_marker = (bool)$val;
}

function set_use_center_marker( $val )
{
	$this->_use_center_marker = (bool)$val;
}

function set_use_search_marker( $val )
{
	$this->_use_search_marker = (bool)$val;
}

function set_use_current_location( $val )
{
	$this->_use_current_location = (bool)$val;
}

function set_use_current_address( $val )
{
	$this->_use_current_address = (bool)$val;
}

function set_show_set_address( $v )
{
	$this->_show_set_address = (bool)$v;
}

function set_show_current_address( $v )
{
	$this->_show_current_address = (bool)$v;
}

// --- class end ---
}

?>