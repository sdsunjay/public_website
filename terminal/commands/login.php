<?php
require_once '../../../security/htmlpurifier/HTMLPurifier.standalone.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    require_once '../../../projects/accounts/functions.php';
require_once '../../../config/db_config.php';
if(isset($_POST['submit'],$_POST['username'], $_POST['password'])) {
   $name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
   $name = $purifier->purify($name);
   
   if(is_null($name))
   {
      echo "Username is null.";
   }
   else
   {
      $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
      //this needs to be fixed..use the class..I will merge with it..eventually.
      $name = preg_replace("/[^a-zA-Z0-9_\-]+/","",$name);
      $name= $mysqli->escape_string($name);

      /* check connection */
      if (mysqli_connect_errno()) 
      {
      //   printf("Connect failed: %s\n", mysqli_connect_error());
         echo "Connect: failed";
         exit();
      }
      if (checkUsernameExists($name,$mysqli))
      {
         echo "Yes";

         $mysqli->close();
      }
      else
      {
         //save username to session variable
         $mysqli->close();
         echo "No";
      }
   }
}
