<?php
require_once('lib/clean.php');
require_once('lib/enqueue-styles.php');
require_once('lib/enqueue-scripts.php');
require_once('lib/nav.php');
require_once('lib/options.php');
require_once('lib/custom-post-types.php');
require_once('lib/widget-areas.php');
if (!isset($content_width)) {
    $content_width = 680;
}

/**
 * Hide plugin notice.
 *
 * @since Jobify 1.0
 *
 * @return void
 */
function jobify_hide_plugin_notice() {
    check_admin_referer('jobify-hide-plugin-notice');

    $user_id = get_current_user_id();

    add_user_meta($user_id, 'jobify-hide-plugin-notice', 1);
}

if (is_admin())
    add_action('admin_action_jobify-hide-plugin-notice', 'jobify_hide_plugin_notice');

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Jobify 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function jobify_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
     * supported by Montserrat, translate this to 'off'. Do not translate
     * into your own language.
     */
    $montserrat = _x('on', 'Montserrat font: on or off', 'jobify');

    /* Translators: If there are characters in your language that are not
     * supported by Varela Round, translate this to 'off'. Do not translate into your
     * own language.
     */
    $varela = _x('on', 'Varela Round font: on or off', 'jobify');

    if ('off' !== $montserrat || 'off' !== $varela) {
        $font_families = array();

        if ('off' !== $montserrat)
            $font_families[] = 'Montserrat:400,700';

        if ('off' !== $varela)
            $font_families[] = 'Varela+Round';

        $protocol = is_ssl() ? 'https' : 'http';
        $query_args = array(
            'family' => implode('|', $font_families),
            'subset' => 'latin',
        );
        $fonts_url = add_query_arg($query_args, "$protocol://fonts.googleapis.com/css");
    }

    return $fonts_url;
}

/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses jobify_fonts_url() to get the Google Font stylesheet URL.
 *
 * @since Jobify 1.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string
 */
function jobify_mce_css($mce_css) {
    $fonts_url = jobify_fonts_url();

    if (empty($fonts_url))
        return $mce_css;

    if (!empty($mce_css))
        $mce_css .= ',';

    $mce_css .= esc_url_raw(str_replace(',', '%2C', $fonts_url));

    return $mce_css;
}

add_filter('mce_css', 'jobify_mce_css');

/**
 * Loads our special font CSS file.
 *
 * To disable in a child theme, use wp_dequeue_style()
 * function mytheme_dequeue_fonts() {
 *     wp_dequeue_style( 'jobify-fonts' );
 * }
 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
 *
 * Also used in the Appearance > Header admin panel:
 * @see twentythirteen_custom_header_setup()
 *
 * @since Jobify 1.0
 *
 * @return void
 */
function jobify_fonts() {
    $fonts_url = jobify_fonts_url();

    if (!empty($fonts_url))
        wp_enqueue_style('jobify-fonts', esc_url_raw($fonts_url), array(), null);
}

add_action('wp_enqueue_scripts', 'jobify_fonts');

/**
 * Enqueues scripts and styles for front end.
 *
 * @since Jobify 1.0
 *
 * @return void
 */




/**
 * Adjust page when responsive is off to normal scale.
 *
 * @since Jobify 1.1
 */
function jobify_nonresponsive_viewport() {
    if (!jobify_theme_mod('jobify_general', 'responsive'))
        return;

    echo '<meta name="viewport" content="initial-scale=1">';
}

add_action('wp_head', 'jobify_nonresponsive_viewport');

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Jobify 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function jobify_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'jobify'), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'jobify_wp_title', 10, 2);


/**
 * Extends the default WordPress body class to denote:
 * 1. Custom fonts enabled.
 *
 * @since Jobify 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function jobify_body_class($classes) {
    if (wp_style_is('jobify-fonts', 'queue'))
        $classes[] = 'custom-font';

    if (get_option('job_manager_enable_categories'))
        $classes[] = 'wp-job-manager-categories';

    return $classes;
}

add_filter('body_class', 'jobify_body_class');

/**
 * Extends the default WordPress comment class to add 'no-avatars' class
 * if avatars are disabled in discussion settings.
 *
 * @since Jobify 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function jobify_comment_class($classes) {
    if (!get_option('show_avatars'))
        $classes[] = 'no-avatars';

    return $classes;
}

add_filter('comment_class', 'jobify_comment_class');

/**
 * Adds a class to menu items that have children elements
 * so that they can be styled
 *
 * @since Jobify 1.0
 */
function jobify_add_menu_parent_class($items) {
    $parents = array();

    foreach ($items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent > 0) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ($items as $item) {
        if (in_array($item->ID, $parents)) {
            $item->classes[] = 'has-children';
        }
    }

    return $items;
}

add_filter('wp_nav_menu_objects', 'jobify_add_menu_parent_class');

/**
 * Append modal boxes to the bottom of the the page that
 * will pop up when certain links are clicked.
 *
 * Login/Register pages must be set in EDD settings for this to work.
 *
 * @since Jobify 1.0
 *
 * @return void
 */
