<?php
/**
 * template for a single outlet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article class="col-md-4 col-sm-12">

    <main class="card">

        <div class="card-body">

            <h1 class="card-title">
                <?php the_title(); ?>
            </h1>
            <p class="card-text">
                <?php the_field('store_address'); ?>
            </p>
            <p class="card-text">
                <?php the_field('store_postnr'); ?>
                &nbsp;
                <?php the_field('store_city'); ?>
            </p>

        </div> <!-- /.card-body -->

    </main> <!-- /.card -->

</article> <!-- /article -->