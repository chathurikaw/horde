<?php
/**
 * Adressen index script.
 
 *
 * @author Your Name chathurika priyadarshani wijayawardana
 */


require_once dirname(__FILE__) . '/lib/Application.php';

//Horde_Registry::appInit('adressen');

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
$request_edit_single = Util::getFormData('request_edit_single', false);

$delete = Util::getFormData('delete', false);


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

require_once dirname(__FILE__) . '/lib/add_alias.php';
$address_ob=new Alias();
echo $userid;

$myadd=$address_ob->add_addresses($userid,$email,$contact, $mailbox);
//$myadd=$address_ob->checkforDomain($email);
}

if($request_submit_group){
      $userid = Util::getFormData('userid');
      $email =  Util::getFormData('email', false);
      $contact = Util::getFormData('contact_name', false);  
      $mailbox = Util::getFormData('mailbox', false);
      $contact_email = Util::getFormData('contact_email', false); //array

if($mailbox=="Select Mailbox") {
   echo "<script type='text/javascript'>window.alert('Select Mailbox');</script>";
}

require_once dirname(__FILE__) . '/lib/add_alias.php';
//$myadd=$address_ob->checkforDomain($email);
Alias::addGroup($userid,$email,$contact,$mailbox,$contact_email);
}

if($request_submit_dom){
      $userid = Util::getFormData('userid');
      $email =  Util::getFormData('email', false);
      $contact = Util::getFormData('contact_name', false);  
      $mailbox = Util::getFormData('mailbox', false);
      $contact_email = Util::getFormData('contact_email', false); //array

if($mailbox=="Select Mailbox") {
   echo "<script type='text/javascript'>window.alert('Select Mailbox');</script>";
}

require_once dirname(__FILE__) . '/lib/add_alias.php';
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

require_once dirname(__FILE__) . '/lib/LoadAdressen.php';
$addr_ob=new IMP_LoadAdressen();
$u=$addr_ob->findUID($userid);	
$d=$addr_ob->getDomain();
$addr=$addr_ob->get_addresses($u);
$mailbox=$addr_ob->get_mailboxes($u);
$contacts=$addr_ob->get_contacts();
$gaddr=$addr_ob->getGroups($u);
$dom=$addr_ob->getDomains($u);



require ADRESSEN_TEMPLATES . '/common-header.inc';

//echo Horde::menu();

$notification->notify(array('listeners' => 'status'));

require ADRESSEN_TEMPLATES . '/main/main.inc';
require $registry->get('templates', 'horde') . '/common-footer.inc';

if($create_submit){
	$formname = Util::getFormData('address', false);
require "/var/www/html/horde/adressen/templates/app.php"; 	
}

if($request_edit_single){
	$formname = Util::getFormData('request_edit_single', false);
 echo $formname;	
}
