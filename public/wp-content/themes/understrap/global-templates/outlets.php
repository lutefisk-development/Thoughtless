<?php
/**
 * The template part for outlets
 */

if(!defined('ABSPATH')) {
    exit;  //exit if accessed directly
}

$outlets = new WP_Query([
    'post_type'         => 'us_stores',
    'posts_per_page'    => -1,
    'order'             => 'ASC'
]);
?>

<section class="wrapper" id="wrapper-outlets">
    
    <main class="container">
       
        <!-- conditional to for checking if we have any outlets -->
        <?php if($outlets->have_posts()) : ?>
        
        <h1 id="page-header"><?php _e('Thoughtless Outlets:', 'understrap'); ?></h1>
        
        <section class="row">

            <?php while($outlets->have_posts()) : $outlets->the_post() ?>

                <!-- here we include the loop-template file -->
                <?php get_template_part('loop-templates/content', 'outlet'); ?>

            <?php endwhile; ?>

        </section> <!-- /.row -->

        <?php endif; ?>
        <!-- Reset postdata back to blog-posts -->
        <?php wp_reset_postdata(); ?>

        <!-- place shortcode for google maps here -->
        <?php echo do_shortcode("[tgm]"); ?>

        <section class="row form-wrapper">

            <article class="col">

                <div class="form">

                    <?php echo do_shortcode("[contact-form-7 id='233' title='test']"); ?>

                </div>

            </article> <!-- /.col -->

        </section> <!-- /.row -->

    </main> <!-- /.container -->

</section> <!-- /#wrapper-outlets -->