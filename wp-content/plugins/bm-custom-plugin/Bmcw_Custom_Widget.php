<?php

class Bmcw_Custom_Widget extends WP_Widget {
    //Constructor

    function __construct()
    {
        parent::__construct(
            'bmcw_custom_widget',
            'BM Custom Widget',
            array(
                'description' => 'Display a static message and recent post',
            )
        );
    }

    // Display Widget to Admin Panel
    public function form( $instance ) {
        $bmcw_title = ! empty( $instance['bmcw_title'] ) ? $instance['bmcw_title'] : esc_html__( 'New title', 'bmcw_domain' );
        $bmcw_select_option = ! empty( $instance['bmcw_select_option'] ) ? $instance['bmcw_select_option'] : esc_html__( 'recent_post', 'bmcw_domain' );
        $bmcw_recent_post_number = ! empty( $instance['bmcw_recent_post_number'] ) ? $instance['bmcw_recent_post_number'] : esc_html__( '5', 'bmcw_domain' );
        $bmcw_your_message = ! empty( $instance['bmcw_your_message'] ) ? $instance['bmcw_your_message'] : esc_html__( 'Write your message here', 'bmcw_domain' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('bmcw_title') ?>">Title</label>
            <input type="text" 
                id="<?php echo $this->get_field_id('bmcw_title') ?>" 
                name="<?php echo $this->get_field_name('bmcw_title') ?>" 
                value="<?php echo $bmcw_title ?>"
                class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bmcw_select_option') ?>">Display Type</label>
            <select class="widefat bmcw_dd_option" 
                id="<?php echo $this->get_field_id('bmcw_select_option') ?>"
                name="<?php echo $this->get_field_name('bmcw_select_option') ?>" 
            >
                <option <?php selected( $bmcw_select_option, 'recent_post' ); ?> value="recent_post">Recent Post</option>
                <option <?php selected( $bmcw_select_option, 'static_message' ); ?> value="static_message">Static Message</option>
            </select>
        </p>
        <p id="bmcw_display_recent_post" <?php if($bmcw_select_option == 'recent_post') {} else { echo 'class="hide_element"';} ?> >
            <label for="<?php echo $this->get_field_id('bmcw_recent_post_number') ?>">Recent Post</label>
            <input type="number" 
                    id="<?php echo $this->get_field_id('bmcw_recent_post_number') ?>" 
                    name="<?php echo $this->get_field_name('bmcw_recent_post_number') ?>" 
                    value="<?php echo $bmcw_recent_post_number ?>" class="widefat" 
            />
        </p>
        <p id="bmcw_display_static_message" <?php if($bmcw_select_option == 'static_message') {} else { echo 'class="hide_element"';} ?> >
            <label for="<?php echo $this->get_field_id('bmcw_your_message') ?>">Static Message</label>
            <input type="text"  
                    name="<?php echo $this->get_field_name('bmcw_your_message') ?>"  
                    id="<?php echo $this->get_field_id('bmcw_your_message') ?>" 
                    value="<?php echo $bmcw_your_message ?>" 
                    class="widefat" />
        </p>

        <?php
    }

    // Save Widget setting to WP
    public function update( $new_instance, $old_instance ) {

        $instance = []; 
        $instance['bmcw_title'] = ( ! empty( $new_instance['bmcw_title'] ) ) ? sanitize_text_field( $new_instance['bmcw_title'] ) : '';
        $instance['bmcw_select_option'] = ( ! empty( $new_instance['bmcw_select_option'] ) ) ? sanitize_text_field( $new_instance['bmcw_select_option'] ) : '';
        $instance['bmcw_recent_post_number'] = ( ! empty( $new_instance['bmcw_recent_post_number'] ) ) ? sanitize_text_field( $new_instance['bmcw_recent_post_number'] ) : '';
        $instance['bmcw_your_message'] = ( ! empty( $new_instance['bmcw_your_message'] ) ) ? sanitize_text_field( $new_instance['bmcw_your_message'] ) : '';
		
        return $instance;
	}

    // Display Widget to the Frontend
    public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['bmcw_title'] );

        echo $args['before_widget'];
            echo $args['before_title'];
                echo $title;
            echo $args['after_title'];

            // Check for the display type
            if($instance['bmcw_select_option'] == 'static_message'){
                echo $instance['bmcw_your_message'];
            
            }else if($instance['bmcw_select_option'] == 'recent_post'){

                $query = new WP_Query(array(
                    'post_per_page' => $instance['bmcw_recent_post_count'],
                    'post_status' => 'publish',
                ));

                if($query->have_posts()){
                    echo '<ul>';
                    while($query->have_posts()){
                        $query->the_post();
                        echo '<li> <a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                    }
                    echo '</ui>';

                    wp_reset_postdata();
                }

                
            }

        echo $args['after_widget'];

        
	}
    
}