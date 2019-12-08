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
        echo $before_widget;
        if (! empty($title)) {
            echo $before_title . $title . $after_title;
        }
        $access_token = 'ACCESS_TOKEN';

        $instagram_images = $this->curl_connect("https://graph.instagram.com/" . 'me' . '?fields=account_type,username,media&access_token=' . $access_token);

        $images = $instagram_images->media->data;
          ?>
            <div class="container">
              <div class="col-4">
                <div class="row">
                  <?php
                    foreach( $images as $image) {
                      echo '<br>';
                      $images_url = $this->curl_connect("https://graph.instagram.com/" . $image->id . '?fields=media_url,permalink&access_token=' . $access_token);
                      ?>
                        <img src="<?php echo $images_url->media_url; ?>" alt="insta_image" height="420" width="420">
                      <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          <?php

        //echo $instance['content'];
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
    /**
     * The field where you can insert your Instagram API token
     */

        ?>
  <p>
    <label for="<?php echo $this->get_field_name('title'); ?>">
      <?php _e('Title:'); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
      name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
  <?php
    /**
     * /The field where you can insert your Instagram API token
     */


    }
    /**
     * /Front End for displaying widget in wp-admin
     */

     /**
      * The Method which saves your insertef Instagram API token
      */
    public function update($new_instance, $old_instance){
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) 
        ? strip_tags($new_instance['title']) 
        : '';
        
        return $instance;
    }
    /**
      * /The Method which saves your insertef Instagram API token
      */
}