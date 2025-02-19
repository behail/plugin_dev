<?php
/*
Plugin Name: Shortcode Plugin
Description: Shortcode Plugin
Version: 1.0.0
Author: Behailu Mesganaw
*/

add_shortcode('message', 'scp_show_static_message');
function scp_show_static_message(){
    return "<p style='color:red; font-size:20px; font-weight:bold;'>Hello, It is a shortcode from Shortcode Plugin</p>";
}

// parameterized shortcode
add_shortcode('message2', 'scp_show_static_message2');
function scp_show_static_message2($attributes) {
    $attributes = shortcode_atts(array(
        'name' => 'Behailu Mesganaw',
        'email' => 'behailu.mesganaw@gmail.com',
    ), $attributes,'message2' );

    return "<h3>Name: {$attributes['name']} -  Email: {$attributes['email']}</h3>";
}

// shortcode with DB operation
add_shortcode('list_posts', 'scp_handle_list_posts');
function scp_handle_list_posts(){
    
    global $wpdb;

    $table_prefix = $wpdb->prefix; //wp_
    $table_name = $table_prefix . 'posts'; // wp_posts

    // Get posts whose post_type is post and post_status is publish
    $posts = $wpdb->get_results(
        "SELECT post_title FROM {$table_name} WHERE post_type = 'post' AND post_status = 'publish' "
    );
 
    if(count($posts) > 0){
        $outputhtml = '<ul>';

        foreach($posts as $post){
            $outputhtml .= '<li>'.$post->post_title.'</li>';
        }
        $outputhtml .= '</ul>';

        return $outputhtml;
    }
    return '<p>No posts found</p>';
}