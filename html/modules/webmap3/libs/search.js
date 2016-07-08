/* ========================================================
 * $Id: search.js,v 1.2 2012/04/09 12:09:43 ohwada Exp $
 * http://code.google.com/intl/en/apis/maps/documentation/javascript/
 * ========================================================
 */

/* --------------------------------------------------------
 * change log
 * 2012-04-02 K.OHWADA
 *   webmap3_use_center_marker
 *   bugfix: NOT work in IE9
 * 2012-03-01 K.OHWADA
 *   Frist version
 * --------------------------------------------------------
 */

/* --------------------------------------------------------
 * require map.js
 * --------------------------------------------------------
 */

/* constant */
var WEBMAP3_ZOOM_MIN = 0;
var WEBMAP3_ZOOM_MAX = 17;
var WEBMAP3_ZOOM_DEFAULT = 12;
var WEBMAP3_SMALL_ICON = "marker_small.png";
var WEBMAP3_DRAG_ICON = "marker_drag.png";

/* system */
var webmap3_marker_url = "";

/* element id */
var webmap3_ele_id_list = "webmap3_map_list";
var webmap3_ele_id_search = "webmap3_map_search";
var webmap3_ele_id_current_location = "webmap3_map_current_location";
var webmap3_ele_id_current_address = "webmap3_map_current_address";
var webmap3_ele_id_parent_latitude = "webmap3_map_latitude";
var webmap3_ele_id_parent_longitude = "webmap3_map_longitude";
var webmap3_ele_id_parent_zoom = "webmap3_map_zoom";
var webmap3_ele_id_parent_address = "webmap3_map_address";

/* setter */
var webmap3_opener_mode = "";
var webmap3_region = "";
var webmap3_use_search_marker = true;
var webmap3_use_draggable_marker = false;
var webmap3_use_center_marker = false;
var webmap3_use_current_location = true;
var webmap3_use_current_address = false;
var webmap3_use_parent_location = false;

/* local object */
var webmap3_map = null;
var webmap3_geocoder = null;
var webmap3_marker_list = null;
var webmap3_bounds = null;
var webmap3_draggable_marker = null;
var webmap3_is_set_parent_ddress = false;

/* lang */
var webmap3_lang_latitude = "Latitude";
var webmap3_lang_longitude = "Longitude";
var webmap3_lang_zoom = "Zoom Level";
var webmap3_lang_not_successful = "Geocode was not successful for the following reason";
var webmap3_lang_no_match_place = "There are no place to match the address";

/* ========================================================
 * search
 * ========================================================
 */
function webmap3_search(param) {
    webmap3_geocoder = new google.maps.Geocoder();
    webmap3_marker_list = new google.maps.MVCArray();
    webmap3_map = webmap3_init(param);
}

/* --------------------------------------------------------
 * map center
 * --------------------------------------------------------
 */
/* get map center */
function webmap3_getCenterZoom() {
    var center = webmap3_map.getCenter();
    var lat = center.lat();
    var lng = center.lng();
    var zoom = webmap3_map.getZoom();
    arr = new Array(lat, lng, zoom, center);
    return arr;
}

function webmap3_moveCenterZoom(lat, lng, zoom) {
    /* map */
    var center = webmap3_getLatLng(lat, lng);
    webmap3_map.setCenter(center);
    webmap3_map.setZoom(Math.floor(zoom));
    webmap3_map.panTo(center);

    /* draggable marker */
    if (webmap3_use_draggable_marker) {
        webmap3_draggable_marker.setPosition(center);
    }
}

/* ========================================================
 * get location
 * ========================================================
 */
function webmap3_get_location(param) {
    webmap3_geocoder = new google.maps.Geocoder();
    webmap3_marker_list = new google.maps.MVCArray();

    var lat = param["latitude"];
    var lng = param["longitude"];
    var zoom = param["zoom"];
    var center = webmap3_getLatLng(lat, lng);

    webmap3_map = webmap3_init(param);

    /* rewrite current location */
    if (webmap3_use_current_location) {
        webmap3_rewriteCurrentLocation(lat, lng, zoom);
    }

    /* draggable maker */
    if (webmap3_use_draggable_marker) {
        webmap3_draggable_marker = webmap3_createDraggableMarker(center);
        webmap3_eventDraggableMarkerDragend();
    }

    /* center maker */
    if (webmap3_use_center_marker) {
        webmap3_createCenterMarker(center);
    }

    /* map event */
    webmap3_eventMapDragend();
}

/* --------------------------------------------------------
 * map event
 * --------------------------------------------------------
 */
