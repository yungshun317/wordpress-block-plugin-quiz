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
            add_action( 'init', array( $this, 'admin_assets' ) );
        }

        function admin_assets() {
            wp_enqueue_script( 'new_block_type', plugin_dir_url(__FILE__) . 'build/index.js', array( 'wp-blocks', 'wp-element' ) );
            register_block_type( 'plugin/quiz', array(
                'editor_script' => 'new_block_type',
                'render_callback' => array( $this, 'render_html' )
            ));
        }

        function render_html( $attributes ) {
            ob_start(); ?>
            <h3>Today the sky is <?php echo esc_html( $attributes['skyColor'] ) ?> and the grass is <?php echo esc_html( $attributes['grassColor'] ) ?>!</h3>
            <?php return ob_get_clean();
        }
    }

    $quiz = new Quiz();
}

