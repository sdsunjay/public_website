<!DOCTYPE html>
<html lang="en">
<head>

<!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<title>Tweetonomics</title>
<meta name="author" content="Sunjay Dhama">

<!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">

<!-- Meta Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

<meta charset="utf-8">
<meta name="keywords" content="Sunjay, Dhama, Cal, Poly, California, Polytechnic, San Luis Obispo, Obispo, Software, Engineering, Computer, Science, Android, Security, C, C++, Java, Javascript, Python, CUDA, Terminal, HTML,CSS,JavaScript,PHP">
<meta name="description" content="Distributed WPA/2 Cracker Leveraging EC2 GPU Instances ">
<meta name="author" content="Sunjay Dhama">
<meta content="images/favicon.ico" itemprop="image">
<meta https-equiv="content-type" content="text/html; charset=utf-8" />

<!-- SEO -->
<link rel="canonical" href="https://sunjaydhama.com/" />

<!-- Facebook -->
<meta property="og:image" content="https://sunjaydhama.com/images/about.jpg"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="DWPACLEC2"/>
<meta property="og:url" content="https://sunjaydhama.com/"/>
<meta property="og:site_name" content="sunjaydhama.com"/>
<meta property="og:description" content="I'm a Software Engineer and am passionate about Machine Learning, currently based in Seattle, Washington."/>
<meta property=”og:locale” content=”en_US” />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="@sdsunjay">
<meta name="twitter:title" content="Sunjay Dhama">
<meta name="twitter:description" content="I'm a Software Engineer and am passionate about Machine Learning, currently based in Seattle, Washington."/>
<meta name="twitter:image:src" content="https://sunjaydhama.com/images/about.jpg">

<!-- Google+ -->
<meta itemprop="name" content="Sunjay Dhama">
<meta itemprop="description" content="I'm a Software Engineer and am passionate about Machine Learning, currently based in Seattle, Washington.">
<meta itemprop="image" content="https://sunjaydhama.com/images/about.jpg">

<!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>

<!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="stylesheet" href="../../css/normalize.css">
<link rel="stylesheet" href="../../css/skeleton.css">
<!-- specific to the homepage -->

</head>
<body>

<!-- Nav
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<nav>
   <ul>
      <li><a href="../../gui/new/about.html">ABOUT</a></li>
      <li><a href="../../gui/new/projects.html">PROJECTS</a></li>
      <li>
      <a href="../gui/new/index.html">
         <img id="navlogo" src="../../images/logo.png" alt="navagation-logo"></a></li>
      <li><a href="../../gui/new/resume.html">R&Eacute;SUM&Eacute;</a></li>
      <!--
        <li><a href="../../blog">BLOG</a></li>
        -->
      <li><a href="../../gui/new/contact.html">CONTACT</a></li>
   </ul>
</nav>
<!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="shell spacer">

   <div class="left-col">
<body class="loading">

  <div id="container" class="cf">
      <a class="logo" href="https://sunjaydhama.com/projects/swslo13" title="Startup Weekend SLO 2013">
        <img src="../swslo14/logo.png" alt="Startup Weekend SLO 2013" />
          </a>
      <h1>Startup Weekend SLO 2013</h1>
      <h2>No Talk, All Action. Launch a Startup in 54 hours.</h2>
      <h3 class="nav-header">More about Startup Weekend SLO</h3>
        <ul>
          <li><a href="http://mustangnews.net/startup-weekend-slo-brings-ideas-business-to-cal-poly/">Press Release</a></li>
          <!-- 
         Bob must have moved or deleted the blog... it used to be here
          <li><a href="https://www.softec.org/blogs/news_and_announcements/archive/2013/01/28/start-up-weekend-slo.aspx">Softec Blog</a></li>
         --> 
         <li><a href="app.pdf">Detailed Explanation</a></li> 
          <li><a href="http://www.up.co/communities/usa/san-luis-obispo/startup-weekend/5156">Event Page</a></li>
          <li><a href="http://startupweekend.org/">Global Organization</a></li>
         </ul>
  <h3 class="nav-header">Other</h3>
        <ul>
<!--
          <li class="active"><a href="index.php">Slider</a></li>
          <li><a href="fullscreen.php">Fullscreen Mode</a></li>
-->          
            <li><a href="list.php">List Mode</a></li>
           <li><a href="../../gui/images.html">Project Images</a></li>
           <li><a href="../../projects">Projects</a></li>
          <li><a href="../../index.html">Homepage</a></li>
         <li> <a href="../..//gui">GUI</a></li>
          <li><a href="https://github.com/woothemes/flexslider">Source</a></li>
    </ul>
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
