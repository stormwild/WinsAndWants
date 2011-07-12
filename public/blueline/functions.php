<?php
if ( function_exists('register_sidebar') ) {
   register_sidebar(array(
       'before_widget' => '<div id="%1$s" class="box_r widget %2$s">',
	   'before_title' => '<div class="wtitle"><h2>',
       'after_title' => '</h2></div><!--/wtitle --><div class="content">',
       'after_widget' => '</div><!--/content --></div><!--/box -->',       
   ));
}

add_action('admin_menu', 'taccess_theme_page');

function taccess_theme_page ()
{
	if ( count($_POST) > 0 && isset($_POST['taccess_settings']) )
	{
		$options = array ( 'feedburner_id', 'advertise_page', 'flickr_group_id' );

		foreach ( $options as $opt )
		{
			delete_option ( 'taccess_'.$opt, $_POST[$opt] );
			add_option ( 'taccess_'.$opt, $_POST[$opt] );
		}
		wp_redirect("themes.php?page=functions.php&saved=true");
		die;
	}
	add_theme_page(__('wpTheme Settings'), __('wpTheme Settings'), 'edit_themes', basename(__FILE__), 'taccess_settings');
}

function taccess_settings ()
{

if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.__('Options saved.').'</strong></p></div>';

echo <<<TT
<div class="wrap">
	<h2>wp Theme Settings</h2>

<form method="post" action="">
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="feedburner_id">FeedBurner ID</label></th>
			<td><input name="feedburner_id" type="text" id="feedburner_id" value="<?php echo htmlspecialchars(stripslashes(get_option('taccess_feedburner_id'))); ?>" class="regular-text" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="advertise_page">Advertise Page</label></th>
			<td>
				<?php wp_dropdown_pages("name=advertise_page&show_option_none=".__('- Select -')."&selected=" .get_option('taccess_advertise_page')); ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="flickr_group_id">Flickr Group ID</label></th>
			<td>
				<input name="flickr_group_id" type="text" id="flickr_group_id" value="<?php echo htmlspecialchars(stripslashes(get_option('taccess_flickr_group_id'))); ?>" class="regular-text" />
			</td>
		</tr>
	</table>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="taccess_settings" value="save" style="display:none;" />
	</p>
</form>

</div>
TT;

}

?>
<?php

function taccess_popular_posts ()
{
	global $wpp, $wpdb, $post;
	$summoner = 1;

			$table_wpp = $wpdb->prefix . $wpp->table_name;

			if ( $wpp->options_holder[$summoner]['pages'] ) {
				$nopages = '';
			} else {
				$nopages = "AND $wpdb->posts.post_type = 'post'";
			}

			// time range
			switch( $wpp->options_holder[$summoner]['range'] ) {
				case 'all-time':
					$range = "post_date_gmt < '".gmdate("Y-m-d H:i:s")."'";
					break;
				case 'today':
					$range = "$table_wpp.day = '".gmdate("Y-m-d")."'";
					break;
				case 'weekly':
					$range = "$table_wpp.day >= '".gmdate("Y-m-d")."' - INTERVAL 7 DAY";
					break;
				case 'monthly':
					$range = "$table_wpp.day >= '".gmdate("Y-m-d")."' - INTERVAL 30 DAY";
					break;
				case 'yearly':
					$range = "$table_wpp.day >= '".gmdate("Y-m-d")."' - INTERVAL 365 DAY";
					break;
				default:
					$range = "post_date_gmt < '".gmdate("Y-m-d H:i:s")."'";
					break;
			}

			// sorting options
			switch( $wpp->options_holder[$summoner]['sortby'] ) {
				case 1:
					$sortby = 'comment_count';
					break;
				case 2:
					$sortby = 'pageviews';
					break;
				case 3:
					$sortby = 'avg_views';
					break;
				default:
					$sortby = 'comment_count';
					break;
			}


			// dynamic query fields
			$fields = ', ';
			if ( $wpp->options_holder[$summoner]['views'] ) $fields .= "SUM($table_wpp.pageviews) AS 'pageviews' ";
			if ( $wpp->options_holder[$summoner]['comments'] ) {
				if ( $fields != ', ' ) {
					$fields .= ", $wpdb->posts.comment_count AS 'comment_count' ";
				} else {
					$fields .= "$wpdb->posts.comment_count AS 'comment_count' ";
				}
			}
			if ( $sortby == 'avg_views' ) {
				if ( $fields != ', ' ) {
					$fields .= ", (SUM($table_wpp.pageviews)/(IF ( DATEDIFF(CURDATE(), MIN($table_wpp.day)) > 0, DATEDIFF(CURDATE(), MIN($table_wpp.day)), 1) )) AS 'avg_views' ";
				} else {
					$fields .= "(SUM($table_wpp.pageviews)/(IF ( DATEDIFF(CURDATE(), MIN($table_wpp.day)) > 0, DATEDIFF(CURDATE(), MIN($table_wpp.day)), 1) )) AS 'avg_views' ";
				}
			}
			if ( $wpp->options_holder[$summoner]['author'] ) {
				if ( $fields != ', ' ) {
					$fields .= ", (SELECT $wpdb->users.display_name FROM $wpdb->users WHERE $wpdb->users.ID = $wpdb->posts.post_author ) AS 'display_name'";
				} else {
					$fields .= "(SELECT $wpdb->users.display_name FROM $wpdb->users WHERE $wpdb->users.ID = $wpdb->posts.post_author ) AS 'display_name'";
				}
			}
			if ( $wpp->options_holder[$summoner]['date'] ) {
				if ( $fields != ', ' ) {
					$fields .= ", $wpdb->posts.post_date_gmt AS 'date_gmt'";
				} else {
					$fields .= "$wpdb->posts.post_date_gmt AS 'date_gmt'";
				}
			}

			if (strlen($fields) == 2) $fields = '';


			$mostpopular = $wpdb->get_results("SELECT $wpdb->posts.ID, $wpdb->posts.post_title $fields FROM $wpdb->posts LEFT JOIN $table_wpp ON $wpdb->posts.ID = $table_wpp.postid WHERE post_status = 'publish' AND post_password = '' AND $range AND pageviews > 0 $nopages GROUP BY postid ORDER BY $sortby DESC LIMIT " . $wpp->options_holder[$summoner]['limit'] . "");
		return $mostpopular;
}

