<?php
// $Id: modinfo.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

// test
if ( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) {
	$MY_DIRNAME = 'webmap3' ;

// normal
} elseif (  isset($GLOBALS['MY_DIRNAME']) ) {
	$MY_DIRNAME = $GLOBALS['MY_DIRNAME'];

// call by altsys/mytplsadmin.php
} elseif ( $mydirname ) {
	$MY_DIRNAME = $mydirname;

// probably error
} else {
	echo "not set dirname in ". __FILE__ ." <br />\n";
	$MY_DIRNAME = 'webmap3' ;
}

$constpref = strtoupper( '_MI_' . $MY_DIRNAME. '_' ) ;

// === define begin ===
if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || !defined($constpref."LANG_LOADED") ) 
{

define($constpref."LANG_LOADED" , 1 ) ;

// module name
define($constpref."NAME","Google Maps V3");
define($constpref."DESC","Google Maps API を利用して地図を表示する");

// module config
define($constpref."CFG_ADDRESS",   "住所");
define($constpref."CFG_LATITUDE",  "緯度");
define($constpref."CFG_LONGITUDE", "経度");
define($constpref."CFG_ZOOM",      "ズーム");
define($constpref."CFG_MARKER_GICON" , "マーカーのアイコン" ) ;
define($constpref."CFG_CONFIG_DSC" ,   "[緯度・経度の設定] にて変更可能");

// map param
define($constpref."CFG_MAP_TYPE_CONTROL",      "地図形式を使用する");
define($constpref."CFG_MAP_TYPE_CONTROL_DSC",  "mapTypeControl");
define($constpref."CFG_MAP_TYPE_CONTROL_STYLE",      "地図形式のスタイル");
define($constpref."OPT_MAP_TYPE_CONTROL_STYLE_DSC",  "google.maps.MapTypeControlStyle");
define($constpref."OPT_MAP_TYPE_CONTROL_STYLE_DEFAULT",    "標準: Default");
define($constpref."OPT_MAP_TYPE_CONTROL_STYLE_HORIZONTAL", "水平バー: Horizontal bar");
define($constpref."OPT_MAP_TYPE_CONTROL_STYLE_DROPDOWN",   "ドロップダウン・メニュー: Dropdown menu");
define($constpref."CFG_MAP_TYPE",  "地図形式");
define($constpref."CFG_MAP_TYPE_DSC",  "google.maps.MapTypeId");
define($constpref."OPT_MAP_TYPE_ROADMAP",   "地図: Roadmap");
define($constpref."OPT_MAP_TYPE_SATELLITE", "航空写真: Satellite");
define($constpref."OPT_MAP_TYPE_HYBRID",    "地図+写真: Hybrid");
define($constpref."OPT_MAP_TYPE_TERRAIN",   "地形: Terrain");
define($constpref."CFG_ZOOM_CONTROL",      "ズームを使用する");
define($constpref."CFG_ZOOM_CONTROL_DSC",  "zoomControl");
define($constpref."CFG_ZOOM_CONTROL_STYLE",      "ズームのスタイル");
define($constpref."CFG_ZOOM_CONTROL_STYLE_DSC",  "google.maps.ZoomControlStyle");
define($constpref."OPT_ZOOM_CONTROL_STYLE_DEFAULT", "標準: Default");
define($constpref."OPT_ZOOM_CONTROL_STYLE_SMALL",   "小さい: Small");
define($constpref."OPT_ZOOM_CONTROL_STYLE_LARGE",   "大きい: Large");
define($constpref."CFG_OVERVIEW_MAP_CONTROL",  "右下の小さい地図を使用する");
define($constpref."CFG_OVERVIEW_MAP_CONTROL_DSC",  "overviewMapControl");
define($constpref."CFG_OVERVIEW_MAP_CONTROL_OPENED",  "小さい地図を展開モードにする");
define($constpref."CFG_OVERVIEW_MAP_CONTROL_OPENED_DSC",  "google.maps.OverviewMapControlOptions");
define($constpref."CFG_PAN_CONTROL",      "移動のコントロール");
define($constpref."CFG_PAN_CONTROL_DSC",  "panControl");
define($constpref."CFG_STREET_VIEW_CONTROL",      "ストリートビューを使用する");
define($constpref."CFG_STREET_VIEW_CONTROL_DSC",  "streetViewControl");
define($constpref."CFG_SCALE_CONTROL",  "距離表示を使用する");
define($constpref."CFG_SCALE_CONTROL_DSC",  "scaleControl");

// search
define($constpref."CFG_USE_DRAGGABLE_MARKER",  "[検索] ドラッグ・マーカーを使用する");
define($constpref."CFG_USE_DRAGGABLE_MARKER_DSC",  "google.maps.MarkerOptions - draggable");
define($constpref."CFG_USE_SEARCH_MARKER",  "[検索] 検索結果のマーカーを使用する");
define($constpref."CFG_USE_SEARCH_MARKER_DSC",  "google.maps.MarkerOptions - icon");

// location
define($constpref."CFG_USE_LOC_MARKER",  "[場所] マーカーを使用する");
define($constpref."CFG_USE_LOC_MARKER_DSC",  "google.maps.MarkerOptions");
define($constpref."CFG_USE_LOC_MARKER_CLICK",  "[場所] マーカーのクリックを使用する");
define($constpref."CFG_USE_LOC_MARKER_CLICK_DSC",  "google.maps.InfoWindow - addListener");
define($constpref."CFG_LOC_MARKER_INFO",  "[場所] マーカーをクリックしたときの内容");
define($constpref."CFG_LOC_MARKER_INFO_DSC",  "google.maps.InfoWindowOptions - content");

// georss
define($constpref."CFG_GEO_URL",  "[GeoRSS] RSS の URL");
define($constpref."CFG_GEO_URL_DSC",  "google.maps.KmlLayer");
define($constpref."CFG_GEO_TITLE", "[GeoRSS] タイトル");
define($constpref."CFG_GICON_PATH" , "アップロード・ファイルのディレクトリ" ) ;

// icon
define($constpref."CFG_GICON_PATH_DSC" , "[Googleアイコン] アップロード時の保存先ディレクトリ<br />XOOPSインストール先からの相対パスを指定する<br />最初と最後の'/'は不要<br />Unixではこのディレクトリへの書込属性をONにして下さい" ) ;
define($constpref."CFG_GICON_FSIZE" , "最大ファイル容量" ) ;
define($constpref."CFG_GICON_FSIZE_DSC" , "[Googleアイコン] アップロード時のファイル容量制限(byte)" ) ;
define($constpref."CFG_GICON_WIDTH" , "最大の横幅と高さ" ) ;
define($constpref."CFG_GICON_WIDTH_DSC" , "[Googleアイコン] アップロード時の横幅と高さの最大" ) ;
define($constpref."CFG_GICON_QUALITY" ,  "JPEG 品質" ) ;
define($constpref."CFG_GICON_QUALITY_DSC" ,  "[Googleアイコン] アップロード時のサイズ変更したときに品質<br />1 - 100" ) ;

define($constpref."ADMENU_INDEX","目次");
define($constpref."ADMENU_LOCATION","緯度・経度を取得する");
define($constpref."ADMENU_KML","KMLのデバッグ表示");
define($constpref."ADMENU_GICON_MANAGER","Googleアイコン管理");
define($constpref."ADMENU_GICON_TABLE_MANAGE","Googleアイコンテーブル管理");

define($constpref."BNAME_LOCATION","Webmap3 地図");

//---------------------------------------------------------
// v1.10
//---------------------------------------------------------
// geocoding
define($constpref."CFG_LANGUAGE","言語コード");
define($constpref."CFG_LANGUAGE_DSC","[Geocoding]" );
define($constpref."CFG_REGION","国コード");
define($constpref."CFG_REGION_DSC","[Geocoding]" );

}
// === define begin ===

?>