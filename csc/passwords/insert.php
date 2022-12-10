
<html>
<head>
<meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login</title>
<?php
session_start(); 
include("/var/www/passwords/passwords.php");
include("/var/www/passwords/captchg.php");

if(isset($_POST['submit'])){
   //$username = 'admin';
   //$password = 'admin';
   if(empty($_POST['username']))
   {
      echo 'Username is empty!';
   }
   else if(empty($_POST['password']))
   {
      echo 'Password is empty!';
   }
   else
   {
      $mysqli = new mysqli("localhost", "root", "toor", "logins");
      //check connection 
      if ($mysqli->connect_error) {
	 header("Location: bad.php");
      }
      else
      {

	 $username=trim($_REQUEST["username"]);
	 $password=trim($_REQUEST["password"]);

	 if($stmt = $mysqli->prepare("INSERT INTO MEMBERS (username, password) VALUES (:username, :password)"))
	 {
	    $stmt->bindParam(':username', $username);
	    $stmt->bindParam(':password', $password);
	    // insert one row
	    $stmt->execute();
	    $stmt->store_result();  // add this line
	    if($stmt->num_rows){
	       header("Location: display.php");
	       // $_SESSION["logged"]=$_POST["username"]; 
	       //header("Location: upload.php");
	       //$query = "UPDATE from members SET logged=SYSDATE()";
	       //$query .= "WHERE username='$username' AND password='$password' ";
	       // $_SESSION["logged"]=$_POST["username"]; 
	    }
	    else
	    {
	       echo 'Sorry, this login is invalid.';
	       header("Location: bad.php");
	       //$message  = 'Invalid query: ' . mysql_error() . "\n";
	       //$message .= 'Whole query: ' . $query;
	       //die($message);
	    }
	    $stmt->close();
	    $mysqli->close();
	 }
      }
   }
   /*	 else
	 {
	 echo "Could not connect to server\n";
	 trigger_error(mysql_error(), E_USER_ERROR);
	 }
	 }*/
}
?>
</head>
<body>
<p>Login now!</p>
<form action="passwordsql.php" method="post">
<p>username: <input type="password" name="username" /></p>
<p>password: <input type="password" name="password" /></p>
<input type="submit" name="submit" value="Submit" />
</form>

</html>