/**
 * add a default-gravatar to options
 */
if ( !function_exists('fb_addgravatar') ) {
	function fb_addgravatar( $avatar_defaults ) {
		$myavatar = get_bloginfo('template_directory') . '/images/avatar.gif';
		$avatar_defaults[$myavatar] = 'people';
 
		$myavatar2 = get_bloginfo('template_directory') . '/images/myavatar.png';
		$avatar_defaults[$myavatar2] = 'wpengineer.com';
 
		return $avatar_defaults;
	}
 
	add_filter( 'avatar_defaults', 'fb_addgravatar' );
}

?>
<?php

$themename = "Piecemaker Slider";
$shortname = "Slider";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category");

// Array added for 3D Rotator
$tween_types = array("linear","easeInSine","easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeOutInCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeOutInQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeOutInCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeOutInBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeOutInQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeOutInQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeOutInExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeOutInElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce", "easeOutInBounce");

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "General",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Colour Scheme",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array("blue", "red", "green"),
	"std" => "blue"),
	
array( "name" => "Logo URL",
	"desc" => "Enter the link to your logo image",
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => ""),
	
	
array( "name" => "Custom CSS",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""),
	
array( "type" => "close"),

// Options Panel added for 3D Rotator
array( "name" => "3D Rotator Options",
"type" => "section"),
array( "type" => "open"),

array( "name" => "Segments",
"desc" => "Number of segments in which the image will be sliced.",
"id" => $shortname."_segments",
"type" => "text",
"std" => "9"),

array( "name" => "Tween Time",
"desc" => "Number of seconds for each element to be turned.",
"id" => $shortname."_tween_time",
"type" => "text",
"std" => "3"),

array( "name" => "Tween Delay",
"desc" => "Number of seconds from one element starting to turn to the next element starting.",
"id" => $shortname."_tween_delay",
"type" => "text",
"std" => "0.1"),

array( "name" => "Tween Type",
"desc" => "Type of animation transition.",
"id" => $shortname."_tween_type",
"type" => "select",
"options" => $tween_types,
"std" => "Choose a category"),

array( "name" => "Z Distance",
"desc" => "to which extend are the cubes moved on z axis when being tweened. Negative values bring the cube closer to the camera, positive values take it further away. A good range is roughly between -200 and 700.",
"id" => $shortname."_z_distance",
"type" => "text",
"std" => "25"),

array( "name" => "Expand",
"desc" => "To which etxend are the cubes moved away from each other when tweening.",
"id" => $shortname."_expand",
"type" => "text",
"std" => "9"),

array( "name" => "Inner Color",
"desc" => "Color of the sides of the elements in hex values (e.g. 0x000000 for black)",
"id" => $shortname."_inner_color",
"type" => "text",
"std" => "0x000000"),

array( "name" => "Text Background Color",
"desc" => "Color of the description text background in hex values (e.g. 0xFF0000 for red)",
"id" => $shortname."_text_background",
"type" => "text",
"std" => "0x666666"),

array( "name" => "Text Distance",
"desc" => "Distance of the info text to the borders of its background.",
"id" => $shortname."_text_distance",
"type" => "text",
"std" => "25"),

array( "name" => "Shadow Darkness",
"desc" => "To which extend are the sides shadowed, when the elements are tweening and the sided move towards the background. 100 is black, 0 is no darkening.",
"id" => $shortname."_shadow_darkness",
"type" => "text",
"std" => "25"),

array( "name" => "Auto Play",
"desc" => "Number of seconds to the next image when autoplay is on. Set 0, if you don't want autoplay.",
"id" => $shortname."_autoplay",
"type" => "text",
"std" => "2"),

array( "type" => "close"),

array( "name" => "Homepage",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Homepage header image",
	"desc" => "Enter the link to an image used for the homepage header.",
	"id" => $shortname."_header_img",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Homepage featured category",
	"desc" => "Choose a category from which featured posts are drawn",
	"id" => $shortname."_feat_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),	

array( "type" => "close"),
array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	
	
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/favicon.ico"),	
	
array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),
 
array( "type" => "close")
 
);

function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=functions.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=functions.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?> 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>