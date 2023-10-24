<?php

namespace SEVEN_TECH_Schedule\JS;

use SEVEN_TECH_Schedule\Pages\Pages;
use SEVEN_TECH_Schedule\Post_Types\Post_Types;

class JS
{
    private $handle_prefix;
    private $page_titles;
    private $post_types;
    private $includes_url;
    private $buildFilePrefix;
    private $buildFilePrefixURL;
    private $front_page_react;

    public function __construct()
    {
        // add_action('wp_footer', [$this, 'load_js']);

        $this->handle_prefix = 'seven_tech_schedule_';
        $this->buildFilePrefix = SEVEN_TECH_SCHEDULE . 'build/src_views_';
        $this->buildFilePrefixURL = SEVEN_TECH_SCHEDULE_URL . 'build/src_views_';

        $this->includes_url = includes_url();

        $pages = new Pages;
        $posttypes = new Post_Types;

        $this->page_titles = $pages->page_titles;
        $this->front_page_react = $pages->front_page_react;
        $this->post_types = $posttypes->post_types;
    }

    function load_js()
    {
        // Animations
        wp_register_script($this->handle_prefix, SEVEN_TECH_SCHEDULE_URL . 'JS/seven-tech.js', array('jquery'), false, false);
        wp_enqueue_script($this->handle_prefix);
    }

    function load_front_page_react()
    {
        if (is_front_page()) {
            if (is_array($this->front_page_react) && !empty($this->front_page_react)) {
                foreach ($this->front_page_react as $section) {
                    $fileName = ucwords($section);
                    $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                    $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                    wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                    if (file_exists($filePath)) {
                        wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                    } else {
                        error_log($fileName . ' page has not been created in react JSX.');
                    }

                    wp_enqueue_script($this->handle_prefix . 'react_index', SEVEN_TECH_SCHEDULE_URL . 'build/index.js', ['wp-element'], '1.0', true);
                }
            } else {
                error_log('There are no front page react files to load at SEVEN_TECH Pages');
            }
        }
    }

    function load_pages_react()
    {
        if (is_array($this->page_titles) && !empty($this->page_titles)) {
            foreach ($this->page_titles as $page) {
                if (is_page($page)) {
                    $fileName = ucwords($page);
                    $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                    $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                    wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                    if (file_exists($filePath)) {
                        wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                    } else {
                        error_log($page . ' page has not been created in react JSX.');
                    }

                    wp_enqueue_script($this->handle_prefix . 'react_index', SEVEN_TECH_SCHEDULE_URL . 'build/index.js', ['wp-element'], '1.0', true);
                }
            }
        } else {
            error_log('There are no page titles in the array at SEVEN_TECH Pages');
        }
    }

    function load_post_types_archive_react()
    {
        foreach ($this->post_types as $post_type) {
            if (is_array($post_type) && isset($post_type['name']) && isset($post_type['archive_page'])) {
                $fileName = ucwords($post_type['archive_page']);
                $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                if (file_exists($filePath)) {
                    wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                } else {
                    error_log('Post Type ' . $post_type['archive_page'] . ' page has not been created in react JSX.');
                }

                wp_enqueue_script($this->handle_prefix . 'react_index', SEVEN_TECH_SCHEDULE_URL . 'build/index.js', ['wp-element'], '1.0', true);
            } else {
                error_log('There are no post types in the array at SEVEN_TECH Post_Types');
            }
        }
    }

    function load_post_types_single_react()
    {
        foreach ($this->post_types as $post_type) {
            if (is_array($post_type) && isset($post_type['name']) && isset($post_type['single_page'])) {
                if (is_singular($post_type['name'])) {
                    $fileName = ucwords($post_type['single_page']);
                    $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                    $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                    wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                    if (file_exists($filePath)) {
                        wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                    } else {
                        error_log('Post Type ' . $post_type['single_page'] . ' page has not been created in react JSX.');
                    }

                    wp_enqueue_script($this->handle_prefix . 'react_index', SEVEN_TECH_SCHEDULE_URL . 'build/index.js', ['wp-element'], '1.0', true);
                }
            }
        }
    }
}
