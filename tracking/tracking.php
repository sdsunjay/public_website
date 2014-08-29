<?php

include_once("../../config/db_config.php");
if(isset($_POST['submit'],$_POST['referrer'])) {
 checkIfExists(getRealIp(),$_POST['referrer']);
}
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
function checkIfExists($ip,$referrer) 
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
      if (!($stmt = $mysqli->prepare("SELECT id,visits FROM tracking where ip=?"))) 
      {
         echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
      }

   /* Prepared statement, 
   stage 2: bind and execute */
      if (!$stmt->bind_param('s',$ip)) 
      {
         echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      }

      if($stmt->execute()) 
      {

         /* bind result variables */
         $stmt->bind_result($id,$visits);

         $output = $stmt->fetch();
         // does not exists in table
         if($id==null)
         {

            /* explicit close recommended */
            $stmt->close();
            securelyInsertIntoDB($ip,$referrer,$mysqli);
         }
         //exists in table
         else if($output)
         {
            //update
            
            /* explicit close recommended */
            $stmt->close();
            updateDB($visits,$id,$mysqli);
            insertIntoVisits($id,$mysqli);
         }
         //error
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
      //$stmt->close();

   /* close connection */
   /** For some reason the line below cause an error, check it out*/
   //$mysqli->close();
}

function insertIntoVisits($id,$mysqli)
{

   $now = time();
   if ($insert_st = $mysqli->prepare("INSERT INTO visits(id, time) VALUES (?, ?)")) {
      $insert_st->bind_param('is', $id, $now);
      // Execute the prepared query.
      if ($insert_st->execute()) {
         $insert_st->close();
         return true;
      }
      else
      {
         return false;
      }
         $insert_st->close();
   }
}
/**
 * Update tracking table with an additional visit
 */
function updateDB($visits, $id,$mysqli)
{

   $query_string="UPDATE tracking SET visits = ? where id = ?";
   $chk_name = $mysqli->prepare($query_string);
   $visits = $visits+1;
   $chk_name->bind_param('si',$visits,$id);
   // Execute the prepared query.
   if ($chk_name->execute()) {
      $chk_name->close();
      return true;
   }
   $chk_name->close();
   return false;
}
function securelyInsertIntoDB($ip,$referrer,$mysqli)
{

   /* check connection */
   if (mysqli_connect_errno()) {
      echo "bad";
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
   }

   /* Prepared statement, stage 1: prepare */
   if (!($stmt = $mysqli->prepare("INSERT INTO tracking(ip,visits,referrer) VALUES(?,?,?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
   }

   /* Prepared statement, stage 2: bind and execute */
   if (!$stmt->bind_param('sis',$ip,1,$referrer)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
   }

   if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
   }
   //close statement
   $stmt->close();
}
