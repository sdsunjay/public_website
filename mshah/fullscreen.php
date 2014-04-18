<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta content="charset=utf-8">
	<title>M Shah</title>
        
<!-- <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">-->

  <!-- Demo CSS -->
        <link rel="stylesheet" href="../../css/demo.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../../css/flexslider.css" type="text/css" media="screen" />
	<!-- Modernizr -->
  <script src="../../js/flexslider/modernizr.js"></script>

  <!-- jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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

      <script src="http://code.jquery.com/jquery-latest.js"></script>
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
<!--
<body class="loading">

<h3>
<a href="fullscreen.php">Fullscreen Mode</a>
</h3>
<h3>
<a href="list.php">List Mode</a>
</h3>

<p>
<a href="http://sunjaydhama.com">Homepage</a>
<p>
<p>
<a href="https://github.com/woothemes/flexslider">Source</a>
<p>
  <div id="container" class="cf">
	<div id="main" role="main">
      <section class="slider">
        <div class="flexslider">
          <ul class="slides">
            <li>-->


<body class="loading">

  <div id="container" class="cf">
    <header role="navigation">
      <a class="logo" href="http://www.mshah.com" title="M Shah">
        <img src="images/logo.jpg" alt="M Shah" />
     </a>
      <h1>M Shah</h1>
      <h2>An up and coming artist from Northern California</h2>
<!--
      <a class="button green" href="https://github.com/woothemes/FlexSlider/zipball/master">Download Flexslider</a>
-->
          
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
          <li class="active"><a href="index.php">Slider</a></li>
          <li><a href="fullscreen.php">Fullscreen Mode</a></li>
          <li><a href="list.php">List Mode</a></li>
          <li><a href="http://sunjaydhama.com">Sunjay's Homepage</a></li>
          <li><a href="https://github.com/woothemes/flexslider">Source</a></li>
<!--
          <li><a href="carousel-min-max.html">Carousel with min and max ranges</a></li>
          <li><a href="dynamic-carousel-min-max.html">Carousel with dynamic min/max ranges</a></li>
          <li><a href="video.html">Video & the api (vimeo)</a></li>
          <li><a href="video-wistia.html">Video & the api (wistia)</a></li>
-->    
    </ul>
      </nav>
    </header>

   <div id="main" role="main">
      <section class="slider">
        <div class="flexslider">
          <ul class="slides">
               <?php
               //$dir_open = opendir('../../../mshah');

               $files = glob("./images/[fF]*.{jpg,png,gif,bmp}", GLOB_BRACE);
               for ($i=0; $i<count($files); $i++)
               {
                  $num = $files[$i];
                  echo '<li><img src="'.$num.'" alt="M Shah Performing"/></li>';
               }
               /*$dir_open = opendir('images');

               while(false !== ($filename = readdir($dir_open))){
                  if (exif_imagetype($filename) != IMAGETYPE_JPEG) {
                     //echo $filename .' is not a picture <br>';
                  }
                  else
                  {
                     if($filename != "." && $filename != ".."){
                        $link = "<li><img src='./$filename' alt='M Shah performing'/></li>";
                        echo $link;
                     }
                  }
               }
               closedir($dir_open);
                */
?>
          </ul>
        </div>
      </section>
   </div>
</div>
 </ul>
</body>
</html>
