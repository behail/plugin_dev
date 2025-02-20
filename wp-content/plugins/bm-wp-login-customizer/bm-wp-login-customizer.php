<?php
/**
 * Plugin Name: BM WP Login Customizer
 * Description: A plugin to customize the WP login page logo, Text Color, Background Color
 * Version: 1.0.0
 * Author: Behailu Mesganaw
 * Author URI: https://github.com/behail
 */

 if(!defined('ABSPATH')) exit;

 add_action('admin_menu', 'bmlp_wp_add_menu');
 function bmlp_wp_add_menu(){
     add_submenu_page(
                 'options-general.php', 
                 'BM WP Login Customizer', 
                 'BM Login Customizer', 
                 'manage_options', 
                 'bmwp_login_customizer', 
                 'bmlp_wp_login_customizer_page',
             );
 }

 // Create Login page customizer layout
 function bmlp_wp_login_customizer_page(){

    ob_start();

    include_once plugin_dir_path(__FILE__) . 'template/login_setting_layout.php';

    $content = ob_get_contents();

    ob_end_clean();

    echo $content;
 }

 // Register Settings for Login page
 add_action('admin_init', 'bmlp_wp_login_customizer_settings');
 function bmlp_wp_login_customizer_settings(){
     register_setting('bmwp_login_page_settings_field_group', 'bmwp_login_page_text_color');
     register_setting('bmwp_login_page_settings_field_group', 'bmwp_login_page_background_color');
     register_setting('bmwp_login_page_settings_field_group', 'bmwp_login_page_logo');

     // Create a sections here and add setting fields
     add_settings_section(
         'bmwp_login_page_settings_section_id', 
         'BM WP Login Customizer', 
         null, 
         'bmwp_login_customizer'
     );

     // Text Color
     add_settings_field(
        'bmwp_login_page_text_color',
        'Page Text Setting',
        'bmlp_wp_login_text_color_input',
        'bmwp_login_customizer',
        'bmwp_login_page_settings_section_id'
     );

     // Background Color
     add_settings_field(
        'bmwp_login_page_background_color',
        'Page Background Color',
        'bmlp_wp_login_background_color_input',
        'bmwp_login_customizer',
        'bmwp_login_page_settings_section_id'
     );

     // Logo
     add_settings_field(
        'bmwp_login_page_logo',
        'Page Logo',
        'bmlp_wp_login_logo_input',
        'bmwp_login_customizer',
        'bmwp_login_page_settings_section_id'
     );

 }

 // Text color setting
 function bmlp_wp_login_text_color_input(){
    ?>
        <input type="text" name="bmwp_login_page_text_color" placeholder="Text Color" >
    <?php
 }

 // Background color setting
 function bmlp_wp_login_background_color_input(){
    ?>
        <input type="text" name="bmwp_login_page_background_color" placeholder="Background Color" >
    <?php
 }

 // Logo setting
 function bmlp_wp_login_logo_input(){
    ?>
        <input type="text" name="bmwp_login_page_logo" placeholder="Logo URL" >
    <?php
 }