<{* $Id: webmap3_inc_display_style_js.html,v 1.1 2012/04/09 12:10:15 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function <{$func_popup}>()
    {
        var options = "width=<{$open_width}>, height=<{$open_height}>, ";
        options += "toolbar=no, location=yes, directories=no, status=no, ";
        options += "menubar=no, scrollbars=yes, resizable=yes, copyhistory=no";
        window.open( "<{$open_url}>", "<{$open_name}>", options );
    }
    function <{$func_style_show}>()
    {
        var element = document.getElementById( "<{$div_id}>" );
        if ( element != null ) {
            element.style.display = "block";
        }
    }
    function <{$func_style_hide}>()
    {
        var element = document.getElementById( "<{$div_id}>" );
        if ( element != null ) {
            element.style.display = "none";
        }
    }
    //]]>
</script>
