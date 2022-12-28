<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta content="charset=utf-8">
	<title>SWSLO14</title>
        
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

</head>
<body class="loading">

  <div id="container" class="cf">
    <header role="navigation">
      <a class="logo" href="https://sunjaydhama.com/projects/swslo14" title="Startup Weekend SLO 2014">
        <img src="logo.png" alt="Startup Weekend SLO 2014" />
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
          <li><a href="https://slo.startupweekend.org/">Event Page</a></li>
          <li><a href="https://startupweekend.org/">Global Organization</a></li>
        </ul>
      </nav>
  <h3 class="nav-header">Other</h3>
      <nav>
        <ul>
<!--
          <li class="active"><a href="index.php">Slider</a></li>
          <li><a href="fullscreen.php">Fullscreen Mode</a></li>
-->        
          <li><a href="list.php">List Mode</a></li>
          <li><a href="https://sunjaydhama.com">Homepage</a></li>
          <li><a href="https://github.com/woothemes/flexslider">Source</a></li>
    </ul>
      </nav>
    </header>
    <div id="main" role="main">
      <section class="slider">
        <div class="flexslider">
          <ul class="slides">
             <li>
              <iframe id="player_1" src="https://player.vimeo.com/video/89825376?api=1&amp;player_id=player_1" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

</li>
<?php
               $files = glob("./images/*.{jpg,png,gif,bmp}", GLOB_BRACE);
               for ($i=0; $i<count($files); $i++)
               {
                  $num = $files[$i];
                  echo '<li><img src="'.$num.'" alt="my team"/></li>';
               }?>
          </ul>
        </div>
      </section>

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

      // Vimeo API nonsense
      var player = document.getElementById('player_1');
      $f(player).addEvent('ready', ready);

      function addEvent(element, eventName, callback) {
        (element.addEventListener) ? element.addEventListener(eventName, callback, false) : element.attachEvent(eventName, callback, false);
      }

      function ready(player_id) {
        var froogaloop = $f(player_id);

        froogaloop.addEvent('play', function(data) {
          $('.flexslider').flexslider("pause");
        });

        froogaloop.addEvent('pause', function(data) {
          $('.flexslider').flexslider("play");
        });
      }


      // Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
      $(".flexslider")
        .fitVids()
        .flexslider({
          animation: "slide",
          useCSS: false,
          animationLoop: false,
          smoothHeight: true,
          start: function(slider){
            $('body').removeClass('loading');
          },
          before: function(slider){
            $f(player).api('pause');
          }
      });
    });
  </script>

   <!-- Syntax Highlighter 
	<script type="text/javascript" src="demo/js/shCore.js"></script>
	<script type="text/javascript" src="demo/js/shBrushXml.js"></script>
	<script type="text/javascript" src="demo/js/shBrushJScript.js"></script>
        -->
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
