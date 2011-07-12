<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>

  <div class="index_blog">
    <div id="centercol">
    <div class="box post full">
      <h2>Archives by Month:</h2>
      <div class="content border">
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </div>
      <h2>Archives by Subject:</h2>
      <div class="content border">
        <ul>
          <?php wp_list_categories(); ?>
        </ul>
      </div>
      <!--/content -->
    </div>
    <!--/box -->
  </div>
  <!--/centercol -->
  <?php get_sidebar(); ?>
  <div class="clr"></div>
</div>
<!--/columns -->
<?php get_footer(); ?>
