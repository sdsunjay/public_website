<?php
    include_once("/usr/share/nginx/html/security/htmlpurifier/HTMLPurifier.standalone.php");
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $clean_name = $purifier->purify($_GET['name']);
    include_once("/usr/share/nginx/html/config/db_config.php");
    if(strlen($clean_name) > 20)
    {
       $clean_name = substr($clean_name,0,20);
    }
    getFromDB($clean_name);

function getRealIp() {
   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
      $ip=$_SERVER['HTTP_CLIENT_IP'];
   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
   } else {
      $ip=$_SERVER['REMOTE_ADDR'];
   }
   return $ip;
}
function getFromDB($name) 
{
   if(is_null($name))
   {
      echo "name is null in load";
      printf("Name is null\n\n");
   }
   else
   {
      $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

      /* check connection */
      if (mysqli_connect_errno()) 
      {
         printf("Connect failed: %s\n", mysqli_connect_error());
         echo "Connect: failed";
         exit();
      }
      /* Prepared statement, stage 1: prepare */
      if (!($stmt = $mysqli->prepare("SELECT userInput FROM code where name=? ORDER BY DateInserted DESC"))) 
      {
         echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
      }

   /* Prepared statement, 
   stage 2: bind and execute */
      if (!$stmt->bind_param('s',$name)) 
      {
         echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      }

      if($stmt->execute()) 
      {

         /* bind result variables */
         $stmt->bind_result($ds);

         $output = $stmt->fetch();
         if($output==null)
         {
            $ip = getRealIp(); // Get the IP from superglobal
            $_SERVER['REMOTE_ADDR'];
            securelyInsertIntoDB("//Only this file can be saved",$name,$ip,$mysqli);
            getFromDB($name);
         }
         else if($output)
         {
            /* fetch value */
            $stmt->fetch();
            echo $ds;
         }
         else
         {
            echo "An error occurred: (" . $stmt->errno . ") " . $stmt->error;
            printf("Error occurred in load\n");
         }

      }
      else
      {
         printf("Execute failed\n");
         echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      }
      /* explicit close recommended */
      $stmt->close();

   }
   /* close connection */
   /** For some reason the line below cause an error, check it out*/
   //$mysqli->close();
}

function securelyInsertIntoDB($code,$name,$ip,$mysqli)
{

   /* check connection */
   if (mysqli_connect_errno()) {
      echo "bad";
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
   }

   /* Prepared statement, stage 1: prepare */
   if (!($stmt = $mysqli->prepare("INSERT INTO code(userInput,name,IP) VALUES(?,?,?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
   }

   /* Prepared statement, stage 2: bind and execute */
   if (!$stmt->bind_param('sss',$code,$name,$ip)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
   }

   if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
   }
   //close statement
   $stmt->close();
   //close connection
   $mysqli->close();
}
?>