/* Listener : map dragend */
function webmap3_eventMapDragend() {
    google.maps.event.addListener(webmap3_map, 'dragend', function () {

        /* get map center */
        var arr = webmap3_getCenterZoom();
        var lat = arr[0];
        var lng = arr[1];
        var zoom = arr[2];
        var center = arr[3];

        /* move draggable_marker */
        if (webmap3_use_draggable_marker) {
            webmap3_draggable_marker.setPosition(center);
        }

        /* rewrite current location */
        if (webmap3_use_current_location) {
            webmap3_rewriteCurrentLocation(lat, lng, zoom);
        }

        /* rewrite parent location */
        if (webmap3_use_parent_location) {
            webmap3_setParentLatitude(lat, lng, zoom);
        }

    });

}

/* --------------------------------------------------------
 * draggable marker
 * --------------------------------------------------------
 */
function webmap3_createDraggableMarker(center) {
    var icon = webmap3_marker_url + "/" + WEBMAP3_DRAG_ICON;
    var marker = new google.maps.Marker({
        map: webmap3_map,
        position: center,
        icon: icon,
        draggable: true
    });
    return marker;
}

/* Listener : draggable marker dragend */
function webmap3_eventDraggableMarkerDragend() {
    google.maps.event.addListener(webmap3_draggable_marker, "dragend", function () {

        window.setTimeout(function () {

                /* move to the position of draggable marker at the center of map */
                var position = webmap3_draggable_marker.getPosition();
                webmap3_map.panTo(position);
            },

            /* after 0.5 sec */
            500);
    });
}

/* --------------------------------------------------------
 * center marker
 * --------------------------------------------------------
 */
function webmap3_createCenterMarker(center) {
    var marker = new google.maps.Marker({
        map: webmap3_map,
        position: center
    });
    return marker;
}

/* --------------------------------------------------------
 * rewrite current
 * --------------------------------------------------------
 */
/* rewrite current location */
function webmap3_rewriteCurrentLocation(lat, lng, zoom) {
    var ele = document.getElementById(webmap3_ele_id_current_location);
    if (ele != null) {
        var location = webmap3_lang_latitude + ': ';
        location += lat + ' / ';
        location += webmap3_lang_longitude + ': ';
        location += lng + ' / ';
        location += webmap3_lang_zoom + ': ';
        location += zoom + ' / ';
        ele.innerHTML = location.webmap3_htmlspecialchars();
    }
}

/* rewrite current address */
function webmap3_rewriteCurrentAddress(addr) {
    var ele = document.getElementById(webmap3_ele_id_current_address);
    if (ele != null) {
        ele.innerHTML = addr.webmap3_htmlspecialchars();
    }
    if (webmap3_is_set_parent_ddress) {
        webmap3_setParentAddress(addr);
    }
    webmap3_is_set_parent_ddress = false;
}

/* --------------------------------------------------------
 * set & get parent
 * --------------------------------------------------------
 */
/* set location */
function webmap3_setParentCenterLocation() {
    var arr = webmap3_getCenterZoom();
    webmap3_setParentLatitude(arr[0], arr[1], arr[2]);
}

/* set address */
function webmap3_setParentCurrentAddress() {
    webmap3_is_set_parent_ddress = true;
    var center = webmap3_map.getCenter();
    webmap3_reverseGeocoding(center);
}

/* set & get parent */
function webmap3_getParentLatitude() {
    var ele_lat = null;
    var ele_lng = null;
    var ele_zoom = null;
    var lat = 0;
    var lng = 0;
    var zoom = 0;
    var flag = false;

    /* self */
    if (webmap3_opener_mode == 'self') {
        ele_lat = document.getElementById(webmap3_ele_id_parent_latitude);
        ele_lng = document.getElementById(webmap3_ele_id_parent_longitude);
        ele_zoom = document.getElementById(webmap3_ele_id_parent_zoom);

        /* opener */
    } else if (( webmap3_opener_mode == 'opener' ) && ( opener != null )) {
        ele_lat = opener.document.getElementById(webmap3_ele_id_parent_latitude);
        ele_lng = opener.document.getElementById(webmap3_ele_id_parent_longitude);
        ele_zoom = opener.document.getElementById(webmap3_ele_id_parent_zoom);

        /* parent */
    } else if (( webmap3_opener_mode == 'parent' ) && ( parent != null )) {
        ele_lat = parent.document.getElementById(webmap3_ele_id_parent_latitude);
        ele_lng = parent.document.getElementById(webmap3_ele_id_parent_longitude);
        ele_zoom = parent.document.getElementById(webmap3_ele_id_parent_zoom);
    }

    /* if element exist */
    if (ele_lat != null) {
        lat = ele_lat.value;
    }
    if (ele_lng != null) {
        lng = ele_lng.value;
    }
    if (ele_zoom != null) {
        zoom = ele_zoom.value;
    }

    /* if parent param is set */
    if ((lat != 0) || (lng != 0) || (zoom != 0)) {
        flag = true;
    }

    arr = new Array(flag, lat, lng, zoom);
    return arr;
}

