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
            PRIMARY KEY (`id`)
            ) ".$collate."
            ";
        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
        dbDelta($createCommand);

    }

    // Drop DB table
    public function dropEmployeeTable(){
       $delete_command = "DROP TABLE IF EXISTS {$this->table_name}";
       
       $this->wpdb->query($delete_command);
    }
}