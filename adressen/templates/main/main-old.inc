<script type="text/javascript">


function submit_form()
{
   return true;
}

function setFocus()
{
    
}
//-->
</script>

<script type="text/javascript">

/* AJAX Star Rating : v1.0.3 : 2008/05/06 */
/* http://www.nofunc.com/AJAX_Star_Rating/ */

function $(v,o) { return((typeof(o)=='object'?o:document).getElementById(v)); }
function $S(o) { return((typeof(o)=='object'?o:$(o)).style); }
function agent(v) { return(Math.max(navigator.userAgent.toLowerCase().indexOf(v),0)); }
function abPos(o) { var o=(typeof(o)=='object'?o:$(o)), z={X:0,Y:0}; while(o!=null) { z.X+=o.offsetLeft; z.Y+=o.offsetTop; o=o.offsetParent; }; return(z); }
function XY(e,v) { var o=agent('msie')?{'X':event.clientX+document.body.scrollLeft,'Y':event.clientY+document.body.scrollTop}:{'X':e.pageX,'Y':e.pageY}; return(v?o[v]:o); }

star={};


star.num=0;

</script>


<div id="dhtmltooltip"></div>
<script type="text/javascript">

/***********************************************
* Freejavascriptkit.com
* Visit http://www.freejavascriptkit.com for more free Javascripts source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(total,num,p_v,n_v,nu_v, thecolor, thewidth){
total = ((total/16)*10);
total=Math.round(total*Math.pow(10,2))/Math.pow(10,2);
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML="<h4><center>Reputation</center></h4><br> Total score: "+total+"<br> Total votes: "+num+"<br> Positive votes: "+p_v+"<br> Negative votes: "+n_v+"<br> Neutral votes: "+nu_v
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hideddrivetip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>



<style type="text/css">
#star ul.star { LIST-STYLE: none; MARGIN: 0; PADDING: 0; WIDTH: 80px; HEIGHT: 16px; LEFT: 10px; TOP: 1px; POSITION: relative; FLOAT: left; BACKGROUND: url('/horde/imp/themes/graphics/star-i.gif') repeat-x; CURSOR: pointer; }
#star li { PADDING: 0; MARGIN: 0; FLOAT: left; DISPLAY: block; WIDTH: 75px; HEIGHT: 16px; TEXT-DECORATION: none; text-indent: -9000px; Z-INDEX: 20; POSITION: absolute; PADDING: 0; }
#star li.curr { BACKGROUND: url('/horde/imp/themes/graphics/star-i.gif') left 16px; FONT-SIZE: 1px; }
#star div.user { LEFT: 15px; POSITION: relative; FLOAT: left; FONT-SIZE: 13px; FONT-FAMILY: Arial; COLOR: #888; }

#star_neg ul.star { LIST-STYLE: none; MARGIN: 0; PADDING: 0; WIDTH: 80px; HEIGHT: 16px; LEFT: 10px; TOP: 1px; POSITION: relative; FLOAT: left; BACKGROUND: url('/horde/imp/themes/graphics/star_neg.gif') repeat-x; CURSOR: pointer; }
#star_neg li { PADDING: 0; MARGIN: 0; FLOAT: left; DISPLAY: block; WIDTH: 80px; HEIGHT: 16px; TEXT-DECORATION: none; text-indent: -9000px; Z-INDEX: 20; POSITION: absolute; PADDING: 0; }
#star_neg li.curr { BACKGROUND: url('/horde/imp/themes/graphics/star_neg.gif') left 16px; FONT-SIZE: 1px; }
#star_neg div.user { LEFT: 15px; POSITION: relative; FLOAT: left; FONT-SIZE: 13px; FONT-FAMILY: Arial; COLOR: #888; }

#dhtmltooltip{
position: absolute;
border: 5px solid #F4D793;
padding: 2px;
background: none repeat scroll 0 0 #ffc;
visibility: hidden;
z-index: 100;
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=115);
}




#request{
	background:#570D00;
}

.address_list textarea{
	align:"center";
	width:400px;
}

#header{
	width:406px;
	background: #F2A322;
	color:#000000;
}

#wrap{
	padding: 10px;

}

</style>

<div id="menu">
<?php
Horde::addScriptFile('stripe.js', 'horde', true);
require_once 'Horde/Menu.php';
$menu = &new Menu(HORDE_MENU_MASK_ALL & ~HORDE_MENU_MASK_PREFS);
echo $menu->render();
$item = 1;




?>
</div>

<?php


/* Build search mode tabs. */
require_once 'Horde/UI/Tabs.php';
require_once 'Horde/Variables.php';
$sUrl = Horde::applicationUrl('list.php');
$vars = Variables::getDefaultVariables();
$tabs = new Horde_UI_Tabs('rep_mode', $vars);
$tabs->addTab(_("Request Recommendaion"), $sUrl, 'request');
$tabs->addTab(_("My Reputation"), $sUrl, 'my_rep');
echo $tabs->render($_SESSION['reputation']['rep_mode']);

