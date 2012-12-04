<?php
/**
 * Address creating form loading script.
 
 *
 * @author chathurika priyadarshani wijayawardana
 */
?>
<script>
//function to display atext field to add new contact
//when creating email address(if the contact is not exist)
function addContact(){
    selectedContact = document.getElementById('contact_name').value;
    if (selectedContact == 'newcon'){
        document.getElementById('newContxt').style.display = 'block';
    }
}

//random generating addresss(user can define the letters to use)
function createAddress()
{
web = document.getElementById('contact_name').value;
var name = prompt("Insert some letters to create address", web);
  if (name==null || name==" ")
    {alert("Insert text");} 
  else {randomString(name); }
}

//generate random string
function randomString(chars) {
	var string_length = chars.length;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	document.create.email.value = randomstring;
}

//generate random addresses
function randomAddress() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 8;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	document.create.email.value = randomstring;
}

</script>

<?php
require_once("/var/www/html/horde/adressen/list.php");
?>
<?php if ($formname == 'single'):?>
<?php //load the form for single person address generating?>

<div id="wrap">
<br><br>
   <form name="create" method="post"  action="<?php echo Horde::applicationUrl('list.php', false, -1, true) ?>">
   <?php echo Util::formInput() ?>
<input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($userid) ?>" />

<p>email prefix: (Without @DomainName) Your Domain = <?php echo $d[$domain] ?></p><input type="text" name="email" color="white"/>
<input type="button" id="namesubmit" name="name_submit" value="Suggest address" class="button" onclick="randomAddress()"/> </tab>
<br><br>
<p>Contact: </p>
<select name="contact_name" id ="contact_name" class="dropdownmenus" value="Select me" onchange= "addContact()" > >
	<option selected> Select Contact </option>
	<?
	 
	    while ($row = mysql_fetch_array($contacts)) {
	    extract($row);
	 
	    echo "<option value='".$row['object_email']."'>".$row['object_email']."</option>";
	 
	    }
	?>
	<option value="newcon" id="newcon"> Add New Contact </option>
	</select>
	<input type="text" name="newContxt" id="newContxt" style="display: none" />

<br><br>
<p>Mailbox: </p> 
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

<input type="submit" id="bsubmit" name="request_submit" value="Submit" class="button" /> </tab>
<input type="reset" id="bclear" name="clear" value="Clear" class="button" />
</form>
</div>

<?php elseif ($formname == 'group'):?>
<?php //load the form for group address generating?>
<div id="wrap">
<br><br>
   <form name="create" method="post"  action="<?php echo Horde::applicationUrl('list.php', false, -1, true) ?>">
   <?php echo Util::formInput() ?>
<input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($userid) ?>" />
<p>email prefix: (Without @DomainName) Your Domain = <?php echo $d[$domain] ?></p><input type="text" name="email" color="white"/>
<input type="button" id="namesubmit" name="name_submit" value="Suggest address" class="button" onclick="randomAddress()"/> </tab>
<br><br>
<p>Group name: </p> 
<input type="text" name="contact_name"" color="white"/>
<br><br>
<p>Group members: </p>
<?
	 
	    while ($row = mysql_fetch_array($contacts)) {
	    extract($row);
	 
	    echo "<input name='contact_email[]' type='checkbox' value='".$row['object_email']."'>".$row['object_email']."</>";
	 echo "<br>";
	    
	    }
	      
	      
	    
	?>

<br><br>
<p>Mailbox: </p> 
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

<input type="submit" id="bsubmit" name="request_submit_group" value="Submit" class="button" /> </tab>
<input type="reset" id="bclear" name="clear" value="Clear" class="button" />
</form>
</div>

<?php elseif ($formname == 'website'):?>
<?php //load the form for address generating for websites?>

<div id="wrap">
<br><br>
   <form name="create" method="post"  action="<?php echo Horde::applicationUrl('list.php', false, -1, true) ?>">
   <?php echo Util::formInput() ?>
   <input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($userid) ?>" />
<p>Web Site: </p> 
<input type="text" id="contact_name" name="contact_name" color="white"/>
<br><br>
<p>email prefix: (Without @DomainName) Your Domain = <?php echo $d[$domain] ?></p><input type="text" name="email" id="email" color="white"/>
<input type="button" id="namesubmit" name="name_submit" value="Suggest address" class="button" onclick="createAddress()"/> </tab>

<br><br>
<p>Website domain: </p><input type="text" name="contact_email" color="white"/>
<br><br>
<p>Mailbox: </p> 
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

<input type="submit" id="bsubmit" name="request_submit_dom" value="Submit" class="button" /> </tab>
<input type="reset" id="bclear" name="clear" value="Clear" class="button" />
</form>
</div>


<?php elseif ($formname == 'company'):?>
<?php //load the form for address generating for company domains?>

<div id="wrap">
<br><br>
   <form name="create" method="post"  action="<?php echo Horde::applicationUrl('list.php', false, -1, true) ?>">
   <?php echo Util::formInput() ?>
<input type="hidden" id="userid" name="userid" value="<?php echo htmlspecialchars($userid) ?>" />
<p>Company: </p> 
<input type="text" name="contact_name" color="white" id="contact_name"/>
<br><br>
<p>email prefix: (Without @DomainName) Your Domain = <?php echo $d[$domain] ?></p><input type="text" name="email" color="white"/>
<input type="button" id="namesubmit" name="name_submit" value="Suggest address" class="button" onclick="createAddress()"/> </tab>
<br><br>
<p>Company Domain: </p><input type="text" name="contact_email" color="white"/>
<br><br>
<p>Mailbox: </p> 
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

<input type="submit" id="bsubmit" name="request_submit_dom" value="Submit" class="button" /> </tab>
<input type="reset" id="bclear" name="clear" value="Clear" class="button" />
</form>
</div>

<?php endif; ?>



