<?php get_header(); ?>

  <div class="index_blog">
    <div id="centercol">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="box post full" id="post-<?php the_ID(); ?>">
      <div class="post-block">
        <div class="post-title">
          <h1>
            <?php the_title(); ?>
          </h1>
        </div>
      </div>
      <!--/post-title -->
      <div class="content border">
        <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
        <!--/post-excerpt -->
      </div>
      <!--/content -->
    </div>
    <!--/box -->
    <?php endwhile; endif; ?>
  </div>
  <!--/centercol -->
  <?php get_sidebar(); ?>
  <div class="clr"></div>
</div>
<!--/columns -->
<?php get_footer(); ?>
