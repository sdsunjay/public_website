<?php

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table
$result = mysql_query("SELECT * FROM reviewers ORDER BY businessName") or die(mysql_error());


//       IF YOU ONLY WANT TO SHOW REVIEWS OF A PARTICULAR TYPE 
//UNCOMMENT LINE BELOW

//$result = mysql_query("SELECT * FROM reviewers where businessName=\"SLO BBQ\"") or die(mysql_error());

 ?>

<table>
<tr>
<td><h2>Reviews</h2></td>

</tr>
<tr> <b> First name 
         last name               business name  comment</b> </tr>
   <?php 
      while($row = mysql_fetch_array($result)) : 
   ?>
<!--
STYLE THIS BITCH AND MAKE HER LOOK ALL PRETTY
-->

<tr>
<td>
   <font face="Arial, Helvetica, sans-serif"> 
   <?php
      if($row['businessName'] == "SLO BBQ"){
         echo $row['firstname'] . '&nbsp;';
      }
   ?>
   </font>         
   <font face="Arial, Helvetica, sans-serif"> 
   <?php 
      if($row['businessName'] == "SLO BBQ"){
         echo $row['lastname'] . '&nbsp;';
      }                     
   ?>
   
   </font>         
</td>
<td>
   <font face="Arial, Helvetica, sans-serif"> 
   <?php 
//      if($row['businessName'] == "SLO BBQ"){
         echo $row['businessName'] . '&nbsp;';
//      }                   
   ?>
   </font>
</td>
<td>
<!-- I don't think we want to show the date just yet -->
<!-- 
<font face="Arial, Helvetica, sans-serif"> <?php// echo $row['date']; ?> </font> -->
</td>
<td>
   <font face="Arial, Helvetica, sans-serif"> 
   <?php 
      if($row['businessName'] == "SLO BBQ"){
         echo $row['comment'] . '&nbsp;';
      }                   
   ?>
   </font>
</td>
</tr>
<?php endwhile; $db.close()?>
</table>
