<?php

namespace SEVEN_TECH\Schedule\CSS\Customizer;

class Customizer
{
	public function __construct()
	{		
	}

	function register_customizer_panel($wp_customize)
	{
		add_theme_support('customizer');
		$wp_customize->add_panel(
			'seven_tech_schedule_settings',
			array(
				'title' => __('ORB Products & Services Settings', 'seven-tech-schedule'),
				'priority' => 10,
			)
		);
	}

	function calculate_lightness($hue, $lightness)
    {
        if ($hue == 0 && $lightness == 0) {
            return 100;
        }

        if ($hue == 0 && $lightness == 100) {
            return 0;
        }

        if ($hue >= 40 && $hue <= 180) {
            if (10 > ($lightness - 40)) {
                return 10;
            }

            return $lightness - 40;
        }

        if ($hue < 40 || $hue > 180) {
            if (90 < ($lightness + 40)) {
                return 90;
            }

            return $lightness + 40;
        }
    }
}
