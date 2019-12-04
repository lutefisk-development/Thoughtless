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

?>

<section id="wrapper-hero" class="wrapper-hero">

	<article class="hero">

		<h1>here be heading</h1>

		<h2>here be subheading</h2>

		<small>
			<?php
				printf(
					__('Photo by %s on %s', 'understrap'),
					$hanna, $unsplash
				); 
			?>
		</small>

		<!-- button will be displayed only if admin has defined a valid link-->

	</article>

</section>

<!-- ACF spesific styles -->
<style>


</style>
