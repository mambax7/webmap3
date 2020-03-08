<{* $Id: inc_set_location_form.tpl,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $ *}>

<form action="#" method="post">
    <input type="hidden" name="op" value="edit">
    <input type="hidden" name="XOOPS_G_TICKET" value="<{$ticket}>">
    <table width='100%' class='outer' cellspacing='1'>
        <tr>
            <th colspan='2'><{$lang_title}></th>
        </tr>
        <tr>
            <td class="head"><{$lang_address}></td>
            <td class="even">
                <{$address|escape:'html'}><br>
                <input type="text" id="webmap3_address" name="webmap3_address" value="<{$address|escape:'html'}>" size="50">
            </td>
        </tr>
        <tr>
            <td class="head"><{$lang_latitude}></td>
            <td class="even">
                <{$latitude}><br>
                <input type="text" id="webmap3_latitude" name="webmap3_latitude" value="<{$latitude}>" size="50">
            </td>
        </tr>
        <tr>
            <td class="head"><{$lang_longitude}></td>
            <td class="even">
                <{$longitude}><br>
                <input type="text" id="webmap3_longitude" name="webmap3_longitude" value="<{$longitude}>" size="50">
            </td>
        </tr>
        <tr>
            <td class="head"><{$lang_zoom}></td>
            <td class="even">
                <{$zoom}><br>
                <input type="text" id="webmap3_zoom" name="webmap3_zoom" value="<{$zoom}>" size="50">
            </td>
        </tr>
        </tr>
        <td class="head"><{$lang_icon}></td>
        <td class="even"><{$icon_content}></td>
        </tr>
        <tr>
            <td class="head"></td>
            <td class="even"><input type="submit" value="<{$lang_edit}>"></td>
        </tr>
    </table>
</form>
