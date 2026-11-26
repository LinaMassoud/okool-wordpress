<?php
/**
 * Job applications: submitted from /careers/vacancies/{role}/apply/, stored as private posts
 * under Vacancies → Applications, with the CV kept in a protected uploads folder.
 *
 * Sample vacancies never accept applications.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OKOOL_APPLICATION_TYPE   = 'okool_application';
const OKOOL_APPLICATION_ACTION = 'okool_apply';
const OKOOL_CV_MAX_BYTES       = 5 * 1024 * 1024;

/**
 * Allowed CV file types.
 *
 * @return array<string, string> Extension => MIME type.
 */
function okool_cv_mimes() {
	return [
		'pdf'  => 'application/pdf',
		'doc'  => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	];
}

/**
 * Register the Applications post type (admin only, listed under Vacancies).
 */
function okool_register_application_type() {
	register_post_type(
		OKOOL_APPLICATION_TYPE,
		[
			'labels'          => [
				'name'          => __( 'Applications', 'okool' ),
				'singular_name' => __( 'Application', 'okool' ),
				'all_items'     => __( 'Applications', 'okool' ),
				'edit_item'     => __( 'Application', 'okool' ),
				'search_items'  => __( 'Search applications', 'okool' ),
				'not_found'     => __( 'No applications yet.', 'okool' ),
			],
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => 'edit.php?post_type=' . OKOOL_VACANCY_TYPE,
			'supports'        => [ 'title' ],
			'capability_type' => 'post',
			'capabilities'    => [ 'create_posts' => 'do_not_allow' ],
			'map_meta_cap'    => true,
			'rewrite'         => false,
			'query_var'       => false,
		]
	);
}
add_action( 'init', 'okool_register_application_type' );

/**
 * Folder where CVs are stored: wp-content/uploads/okool-applications/, blocked from direct access.
 *
 * @return string Absolute path, or '' if it could not be created.
 */
