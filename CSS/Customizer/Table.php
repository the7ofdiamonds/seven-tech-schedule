<?php

namespace SEVEN_TECH\Schedule\CSS\Customizer;

class Table
{
    private $customizer;

    public function __construct()
    {
        $this->customizer = new Customizer;
    }

    function seven_tech_schedule_table_section($wp_customize)
    {
        $wp_customize->add_section(
            'seven_tech_schedule_table_settings',
            array(
                'priority'       => 9,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __('Table', 'seven-tech-schedule'),
                'description'    => __('Table Settings', 'seven-tech-schedule'),
                'panel'  => 'seven_tech_schedule_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_table_color_hue', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_setting('seven_tech_schedule_table_color_saturation', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_setting('seven_tech_schedule_table_color_lightness', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_setting('seven_tech_schedule_table_body_color_hue', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_setting('seven_tech_schedule_table_body_color_saturation', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_setting('seven_tech_schedule_table_body_color_lightness', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_table_color_hue',
            array(
                'type' => 'input',
                'label' => __('Header & Footer Hue', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_table_settings',
            )
        );

        $wp_customize->add_control(
            'seven_tech_schedule_table_color_saturation',
            array(
                'type' => 'input',
                'label' => __('Header & Footer Saturation', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_table_settings',
            )
        );

        $wp_customize->add_control(
            'seven_tech_schedule_table_color_lightness',
            array(
                'type' => 'input',
                'label' => __('Header & Footer Lightness', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_table_settings',
            )
        );

        $wp_customize->add_control(
            'seven_tech_schedule_table_body_color_hue',
            array(
                'type' => 'input',
                'label' => __('Body Hue', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_table_settings',
            )
        );

        $wp_customize->add_control(
            'seven_tech_schedule_table_body_color_saturation',
            array(
                'type' => 'input',
                'label' => __('Body Saturation', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_table_settings',
            )
        );

        $wp_customize->add_control(
            'seven_tech_schedule_table_body_color_lightness',
            array(
                'type' => 'input',
                'label' => __('Body Lightness', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_table_settings',
            )
        );
    }

    function load_css()
    {
?>
        <style>
            :root {
               --seven-tech-schedule-table-color: <?php
                                            $h = !empty(get_theme_mod('seven_tech_schedule_table_color_hue')) ? get_theme_mod('seven_tech_schedule_table_color_hue') : 0;
                                            $s = !empty(get_theme_mod('seven_tech_schedule_table_color_saturation')) ? get_theme_mod('seven_tech_schedule_table_color_saturation') : 0;
                                            $l = !empty(get_theme_mod('seven_tech_schedule_table_color_lightness')) ? get_theme_mod('seven_tech_schedule_table_color_lightness') : 0;

                                            echo "hsl({$h}, {$s}%, {$l}%)";
                                            ?>;

               --seven-tech-schedule-table-color-text: <?php
                                                    $hue = !empty(get_theme_mod('seven_tech_schedule_table_color_hue')) ? get_theme_mod('seven_tech_schedule_table_color_hue') : 0;
                                                    $lightness = !empty(get_theme_mod('seven_tech_schedule_table_color_lightness')) ? get_theme_mod('seven_tech_schedule_table_color_lightness') : 0;

                                                    $l = $this->customizer->calculate_lightness($hue, $lightness);

                                                    echo "hsl({$h}, {$s}%, {$l}%)";
                                                    ?>;

               --seven-tech-schedule-table-border-color: <?php
                                                    $h = !empty(get_theme_mod('seven_tech_schedule_table_body_color_hue')) ? get_theme_mod('seven_tech_schedule_table_body_color_hue') : 0;
                                                    $s = !empty(get_theme_mod('seven_tech_schedule_table_body_color_saturation')) ? get_theme_mod('seven_tech_schedule_table_body_color_saturation') : 0;
                                                    $l = !empty(get_theme_mod('seven_tech_schedule_table_body_color_lightness')) ? get_theme_mod('seven_tech_schedule_table_body_color_lightness') : 100;

                                                    echo "hsl({$h}, {$s}%, {$l}%)";
                                                    ?>;

               --seven-tech-schedule-table-body-color: <?php
                                                    echo "hsl({$h}, {$s}%, {$l}%)";
                                                    ?>;

               --seven-tech-schedule-table-body-color-text: <?php
                                                        $hue = !empty(get_theme_mod('seven_tech_schedule_table_body_color_hue')) ? get_theme_mod('seven_tech_schedule_table_body_color_hue') : 0;
                                                        $lightness = !empty(get_theme_mod('seven_tech_schedule_table_body_color_lightness')) ? get_theme_mod('seven_tech_schedule_table_body_color_lightness') : 100;

                                                        $l = $this->customizer->calculate_lightness($hue, $lightness);

                                                        echo "hsl({$h}, {$s}%, {$l}%)";
                                                        ?>;

               --seven-tech-schedule-table-body-border-color: <?php
                                                        $hue = !empty(get_theme_mod('seven_tech_schedule_table_body_color_hue')) ? get_theme_mod('seven_tech_schedule_table_body_color_hue') : 0;
                                                        $lightness = !empty(get_theme_mod('seven_tech_schedule_table_body_color_lightness')) ? get_theme_mod('seven_tech_schedule_table_body_color_lightness') : 100;

                                                        $l = $this->customizer->calculate_lightness($hue, $lightness);

                                                        echo "hsl({$h}, {$s}%, {$l}%)";
                                                        ?>;
            }
        </style>
<?php
    }
}
