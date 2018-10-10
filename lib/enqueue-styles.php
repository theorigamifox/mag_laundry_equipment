<?php
function jobify_styles() {
    global $wp_styles, $edd_options;

    /** Styles */
    wp_enqueue_style('app', get_template_directory_uri() . '/css/app.css');
    wp_dequeue_style('wp-job-manager-frontend');
}
add_action('wp_enqueue_scripts', 'jobify_styles');