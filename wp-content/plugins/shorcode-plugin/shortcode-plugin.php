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