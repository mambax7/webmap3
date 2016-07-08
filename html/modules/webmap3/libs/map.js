/* ========================================================
 * $Id: map.js,v 1.2 2012/04/09 12:09:43 ohwada Exp $
 * http://code.google.com/intl/en/apis/maps/documentation/javascript/
 * ========================================================
 */

/* --------------------------------------------------------
 * change log
 * 2012-04-02 K.OHWADA
 *   bugfix: NOT work in IE9
 * 2012-03-01 K.OHWADA
 *   Frist version
 * --------------------------------------------------------
 */

/* ========================================================
 * geoxml
 * ========================================================
 */
/* param: xml_url */
function webmap3_geoxml(param) {
    var map = webmap3_init(param);
    var layer = new google.maps.KmlLayer(param["xml_url"]);
    layer.setMap(map);
}

/* param: map_div_id, latitude, longitude, zoom, etc */
function webmap3_init(param) {
    if (param["map_div_id"] == null) {
        alert("NO map div id");
    }
    if (param["latitude"] == null) {
        alert("NO latitude");
    }
    if (param["longitude"] == null) {
        alert("NO longitude");
    }
    if (param["zoom"] == null) {
        alert("NO zoom");
    }

    var element = document.getElementById(param["map_div_id"]);
    var center = webmap3_getLatLng(param["latitude"], param["longitude"]);
    var zoom = webmap3_getIntZoom(param["zoom"]);

    /* pan_control */
    var pan_control = true;
    if (param["pan_control"] != null) {
        pan_control = Boolean(param["pan_control"]);
    }

    /* zoom_control */
    var zoom_control = true;
    if (param["zoom_control"] != null) {
        zoom_control = Boolean(param["zoom_control"]);
    }

    /* map_type_control */
    var map_type_control = true;
    if (param["map_type_control"] != null) {
        map_type_control = Boolean(param["map_type_control"]);
    }

    /* street_view_control */
    var street_view_control = true;
    if (param["street_view_control"] != null) {
        street_view_control = Boolean(param["street_view_control"]);
    }

    /* scale_control */
    var scale_control = false;
    if (param["scale_control"] != null) {
        scale_control = Boolean(param["scale_control"]);
    }

    /* overview_map_control */
    var overview_map_control = false;
    if (param["overview_map_control"] != null) {
        overview_map_control = Boolean(param["overview_map_control"]);
    }

    /* overview_map_control_opened */
    var overview_map_control_opened = false;
    if (param["overview_map_control_opened"] != null) {
        overview_map_control_opened = Boolean(param["overview_map_control_opened"]);
    }

    /* map type */
    var map_type = "normal";
    if (param["map_type"] != null) {
        map_type = param["map_type"];
    }
    var map_type_id = google.maps.MapTypeId.ROADMAP;
    if (map_type == "satellite") {
        map_type_id = google.maps.MapTypeId.SATELLITE;
    } else if (map_type == "hybrid") {
        map_type_id = google.maps.MapTypeId.HYBRID;
    } else if (map_type == "terrain") {
        map_type_id = google.maps.MapTypeId.TERRAIN;
    }

    /* map_type_control_style */
    var param_map_type_control_style = "default";
    if (param["map_type_control_style"] != null) {
        param_map_type_control_style = param["map_type_control_style"];
    }
    var map_type_control_style = google.maps.MapTypeControlStyle.DEFAULT;
    if (param_map_type_control_style == "horizontal") {
        map_type_control_style = google.maps.MapTypeControlStyle.HORIZONTAL_BAR;
    } else if (param_map_type_control_style == "dropdown") {
        map_type_control_style = google.maps.MapTypeControlStyle.DROPDOWN_MENU;
    }

    /* zoom_control_style */
    var param_zoom_control_style = "default";
    if (param["zoom_control_style"] != null) {
        param_zoom_control_style = param["zoom_control_style"];
    }
    var zoom_control_style = google.maps.ZoomControlStyle.DEFAULT;
    if (param_zoom_control_style == "small") {
        zoom_control_style = google.maps.ZoomControlStyle.SMALL;
    } else if (param_zoom_control_style == "large") {
        zoom_control_style = google.maps.ZoomControlStyle.LARGE;
    }

    var options = {
        center: center,
        zoom: zoom,
        mapTypeControl: map_type_control,
        mapTypeControlOptions: {
            style: map_type_control_style
        },
        mapTypeId: map_type_id,
        zoomControl: zoom_control,
        zoomControlOptions: {
            style: zoom_control_style
        },
        overviewMapControl: overview_map_control,
        overviewMapControlOptions: {
            opened: overview_map_control_opened
        },
        panControl: pan_control,
        streetViewControl: street_view_control,
        scaleControl: scale_control
    };

    var map = new google.maps.Map(element, options);
    return map;
}

