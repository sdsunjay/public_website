<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

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
                        <li><a href="#">Fruit</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Cooked</li>
                        <li><a href="#">Vegetarian</a></li>
                        <li><a href="#">Carnivores</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Other</a></li>
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
            <h2>Search</h2>
        </div>
    </div>
    <div class="container">
      Search through our review database! :)

      <form action="displayReviews.php" method="post">
         Search Companies: <input type="text" name="vendor" />
      <input type="submit" />
      </form>

      <br>

      <?php
         $searchthing = $_POST["vendor"];
      ?>
      
      <table width="100%">
         <col width="15">
         <col width="15">
         <col width="30">
         <col width="100">
      <?php
         require_once 'db_connect.php';

         $db = new DB_CONNECT();

         $result=null;
         $result = mysql_query("SELECT * FROM reviews ORDER BY businessName") or die(mysql_error());
      ?>

      <tr>
      <td> Reviews </td>
      </tr>

      <tr> 
         <th> FirstName    </th>
         <th> Lastname     </th> 
         <th> Business     </th>
         <th> Comment      </th>
      </tr>

      <?php
         while($row = mysql_fetch_array($result)) :
      ?>

      <tr>
      <td>
         <font face="Arial, Helvetica, sans-serif">
         <?php
            if($row['businessName'] == $searchthing) 
               echo $row['firstname'] . '&nbsp;';
         ?>
         </font>
      </td>

      <td>
         <font face="Arial, Helvetica, sans-serif">
         <?php
           if($row['businessName'] == $searchthing) 
              echo $row['lastname'] . '&nbsp;';
         ?>
         </font>
      </td>

      <td>
         <font face="Arial, Helvetica, sans-serif">
         <?php
           if($row['businessName'] == $searchthing) 
              echo $row['businessName'] . '&nbsp;';
         ?>
         </font>
      </td>

      <td>
         <font face="Arial, Helvetica, sans-serif">
         <?php
           if($row['businessName'] == $searchthing) 
              echo $row['comment'] . '&nbsp;';
         ?>
         </font>
      </td>
      </tr>

      <?php 
         endwhile; 
        // $db.close()
      ?>

      </table>

   </div>
</body>
