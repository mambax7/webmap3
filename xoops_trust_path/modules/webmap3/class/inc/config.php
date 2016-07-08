<?php
// $Id: config.php,v 1.1.1.1 2012/03/17 09:28:14 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_inc_config
//=========================================================
//---------------------------------------------------------
// caller inc_blocks
//---------------------------------------------------------

class webmap3_inc_config
{
	var $_cached_config = array();
	var $_DIRNAME ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_inc_config( $dirname )
{
	$this->_DIRNAME = $dirname;
	$this->_cached_config = $this->get_config_by_dirname( $dirname );
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new webmap3_inc_config( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// cache 
//---------------------------------------------------------
function get_by_name( $name )
{
	if ( isset($this->_cached_config[ $name ]) ) {
		return $this->_cached_config[ $name ];
	}
	return false;
}

//---------------------------------------------------------
// xoops class
//---------------------------------------------------------
function get_config_by_dirname( $dirname )
{
	$modid = $this->get_modid_by_dirname( $dirname );
	return $this->get_config_by_modid( $modid );
}

function get_config_by_modid( $modid )
{
	$config_handler =& xoops_gethandler('config');
	return $config_handler->getConfigsByCat( 0, $modid );
}

function get_modid_by_dirname( $dirname )
{
	$module_handler =& xoops_gethandler('module');
	$module = $module_handler->getByDirname( $dirname );
	if ( !is_object($module) ) {
		return false;
	}
	return $module->getVar( 'mid' );
}

// --- class end ---
}

?>