<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<title>
<?php if (is_home()) { ?>
<?php bloginfo('name'); ?>
-
<?php bloginfo('description'); ?>
<?php } else { ?>
<?php wp_title($sep = ''); ?>
-
<?php bloginfo('name'); ?>
<?php } ?>
</title>
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<meta name="description" content="<?php bloginfo('description') ?>" />
<?php if(is_search()) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php }?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/coin-slider-styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/menusm.css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.4.2.min.js"></script>
<!-- slider -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/coin-slider.min.js"></script>
<!-- cufon -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cufon-yankaff.js"></script>
<!-- menu -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/menusm.js"></script>
<!-- tabs-categories -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabs-hoverintent.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabs-superfish.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabs.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/tabs.css" type="text/css" media="screen" />
<!-- scripts for use -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
<?php wp_head(); ?>
</head>
<body>
<div id="page">
<div id="header">
  <div class="logo">
    <h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
      <?php bloginfo('name'); ?>
      <small class="slogan">
      <?php bloginfo('description'); ?>
      </small></a></h1>
  </div>
  <div class="topnav">
    <ul class="menusm">
      <?php wp_list_pages('title_li='); ?>
    </ul>
    <div class="clr"></div>
  </div>
  <!--/topnav -->
  <div class="clr"></div>
  <?php if (is_front_page()) { ?>
  <div class="slider">
    <div id="coin-slider"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide1.jpg" width="960" height="260" alt="slide1" /><span><big>Praesent vitae felis metus</big> <small>Sed pretium, nulla eget luctus adipiscing, eros nisi aliquam elit, ut vulputate sem libero sed mauris.</small></span></a> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide2.jpg" width="960" height="260" alt="slide2" /><span><big>Quisque fermentum</big> <small>Eros sit amet consequat scelerisque, velit quam commodo libero, nec pretium mauris magna nec augue.</small></span></a> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide3.jpg" width="960" height="260" alt="slide3" /><span><big>Morbi mi risus</big> <small>Ut venenatis auctor lacus, quis gravida erat porttitor vel. Aliquam erat volutpat. Duis et mi lorem.</small></span></a> </div>
  </div>
  <div class="clr"></div>
  <div class="underslider">
    <p class="us_text">Hello &amp; Welcome to Cleanfolio.<br />
      Stylish Web is a modern High quality HTML/CSS coded Template.</p>
    <p class="us_but"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/button_tour.jpg" width="139" height="48" alt="Take a Tour" /></a></p>
    <div class="clr"></div>
  </div>
  <?php } else { ?>
  <div class="pagetitle">
    <h2>Blog</h2>
    <div class="search">
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>
    </div>
    <!--/searchform -->
    <div class="clr"></div>
  </div>
  <?php } ?>
  <div class="clr"></div>
</div>
<!--/header-->
