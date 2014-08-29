<head>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta https-equiv="content-type" content="text/html; charset=utf-8" />
<title>Airport Calculator</title>
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../gui/style.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript" src="../../gui/jquery.formerize-0.1.js"></script>
<script type="text/javascript">
	$(function() {
		$('#search').formerize();
	});
</script>


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


</head>
<body>
<div id="wrapper">
<div id="header">
  <div id="logo">
    <h1><strong>Sunjay's Homepage</strong></h1>
  </div>
  <div id="search">
    <form action="" method="post">
      <div>
        <input class="form-text" name="search" size="44" maxlength="100" title="Search my website" />
      </div>
    </form>
  </div>
 	<div id="menu">
                        <ul>
                             <li class="https://sunjaydhama.com"><a href="../../gui/index.html">Home</a></li>
                             <li><a href="../../gui/about.html">About</a></li>
                             <li><a href="../../gui/images.html">Images</a></li>
                             <li><a href="../../blog">Blog</a></li>
                             <li><a href="../../gui/projects.html">Projects</a></li>
                             <li><a href="../../gui/contact.html">Contact Me</a></li>
                        </ul>
			<br class="clearfix" />
		</div>
	</div>
	<div id="page">
		<div id="sidebar">
			<h3>Sidebar</h3>
			<ul class="list">
                         <li class="first"><a href="https://sunjaydhama.com">Terminal</a></li>
                         <li><a href="#" onClick="window.open('https://github.com/sdsunjay?tab=repositories', 'external');">Github</a></li>
                      
      <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/sdsunjay" data-widget-id="459207762094735360">Tweets by @sdsunjay</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^https:/.test(d.location)?'https':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </ul>
</div>
<div id="content">
<div id="post1">


<h4>Airport Cost Calculator</h4><a href='../accounts/index.php'>Admin</a>
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

                  <div id="footer"> Copyright (c) 2014 <a href="https://www.sunjaydhama.com/">Sunjay Dhama</a>. All rights reserved. Template by <a href="https://www.freecsstemplates.org/">CSS Templates</a><br>
<a class='facebook' href='#' onclick="window.open('https://www.linkedin.com/in/sdsunjay','external');" >
                        <img alt='' src='../../gui/images/li.png' width="30" height="30" /></a>
                     <a class='twitter' href='#' onclick="window.open('https://www.twitter.com/sdsunjay','external');" >
                        <br>
                        <img alt='' src='../../gui/images/twitt.jpg' width="30" height="30"/></a>
                     <br>
                     <a href="https://bitcoin.org" target="_NEW">BitCoin</a>: <b><a href="bitcoin:1Shn9NDCuHeAeDDaHtCb9RFMV1kQr6uZx">1Shn9NDCuHeAeDDaHtCb9RFMV1kQr6uZx</a></b><br />
                  </div>
               </body>
            </html>
<!--
<div id="footer"> Copyright (c) 2012 www.sunjaydhama.com. All rights reserved. Template by <a href="https://www.freecsstemplates.org/">CSS Templates</a>. </div>

</div>
</div>
</body>
</html></div>


</body>
</html>-->
