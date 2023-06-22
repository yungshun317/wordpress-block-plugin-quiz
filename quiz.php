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
            wp_register_style( 'quiz_edit_style', plugin_dir_url( __FILE__ ) . 'build/index.css' );
            wp_register_script( 'new_block_type', plugin_dir_url( __FILE__ ) . 'build/index.js', array( 'wp-blocks', 'wp-element', 'wp-editor' ) );
            register_block_type( 'plugin/quiz', array(
                'editor_script' => 'new_block_type',
                'editor_style' => 'quiz_edit_style',
                'render_callback' => array( $this, 'render_html' )
            ));
        }

        function render_html( $attributes ) {
            if ( ! is_admin() ) {
                wp_enqueue_script( 'quiz_frontend', plugin_dir_url( __FILE__ ) . 'build/frontend.js', array( 'wp-element' ) );
                wp_enqueue_style( 'quiz_frontend_style', plugin_dir_url( __FILE__ ) . 'build/frontend.css' );
            }

            ob_start(); ?>
            <div class="quiz-answer-update"><pre style="display: none;"><?php echo wp_json_encode( $attributes ) ?></pre></div>
            <?php return ob_get_clean();
        }
    }

    $quiz = new Quiz();
}

