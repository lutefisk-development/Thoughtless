<?php
/**
 * Template for the front page
 */

if(!defined('ABSPATH')) {
    exit;  //exit if accessed directly
}

get_header();
get_template_part('global-templates/hero-frontpage');

// REMEMBER TO COMMENT THIS OUT WHEN GOING LIVE! MIGHT NOT WORK
echo do_shortcode("[wcps id='104']");

get_footer();