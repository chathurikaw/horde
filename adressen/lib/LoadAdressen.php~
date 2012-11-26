<?php
require_once("db_connect.inc");
require_once("/var/www/html/horde/lib/Horde/Identity.php");
require_once("/var/www/html/horde/imp/lib/Mailbox.php");
require_once("/var/www/html/horde/imp/lib/api.php");
require_once("/var/www/html/horde/imp/lib/Fetchmail.php");

class IMP_LoadAdressen{
       
       function getDomain(){
	
		$id = new identity();
  		$user[$fuser] = $id->_user;	
  		$at=strrpos($user[$fuser], '@');
  		$user[$domain]=substr($user[$fuser],$at+1);
  		return $user;
  		
	}
       
       function getpassword($user, $domid){
    //   echo $user;
     //  echo $domid;
       	$passquery = "SELECT password
                  		FROM mailserver.virtual_users
                 			WHERE user = '$user' and domain_id = '$domid'
               			";
                $passres = mysql_query($passquery);
		$drowp = mysql_fetch_assoc($passres);
       		$mypassword = $drowp[password];
       		return $mypassword;       				
       
       }
       
       
       function get_addresses($user){
              
       	connect_to_db();
       	if (!mysql_select_db('adressen'))
       	{
       		echo "could not select ('adressen db')";
       	}
       		// select addresses to be viewed
       		$query = "SELECT *
                  		FROM dis_addresses
                 			WHERE owner = '$user'
               			";
               			
               	$res = mysql_query($query);
               	

                $count=mysql_num_rows($res);
               
               	$rows = array();
               	$add = array();
               	$i = 0;
               	$j = 0;
               	
               	$u=IMP_LoadAdressen::getDomain();
               		
               	while($row = mysql_fetch_array($res))
                  {
  		    
  		    $rows = $row;
  		    
  		    $add[$i] = array ($i => array($rows[d_add],$rows[contact_name], $rows[email]));
  		    $i = $i +1;
  		}		
			return $add;	
       }
       
	
	function getGroups($user){
		connect_to_db();
       	if (!mysql_select_db('adressen'))
       	{
       		echo "could not select ('adressen db')";
       	}
       		// select addresses to be viewed
       		$query = "SELECT *
                  		FROM groups
                 			WHERE owner = '$user'
               			";
               			
               	$res = mysql_query($query);
               
               
               	$rows = array();
               	$add = array();
               	$i = 0;
               	$k = 0;
               		
               	while($row = mysql_fetch_array($res))
                  {
  		    
  		    $rows = $row;
  		    
  		    $add[$i] = array ($rows[dis_add],$rows[group_name]);
  		    $i = $i +1;
  		    
  		    //echo $add[$i];
  		}		
			return $add;	
	
	}
	
	function getDomains($user){
		connect_to_db();
       	if (!mysql_select_db('adressen'))
       	{
       		echo "could not select ('adressen db')";
       	}
       		// select addresses to be viewed
       		$query = "SELECT *
                  		FROM domain_table
                 			WHERE owner = '$user'
               			";
               			
               	$res = mysql_query($query);
               
               
               	$rows = array();
               	$add = array();
               	$i = 0;
               	$k = 0;
               		
               	while($row = mysql_fetch_array($res))
                  {
  		    
  		    $rows = $row;
  		    
  		    $add[$i] = array ($rows[email],$rows[domain]);
  		    $i = $i +1;
  		    
  		   // echo $add[$i];
  		}		
			return $add;	
	
	}
	
	
	function get_mailboxes($user){
		connect_to_db();
       		if (!mysql_select_db('adressen'))
       		{
       			echo "could not select ('adressen db')";
       		}
       		
       		$add_query = "SELECT d_add
                  		FROM dis_addresses
                 			WHERE owner = '$user' union 
                 	      SELECT dis_add
                  		FROM groups
                 			WHERE owner = '$user' union
                 	      SELECT email
                  		FROM domain_table
                 			WHERE owner = '$user'
               			";
               
               
               			 			
               	$res = mysql_query($add_query);
                
               return $res;	
	}
	
	
	
	function get_contacts(){
	    $id = new identity();
  	    $user = $id->_user;		            
	      connect_to_db();
	    if (!mysql_select_db('horde'))
       		{
       			echo "could not select ('horde db')";
       		}  
	     $con_query = "SELECT object_email
                  		FROM turba_objects
                 			WHERE owner_id = '$user'
               			"; 
             $con= mysql_query($con_query);
             
            
             return $con;
	}




	function findUID($fulluser){
		$at='@';
    		$colan=':';
    		$iat=strrpos($fulluser, $at);
    		$icolan=strrpos($fulluser, $colan);
    		$user=null;
		
		if($iat==false){
			$user=$fulluser;

		}else{			
	    		if($icolan==false){
				
				$user=substr($fulluser, 0, $iat);
				
		
			}else{
				$user=substr($fulluser, 4, $iat-4);
	    		}
		
		
		}
		return $user;
	}



function get_email($user){
          // echo $user;   
       	connect_to_db();
       	if (!mysql_select_db('adressen'))
       	{
       		echo "could not select ('adressen db')";
       	}
       		// select addresses to be viewed
       		$emquery = "SELECT d_add
                  		FROM adressen.dis_addresses
                 			WHERE owner = '$user'
               			";
               			
               	$res = mysql_query($emquery);
             //  	echo "fssssgsf";
               	$rows = array();
               	$add = array();
               	$i = 0;
               	$k = 0;
               	
               	
               		while($row = mysql_fetch_array($res))
                  {
  		    
  		    $rows = $row;
  		    
  		    $add[$i] = $rows[d_add];
  		    $i = $i +1;
  		    
  		  //  echo $add[$i];
  		}		
                 	
			return $add;	
       }
}
?>
