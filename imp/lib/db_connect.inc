<?php

include_once("dbproperties.conf");

function connect_to_db() {
  global $USERS_DBHOST, $USERS_DBUSER, $USERS_DBPASS;
  if (!mysql_connect($USERS_DBHOST, $USERS_DBUSER, $USERS_DBPASS)) {
    // couldn't connect
    echo "could not connect ($USERS_DBHOST, $USERS_DBUSER, $USERS_DBPASS)"; 	
  }
 // if (!mysql_select_db($ADRESSEN_DB)) {
    // couldn't connect
    //echo "could not select ($HORDE_DB)"; 	
  }
//}


?>
