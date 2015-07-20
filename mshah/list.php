
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

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="../../css/lightbox/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="../../css/lightbox/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="../../css/lightbox/jquery.fancybox-media.js?v=1.0.6"></script>
<!--
<script type="text/javascript">
$(document).ready(function() {
   $(".fancybox").fancybox();
               });</script>
                  -->
                     <style>article, aside, figure, footer, header, hgroup,menu, nav, section { display: block; }

  body {
     display: inline;
     text-align: left;
  }
</style>


   <meta content="charset=utf-8">
   <title>M Shah</title>

   <!-- <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">-->

   <!-- Demo CSS -->
   <link rel="stylesheet" href="../../css/demo.css" type="text/css" media="screen" />
   <link rel="stylesheet" href="../../css/flexslider.css" type="text/css" media="screen" />
   <!-- Modernizr -->
   <script src="../../js/flexslider/modernizr.js"></script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../js/flexslider/libs/jquery-1.7.min.js">\x3C/script>')</script>

<!-- FlexSlider -->
<script defer src="../../js/flexslider/jquery.flexslider.js"></script>

<script type="text/javascript">
$(function(){
   SyntaxHighlighter.all();
});
$(window).load(function(){
   $('.flexslider').flexslider({
      animation: "slide",
         start: function(slider){
            $('body').removeClass('loading');
         }
   });
});
</script>

      <script src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" language="JavaScript">
function set_body_height()
{
   var wh = $(window).height();
   $('body').attr('style', 'height:' + wh + 'px;');
}
$(document).ready(function() {
   set_body_height();
   $(window).bind('resize', function() { set_body_height(); });
});
</script>

  <!-- Syntax Highlighter -->
  <script type="text/javascript" src="../../js/flexslider/shCore.js"></script>
  <script type="text/javascript" src="../../js/flexslider/shBrushXml.js"></script>
  <script type="text/javascript" src="../../js/flexslider/shBrushJScript.js"></script>

  <!-- Optional FlexSlider Additions -->
  <script src="../../js/flexslider/jquery.easing.js"></script>
  <script src="../../js/flexslider/jquery.mousewheel.js"></script>
  <script defer src="../../js/flexslider/demo.js"></script>

   </head>
   <body>

  <div id="container" class="cf">
    <header role="navigation">
      <a class="logo" href="https://www.mshah.com" title="M Shah">
        <img src="logo.jpg" alt="M Shah" />
     </a>
      <h1>M Shah</h1>
      <h2>An up and coming artist from Northern California</h2>

  <h3 class="nav-header">More M Shah</h3>
      <nav>
        <ul>
          <li><a href="https://soundcloud.com/mshahmusic">SoundCloud</a></li>
          <li><a href="https://www.facebook.com/MShahMusic">Faceboook</a></li>
        </ul>
      </nav>
  <h3 class="nav-header">Other</h3>
      <nav>
        <ul>
          <li class="active"><a href="index.html">Slider</a></li>
          <li><a href="fullscreen.php">Fullscreen Mode</a></li>
          <li><a href="list.php">List Mode</a></li>
          <li><a href="https://sunjaydhama.com">Sunjay's Homepage</a></li>
          <li><a href="https://github.com/woothemes/flexslider">Source</a></li>
    </ul>
      </nav>
    </header>

<?php
$dir_open = opendir('.');

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
   </body>

</div>

</div>
</html>


