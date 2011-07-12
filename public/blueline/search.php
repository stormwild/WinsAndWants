<?php get_header(); ?>

  <div class="index_blog">
    <div id="centercol">
    <?php if (have_posts()) : ?>
    <div class="box post">
      <div class="post-block">
        <div class="post-title full">
          <h1>Search Results For: <span><?php echo $s; ?></span></h1>
        </div>
      </div>
      <div class="content"></div>
      <div class="clr"></div>
    </div>
    <?php while (have_posts()) : the_post(); ?>
    <div class="box post" id="post-<?php the_ID(); ?>">
      <div class="content">
        <div class="post-title">
          <h2><a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>">
            <?php the_title(); ?>
            </a></h2>
        </div>
        <!--/post-title -->
        <?php $postimageurl = get_post_meta($post->ID, 'post-img', true); if ($postimageurl) { ?>
        <div class="pic"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $postimageurl; ?>" alt="<?php the_title_attribute(); ?>" /></a></div>
        <?php } ?>
        <!--/post-img -->
        <div class="post-date">On
          <?php the_time('m.d.y'); ?>
          , In
          <?php the_category(', ') ?>
          , by
          <?php the_author_posts_link(); ?>
        </div>
        <div class="comm_count">
          <?php _e('Comments'); ?>
          <a href="<?php the_permalink(); ?>" title="View all posts in <?php _e('Comments'); ?>" rel="category tag">(
          <?php comments_number(0, 1, '%'); ?>
          )</a></div>
        <!--/post-date -->
        <div class="post-excerpt">
          <?php the_excerpt(); ?>
        </div>
        <!--/post-excerpt -->
        <div class="post-leav"><a href="<?php the_permalink(); ?>" title="<?php _e('Leave Your'); ?> Response">
          <?php _e('Comments'); ?>
          &raquo;</a></div>
        <div class="clr"></div>
      </div>
      <!--/content -->
    </div>
    <!--/box -->
    <?php endwhile; ?>
    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
    <?php /*
        <ul>
			<li><?php next_posts_link('&laquo; Older Entries') ?></li>
			<li><?php previous_posts_link('Newer Entries &raquo;') ?></li>
		</ul>
		*/ ?>
    <?php else : ?>
    <div class="box post">
      <div class="post-title">
        <h1>Search Results For Keyword: '<span><?php echo $s; ?></span>'</h1>
      </div>
      <div class="content">
        <p style="padding:20px 0 0 0;">No posts were found. Please try using a different keyword in your search.</p>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <!--/centercol -->
  <?php get_sidebar(); ?>
  <div class="clr"></div>
</div>
<!--/columns -->
<?php get_footer(); ?>
