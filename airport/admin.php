<?php session_start(); 
include("passwords.php");
/*check to make sure we are logged in*/
check_logged();
/*read prices from file*/
/*return array of prices*/
function getPrices()
{
	$fh = fopen('prices.txt', "r");
	while (!feof($fh) ) {
		$text = fgets($fh);
		$vals = explode("|", $text);
	}
	fclose($fh);
	return $vals;
}
/*write prices in prices array*/
function writePrices($prices)
{
	$fh = fopen('prices.txt', "w");
	foreach($prices as $line)
	{
		fwrite($fh, $line."|");
	}

	fclose($fh);
}



/*Logout user*/
if(isset($_GET['logout']))
{
	session_destroy();
	header("location:admin.php");
}



if(isset($_POST['update']))
{
    $prices = getPrices();
    if(!isset($prices[0])|| $prices[0] != $_POST['sfogas'])
        $prices[0] = $_POST['sfogas'];                                              
        
    if(!isset($prices[1]) || $prices[1] != $_POST['sbpgas'])
        $prices[1] = $_POST['sbpgas'];
    
    if(!isset($prices[2])|| $prices[2] != $_POST['sfoctime'])
        $prices[2] = $_POST['sfoctime'];                                              
    if(!isset($prices[3])|| $prices[3] != $_POST['sbpctime'])
        $prices[3] = $_POST['sbpctime'];                                              

    if(!isset($prices[4])|| $prices[4] != $_POST['sfopcost'])
        $prices[4] = $_POST['sfopcost'];                                              
    if(!isset($prices[5]) || $prices[5] != $_POST['sbppcost'])
        $prices[5] = $_POST['sbppcost'];

   if(!isset($prices[6]) || $prices[6] != $_POST['sfodistance'])
        $prices[6] = $_POST['sfodistance'];
    if(!isset($prices[7]) || $prices[7] != $_POST['sbpdistance'])
        $prices[7] = $_POST['sbpdistance'];
    
    //Writes array to file in order, separated by new lines
    writePrices($prices);     //MODIFIED!
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>
</head>

<body>
<p>
<?php 
	$prices = getPrices();
?>
<form id="form2" name="form2" method="post" action="">
<table width="450" border="0" cellpadding="0">
  <tr>
    <td>SFO Gas</td>
    <td><input type="text" name="sfogas" id="sfogas" value="<?php echo $prices[0]; ?>" /></td>
    <td>SBP Gas</td>
    <td><input type="text" name="sbpgas" id="sbpgas" value="<?php echo $prices[1]; ?>" /></td>
  </tr>
  <tr>
  <td>SFO Parking Cost</td>
    <td><input type="text" name="sfopcost" id="sfopcost" value="<?php echo $prices[4]; ?>" /></td>
  <td>SBP Parking Cost</td>
    <td><input type="text" name="sbppcost" id="sbppcost" value="<?php echo $prices[5]; ?>" /></td>
  </tr>
  <tr>
  <td>SFO Time Cost</td>
    <td><input type="text" name="sfoctime" id="sfoctime" value="<?php echo $prices[2]; ?>" /></td>
  <td> SBP Time Cost</td>
    <td><input type="text" name="sbpctime" id="sbpctime" value="<?php echo $prices[3]; ?>" /></td>
  </tr>
  <tr>
  <td> SFO Distance </td>
    <td><input type="text" name="sfodistance" id="sfodistance" value="<?php echo $prices[6]; ?>" /></td>
  <td> SBP Distance </td>
    <td><input type="text" name="sbpdistance" id="sbpdistance" value="<?php echo $prices[7]; ?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="update" id="update" value="Update" />
   
    </td>
  </tr>
</table>
 </form>

<form id="form1" name="form1" method="get" action="admin.php">
  <p>
    <input type="submit" name="logout" id="logout" value="Logout" />
  </p>
</form>

</p>
</body>
</html>
