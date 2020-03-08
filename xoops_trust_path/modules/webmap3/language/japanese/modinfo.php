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
    echo 'not set dirname in ' . __FILE__ . " <br >\n";
    $MY_DIRNAME = 'webmap3';
}

$constpref = mb_strtoupper('_MI_' . $MY_DIRNAME . '_');

// === define begin ===
if (defined('FOR_XOOPS_LANG_CHECKER') || !defined($constpref . 'LANG_LOADED')) {
    define($constpref . 'LANG_LOADED', 1);

    // geocoding: Japan
    define($constpref . 'REGION', 'jp');

    // module name
    define($constpref . 'NAME', 'Google Maps V3');
    define($constpref . 'DESC', 'Google Maps API �����Ѥ����Ͽޤ�ɽ������');

    // module config
    define($constpref . 'CFG_ADDRESS', '����');
    define($constpref . 'CFG_LATITUDE', '����');
    define($constpref . 'CFG_LONGITUDE', '����');
    define($constpref . 'CFG_ZOOM', '������');
    define($constpref . 'CFG_MARKER_GICON', '�ޡ������Υ�������');
    define($constpref . 'CFG_CONFIG_DSC', '[���١����٤�����] �ˤ��ѹ���ǽ');

    // map param
    define($constpref . 'CFG_MAP_TYPE_CONTROL', '�Ͽ޷�������Ѥ���');
    define($constpref . 'CFG_MAP_TYPE_CONTROL_DSC', 'mapTypeControl');
    define($constpref . 'CFG_MAP_TYPE_CONTROL_STYLE', '�Ͽ޷����Υ�������');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_DSC', 'google.maps.MapTypeControlStyle');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_DEFAULT', 'ɸ��: Default');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_HORIZONTAL', '��ʿ�С�: Horizontal bar');
    define($constpref . 'OPT_MAP_TYPE_CONTROL_STYLE_DROPDOWN', '�ɥ�åץ����󡦥�˥塼: Dropdown menu');
    define($constpref . 'CFG_MAP_TYPE', '�Ͽ޷���');
    define($constpref . 'CFG_MAP_TYPE_DSC', 'google.maps.MapTypeId');
    define($constpref . 'OPT_MAP_TYPE_ROADMAP', '�Ͽ�: Roadmap');
    define($constpref . 'OPT_MAP_TYPE_SATELLITE', '�Ҷ��̿�: Satellite');
    define($constpref . 'OPT_MAP_TYPE_HYBRID', '�Ͽ�+�̿�: Hybrid');
    define($constpref . 'OPT_MAP_TYPE_TERRAIN', '�Ϸ�: Terrain');
    define($constpref . 'CFG_ZOOM_CONTROL', '���������Ѥ���');
    define($constpref . 'CFG_ZOOM_CONTROL_DSC', 'zoomControl');
    define($constpref . 'CFG_ZOOM_CONTROL_STYLE', '������Υ�������');
    define($constpref . 'CFG_ZOOM_CONTROL_STYLE_DSC', 'google.maps.ZoomControlStyle');
    define($constpref . 'OPT_ZOOM_CONTROL_STYLE_DEFAULT', 'ɸ��: Default');
    define($constpref . 'OPT_ZOOM_CONTROL_STYLE_SMALL', '������: Small');
    define($constpref . 'OPT_ZOOM_CONTROL_STYLE_LARGE', '�礭��: Large');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL', '�����ξ������Ͽޤ���Ѥ���');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL_DSC', 'overviewMapControl');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL_OPENED', '�������Ͽޤ�Ÿ���⡼�ɤˤ���');
    define($constpref . 'CFG_OVERVIEW_MAP_CONTROL_OPENED_DSC', 'google.maps.OverviewMapControlOptions');
    define($constpref . 'CFG_PAN_CONTROL', '��ư�Υ���ȥ���');
    define($constpref . 'CFG_PAN_CONTROL_DSC', 'panControl');
    define($constpref . 'CFG_STREET_VIEW_CONTROL', '���ȥ꡼�ȥӥ塼����Ѥ���');
    define($constpref . 'CFG_STREET_VIEW_CONTROL_DSC', 'streetViewControl');
    define($constpref . 'CFG_SCALE_CONTROL', '��Υɽ������Ѥ���');
    define($constpref . 'CFG_SCALE_CONTROL_DSC', 'scaleControl');

    // search
    define($constpref . 'CFG_USE_DRAGGABLE_MARKER', '[����] �ɥ�å����ޡ���������Ѥ���');
    define($constpref . 'CFG_USE_DRAGGABLE_MARKER_DSC', 'google.maps.MarkerOptions - draggable');
    define($constpref . 'CFG_USE_SEARCH_MARKER', '[����] ������̤Υޡ���������Ѥ���');
    define($constpref . 'CFG_USE_SEARCH_MARKER_DSC', 'google.maps.MarkerOptions - icon');

    // location
    define($constpref . 'CFG_USE_LOC_MARKER', '[���] �ޡ���������Ѥ���');
    define($constpref . 'CFG_USE_LOC_MARKER_DSC', 'google.maps.MarkerOptions');
    define($constpref . 'CFG_USE_LOC_MARKER_CLICK', '[���] �ޡ������Υ���å�����Ѥ���');
    define($constpref . 'CFG_USE_LOC_MARKER_CLICK_DSC', 'google.maps.InfoWindow - addListener');
    define($constpref . 'CFG_LOC_MARKER_INFO', '[���] �ޡ������򥯥�å������Ȥ�������');
    define($constpref . 'CFG_LOC_MARKER_INFO_DSC', 'google.maps.InfoWindowOptions - content');

    // georss
    define($constpref . 'CFG_GEO_URL', '[GeoRSS] RSS �� URL');
    define($constpref . 'CFG_GEO_URL_DSC', 'google.maps.KmlLayer');
    define($constpref . 'CFG_GEO_TITLE', '[GeoRSS] �����ȥ�');
    define($constpref . 'CFG_GICON_PATH', '���åץ��ɡ��ե�����Υǥ��쥯�ȥ�');

    // icon
    define($constpref . 'CFG_GICON_PATH_DSC', "[Google��������] ���åץ��ɻ�����¸��ǥ��쥯�ȥ�<br >XOOPS���󥹥ȡ����褫������Хѥ�����ꤹ��<br >�ǽ�ȺǸ��'/'������<br >Unix�ǤϤ��Υǥ��쥯�ȥ�ؤν��°����ON�ˤ��Ʋ�����");
    define($constpref . 'CFG_GICON_FSIZE', '����ե���������');
    define($constpref . 'CFG_GICON_FSIZE_DSC', '[Google��������] ���åץ��ɻ��Υե�������������(byte)');
    define($constpref . 'CFG_GICON_WIDTH', '����β����ȹ⤵');
    define($constpref . 'CFG_GICON_WIDTH_DSC', '[Google��������] ���åץ��ɻ��β����ȹ⤵�κ���');
    define($constpref . 'CFG_GICON_QUALITY', 'JPEG �ʼ�');
    define($constpref . 'CFG_GICON_QUALITY_DSC', '[Google��������] ���åץ��ɻ��Υ������ѹ������Ȥ����ʼ�<br >1 - 100');

    define($constpref . 'ADMENU_INDEX', '�ܼ�');
    define($constpref . 'ADMENU_LOCATION', '���١����٤��������');
    define($constpref . 'ADMENU_KML', 'KML�ΥǥХå�ɽ��');
    define($constpref . 'ADMENU_GICON_MANAGER', 'Google�����������');
    define($constpref . 'ADMENU_GICON_TABLE_MANAGE', 'Google��������ơ��֥����');

    define($constpref . 'BNAME_LOCATION', 'Webmap3 �Ͽ�');

    //---------------------------------------------------------
    // v1.10
    //---------------------------------------------------------
    // geocoding
    define($constpref . 'CFG_LANGUAGE', '���쥳����');
    define($constpref . 'CFG_LANGUAGE_DSC', '[Geocoding]');
    define($constpref . 'CFG_REGION', '�񥳡���');
    define($constpref . 'CFG_REGION_DSC', '[Geocoding]');
}// === define begin ===
