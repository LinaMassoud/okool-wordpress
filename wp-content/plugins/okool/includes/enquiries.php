<?php
/**
 * Contact form enquiries: stored as a private post type and emailed to the site admin.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OKOOL_ENQUIRY_TYPE   = 'okool_enquiry';
const OKOOL_ENQUIRY_ACTION = 'okool_enquiry';

/**
 * Service options for the enquiry form, keyed by stored value.
 *
 * @return array<string, string>
 */
function okool_enquiry_services() {
	return [
		'workforce'  => __( 'Workforce Solutions', 'okool' ),
		'facilities' => __( 'Facilities Management', 'okool' ),
		'security'   => __( 'Security Services', 'okool' ),
		'multiple'   => __( 'Multiple services', 'okool' ),
	];
}

/**
 * Form fields: name => [ label, required, max length ].
 *
 * @return array<string, array{0: string, 1: bool, 2: int}>
 */
function okool_enquiry_fields() {
	return [
		'name'     => [ __( 'Full name', 'okool' ), true, 120 ],
		'company'  => [ __( 'Company name', 'okool' ), false, 160 ],
		'email'    => [ __( 'Work email', 'okool' ), true, 160 ],
		'phone'    => [ __( 'Phone number', 'okool' ), false, 40 ],
		'location' => [ __( 'Location', 'okool' ), false, 120 ],
		'service'  => [ __( 'Service required', 'okool' ), true, 20 ],
		'details'  => [ __( 'Requirement details', 'okool' ), true, 5000 ],
	];
}

/**
 * Register the Enquiries post type (admin-only, no front-end URLs).
 */
function okool_register_enquiry_type() {
	register_post_type(
		OKOOL_ENQUIRY_TYPE,
		[
			'labels'          => [
				'name'          => __( 'Enquiries', 'okool' ),
				'singular_name' => __( 'Enquiry', 'okool' ),
				'all_items'     => __( 'All Enquiries', 'okool' ),
				'edit_item'     => __( 'Enquiry', 'okool' ),
				'search_items'  => __( 'Search Enquiries', 'okool' ),
				'not_found'     => __( 'No enquiries yet.', 'okool' ),
			],
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_position'   => 25,
			'menu_icon'       => 'dashicons-email-alt',
			'supports'        => [ 'title' ],
			'capability_type' => 'post',
			'capabilities'    => [ 'create_posts' => 'do_not_allow' ],
			'map_meta_cap'    => true,
			'rewrite'         => false,
			'query_var'       => false,
		]
	);
}
add_action( 'init', 'okool_register_enquiry_type' );

/**
 * Handle a form submission from admin-post.php.
 */
