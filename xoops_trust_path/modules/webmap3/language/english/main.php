<?php
// $Id: main.php,v 1.3 2012/04/11 05:35:57 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

// === define begin ===
if (!defined('_MB_WEBMAP3_LANG_LOADED')) {
    define('_MB_WEBMAP3_LANG_LOADED', 1);

    // tilte
    define('_WEBMAP3_TITLE_SEARCH', 'Search Map');
    define('_WEBMAP3_TITLE_SEARCH_DESC', 'Search map from address');
    define('_WEBMAP3_TITLE_LOCATION', 'Show Map');
    define('_WEBMAP3_TITLE_LOCATION_DESC', 'Show map which is specified latitude and longitude');
    define('_WEBMAP3_TITLE_GEORSS', 'Show GeoRSS');
    define('_WEBMAP3_TITLE_GEORSS_DESC', 'Show marker on the map, getting latitude and longitude by RSS supporing GeoRSS');
    define('_WEBMAP3_TITLE_DEMO', 'Demo of Function Call');

    // google icon table
    define('_WEBMAP3_GICON_TABLE', 'Google Icon Table');
    define('_WEBMAP3_GICON_ID', 'Icon ID');
    define('_WEBMAP3_GICON_TIME_CREATE', 'Create Time');
    define('_WEBMAP3_GICON_TIME_UPDATE', 'Update Time');
    define('_WEBMAP3_GICON_TITLE', 'Icon Title');
    define('_WEBMAP3_GICON_IMAGE_PATH', 'Image Path');
    define('_WEBMAP3_GICON_IMAGE_NAME', 'Image Name');
    define('_WEBMAP3_GICON_IMAGE_EXT', 'Image Extntion');
    define('_WEBMAP3_GICON_SHADOW_PATH', 'Shadow Path');
    define('_WEBMAP3_GICON_SHADOW_NAME', 'Shadow Name');
    define('_WEBMAP3_GICON_SHADOW_EXT', 'Shadow Extention');
    define('_WEBMAP3_GICON_IMAGE_WIDTH', 'Image Width');
    define('_WEBMAP3_GICON_IMAGE_HEIGHT', 'Image Height');
    define('_WEBMAP3_GICON_SHADOW_WIDTH', 'Shadow Height');
    define('_WEBMAP3_GICON_SHADOW_HEIGHT', 'Shadow Y Size');
    define('_WEBMAP3_GICON_ANCHOR_X', 'Anchor X Size');
    define('_WEBMAP3_GICON_ANCHOR_Y', 'Anchor Y Size');
    define('_WEBMAP3_GICON_INFO_X', 'WindowInfo X Size');
    define('_WEBMAP3_GICON_INFO_Y', 'WindowInfo Y Size');

    // google_js
    define('_WEBMAP3_ADDRESS', 'Address');
    define('_WEBMAP3_LATITUDE', 'Latitude');
    define('_WEBMAP3_LONGITUDE', 'Longitude');
    define('_WEBMAP3_ZOOM', 'Zoom');
    define('_WEBMAP3_NOT_COMPATIBLE', 'Your browser cannot use GoogleMaps');

    // search
    define('_WEBMAP3_SEARCH', 'Search');
    define('_WEBMAP3_SEARCH_REVERSE', 'Search address from latitude and longitude');
    define('_WEBMAP3_SEARCH_LIST', 'Search Results');
    define('_WEBMAP3_CURRENT_LOCATION', 'Current Location');
    define('_WEBMAP3_CURRENT_ADDRESS', 'Current Address');
    define('_WEBMAP3_NO_MATCH_PLACE', 'There are no place to match the address');
    define('_WEBMAP3_JS_INVALID', 'Your browser cannot use JavaScript');
    define('_WEBMAP3_NOT_SUCCESSFUL', 'Geocode was not successful for the following reason');

    // kml
    define('_WEBMAP3_DOWNLOAD_KML', 'Download KML and show in GoogleEarth');

    // get_location
    define('_WEBMAP3_TITLE_GET_LOCATION', 'Setting of Latitude and Longitude');
    define('_WEBMAP3_GET_LOCATION', 'Get latitude and longitude');
    define('_WEBMAP3_GET_ADDRESS', 'Get Address from latitude and longitude');
    define('_WEBMAP3_DISPLAY_DESC', 'Get location with GoogleMaps');
    define('_WEBMAP3_DISPLAY_NEW', 'Show new window');
    define('_WEBMAP3_DISPLAY_POPUP', 'Show popup window');
    define('_WEBMAP3_DISPLAY_INLINE', 'Show map');
    define('_WEBMAP3_DISPLAY_HIDE', '(Hide map)');

    // set location
    define('_WEBMAP3_TITLE_SET_LOCATION', 'Setting of Latitude and Longitude');

    // form
    define('_WEBMAP3_DBUPDATED', 'Database Updated Successfully');
    define('_WEBMAP3_DELETED', 'Deleted¤¿');
    define('_WEBMAP3_ERR_NOIMAGESPECIFIED', 'No image was uploaded');
    define('_WEBMAP3_ERR_FILE', 'Image is too big or there is a problem with the configuration');
    define('_WEBMAP3_ERR_FILEREAD', 'Image is not readable.');

    // PHP upload error
    // http://www.php.net/manual/en/features.file-upload.errors.php
    define('_WEBMAP3_UPLOADER_PHP_ERR_OK', 'There is no error, the file uploaded with success.');
    define('_WEBMAP3_UPLOADER_PHP_ERR_INI_SIZE', 'The uploaded file exceeds the upload_max_filesize.');
    define('_WEBMAP3_UPLOADER_PHP_ERR_FORM_SIZE', 'The uploaded file exceeds %s .');
    define('_WEBMAP3_UPLOADER_PHP_ERR_PARTIAL', 'The uploaded file was only partially uploaded.');
    define('_WEBMAP3_UPLOADER_PHP_ERR_NO_FILE', 'No file was uploaded.');
    define('_WEBMAP3_UPLOADER_PHP_ERR_NO_TMP_DIR', 'Missing a temporary folder.');
    define('_WEBMAP3_UPLOADER_PHP_ERR_CANT_WRITE', 'Failed to write file to disk.');
    define('_WEBMAP3_UPLOADER_PHP_ERR_EXTENSION', 'File upload stopped by extension.');

    // upload error
    define('_WEBMAP3_UPLOADER_ERR_NOT_FOUND', 'Uploaded File not found');
    define('_WEBMAP3_UPLOADER_ERR_INVALID_FILE_SIZE', 'Invalid File Size');
    define('_WEBMAP3_UPLOADER_ERR_EMPTY_FILE_NAME', 'Filename Is Empty');
    define('_WEBMAP3_UPLOADER_ERR_NO_FILE', 'No file uploaded');
    define('_WEBMAP3_UPLOADER_ERR_NOT_SET_DIR', 'Upload directory not set');
    define('_WEBMAP3_UPLOADER_ERR_NOT_ALLOWED_EXT', 'Extension not allowed');
    define('_WEBMAP3_UPLOADER_ERR_PHP_OCCURED', 'Error occurred: Error #');
    define('_WEBMAP3_UPLOADER_ERR_NOT_OPEN_DIR', 'Failed opening directory: ');
    define('_WEBMAP3_UPLOADER_ERR_NO_PERM_DIR', 'Failed opening directory with write permission: ');
    define('_WEBMAP3_UPLOADER_ERR_NOT_ALLOWED_MIME', 'MIME type not allowed: ');
    define('_WEBMAP3_UPLOADER_ERR_LARGE_FILE_SIZE', 'File size too large: ');
    define('_WEBMAP3_UPLOADER_ERR_LARGE_WIDTH', 'File width must be smaller than ');
    define('_WEBMAP3_UPLOADER_ERR_LARGE_HEIGHT', 'File height must be smaller than ');
    define('_WEBMAP3_UPLOADER_ERR_UPLOAD', 'Failed uploading file: ');

    //---------------------------------------------------------
    // v1.10
    //---------------------------------------------------------
    define('_WEBMAP3_TITLE_GEOCODING', 'Geocoding');
    define('_WEBMAP3_TITLE_GEOCODING_DESC', 'Search Latitude and Longitude from address using Google Geocoding API');
    define('_WEBMAP3_LOOK_GOOGLE_MAP', 'Look with large map');

    // === define end ===
}
