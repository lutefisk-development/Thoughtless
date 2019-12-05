<?php

class Instagramwidget extends WP_Widget{
    /**
     * Register Widget with WordPress
     */
    public function __construct() {
        parent::__construct(
            'instagram', //Base ID
            'Instagram', //Widget name
            [
                'description' => __('A Widget which shows pictures from Instagram', 'instagram'),
            ]
            
        );
    }

    /**
     * Front End display of Widget
     */
    public function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if (! empty($title)) {
        echo $before_title . $title . $after_title;
        }
        echo $instance['content'];
        echo $after_widget;
    }

    /**
     * Front End for displaying widget in wp-admin
     */
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
        else {
            $title = __('New title', 'instagram');
        }
        if (isset($instance['content'])) {
            $content = $instance['content'];
        }
        else {
            $content = '';
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_name('title'); ?>">
            <?php _e('Title:'); ?>
        </label>
        <input 
        class="widefat" 
        id="<?php echo $this->get_field_id('title'); ?>" 
        name="<?php echo $this->get_field_name('title'); ?>" 
        type="text" 
        value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_name('content'); ?>">
            <?php _e('Content:'); ?>
        </label>
        <textarea 
            class="widefat" 
            id="<?php echo $this->get_field_id('content'); ?>" 
            name="<?php echo $this->get_field_name('content'); ?>" 
            rows="8"
            ><?php echo $content; ?></textarea>
        </p>
        <?php


    }

    public function update($new_instance, $old_instance){
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) 
        ? strip_tags($new_instance['title']) 
        : '';
        $instance['content'] = (!empty($new_instance['content'])) 
        ? $new_instance['content'] 
        : '';
        return $instance;
    }
}