function jobify_inline_modals() {


    $login = jobify_find_page_with_shortcode(array('jobify_login_form', 'login_form'));

    if (0 != $login)
        get_template_part('modal', 'login');

    $register = jobify_find_page_with_shortcode(array('jobify_register_form', 'register_form'));

    if (0 != $register)
        get_template_part('modal', 'register');
}

add_action('wp_footer', 'jobify_inline_modals');

/**
 * If the menu item has a custom class, that means it is probably
 * going to be triggering a modal. The ID will be used to determine
 * the inline content to be displayed, so we need it to provide context.
 * This uses the specificed class name instead of `menu-item-x`
 *
 * @since Jobify 1.0
 *
 * @param string $id The ID of the current menu item
 * @param object $item The current menu item
 * @param array $args Arguments
 * @return string $id The modified menu item ID
 */
function jobify_nav_menu_item_id($id, $item, $args) {
    if (!empty($item->classes[0])) {
        return current($item->classes) . '-modal';
    }

    return $id;
}

add_filter('nav_menu_item_id', 'jobify_nav_menu_item_id', 10, 3);

/**
 * Object meta helper.
 *
 * @since Jobify 1.0
 *
 * @param string $key The meta key to get.
 * @param int $post_id The post ID to pull the meta from.
 * @return mixed The found post meta
 */
function jobify_item_meta($key, $post_id = null) {
    global $post;

    if (is_null($post_id) && is_object($post))
        $post_id = $post->ID;

    $meta = get_post_meta($post_id, $key, true);

    if ($meta)
        return apply_filters('jobify_meta_' . $key, $meta);

    return false;
}

// numbered pagination
function pagination($pages = '', $range = 4) {
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged))
        $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class=\"pagination\"><span>Page " . $paged . " of " . $pages . "</span>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";
        if ($paged > 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages)
            echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">Next &rsaquo;</a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>";
        echo "</div>\n";
    }
}

/**
 * Pagination
 *
 * After the loop, attach pagination to the current query.
 *
 * @since Jobify 1.0
 *
 * @return void
 */
function jobify_pagination() {
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<i class="icon-left-open-big"></i>',
        'next_text' => '<i class="icon-right-open-big"></i>'
    ));
    ?>
    <div class="paginate-links container">
    <?php echo $links; ?>
    </div>
    <?php
}

add_action('jobify_loop_after', 'jobify_pagination');

