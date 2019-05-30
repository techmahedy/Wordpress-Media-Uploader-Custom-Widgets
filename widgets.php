<?php
/*
Plugin Name: Media Uploader Photography
Plugin URI: 
Description: 
Version: 
Author: Mahedi Hasan
Author URI: 
License: GPLv2 or later
Text Domain: meadia-upload
*/

function plugin_script_loaded() {
    wp_enqueue_media();
    wp_register_script( 'custom-js', plugins_url('custom.js',__FILE__ ));
    wp_enqueue_script( 'custom-js' );
}
 
add_action( 'admin_init','plugin_script_loaded');

class Media_Uploader extends WP_Widget {
    function __construct(){
        $params = array(
           'description' => 'Display messages to readers',
           'name' => 'Photography: Media Upload'
        );

        parent::__construct('Photography','',$params ); //Parameter: id, name , options
    }

    public function form($instance){
        extract($instance);
        ?>
        <p>
        <label for="">Title</label>
        <input
            class="widefat"
            id="<?php echo $this->get_field_id('title'); ?>"
            name="<?php echo $this->get_field_name('title'); ?>"
            value="<?php echo isset($title) ? esc_attr($title) : ''; ?>" 
          />
        </p>
        
        <p>
            <button class="button button-secondary" id="author_info_image">Upload Image</button>
            <input type="hidden" id="<?php echo $this->get_field_id('link'); ?>"  name="<?php echo $this->get_field_name('link'); ?>" class="image_er_link" value="<?php echo isset($link) ? esc_url($link) : ''; ?>"
            />
            <div class="image_show">
                <img src="<?php echo isset($link) ? esc_url($link) : ''; ?>" alt="" width="50" height="50">
            </div>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('description'); ?>">Description</label>
        <textarea 
            class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo    $this->get_field_name('description'); ?>"><?php echo isset($description) ? esc_attr($description) : ''; ?>
        </textarea>
        </p>

        <?php
    }

    function widget($args, $instance)
    {
       extract($args);
       extract($instance);

       $title = apply_filters('widgets_title',$title);
       $description = apply_filters('widgets_description',$description);

       echo $before_widget;
         echo $before_title . $title . $after_title; ?>
        <img src="<?php echo $link; ?>" alt="<?php echo $title; ?>">
         <?php echo "<p>$description</p>";
       echo $after_widget;
    }
}

add_action('widgets_init','photographer_media_uploader'); 

function photographer_media_uploader(){
    register_widget('Media_Uploader');
}