<?php
/**
 * Hero setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$hanna = '<a href="https://unsplash.com/@hannahmorgan7?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Hanna Morgan</a>';

$unsplash = '<a href="https://unsplash.com/s/photos/fashion?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>';

// Change to what ever the field is named on livesite!
$imgArray = wp_get_attachment_image_src(get_field('hero-image'), 'hero-image');
$link = get_field('hero-link');
?>

<section id="wrapper-hero-frontpage" class="wrapper-hero">
	<article class="hero">
		<h1>here be heading</h1>
		<h2>here be subheading</h2>

		<!-- button will be displayed only if admin has defined a valid link-->
		<?php if($link) : ?>
			<a href="" class="btn btn-primary"><?php echo the_field('hero-button-text'); ?></a>
		<?php endif; ?>

		<small>
			<?php
				printf(
					__('Photo by %s on %s', 'understrap'),
					$hanna, $unsplash
				); 
			?>
		</small>

	</article> <!--- /.jumbotron -->
</section> <!-- /#wrapper-hero-frontpage -->

<!-- ACF spesific styles -->
<style>
	.hero {
		min-height: 600px;
		background: linear-gradient(
			rgba(0, 0, 0, 0.35),
			rgba(0, 0, 0, 0.35)
		),
		url(
			<?php 
				if($imgArray) {
					echo $imgArray[0];
				}else {
					?>
						'https://via.placeholder.com/1200x675.png?text=placeholder+image+-%20https://placeholder.com/'
					<?php
				}
			?>
		);
		background-repeat:no-repeat;
		background-size:cover;
		background-position:center center;
	}
</style>