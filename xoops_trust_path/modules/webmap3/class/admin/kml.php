<?php
// $Id: kml.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_admin_kml
//=========================================================
class webmap3_admin_kml
{
	var $_builder;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_admin_kml( $dirname )
{
	$this->_builder =& webmap3_view_kml::getInstance( $dirname );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_admin_kml( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	$this->_builder->view_webmap3_kml();
}

// --- class end ---
}

?>