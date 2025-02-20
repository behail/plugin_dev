<?php
/*
Plugin Name: BM Custom Plugin
Description: A Custom plugin that display a static message and recent post 
Version: 1.0.0
Author: Behailu Mesganaw
Author URI: https://github.com/behail
*/

if(!defined('ABSPATH')) exit;

add_action('widgets_init', 'bmcw_register_widget');

require_once plugin_dir_path(__FILE__) . 'Bmcw_Custom_Widget.php';

function bmcw_register_widget(){
    register_widget('Bmcw_Custom_Widget');
}


// Add admin panel script
add_action('admin_enqueue_scripts', 'bmcw_add_admin_script');
function bmcw_add_admin_script(){
    //CSS
    wp_enqueue_style(
            'bmcw_admin_style', 
            plugin_dir_url(__FILE__) . 'style.css', 
        );
    //JS
    wp_enqueue_script(
            'bmcw_admin_script', 
            plugin_dir_url(__FILE__) . 'script.js', 
            array('jquery')
        );
}