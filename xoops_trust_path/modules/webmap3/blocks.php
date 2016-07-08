<?php
// $Id: blocks.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

// 2012-04-02 K.OHWADA
// include/api.php

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME WEBPHOTO_TRUST_PATH are set by caller
//---------------------------------------------------------

if ( ! defined( 'WEBMAP3_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// webmap3 files
//---------------------------------------------------------
include_once WEBMAP3_TRUST_PATH.'/class/d3/optional.php';
include_once WEBMAP3_TRUST_PATH.'/include/optional.php';

webmap3_include_once( 'include/api.php',      $MY_DIRNAME );
webmap3_include_once( 'class/inc/config.php', $MY_DIRNAME );
webmap3_include_once( 'class/inc/blocks.php', $MY_DIRNAME );
webmap3_include_once( 'blocks/functions.php', $MY_DIRNAME );

webmap3_include_language( 'main.php',   $MY_DIRNAME );
webmap3_include_language( 'blocks.php', $MY_DIRNAME );

webmap3_include_once_preload_trust();

?>