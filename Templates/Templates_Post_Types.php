<?php

namespace SEVEN_TECH\Schedule\Templates;

use SEVEN_TECH\Schedule\CSS\CSS;
use SEVEN_TECH\Schedule\JS\JS;
use SEVEN_TECH\Schedule\Post_Types\Post_Types;

class Templates_Post_Types
{
    private $css_file;
    private $js_file;
    private $post_types;

    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_archive_template']);
        add_filter('single_template', [$this, 'get_single_template']);

        $posttypes = new Post_Types();
        $this->css_file = new CSS;
        $this->js_file = new JS;

        $this->post_types = $posttypes->post_types;
    }


    function get_archive_template($archive_template)
    {
        if (is_array($this->post_types) && count($this->post_types) > 0) {
            foreach ($this->post_types as $post_type) {
                if (is_post_type_archive($post_type['name'])) {
                    $archive_template = SEVEN_TECH_SCHEDULE . 'Post_Types/' . $post_type['plural'] . '/archive-' . $post_type['name'] . '.php';

                    if (file_exists($archive_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                        return $archive_template;
                    }
                }
            }
        }
        return $archive_template;
    }

    function get_single_template($single_template)
    {
        if (is_array($this->post_types) && count($this->post_types) > 0) {
            foreach ($this->post_types as $post_type) {
                if (is_singular($post_type['name'])) {
                    $single_template = SEVEN_TECH_SCHEDULE . 'Post_Types/' . $post_type['plural'] . '/single-' . $post_type['name'] . '.php';

                    if (file_exists($single_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);

                        return $single_template;
                    }
                }
            }
        }
        return $single_template;
    }
}
