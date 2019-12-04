<?php
/**
 * Template for the front page
 */

if(!defined('ABSPATH')) {
    exit;  //exit if accessed directly
}

get_header();

$kampanj = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => -1,
    'product_cat' => 'featured'
]);


?>

<?php if ($kampanj->have_posts()): ?>
    <?php while ($kampanj->have_posts()): $kampanj->the_post()?>
        <p><?php the_title(); ?></p>
        <?php echo woocommerce_get_product_thumbnail(); ?>
    <?php endwhile;?>
<?php endif;?>
<?php wp_reset_postdata();?>


<div id="front-page-wrapper">
    <div class="hero">
        <h1>HERE BE HERO</h1>
    </div>
    <div class="kampanj">
        <h1>HERE BE KAMPANJ</h1>
    </div>
    <div class="best">
        <h1>HERE BE BESTSÄLJARE</h1>
    </div>
    <div class="insta">
        <h1>HERE BE INSTA</h1>
    </div>
</div>

<?php
get_footer();
?>




