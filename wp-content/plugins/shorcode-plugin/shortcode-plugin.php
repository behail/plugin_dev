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