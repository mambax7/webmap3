<{* $Id: inc_gicon_js.html,v 1.1 2012/03/17 09:28:11 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function webmap3_gicon_get_icons()
    {
        var icons = new Array();

        <{* -- gicon icon loop -- *}>
        <{foreach item=gicon_icon from=$gicon_icons}>
        icons[ <{$gicon_icon.id}> ] = "<{$gicon_icon.image_url}>";
        <{/foreach}>
        <{* -- gicon icon loop end -- *}>

        return icons;
    }
    //]]>
</script>
