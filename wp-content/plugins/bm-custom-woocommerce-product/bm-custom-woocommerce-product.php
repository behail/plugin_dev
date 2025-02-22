<?php
/*
Plugin Name: BM Custom Woocommerce Product
Description: This plugin is used to create custom product in Woocommerce
Version: 1.0.0
Author: BM

*/

if(!defined('ABSPATH')) exit;

// Add Plugin Menu
add_action("admin_menu", "bmwcp_add_menu");

function bmwcp_add_menu(){
    add_menu_page(
        "BM Woocommerce Creator", 
        "BM Woocommerce Creator", 
        'manage_options', 
        'bmwcp-woocommerce-product-creator', 
        'bmwcp_create_product_callback',
        'dashicons-cloud-upload',
        8
    );
}

function bmwcp_create_product_callback(){

}