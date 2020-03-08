<{* $Id: webmap3_inc_display_html_js.html,v 1.1 2012/04/09 12:10:15 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    function <{$func_popup}>()
    {
        var options = "width=<{$open_width}>, height=<{$open_height}>, ";
        options += "toolbar=no, location=yes, directories=no, status=no, ";
        options += "menubar=no, scrollbars=yes, resizable=yes, copyhistory=no";
        window.open( "<{$open_url}>", "<{$open_name}>", options );
    }
    function <{$func_html_show}>()
    {
        var html = '<iframe src="<{$iframe_url|escape}>" ';
        html += 'width="<{$iframe_width}>" height="<{$iframe_height}>" ';
        html += 'frameborder="0" scrolling="yes">';
        html += '</iframe>';

        var element = document.getElementById( "<{$div_id}>" );
        if ( element != null ) {
            element.innerHTML = html;
        }
    }
    function <{$func_html_hide}>()
    {
        var element = document.getElementById( "<{$div_id}>" );
        if ( element != null ) {
            element.innerHTML = '';
        }
    }
    //]]>
</script>
