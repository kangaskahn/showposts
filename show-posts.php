/**
 * Shortcode allowing the display of posts in a certain category
 *
 * `[showposts count="2" category="news"]`
 *
 * More info in `README.MD`.
 *
 * Refer to the WordPress Codex page on WP_Query:
 * http://codex.wordpress.org/Class_Reference/WP_Query
 *
 * Options:
 *
 * - title    = Adds a title to the post (for some reason HTML printed
 * before the shortcode show up at the end). Default is none.
 *
 * - hsize    = An integer between 1 and 6 for specifying `<h?>` tag.
 * Default is `2` for an output of `<h2>`.
 *
 * - count    = the amount of posts you wish to display. Default is 1.
 *
 * - category = the name/slug of the category you wish to display.
 * Separate multiple with a comma *without spaces*, e.g. `news,events,media`.
 *
 * - excerpt  = Set to false to hide the excerpt. Default is true.
 *
 * - postdate = Set to false to hide the date. Default is true.
 *
 * - orderby  = Order posts by one of the WP_Query `orderby` params. Default is 'date'.
 * http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
 *
 * - order    = Ascending ('ASC') or descending ('DESC'). Default is 'DESC'.
 *
 * - listmode = Allows for each post to be displayed as a list item instead of a div
 *
 * @param  [type] $atts [description]
 * @return [type]       [description]
 */
function smc_shortcode_post_display($atts) {
    // Start output buffering
    // Prevents the script from echoing until the end.
    // http://us1.php.net/ob_start
    ob_start();

    wp_reset_query();

    // Create shortcode options for the function, they become variables with a default value
    extract(shortcode_atts(array(
        "count" => '1',
        "category" => '',
        "excerpt" => 'true',
        "orderby" => 'date',
        "order" => 'DESC',
        "postdate" => 'true',
        "titleonly" => 'false',
        "showcategories" => 'true'
    ), $atts));

    $args = array( //arguments for the WP_Query() function. Feel free to add more if needed
        'posts_per_page' => $count,
        'category_name' => $category,
        'orderby' => $orderby,
        'order' => $order
    );

    // Create a new WP_Query to grab the posts
    $my_query = new WP_Query( $args );
    while ($my_query->have_posts()) : $my_query->the_post();

    // OUTPUT: ?>

            <div id="post-<?php the_ID(); ?>" class="shortposts <?php foreach((get_the_category()) as $cat) { echo $cat->slug  . ' '; } ?>">
            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>

    <?php if ($titleonly === "false") { ?>

        <?php if ($excerpt === "true") : ?>
            <div class="shortposts-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>

        <?php if ($showcategories === "true") : ?>
            <div class="shortposts-categories">
                <?php foreach((get_the_category()) as $cat) { echo $cat->cat_name. ', '; } ?>
            </div>
        <?php endif; ?>

        <?php if ($postdate === "true") : ?>
            <div class="shortposts-entry-meta">
                <?php esemci_entry_meta(); ?>
            </div>
        <?php endif; ?>

            </div>
    <?php

    } //end if titleonly === false
        endwhile;
        $html = ob_get_contents(); //grabs output buffer contents for display
        ob_end_clean();
            return $html;
    } // end smc_shortcode_post_display()

//adds the shortcode for the show posts functions
add_shortcode('showposts', 'smc_shortcode_post_display');
