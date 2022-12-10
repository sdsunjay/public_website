<?php
session_set_cookie_params(0);
session_start();  
include("../../passwords/passwords.php");
   /*check to make sure we are logged in*/
   check_logged();

     
// set proper permissions on the new file

if(isset($_POST['logout']))
{
    session_start();
    session_unset();
    session_destroy();
    header("location:upload.php");
    exit();
}
?>

<html>
<head>
<title>File Upload Form</title>
</head>
<body>
<p>This form allows you to upload a file to the server.</p>
<form action="getfile1.php" method="post" enctype="multipart/form-data"><br>
Type (or select) Filename: <input type="file" name="file">
<input type="submit" value="Upload">
</form>

<p>
<input type="submit" name="logout" id="logout" value="logout" />
</p>
</body>
</html>
