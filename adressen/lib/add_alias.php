<?php
require_once("db_connect.inc");
require_once dirname(__FILE__) . '/LoadAdressen.php';
require_once dirname(__FILE__) . '/create_mailboxes.php';
require ('/var/www/html/horde/imp/lib/Folder.php');
require ('/var/www/html/horde/imp/lib/IMP.php');
require ('/var/www/html/horde/lib/api.php');

class Alias{
	
	
	function add_addresses($user_id,$email_address,$contact_name, $mailbox){
	 	
		 Alias::updateServer($user_id,$email_address,$mailbox);  
		
		  $addr_obj=new IMP_LoadAdressen();	
               $userd=$addr_obj->getDomain();
              
         $emailwdom = $email_address.'@'.$userd[$domain];
        
                
		//update the adressen database
		$inserta_query = "INSERT INTO adressen.dis_addresses 
		(object_id,owner,d_add,contact_name,email)
                 			VALUES (DEFAULT,'$user_id','$emailwdom','  ','$contact_name')";
               			
		  mysql_query($inserta_query); 
		 
		if($mailbox == "new"){
		 IMP_Folder::create(imap_utf7_encode("INBOX.".$email_address), 0);
		  $mailbox = $emailwdom;        	  
		   }
		  
		   
		 Alias::add_filter($user_id,$emailwdom,$contact_name, $mailbox); 
		Alias::add_from_address($email_address, $mailbox);
		
	}
	
	
	function addGroup($userid,$email,$group_name,$mailbox,$contact_email){
	
         Alias::updateServer($userid,$email,$mailbox);
	 $size = sizeof($contact_email);
         $addr_obj=new IMP_LoadAdressen();	
               $userd=$addr_obj->getDomain();
             // echo $userid;
         $emailwdom = $email.'@'.$userd[$domain];
	 $insertng_query = "INSERT INTO adressen.groups 
		(group_id,group_name,owner,dis_add)
                 			VALUES (DEFAULT,'$group_name','$userid','$emailwdom')";
               			
		mysql_query($insertng_query); 
		
		$groupid = Alias::fetchGroupID($userid,$group_name);
		
		
		if($mailbox == "new"){
		  IMP_Folder::create(imap_utf7_encode("INBOX.".$email), 0);
		  $mailbox = $emailwdom;        	  
		   }
		   
		
	  for($j=0; $j<$size; $j++){
		  
		$insertg_query = "INSERT INTO adressen.group_dis_addresses 
		(group_id, members)
                 			VALUES ('$groupid','$contact_email[$j]')";
               			
		mysql_query($insertg_query);
		}
		
		
		   echo $mailbox;
		   
		  Alias::add_group_filter($userid,$emailwdom,$contact_email, $mailbox);
		  Alias::add_from_address($email, $mailbox);
	
	}
	
	
	function addDom($userid,$email,$contact,$mailbox,$contact_email){
	
	     Alias::updateServer($userid,$email,$mailbox);
	    
	     $addr_obj=new IMP_LoadAdressen();	
             $userd=$addr_obj->getDomain();
              
         $emailwdom = $email.'@'.$userd[$domain];
	    
	    $insertw_query = "INSERT INTO adressen.domain_table 
		(record_id,owner,domain,email)
                 			VALUES (DEFAULT,'$userid','$contact_email','$emailwdom')";
               			
		mysql_query($insertw_query); 
		
		
		if($mailbox == "new"){
		  IMP_Folder::create(imap_utf7_encode("INBOX.".$email), 0);
		  $mailbox = $emailwdom;        	  
		   }
		   
		   
		    Alias::add_from_address($email, $mailbox);
		
	}
	
