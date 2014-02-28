/**
 * Shortcode allowing the display of posts in a certain category.
 *
 * `[shortposts count="2" category="news"]`
 *
 * More info in `README.MD`.
 *
 * Refer to the WordPress Codex page on WP_Query:
 * http://codex.wordpress.org/Class_Reference/WP_Query
 *
 * Options:
 *
 * `category`
 * : The name/slug of the category you wish to display.
 * : Accepts category slug names as well as category IDs.
 * : Spaces are NOT allowed in the shortcode `category="1,2,3,4"` or `category="news,events,stats"`
 * : Default is none.
 *
 * `count`
 * : The amount of posts you wish to display.
 * : Default is `-1`, for unlimited posts.
 *
 * `excerpt`
 * : Set to false to hide the excerpt.
 * : Default is true.
 *
 * `order`
 * : Ascending (`ASC`) or descending (`DESC`).
 * : Default is `DESC`.
 *
 * `orderby`
 * : Order posts by one of the WP_Query `orderby` params.
 * : Default is `date`.
 * : http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
 *
 * `postdate`
 * : Set to false to hide the date.
 * : Default is true.
 *
 * `showcategories`
 * : Set to true to display the categories at the bottom of the post, with links.
 * : Example: "News, Events, Products"
 *
 * `titleonly`
 * : Set to true to only show the title
 * : Default is false.
 */
function smc_shortcode_shortposts($atts) {
    // Start output buffering
    // Prevents the script from echoing until the end.
    // http://us1.php.net/ob_start
    ob_start();

    wp_reset_query();
    $categoryArg = "";

    // Create shortcode options for the function, they become variables with a default value
    extract(shortcode_atts(array(
        // Query attributes
        "category"       => '',
        "count"          => '1',
        "order"          => 'DESC',
        "orderby"        => 'date',
        // Display attributes
        "excerpt"        => 'true',
        "postdate"       => 'true',
        "showcategories" => 'true',
        "titleonly"      => 'false',
    ), $atts));

    //Checks to see if numbers or strings are used.
        $category_chunks = explode(",", $category);

        foreach ($category_chunks as $cat) {
            if (is_numeric ($cat)) {
                $categoryArg = "cat";

            } else {
                $categoryArg= "category_name";
            }
        }


    $shortposts_args = array(
        $categoryArg => $category,
        'order'          => $order,
        'orderby'        => $orderby,
        'posts_per_page' => $count
    );


    // Create a new WP_Query to grab the posts
    $shortposts_query = new WP_Query( $shortposts_args );

    while ($shortposts_query->have_posts()) : $shortposts_query->the_post(); ?>
        <div class="shortposts <?php foreach((get_the_category()) as $cat) { echo $cat->slug  . ' '; } ?>">
            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
            <?php if ($titleonly === "false") :

                if ($excerpt === "true") : ?>
                    <div class="shortposts-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif;

                if ($showcategories === "true") : ?>
                    <div class="shortposts-categories">
                        <?php echo get_the_category_list(', '); ?>
                    </div>
                <?php endif;

                if ($postdate === "true") : ?>
                    <div class="shortposts-entry-meta">
                        <?php esemci_entry_meta(); ?>
                    </div>
                <?php endif; ?>
                <hr>
            <?php endif; // endif ($titleonly === "false") ?>
        </div>
    <?php
    endwhile;
    $html = ob_get_contents(); //grabs output buffer contents for display
    ob_end_clean();
    return $html;
}
add_shortcode('shortposts', 'smc_shortcode_shortposts');
