<?php

function order_init() {
	register_post_type( 'order', array(
		'labels'            => array(
			'name'                => __( 'Orders', 'shippingninja' ),
			'singular_name'       => __( 'Order', 'shippingninja' ),
			'all_items'           => __( 'Orders', 'shippingninja' ),
			'new_item'            => __( 'New order', 'shippingninja' ),
			'add_new'             => __( 'Add New', 'shippingninja' ),
			'add_new_item'        => __( 'Add New order', 'shippingninja' ),
			'edit_item'           => __( 'Edit order', 'shippingninja' ),
			'view_item'           => __( 'View order', 'shippingninja' ),
			'search_items'        => __( 'Search orders', 'shippingninja' ),
			'not_found'           => __( 'No orders found', 'shippingninja' ),
			'not_found_in_trash'  => __( 'No orders found in trash', 'shippingninja' ),
			'parent_item_colon'   => __( 'Parent order', 'shippingninja' ),
			'menu_name'           => __( 'Orders', 'shippingninja' ),
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
add_action( 'init', 'order_init' );

function order_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['order'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Order updated. <a target="_blank" href="%s">View order</a>', 'shippingninja'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'shippingninja'),
		3 => __('Custom field deleted.', 'shippingninja'),
		4 => __('Order updated.', 'shippingninja'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Order restored to revision from %s', 'shippingninja'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Order published. <a href="%s">View order</a>', 'shippingninja'), esc_url( $permalink ) ),
		7 => __('Order saved.', 'shippingninja'),
		8 => sprintf( __('Order submitted. <a target="_blank" href="%s">Preview order</a>', 'shippingninja'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Order scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview order</a>', 'shippingninja'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Order draft updated. <a target="_blank" href="%s">Preview order</a>', 'shippingninja'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'order_updated_messages' );
