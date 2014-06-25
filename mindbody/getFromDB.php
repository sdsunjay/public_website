
<?php
function getFromDB($name)
{

// include db connect class
require_once __DIR__ . '/db_connect.php';
require_once '../../security/htmlpurifier/library/HTMLPurifier.auto.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table
//$result = mysql_query("SELECT * FROM reviewers ORDER BY businessName") or die(mysql_error());


// IF YOU ONLY WANT TO SHOW REVIEWS OF A PARTICULAR TYPE 
// UNCOMMENT LINE BELOW

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
$name = $purifier->purify($name);
$result = mysql_query("SELECT * FROM reviews WHERE businessName='$name'") or die(mysql_error());


$numberOfRows = mysql_num_rows($result);
if ($numberOfRows == 0) {
   echo "<p>Sorry, there are no reviews yet for this farm </p>";
}
else 
{
   echo '<section id="reviews">
      <div class="container">
      <h2>Reviews</h2>';
   while($row = mysql_fetch_array($result)) : ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title" section id="johnsmith">
                <b> <?php echo $row['firstname'] . '&nbsp;';echo $row['lastname']; ?></b> 
                <br>
                <?php echo $row['businessName']; ?>
                </h4>
            </div>
        <div class="panel-body">
            <?php echo $row['comment']; ?> 
        </div>
</div>

<?php 
      endwhile; 
} 
//$db.close();
?>
</section>

<?php } ?>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/farmer.js"></script>

</body>
</html>
