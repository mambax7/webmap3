<?php
// $Id: modinfo.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

// test
if (defined('FOR_XOOPS_LANG_CHECKER')) {
    $MY_DIRNAME = 'webmap3';

    // normal
} elseif (isset($GLOBALS['MY_DIRNAME'])) {
    $MY_DIRNAME = $GLOBALS['MY_DIRNAME'];

    // call by altsys/mytplsadmin.php
} elseif ($mydirname) {
    $MY_DIRNAME = $mydirname;

    // probably error
} else {
    echo 'not set dirname in ' . __FILE__ . " <br />\n";
    $MY_DIRNAME = 'webmap3';
}

$constpref = strtoupper('_MI_' . $MY_DIRNAME . '_');

// === define begin ===
if (defined('FOR_XOOPS_LANG_CHECKER') || !defined($constpref . 'LANG_LOADED')) {
    define($constpref . 'LANG_LOADED', 1);

    // geocoding: USA
    define($constpref . 'REGION', 'us');

    // module name
    define($constpref . 'NAME', 'Google Maps V3');
    define($constpref . 'DESC', 'Show map using Google Maps API');

    // module config
    define($constpref . 'CFG_ADDRESS', 'Address');
    define($constpref . 'CFG_LATITUDE', 'Latitude');
    define($constpref . 'CFG_LONGITUDE', 'Longitude');
    define($constpref . 'CFG_ZOOM', 'Zoom');
    define($constpref . 'CFG_MARKER_GICON', 'Icon of Marker');
    define($constpref . 'CFG_CONFIG_DSC', 'You can change in<br />[Latitude and Longitude Setting]');

    // map param
    define($constpref . 'CFG_MAP_TYPE_CONTROL', 'Use MapType');
    define($constpref . 'CFG_MAP_TYPE_CONTROL_DSC', 'mapTypeControl');
    define($constpref . 'CFG_MAP_TYPE_CONTROL_STYLE', 'Style of MapType');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_DSC', 'google.maps.MapTypeControlStyle');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_DEFAULT', 'Default');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_HORIZONTAL', 'Horizontal bar');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_DROPDOWN', 'Dropdown menu');
    define($constpref . 'CFG_MAP_TYPE', 'MapType');
    define($constpref . 'CFG_MAP_TYPE_DSC', 'google.maps.MapTypeId');
    define($constpref . 'OPT_MAP_TYPE_ROADMAP', 'Roadmap');
    define($constpref . 'OPT_MAP_TYPE_SATELLITE', 'Satellite');
    define($constpref . 'OPT_MAP_TYPE_HYBRID', 'Hybrid');
    define($constpref . 'OPT_MAP_TYPE_TERRAIN', 'Terrain');
    define($constpref . 'CFG_ZOOM_CONTROL', 'Use Zoom');
    define($constpref . 'CFG_ZOOM_CONTROL_DSC', 'zoomControl');
    define($constpref . 'CFG_ZOOM_CONTROL_STYLE', 'Style of Zoom');
    define($constpref . 'CFG_ZOOM_CONTROL_STYLE_DSC', 'google.maps.ZoomControlStyle');
    define($constpref . 'OPT_ZOOM_CONTROL_STYLE_DEFAULT', 'Default');
    define($constpref . 'OPT_ZOOM_CONTROL_STYLE_SMALL', 'Small');
    define($constpref . 'OPT_ZOOM_CONTROL_STYLE_LARGE', 'Large');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL', 'Use OverviewMap');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL_DSC', 'overviewMapControl');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL_OPENED', 'Expand OverviewMap');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL_OPENED_DSC', 'google.maps.OverviewMapControlOptions');
    define($constpref . 'CFG_PAN_CONTROL', 'Use Pan');
    define($constpref . 'CFG_PAN_CONTROL_DSC', 'panControl');
    define($constpref . 'CFG_STREET_VIEW_CONTROL', 'Use StreetView');
    define($constpref . 'CFG_STREET_VIEW_CONTROL_DSC', 'streetViewControl');
    define($constpref . 'CFG_SCALE_CONTROL', 'Use Scale');
    define($constpref . 'CFG_SCALE_CONTROL_DSC', 'scaleControl');

    // search
    define($constpref . 'CFG_USE_DRAGGABLE_MARKER', '[Search] Use Draggable Marker');
    define($constpref . 'CFG_USE_DRAGGABLE_MARKER_DSC', 'google.maps.MarkerOptions - draggable');
    define($constpref . 'CFG_USE_SEARCH_MARKER', '[Search] Use Search Result Marker');
    define($constpref . 'CFG_USE_SEARCH_MARKER_DSC', 'google.maps.MarkerOptions - icon');

    // location
    define($constpref . 'CFG_USE_LOC_MARKER', '[Location] Use Marker');
    define($constpref . 'CFG_USE_LOC_MARKER_DSC', 'google.maps.MarkerOptions');
    define($constpref . 'CFG_USE_LOC_MARKER_CLICK', '[Location] Use Maker Click');
    define($constpref . 'CFG_USE_LOC_MARKER_CLICK_DSC', 'google.maps.InfoWindow - addListener');
    define($constpref . 'CFG_LOC_MARKER_INFO', '[Location] Content when click marker');
    define($constpref . 'CFG_LOC_MARKER_INFO_DSC', 'google.maps.InfoWindowOptions - content');

    // georss
    define($constpref . 'CFG_GEO_URL', '[GeoRSS] URL of RSS');
    define($constpref . 'CFG_GEO_URL_DSC', 'google.maps.KmlLayer');
    define($constpref . 'CFG_GEO_TITLE', '[GeoRSS] Title');
    define($constpref . 'CFG_GICON_PATH', 'Path to uploads');

    // icon
    define($constpref . 'CFG_GICON_PATH_DSC',
           "[Google Icon] Directory for uploaded files<br />Relative path from the directory installed XOOPS.<br />The first character should not  '/'. <br />The last character should not be '/' <br />This directory's permission is 777 or 707 in unix.");
    define($constpref . 'CFG_GICON_FSIZE', 'Max of file size');
    define($constpref . 'CFG_GICON_FSIZE_DSC', '[Google Icon] The limitation of the size of uploading file.(bytes)');
    define($constpref . 'CFG_GICON_WIDTH', 'Max of image width and height');
    define($constpref . 'CFG_GICON_WIDTH_DSC', "[Google Icon] This means the images's width and height to be resized.");
    define($constpref . 'CFG_GICON_QUALITY', 'JPEG Quality');
    define($constpref . 'CFG_GICON_QUALITY_DSC', '[Google Icon] The quality if resizing when upload<br />1 - 100');

    define($constpref . 'ADMENU_INDEX', 'Index');
    define($constpref . 'ADMENU_LOCATION', 'Get Latitude and Longitude');
    define($constpref . 'ADMENU_KML', 'Debug view of KML');
    define($constpref . 'ADMENU_GICON_MANAGER', 'Google Icon Manager');
    define($constpref . 'ADMENU_GICON_TABLE_MANAGE', 'Google icon table manage');

    define($constpref . 'BNAME_LOCATION', 'Webmap3 Map');

    //---------------------------------------------------------
    // v1.10
    //---------------------------------------------------------
    // geocoding
    define($constpref . 'CFG_LANGUAGE', 'Langauge code');
    define($constpref . 'CFG_LANGUAGE_DSC', '[Geocoding]');
    define($constpref . 'CFG_REGION', 'Region code');
    define($constpref . 'CFG_REGION_DSC', '[Geocoding]');
}// === define begin ===
;
