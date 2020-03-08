<{* $Id: webmap3_inc_search_js.html,v 1.1.1.1 2012/03/17 09:28:52 ohwada Exp $ *}>

<{if $show_google_js }>
    <script src="https://maps.google.com/maps/api/js?sensor=false&amp;language=<{$xoops_langcode}>" type="text/javascript" charset="utf-8"></script>
<{/if}>

<{if $show_map_js }>
    <script src="<{$xoops_url}>/modules/<{$xoops_dirname}>/libs/map.js" type="text/javascript"></script>
<{/if}>

<script type="text/javascript">
    //<![CDATA[

    <{* value: strings *}>
    <{if $marker_url}>    webmap3_marker_url = "<{$marker_url}>";
    <{/if}>
    <{if $element_list}>webmap3_element_list = "<{$element_list}>";
    <{/if}>

    <{* value: strings : "true" or "false" *}>
    <{if $use_search_marker != ""}>    webmap3_use_search_marker = <{$use_search_marker}>;
    <{/if}>
    <{* value: strings : Language *}>
    <{if $lang_not_successful}>webmap3_lang_not_successful = "<{$lang_not_successful}>";
    <{/if}>
    <{if $lang_no_match_place}>webmap3_lang_no_match_place = "<{$lang_no_match_place}>";
    <{/if}>

    function webmap3_load_search() {

        <{*var param = {};       *}>
        <{include file = "db:`$xoops_dirname`_inc_map_param.html"}>
        webmap3_search(param);
    }

    window.onload = webmap3_load_search;
    window.onunload = GUnload;

    //]]>
</script>

<{if $show_element }>
    <div id="<{$element}>" style="<{$style}>">Loading ...</div>
<{/if}>
