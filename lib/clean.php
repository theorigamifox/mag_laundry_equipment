<?php

function jobify_setup() {

    load_theme_textdomain('jobify', get_template_directory() . '/languages');

    // Editor style
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => '#ffffff'
    ));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'primary' => __('Navigation Menu', 'jobify'),
        'mobile_menu' => __('Mobile Nav', 'reverie'),
        'footer-social' => __('Footer Social', 'jobify'),
        'footer' => __('Footer Nav', 'reverie'),
        'footer_1' => __('Footer Nav 1', 'reverie'),
        'footer_2' => __('Footer Nav 2', 'reverie'),
        'footer_3' => __('Footer Nav 3', 'reverie'),
        'footer_4' => __('Footer Nav 4', 'reverie'),
        'footer_5' => __('Footer Nav 5', 'reverie'),
        'copyright' => __('Copyright Nav', 'reverie')
    ));

    add_theme_support('job-manager-templates');

    /** Shortcodes */
    add_filter('widget_text', 'do_shortcode');

    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
    add_theme_support('post-thumbnails');
    add_image_size('content-grid', 400, 200, true);
    add_image_size('content-job-featured', 450, 175, true);

    /**
     * WooCommerce
     */
    add_theme_support('woocommerce');

    /**
     * Misc
     */
    add_filter('excerpt_more', '__return_false');
}

add_action('after_setup_theme', 'jobify_setup');
