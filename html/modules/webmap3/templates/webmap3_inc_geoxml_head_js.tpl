<{* $Id: webmap3_inc_geoxml_head_js.html,v 1.1 2012/03/17 09:42:55 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function <{$map_func}>()
    {
        <{include file="db:`$webmap3_dirname`_inc_map_param_js.html" }>
        param["xml_url"] = "<{$xml_url}>";
        webmap3_geoxml( param );
    }
    //]]>
</script>
