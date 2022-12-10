
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
$dir_open = opendir('images/.');

while(false !== ($filename = readdir($dir_open))){

   if (is_dir('images/' . $filename)) {

     // $directories.= "<a href='images/$filename'> $filename <br>";  
   }
   else
   {
      // else if (exif_imagetype($filename) != IMAGETYPE_JPEG) {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //$exts .=$ext."<br>";
      if(strcmp($ext,"php")===0)
      {
         $files.= "<a href='images/$filename'> $filename <br>";  
      }
      else if(strcmp($ext,"html")===0)
      {
         $files.= "<a href='images/$filename'> $filename <br>";  
      }
      else if($filename != "." && $filename != ".."){
         $link = "<p><img src='images/$filename' alt='$filename'/><br><a href='images/$filename'> $filename </a><br/></p>";
         echo $link;
      }
   }
}
closedir($dir_open);
?>
   </body>


</html>


