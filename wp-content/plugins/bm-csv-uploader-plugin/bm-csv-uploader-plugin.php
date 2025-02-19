<?php
/*
Plugin Name: BM CSV Uploader Plugin
Description: A Plugin to upload CSV file to the database
Version: 1.0.0
Author: Behailu Mesganaw
*/

define('BMCSV_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ));


add_shortcode('bm_csv_uploader', 'bmcsv_data_uploader_form');
function bmcsv_data_uploader_form(){

    // Start PHP buffer
    ob_start();

    include_once BMCSV_PLUGIN_DIR_PATH .'template/bmcsv_form.php'; 

    // Read PHP buffer
    $template = ob_get_contents();

    // Clean PHP buffer
    ob_end_clean();

    return $template;
}

// DB Table on Plugin Activation
register_activation_hook(__FILE__, 'bmcsv_create_table');
function bmcsv_create_table(){
    global $wpdb;
    $table_prefix = $wpdb->prefix; //wp_
    $table_name = $table_prefix . 'stident_data'; // wp_posts

    $table_collate = $wpdb->get_charset_collate();

    $sql_command = "
    CREATE TABLE `".$table_name."` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(50) DEFAULT NULL,
        `email` varchar(50) DEFAULT NULL,
        `age` int(5) DEFAULT NULL,
        `phone` varchar(30) DEFAULT NULL,
        `photo` varchar(120) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ".$table_collate."
    ";

    require_once(ABSPATH.'/wp-admin/includes/upgrade.php');
    dbDelta($sql_command);
}