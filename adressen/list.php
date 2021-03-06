<?php
/**
 * Adressen index script.
 
 *
 * @author chathurika priyadarshani wijayawardana
 */
require_once dirname(__FILE__) . '/lib/Application.php';
require_once dirname(__FILE__) . '/lib/add_alias.php';
require_once dirname(__FILE__) . '/lib/delete_alias.php';
require_once dirname(__FILE__) . '/lib/LoadAdressen.php';

/* Verify if the search mode variable is passed in form or is
 * registered in the session. Always use basic search by default. */

if (Util::getFormData('addr_mode')) {
    $_SESSION['adressen']['addr_mode'] = Util::getFormData('addr_mode');
}
if (!isset($_SESSION['adressen']['addr_mode'])) {
    $_SESSION['adressen']['addr_mode'] = 'create';
}

//  submitting the address details
$request_submit = Util::getFormData('request_submit', false);
$request_submit_group = Util::getFormData('request_submit_group', false);
$request_submit_dom = Util::getFormData('request_submit_dom', false);
$create_submit = Util::getFormData('create_submit', false);
$request_edit= Util::getFormData('request_edit', false);
$delete= Util::getFormData('delete', false);

//single address
if($request_submit){
      $userid = Util::getFormData('userid');
      $email =  Util::getFormData('email', false);
      if (Util::getFormData('contact_name', false)=="newcon"){
         $contact = Util::getFormData('newContxt', false); }
      else {
         $contact = Util::getFormData('contact_name', false);
      }
      $mailbox = Util::getFormData('mailbox', false);

if($mailbox=="Select Mailbox") {
   echo "<script type='text/javascript'>window.alert('Select Mailbox');</script>";
}

$address_ob=new Alias();
echo $userid;

$myadd=$address_ob->add_addresses($userid,$email,$contact, $mailbox);
//$myadd=$address_ob->checkforDomain($email);
}

//group address
if($request_submit_group){
      $userid = Util::getFormData('userid');
      $email =  Util::getFormData('email', false);
      $contact = Util::getFormData('contact_name', false);  
      $mailbox = Util::getFormData('mailbox', false);
      $contact_email = Util::getFormData('contact_email', false); //array

if($mailbox=="Select Mailbox") {
   echo "<script type='text/javascript'>window.alert('Select Mailbox');</script>";
}

//$myadd=$address_ob->checkforDomain($email);
Alias::addGroup($userid,$email,$contact,$mailbox,$contact_email);
}

//company/domain address
if($request_submit_dom){
      $userid = Util::getFormData('userid');
      $email =  Util::getFormData('email', false);
      $contact = Util::getFormData('contact_name', false);  
      $mailbox = Util::getFormData('mailbox', false);
      $contact_email = Util::getFormData('contact_email', false); //array

if($mailbox=="Select Mailbox") {
   echo "<script type='text/javascript'>window.alert('Select Mailbox');</script>";
}

//$myadd=$address_ob->checkforDomain($email);
Alias::addDom($userid,$email,$contact,$mailbox,$contact_email);
}


// Extract userid to be shown in the username field.
if (empty($userid)) {
    if ($conf['hooks']['default_username']) {
        $userid = Horde::callHook('_passwd_hook_default_username',
                                  array(Auth::getAuth()),
                                  'passwd');
    } elseif ($conf['hooks']['full_name']) {
        $userid = Auth::getAuth();
    } else {
        $userid = Auth::getBareAuth();
    }
    if (is_a($userid, 'PEAR_Error')) {
        Horde::logMessage($userid, __FILE__, __LINE__);
        $userid = '';
    }
}

//get the required details to fill the address creating form
$addr_ob=new IMP_LoadAdressen();
$u=$addr_ob->findUID($userid);	
$d=$addr_ob->getDomain();
$addr=$addr_ob->get_addresses($u);
$mailbox=$addr_ob->get_mailboxes($u);
$contacts=$addr_ob->get_contacts();
$gaddr=$addr_ob->getGroups($u);
$dom=$addr_ob->getDomains($u);



require ADRESSEN_TEMPLATES . '/common-header.inc';


$notification->notify(array('listeners' => 'status'));

require ADRESSEN_TEMPLATES . '/main/main.inc';
require $registry->get('templates', 'horde') . '/common-footer.inc';

//load the form to create address
if($create_submit){
	$formname = Util::getFormData('address', false);
require "/var/www/html/horde/adressen/templates/app.php"; 	
}

//load the form to edit addresses
if($request_edit){
        $user_id = Util::getFormData('userid');
	$address = Util::getFormData('check', false);	
	if($address){	
	require "/var/www/html/horde/adressen/templates/edit.php"; 
	} 
	else {echo "<script type='text/javascript'>window.alert('Select addresses to edit');</script>";}	
}

//delete addresses
if($delete){
        $userid = Util::getFormData('userid');
	$addresses = Util::getFormData('check', false);
	if($addresses){		
	Delete_Alias::deleteAddress($addresses, $userid);}
	else {echo "<script type='text/javascript'>window.alert('No Addresses are selected to delete');</script>";}
	
}
