<{* $Id: inc_gicon_array_js.html,v 1.1 2012/03/17 09:28:11 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function <{$gicon_func}>()
    {
        var gicon_array = new Array();

        <{counter name="map_gicon_i" assign="map_gicon_i" start=0 print=false }>
        <{foreach item=map_gicon from=$map_gicons}>
        var gicon = {};
        gicon["id"]            = <{$map_gicon.id}>;
        gicon["image_url"]     = "<{$map_gicon.image_url}>";
        gicon["image_width"]   = <{$map_gicon.image_width}>;
        gicon["image_height"]  = <{$map_gicon.image_height}>;
        gicon["anchor_x"]      = <{$map_gicon.anchor_x}>;
        gicon["anchor_y"]      = <{$map_gicon.anchor_y}>;
        gicon["info_x"]        = <{$map_gicon.info_x}>;
        gicon["info_y"]        = <{$map_gicon.info_y}>;
        gicon["shadow_url"]    = "<{$map_gicon.shadow_url}>";
        gicon["shadow_width"]  = <{$map_gicon.shadow_width}>;
        gicon["shadow_height"] = <{$map_gicon.shadow_height}>;
        gicon_array[ <{$map_gicon_i}> ] = gicon;

        <{counter name="map_gicon_i" assign="map_gicon_i" print=false }>
        <{/foreach}>

        return gicon_array;
    }
    //]]>
</script>
