<?php
/* 
Plugin Name: BM CRUD REST API PLUGIN
Description: Rest API to perform CRUD operations on WordPress
Version: 1.0.0
Author: Behailu Mesganaw
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook(__FILE__, 'bmcapi_create_student_table');
function bmcapi_create_student_table(){

    global $wpdb;
    $tableName = $wpdb->prefix . 'students_table';
    $collate = $wpdb->get_charset_collate();

    $createTableCommand = '
        CREATE TABLE `'.$tableName.'` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(50) NOT NULL,
        `email` varchar(50) NOT NULL,
        `phone` varchar(25) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) '.$collate.'   
    ';

    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($createTableCommand);
}


