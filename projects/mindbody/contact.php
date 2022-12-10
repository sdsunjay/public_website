<?php
require_once __DIR__ . '/getFromDB.php';
?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Farmers</title>
</head>

<body>
    <div class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">SLO Farmers Market</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    
                    
                    <li class="dropdown">
                      <a href="vendor.php" class="dropdown-toggle" data-toggle="dropdown">Vendors<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li class="dropdown-header">Produce</li>
                        <li><a href="vendor.php">Vegetables</a></li>
                        <li><a href="vendor.php">Fruit</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Cooked</li>
                        <li><a href="vendor.php">Vegetarian</a></li>
                        <li><a href="vendor.php">Carnivores</a></li>
                        <li class="divider"></li>
                        <li><a href="vendor.php">Other</a></li>
                      </ul>
                    </li>
                    <li><a href="review.html">Write a Review</a></li>
                    <li><a href="displayReviews.php">Read Reviews</a></li>
                    <li><a href="map.html">Map</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    
                </ul>
            </div><!---end navbar-collapse--->
             
          </div><!---end of container--->
    </div>
    
    <div class="container">
        <div class="review-title">
            <h2>Contact</h2>
        </div>
    </div>
    <div class="container">
      For additional information regarding SLO Farmer's Market, contact the SLO County Farmers' Market Association
      <address>
      <strong>Telephone</strong><br>
      805-544-9570<br>
      SLO FMA<br>
      P.O. Box 16058<br>
      San Luis Obispo, CA 93401<br>
      </p>
<!--
      <form action="contact.php" method="post">
         Search Companies: <input type="text" name="vendor" /><br><br>
      <input type="submit" />
      </form>

      <?php
	 //getFromDB($_POST["vendor"]);
      ?>
-->
   </div>
</body>
