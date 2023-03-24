<?php

/*
 * Plugin Name: Quiz
 * Plugin URI: https://www.wordpress.org/word-counter
 * Description: My plugin's description
 * Version: 1.0
 * Requires at least: 5.6
 * Author: Chouqin Info Co.
 * Author URI: https://www.chouqin.com.tw
 * Text Domain: quiz
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Quiz' ) ) {
    class Quiz {
        function __construct() {
            add_action( 'enqueue_block_editor_assets', array( $this, 'admin_assets' ) );
        }

        function admin_assets() {
            wp_enqueue_script( 'new_block_type', plugin_dir_url( __FILE__ ) . 'test.js', array( 'wp-blocks', 'wp-element' ) );
        }
    }

    $quiz = new Quiz();
}

