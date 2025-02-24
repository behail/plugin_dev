<?php
/*
Plugin Name: BM Woocommerce Product Importer
Description: This plugin is used to import product from CSV file to Woocommerce
Version: 1.0.0
Author: BM

*/

if(!defined('ABSPATH')) exit;

// Add Plugin menu
add_action("admin_menu", "bmwpi_add_menu");

function bmwpi_add_menu(){
    add_menu_page(
        "BM Woocommerce Product Importer", 
        "BM Woocommerce Product Importer", 
        'manage_options', 
        'bmwpi-woocommerce-product-importer', 
        'bmwpi_create_product_callback',
        'dashicons-cloud-upload',
        8
    );
}

function bmwpi_create_product_callback(){
    
}