<script type="text/javascript">


function submit_form()
{
   return true;
}

function setFocus()
{
    
}
 
 
$('#request_edit').click(function(){

      $('#single').filter(':has(:checkbox:checked)').each(
          var add = $address;
          document.write("add");
      );
    });


//-->
</script>



<div id="dhtmltooltip"></div>

<style type="text/css">
require ADRESSEN_TEMPLATES . 'app.php';

#dhtmltooltip{
position: absolute;
border: 5px solid #ffffff;
padding: 10px;
background: none repeat scroll 0 0 #ffc;
visibility: hidden;
z-index: 100;
filter: progid:DXImageTransform.Microsoft.Shadow(color=white,direction=115);
}

th{background-color:LightBlue; font-color:black; font-size:12pt;}
td{background-color:white;}
p{color:black;}
input{backgroung-color:white;}

#wrap{
	padding: 30px;

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
$j = 0;
$sUrl = Horde::applicationUrl('list.php');
$vars = Variables::getDefaultVariables();
$tabs = new Horde_UI_Tabs('addr_mode', $vars);
$tabs->addTab(_("Create New Address"), $sUrl, 'create');
$tabs->addTab(_("View Adresses"), $sUrl, 'my_addr');
echo $tabs->render($_SESSION['adressen']['addr_mode']);

?>

<?php $notification->notify(array('listeners' => 'status')) ?>

<?php if ($_SESSION['adressen']['addr_mode'] == 'create'): ?>

<div id="wrap">
<br><br>
   <form name="create_add" method="post"  action="<?php echo Horde::applicationUrl('list.php', false, -1, true) ?>">
   <?php echo Util::formInput() ?>

<input type="radio" name="address" value="single" /> Single Person
        <br />
<input type="radio" name="address" value="group" /> Group of people
        <br />
<input type="radio" name="address" value="website" /> Website
        <br />
<input type="radio" name="address" value="company" /> Company
        <br /><br />

<input type="Submit" id="acreate" name="create_submit" value="Create" class="button" />
</form>
</div>

<?php else: ?>
<form name="view_add" method="post"  action="<?php echo Horde::applicationUrl('list.php', false, -1, true) ?>">
 <?php echo Util::formInput() ?>
<div id="address">
<br><br>
<div id="wrap">
<div class="address_list">
<?php
		echo "<table name='single' border='1' >
			<tr>
			<th> </th>
			<th> </th>
			<th>Address     </th>
			<th>Contact     </th>
			</tr>";
               		        
                  foreach($addr as $add2){
  		 	$address = $add2[$j][0];
  		 	$contact = $add2[$j][2];
  		 	
  		echo "<tr>";
  		echo "<td>" . ($j+1). "</td>";
  		echo "<td class='cb'><input type='checkbox' value='$j' name='selected[$j]'></td>";
  		echo "<td>" . $address. "</td>";
  		echo "<td>" . $contact . "</td>"; 
  		$j = $j + 1;
  		}
  		
  		echo "<tr>
			<th> </th>
			<th> </th>
			<th>Address      </th>
			<th>Group        </th>
			</tr>";
  		
  		
  		foreach($gaddr as $add2){
  		 	$address = $add2[0];
  		 	$group = $add2[1];
  		 	
  		echo "<tr>";
  		echo "<td>" . ($j+1). "</td>";
  		echo "<td class='cb'><input type='checkbox' value='yes'></td>";
  		echo "<td>" . $address. "</td>";
  		echo "<td>" . $group . "</td>";	
  		
  		
  		$k = $k + 1;
  		$j = $j + 1;
  		}
  		
  		echo "<tr>
			<th> </th>
			<th> </th>
			<th>Address      </th>
			<th>Domain        </th>
			</tr>";
  		
  		
  		foreach($dom as $add2){
  		 	$address = $add2[0];
  		 	$domain = $add2[1];
  		 	
  		echo "<tr>";
  		echo "<td>" . ($j+1). "</td>";
  		echo "<td class='cb'><input type='checkbox' value='yes'></td>";
  		echo "<td>" . $address. "</td>";
  		echo "<td>" . $domain . "</td>";
  		

  		
  		$k = $k + 1;
  		$j = $j + 1;
  		}
  		
			echo "</table>";	
echo "<input type='Submit' id='bedit' name='request_edit' value='Edit' class='button' onclick='edit.php'/>";
echo "<input type='button' id='bdelete' name='delete' value='Delete' class='button'/>";
  		

?>



</div>
<br>

</div>

</div>

</form>

<?php endif; ?>

