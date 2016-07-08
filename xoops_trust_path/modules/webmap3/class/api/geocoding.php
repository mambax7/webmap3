<?php
// $Id: geocoding.php,v 1.3 2012/04/10 01:46:49 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-04-02 K.OHWADA
//=========================================================

//=========================================================
// class webmap3_api_geocoding
// https://developers.google.com/maps/documentation/geocoding/
//=========================================================
class webmap3_api_geocoding
{
	var $_multibyte_class ;

	var $_BASE_URL = 'http://maps.googleapis.com/maps/api/geocode/json?sensor=false';

	var $_search_address  = '';
	var $_language = '';
	var $_region   = '';

	var $_results = false;
	var $_error = '';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function webmap3_api_geocoding( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->_multibyte_class =& webmap3_lib_multibyte::getInstance();

	$config_class =& webmap3_inc_config::getSingleton( $dirname );
	$this->_language = $config_class->get_by_name( 'language' );
	$this->_region   = $config_class->get_by_name( 'region' );
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new webmap3_api_geocoding( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function build_url()
{
	$url  = $this->_BASE_URL;
	$url .= '&region='.$this->_region;
	$url .= '&language='.$this->_language;
	$url .= '&address='. $this->to_utf8_rawurlencode( $this->_search_address );
	return $url;
}

function fetch()
{
	$snoopy = new Snoopy();
	$ret = $snoopy->fetch( $this->build_url() );
	$response_code = $snoopy->response_code;
	if ( !$ret ) {
		$this->_error = 'code: '.$response_code.' error: '.$snoopy->error;
		return false;
	}

	$json = json_decode( $snoopy->results );
	if ( !isset( $json->status ) ) {
		$this->_error = 'code: '.$response_code.' no status';
		return false;
	}

	$status = $json->status;
	if ( $status != 'OK' ) {
		$this->_error = 'status: '.$status;
		return false;
	}

	if ( !isset( $json->results ) ) {
		$this->_error = 'parse error 1';
		return false;
	}

	$results = $json->results;
	$arr = array();

	foreach ($results as $r) {

		if ( !isset( $r->geometry ) ) {
			continue;
		}
		if ( !isset( $r->formatted_address ) ) {
			continue;
		}

		$geometry = $r->geometry;
		$addr     = $r->formatted_address;

		if ( !isset( $geometry->location ) ) {
			continue;
		}

		$location = $geometry->location;

		if ( !isset( $location->lat ) ) {
			continue;
		}
		if ( !isset( $location->lng ) ) {
			continue;
		}

		$lat = $location->lat;
		$lng = $location->lng;

		$arr[] = array(
			'formatted_address' => $this->from_utf8( $addr ),
			'lat' => $lat,
			'lng' => $lng,
		);
	}

	$this->_results = $arr;
	return true;
}

//---------------------------------------------------------
// multibyte
//---------------------------------------------------------
function to_utf8_rawurlencode( $str )
{
	return rawurlencode(
		$this->_multibyte_class->convert_to_utf8( $str ) );
}

function from_utf8( $str )
{
	return $this->_multibyte_class->convert_from_utf8( $str );
}

//---------------------------------------------------------
// setter
//---------------------------------------------------------
function set_region( $v )
{
	$this->_region = $v;
}

function set_language( $v )
{
	$this->_language = $v;
}

function set_search_address( $v )
{
	$this->_search_address = $v;
}

//---------------------------------------------------------
// getter
//---------------------------------------------------------
function get_results()
{
	return $this->_results;
}

function get_error()
{
	return $this->_error;
}

// --- class end ---
}

?>