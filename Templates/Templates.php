<?php

namespace SEVEN_TECH\Schedule\Templates;

use SEVEN_TECH\Schedule\CSS\CSS;
use SEVEN_TECH\Schedule\JS\JS;

class Templates
{
    private $css;
    private $js;
    private $pluginDir;

    public function __construct(
        CSS $css,
        JS $js,
    ) {
        $this->css = $css;
        $this->js = $js;
        $this->pluginDir = SEVEN_TECH_SCHEDULE;
    }

    function get_front_page_template($frontpage_template, $section)
    {
        if (is_front_page()) {
            
            add_action('wp_head', function () use ($section) {
                $this->css->load_front_page_css($section);
            });
            add_action('wp_footer', function () use ($section) {
                $this->js->load_front_page_react($section);
            });

            return $frontpage_template;
        }

        return $frontpage_template;
    }


    function get_custom_page_template($template_include, $custom_page)
    {
        $custom_template = $this->pluginDir . "Pages/page-{$custom_page['name']}.php";

        if (file_exists($custom_template)) {
            $filename = $custom_page['file_name'];

            add_action('wp_head', function () use ($filename) {
                $this->css->load_pages_css($filename);
            });
            add_action('wp_footer', function () use ($filename) {
                $this->js->load_pages_react($filename);
            });

            return $custom_template;
        }

        return $template_include;
    }

    function get_protected_page_template($template_include, $protected_page)
    {
        $template = $this->pluginDir . 'Pages/page-protected.php';

        if (file_exists($template)) {
            $filename = $protected_page['file_name'];

            add_action('wp_head', function () use ($filename) {
                $this->css->load_pages_css($filename);
            });
            add_action('wp_footer', function () use ($filename) {
                $this->js->load_pages_react($filename);
            });

            return $template;
        } else {
            error_log('Protected Page Template does not exist.');
        }

        return $template_include;
    }

    function get_page_template($template_include, $page)
    {
        $template = $this->pluginDir . 'Pages/page.php';;

        if (file_exists($template)) {
            $filename = $page['file_name'];

            add_action('wp_head', function () use ($filename) {
                $this->css->load_pages_css($filename);
            });
            add_action('wp_footer', function () use ($filename) {
                $this->js->load_pages_react($filename);
            });

            return $template;
        } else {
            error_log('Page Template does not exist.');
        }

        return $template_include;
    }

    function get_page_list_template($template_include, $page)
    {
        $filename = $page['file_name'];

        add_action('wp_head', function () use ($filename) {
            $this->css->load_pages_css($filename);
        });
        add_action('wp_footer', function () use ($filename) {
            $this->js->load_pages_react($filename);
        });

        return $template_include;
    }

    function get_taxonomy_page_template($taxonomy_template, $taxonomy)
    {
        if (is_tax($taxonomy['taxonomy'])) {
            $custom_taxonomy_template = $this->pluginDir . "Taxonomies/taxonomy-{$taxonomy['file_name']}.php";

            if (file_exists($custom_taxonomy_template)) {
                $filename = $taxonomy['file_name'];

                add_action('wp_head', function () use ($filename) {
                    $this->css->load_pages_css($filename);
                });
                add_action('wp_footer', function () use ($filename) {
                    $this->js->load_pages_react($filename);
                });

                return $custom_taxonomy_template;
            }
        }

        return $taxonomy_template;
    }

    function get_archive_page_template($archive_template, $post_type)
    {
        if (is_post_type_archive($post_type['name'])) {
            $custom_archive_template = $this->pluginDir . 'Post_Types/' . $post_type['plural'] . '/archive-' . $post_type['name'] . '.php';

            if (file_exists($custom_archive_template)) {
                $filename = $post_type['file_name'];

                add_action('wp_head', function () use ($filename) {
                    $this->css->load_pages_css($filename);
                });
                add_action('wp_footer', function () use ($filename) {
                    $this->js->load_pages_react($filename);
                });

                return $custom_archive_template;
            }
        }

        return $archive_template;
    }

    function get_single_page_template($single_template, $post_type)
    {
        if (is_singular($post_type['name'])) {
            $custom_single_template = $this->pluginDir . 'Post_Types/' . $post_type['plural'] . '/single-' . $post_type['name'] . '.php';

            if (file_exists($custom_single_template)) {
                $filename = $post_type['file_name'];

                add_action('wp_head', function () use ($filename) {
                    $this->css->load_pages_css($filename);
                });
                add_action('wp_footer', function () use ($filename) {
                    $this->js->load_pages_react($filename);
                });

                return $custom_single_template;
            }
        }

        return $single_template;
    }
}
