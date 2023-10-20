<?php

namespace SEVEN_TECH_Schedule\Shortcodes;

class Shortcodes
{
    public function __construct()
    {
        // add_shortcode('seven-tech-locations', [$this, 'seven_tech_locations_shortcode']);
    }

    function seven_tech_locations_shortcode()
    {
        include SEVEN_TECH_SCHEDULE . 'includes/react.php';
    }
}
