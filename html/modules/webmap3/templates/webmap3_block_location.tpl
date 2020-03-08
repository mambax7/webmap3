<{* $Id: webmap3_block_location.html,v 1.2 2012/04/09 12:09:43 ohwada Exp $ *}>

<script type="text/javascript">
    //<![CDATA[
    setTimeout('<{$block.func}>()', < {$block.timeout}> );
    //]]>
</script>

<div id="<{$block.div_id}>" style="width:100%; height:<{$block.height}>px;">
    Loading ...
</div>
<br>
<a href="<{$xoops_url}>/modules/<{$block.dirname}>/index.php?fct=location">
    <{$block.lang_more}></a><br>
