<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Stores.
	 */

	$labels = [
		"name" => __( "Stores", "understrap" ),
		"singular_name" => __( "Store", "understrap" ),
	];

	$args = [
		"label" => __( "Stores", "understrap" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "stores", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "custom-fields" ],
	];

	register_post_type( "us_stores", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
