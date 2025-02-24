<?php
/*
Plugin Name: BM Custom Woocommerce Product
Description: This plugin is used to create custom product in Woocommerce
Version: 1.0.0
Author: BM

*/

if(!defined('ABSPATH')) exit;

// Check if Woocommerce is active
if(! in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
    add_action('admin_notices', 'bmwcp_admin_notice');
  
}
function bmwcp_admin_notice(){
    echo '<div class="notice notice-error "><p>Woocommerce is not active</p></div>';
}

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

// Add Style to admin page
add_action('admin_enqueue_scripts', 'bmwcp_add_style');

function bmwcp_add_style(){
        wp_enqueue_style('bmwcp-style', plugin_dir_url(__FILE__) . 'assets/style.css');

        wp_enqueue_media();

        // Add Script
        wp_enqueue_script('bmwcp-script', plugin_dir_url(__FILE__) . 'assets/script.js');
}

function bmwcp_create_product_callback(){
    ob_start();

    include_once plugin_dir_path(__FILE__) . 'template/add-woocom-product-form.php';

    $template = ob_get_contents();

    ob_end_clean();

    echo $template;
}

// Admin init
add_action('admin_init', 'bmwcp_create_product');
function bmwcp_create_product(){
    if(isset($_POST['bmwcp_submit'])){

        // Verift nonce
        if(!wp_verify_nonce($_POST['bmwcp_create_product_nonce'], 'bmwcp_create_product')){
            return;
        }

        // Check if woocommerce is active
        if(class_exists("WC_Product_Simple")){
            $prodObj = new WC_Product_Simple();

            // Product Parameters
            $prodObj->set_name($_POST['bmwcp_name']);
            $prodObj->set_regular_price($_POST['bmwcp_regular_price']);
            $prodObj->set_sale_price($_POST['bmwcp_sale_price']);
            $prodObj->set_sku($_POST['bmwcp_sku']);
            $prodObj->set_short_description($_POST['bmwcp_short_description']);
            $prodObj->set_description($_POST['bmwcp_description']);
            $prodObj->set_status('publish');
            $prodObj->set_image_id($_POST['product_image_media_id']);

            // Save Product
           $prodId = $prodObj->save();
            if($prodId > 0){
                add_action('admin_notices', function(){
                    echo '<div class="notice notice-success "><p>Product created successfully</p></div>';
                });
            }
      
        }        
        
    }
}