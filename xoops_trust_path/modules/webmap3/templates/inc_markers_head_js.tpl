<{* $Id: inc_markers_head_js.html,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function
    <{$map_func}>() {
        <{* var param = {}; *}>
        <{include file = "db:`$webmap3_dirname`_inc_map_param_js.html"}>
        var gicon_array = <{$gicon_func}>();
        var marker_array = new Array();
        <{* --map photo_loop-- *}>
        <{counter name = "map_marker_i" assign = "map_marker_i" start = 0 print = false}>
        <{foreach item = map_marker from = $map_markers}>
        var marker = {};
        marker["latitude"] = <{$map_marker.latitude}>;
        marker["longitude"] =<{$map_marker.longitude}>;
        marker["icon_id"] =<{$map_marker.icon_id}>;
        marker["info"] = '<{$map_marker.info}>';
        marker_array[<{$map_marker_i}>] = marker;
        <{counter name = "map_marker_i" assign = "map_marker_i" print = false}>
        <{/foreach}>
        webmap3_markers(param, marker_array, gicon_array);
    }

    //]]>
</script>
