<?php
// $Id: oninstall.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_inc_oninstall
//=========================================================
class webmap3_inc_oninstall extends webmap3_inc_oninstall_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_inc_oninstall()
{
	$this->webmap3_inc_oninstall_base();
	$this->set_trust_dirname( WEBMAP3_TRUST_DIRNAME );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_inc_oninstall();
	}
	return $instance;
}

// --- class end ---
}

?>