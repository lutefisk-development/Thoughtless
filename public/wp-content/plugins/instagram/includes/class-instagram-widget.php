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
   * Function that sends post requests with curl
   * @param $api_url
   * @return mixed
   */
  public function curl_post( $uri, $data ){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri); // uri
    curl_setopt($ch, CURLOPT_POST, true); // POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // POST DATA
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // RETURN RESULT true
    curl_setopt($ch, CURLOPT_HEADER, 0); // RETURN HEADER false
    curl_setopt($ch, CURLOPT_NOBODY, 0); // NO RETURN BODY false / we need the body to return
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // VERIFY SSL HOST false
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // VERIFY SSL PEER false
    return json_decode(curl_exec($ch));
  }

  /**
   * Function that sends get requests with curl
   * @param $api_url
   * @return mixed
   */
  public function curl_get( $uri ){
    //Initialize cURL.
    $ch = curl_init();
    //Set the URL that you want to GET by using the CURLOPT_URL option.
    curl_setopt($ch, CURLOPT_URL, $uri);
    //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    return json_decode(curl_exec($ch));
  }

  /**
   * Front End display of Widget
   */
  public function widget($args, $instance){
    extract($args);
    // Gets the instances
    $title = apply_filters('widget_title', $instance['title']);
    $instagram_token = apply_filters('widget_title', $instance['instagram_token']);
    $nr_of_images = apply_filters('widget_title', $instance['nr_of_images']);
    $image_size = apply_filters('widget_title', $instance['image_size']);

    echo $before_widget;
    if (! empty($title)) {
        echo $before_title . $title . $after_title;
    }
    ?>

    <!-- Sends variables to javascript with a querySelector -->
    <div class="instagram"
      data-token="<?php echo $instagram_token; ?>"
      data-nr_of_images="<?php echo $nr_of_images; ?>"
      data-image_size="<?php echo $image_size; ?>">
    </div>

    <!-- Shows the Images -->
    <div class="content text-center mt-3">
      <span class="loading"><?php _e('Loading...', 'instagram'); ?></span>
    </div>

    <?php
    echo $after_widget;
  }

  /**
   * Front End for displaying widget in wp-admin
   */
  public function form($instance) {
    // Creates a token if it gets back a code from Instagram
    $new_token = $this->createToken($instance);
    // Shows the token
    if($new_token) {
      ?>
        <p>
          <label>
            <?php _e('New Token:', 'instagram'); ?>
          </label>
          <textarea rows="6" cols="34"><?php echo $new_token; ?></textarea>
        </p>
      <?php
      }
      
    /**
     * The field where you can insert your title
     */
    if (isset($instance['title'])) {
        $title = $instance['title'];
    }
    else {
        $title = __('New Title', 'instagram');
    }
    /**
     * The field where you can insert your Instagram token
     */
    if (isset($instance['instagram_token'])) {
      $instagram_token = $instance['instagram_token'];
    }
    else {
      $instagram_token = __('New Instagram Token', 'instagram');
    }
    /**
     * The field where you can insert your Number of images
     */
    if (isset($instance['nr_of_images'])) {
        $nr_of_images = $instance['nr_of_images'];
    }
    else {
        $nr_of_images = '4';
    }
    /**
     * Change the Image size
     */
    if (isset($instance['image_size'])) {
        $image_size = $instance['image_size'];
    }
    else {
        $image_size = '250';
    }
    /**
     * The field where you can insert your App id
     */
    if (isset($instance['app_id'])) {
        $app_id = $instance['app_id'];
    }
    else {
        $app_id = __('App Id', 'instagram');
    }
    /**
     * The field where you can insert your App secret
     */
    if (isset($instance['app_secret'])) {
        $app_secret = $instance['app_secret'];
    }
    else {
        $app_secret = __('App Secret', 'instagram');
    }

    /**
     * Creates input fields and labels for widget form
     */
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
            <?php _e('Number Of Images:', 'instagram'); ?>
        </label>
        <input class="widefat" id="<?php echo $this->get_field_id('nr_of_images'); ?>"
                name="<?php echo $this->get_field_name('nr_of_images'); ?>" type="text" value="<?php echo esc_attr($nr_of_images); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_name('image_size'); ?>">
            <?php _e('Image Size:', 'instagram'); ?>
        </label>
        <input class="widefat" id="<?php echo $this->get_field_id('image_size'); ?>"
                name="<?php echo $this->get_field_name('image_size'); ?>" type="text" value="<?php echo esc_attr($image_size); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_name('app_id'); ?>">
            <?php _e('App Id:', 'instagram'); ?>
        </label>
        <input class="widefat" id="<?php echo $this->get_field_id('app_id'); ?>"
                name="<?php echo $this->get_field_name('app_id'); ?>" type="text" value="<?php echo esc_attr($app_id); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_name('app_secret'); ?>">
            <?php _e('App Secret:', 'instagram'); ?>
        </label>
        <input class="widefat" id="<?php echo $this->get_field_id('app_secret'); ?>"
                name="<?php echo $this->get_field_name('app_secret'); ?>" type="text" value="<?php echo esc_attr($app_secret); ?>" />
      </p>
      <?php
      // Gets the url
      $url = get_site_url();
      // Link to get Instagram code used to create token
      ?>
      <a href="https://api.instagram.com/oauth/authorize?app_id=605693496868185&redirect_uri=<?php echo $url; ?>/wp-admin/widgets.php&scope=user_profile,user_media&response_type=code">
        <?php _e('Create New Instagram Token', 'instagram'); ?>
      </a>
    <?php
  }
  /**
   * Front End for displaying widget in wp-admin
   */
  public function update($new_instance, $old_instance){
    $instance = [];
    $instance['title'] = (!empty($new_instance['title'])) 
    ? strip_tags($new_instance['title']) 
    : '';
    $instance['instagram_token'] = (!empty($new_instance['instagram_token'])) 
    ? strip_tags($new_instance['instagram_token']) 
    : '';
    $instance['nr_of_images'] = (!empty($new_instance['nr_of_images']))
    ? strip_tags($new_instance['nr_of_images'])
    : '';
    $instance['image_size'] = (!empty($new_instance['image_size']))
    ? strip_tags($new_instance['image_size'])
    : '';
    $instance['app_id'] = (!empty($new_instance['app_id']))
    ? strip_tags($new_instance['app_id'])
    : '';
    $instance['app_secret'] = (!empty($new_instance['app_secret']))
    ? strip_tags($new_instance['app_secret'])
    : '';

    return $instance;
  }

  /**
   * Returns a 60 day Instagram Token
   */
  public function createToken($instance) {
    // Gets code from url
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = explode('code=', $actual_link);
    $code = $url[1];
    $app_id = apply_filters('widget_title', $instance['app_id']);
    $app_secret = apply_filters('widget_title', $instance['app_secret']);
    $site_url = get_site_url();

    // Sends a post request if there is a code
    if($code) {
      $uri = 'https://api.instagram.com/oauth/access_token'; 
      $data = [
        'app_id' => $app_id, 
        'app_secret' => $app_secret, 
        'grant_type' => 'authorization_code', 
        'redirect_uri' => $site_url . '/wp-admin/widgets.php',
        'code' => $code
      ];
      $obj_one = $this->curl_post($uri, $data);
      $token_one = $obj_one->access_token;
      // Sends a get request if there is a 1h token
      if($token_one) {
        $uri = 'https://graph.instagram.com/access_token?grant_type=ig_exchange_token&&client_secret='. $app_secret .'&access_token='. $token_one; 
        $obj_two = $this->curl_get($uri);
        $token_two = $obj_two->access_token;
        // returns the 60 day token
        if($token_two) {
          return $token_two;
        }
      }
    }
  }
}