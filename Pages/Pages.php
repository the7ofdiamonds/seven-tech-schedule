<?php

namespace SEVEN_TECH_Schedule\Pages;

use WP_Query;

class Pages
{
    public $page_titles;
    public $post_types;

    public function __construct()
    {
        $this->page_titles = [
            
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
                    'post_title'   => $page_title,
                    'post_type'    => 'page',
                    'post_content' => '',
                    'post_status'  => 'publish',
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

            wp_reset_postdata();
        }
    }
}
