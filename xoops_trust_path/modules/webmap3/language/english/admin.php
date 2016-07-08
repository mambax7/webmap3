<?php
// $Id: admin.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

// === define begin ===
if (!defined('_AM_WEBMAP3_LANG_LOADED')) {
    define('_AM_WEBMAP3_LANG_LOADED', 1);

    // menu
    define('_AM_WEBMAP3_MYMENU_TPLSADMIN', 'Templates');
    define('_AM_WEBMAP3_MYMENU_BLOCKSADMIN', 'Blocks/Permissions');
    define('_AM_WEBMAP3_MYMENU_GOTO_MODULE', 'Goto Module');

    // index
    define('_AM_WEBMAP3_CHK_SERVER', 'Server Environment');
    define('_AM_WEBMAP3_CHK_PHP', 'PHP Config');
    define('_AM_WEBMAP3_CHK_DIR', 'Direcoroty Config');
    define('_AM_WEBMAP3_CHK_BOTH_OK', 'Both OK');
    define('_AM_WEBMAP3_CHK_NEED_ON', 'Need ON');
    define('_AM_WEBMAP3_CHK_RECOMMEND_OFF', 'Recommend OFF');
    define('_AM_WEBMAP3_CHK_MB_LINK', "Check that 'Charset Convert' is working correctly in your server");
    define('_AM_WEBMAP3_CHK_MB_DSC', "If the page linked to from here doesn't display correctly, you should not use 'Charset Convert' ");
    define('_AM_WEBMAP3_CHK_MB_SUCCESS', 'Can you read this sentence correctly, wihout character garble ? ');
    define('_AM_WEBMAP3_CHK_GD_LINK', "Check that 'GD2' is working correctly under your GD bundled with PHP");
    define('_AM_WEBMAP3_CHK_GD_DSC', "If the page linked to from here doesn't display correctly, you should not use your GD in truecolor mode");
    define('_AM_WEBMAP3_CHK_GD_SUCCESS', 'Success!<br />Perhaps, you can use GD2 (truecolor) in this environment.');
    define('_AM_WEBMAP3_CHK_GD_FAILED', 'Failed!<br />Perhaps, you can NOT use GD2 in this environment.');
    define('_AM_WEBMAP3_CHK_ERR_CHAR_FIRST_NEED', "Error: The first charactor should be '/'");
    define('_AM_WEBMAP3_CHK_ERR_CHAR_FIRST_NOT', "Error: The first charactor should NOT be '/'");
    define('_AM_WEBMAP3_CHK_ERR_CHAR_LAST_NEED', "Error: The last charactor should be '/'");
    define('_AM_WEBMAP3_CHK_ERR_CHAR_LAST_NOT', "Error: The last charactor should NOT be '/'");
    define('_AM_WEBMAP3_CHK_ERR_DIR_PERM', 'Error: You first have to create and chmod 777 this directory by ftp or shell.');
    define('_AM_WEBMAP3_CHK_ERR_DIR_NOT', 'Error: This is not a directory.');
    define('_AM_WEBMAP3_CHK_ERR_DIR_WRITE', 'Error: This directory is not writable nor readable. You should change the permission of the directory to 777.');
    define('_AM_WEBMAP3_CHK_WARN_DIR_GEUST', 'Anoymous user can read file in this directory');
    define('_AM_WEBMAP3_CHK_WARN_DIR_RECOMMEND', 'Recommend to set it except under the document root');

    // location
    define('_AM_WEBMAP3_LOCATION', 'Latitude and Longitude Setting');
    define('_AM_WEBMAP3_ADDRESS', 'Address Setting');
    define('_AM_WEBMAP3_ICON', 'Icon of Marker');
    define('_AM_WEBMAP3_ICON_SELECT', 'Icon Select');

    // gicon list
    define('_AM_WEBMAP3_GICON_ADD', 'Add New Google Icon');
    define('_AM_WEBMAP3_GICON_LIST_IMAGE', 'Icon');
    define('_AM_WEBMAP3_GICON_LIST_SHADOW', 'Shadow');
    define('_AM_WEBMAP3_GICON_ANCHOR', 'Anchor Point');
    define('_AM_WEBMAP3_GICON_WINANC', 'Window Anchor');
    define('_AM_WEBMAP3_GICON_LIST_EDIT', 'Edit Icon');

    // gicon form
    define('_AM_WEBMAP3_GICON_MENU_NEW', 'Add Icon');
    define('_AM_WEBMAP3_GICON_MENU_EDIT', 'Edit Icon');
    define('_AM_WEBMAP3_GICON_IMAGE_SEL', 'Select Icon Image');
    define('_AM_WEBMAP3_GICON_SHADOW_SEL', 'Select Icon Shadow');
    define('_AM_WEBMAP3_GICON_SHADOW_DEL', 'Delete Icon Shadow');
    define('_AM_WEBMAP3_GICON_DELCONFIRM', 'Confirm delete icon %s ?');
    define('_AM_WEBMAP3_CAP_MAXPIXEL', 'Max pixel size');
    define('_AM_WEBMAP3_CAP_MAXSIZE', 'Max file size (byte)');
    define('_AM_WEBMAP3_DSC_RESIZE', 'Resize automatically if bigger than this size');

    // === define end ===
}
