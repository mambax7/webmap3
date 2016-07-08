<?php
// $Id: functions.php,v 1.1.1.1 2012/03/17 09:28:10 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//---------------------------------------------------------
// blocks
//---------------------------------------------------------
function b_webmap3_location_show($options)
{
    $inc_class = b_webmap3_blocks($options);
    return $inc_class->location_show($options);
}

function b_webmap3_location_edit($options)
{
    $inc_class = b_webmap3_blocks($options);
    return $inc_class->location_edit($options);
}

function &b_webmap3_blocks($options)
{
    if (isset($options[0]) && $options[0]) {
        $dirname = $options[0];
    } else {
        $dirname = 'webmap3';
    }

    $ret = webmap3_inc_blocks::getSingleton($dirname, WEBMAP3_TRUST_DIRNAME);
    return $ret;
}