function webmap3_getLatLng(lat, lng) {
    var latlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
    return latlng;
}

function webmap3_getIntZoom(zoom) {
    return Math.floor(zoom);
}

/* ========================================================
 * markers
 * ========================================================
 */
function webmap3_markers(param, marker_array, icon_array) {
    var map = webmap3_init(param);

    var icons = new Array();
    var shadows = new Array();
    if (icon_array.length > 0) {
        for (i = 0; i < icon_array.length; i++) {
            var icon_i = icon_array[i];
            var icon_id = icon_i["id"];
            icons[icon_id] = webmap3_createIconForMarkers(icon_i);
            shadows[icon_id] = webmap3_createShadowForMarkers(icon_i);
        }
    }

    if (marker_array.length > 0) {
        for (i = 0; i < marker_array.length; i++) {
            webmap3_createMarkerForMarkers(map, marker_array[i], icons, shadows);
        }
    }
}

/* param: image_url, image_width, image_height, anchor_x, anchor_y */
function webmap3_createIconForMarkers(param) {
    if (param["image_url"] == null) {
        return null;
    }

    var size = new google.maps.Size(parseInt(param["image_width"]), parseInt(param["image_height"]));
    var anchor = new google.maps.Point(parseInt(param["anchor_x"]), parseInt(param["anchor_y"]));
    var origin = new google.maps.Point(0, 0);
    var icon = new google.maps.MarkerImage(
        param["image_url"], size, origin, anchor);
    return icon;
}

/* param: shadow_url, shadow_width, shadow_height */
function webmap3_createShadowForMarkers(param) {
    if (( param["shadow_url"] == null ) || ( param["shadow_url"] == '' )) {
        return null;
    }

    var size = new google.maps.Size(parseInt(param["shadow_width"]), parseInt(param["shadow_height"]));
    var anchor = new google.maps.Point(parseInt(param["anchor_x"]), parseInt(param["anchor_y"]));
    var origin = new google.maps.Point(0, 0);
    var icon = new google.maps.MarkerImage(
        param["shadow_url"], size, origin, anchor);
    return icon;
}

/* param: icon_id, latitude, longitude, info */
function webmap3_createMarkerForMarkers(map, param, icons, shadows) {
    /* icon */
    var icon_id = parseInt(param["icon_id"]);
    var icon = null;
    var shadow = null;

    if (icon_id > 0) {
        if (icons[icon_id] != null) {
            icon = icons[icon_id];
        }
        if (shadows[icon_id] != null) {
            shadow = shadows[icon_id];
        }
    }

    /* marker */
    var position = webmap3_getLatLng(param["latitude"], param["longitude"]);
    var marker_param = {
        icon: icon,
        shadow: shadow,
        content: param["info"]
    };
    webmap3_createMarker(map, position, marker_param);
}

/* param: icon, content */
function webmap3_createMarker(map, position, param) {
    var options = {
        map: map,
        position: position
    };

// if icon exist
    if (param["icon"] != null) {
        options.icon = param["icon"];
    }

// if shadow exist
    if (param["shadow"] != null) {
        options.shadow = param["shadow"];
    }

    var marker = new google.maps.Marker(options);

// if content exist
    if (param["content"] != null) {
        var infowindow = new google.maps.InfoWindow({
            content: param["content"]
        });

        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });
    }

    return marker;
}
