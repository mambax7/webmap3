<?php
// $Id: constants.php,v 1.3 2012/04/09 12:00:36 ohwada Exp $

//=========================================================
// webphoto module
// 2012-03-01 K.OHWADA
//=========================================================

// define("_C_WEBMAP3_MAP_TITLE_LENGH", 100 ) ;

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

// === define begin ===
if( !defined("_C_WEBMAP3_LOADED") ) 
{

define("_C_WEBMAP3_LOADED", 1 ) ;

//=========================================================
// Constant
//=========================================================

// config
define("_C_WEBMAP3_CFG_ADDRESS", "Yokohama, Japan" ) ;
define("_C_WEBMAP3_CFG_LATITUDE", "35.443924694026" ) ;
define("_C_WEBMAP3_CFG_LONGITUDE", "139.63738918304" ) ;
define("_C_WEBMAP3_CFG_ZOOM", "10" ) ;
define("_C_WEBMAP3_CFG_LOC_MARKER_INFO", '<b>Example</b><br/><a href="http://www.city.yokohama.lg.jp/en/" target="_blank"><img src="http://www.city.yokohama.lg.jp/bunka/outline/brand/open-yokohama.jpg" width="70" border="0" /><br />Yokohama City Office</a>' ) ;
define("_C_WEBMAP3_CFG_GEO_URL", "http://api.flickr.com/services/feeds/geo/?id=8645522@N06&format=rss_200" ) ;
define("_C_WEBMAP3_CFG_GEO_TITLE", "Flickr : ken.ohwada" ) ;
define("_C_WEBMAP3_CFG_GICON_FSIZE", "102400" ) ;	// 100 KB
define("_C_WEBMAP3_CFG_GICON_WIDTH", "50" ) ;	// 50 pixel
define("_C_WEBMAP3_CFG_GICON_QUALITY", "95" ) ;

// map
define("_C_WEBMAP3_GOOGLE_MAP_TYPE_CONTROL_STYLE", "default" ) ;
define("_C_WEBMAP3_GOOGLE_ZOOM_CONTROL_STYLE",     "default" ) ;
define("_C_WEBMAP3_GOOGLE_MAP_TYPE",               "roadmap" ) ;

define("_C_WEBMAP3_MAP_WIDTH",      "640px" ) ;
define("_C_WEBMAP3_MAP_HEIGHT",     "480px" ) ;
define("_C_WEBMAP3_MAP_TITLE_LENGH", 100 ) ;
define("_C_WEBMAP3_MAP_INFO_MAX",    100 ) ;
define("_C_WEBMAP3_MAP_INFO_WIDTH",  20 ) ;
define("_C_WEBMAP3_MAP_INFO_BREAK",  "<br />" ) ;
define("_C_WEBMAP3_MAP_IMAGE_MAX_WIDTH",  120 ) ;
define("_C_WEBMAP3_MAP_IMAGE_MAX_HEIGHT", 120 ) ;

// 1000 msec
define("_C_WEBMAP3_MAP_TIMEOUT", 1000 ) ;

// error code
define("_C_WEBMAP3_ERR_NO_PERM",         -101 ) ;
define("_C_WEBMAP3_ERR_NO_RECORD",       -102 ) ;
define("_C_WEBMAP3_ERR_TOKEN",           -103 ) ;
define("_C_WEBMAP3_ERR_DB",              -104 ) ;
define("_C_WEBMAP3_ERR_UPLOAD",          -105 ) ;
define("_C_WEBMAP3_ERR_FILE",            -106 ) ;
define("_C_WEBMAP3_ERR_FILEREAD",        -107 ) ;
define("_C_WEBMAP3_ERR_NO_SPECIFIED",    -108 ) ;
define("_C_WEBMAP3_ERR_NO_IMAGE",        -109 ) ;
define("_C_WEBMAP3_ERR_NO_TITLE",        -110 ) ;
define("_C_WEBMAP3_ERR_CHECK_DIR",       -111 ) ;
define("_C_WEBMAP3_ERR_NOT_ALLOWED_EXT", -112 ) ;
define("_C_WEBMAP3_ERR_EMPTY_FILE",      -113 ) ;
define("_C_WEBMAP3_ERR_EMPTY_CAT",       -114 ) ;
define("_C_WEBMAP3_ERR_INVALID_CAT",     -115 ) ;
define("_C_WEBMAP3_ERR_NO_CAT_RECORD",   -116 ) ;
define("_C_WEBMAP3_ERR_EXT",             -117 ) ;
define("_C_WEBMAP3_ERR_FILE_SIZE",       -118 ) ;
define("_C_WEBMAP3_ERR_CREATE_PHOTO",    -119 ) ;
define("_C_WEBMAP3_ERR_CREATE_THUMB",    -120 ) ;
define("_C_WEBMAP3_ERR_GET_IMAGE_SIZE",  -121 ) ;
define("_C_WEBMAP3_ERR_EMBED",       -122 ) ;
define("_C_WEBMAP3_ERR_PLAYLIST",    -123 ) ;
define("_C_WEBMAP3_ERR_NO_FALSHVAR", -124 ) ;
define("_C_WEBMAP3_ERR_VOTE_OWN",   -125 ) ;
define("_C_WEBMAP3_ERR_VOTE_ONCE",  -126 ) ;
define("_C_WEBMAP3_ERR_NO_RATING",  -127 ) ;

// === define end ===
}

?>