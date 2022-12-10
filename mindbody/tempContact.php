
      
      <table width="100%">
         <col width="15">
         <col width="15">
         <col width="30">
         <col width="100">
      <?php
         require_once 'db_connect.php';

         $db = new DB_CONNECT();
         $result = mysql_query("SELECT * FROM reviews ORDER BY businessName") or die(mysql_error());
      	 $tempRow = mysql_fetch_array($result);
         if($tempRow['businessName'] == $searchthing){ 
	

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
      <tr>
      <td>
	<?php
         	while($row = mysql_fetch_array($result)) :
  			echo $row['firstname'] . '&nbsp;';
                	echo $row['lastname'] . '&nbsp;';
                	echo $row['businessName'] . '&nbsp;';
              		echo $row['comment'] . '&nbsp;';
         
         	endwhile; 
	?>
      </td>

      </tr>

      <?php 
	}
	else
{?>
<p> No reviews found for that company</p>
<?php
}
         $db.close()
      ?>

