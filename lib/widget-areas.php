<?php
/**
 * Get all widgets used on the home page.
 *
 * @since Jobify 1.0
 *
 * @return array $_widgets An array of active widgets
 */
function jobify_homepage_widgets() {
    global $wp_registered_sidebars, $wp_registered_widgets;

    $index = 'widget-area-front-page';
    $sidebars_widgets = wp_get_sidebars_widgets();
    $_widgets = array();

    if (empty($sidebars_widgets) || empty($wp_registered_sidebars[$index]) || !array_key_exists($index, $sidebars_widgets) || !is_array($sidebars_widgets[$index]) || empty($sidebars_widgets[$index]))
        return $_widgets;

    foreach ((array) $sidebars_widgets[$index] as $id) {
        $_widgets[] = $wp_registered_widgets[$id];
    }

    return $_widgets;
}


register_sidebar(array(
    'name' => __('Instagram', 'theme-slug'),
    'id' => 'instagram-bar',
    'description' => __('Home.', 'theme-slug'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3><span>',
    'after_title' => '</span></h3>',
));
register_sidebar(array(
    'name' => __('Twitter', 'theme-slug'),
    'id' => 'twitter-bar',
    'description' => __('Twitter bar.', 'theme-slug'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3><span>',
    'after_title' => '</span></h3>',
));
register_sidebar(array(
    'name' => __('Mailchimp', 'theme-slug'),
    'id' => 'mailchimp-widget',
    'description' => __('Mailchimp', 'theme-slug'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h4><span>',
    'after_title' => '</span></h4>',
));

/**
 * Registers widgets, and widget areas.
 *
 * @since Jobify 1.0
 *
 * @return void
 */
function jobify_widgets_init() {
    register_widget('Jobify_Widget_Callout');
    register_widget('Jobify_Widget_Blog_Posts');
    register_sidebar(array(
        'name' => __('Blog Sidebar Widget Area', 'jobify'),
        'id' => 'widget-area-blog',
        'description' => __('Display widgets in the blog sidebar.', 'jobify'),
        'before_widget' => '<section id="%1$s" class="blog-sidebar %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="homepage-widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area 1', 'jobify'),
        'id' => 'widget-area-footer',
        'description' => __('Display columns of widgets in the footer.', 'jobify'),
        'before_widget' => '<aside id="%1$s" class="large-4 small-12 columns footer-widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area 2', 'jobify'),
        'id' => 'widget-area-footer-2',
        'description' => __('Display columns of widgets in the footer.', 'jobify'),
        'before_widget' => '<aside id="%1$s" class="large-5 small-12 columns medium-6 footer-widget page-list %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area 3', 'jobify'),
        'id' => 'widget-area-footer-3',
        'description' => __('Display columns of widgets in the footer.', 'jobify'),
        'before_widget' => '<aside id="%1$s" class="large-3 small-12 columns medium-6 footer-widget contact-details %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));    
}

add_action('widgets_init', 'jobify_widgets_init');
