<{* $Id: main_search.html,v 1.2 2012/04/09 11:52:19 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    window.onload = <{$map_func}>;
    //]]>
</script>

<h3 align='center'><{$module_name}></h3>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php">[<{$lang_title_search}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php?fct=location">[<{$lang_title_location}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php?fct=georss">[<{$lang_title_georss}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php?fct=geocoding">[<{$lang_title_geocoding}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/demo.php">[<{$lang_title_demo}>]</a>

<h4><{$lang_title_search}></h4>
<{$lang_title_search_desc}><br><br>

<noscript>
    <div class="webmap3_error"><{$lang_js_invalid}></div>
</noscript>


<form action="#" onsubmit="webmap3_searchAddress(this.<{$ele_id_search}>.value); return false">
    <{$lang_address}>
    <input type="text" id="<{$ele_id_search}>" name="<{$ele_id_search}>" value="<{$address_s}>" size="60" />
    <input type="submit" value="<{$lang_search}>" />
</form>
<br>

<b><{$lang_search_list}></b><br>
<div id="<{$ele_id_list}>"></div>
<br>

<div id="<{$map_div_id}>" class="webmap3_map_search">Loading ...</div>
<br>

<{if $is_module_admin }>
    <br>
    <hr>
    <a href="./admin/index.php">go to admin cp</a>
<{/if}>
