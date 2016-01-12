<?php

function store_init() {
	register_post_type( 'store', array(
		'labels'            => array(
			'name'                => __( 'Stores', 'shippingninja' ),
			'singular_name'       => __( 'Store', 'shippingninja' ),
			'all_items'           => __( 'Stores', 'shippingninja' ),
			'new_item'            => __( 'New store', 'shippingninja' ),
			'add_new'             => __( 'Add New', 'shippingninja' ),
			'add_new_item'        => __( 'Add New store', 'shippingninja' ),
			'edit_item'           => __( 'Edit store', 'shippingninja' ),
			'view_item'           => __( 'View store', 'shippingninja' ),
			'search_items'        => __( 'Search stores', 'shippingninja' ),
			'not_found'           => __( 'No stores found', 'shippingninja' ),
			'not_found_in_trash'  => __( 'No stores found in trash', 'shippingninja' ),
			'parent_item_colon'   => __( 'Parent store', 'shippingninja' ),
			'menu_name'           => __( 'Stores', 'shippingninja' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
	) );

}
add_action( 'init', 'store_init' );

function store_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['store'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Store updated. <a target="_blank" href="%s">View store</a>', 'shippingninja'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'shippingninja'),
		3 => __('Custom field deleted.', 'shippingninja'),
		4 => __('Store updated.', 'shippingninja'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Store restored to revision from %s', 'shippingninja'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Store published. <a href="%s">View store</a>', 'shippingninja'), esc_url( $permalink ) ),
		7 => __('Store saved.', 'shippingninja'),
		8 => sprintf( __('Store submitted. <a target="_blank" href="%s">Preview store</a>', 'shippingninja'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Store scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview store</a>', 'shippingninja'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Store draft updated. <a target="_blank" href="%s">Preview store</a>', 'shippingninja'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'store_updated_messages' );
