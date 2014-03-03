
<?php
include_once("db_config.php");

securelyinsertIntoDB($_POST['fname'],$_POST['lname'],$_POST['businessname'],$_POST['comment']);
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=review.html">';    
exit;
//if i got posted to, get global
//intercept the post
//and get the variables
//php detect post
//global
function insertIntoDB($firstname,$lastname,$businessname,$comment)
{
   // array for JSON response
   $response = array();
   // check for required fields
   if (isset($comment) && isset($businessname)) {
      // include db connect class
      require_once __DIR__ . '/db_connect.php';

      // connecting to db
      $db = new DB_CONNECT();


      // mysql inserting a new row
      $result = mysql_query("INSERT INTO reviews(firstname,lastname,businessName,comment) VALUES('$firstname','$lastname','$businessname','$comment')");
      //$id = mysql_insert_id();
      //$result = mysql_query("INSERT INTO categories(id, category) VALUES('$id', '$cate')");
      //$count=3;
      //if(count<$size)
     // {
	 //if($tags[$count]!='' || $tags[$counter]!=' ') 
	 //{
	   // for ( $counter = 3; $counter < $size; $counter ++) {
	     //  $result = mysql_query("INSERT INTO tagsd(id, tag) VALUES($id, '$tags[$counter]')");
	   // }
	// }
    //  }
      
      // check if row inserted or not
      if ($result) {
	 // successfully inserted into database
	 $response["success"] = 1;
	 $response["message"] = "Product successfully created.";
      echo "success! Redirecting!";
	 // echoing JSON response
	 //echo json_encode($response);
      } else {
	 // failed to insert row
	 $response["success"] = 0;
	 $response["message"] = "Oops! An error occurred.";
      echo "An error occurred. Oops!";
	 // echoing JSON response
      }
   } else {
      // required field is missing
      $response["success"] = 0;
      $response["message"] = "Required field(s) is missing";
      echo "Missing a required field";

      // echoing JSON response
      //echo json_encode($response);
   }
}

function securelyInsertIntoDB($firstname,$lastname,$businessname,$comment)
{

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* Prepared statement, stage 1: prepare */
if (!($stmt = $mysqli->prepare("INSERT INTO reviews(firstname,lastname,businessName,comment) VALUES (?,?,?,?)"))) {
     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

/* Prepared statement, 
stage 2: bind and execute */
if (!$stmt->bind_param('ssss', $firstname, $lastname, $businessName, $comment)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

/* explicit close recommended */
$stmt->close();


}
   ?>
