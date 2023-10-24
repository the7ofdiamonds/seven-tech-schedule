<?php

namespace SEVEN_TECH_Schedule\Pages;

use WP_Query;

class Pages
{
    public $front_page_react;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'schedule',
        ];

        $this->page_titles = [
            'schedule',
            'event'
        ];

        add_action('init', [$this, 'react_rewrite_rules']);
    }

    public function add_pages()
    {
        global $wpdb;

        foreach ($this->page_titles as $page_title) {
            $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page_title));

            if (!$page_exists) {
                $page_data = array(
                    'post_title'   => strtoupper($page_title),
                    'post_type'    => 'page',
                    'post_content' => '',
                    'post_status'  => 'publish',
                );

                wp_insert_post($page_data);
            }
        }
    }

    public function add_founder_subpages()
    {
        global $wpdb;

        $pages = [
            [
                'title' => 'FOUNDER RESUME',
                'name' => 'resume'
            ]
        ];

        foreach ($pages as $page) {
            $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'page'", $page['name']));

            if (!$page_exists) {
                $page_data = array(
                    'post_title'   => $page['title'],
                    'post_type'    => 'page',
                    'post_content' => '',
                    'post_status'  => 'publish',
                    'post_name' => $page['name']
                );

                wp_insert_post($page_data);
            }
        }
    }

    public function react_rewrite_rules()
    {
        foreach ($this->page_titles as $page_title) {
            $args = array(
                'post_type' => 'page',
                'post_title' => $page_title,
                'posts_per_page' => 1
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $query->the_post();
                add_rewrite_rule('^' . $query->post->post_name, 'index.php?page_id=' . $query->post->ID, 'top');
            }

            $resume_id = get_page_by_path('resume')->ID;

            add_rewrite_rule('^founders/([^/]+)/resume/?$', 'index.php?page_id=' . $resume_id, 'top');

            wp_reset_postdata();
        }
    }
}
