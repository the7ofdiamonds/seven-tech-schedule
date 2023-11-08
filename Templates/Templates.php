<?php

namespace SEVEN_TECH\Schedule\Templates;

use SEVEN_TECH\Schedule\CSS\CSS;
use SEVEN_TECH\Schedule\JS\JS;

class Templates
{
    private $css_file;
    private $js_file;

    public function __construct()
    {
        add_filter('frontpage_template', [$this, 'get_custom_front_page']);

        $this->css_file = new CSS;
        $this->js_file = new JS;

        new Templates_Post_Types;
    }

    function get_custom_front_page($frontpage_template)
    {
        if (is_front_page()) {
            add_action('wp_head', [$this->css_file, 'load_front_page_css']);
            add_action('wp_footer', [$this->js_file, 'load_front_page_react']);
        }

        return $frontpage_template;
    }
}
