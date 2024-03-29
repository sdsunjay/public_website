<!DOCTYPE html>
<html lang="en">
<head>

<!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<meta charset="utf-8">
<title>KARMIK</title>
<meta name="description" content="">
<meta name="author" content="Sunjay Dhama">

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
<link rel="icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">


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
         <a href="../../gui/new/index.html">
            <img id="navlogo" src="../../images/logo.png" alt="navagation-logo"></a></li>
         <li><a href="../../gui/new/resume.html">R&Eacute;SUM&Eacute;</a></li>
         <li><a href="../../gui/new/contact.html">CONTACT</a></li>
      </ul>
   </nav>
<div class="shell spacer">

   <div class="left-col">
      <h1>Karmik</h1>
      <h4></h4>
      <p>Startup Weekend SLO 2014 was my 3rd Startup Weekend SLO event. I wanted to try to learn a new language. Ian Mitchel is an awesome developer and I wanted to team up with him. He introduced my to Ashley McCarter. Ashley's idea was that in this growing sharing economy, people are more willing to shae, but also trade. She thought it would be easy to have people with a need connect to others with a skill to get a job done. For example, instead of Ashley paying a babysitter for an hour of babysitting her children, instead she could clean their house for an hour or teach them a sport or instrument for an hour. I also liked this idea, so Ian and I worked on a Ruby on Rails application to facilitate that. Voila, Karmik was born. 
</p>
<p><a class="navbuts" href="../RS/rs.html"><img src="../../images/css/previous.png" /></a><a class="navbuts" href="../swsb14/index.html"><img src="../../images/css/next.png" /></a></p>
   </div>

   <div class="left-colmn">

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
