<?php

if (function_exists('acf_add_options_page')) {

    acf_add_options_page();
    acf_add_options_sub_page('Header');
    acf_add_options_sub_page('Footer');    
    acf_add_options_sub_page('Social');
    //acf_add_options_sub_page('Availability');
    
    acf_add_options_sub_page(array(
        'page_title' => 'Header',
        'menu_title' => 'Header',
        'menu_slug' => 'theme-options-social',
        'capability' => 'edit_posts',
        'parent_slug' => 'theme-options',
        'position' => false,
        'icon_url' => false,
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Footer',
        'menu_title' => 'Footer',
        'menu_slug' => 'theme-options-footer',
        'capability' => 'edit_posts',
        'parent_slug' => 'theme-options',
        'position' => false,
        'icon_url' => false,
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Social',
        'menu_title' => 'Social',
        'menu_slug' => 'theme-options-social',
        'capability' => 'edit_posts',
        'parent_slug' => 'theme-options',
        'position' => false,
        'icon_url' => false,
    ));

}