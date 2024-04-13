<?php

namespace SEVEN_TECH\Schedule\CSS\Customizer;

class StatusBar
{
    private $customizer;

    public function __construct()
    {
        $this->customizer = new Customizer;
    }

    function seven_tech_schedule_status_bar_section($wp_customize)
    {
        $wp_customize->add_section(
            'seven_tech_schedule_status_bar_settings',
            array(
                'priority'       => 9,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __('Status Bar', 'seven-tech-schedule'),
                'description'    =>  __('Status Bar Settings', 'seven-tech-schedule'),
                'panel'  => 'seven_tech_schedule_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_success_color', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_success_color',
            array(
                'type' => 'input',
                'label' => __('Success Color', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_status_bar_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_error_color', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_error_color',
            array(
                'type' => 'input',
                'label' => __('Error Color', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_status_bar_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_caution_color', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_caution_color',
            array(
                'type' => 'input',
                'label' => __('Caution Color', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_status_bar_settings',
            )
        );

        $wp_customize->add_setting('seven_tech_schedule_info_color', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'seven_tech_schedule_info_color',
            array(
                'type' => 'input',
                'label' => __('Info Color', 'seven-tech-schedule'),
                'section' => 'seven_tech_schedule_status_bar_settings',
            )
        );
    }

    function load_css()
    {
?>
        <style>
            :root {
                --seven-tech-schedule-color-success: <?php
                                                        $h = !empty(get_theme_mod('seven_tech_schedule_success_color_hue')) ? get_theme_mod('seven_tech_schedule_success_color_hue') : 120;
                                                        $s = !empty(get_theme_mod('seven_tech_schedule_success_color_saturation')) ? get_theme_mod('seven_tech_schedule_success_color_saturation') : 100;
                                                        $l = !empty(get_theme_mod('seven_tech_schedule_success_color_lightness')) ? get_theme_mod('seven_tech_schedule_success_color_lightness') : 30;

                                                        echo "hsl({$h}, {$s}%, {$l}%)";
                                                        ?>;

                --seven-tech-schedule-color-success-text: <?php
                                                            $lightness = $this->customizer->calculate_lightness($h, $l);

                                                            echo "hsl({$h}, {$s}%, {$lightness}%)";
                                                            ?>;

                --seven-tech-schedule-color-error: <?php
                                                        $h = !empty(get_theme_mod('seven_tech_schedule_error_color_hue')) ? get_theme_mod('seven_tech_schedule_error_color_hue') : 0;
                                                        $s = !empty(get_theme_mod('seven_tech_schedule_error_color_saturation')) ? get_theme_mod('seven_tech_schedule_error_color_saturation') : 100;
                                                        $l = !empty(get_theme_mod('seven_tech_schedule_error_color_lightness')) ? get_theme_mod('seven_tech_schedule_error_color_lightness') : 50;

                                                        echo "hsl({$h}, {$s}%, {$l}%)";
                                                        ?>;

                --seven-tech-schedule-color-error-text: <?php
                                                            $lightness = $this->customizer->calculate_lightness($h, $l);

                                                            echo "hsl({$h}, {$s}%, {$lightness}%)";
                                                            ?>;

                --seven-tech-schedule-color-caution: <?php
                                                        $h = !empty(get_theme_mod('seven_tech_schedule_caution_color_hue')) ? get_theme_mod('seven_tech_schedule_caution_color_hue') : 60;
                                                        $s = !empty(get_theme_mod('seven_tech_schedule_caution_color_saturation')) ? get_theme_mod('seven_tech_schedule_caution_color_saturation') : 100;
                                                        $l = !empty(get_theme_mod('seven_tech_schedule_caution_color_lightness')) ? get_theme_mod('seven_tech_schedule_caution_color_lightness') : 50;

                                                        echo "hsl({$h}, {$s}%, {$l}%)";
                                                        ?>;

                --seven-tech-schedule-color-caution-text: <?php
                                                            $lightness = $this->customizer->calculate_lightness($h, $l);

                                                            echo "hsl({$h}, {$s}%, {$lightness}%)";
                                                            ?>;

                --seven-tech-schedule-color-info: <?php
                                                    $h = !empty(get_theme_mod('seven_tech_schedule_info_color_hue')) ? get_theme_mod('seven_tech_schedule_info_color_hue') : 240;
                                                    $s = !empty(get_theme_mod('seven_tech_schedule_info_color_saturation')) ? get_theme_mod('seven_tech_schedule_info_color_saturation') : 100;
                                                    $l = !empty(get_theme_mod('seven_tech_schedule_info_color_lightness')) ? get_theme_mod('seven_tech_schedule_info_color_lightness') : 50;

                                                    echo "hsl({$h}, {$s}%, {$l}%)";
                                                    ?>;

                --seven-tech-schedule-color-info-text: <?php
                                                            $lightness = $this->customizer->calculate_lightness($h, $l);

                                                            echo "hsl({$h}, {$s}%, {$lightness}%)";
                                                            ?>;
            }
        </style>
<?php
    }
}
