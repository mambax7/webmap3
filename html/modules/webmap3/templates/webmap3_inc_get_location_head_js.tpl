<{* $Id: inc_get_location_head_js.html,v 1.2 2012/04/09 11:52:19 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function <{$map_func}>()
    {
        <{include file="db:`$webmap3_dirname`_inc_map_param_js.html" }>
        webmap3_get_location( param );
    }

    <{* value: strings *}>
    <{if $webmap3_marker_url }>
    webmap3_marker_url = "<{$webmap3_marker_url}>";
    <{/if}>
    <{if $opener_mode }>
    webmap3_opener_mode = "<{$opener_mode}>";
    <{/if}>
    <{if $ele_id_latitude }>
    webmap3_ele_id_latitude = "<{$ele_id_latitude}>";
    <{/if}>
    <{if $ele_id_longitude }>
    webmap3_ele_id_longitude = "<{$ele_id_longitude}>";
    <{/if}>
    <{if $ele_id_zoom }>
    webmap3_ele_id_zoom = "<{$ele_id_zoom}>";
    <{/if}>
    <{if $ele_id_list }>
    webmap3_ele_id_list = "<{$ele_id_list}>";
    <{/if}>
    <{if $ele_id_search }>
    webmap3_ele_id_search = "<{$ele_id_search}>";
    <{/if}>
    <{if $ele_id_current_location}>
    webmap3_ele_id_current_location = "<{$ele_id_current_location}>";
    <{/if}>
    <{if $ele_id_current_address}>
    webmap3_ele_id_current_address = "<{$ele_id_current_address}>";
    <{/if}>
    <{if $ele_id_parent_latitude}>
    webmap3_ele_id_parent_latitude = "<{$ele_id_parent_latitude}>";
    <{/if}>
    <{if $ele_id_parent_longitude}>
    webmap3_ele_id_parent_longitude = "<{$ele_id_parent_longitude}>";
    <{/if}>
    <{if $ele_id_parent_zoom}>
    webmap3_ele_id_parent_zoom = "<{$ele_id_parent_zoom}>";
    <{/if}>
    <{if $ele_id_parent_address}>
    webmap3_ele_id_parent_address = "<{$ele_id_parent_address}>";
    <{/if}>

    <{* value: strings : "true" or "false" *}>
    <{if $use_draggable_marker != "" }>
    webmap3_use_draggable_marker = <{$use_draggable_marker}>;
    <{/if}>
    <{if $use_center_marker != "" }>
    webmap3_use_center_marker = <{$use_center_marker}>;
    <{/if}>
    <{if $use_current_location  != "" }>
    webmap3_use_current_location = <{$use_current_location }>;
    <{/if}>
    <{if $use_current_address  != "" }>
    webmap3_use_current_address = <{$use_current_address }>;
    <{/if}>
    <{if $use_parent_location != "" }>
    webmap3_use_parent_location = <{$use_parent_location}>;
    <{/if}>

    <{* value: strings : Language *}>
    <{if $lang_latitude }>
    webmap3_lang_latitude = "<{$lang_latitude}>";
    <{/if}>
    <{if $lang_longitude }>
    webmap3_lang_longitude = "<{$lang_longitude}>";
    <{/if}>
    <{if $lang_zoom }>
    webmap3_lang_zoom = "<{$lang_zoom}>";
    <{/if}>
    <{if $lang_not_successful}>
    webmap3_lang_not_successful = "<{$lang_not_successful}>";
    <{/if}>
    <{if $lang_no_match_place }>
    webmap3_lang_no_match_place  = "<{$lang_no_match_place}>";
    <{/if}>
    //]]>
</script>
