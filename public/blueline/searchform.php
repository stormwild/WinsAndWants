<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
  <fieldset id="search">
    <span>
    <input type="text" value="Search..." onclick="this.value='';" name="s" id="s" class="keywords" />    
    <input name="searchsubmit" type="image" src="<?php bloginfo('template_directory'); ?>/images/search.png" value="Go" id="searchsubmit" class="btn"  />
    </span>
  </fieldset>
</form>
