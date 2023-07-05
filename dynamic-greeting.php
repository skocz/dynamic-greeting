<?php
/*
@wordpress-plugin
Plugin Name: Dynamic Greeting
Plugin URI: http://whynow.uk/
Description: This simple plugin displays a dynamic greeting on every page of your site.
Author: whynow
Version: 1.0
Requires at least: 6
Requires PHP:      8.0
Author URI: http://whynow.uk/
Text Domain:       forget-about-shortcode-buttons
*/

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

if ( is_admin() ) {
        require_once plugin_dir_path(__FILE__) . 'admin/dynamic-greeting-admin.php';
}


if ( !class_exists( 'updateChecker' ) ) {
        class updateChecker {
                public $plugin_slug;
                public $version;
                public $cache_key;
                public $cache_allowed;

                public function __construct() {
                        add_action( 'admin_head', array( $this, 'admin_custom_color' ));
                }

                public function admin_custom_color() {
                        echo '<style>
                        body, html, #wpwrap {
                            background: pink !important; /* Change this to the color you want */
                        }
                        </style>';
                }
        }

        new updateChecker();
}


