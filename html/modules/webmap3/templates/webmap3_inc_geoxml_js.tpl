<{* $Id: webmap3_inc_geoxml_js.html,v 1.1.1.1 2012/03/17 09:28:52 ohwada Exp $ *}>

<{if $show_google_js }>
<script src="https://maps.google.com/maps/api/js?sensor=false&amp;language=<{$xoops_langcode}>" type="text/javascript" charset="utf-8"></script>
<{/if}>

<{if $show_map_js }>
<script src="<{$xoops_url}>/modules/<{$xoops_dirname}>/libs/map.js" type="text/javascript"></script>
<{/if}>

<script type="text/javascript">
    //<![CDATA[
    function webmap3_load_geoxml_
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
        param["xml_url"] = "<{$xml_url}>";

        webmap3_geoxml(param);
    }

    window.onload = webmap3_load_geoxml_ < {$id} >;
    window.onunload = GUnload;
    //]]>
</script>

<{if $show_element }>
<div id="<{$element}>" style="<{$style}>">Loading ...</div>
<{/if}>
