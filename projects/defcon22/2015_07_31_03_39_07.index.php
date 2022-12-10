<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta content="charset=utf-8">
	<title>DEFCON22</title>
        
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

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
// Can also be used with $(document).ready()
  // $('.flexslider').flexslider({
  //    animation: "slide"
 //  });
//});

$(window).load(function() {
// Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
$(".flexslider")
//   .fitVids()
   .flexslider({
      animation: "slide",
         useCSS: false,
         animationLoop: false,
         smoothHeight: true,
         start: function(slider){
           $('body').removeClass('loading');
         },
        /*    before: function(slider){
               $f(player).api('pause');
   }*/
   });
    });
  </script>
</head>
<body class="loading">

  <div id="container" class="cf">
    <header role="navigation">
      <a class="logo" href="https://www.sunjaydhama.com/projects/defcon22" title="DEFCON22">
        <img src="logo.jpg" alt="Defcon 22" />
          </a>
      <h1>DEFCON 22</h1>
  <h3 class="nav-header">More about DEFCON22</h3>
      <nav>
        <ul>
        
 <li><a href="https://www.defcon.org/">Official DEFCON Hacking Conference</a></li>  
    </ul>
      </nav>
  <h3 class="nav-header">Other</h3>
      <nav>
        <ul>
<!--
          <li class="active"><a href="index.php">Slider</a></li>
          <li><a href="fullscreen.php">Fullscreen Mode</a></li>
//list doesn't work right now... probably not enough memory on the server to display images
            <li><a href="list.php">List Mode</a></li>
-->          
           <li><a href="https://sunjaydhama.com/gui/images.html">Project Images</a></li>
           <li><a href="https://sunjaydhama.com/gui/projects.html">Projects</a></li>
           <li><a href="https://sunjaydhama.com">Sunjay's Homepage</a></li>
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
$files = glob("./images/*.{jpg,JPG,png,gif,bmp}", GLOB_BRACE);
for ($i=0; $i<count($files); $i++)
{
   $num = $files[$i];
   echo '<li><img src="'.$num.'" alt="my team"/></li>';
}?>
          </ul>
        </div>
      </section>
      <!--  Optional FlexSlider Additions -->
    <script src="../../js/flexslider/froogaloop.js"></script>
        <script src="../../js/flexslider/jquery.fitvid.js"></script>
        <script src="../../js/flexslider/demo.js"></script>


  <!-- Syntax Highlighter -->
  <script type="text/javascript" src="../../js/flexslider/shCore.js"></script>
  <script type="text/javascript" src="../../js/flexslider/shBrushXml.js"></script>
  <script type="text/javascript" src="../../js/flexslider/shBrushJScript.js"></script>

  <!-- Optional FlexSlider Additions -->
  <script src="../../js/flexslider/jquery.easing.js"></script>
  <script src="../../js/flexslider/jquery.mousewheel.js"></script>
  <script defer src="../../js/flexslider/demo.js"></script>
</body>
</html>