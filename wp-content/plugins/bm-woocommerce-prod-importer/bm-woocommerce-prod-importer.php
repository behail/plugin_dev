<?php
/*
Plugin Name: BM Woocommerce Product Importer
Description: This plugin is used to import product from CSV file to Woocommerce
Version: 1.0.0
Author: BM

*/

if(!defined('ABSPATH')) exit;

// check if Woocommerce is active
if(! in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
    add_action('admin_notices', 'bmwpi_admin_notice');
  
}
function bmwpi_admin_notice(){
    echo '<div class="notice notice-error "><p>Woocommerce is not active</p></div>';
}

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
    ob_start();

    include_once plugin_dir_path(__FILE__) . 'template/import_layout.php';

    $template = ob_get_contents();

    ob_end_clean();

    echo $template;
}

add_action('admin_init', 'bmwpi_handle_form_upload');
function bmwpi_handle_form_upload(){

    if(isset($_POST['bmwpi_import_csv'])){
         // Verify nonce
        if(!wp_verify_nonce($_POST['bmwpi_import_csv_nonce_value'], 'bmwpi_handle_form_upload')){
            return;
        }

        $files = $_FILES['bmwpi_import_file'];
        $fileName = $files['name'];
        
        if(isset($fileName) && !empty($fileName)){
            $tmpName = $files['tmp_name'];
            $handle = fopen($tmpName, 'r');
           
            $row = 0;

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($row == 0){
                    $row++;
                    continue;
                }
  
                $productObj = new WC_Product();
                $productObj->set_name($data[0]);
                $productObj->set_regular_price($data[1]);
                $productObj->set_sale_price($data[2]);
                $productObj->set_description($data[3]);
                $productObj->set_short_description($data[4]);
                $productObj->set_sku($data[5]);
                $productObj->set_status('publish');
                $productObj->save();
               
            }
            add_action('admin_notices', function(){
                echo '<div class="notice notice-success "><p>Product imported successfully</p></div>';
            });
        } else {
            add_action('admin_notices', function(){
                echo '<div class="notice notice-error "><p>Please select CSV file</p></div>';
            });
        }

    }

   
}