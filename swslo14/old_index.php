<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta content="charset=utf-8">
	<title>SWSLO14</title>
        
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
      <h1>Startup Weekend SLO 2014</h1>
<h2>
No Talk, All Action. Launch a Startup in 54 hours.</h2>
<!--
      <a class="button green" href="https://github.com/woothemes/FlexSlider/zipball/master">Download Flexslider</a>
-->
          
  <h3 class="nav-header">More about Startup Weekend SLO</h3>
      <nav>
        <ul>
          <li><a href="http://slo.startupweekend.org/">Event Page</a></li>
          <li><a href="http://startupweekend.org/">Global Organization</a></li>
        </ul>
      </nav>
  <h3 class="nav-header">Other</h3>
      <nav>
        <ul>
<!--
          <li class="active"><a href="index.php">Slider</a></li>
          <li><a href="fullscreen.php">Fullscreen Mode</a></li>
          <li><a href="list.php">List Mode</a></li>-->
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
            <li>
               <?php
               //$dir_open = opendir('../../../mshah');
               $dir_open = opendir('.');

               while(false !== ($filename = readdir($dir_open))){
                  if (exif_imagetype($filename) != IMAGETYPE_JPEG) {
                     //echo $filename .' is not a picture <br>';
                  }
                  else
                  {
                     if($filename != "." && $filename != ".."){
                        $link = "<li><img src='./$filename'/></li>";
                        echo $link;
                     }
                  }
               }
               closedir($dir_open);
               ?>
                        </li>
          </ul>
        </div>
      </section>
   </div>
</div>
 </ul>
</body>
</html>
