<?php
// $Id: index.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// changed build_map()

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_main_index
//=========================================================
class webmap3_main_index extends webmap3_view_map
{
	var $_ZOOM_GEOCODE_DEFAULT = 13;

	var $_ELE_ID_LIST   = "";
	var $_ELE_ID_SEARCH = "";

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_main_index( $dirname )
{
	$this->webmap3_view_map( $dirname );

	$this->_ELE_ID_LIST   = $dirname."webmap3_map_list";
	$this->_ELE_ID_SEARCH = $dirname."webmap3_map_search";
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_main_index( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	$addr = $this->get_config('address');
	$lat  = $this->get_config('latitude');
	$lng  = $this->get_config('longitude');
	$zoom = $this->get_config('zoom');

	if ( isset($_GET['lat']) && isset($_GET['lng']) ) {
		$addr = '';
		$lat  = floatval( $_GET['lat'] );
		$lng  = floatval( $_GET['lng'] );
		$zoom = $this->_ZOOM_GEOCODE_DEFAULT;
		if ( isset($_GET['zoom']) ) {
			$zoom = intval( $_GET['zoom'] );
		}
	}

	$param = $this->build_main();
	$param['address_s']     = $this->sanitize( $addr ) ;
	$param['ele_id_list']   = $this->_ELE_ID_LIST;
	$param['ele_id_search'] = $this->_ELE_ID_SEARCH;

	$this->build_map( $lat, $lng, $zoom );

	return $param;
}

function build_map( $lat, $lng, $zoom )
{
	$this->init_map();
	$this->_map_class->assign_search_js_to_head( true );
	$this->_map_class->set_latitude(  $lat );
	$this->_map_class->set_longitude( $lng );
	$this->_map_class->set_zoom(      $zoom );
	$this->_map_class->set_use_search_marker( 
		$this->get_config('use_search_marker') );
	$this->_map_class->set_ele_id_list( $this->_ELE_ID_LIST );

	$param = $this->_map_class->build_search();
	         $this->_map_class->fetch_search_head( $param );
}

// --- class end ---
}

?>