<?php

namespace SEVEN_TECH\Schedule\Admin;


class Admin
{
    private $admin_team;
    private $admin_location;
    private $admin_office_hours;
    private $admin_social_bar;

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_custom_menu_page']);
        add_action('admin_menu', [new AdminOfficeHours, 'register_custom_submenu_page']);

        // add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
    }

    function register_custom_menu_page()
    {
        add_menu_page(
            'SEVEN TECH SCHEDULE',
            'SCHEDULE',
            'manage_options',
            'seven-tech-schedule',
            '',
            'dashicons-info',
            103
        );
    }
}
