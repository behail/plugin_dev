<?php 
/*
Plugin Name: First Hello Plugin
Description: First Hello Plugin
Version: 1.0.0
Author: Behailu Mesganaw
*/

// Add Admin Notice
add_action('admin_notices','fhw_display_warning_message');
function fhw_display_success_message(){
    echo '<div class=" notice notice-success is-dismissible"><p>Hello, It is a success message from First Hello Plugin</p></div>';
}

function fhw_display_error_message(){
    echo '<div class=" notice notice-error is-dismissible"><p>Hello, It is a error message from First Hello Plugin</p></div>';
}

function fhw_display_info_message(){
    echo '<div class=" notice notice-info is-dismissible"><p>Hello, It is a information message from First Hello Plugin</p></div>';
}

function fhw_display_warning_message(){
    echo '<div class=" notice notice-warning is-dismissible"><p>Hello, It is a warning message from First Hello Plugin</p></div>';
}

// Admin Dashboard Widget
add_action('wp_dashboard_setup', 'fhw_dashboard_widget');
function fhw_dashboard_widget() {
    wp_add_dashboard_widget('fhw_hello_world', 'FHW, Hello World', 'fhw_custom_dashboard_widget');
}
function fhw_custom_dashboard_widget() {
    echo 'This is a custom dashboard widget';
}