function okool_handle_enquiry() {
	$back = wp_get_referer();
	$back = $back ? remove_query_arg( 'enquiry', $back ) : okool_page_url( 'contact', home_url( '/' ) );

	$redirect = static function ( $status ) use ( $back ) {
		wp_safe_redirect( add_query_arg( 'enquiry', $status, $back ) . '#enquiry' );
		exit;
	};

	if ( ! isset( $_POST['_okool_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['_okool_nonce'] ) ), OKOOL_ENQUIRY_ACTION ) ) {
		$redirect( 'expired' );
	}

	// Honeypot: real visitors never see or fill this field.
	if ( ! empty( $_POST['website'] ) ) {
		$redirect( 'sent' );
	}

	// Throttle: at most 5 enquiries per 10 minutes from one address.
	$ip_key = 'okool_enq_' . md5( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	$count  = (int) get_transient( $ip_key );
	if ( $count >= 5 ) {
		$redirect( 'limit' );
	}

	$data = [];
	foreach ( okool_enquiry_fields() as $key => $field ) {
		$raw = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized below.
		$raw = is_string( $raw ) ? $raw : '';

		if ( 'details' === $key ) {
			$value = sanitize_textarea_field( $raw );
		} elseif ( 'email' === $key ) {
			$value = sanitize_email( $raw );
		} else {
			$value = sanitize_text_field( $raw );
		}

		$value        = mb_substr( trim( $value ), 0, $field[2] );
		$data[ $key ] = $value;

		if ( $field[1] && '' === $value ) {
			$redirect( 'invalid' );
		}
	}

	if ( ! is_email( $data['email'] ) || ! isset( okool_enquiry_services()[ $data['service'] ] ) ) {
		$redirect( 'invalid' );
	}

	$service = okool_enquiry_services()[ $data['service'] ];
	$title   = $data['company'] ? $data['name'] . ' — ' . $data['company'] : $data['name'];

	$post_id = wp_insert_post(
		[
			'post_type'    => OKOOL_ENQUIRY_TYPE,
			'post_status'  => 'private',
			'post_title'   => $title,
			'post_content' => $data['details'],
			'meta_input'   => [
				'_okool_company'  => $data['company'],
				'_okool_email'    => $data['email'],
				'_okool_phone'    => $data['phone'],
				'_okool_location' => $data['location'],
				'_okool_service'  => $service,
			],
		],
		true
	);

	if ( is_wp_error( $post_id ) ) {
		$redirect( 'error' );
	}

	set_transient( $ip_key, $count + 1, 10 * MINUTE_IN_SECONDS );

	okool_notify_enquiry( (int) $post_id, $data, $service );

	$redirect( 'sent' );
}
add_action( 'admin_post_nopriv_' . OKOOL_ENQUIRY_ACTION, 'okool_handle_enquiry' );
add_action( 'admin_post_' . OKOOL_ENQUIRY_ACTION, 'okool_handle_enquiry' );

/**
 * Email the site admin about a new enquiry. Failure is non-fatal: the enquiry is already saved.
 *
 * @param int                  $post_id Enquiry post ID.
 * @param array<string,string> $data    Sanitized form data.
 * @param string               $service Service label.
 */
function okool_notify_enquiry( $post_id, $data, $service ) {
	$to = apply_filters( 'okool_enquiry_recipient', get_option( 'admin_email' ) );

	if ( ! $to ) {
		return;
	}

	$lines = [
		__( 'A new business enquiry was submitted on the website.', 'okool' ),
		'',
		__( 'Name', 'okool' ) . ': ' . $data['name'],
		__( 'Company', 'okool' ) . ': ' . $data['company'],
		__( 'Email', 'okool' ) . ': ' . $data['email'],
		__( 'Phone', 'okool' ) . ': ' . $data['phone'],
		__( 'Location', 'okool' ) . ': ' . $data['location'],
		__( 'Service', 'okool' ) . ': ' . $service,
		'',
		$data['details'],
		'',
		__( 'View in WordPress', 'okool' ) . ': ' . admin_url( 'post.php?post=' . $post_id . '&action=edit' ),
	];

	wp_mail(
		$to,
		/* translators: %s: enquirer name. */
		sprintf( __( 'New enquiry from %s', 'okool' ), $data['name'] ),
		implode( "\n", $lines ),
		[ 'Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>' ]
	);
}

/**
 * Admin list columns.
 *
 * @param string[] $columns Columns.
 * @return string[]
 */
function okool_enquiry_columns( $columns ) {
	return [
		'cb'      => $columns['cb'],
		'title'   => __( 'Name', 'okool' ),
		'email'   => __( 'Email', 'okool' ),
		'phone'   => __( 'Phone', 'okool' ),
		'service' => __( 'Service', 'okool' ),
		'date'    => __( 'Received', 'okool' ),
	];
}
add_filter( 'manage_' . OKOOL_ENQUIRY_TYPE . '_posts_columns', 'okool_enquiry_columns' );

/**
 * Render admin list column values.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function okool_enquiry_column_value( $column, $post_id ) {
	if ( 'email' === $column ) {
		$email = get_post_meta( $post_id, '_okool_email', true );
		printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $email ), esc_html( $email ) );
	} elseif ( in_array( $column, [ 'phone', 'service' ], true ) ) {
		echo esc_html( get_post_meta( $post_id, '_okool_' . $column, true ) );
	}
}
add_action( 'manage_' . OKOOL_ENQUIRY_TYPE . '_posts_custom_column', 'okool_enquiry_column_value', 10, 2 );

/**
 * Read-only details box on the enquiry screen.
 */
function okool_enquiry_meta_box() {
	add_meta_box(
		'okool-enquiry-details',
		__( 'Enquiry details', 'okool' ),
		static function ( $post ) {
			$rows = [
				__( 'Company', 'okool' )  => get_post_meta( $post->ID, '_okool_company', true ),
				__( 'Email', 'okool' )    => get_post_meta( $post->ID, '_okool_email', true ),
				__( 'Phone', 'okool' )    => get_post_meta( $post->ID, '_okool_phone', true ),
				__( 'Location', 'okool' ) => get_post_meta( $post->ID, '_okool_location', true ),
				__( 'Service', 'okool' )  => get_post_meta( $post->ID, '_okool_service', true ),
				__( 'Received', 'okool' ) => get_the_date( 'j F Y, H:i', $post ),
			];

			echo '<table class="form-table" role="presentation"><tbody>';
			foreach ( $rows as $label => $value ) {
				printf( '<tr><th scope="row">%1$s</th><td>%2$s</td></tr>', esc_html( $label ), esc_html( $value ? $value : '—' ) );
			}
			printf(
				'<tr><th scope="row">%1$s</th><td>%2$s</td></tr>',
				esc_html__( 'Requirement details', 'okool' ),
				wp_kses_post( wpautop( esc_html( $post->post_content ) ) )
			);
			echo '</tbody></table>';
		},
		OKOOL_ENQUIRY_TYPE,
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_' . OKOOL_ENQUIRY_TYPE, 'okool_enquiry_meta_box' );

/**
 * Status message for the form, from the `enquiry` query arg set after a submission.
 *
 * @return array{type: string, text: string}|null
 */
function okool_enquiry_notice() {
	$status = isset( $_GET['enquiry'] ) ? sanitize_key( wp_unslash( $_GET['enquiry'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.

	$messages = [
		'sent'    => [ 'success', __( 'Thank you. Your enquiry has been sent and our team will be in touch shortly.', 'okool' ) ],
		'invalid' => [ 'error', __( 'Please fill in your name, a valid work email, the service required and your requirement details.', 'okool' ) ],
		'expired' => [ 'error', __( 'Your session expired. Please submit the form again.', 'okool' ) ],
		'limit'   => [ 'error', __( 'Too many enquiries were sent from your connection. Please try again in a few minutes or email info@okool.com.', 'okool' ) ],
		'error'   => [ 'error', __( 'Something went wrong while sending your enquiry. Please try again or email info@okool.com.', 'okool' ) ],
	];

	if ( ! isset( $messages[ $status ] ) ) {
		return null;
	}

	return [
		'type' => $messages[ $status ][0],
		'text' => $messages[ $status ][1],
	];
}
