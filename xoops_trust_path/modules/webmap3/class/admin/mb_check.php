<?php
// $Id: mb_check.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_admin_mb_check
//=========================================================
class webmap3_admin_mb_check extends webmap3_admin_mb_check_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_admin_mb_check()
{
	$this->webmap3_admin_mb_check_base();
	$this->set_lang_success( _AM_WEBMAP3_CHK_MB_SUCCESS );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_admin_mb_check();
	}
	return $instance;
}

// --- class end ---
}

?>