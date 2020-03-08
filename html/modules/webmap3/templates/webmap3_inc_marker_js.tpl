<{* $Id: webmap3_inc_marker_js.html,v 1.1.1.1 2012/03/17 09:28:52 ohwada Exp $ *}>

<{if $show_google_js }>
<script src="https://maps.google.com/maps/api/js?sensor=false&amp;language=<{$xoops_langcode}>" type="text/javascript" charset="utf-8"></script>
<{/if}>

<{if $show_map_js }>
<script src="<{$xoops_url}>/modules/<{$xoops_dirname}>/libs/map.js" type="text/javascript"></script>
<{/if}>

<script type="text/javascript">
    //<![CDATA[

    function webmap3_load_markers_
    <
    {
        $id
    }
    >
    ()
    {

    <
        {*
            var param = {};
        *
        }
    >
    <
        {
            include
            file = "db:`$xoops_dirname`_inc_map_param.html"
        }
    >

        var marker_array = new Array();
        var icon_array = new Array();

    <
        {*
            --map
            photo_loop-- *
        }
    >
    <
        {
            counter
            name = "map_marker_i"
            assign = "map_marker_i"
            start = 0
            print = false
        }
    >
    <
        {
            foreach
            item = map_marker
            from = $map_markers
        }
    >
        var marker = {};
        marker["latitude"] =
    <
        {
            $map_marker.latitude
        }
    >
        ;
        marker["longitude"] =
    <
        {
            $map_marker.longitude
        }
    >
        ;
        marker["icon_id"] =
    <
        {
            $map_marker.icon_id
        }
    >
        ;
        marker["info"] = '<{$map_marker.info}>';
        marker_array[ < {$map_marker_i} >
    ]
        = marker;

    <
        {
            counter
            name = "map_marker_i"
            assign = "map_marker_i"
            print = false
        }
    >
    <
        {/
            foreach
        }
    >
    <
        {*
            --map
            photo
            loop
            end-- *
        }
    >

    <
        {*
            --map
            icon
            loop-- *
        }
    >
    <
        {
            counter
            name = "map_icon_i"
            assign = "map_icon_i"
            start = 0
            print = false
        }
    >
    <
        {
            foreach
            item = map_icon
            from = $map_icons
        }
    >
        var icon = {};
        icon["id"] =
    <
        {
            $map_icon.id
        }
    >
        ;
        icon["image_url"] = "<{$map_icon.image_url}>";
        icon["image_width"] =
    <
        {
            $map_icon.image_width
        }
    >
        ;
        icon["image_height"] =
    <
        {
            $map_icon.image_height
        }
    >
        ;
        icon["anchor_x"] =
    <
        {
            $map_icon.anchor_x
        }
    >
        ;
        icon["anchor_y"] =
    <
        {
            $map_icon.anchor_y
        }
    >
        ;
        icon["info_x"] =
    <
        {
            $map_icon.info_x
        }
    >
        ;
        icon["info_y"] =
    <
        {
            $map_icon.info_y
        }
    >
        ;
        icon["shadow_url"] = "<{$map_icon.shadow_url}>";
        icon["shadow_width"] =
    <
        {
            $map_icon.shadow_width
        }
    >
        ;
        icon["shadow_height"] =
    <
        {
            $map_icon.shadow_height
        }
    >
        ;
        icon_array[ < {$map_icon_i} >
    ]
        = icon;

    <
        {
            counter
            name = "map_icon_i"
            assign = "map_icon_i"
            print = false
        }
    >
    <
        {/
            foreach
        }
    >
    <
        {*
            --map
            icon
            loop
            end-- *
        }
    >

        webmap3_markers(param, marker_array, icon_array);

    }

    window.onload = webmap3_load_markers_ < {$id} >;
    window.onunload = GUnload;
    //]]>
</script>

<{if $show_element }>
<div id="<{$element_map}>" style="<{$style}>">Loading ...</div>
<{/if}>
