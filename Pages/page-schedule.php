<?php

if (!is_user_logged_in()) {
    $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    wp_redirect('/login' . '?redirectTo=' . $fullUrl);
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

get_header();
?>

<div class='schedule'>
<?php
include SEVEN_TECH_SCHEDULE . 'includes/react.php';

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if (is_plugin_active('seven-tech/SEVEN_TECH.php')) {
    echo do_shortcode('[seven-tech-gateway-nav]');
}
?>
</div>
<?
get_footer();