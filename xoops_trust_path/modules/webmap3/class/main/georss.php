<?php
// $Id: georss.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// changed build_map()

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_main_georss
//=========================================================
class webmap3_main_georss extends webmap3_view_map
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_main_georss( $dirname )
{
	$this->webmap3_view_map( $dirname );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_main_georss( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	$param = $this->build_main();
	$param['geo_url_s']   = $this->get_config_text('geo_url',   's');
	$param['geo_title_s'] = $this->get_config_text('geo_title', 's');

	$this->build_map();

	return $param;
}

function build_map()
{
	$this->init_map();
	$param = $this->_map_class->build_geoxml( 
		$this->get_config_text('geo_url'), true );
	$this->_map_class->fetch_geoxml_head( $param );
}

// --- class end ---
}

?>