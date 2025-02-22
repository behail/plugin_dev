<?php

class BMEmployees {

    private $wpdb;
    private $table_prefix;  
    private $table_name;
    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_prefix = $this->wpdb->prefix;
        $this->table_name = $this->table_prefix . 'bm_employees';
    }

    // Create DB table
    public function createEmployeeTable(){ 

        $collate = $this->wpdb->get_charset_collate();

        $createCommand = "
            CREATE TABLE `".$this->table_name."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(50) NOT NULL,
            `email` varchar(50) DEFAULT NULL,
            `designation` varchar(50) DEFAULT NULL,
            `profile_image` varchar(220) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ".$collate."
            ";
        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
        dbDelta($createCommand);

    }

    // Create dynamic page
    public function createEmployeePage(){
        $page_title = 'Employee CRUD System';
        $page_content = "[bm_employee-form]";

        if(!get_page_by_title($page_title)){
            wp_insert_post(array(
                'post_title' => $page_title,
                'post_content' => $page_content,
                'post_status' => 'publish',
                'post_type' => 'page'
            ));
        }
    }

    public function callPluginActivationFunctions(){
        $this->createEmployeeTable();
        $this->createEmployeePage();
    }

    // Drop DB table
    public function dropEmployeeTable(){
       $delete_command = "DROP TABLE IF EXISTS {$this->table_name}";

       $this->wpdb->query($delete_command);
    }

    // Render Employee Form Layout
    public function createEmployeeForm(){
        ob_start();

        include_once BMCP_DIR_PATH . 'template/employee-form.php';

        $content = ob_get_contents();
         ob_get_clean();

         return $content;
    }

    // Add CSS and JS to plugin
    public function addAssetsToPlugin(){
        // CSS
        wp_enqueue_style(
                'bm_form_style', 
                BMCP_DIR_URL . 'assets/employee-form.css', 
            );
         // Validator
         wp_enqueue_script(
            'bm_form_validator_script', 
            BMCP_DIR_URL . 'assets/jquery.validate.min.js', 
            array('jquery'),

        );

        // JS
        wp_enqueue_script(
                'bm_form_script', 
                BMCP_DIR_URL . 'assets/script.js', 
                array('jquery'),

            );
        wp_localize_script('bm_form_script', 'bm_form_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
       
    }

    // Proceed Ajax Request: Add Employee
    public function handleAddEmployeeFormData(){
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $designation = sanitize_text_field($_POST['designation']);
        $profile_url = '';
        // File 
        if(isset($_FILES['profile_image']['name'])){

            $uploadFile = $_FILES['profile_image'];
            $originalFileName = pathinfo($uploadFile['name'], PATHINFO_FILENAME);
            $fileExtension = pathinfo($uploadFile['name'], PATHINFO_EXTENSION);
            $newFileName = $originalFileName . '-' . time() . '.' . $fileExtension;
            $_FILES['profile_image']['name'] = $newFileName;

            $file_uploaded = wp_handle_upload($_FILES['profile_image'], ['test_form' => false]);
            $profile_url = $file_uploaded['url'];
        }

        $this->wpdb->insert($this->table_name,[
            'name' => $name,
            'email' => $email,
            'designation' => $designation,
            'profile_image' => $profile_url,	
        ]);

        $employee_id = $this->wpdb->insert_id;

        if($employee_id > 0){
            echo json_encode(array(
                'success' => 1, 
                'message' => 'Data saved successfully'
            ));
        } else {
            echo json_encode(array(
                'success' => 0, 
                'message' => 'Error while saving data',
            ));
        }
        wp_die();
    }

   public function handleFetchAllEmployeeData(){
        $employees = $this->wpdb->get_results("SELECT * FROM {$this->table_name}", ARRAY_A);

      return  wp_send_json([
            'success' => 1, 
            'message' => 'Employees are fetched successfully',
            'employees' => $employees
        ]);
    }

    public function handleDeleteEmployee(){
        $employee_id = sanitize_text_field($_GET['employee_id']);

        $this->wpdb->delete($this->table_name, ['id' => $employee_id]);

        return wp_send_json([
            'success' => 1, 
            'message' => 'Employee is deleted successfully'
        ]);

    }

    public function handleFetchEmployeeById(){
        $employee_id = sanitize_text_field($_GET['employee_id']);

        if($employee_id > 0 ){

            $employeeData = $this->wpdb->get_row(
                "SELECT * FROM {$this->table_name} WHERE id = {$employee_id}", ARRAY_A
            );

            return wp_send_json([
                'success' => 1, 
                'message' => 'Employee is fetched successfully',
                'employee' => $employeeData
            ]);

        }else{
            return wp_send_json([
                'success' => 0, 
                'message' => 'Employee Id not passed'
            ]);
        }
    }

    public function handleEditEmployee(){
        $updated_name = sanitize_text_field($_POST['emp_name']);
        $updated_email = sanitize_email($_POST['emp_email']);
        $updated_designation = sanitize_text_field($_POST['emp_designation']);
        $empId = sanitize_text_field($_POST['employee_id']);
        $updated_profile_image = "";

        $employeeData = $this->getEmployeeById($empId);


        if(!empty($employeeData)){
            // Get old profile image
            $old_profile_image = $employeeData['profile_image'];
            
            // New file Object
            $profile_url = isset($_FILES['emp_profile_image']['name']) ? $_FILES['emp_profile_image']['name']  : '';

            // Check if profile image is uploaded
            if(!empty($profile_url)){
                
                    if(! empty($old_profile_image)){
                        $wp_site_url = get_site_url();
                    $file_path = str_replace($wp_site_url."/","", $old_profile_image);
                    if(file_exists(ABSPATH . $file_path)){
                        // Remove file from upload directory
                        unlink(ABSPATH . $file_path);
                    }
                    }

                    $uploadFile = $_FILES['emp_profile_image'];
                    $originalFileName = pathinfo($uploadFile['name'], PATHINFO_FILENAME);
                    $fileExtension = pathinfo($uploadFile['name'], PATHINFO_EXTENSION);
                    $newFileName = $originalFileName . '-' . time() . '.' . $fileExtension;
                    $_FILES['emp_profile_image']['name'] = $newFileName;

                    // Upload new profile image
                    $file_uploaded = wp_handle_upload($_FILES['emp_profile_image'], ['test_form' => false]);
                    $updated_profile_image  = $file_uploaded['url'];
              
    
            }
    
            $this->wpdb->update(
                $this->table_name, 
                [
                    'name' => $updated_name,
                    'email' => $updated_email,
                    'designation' => $updated_designation,
                    'profile_image' => $updated_profile_image
                ],[
                    'id' => $empId
                ]);
    
                return wp_send_json([
                    'success' => 1, 
                    'message' => 'Employee is updated successfully'
                ]);

        }else {
            return wp_send_json([
                'success' => 0, 
                'message' => 'Employee not found'
            ]);
        }

       
    }

    // Get employeed by id
    private function getEmployeeById($employee_id){
        $employeeData = $this->wpdb->get_row(
            "SELECT * FROM {$this->table_name} WHERE id = {$employee_id}", ARRAY_A
        );

        return $employeeData;
    }
}