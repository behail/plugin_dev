<?php

class BMEmployees {

    private $wbdb;
    private $table_name;
    public function __construct(){
        global $wpdb;
        $this->wbdb = $wpdb;
    }
}