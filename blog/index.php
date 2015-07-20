

<?php

require('../../blog/wp-blog-header.php');
/**
 * The main template file
  *
   * This is the most generic template file in a WordPress theme and one of the
    * two required files for a theme (the other being style.css).
     * It is used to display a page when nothing more specific matches a query.
      * For example, it puts together the home page when no home.php file exists.
       *
        * @link http://codex.wordpress.org/Template_Hierarchy
         *
          * @package WordPress
           * @subpackage Twenty_Thirteen
            * @since Twenty Thirteen 1.0
             */

//get_header();
?>

<html lang="en">
<head>

<!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<title>Sunjay's Blog</title>

<!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <link rel="icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">
            <link rel="shortcut icon" href="https://sunjaydhama.com/images/favicon.ico" type="image/x-icon">

<!-- Meta Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

            <meta charset="utf-8">
            <meta name="keywords" content="Sunjay, Dhama, Blog, Blogging, Cal, Poly, California, Polytechnic, San Luis Obispo, Obispo, Software, Engineering, Computer, Science, Android, Security, C, C++, Java, Javascript, Python, CUDA, Terminal, HTML,CSS,JavaScript,PHP">
            <meta name="description" content="Sunjay's Blog.">
            <meta name="author" content="Sunjay Dhama">
            <meta content="images/favicon.ico" itemprop="image">
            <meta https-equiv="content-type" content="text/html; charset=utf-8" />

<!-- SEO -->
<link rel="canonical" href="https://www.sunjaydhama.com/" />

<!-- Facebook -->
<meta property="og:image" content="https://www.sunjaydhama.com/images/selfie.jpg"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Sunjay Dhama's Blog"/>
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

<!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="stylesheet" href="../../css/normalize.css">
<link rel="stylesheet" href="../../css/skeleton.css">

</head>
<body>

<!-- Header
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

<!-- Nav
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
   <nav>
      <ul>
         <li><a href="about.html">ABOUT</a></li>
         <li><a href="projects.html">PROJECTS</a></li>
         <li>
         <a href="index.html">
            <img id="navlogo" src="../../images/logo.png" alt="navagation-logo"></a></li>
         <li><a href="resume.html">R&Eacute;SUM&Eacute;</a></li>
        <!--
        <li><a href="../../blog">BLOG</a></li>
        -->
         <li><a href="contact.html">CONTACT</a></li>
      </ul>
   </nav>
<div class="container">
   <div id="primary" class="content-area">
      <div id="content" class="site-content" role="main">
      <?php if ( have_posts() ) : ?>

               <?php /* The Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
         <?php endwhile; ?>

         <?php twentythirteen_paging_nav(); ?>

      <?php else : ?>
                  <?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>

      </div><!-- #content -->
            </div><!-- #primary -->
               </div><!-- #container -->
</body>
</html>
<?php //get_sidebar(); ?>
<?php //get_footer(); ?>
