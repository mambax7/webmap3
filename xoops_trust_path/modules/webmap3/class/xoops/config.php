<?php
// $Id: config.php,v 1.1.1.1 2012/03/17 09:28:13 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_xoops_config
//=========================================================
class webmap3_xoops_config extends webmap3_xoops_config_dirname
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_xoops_config( $dirname )
{
	$this->webmap3_xoops_config_dirname( $dirname );
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new webmap3_xoops_config( $dirname );
	}
	return $singletons[ $dirname ];
}

// --- class end ---
}

?>