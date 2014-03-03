<?php 
$USERS["admin1"] = "password1"; 

function check_logged(){ 
   global $_SESSION, $USERS; 
   if (!array_key_exists($_SESSION["logged"],$USERS)) { 
      header("Location: login.php"); 
   }; 
}; 
?>
