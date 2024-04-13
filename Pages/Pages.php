<?php

namespace SEVEN_TECH\Schedule\Pages;

class Pages
{
    public $front_page_react;
    public $custom_pages_list;
    public $protected_pages_list;
    public $pages_list;
    public $pages;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'Schedule',
        ];

        $this->custom_pages_list = [
            [
                'file_name' => 'Schedule',
                'url' => 'schedule',
                'regex' => '#^/schedule#',
                'name' => 'schedule'
            ]
        ];

        $this->protected_pages_list = [];

        $this->pages_list = [
            [
                'file_name' => 'Schedule',
                'url' => 'about',
                'regex' => '#^/about#',
                'name' => 'schedule'
            ]
        ];

        $this->pages = [];
    }

    function add_pages()
    {
        if (!empty($this->pages)) {
            global $wpdb;

            foreach ($this->pages as $page) {
                if (!empty($page['title'])) {
                    $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page['title']));

                    if (!$page_exists) {
                        $page_data = array(
                            'post_title'   => $page['title'],
                            'post_type'    => 'page',
                            'post_content' => '',
                            'post_status'  => 'publish',
                        );

                        wp_insert_post($page_data);

                        error_log($page['title'] . ' page added.');
                    }
                }
            }
        }
    }

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
