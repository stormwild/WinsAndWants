<?php get_header(); ?>

  <div class="index_blog">
    <div id="centercol">
    <div class="box post">
      <div class="post-block">
        <div class="post-title">
          <?php if (have_posts()) : ?>
          <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
          <?php /* If this is a category archive */ if (is_category()) { ?>
          <h1>Category: <span>
            <?php single_cat_title(); ?>
            </span></h1>
          <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
          <h1>Tag: <span>
            <?php single_tag_title(); ?>
            </span></h1>
          <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
          <h1>Archive: <span>
            <?php the_time('F jS, Y'); ?>
            </span></h1>
          <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
          <h1>Archive: <span>
            <?php the_time('F, Y'); ?>
            </span></h1>
          <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
          <h1>Archive: <span>
            <?php the_time('Y'); ?>
            </span></h1>
          <?php /* If this is an author archive */ } elseif (is_author()) { ?>
          <h1>Author Archive</h1>
          <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <h1>Blog Archives</h1>
            <?php } ?>
          <?php endif; ?>
        </div>
        <div class="content"></div>
        <div class="clr"></div>
      </div>
    </div>
    <?php if (have_posts()) : ?>
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
      <div class="content">
        <div class="post-title">
          <h1>No Posts Were Found</h1>
        </div>
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
