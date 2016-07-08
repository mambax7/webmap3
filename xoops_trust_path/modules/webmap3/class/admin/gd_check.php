<?php
// $Id: gd_check.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_admin_gd_check
//=========================================================
class webmap3_admin_gd_check extends webmap3_admin_gd_check_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_admin_gd_check()
{
	$this->webmap3_admin_gd_check_base();
	$this->set_lang_success( _AM_WEBMAP3_CHK_GD_SUCCESS );
	$this->set_lang_failed(  _AM_WEBMAP3_CHK_GD_FAILED );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_admin_gd_check();
	}
	return $instance;
}

// --- class end ---
}

?>