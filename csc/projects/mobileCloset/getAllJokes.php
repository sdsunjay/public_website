<?php
$link = mysql_connect("localhost","username","password");
mysql_select_db("morrobay_androidappcourse",$link);

$sql = mysql_query("SELECT `Jokes`.`joke`"
              . " FROM Jokes"
	              . " ORDER BY `Jokes`.`id` ASC");

if ($_REQUEST[author] != "")
{
   $sql = mysql_query("SELECT `Jokes`.`joke`"
	         . " FROM Jokes"
		         . " WHERE author='$_REQUEST[author]'"
			         . " ORDER BY `Jokes`.`id` ASC");
}
while($row = mysql_fetch_array($sql))
{
       $joke = $row['joke'];
           echo "$joke\n";
}
?>
