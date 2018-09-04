<?php

function jobify_scripts() {
    global $wp_styles, $edd_options;

    /*
     * Adds JavaScript to pages with the comment form to support sites with
     * threaded comments (when in use).
     */
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    wp_deregister_script('wp-job-manager-job-application');

    $deps = array('jquery');
    wp_enqueue_script('plugins', get_template_directory_uri() . '/js/plugins.js', true, false);    
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/app.js', true, false);
    /**
     * Localize/Send data to our script.
     */
    $jobify_settings = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'i18n' => array(
        ),
        'pages' => array(
            'is_testimonials' => is_page_template('page-templates/testimonials.php') || is_post_type_archive('testimonial')
        ),
        'widgets' => array()
    );

    foreach (jobify_homepage_widgets() as $widget) {
        $options = get_option('widget_' . $widget['classname']);
        $options = $options[$widget['callback'][0]->number];

        $jobify_settings['widgets'][$widget['classname']] = array(
            'animate' => isset($options['animations']) && 1 == $options['animations'] ? 1 : 0
        );
    }
    wp_localize_script('jobify', 'jobifySettings', $jobify_settings);
}
add_action('wp_enqueue_scripts', 'jobify_scripts');