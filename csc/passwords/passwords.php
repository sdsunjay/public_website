<?php
$USERS["ACCESS DENIED"] = "@ccess_Grant3D";
$temp["Alexander"] = "Spotnitz";
function check_logged(){
   global $_SESSION, $USERS, $temp;
/*   if ((!array_key_exists($_SESSION["logged"],$USERS))|| 
	 (!array_key_exists($_SESSION["logged"],$temp)) ) {
      header("Location: login.php");
         };*/
   return true;
};
?>
<html>
<body>
</body>
</html>
