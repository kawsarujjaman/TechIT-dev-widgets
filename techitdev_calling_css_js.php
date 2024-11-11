<?php 
/**
 * Plugin CSS and JS file calling
 */

 if ( ! defined('ABSPATH')){
    exit;
 }

 if( ! function_exists('techitdev_css_js_file_calling')){
    function techitdev_css_js_file_calling(){
        wp_enqueue_style(
            'techitdev-widget-css', 
            plugin_dir_url( __FILE__ ).'assets/techitdev_widgets.css',
            array(),
            '1.0.0',
            'all' );
    }
 }
 add_action( 'wp_enqueue_scripts', 'techitdev_css_js_file_calling' );