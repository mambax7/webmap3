<?php
// $Id: gicon_table_manage.php,v 1.1.1.1 2012/03/17 09:28:12 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class webmap3_admin_gicon_table_manage
//=========================================================
class webmap3_admin_gicon_table_manage extends webmap3_lib_admin_manage
{
	var $_URL_SIZE = 80;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_admin_gicon_table_manage( $dirname, $trust_dirname )
{
	$this->webmap3_lib_admin_manage( $dirname, $trust_dirname );
	$this->set_manage_handler( webmap3_handler_gicon::getSingleton( $dirname ) );
	$this->set_manage_title_by_name( 'GICON_TABLE_MANAGE' );

	$this->set_manage_list_column_array(
		array( 'gicon_title', 'gicon_image_path' ) );

	$menu_class =& webmap3_admin_menu::getInstance( $dirname, $trust_dirname );
	$this->set_manage_menu( $menu_class->build_menu() );

}

function &getInstance( $dirname, $trust_dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new webmap3_admin_gicon_table_manage( $dirname, $trust_dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	$this->_main();
}

//=========================================================
// override for caller
//=========================================================
function _build_row_by_post()
{
	$row = array(
		'gicon_id'            => $this->_post_class->get_post_get_int( 'gicon_id' ),
		'gicon_title'         => $this->_post_class->get_post_text( 'gicon_title' ),
		'gicon_image_url'     => $this->_post_class->get_post_url(  'gicon_image_url' ),
		'gicon_image_path'    => $this->_post_class->get_post_text( 'gicon_image_path' ),
		'gicon_image_ext'     => $this->_post_class->get_post_text( 'gicon_image_ext' ),
		'gicon_shadow_url'    => $this->_post_class->get_post_url(  'gicon_shadow_url' ),
		'gicon_shadow_path'   => $this->_post_class->get_post_text( 'gicon_shadow_path' ),
		'gicon_shadow_ext'    => $this->_post_class->get_post_text( 'gicon_shadow_ext' ),
		'gicon_image_width'   => $this->_post_class->get_post_int(  'gicon_image_width' ),
		'gicon_image_height'  => $this->_post_class->get_post_int(  'gicon_image_height' ),
		'gicon_shadow_width'  => $this->_post_class->get_post_int(  'gicon_shadow_width' ),
		'gicon_shadow_height' => $this->_post_class->get_post_int(  'gicon_shadow_height' ),
		'gicon_anchor_x'      => $this->_post_class->get_post_int(  'gicon_anchor_x' ),
		'gicon_anchor_y'      => $this->_post_class->get_post_int(  'gicon_anchor_y' ),
		'gicon_info_x'        => $this->_post_class->get_post_int(  'gicon_info_x' ),
		'gicon_info_y'        => $this->_post_class->get_post_int(  'gicon_info_y' ),

	);
	return $row;
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function _print_form( $row )
{
	echo $this->build_manage_form_begin( $row );

	echo $this->build_table_begin();
	echo $this->build_manage_header();
	echo $this->build_manage_id();
	echo $this->build_comp_text( 'gicon_title' );
	echo $this->build_comp_text( 'gicon_time_create' );
	echo $this->build_comp_text( 'gicon_time_update' );
	echo $this->build_comp_text( 'gicon_image_path',  $this->_URL_SIZE  );
	echo $this->build_comp_text( 'gicon_image_name' );
	echo $this->build_comp_text( 'gicon_image_ext' );
	echo $this->build_comp_text( 'gicon_shadow_path',  $this->_URL_SIZE  );
	echo $this->build_comp_text( 'gicon_shadow_name' );
	echo $this->build_comp_text( 'gicon_shadow_ext' );
	echo $this->build_comp_text( 'gicon_image_width' );
	echo $this->build_comp_text( 'gicon_image_height' );
	echo $this->build_comp_text( 'gicon_shadow_width' );
	echo $this->build_comp_text( 'gicon_shadow_height' );
	echo $this->build_comp_text( 'gicon_anchor_x' );
	echo $this->build_comp_text( 'gicon_anchor_y' );
	echo $this->build_comp_text( 'gicon_info_x' );
	echo $this->build_comp_text( 'gicon_info_y' );

	echo $this->build_manage_submit();

	echo "</table></form>\n";
}

// --- class end ---
}

?>