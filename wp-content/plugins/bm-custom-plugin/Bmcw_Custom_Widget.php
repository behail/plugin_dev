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
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('bmcw_title') ?>">Title</label>
            <input type="text" 
                id="<?php echo $this->get_field_id('bmcw_title') ?>" 
                name="<?php echo $this->get_field_name('bmcw_title') ?>" 
                value="" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bmcw_select_option') ?>">Display Type</label>
            <select class="widefat" 
                id="<?php echo $this->get_field_id('bmcw_select_option') ?>"
                name="<?php echo $this->get_field_name('bmcw_select_option') ?>" 
            >
                <option value="">Recent Post</option>
                <option value="">Static Message</option>
            </select>
        </p>
        <p id="bmcw_display_recent_post">
            <label for="<?php echo $this->get_field_id('bmcw_recent_post_number') ?>">Recent Post</label>
            <input type="number" 
                    id="<?php echo $this->get_field_id('bmcw_recent_post_number') ?>" 
                    name="<?php echo $this->get_field_name('bmcw_recent_post_number') ?>" 
                    value="" class="widefat" 
            />
        </p>
        <p id="bmcw_display_static_message">
            <label for="<?php echo $this->get_field_id('bmcw_your_message') ?>">Static Message</label>
            <input type="text"  
                    name="<?php echo $this->get_field_name('bmcw_your_message') ?>"  
                    id="<?php echo $this->get_field_id('bmcw_your_message') ?>" 
                    value="" class="widefat" />
        </p>

        <?php
    }

    // Save Widget setting to WP
    public function update( $new_instance, $old_instance ) {
		
	}

    // Display Widget to the Frontend
    public function widget( $args, $instance ) {
		
	}
    
}