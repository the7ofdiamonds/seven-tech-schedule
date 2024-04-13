<?php

namespace SEVEN_TECH\Schedule\CSS\Customizer;

class Shadow
{
    public function __construct()
    {
    }

    function seven_tech_schedule_shadow_section($wp_customize)
    {
        $wp_customize->add_section(
            'seven_tech_schedule_shadow_settings',
            array(
                'priority'       => 9,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __('Shadows', 'seven-tech-schedule'),
                'description'    =>  __('Shadow Settings', 'seven-tech-schedule'),
                'panel'  => 'seven_tech_schedule_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_card_shadow', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_card_shadow',
            array(
                'type' => 'input',
                'label' => __('Card Box Shadow', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_shadow_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_button_shadow', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_button_shadow',
            array(
                'type' => 'input',
                'label' => __('Button Box Shadow', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_shadow_settings',
            )
        );
    }

    function load_css()
    {
?>
        <style>
            :root {
                --seven-tech-schedule-card-shadow: <?php
                                                        if (empty(get_theme_mod('seven_tech_schedule_card_shadow'))) {
                                                            echo esc_html('0 0 0.5em rgba(0, 0, 0, 0.85)');
                                                        } else {
                                                            error_log(get_theme_mod('seven_tech_schedule_card_shadow'));
                                                            echo esc_html(get_theme_mod('seven_tech_schedule_card_shadow'));
                                                        } ?>;
                --seven-tech-schedule-btn-shadow: <?php
                                                    if (empty(get_theme_mod('seven_tech_schedule_button_shadow'))) {
                                                        echo esc_html('0 0 0.5em rgba(0, 0, 0, 0.85)');
                                                    } else {
                                                        echo esc_html(get_theme_mod('seven_tech_schedule_button_shadow'));
                                                    } ?>;
                --seven-tech-schedule-btn-shadow-hover: <?php
                                                    if (empty(get_theme_mod('seven_tech_schedule_button_shadow_hover'))) {
                                                        echo esc_html('unset');
                                                    } else {
                                                        echo esc_html(get_theme_mod('seven_tech_schedule_button_shadow_hover'));
                                                    } ?>;
            }
        </style>
<?php
    }
}
