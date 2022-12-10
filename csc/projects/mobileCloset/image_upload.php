<?php

$base=$_REQUEST['image'];

$ImageName=$_REQUEST['name'];

copy('test.jpg',$ImageName);

echo $base;

// base64 encoded utf-8 string

 $binary=base64_decode($base);

 // binary, utf-8 bytes

 header('Content-Type: bitmap; charset=utf-8');

// $file = fopen('/tmp/' . $ImageName, 'wb');
$file=fopen('/tmp/image.jpeg','wb');
 //fwrite($file, "hello");
 fwrite($file,$binary);
 fclose($file);

 //echo '<img src=test.jpg>';

 ?>

