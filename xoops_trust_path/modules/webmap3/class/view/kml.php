<?php
// $Id: kml.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_show_kml
//=========================================================
class webmap3_view_kml
{
	var $_xoops_param ;
	var $_kml_class ;

	var $_DIRNAME;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_view_kml( $dirname )
{
	$this->_DIRNAME = $dirname;
	$this->_xoops_param =& webmap3_xoops_param::getInstance();
	$this->_kml_class   =& webmap3_api_kml::getSingleton( $dirname );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_view_kml( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// pulic
//---------------------------------------------------------
function build_webmap3_kml()
{
	$this->_kml_class->api_build_kml( $this->_build_placemarks() );
}

function view_webmap3_kml()
{
	$this->_kml_class->api_view_kml( $this->_build_placemarks() );
}

function _build_placemarks()
{
	$placemark = array(
		'name'        => $this->get_config('address'),
		'description' => $this->get_config('loc_marker_info'),
		'latitude'    => $this->get_config('latitude'),
		'longitude'   => $this->get_config('longitude'),
	);
	return array($placemark) ;
}

//---------------------------------------------------------
// config
//---------------------------------------------------------
function get_config( $name )
{
	return $this->_xoops_param->get_module_config_by_name( $name );
}

// --- class end ---
}

?>