function webmap3_setParentLatitude(latitude, longitude, zoom) {
    var ele_lat = null;
    var ele_lng = null;
    var ele_zoom = null;

    /* self */
    if (webmap3_opener_mode == 'self') {
        ele_lat = document.getElementById(webmap3_ele_id_parent_latitude);
        ele_lng = document.getElementById(webmap3_ele_id_parent_longitude);
        ele_zoom = document.getElementById(webmap3_ele_id_parent_zoom);

        /* opener */
    } else if (( webmap3_opener_mode == 'opener' ) && ( opener != null )) {
        ele_lat = opener.document.getElementById(webmap3_ele_id_parent_latitude);
        ele_lng = opener.document.getElementById(webmap3_ele_id_parent_longitude);
        ele_zoom = opener.document.getElementById(webmap3_ele_id_parent_zoom);

        /* parent */
    } else if (( webmap3_opener_mode == 'parent' ) && ( parent != null )) {
        ele_lat = parent.document.getElementById(webmap3_ele_id_parent_latitude);
        ele_lng = parent.document.getElementById(webmap3_ele_id_parent_longitude);
        ele_zoom = parent.document.getElementById(webmap3_ele_id_parent_zoom);
    }

    /* if element exist */
    if (ele_lat != null) {
        ele_lat.value = parseFloat(latitude);
    }
    if (ele_lng != null) {
        ele_lng.value = parseFloat(longitude);
    }
    if (ele_zoom != null) {
        ele_zoom.value = Math.floor(zoom);
    }
}

function webmap3_getParentAddress() {
    var ele_addr = null;
    var addr = '';

    /* self */
    if (webmap3_opener_mode == 'self') {
        ele_addr = document.getElementById(webmap3_ele_id_parent_address);

        /* opener */
    } else if (( webmap3_opener_mode == 'opener' ) && ( opener != null )) {
        ele_addr = opener.document.getElementById(webmap3_ele_id_parent_address);

        /* parent */
    } else if (( webmap3_opener_mode == 'parent' ) && ( parent != null )) {
        ele_addr = parent.document.getElementById(webmap3_ele_id_parent_address);
    }

    /* if element exist */
    if (ele_addr != null) {
        addr = ele_addr.value;
    }

    return addr;
}

function webmap3_setParentAddress(addr) {
    var ele_addr = null;

    /* self */
    if (webmap3_opener_mode == 'self') {
        ele_addr = document.getElementById(webmap3_ele_id_parent_address);

        /* opener */
    } else if (( webmap3_opener_mode == 'opener' ) && ( opener != null )) {
        ele_addr = opener.document.getElementById(webmap3_ele_id_parent_address);

        /* parent */
    } else if (( webmap3_opener_mode == 'parent' ) && ( parent != null )) {
        ele_addr = parent.document.getElementById(webmap3_ele_id_parent_address);
    }

    /* if element exist */
    if (( ele_addr != null ) && ( addr != null ) && ( addr != '' )) {
        ele_addr.value = addr.webmap3_htmlspecialchars();
    }
}

/* --------------------------------------------------------
 * geocoding
 * --------------------------------------------------------
 */
function webmap3_searchAddress(address) {
    webmap3_geocoding(address);
}

function webmap3_geocoding(address) {
    var request = {'address': address};
    if (webmap3_region != '') {
        request = {'address': address, 'region': webmap3_region};
    }

    webmap3_geocoder.geocode(request, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            webmap3_geocodingResult(results);

        } else {
            /* error */
            var msg = webmap3_lang_not_successful + ": " + status;
            webmap3_writeListHtmlspecialchars(msg);
        }
    });
}

function webmap3_geocodingResult(results) {
    /* remove all marker */
    webmap3_removeSearchMarkers();
    webmap3_bounds = null;

    var length = results.length;

    /* error */
    if (length == 0) {
        webmap3_writeListHtmlspecialchars(webmap3_lang_no_match_place);
        return;
    }

    /* --- start --- */
    var center = null;
    var r = null;
    var addr = "";
    var loc = null;
    var lat = 0;
    var lng = 0;
    var list = '<ol>';

    for (var i = 0; i < length; i++) {

        /* location */
        r = results[i];
        addr = r.formatted_address;
        loc = r.geometry.location;
        lat = loc.lat();
        lng = loc.lng();

        if (i == 0) {
            center = loc;
        }

        /* list */
        html = webmap3_getSearchHtml(i, lat, lng, WEBMAP3_ZOOM_DEFAULT, addr);
        list += '<li>' + html + '</li>' + "\n";

        /* add marker */
        if (webmap3_use_search_marker) {
            webmap3_addSearchMarker(i, loc, html);
        }
        webmap3_setBound(loc);
    }

    list += '</ol>';
    /* --- end --- */

    webmap3_fitBounds();
    webmap3_writeList(list);

    /* draggable marker */
    if (webmap3_use_draggable_marker && (center != null)) {
        webmap3_draggable_marker.setPosition(center);
    }
}

