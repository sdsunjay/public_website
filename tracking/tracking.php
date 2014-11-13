<?php

include_once("../../config/db_config.php");

if(isset($_POST['submit'],$_POST['referrer'], $_POST['yourApp'],$_POST['yourAppAlt'],$_POST['yourAppCodeName'])) {
   //echo $_POST['submit'].$_POST['referrer'].$_POST['yourApp'].$_POST['yourAppAlt'].$_POST['yourAppCodeName'];
   $ip=getRealIp();
   $referrer = $_POST['referrer'];
   if(checkIfExists($ip,$referrer))
   {
      echo "Yes";
   }
}
function getRealIp() {
   $ip="";
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
    //  printf("Connect failed: %s\n", mysqli_connect_error());
      echo "Connect: failed";
      return false;
   }
   
   if(empty($ip))
   {
      echo "Couldn't determine IP Address";
      return false;

   }
   if(empty($referrer))
   {
      echo "Couldn't determine referrer";
      return false;
   }
   $stmt = $mysqli->prepare("SELECT id FROM tracking where ip=?");
   /* Prepared statement, stage 1: prepare */
   if (!($stmt)) 
   {
      echo "Select prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
      return false;
   }
   
 //  $ip=strval(123);
   /* Prepared statement, 
   stage 2: bind and execute */
   if (!($stmt->bind_param('s',$ip))) 
   {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      return false;
   }

   if($stmt->execute()) 
   {

      /* bind result variables */
      $stmt->bind_result($id);
      
         $output=$stmt->fetch();
      // does not exists in table
         if($id==null)
         {

            /* explicit close recommended */
            //    $stmt->close();
            if(securelyInsertIntoDB($ip,$referrer,$mysqli))
            {
               return true;     
            }
         }
         //exists in table
         else 
         {
            /* explicit close recommended */
            $stmt->close();
            if(insertIntoVisits($id,$mysqli))
            {
               return true;     
            } 
         }
         //error
         //  else
         //  {
         //   echo "An error occurred: (" . $stmt->errno . ") " . $stmt->error;
         //printf("Error occurred in load\n");
         //  }
   }
   else
   {
      // printf("Execute failed\n");
      //echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
   }
   return false;
   /* explicit close recommended */
   //$stmt->close();
   /* close connection */
   /** For some reason the line below cause an error, check it out*/
  // $mysqli->close();
}

function insertIntoVisits($id,$mysqli)
{

   if ($insert_st = $mysqli->prepare("INSERT INTO visits(id) VALUES (?)")) {

   /* Prepared statement, 
   stage 2: bind and execute */
      if (!$insert_st->bind_param('i',$id)) 
      {
         echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      }
      // Execute the prepared query.
      if ($insert_st->execute()) {
         $insert_st->close();
         return true;
      }
      else
      {
         echo "Unable to execute insert.";
      }
      $insert_st->close();
   }
   return false;
}

/**
 * Update tracking table with an additional visit
 */
//according to eriq we shouldn't store this info
/*
function updateDB($visits, $id,$mysqli)
{
   // Prepared statement, stage 1: prepare 
   if (!($stmt = $mysqli->prepare("UPDATE tracking SET visits=? WHERE id=?"))) 
   {
      echo "Update prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
      return false;
   }

   //Prepared statement, stage 2: bind and execute 
   if (!$stmt->bind_param('ii',$visits,$id)) 
   {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      return false;
   }
   //$chk_name->bind_param('ii',$visits,$id);
   // Execute the prepared query.
   if ($stmt->execute()) {
      $stmt->close();
      return true;
   }
   else
   {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
   }
   return false;
}*/
function securelyInsertIntoDB($ip,$referrer,$mysqli)
{

   /* check connection */
   if (mysqli_connect_errno()) {
      echo "Connection Error";
      return false;
      //printf("Connect failed: %s\n", mysqli_connect_error());
      //exit();
   }
   /* Prepared statement, stage 1: prepare */
   if (!($stmt = $mysqli->prepare("INSERT INTO tracking(ip,referrer) VALUES(?,?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
      return false;
   }

   /* Prepared statement, stage 2: bind and execute */
   if (!$stmt->bind_param('ss',$ip,$referrer)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      return false;
   }

   if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      return false;
   }
   //close statement
   $stmt->close();
   return true;
}
