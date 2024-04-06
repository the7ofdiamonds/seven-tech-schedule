<?php

namespace SEVEN_TECH\Schedule\JS;

use Exception;

class JS
{
    private $handle_prefix;
    private $dir;
    private $dirURL;
    private $buildDir;
    private $buildDirURL;
    private $includes_url;

    public function __construct()
    {
        $this->dir = SEVEN_TECH_SCHEDULE;
        $this->dirURL = SEVEN_TECH_SCHEDULE_URL;

        $this->buildDir = $this->dir . 'dist/js/';
        $this->buildDirURL = $this->dirURL . 'dist/js/';

        $this->includes_url = includes_url();
    }

    function load_js()
    {
        // Animations
        wp_register_script($this->handle_prefix, SEVEN_TECH_SCHEDULE_URL . 'JS/seven-tech.js', array('jquery'), false, false);
        wp_enqueue_script($this->handle_prefix);
    }

    function load_react_index()
    {
        $indexPath = $this->buildDir . 'index.js';
        $indexPathURL = $this->buildDirURL . 'index.js';

        if (file_exists($indexPath)) {
            echo '<script type="module" src="' . esc_url($indexPathURL) . '"></script>';
        } else {
            throw new Exception('Index page has not been created in react JSX.', 404);
        }
    }

    function load_front_page_react($section)
    {
        try {
            $this->load_react_index();

            if (!empty($section)) {
                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                $filePath = $this->buildDir . $section . '.js';
                $filePathURL = $this->buildDirURL . $section . '.js';

                if (file_exists($filePath)) {
                    echo '<script type="module" src="' . esc_url($filePathURL) . '"></script>';
                } else {
                    throw new Exception($section . ' page has not been created in react JSX.', 404);
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_front_page_react');

            return $response;
        }
    }

    function load_pages_react($page)
    {
        try {
            $this->load_react_index();

            if (!empty($page) && is_array($page)) {
                $filePath = $this->buildDir . $page['file_name'] . '.js';
                $filePathURL = $this->buildDirURL . $page['file_name'] . '.js';

                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                if (file_exists($filePath)) {
                    echo '<script type="module" src="' . esc_url($filePathURL) . '"></script>';
                } else {
                    throw new Exception($page['file_name'] . ' page has not been created in react JSX.');
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_pages_react');

            return $response;
        }
    }

    function load_taxonomies_react($taxonomy)
    {
        try {
            $this->load_react_index();

            if (!empty($taxonomy) && is_array($taxonomy) && is_tax($taxonomy['taxonomy'])) {
                $filePath = $this->buildDir . $taxonomy['file_name'] . '.js';
                $filePathURL = $this->buildDirURL . $taxonomy['file_name'] . '.js';

                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                if (file_exists($filePath)) {
                    echo '<script type="module" src="' . esc_url($filePathURL) . '"></script>';
                } else {
                    throw new Exception('Taxonomy ' . ucfirst($taxonomy['name']) . ' page has not been created in react JSX.');
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_taxonomies_react');

            return $response;
        }
    }

    function load_post_types_archive_react($post_type)
    {
        try {
            $this->load_react_index();

            if (!empty($post_type) && is_array($post_type) && is_post_type_archive($post_type['name'])) {
                $filePath = $this->buildDir . $post_type['archive_page'] . '.js';
                $filePathURL = $this->buildDirURL . $post_type['archive_page'] . '.js';

                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                if (file_exists($filePath)) {
                    echo '<script type="module" src="' . esc_url($filePathURL) . '"></script>';
                } else {
                    throw new Exception('Post Type ' . ucfirst($post_type['name']) . ' page has not been created in react JSX.', 404);
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_post_types_archive_react');

            return $response;
        }
    }

    function load_post_types_single_react($post_type)
    {
        try {
            $this->load_react_index();

            if (!empty($post_type) && is_array($post_type) && is_singular($post_type['name'])) {
                $filePath = $this->buildDir . $post_type['single_page'] . '.js';
                $filePathURL = $this->buildDirURL . $post_type['single_page'] . '.js';

                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                if (file_exists($filePath)) {
                    echo '<script type="module" src="' . esc_url($filePathURL) . '"></script>';
                } else {
                    throw new Exception('Post Type ' . ucfirst($post_type['name']) . ' page has not been created in react JSX.');
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_post_types_single_react');

            return $response;
        }
    }
}
