<?php get_header(); ?>

<div class="index_blog">
  <div id="centercol">
    <?php $urlHome = get_bloginfo('template_directory'); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
          <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
        </div>
        <!--/post-excerpt -->
      </div>
      <!--/content -->
    </div>
    <!--/box -->
    <div class="clr"></div>
    <div class="box post">
      <div class="content border">
        <div class="pic fl"><?php echo get_avatar(get_the_author_email(), $size = '80', $default = $urlHome . '/images/avatar.gif' ); ?></div>
        <div class="post-author">
          <div class="author-descr">
            <h3>
              <?php the_author(); ?>
            </h3>
            <p>
              <?php the_author_description(); ?>
            </p>
            <div class="author-details"><a href="<?php the_author_url(); ?>" target="_blank">Visit Authors Website</a> &nbsp;|&nbsp; <a href="<?php bloginfo('url'); ?>/author/<?php echo strtolower(get_the_author_nickname()); ?>">All Articles From This Author</a></div>
          </div>
          <!--/author-descr -->
        </div>
        <!--/post-author -->
        <div class="clr"></div>
      </div>
      <!--/content -->
      <div class="clr"></div>
    </div>
    <!--/box -->
    <div id="respond" class="box" style="padding:10px 0;">
      <div class="content border">
        <div class="fl">If you enjoyed this article, please consider sharing it!</div>
        <div class="fr"><a href="http://del.icio.us/post?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" title="Bookmark at Delicious" rel="nofollow" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/ico-soc1.gif" alt="Icon" /></a> <a href="http://www.mixx.com/submit?page_url=<?php the_permalink() ?>" title="Bookmark at Mixx" rel="nofollow" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/ico-soc2.gif" alt="Icon" /></a> <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" title="Bookmark at StumbleUpon" rel="nofollow" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/ico-soc3.gif" alt="" /></a> <a href="http://digg.com/submit?phase=2&url=<?php the_permalink() ?>&title=<?php the_title(); ?>" title="Bookmark at Digg" rel="nofollow" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/ico-soc4.gif" alt="Icon" /></a> </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
    <!--/box -->
    <div class="box post-rel">
      <div class="content border">
        <div class="subcols">
          <div class="col1">
            <h2>Related Posts</h2>
            <?php
			$results = $wpdb->get_results(yarpp_sql(array('post'),array()));
			foreach ( (array) $results as $_post ) :  
			$_post = get_post($_post->ID);  ?>
            <div class="th fl"><a href="<?php echo get_permalink($_post->ID); ?>"><img src="<?php echo get_post_meta($_post->ID, 'post-img', true); ?>" alt="" /></a></div>
            <div><a href="<?php echo get_permalink($_post->ID); ?>"><?php echo $_post->post_title; ?></a></div>
            <div class="hl2"></div>
            <?php endforeach; ?>
          </div>
          <!--/col1 -->
          <div class="col2">
            <h2>Popular Posts</h2>
            <?php
				foreach ( (array) taccess_popular_posts() as $_post ) : ?>
            <div class="th fl"><a href="<?php echo get_permalink($_post->ID); ?>"><img src="<?php echo get_post_meta($_post->ID, 'post-img', true); ?>" alt="" /></a></div>
            <div><a href="<?php echo get_permalink($_post->ID); ?>"><?php echo $_post->post_title; ?></a></div>
            <div class="hl2"></div>
            <?php endforeach; ?>
          </div>
          <!--/col1 -->
        </div>
        <div class="clr"></div>
        <!--/subcols -->
      </div>
      <!--/content -->
    </div>
    <!--/box -->
    <?php comments_template(); ?>
    <?php endwhile; else: ?>
    <p>Sorry, no posts matched your criteria.</p>
    <?php endif; ?>
  </div>
  <!--/centercol -->
  <?php get_sidebar(); ?>
  <div class="clr"></div>
</div>
<!--/columns -->
<?php get_footer(); ?>
