<?php

namespace SEVEN_TECH_Schedule\Shortcodes;

class Shortcodes
{
    public function __construct()
    {
        add_shortcode('seven-tech-schedule', [$this, 'seven_tech_schedule_shortcode']);
    }

    function seven_tech_schedule_shortcode()
    {
        include SEVEN_TECH_SCHEDULE . 'includes/react.php';
    }
}
