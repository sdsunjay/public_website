<?php

//images extensions 
$allowed_types = array(
      'jpeg', 'bmp', 'png', 'gif', 'tiff', 'jpg');
$black_list= array(
      //HTML may contain cookie-stealing JavaScript and web bugs
      'text/html', 'text/javascript', 'text/x-javascript',  'application/x-shellscript',
      //PHP scripts may execute arbitrary code on the server
      'application/x-php', 'text/x-php', 'text/x-php',
      //Other types that may be interpreted by some servers
      'text/x-python', 'text/x-perl', 'text/x-bash', 'text/x-sh', 'text/x-csh',
      'text/x-c++', 'text/x-c',
      //Windows metafile, client-side vulnerability on some systems
      'application/x-msmetafile',
      //A ZIP file may be a valid Java archive containing an applet which exploits thesame-origin policy to steal cookies
      'application/zip');
   
$ok=true;
/* target directory*/
/*ensure a safe filename*/
$name = $_FILES['uploadedfile']['name'];
//get the extension
/*
$ext = pathinfo($name, PATHINFO_EXTENSION);
$ext=strtolower($ext);
if ((!$allow_all_types && !in_array($ext,$allowed_types))) {
   echo "<p>Error: File extension is not one of the allowed types.</p>";
   $ok=false;
}
if($ok){
$finfo = new finfo(FILEINFO_MIME, MIME_MAGIC_PATH);
if ($finfo) {
   $mime = $finfo->file($name);

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
chmod($name, 0644);
*/

//$name=$_POST['filename'];

$target_path  = "/var/www/pics/image.jpeg";
//$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['uploadedfile']['name']).
        " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}

/*
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
//$target_path = $target_path . basename($name);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['uploadedfile']['name']).
        " has been uploaded";
} else{
   echo "There was an error uploading the file, please try again!";
   echo "Return Code: " . $_FILES["uploaded"]["error"] . "<br />";
}
*/
/*
$icon = mysql_connect("localhost","root","toor");
if(!$icon)
{
       die('Could not connect : ' . mysql_erroe());
}
mysql_select_db("android", $icon)or die("database selection error");
echo json_encode($data);
$tags=$_POST['tags'];
mysql_query("INSERT INTO mobileCloset (tags, lastlame, id, phone, password)
      VALUES ('$tags', '$lastname', '$id', '$phone', '$password')",$icon);
mysql_close($icon);
*/
?>
