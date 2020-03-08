<{* $Id: webmap3_inc_get_location_js.html,v 1.1.1.1 2012/03/17 09:28:52 ohwada Exp $ *}>

<{if $show_google_js }>
<script src="https://maps.google.com/maps/api/js?sensor=false&amp;language=<{$xoops_langcode}>" type="text/javascript" charset="utf-8"></script>
<{/if}>

<{if $show_map_js }>
<script src="<{$xoops_url}>/modules/<{$xoops_dirname}>/libs/map.js" type="text/javascript"></script>
<{/if}>

<script type="text/javascript">
    //<![CDATA[

    <{* value: strings *}>
    <{if $marker_url}> webmap3_marker_url = "<{$marker_url}>";
    <{/if}>
    <{if $opener_mode}>webmap3_opener_mode = "<{$opener_mode}>";
    <{/if}>
    <{if $element_latitude }>webmap3_element_latitude = "<{$element_latitude}>";
    <{/if}>
    <
    {
        if $element_longitude }
    >
    webmap3_element_longitude = "<{$element_longitude}>";
    <
    {/
        if}
    >
    <
    {
        if $element_zoom }
    >
    webmap3_element_zoom = "<{$element_zoom}>";
    <
    {/
        if}
    >
    <
    {
        if $element_list }
    >
    webmap3_element_list = "<{$element_list}>";
    <
    {/
        if}
    >
    <
    {
        if $element_search }
    >
    webmap3_element_search = "<{$element_search}>";
    <
    {/
        if}
    >
    <
    {
        if $element_current_location}
    >
    webmap3_element_current_location = "<{$element_current_location}>";
    <
    {/
        if}
    >
    <
    {
        if $element_parent_latitude}
    >
    webmap3_element_parent_latitude = "<{$element_parent_latitude}>";
    <
    {/
        if}
    >
    <
    {
        if $element_parent_longitude}
    >
    webmap3_element_parent_longitude = "<{$element_parent_longitude}>";
    <
    {/
        if}
    >
    <
    {
        if $element_parent_zoom}
    >
    webmap3_element_parent_zoom = "<{$element_parent_zoom}>";
    <
    {/
        if}
    >
    <
    {
        if $element_parent_address}
    >
    webmap3_element_parent_address = "<{$element_parent_address}>";
    <
    {/
        if}
    >

    <
    {*
        value: strings : "true"
        or
        "false" *
    }
    >
    <
    {
        if $use_draggable_marker != "" }
    >
    webmap3_use_draggable_marker =
    <
    {
        $use_draggable_marker
    }
    >
    ;
    <
    {/
        if}
    >
    <
    {
        if $use_set_parent_location != "" }
    >
    webmap3_use_set_parent_location =
    <
    {
        $use_set_parent_location
    }
    >
    ;
    <
    {/
        if}
    >
    <
    {*
        value: strings : Language *
    }
    >
    <
    {
        if $lang_latitude }
    >
    webmap3_lang_latitude = "<{$lang_latitude}>";
    <
    {/
        if}
    >
    <
    {
        if $lang_longitude }
    >
    webmap3_lang_longitude = "<{$lang_longitude}>";
    <
    {/
        if}
    >
    <
    {
        if $lang_zoom }
    >
    webmap3_lang_zoom = "<{$lang_zoom}>";
    <
    {/
        if}
    >
    <
    {
        if $lang_not_successful}
    >
    webmap3_lang_not_successful = "<{$lang_not_successful}>";
    <
    {/
        if}
    >
    <
    {
        if $lang_no_match_place }
    >
    webmap3_lang_no_match_place = "<{$lang_no_match_place}>";
    <
    {/
        if}
    >

    function webmap3_load_get_location() {

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

        webmap3_get_location(param);
    }

    window.onload = webmap3_load_get_location;
    window.onunload = GUnload;
    //]]>
</script>

<{if $show_element }>
    <div id="<{$element}>" style="<{$style}>">Loading ...</div>
<{/if}>
