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

    // Update student
    register_rest_route(''.P_REFIX.'/v1', '/student/(?P<id>\d+)', array(
        'methods' => 'PUT',
        'callback' => ''.P_REFIX.'_update_student',
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
                'required' => false,
            ),
        ),
    ));


    // Delete Student
    register_rest_route(''.P_REFIX.'/v1', '/student/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => ''.P_REFIX.'_delete_student',
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

// Update Student
function bmcapi_update_student($request){

    global $wpdb;
    $table_name = $wpdb->prefix . 'students_table';

    $id = $request['id'];
    $name = $request['name'];
    $email = $request['email'];
    $phone = $request['phone'];

    $isStudentExist = $wpdb->get_var("SELECT id FROM {$table_name} WHERE id = {$id}");

    if(!empty($isStudentExist)){
        $wpdb->update(
            $table_name,
            [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
            ],
            [
                'id' => $id,
            ]
        );
        return rest_ensure_response([
            'status' => true,
            'message' => 'Successfully updated student',
            'data' => [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
            ],
            "isStudentExist" => $isStudentExist,
        ]);
    } else {
        return rest_ensure_response([
            'status' => false,
            'message' => 'Student does not exist',
        ]);
    }
        


   
}

// Delete Student
function bmcapi_delete_student($request){

    global $wpdb;
    $table_name = $wpdb->prefix . 'students_table';
    $id = $request['id'];

    $student = $wpdb->get_row("SELECT * FROM {$table_name} WHERE id = {$id}");

    if(!empty($student)){
        $wpdb->delete(
            $table_name,
            [
                'id' => $id,
            ]
        );
        return rest_ensure_response([
            'status' => true,
            'message' => 'Successfully deleted student'
        ]);
    } else {
        return rest_ensure_response([
            'status' => false,
            'message' => 'Student does not exist',
        ]);
    }
}
