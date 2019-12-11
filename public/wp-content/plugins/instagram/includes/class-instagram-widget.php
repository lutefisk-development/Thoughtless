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
     * @param $api_url
     * @return mixed
     */
    public function curl_connect( $api_url ){
      $connection_c = curl_init(); // initializing
      curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
      curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
      curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
      $json_return = curl_exec( $connection_c ); // connect and get json data
      curl_close( $connection_c ); // close connection
      return json_decode( $json_return ); // decode and return
    }

    /**
     * Front End display of Widget
     */
    public function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $instagram_token = apply_filters('widget_title', $instance['instagram_token']);
        $nr_of_images = apply_filters('widget_title', $instance['nr_of_images']);

        echo $before_widget;
        if (! empty($title)) {
            echo $before_title . $title . $after_title;
        }
        ?>

        <div class="instagram"  data-token="<?php echo $instagram_token; ?>" data-nr_of_images="<?php echo $nr_of_images; ?>"></div>

        <div class="content">
          <span class="loading">Loading...</span>
        </div>

        <?php


        //echo $instance['content'];
        echo $after_widget;

        return $instagram_token;
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
    /**
     * The field where you can insert your Instagram token
     */
      if (isset($instance['instagram_token'])) {
        $instagram_token = $instance['instagram_token'];
      }
      else {
        $instagram_token = __('New instagram_token', 'instagram');
      }
        /**
         * The field where you can insert your number of images
         */
        if (isset($instance['nr_of_images'])) {
            $nr_of_images = $instance['nr_of_images'];
        }
        else {
            $nr_of_images = __('4', 'instagram');
        }


      ?>
        <p>
          <label for="<?php echo $this->get_field_name('title'); ?>">
            <?php _e('Title:', 'instagram'); ?>
          </label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
            name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_name('instagram_token'); ?>">
            <?php _e('Instagram Token:', 'instagram'); ?>
          </label>
          <input class="widefat" id="<?php echo $this->get_field_id('instagram_token'); ?>"
            name="<?php echo $this->get_field_name('instagram_token'); ?>" type="text" value="<?php echo esc_attr($instagram_token); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name('nr_of_images'); ?>">
                <?php _e('Number of images:', 'instagram'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('nr_of_images'); ?>"
                   name="<?php echo $this->get_field_name('nr_of_images'); ?>" type="text" value="<?php echo esc_attr($nr_of_images); ?>" />
        </p>
<!--        --><?php
//        $url = get_site_url();
//        ?>
<!--        <a href="https://api.instagram.com/oauth/authorize?app_id=605693496868185&redirect_uri=--><?php //echo $url; ?><!--/&scope=user_profile,user_media&response_type=code" target="_blank">-->
<!--          Get code for access token-->
<!--        <a>-->
      <?php

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
        /**
        * /The Method which saves your insertef Instagram API token
        */
        $instance['instagram_token'] = (!empty($new_instance['instagram_token'])) 
        ? strip_tags($new_instance['instagram_token']) 
        : '';

        $instance['nr_of_images'] = (!empty($new_instance['nr_of_images']))
        ? strip_tags($new_instance['nr_of_images'])
        : '';

        return $instance;
    }
}