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
        //$title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if (! empty($title)) {
        echo $before_title . $title . $after_title;
        }
        //echo $instance['content'];
        echo $after_widget;
    
    ?>
    <div class="container">
        <div class="col-4">
            <h3>Instagram</h3>
            <div class="row">
                <p><?php _e('Popular pictures', 'instagram'); ?></p><br>
                <div class="popimages">
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }

    /**
     * Front End for displaying widget in wp-admin
     */
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
        else {
            $title = __('', 'instagram');
        }
    /**
     * The field where you can insert your Instagram username
     */
        ?>
        <p>
        <label for="<?php echo $this->get_field_name('title'); ?>">
            <?php _e('Username:'); ?>
        </label>
        <input 
        class="widefat" 
        id="<?php echo $this->get_field_id('title'); ?>" 
        name="<?php echo $this->get_field_name('title'); ?>" 
        type="text" 
        value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    /**
     * /The field where you can insert your Instagram username
     */
    /**
     * /The field where you can insert your Instagram password
     */
    ?>
        <p>
        <label for="<?php echo $this->get_field_name('title'); ?>">
            <?php _e('Password:'); ?>
        </label>
        <input 
        class="widefat" 
        id="<?php echo $this->get_field_id('title'); ?>" 
        name="<?php echo $this->get_field_name('title'); ?>" 
        type="password" 
        value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php

    /**
     * /The field where you can insert your Instagram password
     */


    }
    /**
     * /Front End for displaying widget in wp-admin
     */

     /**
      * The Method which saves your login
      */
    public function update($new_instance, $old_instance){
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) 
        ? strip_tags($new_instance['title']) 
        : '';
        $instance['password'] = (!empty($new_instance['password'])) 
        ? strip_tags($new_instance['password']) 
        : '';
        
        return $instance;
    }
    /**
      * /The Method which saves your insertef Instagram API token
      */
}