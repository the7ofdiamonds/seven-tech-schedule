<?php

namespace SEVEN_TECH_Schedule\Templates;

use SEVEN_TECH_Schedule\CSS\CSS;
use SEVEN_TECH_Schedule\JS\JS;

class Templates_Post_Types
{
    private $css_file;
    private $js_file;

    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_schedule_archive_template']);
        add_filter('single_template', [$this, 'get_schedule_single_template']);

        $this->css_file = new CSS;
        $this->js_file = new JS;
    }

    function get_schedule_archive_template($archive_template)
    {
        if (is_post_type_archive('schedule')) {
            $archive_template = SEVEN_TECH_SCHEDULE . 'Post_Types/Schedule/archive-schedule.php';

            if (file_exists($archive_template)) {
                add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                return $archive_template;
            } else {
                error_log('archive template');
            }
        }

        return $archive_template;
    }

    function get_schedule_single_template($singular_template)
    {
        if (is_singular('schedule')) {
            $singular_template = SEVEN_TECH_SCHEDULE . 'Post_Types/Schedule/single-schedule.php';

            if (file_exists($singular_template)) {
                add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);

                return $singular_template;
            }
        }

        return $singular_template;
    }
}
