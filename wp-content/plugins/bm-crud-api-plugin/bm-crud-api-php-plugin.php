<?php
/* 
Plugin Name: BM CRUD REST API PLUGIN
Description: Rest API to perform CRUD operations on WordPress
Version: 1.0.0
Author: Behailu Mesganaw
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

define('P_REFIX', 'bmcapi');

register_activation_hook(__FILE__, ''.P_REFIX.'_create_student_table');
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

add_action('rest_api_init', function () {
    // Get students
    register_rest_route(''.P_REFIX.'/v1', '/students', array(
        'methods' => 'GET',
        'callback' => ''.P_REFIX.'_get_students',
    )); 

    // Add students
    register_rest_route(''.P_REFIX.'/v1', '/student', array(
        'methods' => 'POST',
        'callback' => ''.P_REFIX.'_add_student',
        'args' => array(
            'name' => array(
                'type' => 'string',
                'required' => true,
            ),
            'email' => array(
                'type' => 'string',
                'required' => true,
            ),
            'phone' => array(
                'type' => 'string',
                "required" => false,
            ),
        )
    ));

    register_rest_route(''.P_REFIX.'/v1', '/students/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => ''.P_REFIX.'_get_students_by_id',
    ));

    register_rest_route(''.P_REFIX.'/v1', '/students/(?P<id>\d+)', array(
        'methods' => 'PUT',
        'callback' => ''.P_REFIX.'_update_students',
    ));

    register_rest_route(''.P_REFIX.'/v1', '/students/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => ''.P_REFIX.'_delete_students',
    ));
});

// Get students
function bmcapi_get_students(){

    global $wpdb;

    $students = $wpdb->get_results(
        "SELECT * FROM ".$wpdb->prefix."students_table", ARRAY_A
    );

    if(count($students) == 0){
        return rest_ensure_response([
            'status' => true,
            'message' => 'No students found'
        ]);
     
    }
    
    return rest_ensure_response([
        'status' => true,
        'message' => 'Studenst are fetched successfully',
        'data' => $students
    ]);

    
}

// Add students
function bmcapi_add_student($request){

    global $wpdb;
    $table_name = $wpdb->prefix . 'students_table';

    $name = $request->get_param('name');
    $email = $request->get_param('email');
    $phone = $request->get_param('phone');

    $insert_id = $wpdb->insert($table_name, [
        'name' => $name,
        'email' => $email,
        'phone' => $phone
    ]);

    if($insert_id > 0){
        return rest_ensure_response([
            'status' => true,
            'message' => 'Student is added successfully',
            'data' => $request->get_params()
        ]);
    } else {
        return rest_ensure_response([
            'status' => false,
            'message' => 'Failed to add student',
            'data' => $request->get_params()
        ]);
    }


   
}