	function updateServer($userid,$email,$mailbox){
	connect_to_db(); 	 
		if (!mysql_select_db('adressen'))
       	{
       		echo "could not select ('adressen db')";
       	}

               $addr_obj=new IMP_LoadAdressen();	
               $userd=$addr_obj->getDomain();
              
         $emailwdom = $email.'@'.$userd[$domain];
         $maild = $userd[$domain].'/'.$email.'/';
        if($mailbox = "new"){
         $mailbox = $emailwdom;
        }
        
  	//select domain ID
  		$mydomain = Alias::fetchDomainID($userd[$domain]);
  		
  		$mypassword = IMP_LoadAdressen::getpassword($userid, $mydomain);
  		
  		//echo $mypassword;
  		//update the domain table if the domain not exist
  		/*if(!(mysql_num_rows($dres))){	
  		$insertd_query = "INSERT INTO mailserver.virtual_domains (id, name)
                 			VALUES ( 3,'$domain')"; 
                 			
                 	mysql_query($insertd_query);
                  } 
  		
                 	$dres = mysql_query($dquery);
                 	
                 	*/
                 
         	//update the alias
         	
         	$id = new identity();
  		$fulluser = $id->_user; 
  		
         	$insert_query = "INSERT INTO mailserver.virtual_aliases (id, domain_id, source, destination)
                 			VALUES ( DEFAULT, $mydomain, '$email', '$mailbox')";
                 			
                $insertdu_query = "INSERT INTO mailserver.virtual_aliases (id, domain_id, source, destination)
                 			VALUES ( DEFAULT, $mydomain, '$email', '$fulluser')";
               			
		mysql_query($insert_query);
		mysql_query($insertdu_query);
		  
		  $insertm_query = "INSERT INTO mailserver.mailbox (username, maildir)
                 			VALUES ( '$emailwdom','$maild' )";
               			
		mysql_query($insertm_query);
		  
		  $insertu_query = "INSERT INTO mailserver.virtual_users (id, domain_id, user, password)
                 			VALUES ( DEFAULT, $mydomain, '$email', '$mypassword')";
               			
		mysql_query($insertu_query);
	
	}
	
	
	function add_filter($user_id,$emailwdom,$contact_name, $mailbox){
		$to_length = strlen($emailwdom);
		$from_length = strlen($contact_name);
		
		$filter_string = 'a:2:{i:0;a:4:{s:5:"field";s:2:"To";s:4:"type";i:1;s:5:"match";s:8:"contains";s:5:"value";s:'.$to_length.':"'.$emailwdom.'";}i:1;a:4:{s:5:"field";s:4:"From";s:4:"type";i:1;s:5:"match";s:8:"contains";s:5:"value";s:'.$from_length.':"'.$contact_name.'";}}';
		
		$filter_string_spam = 'a:2:{i:0;a:4:{s:5:"field";s:2:"To";s:4:"type";i:1;s:5:"match";s:8:"contains";s:5:"value";s:'.$to_length.':"'.$emailwdom.'";}i:1;a:4:{s:5:"field";s:4:"From";s:4:"type";i:1;s:5:"match";s:11:"not contain";s:5:"value";s:'.$from_length.':"'.$contact_name.'";}}';
		
	       $addr_obj=new IMP_LoadAdressen();	
               $userd=$addr_obj->getDomain();              
               $owner = $user_id.'@'.$userd[$domain];
               
               $at=strrpos($emailwdom, '@');
  	       $rule=substr($emailwdom,0,$at);
  	       
  	       $mat=strrpos($mailbox, '@');
  	       $value="INBOX.".substr($mailbox,0,$mat);
  	       
  	       $squery = "SELECT MAX(rule_order) as 'order'
                  		FROM horde.ingo_rules
                  			WHERE rule_owner = '$owner' 
               			";
               			
               	$sres = mysql_query($squery);
		$srow = mysql_fetch_assoc($sres);
       		$ruleorder = $srow['order'] + 1;
       		
       	
       		$insert_q = "INSERT INTO horde.ingo_rules(rule_id, rule_owner, rule_name, rule_action, rule_value, rule_flags, rule_conditions, rule_combine, rule_stop, rule_active, rule_order) VALUES (DEFAULT,'$owner','$rule',2,'$value',0,'$filter_string',1,1,1,'$ruleorder')";
       		mysql_query($insert_q);
       		
       		$insert_q_spam = "INSERT INTO horde.ingo_rules(rule_id, rule_owner, rule_name, rule_action, rule_value, rule_flags, rule_conditions, rule_combine, rule_stop, rule_active, rule_order) VALUES (DEFAULT,'$owner','$rule".spam."',2,'INBOX.spam',0,'$filter_string_spam',1,1,1,'".($ruleorder+1)."')";
       		mysql_query($insert_q_spam);
       		
	}
	
	
	
