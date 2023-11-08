<?php

namespace SEVEN_TECH\Schedule\CSS;

use SEVEN_TECH\Schedule\Pages\Pages;
use SEVEN_TECH\Schedule\Post_Types\Post_Types;
use SEVEN_TECH\Schedule\CSS\Customizer\Customizer;

class CSS
{
    private $handle_prefix;
    private $dir;
    private $dirURL;
    private $cssFolderPath;
    private $cssFolderPathURL;
    private $cssFileName;
    private $filePath;
    private $page_titles;
    private $post_types;

    public function __construct()
    {
        $this->dir = SEVEN_TECH_SCHEDULE;
        $this->dirURL = SEVEN_TECH_SCHEDULE_URL;

        $this->handle_prefix = 'seven_tech_schedule_';
        $this->cssFileName = 'seven-tech-schedule.css';
        $this->cssFolderPath = $this->dir . 'CSS/';
        $this->cssFolderPathURL = $this->dirURL . 'CSS/';

        $this->filePath = $this->cssFolderPath . $this->cssFileName;

        $pages = new Pages;
        $posttypes = new Post_Types;

        $this->page_titles = [
            ...$pages->pages,
            ...$pages->protected_pages
        ];
        $this->post_types = $posttypes->post_types;

        // new Customizer;
    }

    function load_front_page_css()
    {
        if (is_front_page()) {
            if ($this->filePath) {
                wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                wp_enqueue_style($this->handle_prefix . 'css');
            } else {
                error_log('CSS file is missing at :' . $this->filePath);
            }
        }
    }

    function load_pages_css()
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {
            foreach ($this->page_titles as $page) {
                if (is_page($page)) {
                    if ($this->filePath) {
                        wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                        wp_enqueue_style($this->handle_prefix . 'css');
                    } else {
                        error_log('CSS file is missing at :' . $this->filePath);
                    }
                }
            }
        }
    }

    function load_post_types_css()
    {
        if (is_array($this->post_types) && count($this->post_types) > 0) {
            foreach ($this->post_types as $post_type) {
                if (is_post_type_archive($post_type['name']) || is_singular($post_type['name'])) {
                    if ($this->filePath) {
                        wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                        wp_enqueue_style($this->handle_prefix . 'css');
                    } else {
                        error_log('CSS file is missing at :' . $this->filePath);
                    }
                }
            }
        }
    }
}
