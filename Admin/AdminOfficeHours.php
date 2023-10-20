<?php

namespace SEVEN_TECH_Schedule\Admin;

class AdminOfficeHours
{

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_custom_submenu_page']);
    }

    function register_custom_submenu_page()
    {

        add_submenu_page('seven_tech_admin', 'Add Office Hours', 'Add Hours', 'manage_options', 'seven_tech_office_hours', [$this, 'create_section'], 2);
        add_action('admin_init', [$this, 'register_section']);
    }

    function create_section()
    {
        include SEVEN_TECH . 'includes/admin-add-office-hours.php';
    }

    function register_section()
    {
        add_settings_section('orb-admin-office-hours', '', [$this, 'section_description'], 'orb_office_hours');
        register_setting('orb-admin-office-hours-group', 'orb_office_hours');
        register_setting('orb-admin-office-hours-group', 'orb_calendar_id');
        register_setting('orb-admin-office-hours-group', 'orb_event_max_results');
        register_setting('orb-admin-office-hours-group', 'orb_event_summary');
        register_setting('orb-admin-office-hours-group', 'orb_event_duration_hours');
        register_setting('orb-admin-office-hours-group', 'orb_event_duration_minutes');
        register_setting('orb-admin-office-hours-group', 'orb_event_time_zone');
        add_settings_field('orb_office_hours', '', [$this, 'office_hours'], 'orb_office_hours', 'orb-admin-office-hours');
        add_settings_field('orb_calendar_id', 'Add Calendar ID', [$this, 'calendar_id'], 'orb_office_hours', 'orb-admin-office-hours');
        add_settings_field('orb_event_max_results', 'Set Max Results', [$this, 'max_results'], 'orb_office_hours', 'orb-admin-office-hours');
        add_settings_field('orb_event_summary', 'Add Title of Event', [$this, 'event_summary'], 'orb_office_hours', 'orb-admin-office-hours');
        add_settings_field('orb_event_duration_hours', 'Add Event Duration', [$this, 'event_duration'], 'orb_office_hours', 'orb-admin-office-hours');
        add_settings_field('orb_event_time_zone', 'Add Event Time Zone', [$this, 'event_time_zone'], 'orb_office_hours', 'orb-admin-office-hours');
    }

    function section_description()
    {
        echo 'Add your hours of operation';
    }

    function office_hours()
    {
        $days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

        // Get the office hours as a serialized string from the option
        $office_hours = get_option("orb_office_hours");

        echo '<table>';
        echo '<thead>';
        echo '<th>Day</th>';
        echo '<th>Start Time</th>';
        echo '<th>End Time</th>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($days as $day) {
            // Check if the day exists in the array before accessing its values
            if (isset($office_hours[$day . '_start']) && isset($office_hours[$day . '_end'])) {
                $start_time = esc_attr($office_hours[$day . '_start']);
                $end_time = esc_attr($office_hours[$day . '_end']);
            } else {
                $start_time = '';
                $end_time = '';
            }

            echo '<tr>';
            echo "<td>{$day}</td>";
            echo "<td><input class='admin-input' type='time' name='orb_office_hours[{$day}_start]' value='{$start_time}'></td>";
            echo "<td><input class='admin-input' type='time' name='orb_office_hours[{$day}_end]' value='{$end_time}'></td>";
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }

    function calendar_id()
    {
        $calendar_id = get_option('orb_calendar_id');
        echo '<input class="admin-input" type="text" name="orb_calendar_id" value="' . $calendar_id . '" >';
    }

    function max_results()
    {
        $event_max_results = get_option('orb_event_max_results');
        echo '<input type="number" name="orb_event_max_results" value="' . $event_max_results . '" >';
    }

    function event_summary()
    {
        $event_summary = esc_attr(get_option('orb_event_summary'));
        echo '<input class="admin-input" type="text" name="orb_event_summary" value="' . $event_summary . '" >';
    }

    public function event_duration()
    {
        $event_duration_hours = get_option('orb_event_duration_hours');
        $event_duration_minutes = get_option('orb_event_duration_minutes');

        echo '<label>Hours: <input type="number" name="orb_event_duration_hours" value="' . $event_duration_hours . '" min="0" max="24"></label>';
        echo '<label>Minutes: <input type="number" name="orb_event_duration_minutes" value="' . $event_duration_minutes . '" min="0" max="59"></label>';
    }


    function event_time_zone()
    {
        $time_zone = esc_attr(get_option('orb_event_time_zone'));
        echo '<input class="admin-input" type="text" name="orb_event_time_zone" value="' . $time_zone . '" >';
    }
}
