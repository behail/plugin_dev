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