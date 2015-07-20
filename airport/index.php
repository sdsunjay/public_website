<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Airport Travel Calculator</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="../../css/normalize.css">
  <link rel="stylesheet" href="../../css/skeleton.css">

<!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <link rel="icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">
            <link rel="shortcut icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">

</head>
<body>

  <!-- Nav
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
   <nav>
      <ul>
         <li><a href="../../gui/new/about.html">ABOUT</a></li>
         <li><a href="../../gui/new/projects.html">PROJECTS</a></li>
         <li>
         <a href="index.html">
            <img id="navlogo" src="../../images/logo.png" alt="navagation-logo"></a></li>
         <li><a href="../../gui/new/resume.html">R&Eacute;SUM&Eacute;</a></li>
        <!--
        <li><a href="../../blog">BLOG</a></li>
        -->
         <li><a href="../../gui/new/contact.html">CONTACT</a></li>
      </ul>
   </nav>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="shell spacer">


<h4>Airport Cost Calculator</h4>
<!--<a href='../accounts/index.php'>Admin</a>
-->
<p>Enter your trip information and then press 'Calculate' to see how much cheaper it is to fly out of SLO than it is to drive to SFO!</p>
<table border="0" cellpadding="0">
  <tr>
    <td width="222" align="middle"></td>
    <td width="96" align="left"><b>SFO</b></td>
    <td width="96" align="left"><b>SBP</b></td>
  </tr>
  <tr>
    <td width="222" align="left">Total Cost of Airfare:</td>
    <td width="96"><input class="uinput" id="costs" type="text" name="costs" maxlength="10" /></td>
    <td width="96"><input class="uinput"  id="costs1" type="text" name="costs" maxlength="10" /></td>
  </tr>
  <tr>
    <td width="222" align="left">Days of Travel:</td>
    <td width="96"><input class="uinput"  id="days" type="text" name="days" maxlength="10" onBlur="copy1()"/></td>
    <td width="96"><input class="uinput"  id="days1" type="text" name="days" maxlength="10" onBlur="copy0()"/></td>
  </tr>
  <tr>
    <td width="222" align="left" id="parking">Parking Costs ($):</td>
    <td width="96"><input class="uinput"  id="pcosts" type="text" name="pcosts" maxlength="10" value="15" />
      /day</td>
    <td width="96"><input class="uinput"  id="pcosts1" type="text" name="pcosts1" maxlength="10" value="8"/>
      /day</td>
  </tr>
  <tr>
    <td width="222" align="left" valign="middle">Distance to Airport (mi):</td>
    <td width="96"><input class="uinput"  id="dairport" type="text" name="dairport" maxlength="10" value="220"/></td>
    <td width="96"><input class="uinput"  id="dairport1" type="text" name="dairport1" maxlength="10" value="10" /></td>
  </tr>
  <tr>
    <td width="222" align="left" valign="middle">How much is your time worth ($):</td>
    <td width="96"><input class="uinput"  id="ctime" type="text" name="ctime" maxlength="10" value="9.99" onBlur="copy()"/>
      /hour</td>
    <td width="96"><input class="uinput"  id="ctime1" type="text" name="ctime1" maxlength="10" value="9.99" onblur= "cop()"/>
      /hour</td>
  </tr>
  <tr>
    <td align="left" valign="middle">Cost of Gas ($):</td>
    <td width="96"><input class="uinput"  id="gasp" type="text"  maxlength="10" value="<?php echo $prices[0]; ?>" />
      /gal</td>
    <td width="96"><input class="uinput"  id="gasp1" type="text" maxlength="10" value="<?php echo $prices[1]; ?>" />
      /gal</td>
  </tr>
  <tr>
    <td align="left" valign="middle"><input type="button" name="calculate" value="Calculate" onClick="Calculation()" />
      &nbsp;&nbsp; <a href="https://www.yourweblog.com/yourfile.html" onClick="window.open('info.html','popup','width=200,height=200,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,right=0,top=0, middle=0'); return false">?</a></td>
    <td align="left" valign="middle" id="output"></td>
    <td align="left" valign="middle" id="output1"></td>
  </tr>
  <tr> 
    <!--<td align="left" valign="middle"><input type="button"  value="Reset" onclick="reset()" />-->
      </td>
    <td align="left" valign="middle"><a href="https://www.yourweblog.com/yourfile.html" onClick="window.open('info.html','popup','width=200,height=200,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,right=0,top=0'); return false"></a></td>
    <td>&nbsp;</td>
    <td width="12">&nbsp;</td>
  </tr>
</table>
</form>
</div>
<!-- scripts-->
<script type="text/javascript" src="js/calculate.js"></script>
</body>
</html>
