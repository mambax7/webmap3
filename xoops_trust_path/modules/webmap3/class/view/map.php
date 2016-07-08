<?php
// $Id: map.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// webmap3_view_base

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_view_map
//=========================================================
class webmap3_view_map extends webmap3_view_base
{
	var $_map_class;

	var $_map_div_id = '' ;
	var $_map_func   = '' ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_view_map( $dirname )
{
	$this->webmap3_view_base( $dirname );

	$this->_map_class    =& webmap3_api_map::getSingleton( $dirname );

	$this->_map_div_id = $dirname.'_map_main' ;
	$this->_map_func   = $dirname.'_map_main_load' ;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function build_main()
{
	$p = $this->build_base();
	$p['map_div_id'] = $this->_map_div_id ;
	$p['map_func']   = $this->_map_func ;
	return $p;
}

function init_map()
{
	$this->_map_class->init();

	$this->_map_class->assign_google_map_js_to_head( true );
	$this->_map_class->assign_map_js_to_head( true );

	$this->_map_class->set_latitude(  $this->get_config('latitude') );
	$this->_map_class->set_longitude( $this->get_config('longitude') );
	$this->_map_class->set_zoom(      $this->get_config('zoom') );

	$this->_map_class->set_map_type_control(            $this->get_config('map_type_control') );	
	$this->_map_class->set_zoom_control(                $this->get_config('zoom_control') );	
	$this->_map_class->set_pan_control(                 $this->get_config('pan_control') );
	$this->_map_class->set_street_view_control(         $this->get_config('street_view_control') );
	$this->_map_class->set_scale_control(               $this->get_config('scale_control') );
	$this->_map_class->set_overview_map_control(        $this->get_config('overview_map_control') );
	$this->_map_class->set_overview_map_control_opened( $this->get_config('overview_map_opened') );
	$this->_map_class->set_map_type_control_style(      $this->get_config('map_type_control_style') );
	$this->_map_class->set_zoom_control_style(          $this->get_config('zoom_control_style') );
	$this->_map_class->set_map_type(                    $this->get_config('map_type') );

	$this->_map_class->set_map_div_id( $this->_map_div_id ) ;
	$this->_map_class->set_map_func(   $this->_map_func ) ;

}

// --- class end ---
}

?>