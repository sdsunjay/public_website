<?php
include("/var/www/passwords/passwords.php");
define("UPLOAD_DIR", "/tmp/");
session_set_cookie_params(0);
session_start();
/*check to make sure we are logged in*/
//check_logged();
/*Logout user*/
if(isset($_GET['logout']))
{
   session_destroy();
   header("location:login.php");
}


$allowed_types = array(
      /* images extensions */
      'jpeg', 'bmp', 'png', 'gif', 'tiff', 'jpg',
      /* audio extensions */
      'mp3', 'wav', 'midi', 'aac', 'ogg', 'wma', 'm4a', 'mid', 'orb', 'aif',
      /* movie extensions */                              
      'mov', 'flv', 'mpeg', 'mpg', 'mp4', 'avi', 'wmv', 'qt','mkv','vob','divx',
      /* document extensions */                               
      'txt', 'pdf', 'ppt', 'pps', 'xls', 'doc', 'xlsx', 'pptx', 'ppsx','srt', 'docx'
      );

$black_list= array(
      /*HTML may contain cookie-stealing JavaScript and web bugs*/
      'text/html', 'text/javascript', 'text/x-javascript',  'application/x-shellscript',
      /*PHP scripts may execute arbitrary code on the server*/
      'application/x-php', 'text/x-php', 'text/x-php',
      /*Other types that may be interpreted by some servers*/
      'text/x-python', 'text/x-perl', 'text/x-bash', 'text/x-sh', 'text/x-csh',
      'text/x-c++', 'text/x-c',
      /*Windows metafile, client-side vulnerability on some systems*/
      'application/x-msmetafile',
      /*A ZIP file may be a valid Java archive containing an applet which exploits the
	same-origin policy to steal cookies*/      
      'application/zip',
      );

$ok=true;
if (!empty($_FILES["file"])) {
   $myFile = $_FILES["file"];
   if ($myFile["error"] !== UPLOAD_ERR_OK) {
      echo "<p>An error occurred.</p>";
      $ok=false;
   }
}
if($ok)
{
   /*ensure a safe filename*/
   $name = preg_replace("/[^A-Z0-9._-]/i", "_", $_FILES["file"]["name"]);
   //get the extension
   $ext = pathinfo($name, PATHINFO_EXTENSION);
   $ext=strtolower($ext);
   if(strlen($ext)==NULL)
   {   
      echo "<p>Error: No length </p>";
      $ok=false;
   }  
   else if ((!$allow_all_types && !in_array($ext,$allowed_types))) {
      echo "<p>Error: File extension is not one of the allowed types.</p>";
      $ok=false;
   }
   if($ok)
   {
      $finfo = new finfo(FILEINFO_MIME, MIME_MAGIC_PATH);
      if ($finfo) {
	 $mime = $finfo->file($name);
      }
      else {
	 $mime=$_FILES["file"]["type"];
      }

      $mime = explode(" ", $mime);
      $mime = $mime[0];
      //echo $mine;

      if (substr($mime, -1, 1) == ";") {
	 $mime = trim(substr($mime, 0, -1));
      }
      if(in_array($mime, $black_list) == true)
      {
	 //echo "<p>Error: File extension is NOT allowed.</p>";
	 $ok=false;
      }

      // don't overwrite an existing file
      $i = 0;
      $parts = pathinfo($name);
      while (file_exists(UPLOAD_DIR . $name)) {
	 $i++;
	 $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	 if($i>2)
	 {
	    echo "<p>Error: Cannot have 3 files of the same name.</p>";
	    $ok=false;
	 }
      }

   }
   //if (($ext == "jpg") && ($_FILES["myFile"]["type"] == "image/jpeg") &&
   //  if(($_FILES["myFile"]["size"] < 3500000)) {
   if($ok)   
   { 
      $success=move_uploaded_file($_FILES["file"]["tmp_name"],
	    "/tmp/" . $name); 
   } 

   if ($_FILES["file"]["error"] > 0)
   {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
   }
   else if($ok)
   {
      if (!$success) {
	 echo "<p>" . $name . "NOT uploaded.</p>";
      }
      else if($success)
      {
	 echo "<p>Successfully uploaded your file.</p>";
	 echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	 echo "File Extention: " . $ext . "<br>";
	 echo "Type: " . $_FILES["file"]["type"] . "<br>";
	 echo "Stored in: " . $_FILES["myFile"]["tmp_name"] . "<br>";  
	 if(($_FILES["file"]["size"] / (1024*1024) )<1)
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	 else
	    echo "Size: " . ($_FILES["file"]["size"] / (1024*1024)) . " MB<br>";
	 // set proper permissions on the new file
	 chmod(UPLOAD_DIR . $name, 0644);
      }
   }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   //something posted

   if (isset($_POST['logout'])) {


      session_start();
      session_unset();
      session_destroy();
      header("location:upload.php");
      exit();
   }
}
if(isset($_GET['back']))
{
   header("location:upload.php");

}

?>
<html>
<head>
<title>File Upload Form</title>
</head>
<body>
<form id="form1" name="form1" method="get" action="getfile1.php">
<p>
<input type="submit" name="logout" id="logout" value="logout" />
</p>
<p>
<input type="submit" name="back" id="back" value="back"/>
</p>
</form>
</form>
</body>
</html>