if (!function_exists('jobify_comment')) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments
     * template simply create your own twentythirteen_comment(), and that function
     * will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Twenty Thirteen 1.0
     *
     * @param object $comment Comment to display.
     * @param array $args Optional args.
     * @param int $depth Depth of comment.
     * @return void
     */
    function jobify_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                    <p><?php _e('Pingback:', 'jobify'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('Edit', 'jobify'), '<span class="ping-meta"><span class="edit-link">', '</span></span>'); ?></p>
                    <?php
                    break;
                default :
                    // Proceed with normal comments.
                    ?>
                <li id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                        <div class="comment-avatar">
                <?php echo get_avatar($comment, 75); ?>
                        </div><!-- .comment-author -->

                        <header class="comment-meta">
                            <span class="comment-author vcard"><cite class="fn"><?php comment_author_link(); ?></cite></span> 
                            <?php echo _x('on', 'comment author "on" date', 'jobify'); ?>
                            <?php
                            printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'), sprintf(_x('%1$s at %2$s', 'on 1: date, 2: time', 'jobify'), get_comment_date(), get_comment_time())
                            );
                            edit_comment_link(__('Edit', 'jobify'), '<span class="edit-link"><i class="icon-pencil"></i> ', '<span>');

                            comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'jobify'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
                            ?>
                        </header><!-- .comment-meta -->

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'jobify'); ?></p>
                            <?php endif; ?>

                        <div class="comment-content">
                    <?php comment_text(); ?>
                        </div><!-- .comment-content -->
                    </article><!-- #comment-## -->
                    <?php
                    break;
            endswitch; // End comment_type check.
        }

    endif;

    /**
     * Testimonials by WooThemes
     *
     * @since Jobify 1.0
     *
     * @param string $tpl
     * @return string $tpl
     */
    function jobify_woothemes_testimonials_item_template($tpl, $args) {
        if ('individual' == $args['category']) {
            $tpl = '<blockquote id="quote-%%ID%%" class="individual-testimonial %%CLASS%%">';
            $tpl .= '%%TEXT%%';
            $tpl .= '<cite class="individual-testimonial-author">%%AVATAR%% %%AUTHOR%%</cite>';
            $tpl .= '</blockquote>';
        } else {
            $tpl = '<div class="company-slider-item">';
            $tpl .= '%%AVATAR%%';
            $tpl .= '</div>';
        }

        return $tpl;
    }

    add_filter('woothemes_testimonials_item_template', 'jobify_woothemes_testimonials_item_template', 10, 2);

    if (!function_exists('shortcode_exists')) :

        /**
         * Whether a registered shortcode exists named $tag
         *
         * @since 3.6.0
         *
         * @global array $shortcode_tags
         * @param string $tag
         * @return boolean
         */
        function shortcode_exists($tag) {
            global $shortcode_tags;
            return array_key_exists($tag, $shortcode_tags);
        }

    endif;

    if (!function_exists('has_shortcode')) :

        /**
         * Whether the passed content contains the specified shortcode
         *
         * @since 3.6.0
         *
         * @global array $shortcode_tags
         * @param string $tag
         * @return boolean
         */
        function has_shortcode($content, $tag) {
            if (shortcode_exists($tag)) {
                preg_match_all('/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER);
                if (empty($matches))
                    return false;

                foreach ($matches as $shortcode) {
                    if ($tag === $shortcode[2])
                        return true;
                }
            }
            return false;
        }

    endif;
$dhL10n = array(
			'ajax_url'=>admin_url( 'admin-ajax.php', 'relative' )
    );
    function template_loop_quickview() {
        global $product;
        echo '<div class="shop-loop-quickview"><a data-product_id ="' . $product->id . '" title="' . esc_attr__('Quick view', 'luxury-wp') . '" href="' . esc_url($product->get_permalink()) . '">Quick View</a></div>';
    }


    remove_action('woocommerce_product_tabs', 'woocommerce_product_reviews_tab', 30);
    remove_action('woocommerce_product_tab_panels', 'woocommerce_product_reviews_panel', 30);

    add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

    function woo_remove_product_tabs($tabs) {

        unset($tabs['description']); // Remove the description tab
        unset($tabs['reviews']); // Remove the reviews tab
        unset($tabs['additional_information']); // Remove the additional information tab

        return $tabs;
    }
require_once( get_template_directory() . '/inc/job-manager.php' );
    require_once( get_template_directory() . '/lib/custom-post-types.php' );
    require_once( get_template_directory() . '/lib/widget-areas.php' );

    /**
     * Widgets
     */
    require_once( get_template_directory() . '/inc/widgets.php' );
    require_once( get_template_directory() . '/inc/widgets/callout.php' );
    require_once( get_template_directory() . '/inc/widgets/video.php' );
    require_once( get_template_directory() . '/inc/widgets/blog-posts.php' );

    if (defined('RCP_PLUGIN_VERSION')) {
        require_once( get_template_directory() . '/inc/widgets/price-table-rcp.php' );
    } else if (class_exists('WooCommerce')) {
        require_once( get_template_directory() . '/inc/widgets/price-table-wc.php' );
    } else {
        require_once( get_template_directory() . '/inc/widgets/price-option.php' );
        require_once( get_template_directory() . '/inc/widgets/price-table.php' );
    }

    if (class_exists('WP_Job_Manager')) {
        require_once( get_template_directory() . '/inc/widgets/jobs.php' );
        require_once( get_template_directory() . '/inc/widgets/stats.php' );
        require_once( get_template_directory() . '/inc/widgets/map.php' );
    }

    if (class_exists('Woothemes_Testimonials')) {
        require_once( get_template_directory() . '/inc/widgets/companies.php' );
        require_once( get_template_directory() . '/inc/widgets/testimonials.php' );
    }

    if (function_exists('soliloquy_slider')) {
        require_once( get_template_directory() . '/inc/widgets/slider.php' );
        require_once( get_template_directory() . '/inc/widgets/slider-hero.php' );
    }
    function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

    /**
     * Custom Header
     */
    require_once( get_template_directory() . '/inc/custom-header.php' );

    /**
     * Customizer
     */
    require_once( get_template_directory() . '/inc/theme-customizer.php' );

    
    function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('parts'));
    }

return $query;
}

add_filter('pre_get_posts','searchfilter');

function wpdocs_custom_taxonomies_terms_links() {
    // Get post by post ID.
    $post = get_post( $post->ID );
 
    // Get post type by post.
    $post_type = $post->post_type;
 
    // Get post type taxonomies.
    $taxonomies = get_object_taxonomies( $post_type, 'objects' );
 
    $out = array();
 
    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
 
        // Get the terms related to post.
        $terms = get_the_terms( $post->ID, $taxonomy_slug );
 
        if ( ! empty( $terms ) ) {
            $out[] = "<ul>";
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<li><a href="%1$s">%2$s</a></li>',
                    esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
                    esc_html( $term->name )
                );
            }
            $out[] = "\n</ul>\n";
        }
    }
    return implode( '', $out );
}
function change_wp_search_size($queryVars) {
	if ( isset($_REQUEST['s']) ) // Make sure it is a search page
		$queryVars['posts_per_page'] = 15; // Change 10 to the number of posts you would like to show
	return $queryVars; // Return our modified query variables
}
add_filter('request', 'change_wp_search_size'); // Hook our custom function onto the request filter
function exclude_category( $query ) {
if ( $query->is_home() && $query->is_main_query() ) {
$query->set( 'cat', '-4190' );
}
}
add_action( 'pre_get_posts', 'exclude_category' );
function exclude_widget_categories($args){
    $exclude = "4190";
    $args["exclude"] = $exclude;
    return $args;
}
add_filter("widget_categories_args","exclude_widget_categories");
?>