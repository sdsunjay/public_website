<!DOCTYPE html>
<?php
require_once __DIR__ . '/getFromDB.php';
?>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Vendors</title>
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
    

    <section id="vendors-list">
        <div class="container">
            <h2>Vendors</h2>
                <div class="list-group">
                  <a href="#" class="list-group-item active">Produce</a>
                  <a href="#johnsmith" class="list-group-item">John Smith
                    <table class="table">
                        <tr> 
                            <td>Type of Food</td>
                            <td>Location of Farm</td>
                            <td>Bio</td>
                        </tr>
                    </table>
                  </a>  
                  <a href="#" class="list-group-item">Produce Farmer 2</a>
                  <a href="#" class="list-group-item">Produce Farmer 3</a>
                  <a href="#" class="list-group-item">Produce Farmer 4</a>  
                </div>     
            

                <div class="list-group">
                  <a href="#" class="list-group-item active">Cooked</a>
                  <a href="#" section id="BBQ" class="list-group-item">BBQ</a>
                  <a href="#" class="list-group-item">Sushi</a>
                  <a href="#" class="list-group-item">Corn</a>
                  <a href="#" class="list-group-item">Kettle Corn</a>  
                </div>  
                
                <div class="list-group">
                  <a href="#" class="list-group-item active">Other</a>
                  <a href="#" class="list-group-item">Clothing</a>
                  <a href="#" class="list-group-item">Clothing 2</a>
                  <a href="#" class="list-group-item">Gifts</a>
                  <a href="#" class="list-group-item">Gifts 2</a>  
                </div> 
                
                
    </section>  
    <!---
    <section id="reviews">
        <div class="container">
            <h2>Reviews</h2>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title" section id="johnsmith">Panel title</h3>
                  </div>
                  <div class="panel-body">
                    Panel content
                  </div>
                </div>
        </div>
    </section>
    -->

<?php
getFromDB("SLO BBQ");
getFromDB("ABC Foods");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/farmer.js"></script>
    
</body>
</html>
