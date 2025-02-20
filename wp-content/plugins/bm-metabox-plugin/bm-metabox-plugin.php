<?php
/*
Plugin Name: BM Metabox Plugin
Description: A metabox Plugin
Author: Behailu Mesganaw
Version: 1.0.0
Author URI: https://github.com/behail
*/

if(!defined('ABSPATH')) exit;

// Register Page metabox
add_action('add_meta_boxes', 'bmmb_register_page_metabox');

function bmmb_register_page_metabox(){
    add_meta_box('bmmb_page_metabox', 
                'Custom BM Metabox - SEO', 
                'bmmb_page_metabox_callback',);
}

// Create layout for page metabox
function bmmb_page_metabox_callback(){
    //Include template file
    ob_start();

    include_once plugin_dir_path(__FILE__) . 'template/page_metabox.php';

    $template = ob_get_contents();

    ob_end_clean();

    echo $template;
}