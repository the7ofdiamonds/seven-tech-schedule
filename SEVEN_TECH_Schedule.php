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
use SEVEN_TECH\Schedule\Shortcodes\Shortcodes;
use SEVEN_TECH\Schedule\Templates\Templates;

use Kreait\Firebase\Factory;

class SEVEN_TECH_Schedule
{
    public function __construct()
    {
        // add_filter('upload_mimes', [$this, 'add_theme_support_upload_mimes']);

        new Admin;
        new API;
        new CSS;
        new Database;
        new JS;
        new Pages;
        new Post_Types;
        new Shortcodes;
        new Templates;
    }

    function activate()
    {
        flush_rewrite_rules();
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

$seven_tech = new SEVEN_TECH_Schedule();
register_activation_hook(__FILE__, [$seven_tech, 'activate']);
// register_deactivation_hook(__FILE__, array($thfw_users, 'deactivate'));