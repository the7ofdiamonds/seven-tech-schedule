<?php

namespace SEVEN_TECH_Schedule\JS;

use SEVEN_TECH_Schedule\Pages\Pages;
use SEVEN_TECH_Schedule\Post_Types\Post_Types;

class JS
{
    private $page_titles;
    private $post_types;
    private $includes_url;

    public function __construct()
    {
        // add_action('wp_footer', [$this, 'load_js']);
        add_action('wp_footer', [$this, 'load_front_page_react']);
        // add_action('wp_footer', [$this, 'load_pages_react']);
        // add_action('wp_footer', [$this, 'load_post_types_archive_jsx']);
        // add_action('wp_footer', [$this, 'load_post_types_single_jsx']);
        // add_filter('script_loader_tag', [$this, 'set_script_type_to_module'], 10, 2);
        // add_action('wp_enqueue_scripts', [$this, 'load_firebase']);

        $pages = new Pages;
        $posttypes = new Post_Types;

        $this->page_titles = $pages->page_titles;
        $this->post_types = $posttypes->post_types;

        $this->includes_url = includes_url();
    }

    function load_js()
    {
        wp_register_script('seven_tech_js', SEVEN_TECH_SCHEDULE_URL . 'JS/seven-tech.js', array('jquery'), false, false);
        wp_enqueue_script('seven_tech_js');
    }

    function load_front_page_react()
    {
        $sections = [
            'schedule',
        ];

        foreach ($sections as $section) {
            if (is_front_page()) {
                $fileName = ucwords($section);
                $filePath = SEVEN_TECH_SCHEDULE_URL . 'build/' . 'src_views_' . $fileName . '_jsx.js';

                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                if ($filePath) {
                    wp_enqueue_script('seven_tech_schedule_react_' . $fileName, $filePath, ['wp-element'], 1.0, true);
                } else {
                    error_log('Post Type' . $section . 'has not been created.');
                }

                wp_enqueue_script('seven_tech_schedule_react_index', SEVEN_TECH_SCHEDULE_URL . 'build/' . 'index.js', ['wp-element'], 1.0, true);
            }
        }
    }

    function load_pages_react()
    {
        foreach ($this->page_titles as $page) {
            if (is_front_page()) {
                $fileName = ucwords($page);
                $filePath = SEVEN_TECH_SCHEDULE_URL . 'build/' . 'src_views_' . $fileName . '_jsx.js';

                if ($filePath) {
                    wp_enqueue_script('seven_tech_react_' . $fileName, $filePath, ['wp-element'], 1.0, true);
                } else {
                    error_log('Post Type' . $page . 'has not been created.');
                }

                wp_enqueue_script('seven_tech_react_index', SEVEN_TECH_SCHEDULE_URL . 'build/' . 'index.js', ['wp-element'], 1.0, true);
            }
        }
    }

    function load_post_types_archive_jsx()
    {
        foreach ($this->post_types as $post_type) {
            if (is_post_type_archive($post_type) || is_singular($post_type)) {
                $fileName = ucwords($post_type);
                $filePath = SEVEN_TECH_SCHEDULE_URL . 'build/' . 'src_views_' . $fileName . '_jsx.js';

                if ($filePath) {
                    wp_enqueue_script('seven_tech_react_' . $fileName, $filePath, ['wp-element'], 1.0, true);
                } else {
                    error_log('Post Type' . $post_type . 'has not been created.');
                }

                wp_enqueue_script('seven_tech_react_index', SEVEN_TECH_SCHEDULE_URL . 'build/' . 'index.js', ['wp-element'], 1.0, true);
            }
        }
    }

    function load_post_types_single_jsx()
    {
        $post_types = [
            [
                'archive_page' => 'SCHEDULEs',
                'single_page' => 'SCHEDULE'
            ],
           
        ];

        foreach ($post_types as $post_type_config) {
            $archive_page = $post_type_config['archive_page'];
            $single_page = $post_type_config['single_page'];

            if (is_post_type_archive($archive_page) || is_singular($archive_page) || is_singular($single_page)) {
                $fileName = ucwords($single_page);
                $filePath = SEVEN_TECH_SCHEDULE_URL . 'build/' . 'src_views_' . $fileName . '_jsx.js';

                if (file_exists($filePath)) {
                    wp_enqueue_script('seven_tech_react_' . $fileName, $filePath, ['wp-element'], '1.0', true);
                } else {
                    error_log('Script file not found for post type: ' . $archive_page);
                }
            }
        }

        wp_enqueue_script('seven_tech_react_index', SEVEN_TECH_SCHEDULE_URL . 'build/index.js', ['wp-element'], '1.0', true);
    }

    function set_script_type_to_module($tag, $handle)
    {
        if (strpos($handle, 'seven_tech_react_') === 0) {
            $tag = str_replace('type=\'text/javascript\'', 'type=\'module\'', $tag);
        }
        return $tag;
    }

    function load_firebase()
    { ?>
        <script type="module">
            import {
                initializeApp
            } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
            import {
                getAuth
            } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";
        </script>
<?php }
}
