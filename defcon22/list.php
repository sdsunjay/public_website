
<!DOCTYPE>
<html>
   <head>
      <!-- Add jQuery library -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>

      <!-- Add fancyBox -->
      <link rel="stylesheet" href="../../css/lightbox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
      <script type="text/javascript" src="../../css/lightbox/jquery.fancybox.pack.js?v=2.1.5"></script>


      <link rel="stylesheet" href="../../css/lightbox/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
      <script type="text/javascript" src="../../css/lightbox/jquery.fancybox-thumbs.js?v=1.0.7"></script>

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
<?php
// Open a known directory, and proceed to read its contents
$dir_open = opendir('/images/');
//$dir_open = opendir('.');

#declare stuff
$dirs="";
$files="";

while(false !== ($filename = readdir($dir_open))){
   if (is_dir($filename)) {
      $dirs.= "<a href='./$filename'> $filename <br>";  
   }
   else if (exif_imagetype($filename) != IMAGETYPE_JPEG) {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //$exts .=$ext."<br>";
      if(strcmp($ext,"php")!==0)
      {
         $files.= "<a href='./$filename'> $filename <br>";  
      }
   }
   else
   {
      if($filename != "." && $filename != ".."){
        //I dont have the large pictures...maybe in the future
         //$link = "<a class='fancybox' rel='group' href='large/$filename'><p><img src='./$filename' alt='$filename'/><br><a href='./$filename'> $filename </a><br><br> </p>";
         $link = "<p><img src='./$filename' alt='$filename' /><br><a href='./$filename'> $filename </a><br><br> </p>";
         echo $link;
      }
   }
}
closedir($dir_open);
?>
      <!-- <a class="fancybox" rel="group" href="big_image_2.jpg"><img src="small_image_2.jpg" alt="" /></a>-->
   </body>


</html>


