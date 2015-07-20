<!DOCTYPE html>
<html lang="en">
<head>

<!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<meta charset="utf-8">
<title>SWSM14</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>



<!-- Flexslider CSS -->
<link rel="stylesheet" href="../../css/demo.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../css/flexslider.css" type="text/css" media="screen" />
<!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="stylesheet" href="../../css/normalize.css">
<link rel="stylesheet" href="../../css/skeleton.css">
<!-- Modernizr -->
<script src="../../js/flexslider/modernizr.js"></script>

<!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>
<!--<body>-->
<body class="loading">

<!-- Nav
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
   <nav>
      <ul>
         <li><a href="../../gui/new/about.html">ABOUT</a></li>
         <li><a href="../../gui/new/projects.html">PROJECTS</a></li>
         <li>
         <a href="index.html">
            <img id="navlogo" src="../../images/logo.png" alt="navagation-logo"></a></li>
         <li><a href="../../gui/new/resume.html">R&Eacute;SUM&Eacute;</a></li>
        <!--
        <li><a href="../../blog">BLOG</a></li>
        -->
         <li><a href="../../gui/new/contact.html">CONTACT</a></li>
      </ul>
   </nav>
<div class="shell spacer">

   <div class="left-col">
      <h1>SWSM14</h1>
      <h4></h4>
      <p>
Description Coming Soon
</p>
      <p><a class="navbuts" href="#"><img src="../../images/css/previous.png" /></a><a class="navbuts" href="#"><img src="../../images/css/next.png" /></a></p>
   </div>

   <div class="left-colmn">

      <div id="main" role="main">
      <section class="slider">
        <div class="flexslider">
          <ul class="slides">
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
      </div>
   </div>
</div>
   <!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="../../js/flexslider/jquery-1.7.min.js">\x3C/script>')</script>

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

   <!-- Syntax Highlighter -->
   <script type="text/javascript" src="../../js/flexslider/shCore.js"></script>
   <script type="text/javascript" src="../../js/flexslider/shBrushXml.js"></script>
   <script type="text/javascript" src="../../js/flexslider/shBrushJScript.js"></script>

   <!-- Optional FlexSlider Additions  (necessary for vimeo)-->
   <script src="../../js/flexslider/froogaloop.js"></script>
   <script src="../../js/flexslider/jquery.fitvid.js"></script>
   <script src="../../js/flexslider/demo.js"></script>

   <!--
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
   </body>
   </html>