?>
<?php $notification->notify(array('listeners' => 'status')) ?>

<?php if ($_SESSION['reputation']['rep_mode'] == 'my_rep'): ?>
<h1 class="header" ">
<?php

    echo _("My Reputation");

?>
</h1>




<table class="striped" style="border-collapse: collapse; width: 100%;font-weight:bold;" cellpadding="10">




<tr>
<td class="rightAlign">My Score:</td>

 <td width="80%">

<?php
	if($is_positive){
?>
 <div id="star" class="rightAlign" onMouseover="ddrivetip('<?php echo htmlspecialchars($score) ?>','<?php echo htmlspecialchars($count) ?>','<?php echo htmlspecialchars($p_votes) ?>','<?php echo htmlspecialchars($n_votes) ?>','<?php echo htmlspecialchars($nu_votes) ?>','#ffc', 150)"; onMouseout="hideddrivetip()">
       <ul id="star0" class="star" >
             <li id="starCur0" class="curr" style="width: <?php echo htmlspecialchars($score) ?>px;"></li>
       </ul>
    </div>

<?php }else{?>

<div id="star_neg" onMouseover="ddrivetip('<?php echo htmlspecialchars($score) ?>','<?php echo htmlspecialchars($count) ?>','<?php echo htmlspecialchars($p_votes) ?>','<?php echo htmlspecialchars($n_votes) ?>','<?php echo htmlspecialchars($nu_votes) ?>','#ffc', 150)"; onMouseout="hideddrivetip()">
       <ul id="star0" class="star" >
             <li id="starCur0" class="curr" style="width: <?php echo htmlspecialchars($score) ?>px;"></li>
       </ul>
    </div>
<?php
} ?>
 </td>


</tr>

<tr>
   <td class="rightAlign">Total Score:</td>
   <td><?php echo htmlspecialchars(($score/16)*10) ?></td>

</tr>

<tr>
   <td class="rightAlign">Total Vote Count:</td>
   <td><?php echo htmlspecialchars($count) ?></td>

</tr>

<tr>
   <td class="rightAlign">Positive Vote Count:</td>
   <td><?php echo htmlspecialchars($p_votes) ?></td>

</tr>


<tr>
   <td class="rightAlign">Neutral Vote Count:</td>
   <td><?php echo htmlspecialchars($nu_votes) ?></td>

</tr>

<tr>
   <td class="rightAlign">Negative Vote Count:</td>
   <td><?php echo htmlspecialchars($n_votes) ?></td>

</tr>


</table>



<?php else: ?>

<div id="request">
<br><br>
<div id="message" style="color:#ffffff"><?php echo $message; ?></div>


<div id="wrap">
<div id="header">
Enter email addresses here: (comma separated)
</div>
<form method="post"  action="<?php echo Horde::url('list.php', false, -1, true) ?>" name="reputation_request">
<?php echo Util::formInput() ?>
<div class="address_list">
<textarea id="taddresses" name="Taddresses" rows="5" >

</textarea>
<input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($userid) ?>" />
</div>
<br>
<input type="submit" id="bsubmit" name="request_submit" value="Submit" class="button" onclick="return submit_form();"/>
<input type="button" id="bclear" name="clear" value="Clear" class="button"/>
</div>
</form>
</div>




<?php endif; ?>