function webmap3_getSearchHtml(index, lat, lng, zoom, addr) {
    letter = webmap3_getCapitalLetter(index);
    if (letter == '') {
        letter = index + 1;
    }

    func = "webmap3_moveCenterZoom(" + lat + ', ' + lng + ', ' + zoom + ")";
    link = '<a href="javascript:void(0)" onClick="' + func + '">' + addr.webmap3_htmlspecialchars() + '</a>';
    html = '<b>' + letter + '</b> ' + link;
    return html;
}

function webmap3_getCapitalLetter(index) {
    var char = '';
    if (index < 26) {
        char = String.fromCharCode("A".charCodeAt(0) + index);
    }
    return char;
}

function webmap3_getSmallLetter(index) {
    var char = '';
    if (index < 26) {
        char = String.fromCharCode("a".charCodeAt(0) + index);
    }
    return char;
}

function webmap3_setBound(point) {
    // Only the first
    if (webmap3_bounds == null) {
        webmap3_bounds = new google.maps.LatLngBounds();
    }
    webmap3_bounds.extend(point);
}

function webmap3_fitBounds(length) {
    webmap3_map.fitBounds(webmap3_bounds);

    // one big size
    var zoom = webmap3_map.getZoom();
    zoom--;
    if (zoom < WEBMAP3_ZOOM_MIN) {
        zoom = WEBMAP3_ZOOM_MIN;
    }
    if (zoom > WEBMAP3_ZOOM_MAX) {
        zoom = WEBMAP3_ZOOM_MAX;
    }

    webmap3_map.setZoom(zoom);
}

function webmap3_addSearchMarker(index, position, content) {
    /* icon */
    var icon = webmap3_marker_url + "/".WEBMAP3_SMALL_ICON;
    var letter = webmap3_getSmallLetter(index);
    if (letter) {
        var icon = webmap3_marker_url + "/marker_" + letter + ".png";
    }

    /* marker */
    var param = {
        icon: icon,
        content: content
    };
    var marker = webmap3_createMarker(webmap3_map, position, param);

    /* marker list */
    webmap3_marker_list.push(marker);
}

/* http://googlemaps.googlermania.com/google_maps_api_v3/map_example_remove_all_markers.html */
function webmap3_removeSearchMarkers() {
    webmap3_marker_list.forEach(function (marker, idx) {
        marker.setMap(null);
    });
}

function webmap3_writeListHtmlspecialchars(msg) {
    webmap3_writeList(msg.webmap3_htmlspecialchars())
}

function webmap3_writeList(msg) {
    var ele = document.getElementById(webmap3_ele_id_list);
    if (ele != null) {
        ele.innerHTML = msg;
    }
}

/* --------------------------------------------------------
 * reverse geocoding
 * --------------------------------------------------------
 */
function webmap3_searchReverse() {
    var center = webmap3_map.getCenter();
    webmap3_reverseGeocoding(center);
}

function webmap3_reverseGeocoding(latlng) {
    webmap3_geocoder.geocode({'latLng': latlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            webmap3_reverseGeocodingResult(results);

        } else {
            /* error */
            var msg = webmap3_lang_not_successful + ": " + status;
            webmap3_writeList(msg);
        }
    });
}

function webmap3_reverseGeocodingResult(results) {
    if (results[1]) {
        var addr = results[1].formatted_address;

        /* rewrite current location */
        if (webmap3_use_current_address) {
            webmap3_rewriteCurrentAddress(addr);
        }
    }
}

/* --------------------------------------------------------
 * String.prototype
 * --------------------------------------------------------
 */
/* reference: mygmap module's mygmap.js */
String.prototype.webmap3_htmlspecialchars = function () {
    var str = this.toString();
    str = str.replace(/\//g, "");
    str = str.replace(/&/g, "&amp;");
    str = str.replace(/"/g, "&quot;");
    str = str.replace(/'/g, "&#39;");
    str = str.replace(/</g, "&lt;");
    str = str.replace(/>/g, "&gt;");
    return str;
}

