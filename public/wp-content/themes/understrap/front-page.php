<?php
/**
 * Template for the front page
 */

if(!defined('ABSPATH')) {
    exit;  //exit if accessed directly
}

get_header();
get_template_part('global-templates/hero-frontpage');

// REMEMBER TO COMMENT THIS OUT WHEN GOING LIVE! MIGHT NOPT WORK
echo do_shortcode("[wcps id='104']");
?>


<div id="front-page-wrapper">
    <div class="best">
        <h1>HERE BE BESTSÄLJARE</h1>
    </div>
    <div class="insta">
        <h1>HERE BE INSTA</h1>
    </div>
</div>

<?php
get_footer();