<?php 
/**
 * Address editing form loading script.
 
 *
 * @author chathurika priyadarshani wijayawardana
 */
?>

<script>
function addContact(){
    selectedContact = document.getElementById('contact_name').value;
    if (selectedContact == 'newcon'){
        document.getElementById('newContxt').style.display = 'block';
    }
}

</script>

<?php
 foreach($address as $add){
 require_once("/var/www/html/horde/adressen/list.php");
     $contacts=IMP_LoadAdressen::get_contacts();
     
     $adrs = explode("-", $add);
     $adress = $adrs[1];  //full email address    
     if($adress != null){
     $con = IMP_LoadAdressen::get_contact_details($adress, $user);
     echo $con;
     ?>
     <form name="edit" method="post"  action="<?php echo Horde::applicationUrl('list.php', false, -1, true) ?>">
   <?php echo Util::formInput() ?>
   
   <?php  if($adrs[0]=='contact'){ ?>
     <input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($user) ?>" />
     <p>Address: <input type="text" name="email" color="white" value="<?php echo $adress;?>" readonly="readonly" />
     Contact: 
<select name="contact_name" id ="contact_name" class="dropdownmenus" value="Select me" onchange= "addContact()" > 
	<option selected> <?php echo $con?> </option>
	<?
	 
	    while ($row = mysql_fetch_array($contacts)) {
	    extract($row);
	 
	    echo "<option value='".$row['object_email']."'>".$row['object_email']."</option>";
	 
	    }
	?>
	<option value="newcon" id="newcon"> Add New Contact </option>
	</select>
	<input type="text" name="newContxt" id="newContxt" style="display: none" />
Mailbox:  
<select name="mailbox" class="dropdownmenus" value="Select me" onchange='this.form.elements['showuserid'].value=this.options[this.selectedIndex].value'>
	<option selected> Select Mailbox </option>
	<?
	 
	    while ($row = mysql_fetch_array($mailbox)) {
	    extract($row);
	 
	    echo "<option value='".$row['d_add']."'>".$row['d_add']."</option>";
	 
	    }
	?>
	<option name=create_mailbox value='new'> Create new Mailbox </option>
	</select>
<br>
     </p>
     
     
     <?php }
     else if($adrs[0]=='group'){ ?>
     
     
     <input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($userid) ?>" />
<p>Address: <input type="text" name="email" color="white" value="<?php echo $adress;?>" readonly="readonly"/>
Group name: 
<input type="text" name="contact_name"" color="white"/>
Mailbox:
<select name="mailbox" class="dropdownmenus" value="Select me" onchange='this.form.elements['showuserid'].value=this.options[this.selectedIndex].value'>
	<option selected> Select Mailbox </option>
	<?
	 
	    while ($row = mysql_fetch_array($mailbox)) {
	    extract($row);
	 
	    echo "<option value='".$row['d_add']."'>".$row['d_add']."</option>";
	 
	    }
	?>
	<option name=create_mailbox value='new'> Create new Mailbox </option>
	</select>
	
<br><br>
Group members: <br>
<? 
	    while ($row = mysql_fetch_array($contacts)) {
	    extract($row);
	 
	    echo "<input name='contact_email[]' type='checkbox' value='".$row['object_email']."'>".$row['object_email']."</>";
	 echo "<br>";
	    
	    }
	      	    
	?>
<br>

     </p>
         <?php
     } 
     
     else if($adrs[0]=='domain'){
           ?>
     <input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($userid) ?>" />
<p>Address: <input type="text" name="email" id="email" color="white" value="<?php echo $adress;?>" readonly="readonly"/>
WebSite/Company:  
<input type="text" id="contact_name" name="contact_name" color="white"/>

Website/Company domain: <input type="text" name="contact_email" color="white"/>
Mailbox: 
<select name="mailbox" class="dropdownmenus" value="Select me" onchange='this.form.elements['showuserid'].value=this.options[this.selectedIndex].value'>
	<option selected> Select Mailbox </option>
	<?
	 
	    while ($row = mysql_fetch_array($mailbox)) {
	    extract($row);
	 
	    echo "<option value='".$row['d_add']."'>".$row['d_add']."</option>";
	 
	    }
	?>
	<option name=create_mailbox value='new'> Create new Mailbox </option>
	</select></p>
         <?php
     }  
    
 }
 }
 
  ?>
     
<input type="submit" id="bsave" name="save_address" value="Save" class="button" /> </tab>
<br><br>
</form>
    
