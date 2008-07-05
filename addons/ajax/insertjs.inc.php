<?php
/*

*/
global $headertext;
$onready='';
$loadingajax=empty($_REQUEST['ajax']);
if (!$loadingajax) $headertext='';

switch ($page) {
        //-------------------------------------------------------------
    case 'item':
        if(!$loadingajax) {
            global $show,$descrows,$outcomerows;
            $show['header']=$show['footer']=$show['submitbuttons']=
                $show['ptitle']=$show['scriptparents']=$show['dateCreated']=
                $show['changetypes']=false;
            $loadingajax=false;
            $descrows=4;
            $outcomerows=2;
        }
        // TODO: attach onkeypress='return GTD.tagKeypress(event);' onto tag input field
        break;
        //-------------------------------------------------------------
    case 'listItems':    
        $onready.="GTD.ajax.multisetup();";
        if($loadingajax)
            $headertext.="<script type='text/javascript' src='{$addon['dir']}jquery-ui-sortable.js'></script>";
        break;
        //-------------------------------------------------------------
    case 'itemReport':
        $onready.="GTD.ajax.inititem();";
        break;
        //-------------------------------------------------------------
    case 'preferences':
        $onready.="GTD.ajax.setTabs();";
        break;
        //-------------------------------------------------------------
    case 'reportContext':
        $onready.="GTD.ajax.initcontext();";
        break;
        //-------------------------------------------------------------
    default:
        // if none of the above, then there is no ajax
        $loadingajax=false;
        break;
        //-------------------------------------------------------------
}
if ($loadingajax) {
    $headertext.= <<<HTML

<link rel='stylesheet' href='{$addon['dir']}ajax.css' type='text/css' />
<script type='text/javascript' src='{$addon['dir']}gtdajax.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
$(document).ready(function() {
    GTD.urlprefix='{$addon['urlprefix']}';
    GTD.ajax.dir='{$addon['dir']}';
    $onready
});
/* ]]> */
</script>
HTML;
}

// php closing tag has been omitted deliberately, to avoid unwanted blank lines being sent to the browser
