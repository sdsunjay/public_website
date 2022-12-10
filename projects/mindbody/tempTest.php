<html>
<body>
<?php
  include 'get_all.php';
  ?>
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
<?php
$i=0;
while ($i < $numberOfRows) : ?>
<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $firstnames[i]; ?></font>         
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $lastnames[i]; ?></font>         
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo "test1"; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo "test2"; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo "test5"; ?></font>
</td>
</tr>
<?php $i++; endwhile;?>
</body>
</html>
