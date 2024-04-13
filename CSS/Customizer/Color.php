<?php

namespace SEVEN_TECH\Schedule\CSS\Customizer;

use WP_Customize_Color_Control;

class Color
{
	public function __construct()
	{
	}

	function seven_tech_schedule_color_section($wp_customize)
	{
		$wp_customize->add_section(
			'seven_tech_schedule_color_settings',
			array(
				'priority'       => 9,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __('Colors', 'seven-tech-schedule'),
				'description'    =>  __('Color Settings', 'seven-tech-schedule'),
				'panel'  => 'seven_tech_schedule_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_primary_color_hue', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'seven_tech_schedule_primary_color_hue',
				array(
					'type' => 'text',
					'label' => __('Primary Color Hue', 'seven-tech-schedule'),
					'section' => 'seven_tech_schedule_color_settings',
				)
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_primary_color_saturation', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'seven_tech_schedule_primary_color_saturation',
				array(
					'type' => 'text',
					'label' => __('Primary Color Saturation', 'seven-tech-schedule'),
					'section' => 'seven_tech_schedule_color_settings',
				)
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_primary_color_lightness', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'seven_tech_schedule_primary_color_lightness',
				array(
					'type' => 'text',
					'label' => __('Primary Color Lightness', 'seven-tech-schedule'),
					'section' => 'seven_tech_schedule_color_settings',
				)
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_secondary_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_secondary_color',
			array(
				'type' => 'color',
				'label' => __('Secondary Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_tertiary_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_tertiary_color',
			array(
				'type' => 'color',
				'label' => __('Tertiary Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_quaternary_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_quaternary_color',
			array(
				'type' => 'color',
				'label' => __('Quaternary Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_success_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_success_color',
			array(
				'type' => 'color',
				'label' => __('Success Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_error_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_error_color',
			array(
				'type' => 'color',
				'label' => __('Error Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_caution_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_caution_color',
			array(
				'type' => 'color',
				'label' => __('Caution Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_info_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_info_color',
			array(
				'type' => 'color',
				'label' => __('Info Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_btn_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_btn_color',
			array(
				'type' => 'color',
				'label' => __('Button Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);

		$wp_customize->add_setting('seven_tech_schedule_btn_font_color', array(
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control(
			'seven_tech_schedule_btn_font_color',
			array(
				'type' => 'color',
				'label' => __('Button Text Color', 'seven-tech-schedule'),
				'section' => 'seven_tech_schedule_color_settings',
			)
		);
	}

	function load_css()
	{
?>
		<style>
			:root {
				--seven-tech-schedule-color-primary: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_primary_color_hue')) ? get_theme_mod('seven_tech_schedule_primary_color_hue') : 0;
										$s = !empty(get_theme_mod('seven_tech_schedule_primary_color_saturation')) ? get_theme_mod('seven_tech_schedule_primary_color_saturation') : 0;
										$l = !empty(get_theme_mod('seven_tech_schedule_primary_color_lightness')) ? get_theme_mod('seven_tech_schedule_primary_color_lightness') : 100;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-color-secondary: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_secondary_color_hue')) ? get_theme_mod('seven_tech_schedule_secondary_color_hue') : 0;
										$s = !empty(get_theme_mod('seven_tech_schedule_secondary_color_saturation')) ? get_theme_mod('seven_tech_schedule_secondary_color_saturation') : 0;
										$l = !empty(get_theme_mod('seven_tech_schedule_secondary_color_lightness')) ? get_theme_mod('seven_tech_schedule_secondary_color_lightness') : 0;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-color-tertiary: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_tertiary_color_hue')) ? get_theme_mod('seven_tech_schedule_tertiary_color_hue') : 0;
										$s = !empty(get_theme_mod('seven_tech_schedule_tertiary_color_saturation')) ? get_theme_mod('seven_tech_schedule_tertiary_color_saturation') : 100;
										$l = !empty(get_theme_mod('seven_tech_schedule_tertiary_color_lightness')) ? get_theme_mod('seven_tech_schedule_tertiary_color_lightness') : 50;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-color-quaternary: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_quaternary_color_hue')) ? get_theme_mod('seven_tech_schedule_quaternary_color_hue') : 120;
										$s = !empty(get_theme_mod('seven_tech_schedule_quaternary_color_saturation')) ? get_theme_mod('seven_tech_schedule_quaternary_color_saturation') : 100;
										$l = !empty(get_theme_mod('seven_tech_schedule_quaternary_color_lightness')) ? get_theme_mod('seven_tech_schedule_quaternary_color_lightness') : 30;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-color-success: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_success_color_hue')) ? get_theme_mod('seven_tech_schedule_success_color_hue') : 120;
										$s = !empty(get_theme_mod('seven_tech_schedule_success_color_saturation')) ? get_theme_mod('seven_tech_schedule_success_color_saturation') : 100;
										$l = !empty(get_theme_mod('seven_tech_schedule_success_color_lightness')) ? get_theme_mod('seven_tech_schedule_success_color_lightness') : 30;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-color-success-text: <?php
											$h = !empty(get_theme_mod('seven_tech_schedule_success_color_hue')) ? get_theme_mod('seven_tech_schedule_success_color_hue') : 120;
											$s = !empty(get_theme_mod('seven_tech_schedule_success_color_saturation')) ? get_theme_mod('seven_tech_schedule_success_color_saturation') : 100;
											$l = 90;

											echo "hsl({$h}, {$s}%, {$l}%)";
											?>;

				--seven-tech-schedule-color-error: <?php
									$h = !empty(get_theme_mod('seven_tech_schedule_error_color_hue')) ? get_theme_mod('seven_tech_schedule_error_color_hue') : 0;
									$s = !empty(get_theme_mod('seven_tech_schedule_error_color_saturation')) ? get_theme_mod('seven_tech_schedule_error_color_saturation') : 100;
									$l = !empty(get_theme_mod('seven_tech_schedule_error_color_lightness')) ? get_theme_mod('seven_tech_schedule_error_color_lightness') : 50;

									echo "hsl({$h}, {$s}%, {$l}%)";
									?>;

				--seven-tech-schedule-color-error-text: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_error_color_hue')) ? get_theme_mod('seven_tech_schedule_error_color_hue') : 0;
										$s = !empty(get_theme_mod('seven_tech_schedule_error_color_saturation')) ? get_theme_mod('seven_tech_schedule_error_color_saturation') : 100;
										$l = 90;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-color-caution: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_caution_color_hue')) ? get_theme_mod('seven_tech_schedule_caution_color_hue') : 60;
										$s = !empty(get_theme_mod('seven_tech_schedule_caution_color_saturation')) ? get_theme_mod('seven_tech_schedule_caution_color_saturation') : 100;
										$l = !empty(get_theme_mod('seven_tech_schedule_caution_color_lightness')) ? get_theme_mod('seven_tech_schedule_caution_color_lightness') : 50;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-color-caution-text: <?php
											$h = !empty(get_theme_mod('seven_tech_schedule_caution_color_hue')) ? get_theme_mod('seven_tech_schedule_caution_color_hue') : 60;
											$s = !empty(get_theme_mod('seven_tech_schedule_caution_color_saturation')) ? get_theme_mod('seven_tech_schedule_caution_color_saturation') : 100;
											$l = 10;

											echo "hsl({$h}, {$s}%, {$l}%)";
											?>;

				--seven-tech-schedule-color-info: <?php
									$h = !empty(get_theme_mod('seven_tech_schedule_info_color_hue')) ? get_theme_mod('seven_tech_schedule_info_color_hue') : 240;
									$s = !empty(get_theme_mod('seven_tech_schedule_info_color_saturation')) ? get_theme_mod('seven_tech_schedule_info_color_saturation') : 100;
									$l = !empty(get_theme_mod('seven_tech_schedule_info_color_lightness')) ? get_theme_mod('seven_tech_schedule_info_color_lightness') : 50;

									echo "hsl({$h}, {$s}%, {$l}%)";
									?>;

				--seven-tech-schedule-color-info-text: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_info_color_hue')) ? get_theme_mod('seven_tech_schedule_info_color_hue') : 240;
										$s = !empty(get_theme_mod('seven_tech_schedule_info_color_saturation')) ? get_theme_mod('seven_tech_schedule_info_color_saturation') : 100;
										$l = 90;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;

				--seven-tech-schedule-btn-color: <?php
									$h = !empty(get_theme_mod('seven_tech_schedule_btn_color_hue')) ? get_theme_mod('seven_tech_schedule_btn_color_hue') : 0;
									$s = !empty(get_theme_mod('seven_tech_schedule_btn_color_saturation')) ? get_theme_mod('seven_tech_schedule_btn_color_saturation') : 0;
									$l = !empty(get_theme_mod('seven_tech_schedule_btn_color_lightness')) ? get_theme_mod('seven_tech_schedule_btn_color_lightness') : 0;

									echo "hsl({$h}, {$s}%, {$l}%)";
									?>;

				--seven-tech-schedule-btn-font-color: <?php
										$h = !empty(get_theme_mod('seven_tech_schedule_btn_color_hue')) ? get_theme_mod('seven_tech_schedule_btn_color_hue') : 0;
										$s = !empty(get_theme_mod('seven_tech_schedule_btn_color_saturation')) ? get_theme_mod('seven_tech_schedule_btn_color_saturation') : 0;
										$l = !empty(get_theme_mod('seven_tech_schedule_btn_color_lightness')) ? get_theme_mod('seven_tech_schedule_btn_color_lightness') : 100;

										echo "hsl({$h}, {$s}%, {$l}%)";
										?>;
			}
		</style>
<?php
	}
}
