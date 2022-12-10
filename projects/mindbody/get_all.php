<?php

/*
 *  * Following code will list all the products
 *   */

$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table
$result = mysql_query("SELECT * FROM reviewers") or die(mysql_error());
// check for empty result
$firstnames = array();
$lastnames = array();
$businessnames = array();
$dates = array();
$comments = array();
$numberOfRows = mysql_num_rows($result);
if ($numberOfRows > 0) {
   // looping through all results
   // products node
   // array for JSON response
   //$response["firstname"] = array();
   //$response["lastname"] = array();
   //$response["businessName"] = array();
   //$response["comment"] = array();
   //$response["date"] = array();
   while ($row = mysql_fetch_array($result)) {
   //while ($row = mysql_fetch_row($result)) {
      // temp user array
      //$product = array();
      //$product["tags"] = $row["category"];
      array_push($firstnames, $row['firstname']); // display the value.
      array_push($lastnames, $row['lastname']); // display the value.
      array_push($businessnames, $row['businessName']); // display the value.
      array_push($dates, $row['date']); // display the value.
      array_push($comments, $row['comment']); // display the value.
      //$lastnames+=$row['lastname']; // display the value.
      //$dates+=$row['date']; // display the value.
      //$row['businessName']; // display the value.
      //$row['comment']; // display the value.



      // push single product into final response array
      //array_push($response["tags"], $product);
   }

   // success
   //$response["success"] = 1;

   // echoing JSON response
   //echo json_encode($response);
} else {
   // no products found
   $response["success"] = 0;
   $response["message"] = "No products found";

   // echo no users JSON
   //echo json_encode($response);
}
//echo "<br>";
//echo $firstnames[1];
//echo "<br>";
//echo $firstnames[2];
//echo "<br>";
//echo $firstnames[3];
//echo "<br>";
//echo $firstnames[4];
//echo "<br>";
//echo $firstnames[5];
//echo "<br>";
//echo $firstnames[6];
//echo "<br>";
//echo $firstnames[7];
//echo "<br>";
//echo $firstnames[8];
//echo "<br>";
//echo $firstnames[9];
//echo "<br>";
?>
