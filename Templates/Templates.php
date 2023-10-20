<?php

namespace SEVEN_TECH_Schedule\Templates;

class Templates
{
    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_locations_archive_template']);
        add_filter('single_template', [$this, 'get_locations_single_template']);
    }

    function get_locations_archive_template($archive_template)
    {
        if (is_post_type_archive('locations')) {
            $archive_template = SEVEN_TECH_SCHEDULE . 'Post_Types/Locations/archive-locations.php';
        }

        return $archive_template;
    }

    function get_locations_single_template($singular_template)
    {
        if (is_singular('locations')) {
            $singular_template = SEVEN_TECH_SCHEDULE . 'Post_Types/Locations/single-locations.php';
        }

        return $singular_template;
    }
}
