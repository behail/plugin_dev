<?php
/*
Plugin Name: BM Metabox Plugin
Description: A metabox Plugin
Author: Behailu Mesganaw
Version: 1.0.0
Author URI: https://github.com/behail
*/

if(!defined('ABSPATH')) exit;

// Register Page metabox
add_action('add_meta_boxes', 'bmmb_register_page_metabox');

function bmmb_register_page_metabox(){
    add_meta_box('bmmb_page_metabox', 
                'Custom BM Metabox - SEO', 
                'bmmb_page_metabox_callback',
                'page'
            );
}

// Create layout for page metabox
function bmmb_page_metabox_callback($post){
    //Include template file
    ob_start();

    include_once plugin_dir_path(__FILE__) . 'template/page_metabox.php';

    $template = ob_get_contents();

    ob_end_clean();

    echo $template;
}

// Save Data of metabox
add_action('save_post', 'bmmb_save_metabox');
function bmmb_save_metabox($post_id){
    //Check and Verify Nonce Value
    if(!wp_verify_nonce($_POST['bmmb_meta_nonce'], 'bmmb_save_metabox')){
        return;
    }

    // Check and verify Auto save of WordPress
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }

    if(isset($_POST['bmmb_meta_title'])){
        update_post_meta($post_id, 'bmmb_meta_title', $_POST['bmmb_meta_title']);
    }

    if(isset($_POST['bmmb_meta_description'])){
    update_post_meta($post_id, 'bmmb_meta_description', $_POST['bmmb_meta_description']);
    }
}

// Add meta tags in the Head tag
add_action('wp_head', 'bmmb_add_meta_tags');
function bmmb_add_meta_tags(){
    if(is_page()){
        global $post;
        $post_id = $post->ID;
        $title = get_post_meta($post_id, 'bmmb_meta_title', true);
        $description = get_post_meta($post_id, 'bmmb_meta_description', true);

        if(!empty($title)){
            echo '<meta name="title" content="'.$title.'">';
        }
        if(!empty($description)){
            echo '<meta name="description" content="'.$description.'">';
        }
    }
}