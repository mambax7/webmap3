<{* $Id: inc_search_head_js.html,v 1.2 2012/04/09 11:52:19 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function <{$map_func}>()
    {
        <{include file="db:`$webmap3_dirname`_inc_map_param_js.tpl" }>
        webmap3_search( param );
    }

    <{* value: strings *}>
    <{if $marker_url }>
    webmap3_marker_url = "<{$marker_url}>";
    <{/if}>
    <{if $region }>
    webmap3_region = "<{$region}>";
    <{/if}>
    <{if $ele_id_list }>
    webmap3_ele_id_list = "<{$ele_id_list}>";
    <{/if}>

    <{* value: strings : "true" or "false" *}>
    <{if $use_search_marker != "" }>
    webmap3_use_search_marker = <{$use_search_marker}>;
    <{/if}>

    <{* value: strings : Language *}>
    <{if $lang_not_successful}>
    webmap3_lang_not_successful = "<{$lang_not_successful}>";
    <{/if}>
    <{if $lang_no_match_place }>
    webmap3_lang_no_match_place  = "<{$lang_no_match_place}>";
    <{/if}>
    //]]>
</script>
