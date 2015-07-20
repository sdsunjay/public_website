<!DOCTYPE html>
<html lang="en">
<head>

<!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<title>Karmik</title>
<!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">


<!-- Meta Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

            <meta charset="utf-8">
            <meta name="keywords" content="Sunjay, Dhama, Cal, Poly, California, Polytechnic, San Luis Obispo, Obispo, Software, Engineering, Computer, Science, Android, Security, C, C++, Java, Javascript, Python, CUDA, Terminal, HTML,CSS,JavaScript,PHP">
            <meta name="description" content="Sunjay's Karmik">
            <meta name="author" content="Sunjay Dhama">
            <meta https-equiv="content-type" content="text/html; charset=utf-8" />
            
            <!-- ROBOTS -->
            <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">

<!-- SEO -->
<link rel="canonical" href="https://www.sunjaydhama.com/" />

<!-- Facebook -->
<meta property="og:image" content="https://www.sunjaydhama.com/images/selfie.jpg"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Karmik Homepage"/>
<meta property="og:url" content="https://www.sunjaydhama.com/"/>
<meta property="og:site_name" content="sunjaydhama.com"/>
<meta property="og:description" content="I'm a Software Engineer and am passionate about security, currently based in San Luis Obispo, California."/>
<meta property=”og:locale” content=”en_US” />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="@sdsunjay">
<meta name="twitter:title" content="Sunjay Dhama">
<meta name="twitter:description" content="I'm a Software Engineer and am passionate about security, currently based in San Luis Obispo, California."/>
<meta name="twitter:image:src" content="https://www.sunjaydhama.com/images/selfie.jpg">

<!-- Google+ -->
<meta itemprop="name" content="Sunjay Dhama">
<meta itemprop="description" content="I'm a Software Engineer and am passionate about security, currently based in San Luis Obispo, California.">
<meta itemprop="image" content="https://www.sunjaydhama.com/images/selfie.jpg">

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


<!--
<style>article, aside, figure, footer, header, hgroup,menu, nav, section { display: block; }
  
  body {
    display: inline;
    text-align: left;
  }
</style>
--> 
</head>
<body class="loading">


<!-- Nav
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<nav class="nav">
   <ul class="nav-list">
      <li class="nav-item"><a href="about.html">ABOUT</a></li>
      <li class="nav-item"><a href="projects.html">PROJECTS</a></li>
      <li class="nav-item">
         <a href="index.html">
         <img src="../../images/logo.png" alt="navagation-logo"></a>
         </a>
      </li>
      <li class="nav-item"><a href="resume.html">R&Eacute;SUM&Eacute;</a></li>
      <li class="nav-item"><a href="contact.html">CONTACT</a></li>
   </ul>
</nav>


<div class="shell spacer">

   <div class="left-col">
      <h1>KARMIK</h1>
      <h4></h4>
      <p>List mode for Karmik</p>
      <p><a class="navbuts" href="#"><img src="../../images/css/previous.png" /></a><a class="navbuts" href="#"><img src="../../images/css/next.png" /></a></p>
   </div>

   <div class="left-colmn">

      <div id="main" role="main">
<?php



$dir_open = opendir('images/.');

while(false !== ($filename = readdir($dir_open))){

   if (is_dir('images/' . $filename)) {

     // $directories.= "<a href='images/$filename'> $filename <br>";  
   }
   else
   {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if(strcmp($ext,"php")===0)
      {
         $files.= "<a href='images/$filename'> $filename <br>";  
      }
      else if(strcmp($ext,"html")===0)
      {
         $files.= "<a href='images/$filename'> $filename <br>";  
      }
      else if($filename != "." && $filename != ".."){
         $link = "<p><img height='500' src='images/$filename' alt='$filename'/><br><a href='images/$filename'> $filename </a><br/></p>";
         echo $link;
      }
   }
}
closedir($dir_open);
?>
<!-- Scripts -->

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

   </body>


</html>


