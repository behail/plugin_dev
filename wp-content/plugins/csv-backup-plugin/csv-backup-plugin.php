<?php
/*
Plugin Name: CSV Backup Plugin
Description: A Plugin to backup CSV file from database table
Version: 1.0.0
Author: Behailu Mesganaw
*/

// Add to Admin Menu
add_action('admin_menu', 'bmcsv_backup_add_menu');
function bmcsv_backup_add_menu(){
    add_menu_page('CSV Backup Plugin', 
                'CSV Backup', 
                'manage_options', 
                'bmcsv_backup', 
                'bmcsv_backup_page',
                'dashicons-database-export',
                8
            );
        }
 
// Form Layout        
function bmcsv_backup_page(){
    ob_start();

    include_once plugin_dir_path(__FILE__) . 'template/table-data-backup.php';

    $layout = ob_get_contents();

    ob_end_clean();

    echo $layout;
}

add_action('init', 'bmcsv_handle_export_csv');
function bmcsv_handle_export_csv(){
    if(isset($_POST['bmcsv_export_button'])){
        global $wpdb;
        $table_name = $wpdb->prefix . 'stident_data'; 
        
      $students =  $wpdb->get_results("SELECT * FROM {$table_name}", ARRAY_A);

      if(empty($students)){
          echo '<p>No Data Found</p>';
      } else {
          $csv_file_name = "students_data_".time()."csv";
          header("Content-Type: text/csv; charset=UTF-8");
          header('Content-Disposition: attachment; filename='.$csv_file_name);
         
          $output = fopen('php://output', 'w');
          fputcsv($output, array_keys($students[0]));

          foreach($students as $student){
              fputcsv($output, $student);
          }
          fclose($output);

          exit;
      }
    }
   
}