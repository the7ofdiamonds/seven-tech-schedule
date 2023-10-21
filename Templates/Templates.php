<?php

namespace SEVEN_TECH_Schedule\Templates;

class Templates
{
    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_schedule_archive_template']);
        add_filter('single_template', [$this, 'get_schedule_single_template']);
    }

    function get_schedule_archive_template($archive_template)
    {
        if (is_post_type_archive('schedule')) {
            $archive_template = SEVEN_TECH_SCHEDULE . 'Post_Types/Schedule/archive-schedule.php';
        }

        return $archive_template;
    }

    function get_schedule_single_template($singular_template)
    {
        if (is_singular('schedule')) {
            $singular_template = SEVEN_TECH_SCHEDULE . 'Post_Types/Schedule/single-schedule.php';
        }

        return $singular_template;
    }
}
