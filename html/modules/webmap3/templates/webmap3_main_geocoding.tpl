<{* $Id: webmap3_main_geocoding.html,v 1.2 2012/04/11 05:53:47 ohwada Exp $ *}>

<h3 align='center'><{$module_name}></h3>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php">[<{$lang_title_search}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php?fct=location">[<{$lang_title_location}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php?fct=georss">[<{$lang_title_georss}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/index.php?fct=geocoding">[<{$lang_title_geocoding}>]</a>
<a href="<{$xoops_url}>/modules/<{$xoops_dirname}>/demo.php">[<{$lang_title_demo}>]</a>

<h4><{$lang_title_geocoding}></h4>
<{$lang_title_geocoding_desc}><br><br>
<{$lang_language}>: <{$language_s}> ,
<{$lang_region}>: <{$region_s}>
<br><br>

<form action="#">
    <input type="hidden" name="fct" value="geocoding"/>
    <{$lang_address}>
    <input type="text" name="address" value="<{$address}>" size="60"/>
    <input type="submit" name="submit" value="<{$lang_search}>"/>
</form>
<br>

<{if $error}>
<div class="webmap3_error"><{$error}></div>
<br>
<{/if}>

<{if $latitude && $longitude }>
<table class="outer" cellpadding="4" cellspacing="1">
    <tr>
        <th class="head"><{$lang_address}></th>
        <th class="head"><{$lang_latitude}></th>
        <th class="head"><{$lang_longitude}></th>
    </tr>

    <{foreach from=$results item=result }>
    <tr>
        <td class="odd"><{$result.formatted_address}></td>
        <td class="odd"><{$result.lat}></td>
        <td class="odd"><{$result.lng}></td>
    </tr>
    <{/foreach}>

</table>
<br>

<iframe src="https://maps.google.com/maps?q=<{$latitude}>,<{$longitude}>&amp;ie=UTF8&amp;t=m&amp;z=12&amp;output=embed"
        width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
</iframe><br>

<small>
    <a href="https://maps.google.com/maps?q=<{$latitude}>,<{$longitude}>&amp;ie=UTF8&amp;t=m&amp;z=12&amp;source=embed"
       target="_blank " style="color:#0000FF;text-align:left">
        <{$lang_look_google_map}>
    </a></small>
<br><br>
<{/if}>

<{if $is_module_admin }>
<br>
<hr>
<a href="./admin/index.php">go to admin cp</a>
<{/if}>
