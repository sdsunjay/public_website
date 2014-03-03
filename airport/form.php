<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Airport Calculator</title>
<script type="text/javascript" src="calculate.js">
</script>
<style>
.uinput {
	width:50px;
	background-color:blue;
	background:white;
}
#output, #output1 {
	text-align:center;
}
#text {
	display:none;
}
#plane {
	width:630px;
	height:300px;
}
</style>
<?php 
//read prices from file
function getPrices()
{
   $fh = fopen('prices.txt', "r");
   //while (!feof($fh) ) {
   $text = fgets($fh);
   //echo $text;
   $vals = explode("|", $text);
   //}
   fclose($fh);
   return $vals;
}

$prices = getPrices();
?>
<script type="text/javascript" >
//reset button code
function resetForm(){
   var prices1 = [<?php echo implode(', ', $prices)?>];

   document.getElementById("pcosts").value=prices1[4];
   document.getElementById("pcosts1").value=prices1[5];
   document.getElementById("dairport").value=prices1[6];
   document.getElementById("dairport1").value=prices1[7];
   document.getElementById("ctime").value=prices1[2];
   document.getElementById("ctime1").value=prices1[3];
   document.getElementById("gasp").value=prices1[0];
   document.getElementById("gasp1").value=prices1[1];
   document.getElementById("costs").value='';
   document.getElementById("costs1").value='';
   document.getElementById("days").value='';
   document.getElementById("days1").value='';
   document.getElementById('output').style.display="none";
   document.getElementById('output1').style.display="none";
}
</script>
</head>

<body>
<table>
  
    <td width="800" align="middle"><h1>Airport Cost Calculator</h1></td>
</table>
<table border="0" cellpadding="0">
  <tr>
    <td width="200" aligh="left"><p> Enter your trip information on the right. 
        After you have filled in the form click calculate below to see how much SBP can save you!</p></td >
      <td width ="800" align="left">
    <table bgcolor="#E6E6E6" border="0" cellpadding="0">
      <tr>
        <td width="222" align="middle"></td>
        <td width="96" align="left"><b>SFO</b></td>
        <td width="96" align="left"><b>SBP</b></td>
      </tr>
      <tr>
        <td width="222" align="left">Total Cost of Flight(s):</td>
        <td width="96"><input class="uinput" id="costs" type="text" name="costs" maxlength="10" /></td>
        <td width="96"><input class="uinput"  id="costs1" type="text" name="costs" maxlength="10" /></td>
      </tr>
      <tr>
        <td width="222" align="left">Days of Travel:</td>
        <td width="96"><input class="uinput"  id="days" type="text" name="days" maxlength="10"/></td>
        <td width="96"><input class="uinput"  id="days1" type="text" name="days" maxlength="10"/></td>
      </tr>
      <tr>
        <td width="222" align="left" id="parking">Parking Costs ($):</td>
        <!--15 and 8 for parking in SFO and SBP -->
        <td width="96"><input class="uinput"  id="pcosts" type="text" name="pcosts" maxlength="10" value="<?php echo $prices[4]; ?>" />
          &nbsp;/day</td>
        <td width="96"><input class="uinput"  id="pcosts1" type="text" name="pcosts1" maxlength="10" value="<?php echo $prices[5];?>"/>
          &nbsp;/day</td>
      </tr>
      <tr>
        <td width="222" align="left" valign="middle">Distance to Airport (mi):</td>
        <!--220 and 5 for default distance in miles to SFO and SBP-->
        <td width="96"><input class="uinput"  id="dairport" type="text" name="dairport" maxlength="10" value="<?php echo $prices[6];?>"/></td>
        <td width="96"><input class="uinput"  id="dairport1" type="text" name="dairport1" maxlength="10" value="<?php echo $prices[7] ?>" /></td>
      </tr>
      <tr>
        <td width="222" align="left" valign="middle"/>
        <a href ="http://www.yourweblog.com/yourfile.html" onclick="window.open('mileageCost.html','popup','width=200,height=200,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,right=0,top=0, middle=0'); return false"> Mileage Cost($):</a>
        </td>
      
      
        <td width="100"><input class="uinput"  id="ctime" type="text" name="ctime" maxlength="10" value="<?php echo $prices[2];?>" />
          &nbsp;/hour</td>
        <td width="100"><input class="uinput"  id="ctime1" type="text" name="ctime1" maxlength="10" value="<?php echo $prices[3];?>"/>
          &nbsp;/hour</td>
      </tr>
      <tr>
        <td width="222" align="left" valign="middle">Cost of Gas ($):</td>
        <td width="96"><input class="uinput"  id="gasp" type="text"  maxlength="10" value="<?php echo $prices[0]; ?>" />
          &nbsp;/gal</td>
        <td width="96"><input class="uinput"  id="gasp1" type="text" maxlength="10" value="<?php echo $prices[1]; ?>" />
          &nbsp;/gal</td>
      </tr>
      <tr>
        <td align="left" valign="middle"><input type="button" name="calculate" value="Calculate" onclick="Calculation()" />
          <input type="button"  value="Reset" onclick="resetForm()" />
          &nbsp;&nbsp; <a href="http://www.yourweblog.com/yourfile.html" onclick="window.open('info.html','popup','width=200,height=200,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,right=0,top=0, middle=0'); return false">?</a></td>
        <td align="left" valign="middle" id="output"></td>
        <td align="left" valign="middle" id="output1"></td>
      </tr>
      <tr> </tr>
    </table>
      </td>
  </tr>
</table>
</body>
</html>
