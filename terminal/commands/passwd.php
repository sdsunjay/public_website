
<?php

require_once '../../../config/db_config.php';
require_once '../../projects/accounts/functions.php';
sec_session_start(); // Our custom secure way of starting a PHP session.
if(isset($_POST['submit'],$_POST['username'],$_POST['password'],$_POST['password1'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];
   $password1 = $_POST['password1'];
   if(registerUserFromCli($username,$password,$password1))
   {
      //check to see if username and password meet requirements
      echo 'Yes';
   }
   else
   {
      echo $_SESSION['Error']; 
      //echo 'No';
      //echo $feedback;
   }
}
else if(isset($_POST['submit'],$_POST['old_password'],$_POST['username'],$_POST['password'],$_POST['password1'])) {
   $username = $_POST['username'];
   $old_password = $_POST['old_password'];
   $password = $_POST['password'];
   $password1 = $_POST['password1'];
   //this isn't going to work, updatePassword needs to be rewritten
   //TODO: SUNJAY rewrite updatepassword
   if(updatePassword($username,$old_password,$password,$password1))
   {
      //check to see if username and password meet requirements
      echo 'Yes';
   }
   else
   {
      echo $_SESSION['Error']; 
      //echo 'No';
      //echo $feedback;
   }
}
   else
{
   echo "Missing required fields";
}
?>
