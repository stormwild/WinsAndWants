<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

<p>This post is password protected. Enter the password to view comments.</p>
<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'alt';
?>
<?php if ( $comments ) : ?>
<!-- You can start editing here. -->
<?php $urlHome = get_bloginfo('template_directory'); ?>
<div class="box full post-comments" id="comments">
  <div class="content border">
    <h2>
      <?php comments_number('No Responses', 'One Response', '% Responses' );?>
    </h2>
    <?php foreach ($comments as $comment) : ?>
    <div id="comment-<?php comment_ID() ?>" class="fl ar post-comment-block">
      <div class="pic"><?php echo get_avatar( $comment, 80, $default = $urlHome . '/images/default_avatar_visitor.gif' ); ?></div>
      <div class="comm-name"><a href="<?php comment_author_url(); ?>" target="_blank">
        <?php comment_author(); ?>
        </a></div>
      <div class="comm-date"><small><em>
        <?php the_time('m.d.y') ?>
        </em></small></div>
    </div>
    <div class="fr">
      <div class="box2 <?php echo $oddcomment; ?>">
        <?php comment_text() ?>
      </div>
      <!--/box2 -->
    </div>
    <div class="clr"></div>
    <?php $oddcomment = ( empty( $oddcomment ) ) ? 'alt' : ''; ?>
    <?php endforeach; // end for each comment ?>
  </div>
  <!--/content -->
  <div class="clr"></div>
</div>
<!--/box -->
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<div id="respond" class="box full post-comments">
  <div class="content border">
    <h2>Leave Your Response</h2>
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
    <div class="fl">
      <div class="pic"><img src="<?php bloginfo('template_directory'); ?>/images/default_avatar_visitor.gif" alt="" /></div>
    </div>
    <div class="fr">
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <fieldset class="message">
          <?php if ( $user_ID ) : ?>
          <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
          <?php else : ?>
          <div>
            <input name="author" id="author" type="text" value="Your Name" onclick="this.value='';" />
          </div>
          <div>
            <input name="email" id="email" type="text" value="Your Email" onclick="this.value='';" />
          </div>
          <div>
            <input name="url" id="url" type="text" value="Your Website" onclick="this.value='';" />
          </div>
          <?php endif; ?>
          <div class="textarea">
            <textarea name="comment" id="comment" cols="" rows="">Your Comments</textarea>
          </div>
          <div class="submit">
            <input name="submit" id="submit" type="submit" value="Send" class="btn"  />
          </div>
          <div class="notice">* Name, Email, Comment are Required</div>
          <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
          <?php do_action('comment_form', $post->ID); ?>
        </fieldset>
      </form>
      <?php endif; // If registration required and not logged in ?>
    </div>
    <div class="clr"></div>
  </div>
  <!--/content -->
</div>
<!--/box -->
<?php endif; // if you delete this the sky will fall on your head ?>