function okool_cv_dir() {
	$uploads = wp_upload_dir( null, false );
	$dir     = trailingslashit( $uploads['basedir'] ) . 'okool-applications';

	if ( ! wp_mkdir_p( $dir ) ) {
		return '';
	}

	// Block direct downloads (Apache / LiteSpeed); files also get unguessable names.
	if ( ! file_exists( $dir . '/.htaccess' ) ) {
		file_put_contents( $dir . '/.htaccess', "Require all denied\nDeny from all\n" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
	}
	if ( ! file_exists( $dir . '/index.php' ) ) {
		file_put_contents( $dir . '/index.php', "<?php\n// Silence is golden.\n" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
	}

	return $dir;
}

/**
 * Status message for the application form, from the `application` query arg.
 *
 * @return array{type: string, text: string}|null
 */
function okool_application_notice() {
	$status = isset( $_GET['application'] ) ? sanitize_key( wp_unslash( $_GET['application'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.

	$messages = [
		'sent'    => [ 'success', __( 'Thank you. Your application has been received and our recruitment team will be in touch if your profile matches the role.', 'okool' ) ],
		'invalid' => [ 'error', __( 'Please enter your full name and a valid email address.', 'okool' ) ],
		'cv'      => [ 'error', __( 'Please attach your CV as a PDF or Word file of up to 5 MB.', 'okool' ) ],
		'expired' => [ 'error', __( 'Your session expired. Please submit the form again.', 'okool' ) ],
		'limit'   => [ 'error', __( 'Too many applications were sent from your connection. Please try again in a few minutes.', 'okool' ) ],
		'closed'  => [ 'error', __( 'This role is not accepting applications.', 'okool' ) ],
		'error'   => [ 'error', __( 'Something went wrong while sending your application. Please try again or email info@okool.com.', 'okool' ) ],
	];

	return isset( $messages[ $status ] ) ? [ 'type' => $messages[ $status ][0], 'text' => $messages[ $status ][1] ] : null;
}

/**
 * Handle an application submitted to admin-post.php.
 */
function okool_handle_application() {
	$vacancy_id = isset( $_POST['vacancy'] ) ? absint( $_POST['vacancy'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Missing -- verified below.
	$vacancy    = $vacancy_id ? get_post( $vacancy_id ) : null;
	$valid_role = $vacancy && OKOOL_VACANCY_TYPE === $vacancy->post_type && 'publish' === $vacancy->post_status;

	$back = wp_get_referer();
	$back = $back ? remove_query_arg( 'application', $back ) : ( $valid_role ? okool_vacancy_apply_url( $vacancy ) : home_url( '/' ) );

	$redirect = static function ( $status ) use ( $back ) {
		wp_safe_redirect( add_query_arg( 'application', $status, $back ) . '#application' );
		exit;
	};

	if ( ! isset( $_POST['_okool_apply_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['_okool_apply_nonce'] ) ), OKOOL_APPLICATION_ACTION ) ) {
		$redirect( 'expired' );
	}

	if ( ! $valid_role || get_post_meta( $vacancy_id, '_okool_sample', true ) ) {
		$redirect( 'closed' );
	}

	// Honeypot: real visitors never see or fill this field.
	if ( ! empty( $_POST['website'] ) ) {
		$redirect( 'sent' );
	}

	// Throttle: at most 5 applications per 10 minutes from one address.
	$ip_key = 'okool_app_' . md5( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	$count  = (int) get_transient( $ip_key );
	if ( $count >= 5 ) {
		$redirect( 'limit' );
	}

	$name    = isset( $_POST['full_name'] ) ? mb_substr( sanitize_text_field( wp_unslash( $_POST['full_name'] ) ), 0, 120 ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? mb_substr( sanitize_text_field( wp_unslash( $_POST['phone'] ) ), 0, 40 ) : '';
	$message = isset( $_POST['message'] ) ? mb_substr( sanitize_textarea_field( wp_unslash( $_POST['message'] ) ), 0, 5000 ) : '';

	if ( '' === $name || ! is_email( $email ) ) {
		$redirect( 'invalid' );
	}

	// CV: required, PDF or Word, up to 5 MB, content checked against its extension.
	$file = isset( $_FILES['cv'] ) && is_array( $_FILES['cv'] ) ? $_FILES['cv'] : null; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- validated below.
	if ( ! $file || UPLOAD_ERR_OK !== (int) $file['error'] || (int) $file['size'] <= 0 || (int) $file['size'] > OKOOL_CV_MAX_BYTES || ! is_uploaded_file( $file['tmp_name'] ) ) {
		$redirect( 'cv' );
	}

	$check = wp_check_filetype_and_ext( $file['tmp_name'], sanitize_file_name( $file['name'] ), okool_cv_mimes() );
	if ( empty( $check['ext'] ) || ! isset( okool_cv_mimes()[ $check['ext'] ] ) ) {
		$redirect( 'cv' );
	}

	$dir = okool_cv_dir();
	if ( '' === $dir ) {
		$redirect( 'error' );
	}

	$stored = wp_generate_password( 24, false ) . '.' . $check['ext'];
	if ( ! move_uploaded_file( $file['tmp_name'], $dir . '/' . $stored ) ) {
		$redirect( 'error' );
	}

	$post_id = wp_insert_post(
		[
			'post_type'    => OKOOL_APPLICATION_TYPE,
			'post_status'  => 'private',
			'post_title'   => $name . ' — ' . $vacancy->post_title,
			'post_content' => $message,
			'meta_input'   => [
				'_okool_vacancy'   => $vacancy_id,
				'_okool_email'     => $email,
				'_okool_phone'     => $phone,
				'_okool_cv_file'   => $stored,
				'_okool_cv_name'   => sanitize_file_name( $file['name'] ),
			],
		],
		true
	);

	if ( is_wp_error( $post_id ) ) {
		wp_delete_file( $dir . '/' . $stored );
		$redirect( 'error' );
	}

	set_transient( $ip_key, $count + 1, 10 * MINUTE_IN_SECONDS );

	okool_notify_application( (int) $post_id, $vacancy, $name, $email, $phone, $message, $dir . '/' . $stored );

	$redirect( 'sent' );
}
add_action( 'admin_post_nopriv_' . OKOOL_APPLICATION_ACTION, 'okool_handle_application' );
add_action( 'admin_post_' . OKOOL_APPLICATION_ACTION, 'okool_handle_application' );

/**
 * Email the site admin about a new application, with the CV attached. Failure is non-fatal.
 *
 * @param int     $post_id Application ID.
 * @param WP_Post $vacancy Vacancy.
 * @param string  $name    Applicant name.
 * @param string  $email   Applicant email.
 * @param string  $phone   Applicant phone.
 * @param string  $message Applicant message.
 * @param string  $cv_path Stored CV path.
 */
function okool_notify_application( $post_id, $vacancy, $name, $email, $phone, $message, $cv_path ) {
	$to = apply_filters( 'okool_application_recipient', get_option( 'admin_email' ) );

	if ( ! $to ) {
		return;
	}

	$lines = [
		/* translators: %s: role title. */
		sprintf( __( 'A new application was submitted for %s.', 'okool' ), $vacancy->post_title ),
		'',
		__( 'Name', 'okool' ) . ': ' . $name,
		__( 'Email', 'okool' ) . ': ' . $email,
		__( 'Phone', 'okool' ) . ': ' . $phone,
		'',
		$message,
		'',
		__( 'View in WordPress', 'okool' ) . ': ' . admin_url( 'post.php?post=' . $post_id . '&action=edit' ),
	];

	wp_mail(
		$to,
		/* translators: 1: applicant name, 2: role title. */
		sprintf( __( 'Application from %1$s — %2$s', 'okool' ), $name, $vacancy->post_title ),
		implode( "\n", $lines ),
		[ 'Reply-To: ' . $name . ' <' . $email . '>' ],
		file_exists( $cv_path ) ? [ $cv_path ] : []
	);
}

/**
 * Let administrators download a stored CV (direct access to the folder is blocked).
 */
function okool_download_cv() {
	$post_id = isset( $_GET['application'] ) ? absint( $_GET['application'] ) : 0;

	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) || ! check_admin_referer( 'okool_cv_' . $post_id ) ) {
		wp_die( esc_html__( 'You are not allowed to download this file.', 'okool' ), 403 );
	}

	$stored = basename( (string) get_post_meta( $post_id, '_okool_cv_file', true ) );
	$path   = okool_cv_dir() . '/' . $stored;

	if ( '' === $stored || ! is_file( $path ) ) {
		wp_die( esc_html__( 'The CV file could not be found.', 'okool' ), 404 );
	}

	$name = (string) get_post_meta( $post_id, '_okool_cv_name', true );
	$type = wp_check_filetype( $path, okool_cv_mimes() );

	nocache_headers();
	header( 'Content-Type: ' . ( $type['type'] ? $type['type'] : 'application/octet-stream' ) );
	header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $name ? $name : $stored ) . '"' );
	header( 'Content-Length: ' . filesize( $path ) );
	readfile( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_readfile
	exit;
}
add_action( 'admin_post_okool_cv', 'okool_download_cv' );

/**
 * Download link for an application's CV.
 *
 * @param int $post_id Application ID.
 * @return string
 */
function okool_cv_download_url( $post_id ) {
	return wp_nonce_url( admin_url( 'admin-post.php?action=okool_cv&application=' . $post_id ), 'okool_cv_' . $post_id );
}

/**
 * Admin list columns.
 *
 * @param string[] $columns Columns.
 * @return string[]
 */
function okool_application_columns( $columns ) {
	return [
		'cb'    => $columns['cb'],
		'title' => __( 'Applicant', 'okool' ),
		'role'  => __( 'Role', 'okool' ),
		'email' => __( 'Email', 'okool' ),
		'cv'    => __( 'CV', 'okool' ),
		'date'  => __( 'Received', 'okool' ),
	];
}
add_filter( 'manage_' . OKOOL_APPLICATION_TYPE . '_posts_columns', 'okool_application_columns' );

/**
 * Admin list column values.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function okool_application_column_value( $column, $post_id ) {
	if ( 'role' === $column ) {
		echo esc_html( get_the_title( (int) get_post_meta( $post_id, '_okool_vacancy', true ) ) );
	} elseif ( 'email' === $column ) {
		$email = get_post_meta( $post_id, '_okool_email', true );
		printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $email ), esc_html( $email ) );
	} elseif ( 'cv' === $column && get_post_meta( $post_id, '_okool_cv_file', true ) ) {
		printf( '<a href="%1$s">%2$s</a>', esc_url( okool_cv_download_url( $post_id ) ), esc_html__( 'Download', 'okool' ) );
	}
}
add_action( 'manage_' . OKOOL_APPLICATION_TYPE . '_posts_custom_column', 'okool_application_column_value', 10, 2 );

/**
 * Read-only details box on the application screen.
 */
function okool_application_meta_box() {
	add_meta_box(
		'okool-application-details',
		__( 'Application details', 'okool' ),
		static function ( $post ) {
			$vacancy = (int) get_post_meta( $post->ID, '_okool_vacancy', true );
			$rows    = [
				__( 'Role', 'okool' )     => get_the_title( $vacancy ),
				__( 'Email', 'okool' )    => get_post_meta( $post->ID, '_okool_email', true ),
				__( 'Phone', 'okool' )    => get_post_meta( $post->ID, '_okool_phone', true ),
				__( 'Received', 'okool' ) => get_the_date( 'j F Y, H:i', $post ),
			];

			echo '<table class="form-table" role="presentation"><tbody>';
			foreach ( $rows as $label => $value ) {
				printf( '<tr><th scope="row">%1$s</th><td>%2$s</td></tr>', esc_html( $label ), esc_html( $value ? $value : '—' ) );
			}
			if ( get_post_meta( $post->ID, '_okool_cv_file', true ) ) {
				printf(
					'<tr><th scope="row">%1$s</th><td><a class="button" href="%2$s">%3$s</a> %4$s</td></tr>',
					esc_html__( 'CV', 'okool' ),
					esc_url( okool_cv_download_url( $post->ID ) ),
					esc_html__( 'Download CV', 'okool' ),
					esc_html( (string) get_post_meta( $post->ID, '_okool_cv_name', true ) )
				);
			}
			printf(
				'<tr><th scope="row">%1$s</th><td>%2$s</td></tr>',
				esc_html__( 'Message', 'okool' ),
				wp_kses_post( wpautop( esc_html( $post->post_content ? $post->post_content : '—' ) ) )
			);
			echo '</tbody></table>';
		},
		OKOOL_APPLICATION_TYPE,
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_' . OKOOL_APPLICATION_TYPE, 'okool_application_meta_box' );

/**
 * Delete the stored CV when an application is permanently deleted.
 *
 * @param int $post_id Post ID.
 */
function okool_application_delete_cv( $post_id ) {
	if ( OKOOL_APPLICATION_TYPE !== get_post_type( $post_id ) ) {
		return;
	}

	$stored = basename( (string) get_post_meta( $post_id, '_okool_cv_file', true ) );
	if ( '' !== $stored ) {
		wp_delete_file( okool_cv_dir() . '/' . $stored );
	}
}
add_action( 'before_delete_post', 'okool_application_delete_cv' );
