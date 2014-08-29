
<?php
//insert into database
// Create MySQL login values and
// set them to your login information.
$username = "root";
$password = "toor";
$host = "localhost";
$database = "android";

// Make the connect to MySQL or die
// and display an error.
$link = mysql_connect($host, $username, $password);
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

// Select your database
mysql_select_db ($database);

// Make sure the user actually
// selected and uploaded a file
if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

   // Temporary file name stored on the server
   $tmpName = $_FILES['image']['tmp_name'];

   // Read the file
   $fp = fopen($tmpName, 'r');
   $data = fread($fp, filesize($tmpName));
   $data = addslashes($data);
   fclose($fp);


   // Create the query and insert
   // into our database.
  //mobileCloset(id INT NOT NULL AUTO_INCREMENT UNIQUE, author VARCHAR(255) NOT NULL,
  //t1 TIMESTAMP DEFAULT CURRENT_TIMESTAMP, grp ENUM('TOPS','BOTTOMS','OUTERWEAR','SHOES','JEWELRY', 'ACCESSORIES'),
  //uri VARCHAR(255) NOT NULL, PRIMARY KEY(id) 
   $query = "INSERT INTO mobileCloset";
   $query .= "(id) VALUES ('1','author','','TOPS','https://users.csc.calpoly.edu/~sdhama/Sunjay.jpg')";
   $results = mysql_query($query, $link);

   // Print results
   print "Thank you, your file has been uploaded.";

}
else {
   print "No image selected/uploaded";
}

// Close our MySQL Link
mysql_close($link);
?>
