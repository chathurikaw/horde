<?php 
/**
 * Address deleting script.
 
 *
 * @author chathurika priyadarshani wijayawardana
 */
require_once("db_connect.inc");
require_once dirname(__FILE__) . '/LoadAdressen.php';
require_once dirname(__FILE__) . '/add_alias.php';

class Delete_Alias {

//delete the alias
function deleteAddress($addresses, $user_id){
    		connect_to_db();
    foreach($addresses as $a){
    
    	$dadd = explode("-", $a);
    	$adrs = $dadd[1];  //full email address
    	$add = explode("@", $adrs );
        $user = $add[0]; //prefix of email address
        $dom =  Alias::fetchDomainID($add[1]);  //domain ID
    	
    	$clear_server = Delete_Alias::clearServer($user, $dom, $adrs);
    	
    	if($dadd[0]=='contact'){  
          
          $delete_dadd = "DELETE FROM adressen.dis_addresses WHERE owner = '$user_id' and d_add = '$adrs' ";
          $con = mysql_query($delete_dadd);
          
    	}
    	
    	else if($dadd[0]=='group'){
    	
    	  $group_id =  Alias::fetchGroupID($user_id,$adrs);
          $delete_group_mem = "DELETE FROM adressen.group_dis_addresses WHERE group_id =  '$group_id' ";
          $group_members = mysql_query($delete_group_mem);
          
          $delete_group = "DELETE FROM adressen.groups WHERE owner =  '$user_id' AND dis_add = '$adrs'";
          $group = mysql_query($delete_group);
          }
    		
    		
    	else if($dadd[0]=='domain'){
    	
    	  $delete_domain = "DELETE FROM adressen.domain_table WHERE owner =  '$user_id' AND email = '$adrs'";
          $domain = mysql_query($delete_domain);
    	}
    }
    
    if(($clear_server)&&($con||($group_members&&$group)||$domain)){echo "<script type='text/javascript'>window.alert('Selected addresses are successfully deleted...');</script>";}
    
    
}

//delete server records
function clearServer($user, $domain, $address){
	 
          $delete_user = "DELETE FROM mailserver.virtual_users WHERE user = '$user' and domain_id = '$domain' ";
          $vuser = mysql_query($delete_user);
          
          $delete_alias = "DELETE FROM mailserver.virtual_aliases WHERE source = '$user' and domain_id = '$domain' ";
          $valias = mysql_query($delete_alias);
          
          $delete_mailbox = "DELETE FROM mailserver.mailbox WHERE username =  '$address' ";
          $mail = mysql_query($delete_mailbox);
          
          if($vuser && $valias && $mail){
          return true;
          }
          else {return false;}
          
}



}
?>
