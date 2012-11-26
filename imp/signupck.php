<?


require_once("/var/www/html/horde/adressen/lib/db_connect.inc");
require_once("/var/www/html/horde/adressen/lib/add_alias.php");

//////////////////////////////
$domainname=$_POST['domainname'];
$username=$_POST['username'];
$password=$_POST['password'];
$password2=$_POST['password2'];

$status = "OK";
$msg="";


connect_to_db();
       	if (!mysql_select_db('mailserver'))
       	{
       		echo "could not select ('mailserver db')";
       	}


// if userid is less than 3 char then status is not ok
if(!isset($domainname) or strlen($username)==0){
$msg=$msg."Please enter the domain name<BR>";

$status= "NOTOK";}

else if(mysql_num_rows(mysql_query("SELECT name FROM virtual_domains WHERE name = '$domainname'"))){
$msg=$msg."Domain name already exists. Please try another one<BR>";
echo "<script type='text/javascript'>no_domain();</script>";
$status= "NOTOK";}

else if(!isset($username) or strlen($username) <3){
$msg=$msg."Username should be =3 or more than 3 char length<BR>";
$status= "NOTOK";}					

else if ( strlen($password) < 3 ){
$msg=$msg."Password must be more than 3 char legth<BR>";
$status= "NOTOK";}					

else if ( $password <> $password2 ){
$msg=$msg."Both passwords are not matching<BR>";
$status= "NOTOK";}					




if($status<>"OK"){
echo "<font face='Verdana' size='3' color=red>$msg</font><br><input type='submit' class='button' value='Retry' onClick='history.go(-1)'>";
}else{
connect_to_db();
       	if (!mysql_select_db('mailserver'))
       	{
       		echo "could not select ('mailserver db')";
       	}
       	
$user = $username.'@'.$domainname;       	
$insDom = mysql_query("insert into mailserver.virtual_domains(id,name) values(DEFAULT,'$domainname')");
$mydomain = Alias::fetchDomainID($domainname);
$insuser = mysql_query("insert into virtual_users(id,domain_id,user,password) values(DEFAULT,$mydomain,'$username',MD5('$password'))");
$insalias = mysql_query("insert into virtual_aliases(id,domain_id,source,destination) values(DEFAULT,$mydomain,'$username','$user')");

if(($insDom && $insuser) && $insalias){
echo "<font face='Verdana' size='3' color=green>Welcome, You have successfully signed up</font><br><input type='button' value='Sign in' onClick='history.go(-1)'>";}
else{ echo "Database Problem, please contact Site admin</font><br><input type='button' value='Retry' onClick='history.go(-1)'>";


//echo mysql_error();

}
}
?>

