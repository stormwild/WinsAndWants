<div id="rightcol">
  <div class="box_r ads">
    <div class="wtitle">
      <h2>
        <?php _e('Advertise'); ?>
      </h2>
    </div>
    <div class="content">
      <?php do_action('ad-minister', array('position' => 'Small Banner', 'limit' => 4)); ?>
      <div class="small_link">
        <div><small><a href="<?php echo get_option('home'); ?>/">
          <?php _e('Learn More About Advertising Here'); ?>
          </a></small></div>
        <div class="clr"></div>
      </div>
    </div>
    <!--/content -->
  </div>
  <!--/box -->
  <div class="box_r">
    <div class="wtitle">
      <h2>
        <?php _e('Navigation'); ?>
      </h2>
    </div>
    <div class="content">
      <ul class="list">
        <li><a href="#" class="active" rel="tabs_category">
          <?php _e('Categories'); ?>
          </a></li>
        <li><a href="#" rel="tabs_archive">
          <?php _e('Archives'); ?>
          </a></li>
        <li><a href="#" rel="tabs_links">
          <?php _e('Links'); ?>
          </a></li>
      </ul>
      <div class="tabs_category tabs_list">
        <ul class="sf-menu sf-js-enabled">
          <?php wp_list_categories('title_li='); ?>
        </ul>
      </div>
      <div class="tabs_archive tabs_list">
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </div>
      <div class="tabs_links tabs_list">
        <ul>
          <?php wp_get_links('before=<li>&after=</li>'); ?>
        </ul>
      </div>
    </div>
    <div class="clr"></div>
    <!--/content -->
  </div>
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
  <?php endif; ?>
  <div class="box_r ads">
    <div class="content">
      <div>
        <?php do_action('ad-minister', array('position' => 'Big Banner', 'limit' => 2)); ?>
      </div>
    </div>
    <!--/content -->
  </div>
  <!--/box -->
</div>
<!--/rightcol -->
