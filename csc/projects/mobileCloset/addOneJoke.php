<?php

$con = mysql_connect("localhost","username","password");
if (!$con)
  {
       die('Could not connect: ' . mysql_error());
         }

mysql_select_db("morrobay_androidappcourse", $con);

$sql="INSERT INTO Jokes (joke, author)
VALUES
('$_REQUEST[joke]','$_REQUEST[author]')";

if (!mysql_query($sql,$con))
  {
       die('Error: ' . mysql_error());
         }
echo "1 record added";
mysql_close($con)
?>
