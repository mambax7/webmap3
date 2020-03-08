$Id: readme_en.txt,v 1.2 2012/04/09 11:52:19 ohwada Exp $

=================================================
Version: 1.10
Date:    2012-04-02
Author: Kenichi OHWADA
URL:    https://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

1. API
(1) geocoding
Added API which search Latitude and Longitude from address using Google Geocoding API .

(2) get_location
Added API which get Latitude and Longitude using Google Map

2. JavaScript
(1) Show the marker in center when the values of latitude and longitude are already set up.
(2) Bugfix: dont work in IE9

3. Block display
(1) Added the height of map and the timeout.


=================================================
Version: 1.00
Date:    2012-03-01
=================================================

This module is the map using Google Maps API
Support Google Maps API V3 base on the existing webmap module.
Big advantage of V3 is not required the API key.

* Main features *
1. User features
(1) Search Map: Search map from address
(2) Show Map: Show map which is specified latitude and longitude
    Download KML and show in GoogleEarth
(3) GeoRSS: Show marker on the map, getting latitude and longitude by RSS supporing GeoRSS

2. Admin features
(1) The admin get latitude and longitude from map, and save them in database
(2) The admin upload the Google Map Icon.

3. API features
This modules provide the interface for the other module to show the map.
The following is simple demonstration .
modules/webmap3/demo.php


* Install *
1. common ( xoops 2.0.16a JP and XOOPS Cube 2.1.x )
When you unzip the zip file, there are two directories html and xoops_trust_path.
Please copy in the directory which XOOPS correspond

When you install, the xoops output warning like the following.
Please ignore, because xoops and webphoto work well.
-----
Warning [Xoops]: Smarty error: unable to read resource: "db:_inc_makrer_js.html" in file class/smarty/Smarty.class.php line 1095
-----

2. xoops 2.0.18
in addition to the above

(1) rename preload file.
XOOPS_TRUUST_PATH/modules/webmap/preload/_constants.php (with undebar)
 -> constants.php (without undebar)

(2) change _C_WEBMAP_PRELOAD_XOOPS_2018 in valid
remove // at the head.
-----
//define("_C_WEBMAP_PRELOAD_XOOPS_2018", "1" )
-----