		function add_group_filter($userid,$emailwdom,$contact_email, $mailbox){
		$to_length = strlen($emailwdom);
		$size = sizeof($contact_email);
		
		$filter_string = 'a:2:{i:0;a:4:{s:5:"field";s:2:"To";s:4:"type";i:1;s:5:"match";s:8:"contains";s:5:"value";s:'.$to_length.':"'.$emailwdom.'";}';
		
		for($j=0; $j<$size; $j++){
		
		$from_length = strlen($contact_email[$j]);
		
		$filter_string .= 'i:'.($j+1).';a:4:{s:5:"field";s:4:"From";s:4:"type";i:1;s:5:"match";s:8:"contains";s:5:"value";s:'.$from_length.':"'.$contact_email[$j].'";}}';
		
		
		}
	       $addr_obj=new IMP_LoadAdressen();	
               $userd=$addr_obj->getDomain();              
               $owner = $user_id.'@'.$userd[$domain];
               
               $at=strrpos($emailwdom, '@');
  	       $rule=substr($emailwdom,0,$at);
  	       
  	       $mat=strrpos($mailbox, '@');
  	       $value="INBOX.".substr($mailbox,0,$mat);
  	       
  	       $squery = "SELECT MAX(rule_order) as 'order'
                  		FROM horde.ingo_rules
                  			WHERE rule_owner = '$owner' 
               			";
               			
               	$sres = mysql_query($squery);
		$srow = mysql_fetch_assoc($sres);
       		$ruleorder = $srow['order'] + 1;
       		
       	
       		$insert_q = "INSERT INTO horde.ingo_rules(rule_id, rule_owner, rule_name, rule_action, rule_value, rule_flags, rule_conditions, rule_combine, rule_stop, rule_active, rule_order) VALUES (DEFAULT,'$owner','$rule',2,'$value',0,'$filter_string',1,1,1,'$ruleorder')";
       		//mysql_query($insert_q);
       		
       		echo $filter_string;
	}
	
	
	
	function add_from_address($email_address, $mailbox){
		
	        $addr_obj=new IMP_LoadAdressen();	
                $userd=$addr_obj->getDomain();
              
                $emailwdom = $email_address.'@'.$userd[$domain];
		
		$pref_val = _horde_getPreference($app, 'identities');
		echo $pref_val;
		$add_num = substr($pref_val,2,1);
		$num = intval($add_num);
		$data = explode("{",$pref_val,2);
		$arr1 = "a:".($num+1).":{";
		$arr2 = substr($data[1],0,(strlen($data[1])-1));
		$arr3 = 'i:'.$num.';a:13:{s:16:"default_identity";s:1:"0";s:2:"id";s:'.strlen($email_address).':"'.$email_address.'";s:8:"fullname";s:'.strlen($emailwdom).':"'.$emailwdom.'";s:9:"from_addr";s:'.strlen($emailwdom).':"'.$emailwdom.'";s:12:"replyto_addr";s:'.strlen($emailwdom).':"'.$emailwdom.'";s:10:"alias_addr";a:1:{i:0;s:'.strlen($mailbox).':"'.$mailbox.'";}s:10:"tieto_addr";a:0:{}s:8:"bcc_addr";a:0:{}s:9:"signature";s:0:"";s:10:"sig_dashes";i:0;s:9:"sig_first";i:0;s:14:"save_sent_mail";i:1;s:16:"sent_mail_folder";s:5:"john1";}}';
		$arr = $arr1.$arr2.$arr3;
		_horde_setPreference($app, 'identities', $arr);
		
	}
	
	
	function fetchDomainID($dom){
	$dquery = "SELECT id
                  		FROM mailserver.virtual_domains
                  			WHERE name = '$dom' 
               			";
               			
               	$dres = mysql_query($dquery);
		$drow = mysql_fetch_assoc($dres);
       		$mydomain = $drow['id'];
       		
       		return $mydomain;
	} 
	
	
	function fetchGroupID($userid,$grp){
	
	$gquery = "SELECT group_id
                  		FROM adressen.groups
                  			WHERE group_name = '$grp' and owner='$userid' 
               			";
               			
               	$res = mysql_query($gquery);
		$row = mysql_fetch_assoc($res);
       		$group = $row['group_id'];
       		
       		return $group;
	} 
	
	function checkforDomain($email_address){
	     
	     $ndom = strrchr($email_address,"@");
	     
	     }
	     
	     
	function exists($folder)
    {
        require_once '/var/www/html/horde/imp/lib/IMAP/Tree.php';
        require_once '/var/www/html/horde/imp/lib/IMAP.php';
        $imaptree = &IMP_Tree::singleton();
        $elt = $imaptree->get($folder);
        if ($elt && !$imaptree->isContainer($elt)) {
            return true;
        }

        $imp_imap = &IMP_IMAP::singleton();
        $ret = @imap_getmailboxes($imp_imap->stream(), IMP::serverString(), $folder);
        return !empty($ret);
    }     
	}
	
?>
