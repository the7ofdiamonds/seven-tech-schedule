<?php

namespace SEVEN_TECH_Schedule\CSS;

use SEVEN_TECH_Schedule\Pages\Pages;
use SEVEN_TECH_Schedule\Post_Types\Post_Types;

class CSS
{
    private $page_titles;
    private $post_types;

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_front_page_css']);
        add_action('wp_head', [$this, 'load_pages_css']);
        add_action('wp_head', [$this, 'load_post_types_css']);

        $pages = new Pages;
        $posttypes = new Post_Types;
        
        $this->page_titles = $pages->page_titles;
        $this->post_types = $posttypes->post_types;
    }

    function load_front_page_css()
    {
        if (is_front_page()) {
            $filePath = SEVEN_TECH_SCHEDULE_URL . 'CSS/seven-tech.css';

            if ($filePath) {
                wp_register_style('seven_tech_css',  SEVEN_TECH_SCHEDULE_URL . 'CSS/seven-tech.css', array(), false, 'all');
                wp_enqueue_style('seven_tech_css');
            } else {
                error_log('CSS file is missing at :' . $filePath);
            }
        }
    }

    function load_pages_css()
    {
        foreach ($this->page_titles as $page) {
            if (is_page($page)) {
                $filePath = SEVEN_TECH_SCHEDULE_URL . 'CSS/seven-tech.css';

                if ($filePath) {
                    wp_register_style('seven_tech_css',  SEVEN_TECH_SCHEDULE_URL . 'CSS/seven-tech.css', array(), false, 'all');
                    wp_enqueue_style('seven_tech_css');
                } else {
                    error_log('CSS file is missing at :' . $filePath);
                }
            }
        }
    }

    function load_post_types_css()
    {
        foreach ($this->post_types as $post_type) {
            if (is_post_type_archive($post_type) || is_singular($post_type)) {
                $filePath = SEVEN_TECH_SCHEDULE_URL . 'CSS/seven-tech.css';

                if ($filePath) {
                    wp_register_style('seven_tech_css',  SEVEN_TECH_SCHEDULE_URL . 'CSS/seven-tech.css', array(), false, 'all');
                    wp_enqueue_style('seven_tech_css');
                } else {
                    error_log('CSS file is missing at :' . $filePath);
                }
            }
        }
    }
}
