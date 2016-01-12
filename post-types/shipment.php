<?php

function shipment_init() {
	register_post_type( 'shipment', array(
		'labels'            => array(
			'name'                => __( 'Shipments', 'shippingninja' ),
			'singular_name'       => __( 'Shipment', 'shippingninja' ),
			'all_items'           => __( 'Shipments', 'shippingninja' ),
			'new_item'            => __( 'New shipment', 'shippingninja' ),
			'add_new'             => __( 'Add New', 'shippingninja' ),
			'add_new_item'        => __( 'Add New shipment', 'shippingninja' ),
			'edit_item'           => __( 'Edit shipment', 'shippingninja' ),
			'view_item'           => __( 'View shipment', 'shippingninja' ),
			'search_items'        => __( 'Search shipments', 'shippingninja' ),
			'not_found'           => __( 'No shipments found', 'shippingninja' ),
			'not_found_in_trash'  => __( 'No shipments found in trash', 'shippingninja' ),
			'parent_item_colon'   => __( 'Parent shipment', 'shippingninja' ),
			'menu_name'           => __( 'Shipments', 'shippingninja' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-email',
	) );

}
add_action( 'init', 'shipment_init' );

function shipment_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['shipment'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Shipment updated. <a target="_blank" href="%s">View shipment</a>', 'shippingninja'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'shippingninja'),
		3 => __('Custom field deleted.', 'shippingninja'),
		4 => __('Shipment updated.', 'shippingninja'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Shipment restored to revision from %s', 'shippingninja'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Shipment published. <a href="%s">View shipment</a>', 'shippingninja'), esc_url( $permalink ) ),
		7 => __('Shipment saved.', 'shippingninja'),
		8 => sprintf( __('Shipment submitted. <a target="_blank" href="%s">Preview shipment</a>', 'shippingninja'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Shipment scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview shipment</a>', 'shippingninja'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Shipment draft updated. <a target="_blank" href="%s">Preview shipment</a>', 'shippingninja'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'shipment_updated_messages' );
