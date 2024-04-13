<?php

namespace SEVEN_TECH\Schedule\CSS\Customizer;

class BorderRadius
{
    public function __construct()
    {
    }

    function seven_tech_schedule_border_radius_section($wp_customize)
    {
        $wp_customize->add_section(
            'seven_tech_schedule_border_radius_settings',
            array(
                'priority'       => 9,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __('Border Radius', 'seven-tech-schedule'),
                'description'    =>  __('Border Radius Settings', 'seven-tech-schedule'),
                'panel'  => 'seven_tech_schedule_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_border_radius', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_border_radius',
            array(
                'type' => 'input',
                'label' => __('Border Radius', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_border_radius_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_border_radius_hover', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_border_radius_hover',
            array(
                'type' => 'input',
                'label' => __('Border Radius Hover', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_border_radius_settings',
            )
        );
    }

    function load_css()
    {
?>
        <style>
            :root {
                --seven-tech-schedule-border-radius: <?php
                                                        if (empty(get_theme_mod('seven_tech_schedule_border_radius'))) {
                                                            echo esc_html('0.5em');
                                                        } else {
                                                            echo esc_html(get_theme_mod('seven_tech_schedule_border_radius'));
                                                        } ?>;
                --seven-tech-schedule-border-radius-hover: <?php
                                                                if (empty(get_theme_mod('seven_tech_schedule_border_radius_hover'))) {
                                                                    echo esc_html('0.25em');
                                                                } else {
                                                                    echo esc_html(get_theme_mod('seven_tech_schedule_border_radius_hover'));
                                                                } ?>;
            }
        </style>
<?php
    }
}
