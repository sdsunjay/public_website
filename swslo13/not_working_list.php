
<!DOCTYPE>
<html>
   <head>
      <!-- Add jQuery library -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
      <script type="text/javascript">
         $(document).ready(function() {
               $(".fancybox").fancybox();
               });</script>
<style>article, aside, figure, footer, header, hgroup,menu, nav, section { display: block; }
  
  body {
    display: inline;
    text-align: left;
  }
</style>
   </head>
   <body>
<!--
  
For large images
    <a class="fancybox" rel="group" href="large/$filename"><img src="/" alt="" /></a>
-->
<?php
$dir_open = opendir('images./');

#declare stuff
$dirs="";
$files="";

while(false !== ($filename = readdir($dir_open))){
   if (is_dir($filename)) {
         $dirs.= "<a href='./$filename'> $filename <br>";  
   }
   else if (exif_imagetype($filename) != IMAGETYPE_JPEG) {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
   }
   else
   {
      if($filename != "." && $filename != ".."){
         $link = "<p><img src='./images/$filename' alt='$filename'/><br><a href='./images/$filename'> $filename </a><br/></p>";
         echo $link;
      }
   }
}
echo "<h3>Other Media Files</h3>";
echo $files;
echo "<h3>Directories</h3>";
echo $dirs;
closedir($dir_open);
?>
      <!-- <a class="fancybox" rel="group" href="big_image_2.jpg"><img src="small_image_2.jpg" alt="" /></a>-->
   </body>


</html>


