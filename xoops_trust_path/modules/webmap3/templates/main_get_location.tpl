<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<{$xoops_langcode}>" lang="<{$xoops_langcode}>">
<head>
    <{* $Id: main_get_location.html,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $ *}>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">
    <title><{$lang_title}></title>
    <link href="<{$xoops_url}>/modules/<{$webmap3_dirname}>/libs/default.css" type="text/css" rel="stylesheet">
    <{*<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=<{$xoops_langcode}>" type="text/javascript" charset="utf-8"></script>*}>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9gAxpIpP1FRJI9E842rkaX7t5pehpQc0&callback=initMap" async defer></script>
    <script src="<{$xoops_url}>/modules/<{$webmap3_dirname}>/libs/map.js" type="text/javascript"></script>
    <script src="<{$xoops_url}>/modules/<{$webmap3_dirname}>/libs/search.js" type="text/javascript"></script>
    <{$head_js}>
</head>
<body>
<script type="text/javascript">
    //<![CDATA[
    window.onload = webmap3_load_get_location;
    //]]>
</script>

<h4><{$lang_title}></h4>

<noscript>
    <div class="xoops_error"><{$lang_not_js_support}></div>
</noscript>

<form action="#" onsubmit="webmap3_searchAddress(this.<{$ele_id_search}>.value); return false">
    <{$lang_address}>
    <input type="text" id="<{$ele_id_search}>" name="<{$ele_id_search}>" value="<{$address}>" size="60">
    <input type="submit" value="<{$lang_search}>">
</form>
<br>

<{if $show_search_reverse }>
    <input type="button" value="<{$lang_search_reverse}>" onclick="webmap3_searchReverse()">
    <br>
    <br>
<{/if}>

<b><{$lang_current_location}></b><br>
<div id="<{$ele_id_current_location}>"></div>
<br>

<{if $show_current_address }>
    <b><{$lang_current_address}></b>
    <br>
    <div id="<{$ele_id_current_address}>"></div>
    <br>
<{/if}>

<b><{$lang_search_list}></b><br>
<div id="<{$ele_id_list}>"></div>
<br>

<div id="<{$ele_id_map}>" style="<{$map_style}>">Loading ...</div>
<br>

<input type="button" value="<{$lang_get_location}>" onclick="webmap3_setParentCenterLocation()">

<{if $show_set_address }>
    <input type="button" value="<{$lang_get_address}>" onclick="webmap3_setParentCurrentAddress()">
<{/if}>

<{if $show_close }>
    <input type="button" value="<{$lang_close}>" onclick="window.close()">
<{/if}>

<{if $show_hide_map }>
    <input type="button" value="<{$lang_hide_map}>" onclick="<{$func_hide_map}>()">
<{/if}>

<br><br>
</body>
</html>
