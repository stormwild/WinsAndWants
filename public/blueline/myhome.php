<?php
/*
Template Name: MyHome
*/
?>
<?php get_header(); ?>

<div id="columns">
  <div class="index-cols">
    <div class="content">
      <div class="post-title">
        <h2><a href="#">Our Services</a></h2>
      </div>
      <div class="index-col1"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/icon1.png" width="36" height="36" alt="image" /></a>
        <h3><a href="#">Help and support</a></h3>
        <p>Vestibulum sit amet neque eu neque suscipit consequat quis vel risus.</p>
        <p><a href="#" class="index_rm">continue reading &raquo;</a></p>
      </div>
      <div class="index-col2"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/icon2.png" width="36" height="36" alt="image" /></a>
        <h3><a href="#">What we do</a></h3>
        <p>Praesent fringilla, eros et tristique tempus, libero metus</p>
        <p><a href="#" class="index_rm">continue reading &raquo;</a></p>
      </div>
      <div class="index-col3"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/icon3.png" width="36" height="36" alt="image" /></a>
        <h3><a href="#">Special event</a></h3>
        <p>Curabitur blandit odio eget odio eleifend vel mattis augue convallis.</p>
        <p><a href="#" class="index_rm">continue reading &raquo;</a></p>
      </div>
      <div class="index-col4"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/icon3.png" width="36" height="36" alt="image" /></a>
        <h3><a href="#">Special package</a></h3>
        <p>Ut dapibus est id odio pretium blandit in eget leo. Aliquam erat volutpat.</p>
        <p><a href="#" class="index_rm">continue reading &raquo;</a></p>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="search">
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>
  </div>
  <div class="graybox">
    <p><big>Your company's welcome message or slogan. Lorem ipsum dolor sit amet, consectur el.</big><br />
      Donec metus lacus, porta id, auctor sit amet, aliquam eu, lacus. Quisque sagittis vulputate orci.</p>
  </div>
  <!--/searchform -->
  <div class="clr"></div>
  <div class="index-cols">
    <div class="content">
      <div class="index-left">
        <div class="post-title">
          <h2><a href="#">Welcome</a></h2>
        </div>
        <img src="<?php bloginfo('template_directory'); ?>/images/img1.jpg" width="188" height="188" alt="img" />
        <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</h3>
        <p></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Excepteur sint occaecat cupidatat non proident. Lorem ipsum dolor sit amet, consectetur adipisicing elit Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
      </div>
      <div class="index-right">
        <div class="post-title">
          <h2><a href="#">Testimonials</a></h2>
        </div>
        <p>" Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Excepteur sint occaecat cupidatat non proident. "</p>
        <p class="autor">John Doe, Creative Director of <a href="#">Website.com</a></p>
      </div>
      <div class="clr"></div>
    </div>
  </div>
</div>
<!--/columns -->
<?php get_footer(); ?>
