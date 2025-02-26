<?php
/*
Plugin Name: BM CRUD Employee Plugin
Description: A plugin to perform CRUD operation on employee table. It also create dynamic wordpress page and it will have a shortcode.
Version: 1.0.0
Author: Behailu Mesganaw
*/

if(!defined('ABSPATH')) exit;

define('BMCP_DIR_PATH', plugin_dir_path( __FILE__ ));
define('BMCP_DIR_URL', plugin_dir_url( __FILE__ ));

include_once BMCP_DIR_PATH .'BMEmployees.php';

// Create Class Object
$bmEmployeesObj = new BMEmployees;

// Create DB table
register_activation_hook(__FILE__, [$bmEmployeesObj, 'callPluginActivationFunctions']);


// Drop DB table
register_deactivation_hook(__FILE__, [$bmEmployeesObj, 'dropEmployeeTable']);

// register shortcode
add_shortcode('bm_employee-form', [$bmEmployeesObj, 'createEmployeeForm']);

// Add Form CSS
add_action('wp_enqueue_scripts', [$bmEmployeesObj, 'addAssetsToPlugin']);

// Process Ajax Request
add_action('wp_ajax_bm_add_employee', [$bmEmployeesObj, 'handleAddEmployeeFormData']);
add_action('wp_ajax_bm_fetch_all_employee', [$bmEmployeesObj, 'handleFetchAllEmployeeData']);
add_action('wp_ajax_bm_delete_employee', [$bmEmployeesObj, 'handleDeleteEmployee']);
add_action('wp_ajax_bm_fetch_employee_by_id', [$bmEmployeesObj, 'handleFetchEmployeeById']);
add_action('wp_ajax_bm_edit_employee', [$bmEmployeesObj, 'handleEditEmployee']);
