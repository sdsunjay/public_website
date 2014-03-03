<html>
<body>
<?php
  include 'get_all.php';
  ?>
<?php$username="root";$password="mindbody";$database="mind";
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM reviewers";$result=mysql_query($query);
$num=mysql_numrows($result);mysql_close();?>
<table border="0" cellspacing="2" cellpadding="2">
<tr>
<td>
<font face="Arial, Helvetica, sans-serif">Value1</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value2</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value3</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value4</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value5</font>
</td>
</tr>
<?php$i=0;while ($i < $num) {$f1=mysql_result($result,$i,"firstname");
$f2=mysql_result($result,$i,"lastname");$f3=mysql_result($result,$i,"comment");
$f4=mysql_result($result,$i,"businessName");$f5=mysql_result($result,$i,"date");?>
<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $firstnames[0]; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $lastnames[0]; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $comments[0]; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $dates[0]; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $businessNames[0]; ?></font>
</td>
</tr>
<?php$i++;}?>
</body>
</html>
