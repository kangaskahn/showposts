<?php 
//Custom function allowing the display of posts in a certain category -- 02-18-2014 -- Author: Matt Vona
//Shortcode example:
//
//  [showposts count ="2" category="news"]
//
//  title = Allows you to add a title to the post (for some reason HTML printed before the shortcode show up at the end)
//  Count = the amount of posts you wish to display
//  Category = the NAME of the category you wish to display
//  Excerpt = Set to true if you want the excerpt, false if you do not
//  Date = Set to true if you want the date, false if you do not
//  Orderby = What you would like to order the posts by (title, date, etc)
//  Order = Ascending (ASC) or Descending (DESC)
//  Postdate = If you want to show the post date
//	listmode = Allows for each post to be displayed as a list item instead of a div
//

function short_show_posts($atts) {
    ob_start(); //Turns on output buffering - prevents the script from echoing until the end. http://us1.php.net/ob_start
    wp_reset_query(); //resets the global query so we can use the the_title(); like functions on the posts we grab
	extract(shortcode_atts(array( //creates shortcode options for the function, they become variables with a default value
		"title" => '',
		"hsize" => '2',
		"description" => '',
		"count" => '1',
		"category" => 'news', //multiple categories can be separated by a comma: 'news,events,media'
		"excerpt" => 'true',
		"date" => 'true',
		"orderby" => 'date',
		"order" => 'DESC',
		"postdate" => 'true',
		"listmode" => 'false'
    ), $atts));

    $args = array( //arguments for the WP_Query() function. Feel free to add more if needed
		'posts_per_page' => $count,
		'category_name' => $category,
		'orderby' => $orderby,
		'order' => $order
	);

    //Basic Options
	if ($title != '') { echo "<h". $hsize .">" . $title . "</h". $hsize .">"; }
	if ($description != '') { echo "<p>" . $description . "<p>"; }
	if ($listmode == "true") { echo "<ul>"; }

	$my_query = new WP_Query( $args ); //Creates a new WP_Query to grab the posts, Awesome!
	while ($my_query->have_posts()) : $my_query->the_post();

	if ($listmode == "false") { ?>
		<article id="post-<?php the_ID(); ?>" class="add-more-bottom">
			<div>
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<hr class="remove-bottom">
				<br />
			</div>

			<div>
				<?php //wpe_excerpt('wpe_excerptlength_index', '');
				if ($excerpt == "true") {  the_excerpt(); }?>
				<div class="clear"></div>
			</div>

			<?php if ($postdate == "true") { ?> <small>Posted on <?php echo mysql2date('M j Y', the_date()); ?></small> <?php } ?>
		</article>
	<?php } else { //if it is a listmode?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
	<?php }

    endwhile;
    if ($listmode == "true") { echo "</ul>"; } 
    ?>
    <div class="clear"></div> 
    <?php //the div.clear is specific to the skeleton boilerplate, needed for the wordpress theme.
        $html = ob_get_contents(); //grabs output buffer contents for display
        ob_end_clean();
            return $html;
} // end short_show_posts()

//adds the shortcode for the show posts functions
add_shortcode('showposts', 'short_show_posts'); 
?>
