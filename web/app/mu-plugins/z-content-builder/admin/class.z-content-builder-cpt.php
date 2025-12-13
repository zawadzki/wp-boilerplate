<?php

if (! class_exists('Z_Content_Builder_Post_Type')) {
    class Z_Content_Builder_Post_Type
    {
        public function __construct()
        {
            add_action('init', [$this, 'create_post_type']);
        }

        public function create_post_type()
        {
            $labels = [
                'name' => _x('News', 'Post type general name', 'zawdam-theme'),
                'singular_name' => _x('News', 'Post type singular name', 'zawdam-theme'),
                'menu_name' => _x('News', 'Admin Menu text', 'zawdam-theme'),
                'name_admin_bar' => _x('News', 'Add New on Toolbar', 'zawdam-theme'),
                'add_new' => __('Add news', 'zawdam-theme'),
                'add_new_item' => __('Add news', 'zawdam-theme'),
                'new_item' => __('New news', 'zawdam-theme'),
                'edit_item' => __('Edit news', 'zawdam-theme'),
                'view_item' => __('View news', 'zawdam-theme'),
                'all_items' => __('All news', 'zawdam-theme'),
            ];

            $args = [
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => ['slug' => 'news'],
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-welcome-write-blog',
                'supports' => [
                    'title',
                    'author',
                    'thumbnail',
                    'revision',
                ],
            ];

            register_post_type('news', $args);

            if (function_exists('acf_add_options_page')) {
                acf_add_options_page([
                    'page_title' => 'News Archive',
                    'menu_title' => 'News Archive',
                    'menu_slug' => 'news-archive',
                    'capability' => 'manage_options',
                    'redirect' => false,
                    'post_id' => 'news_archive',
                    'position' => 4,
                ]);
            }
        }
    }
}
