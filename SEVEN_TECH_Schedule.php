<?php

namespace SEVEN_TECH\Schedule;

/**
 * @package SEVEN_TECH\Schedule
 */
/*
Plugin Name: SEVEN TECH Schedule
Plugin URI: 
Description: Schedule.
Version: 1.0.0
Author: THE7OFDIAMONDS.TECH
Author URI: http://THE7OFDIAMONDS.TECH
License: 
Text Domain: seven-tech-schedule
*/

/*
Licensing Info is needed
*/

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('SEVEN_TECH_SCHEDULE', WP_PLUGIN_DIR . '/seven-tech-schedule/');
define('SEVEN_TECH_SCHEDULE_URL', WP_PLUGIN_URL . '/seven-tech-schedule/');

require_once SEVEN_TECH_SCHEDULE . 'vendor/autoload.php';

use SEVEN_TECH\Schedule\Admin\Admin;
use SEVEN_TECH\Schedule\API\API;
use SEVEN_TECH\Schedule\CSS\CSS;
use SEVEN_TECH\Schedule\Database\Database;
use SEVEN_TECH\Schedule\JS\JS;
use SEVEN_TECH\Schedule\Pages\Pages;
use SEVEN_TECH\Schedule\Post_Types\Post_Types;
use SEVEN_TECH\Schedule\Roles\Roles;
use SEVEN_TECH\Schedule\Router\Router;
use SEVEN_TECH\Schedule\Shortcodes\Shortcodes;
use SEVEN_TECH\Schedule\Taxonomies\Taxonomies;
use SEVEN_TECH\Schedule\Templates\Templates;
use SEVEN_TECH\Schedule\Templates\TemplatesCustom;

class SEVEN_TECH_Schedule
{
    public $pages;
    public $css;
    public $js;
    public $posttypes;
    public $router;
    public $templates;
    public $roles;

    public function __construct()
    {
        // add_filter('upload_mimes', [$this, 'add_theme_support_upload_mimes']);

        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_{$plugin}", [$this, 'settings_link']);

        $admin = new Admin;

        add_action('admin_init', function () use ($admin) {
            $admin;
        });

        add_action('rest_api_init', function () {
            new API();
        });

        $pages = new Pages;
        $posttypes = new Post_Types;
        $taxonomies = new Taxonomies;
        $css = new CSS;
        $js = new JS;
        $templates = new Templates(
            $css,
            $js,
        );
        $router = new Router(
            $pages,
            $posttypes,
            $taxonomies,
            $templates
        );

        add_action('init', function () use ($posttypes, $taxonomies, $router) {
            $posttypes->custom_post_types();
            $taxonomies->custom_taxonomy();
            $router->load_page();
            $router->react_rewrite_rules();
            new Shortcodes;
        });

        // add_action('customize_register', function ($wp_customize) {
        //     (new Customizer)->register_customizer_panel($wp_customize);
        //     (new BorderRadius)->seven_tech_border_radius_section($wp_customize);
        //     (new Color)->seven_tech_color_section($wp_customize);
        //     (new Shadow)->seven_tech_shadow_section($wp_customize);
        //     (new SocialBar)->seven_tech_social_bar_section($wp_customize);
        // });

        $this->router = new Router(
            $pages,
            $posttypes,
            $taxonomies,
            $templates
        );
        $this->pages = new Pages;
    }

    function activate()
    {
        $this->router->react_rewrite_rules();
        $this->pages->add_pages();
    }

    function deactivate()
    {
        flush_rewrite_rules();
    }

    public function settings_link($links)
    {
        $settings_link = '<a href="' . admin_url('admin.php?page=seven-tech-schedule') . '">Settings</a>';
        array_push($links, $settings_link);

        return $links;
    }

    function add_theme_support_upload_mimes($mimes)
    {
        $mimes['jpeg'] = 'image/jpeg';
        $mimes['jpg'] = 'image/jpeg';
        $mimes['svg'] = 'image/svg+xml';
        $mimes['eps'] = 'application/postscript';
        $mimes['ai'] = 'application/postscript';

        return $mimes;
    }
}

$seven_tech_schedule = new SEVEN_TECH_Schedule();
register_activation_hook(__FILE__, [$seven_tech_schedule, 'activate']);
register_deactivation_hook(__FILE__, array($seven_tech_schedule, 'deactivate'));