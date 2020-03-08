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
    define('_WEBMAP3_TITLE_SEARCH', '�Ͽޤθ���');
    define('_WEBMAP3_TITLE_SEARCH_DESC', '���꤫���Ͽޤ򸡺�����');
    define('_WEBMAP3_TITLE_LOCATION', '�Ͽޤ�ɽ��');
    define('_WEBMAP3_TITLE_LOCATION_DESC', '���ٷ��٤���ꤷ������ξ����Ͽޤ�ɽ������');
    define('_WEBMAP3_TITLE_GEORSS', 'GeoRSS ��ɽ��');
    define('_WEBMAP3_TITLE_GEORSS_DESC', 'GeoRSS ���б����� RSS ������ٷ��٤�������ơ��Ͽ޾��ɽ������');
    define('_WEBMAP3_TITLE_DEMO', 'Function Call �Υǥ�');

    // google icon table
    define('_WEBMAP3_GICON_TABLE', 'Google��������ơ��֥�');
    define('_WEBMAP3_GICON_ID', '��������ID');
    define('_WEBMAP3_GICON_TIME_CREATE', '��������');
    define('_WEBMAP3_GICON_TIME_UPDATE', '��������');
    define('_WEBMAP3_GICON_TITLE', '��������̾');
    define('_WEBMAP3_GICON_IMAGE_PATH', '���� �ѥ�');
    define('_WEBMAP3_GICON_IMAGE_NAME', '���� �ե�����̾');
    define('_WEBMAP3_GICON_IMAGE_EXT', '���� ��ĥ��');
    define('_WEBMAP3_GICON_SHADOW_PATH', '����ɡ� �ѥ�');
    define('_WEBMAP3_GICON_SHADOW_NAME', '����ɡ� �ե�����̾');
    define('_WEBMAP3_GICON_SHADOW_EXT', '����ɡ� ��ĥ��');
    define('_WEBMAP3_GICON_IMAGE_WIDTH', '���� ��������');
    define('_WEBMAP3_GICON_IMAGE_HEIGHT', '���� �����⤵');
    define('_WEBMAP3_GICON_SHADOW_WIDTH', '����ɡ� ��������');
    define('_WEBMAP3_GICON_SHADOW_HEIGHT', '����ɡ� �����⤵');
    define('_WEBMAP3_GICON_ANCHOR_X', '���󥫡� X������');
    define('_WEBMAP3_GICON_ANCHOR_Y', '���󥫡� Y������');
    define('_WEBMAP3_GICON_INFO_X', 'WindowInfo X������');
    define('_WEBMAP3_GICON_INFO_Y', 'WindowInfo Y������');

    // google_js
    define('_WEBMAP3_ADDRESS', '����');
    define('_WEBMAP3_LATITUDE', '����');
    define('_WEBMAP3_LONGITUDE', '����');
    define('_WEBMAP3_ZOOM', '������');
    define('_WEBMAP3_NOT_COMPATIBLE', '�����Υ֥饦���Ǥ� GoogleMaps ��ɽ���Ǥ��ޤ���');

    // search
    define('_WEBMAP3_SEARCH', '����');
    define('_WEBMAP3_SEARCH_REVERSE', '���ٷ��٤��齻��򸡺�����');
    define('_WEBMAP3_SEARCH_LIST', '������̤ΰ���');
    define('_WEBMAP3_CURRENT_LOCATION', '���ߤΰ���');
    define('_WEBMAP3_CURRENT_ADDRESS', '���ߤν���');
    define('_WEBMAP3_NO_MATCH_PLACE', '���������꤬�ʤ�');
    define('_WEBMAP3_JS_INVALID', '�����Υ֥饦���Ǥ� JavaScript �����ѤǤ��ޤ���');
    define('_WEBMAP3_NOT_SUCCESSFUL', '���������ɤϼ�����ͳ�Ǽ��Ԥ���');

    // kml
    define('_WEBMAP3_DOWNLOAD_KML', 'KML ���������ɤ��ơ�GoogleEarth �Ǹ���');

    // get_location
    define('_WEBMAP3_TITLE_GET_LOCATION', '���١����٤��������');
    define('_WEBMAP3_GET_LOCATION', '���١����٤��������');
    define('_WEBMAP3_GET_ADDRESS', '���١����٤��齻����������');
    define('_WEBMAP3_DISPLAY_DESC', 'GoogleMaps �ˤư��־�����������');
    define('_WEBMAP3_DISPLAY_NEW', '������������ɤ�ɽ������');
    define('_WEBMAP3_DISPLAY_POPUP', '�ݥåץ��åפ�ɽ������');
    define('_WEBMAP3_DISPLAY_INLINE', '�Ͽޤ�ɽ������');
    define('_WEBMAP3_DISPLAY_HIDE', '(��ɽ���ˤ���)');

    // set location
    define('_WEBMAP3_TITLE_SET_LOCATION', '���١����٤�����');

    // form
    define('_WEBMAP3_DBUPDATED', '�ǡ����١�����������������');
    define('_WEBMAP3_DELETED', '������ޤ���');
    define('_WEBMAP3_ERR_NOIMAGESPECIFIED', '����̤���򡧥��åץ��ɤ��٤������ե���������򤷤Ʋ�������');
    define('_WEBMAP3_ERR_FILE', '�������åץ��ɤ˼��ԡ������ե����뤬���Ĥ���ʤ����������¤�ۤ��Ƥޤ���');
    define('_WEBMAP3_ERR_FILEREAD', '�����ɹ����ԡ��ʤ�餫����ͳ�ǥ��åץ��ɤ��줿�����ե�������ɤ߽Ф��ޤ���');

    // PHP upload error
    // http://www.php.net/manual/en/features.file-upload.errors.php
    define('_WEBMAP3_UPLOADER_PHP_ERR_OK', '���顼�Ϥʤ����ե����륢�åץ��ɤ��������Ƥ��ޤ�');
    define('_WEBMAP3_UPLOADER_PHP_ERR_INI_SIZE', '���åץ��ɤ��줿�ե�����ϡ�upload_max_filesize ���ͤ�Ķ���Ƥ��ޤ�');
    define('_WEBMAP3_UPLOADER_PHP_ERR_FORM_SIZE', '���åץ��ɤ��줿�ե�����ϡ�%s ��Ķ���Ƥ��ޤ�');
    define('_WEBMAP3_UPLOADER_PHP_ERR_PARTIAL', '���åץ��ɤ��줿�ե�����ϰ����Τߤ������åץ��ɤ���Ƥ��ޤ���');
    define('_WEBMAP3_UPLOADER_PHP_ERR_NO_FILE', '�ե�����ϥ��åץ��ɤ���ޤ���Ǥ���');
    define('_WEBMAP3_UPLOADER_PHP_ERR_NO_TMP_DIR', '�ƥ�ݥ��ե����������ޤ���');
    define('_WEBMAP3_UPLOADER_PHP_ERR_CANT_WRITE', '�ǥ������ؤν񤭹��ߤ˼��Ԥ��ޤ���');
    define('_WEBMAP3_UPLOADER_PHP_ERR_EXTENSION', '�ե�����Υ��åץ��ɤ���ĥ�⥸�塼��ˤ�ä���ߤ���ޤ���');

    // upload error
    define('_WEBMAP3_UPLOADER_ERR_NOT_FOUND', '���åץ��ɡ��ե����뤬���Ĥ���ʤ�');
    define('_WEBMAP3_UPLOADER_ERR_INVALID_FILE_SIZE', '�ե����롦�����������ꤵ��Ƥ��ʤ�');
    define('_WEBMAP3_UPLOADER_ERR_EMPTY_FILE_NAME', '�ե�����̾�����ꤵ��Ƥ��ʤ�');
    define('_WEBMAP3_UPLOADER_ERR_NO_FILE', '�ե�����ϥ��åץ��ɤ���Ƥʤ�');
    define('_WEBMAP3_UPLOADER_ERR_NOT_SET_DIR', '���åץ��ɡ��ǥ��쥯�ȥ꤬���ꤵ��Ƥ��ʤ�');
    define('_WEBMAP3_UPLOADER_ERR_NOT_ALLOWED_EXT', '���Ĥ���Ƥ��ʤ���ĥ�ҤǤ�');
    define('_WEBMAP3_UPLOADER_ERR_PHP_OCCURED', '���åץ������ǥ��顼��ȯ������ ');
    define('_WEBMAP3_UPLOADER_ERR_NOT_OPEN_DIR', '���åץ��ɡ��ǥ��쥯�ȥ꤬�����ץ�Ǥ��ʤ� ');
    define('_WEBMAP3_UPLOADER_ERR_NO_PERM_DIR', '���åץ��ɡ��ǥ��쥯�ȥ�Υ����������¤��ʤ� ');
    define('_WEBMAP3_UPLOADER_ERR_NOT_ALLOWED_MIME', '���Ĥ���Ƥ��ʤ�MIME�����פǤ� ');
    define('_WEBMAP3_UPLOADER_ERR_LARGE_FILE_SIZE', '�ե����롦���������礭������ ');
    define('_WEBMAP3_UPLOADER_ERR_LARGE_WIDTH', '�����������礭������ ');
    define('_WEBMAP3_UPLOADER_ERR_LARGE_HEIGHT', '�����⤵���礭������ ');
    define('_WEBMAP3_UPLOADER_ERR_UPLOAD', '���åץ��ɤ˼��Ԥ��� ');

    //---------------------------------------------------------
    // v1.10
    //---------------------------------------------------------
    define('_WEBMAP3_TITLE_GEOCODING', '���������ǥ���');
    define('_WEBMAP3_TITLE_GEOCODING_DESC', 'Google Geocoding API ����Ѥ��ơ����꤫����١����٤򸡺����ޤ�');
    define('_WEBMAP3_LOOK_GOOGLE_MAP', '�礭���ϿޤǸ���');
    // === define end ===
}
