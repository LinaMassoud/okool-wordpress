<?php
/**
 * Plugin Name: Okool Pages
 * Description: Okool page templates, including the designed homepage. Assign Template → Okool — Home on any page.
 * Version: 1.2.0
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Text Domain: okool
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OKOOL_VERSION', '1.2.0' );
define( 'OKOOL_DIR', plugin_dir_path( __FILE__ ) );
define( 'OKOOL_URL', plugin_dir_url( __FILE__ ) );

/**
 * URL for a file under the plugin assets directory.
 *
 * @param string $file Relative path under assets/.
 * @return string
 */
function okool_asset( $file ) {
	return OKOOL_URL . 'assets/' . ltrim( $file, '/' );
}

/**
 * Page designs. To add a page, add an entry here and templates/pages/{name}.php.
 *
 * @return array<string, array{label: string}>
 */
function okool_designs() {
	return [
		'home'   => [
			'label' => __( 'Home', 'okool' ),
		],
		'about'    => [
			'label' => __( 'About', 'okool' ),
		],
		'services' => [
			'label' => __( 'Services', 'okool' ),
		],
		'sample' => [
			'label' => __( 'Sample', 'okool' ),
		],
	];
}

/**
 * Page templates shown in the page editor, keyed `okool-{name}`.
 *
 * @return array<string, array{label: string, design: string}>
 */
function okool_pages() {
	$pages = [];

	foreach ( okool_designs() as $name => $design ) {
		$pages[ 'okool-' . $name ] = [
			/* translators: %s: page name. */
			'label'  => sprintf( __( 'Okool — %s', 'okool' ), $design['label'] ),
			'design' => $name,
		];
	}

	return $pages;
}

/**
 * Template key of the current Okool page, or an empty string.
 *
 * @return string
 */
function okool_current_page() {
	if ( ! is_page() ) {
		return '';
	}

	$template = get_page_template_slug( get_queried_object_id() );

	return isset( okool_pages()[ $template ] ) ? $template : '';
}

/**
 * Permalink of the first published page using an Okool design.
 *
 * @param string $design   Design name, e.g. `about`.
 * @param string $fallback URL to use when no such page exists.
 * @return string
 */
function okool_page_url( $design, $fallback = '' ) {
	static $cache = [];

	if ( ! array_key_exists( $design, $cache ) ) {
		$ids = get_posts(
			[
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_query_meta_key
				'meta_value'     => 'okool-' . $design, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_query_meta_value
			]
		);

		$cache[ $design ] = $ids ? (string) get_permalink( $ids[0] ) : '';
	}

	return $cache[ $design ] ? $cache[ $design ] : $fallback;
}

/**
 * Add the Okool templates to the page template dropdown.
 *
 * @param array $templates Page templates.
 * @return array
 */
function okool_register_templates( $templates ) {
	foreach ( okool_pages() as $key => $page ) {
		$templates[ $key ] = $page['label'];
	}

	return $templates;
}
add_filter( 'theme_page_templates', 'okool_register_templates' );

/**
 * Render the plugin template instead of the theme's.
 *
 * @param string $template Template path chosen by WordPress.
 * @return string
 */
function okool_template_include( $template ) {
	$page = okool_current_page();

	if ( ! $page ) {
		return $template;
	}

	$file = OKOOL_DIR . 'templates/pages/' . okool_pages()[ $page ]['design'] . '.php';

	return file_exists( $file ) ? $file : $template;
}
add_filter( 'template_include', 'okool_template_include', 99 );

/**
 * Body class for Okool pages.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function okool_body_class( $classes ) {
	$page = okool_current_page();

	if ( $page ) {
		$classes[] = 'okool-page';
		$classes[] = 'okool-' . okool_pages()[ $page ]['design'];
	}

	return $classes;
}
add_filter( 'body_class', 'okool_body_class' );

/**
 * Load fonts and homepage styles on Okool template pages.
 */
function okool_enqueue_assets() {
	if ( ! okool_current_page() ) {
		return;
	}

	wp_dequeue_style( 'okool' );

	wp_enqueue_style(
		'okool-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,520;9..144,620&family=Manrope:wght@400;500;600;700&display=swap',
		[],
		null
	);

	$css = OKOOL_DIR . 'assets/css/okool.css';

	wp_enqueue_style(
		'okool-pages',
		OKOOL_URL . 'assets/css/okool.css',
		[ 'okool-fonts' ],
		file_exists( $css ) ? (string) filemtime( $css ) : OKOOL_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'okool_enqueue_assets', 100 );

/**
 * Publish the Home page once and use it as the site front page.
 */
function okool_ensure_home_page() {
	if ( wp_installing() || get_option( 'okool_home_page' ) ) {
		return;
	}

	$ids = get_posts(
		[
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_query_meta_key
			'meta_value'     => 'okool-home', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_query_meta_value
		]
	);

	$page_id = $ids ? (int) $ids[0] : 0;

	if ( ! $page_id ) {
		$existing = get_posts(
			[
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'name'           => 'home',
				'posts_per_page' => 1,
				'fields'         => 'ids',
			]
		);
		$page_id  = $existing ? (int) $existing[0] : 0;

		if ( $page_id ) {
			update_post_meta( $page_id, '_wp_page_template', 'okool-home' );
		}
	}

	if ( ! $page_id ) {
		$created = wp_insert_post(
			[
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => __( 'Home', 'okool' ),
				'post_name'   => 'home',
				'meta_input'  => [
					'_wp_page_template' => 'okool-home',
				],
			],
			true
		);

		if ( is_wp_error( $created ) ) {
			return;
		}

		$page_id = (int) $created;
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $page_id );
	update_option( 'okool_home_page', $page_id, false );
}
add_action( 'init', 'okool_ensure_home_page', 20 );

/**
 * Publish a page for an Okool design once, unless one already exists.
 *
 * @param string $design Design name.
 * @param string $title  Page title.
 * @param string $slug   Page slug.
 */
function okool_ensure_page( $design, $title, $slug ) {
	$option = 'okool_' . $design . '_page';

	if ( wp_installing() || get_option( $option ) ) {
		return;
	}

	if ( okool_page_url( $design ) ) {
		update_option( $option, 1, false );
		return;
	}

	$created = wp_insert_post(
		[
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => $title,
			'post_name'   => $slug,
			'meta_input'  => [
				'_wp_page_template' => 'okool-' . $design,
			],
		],
		true
	);

	if ( ! is_wp_error( $created ) ) {
		update_option( $option, (int) $created, false );
	}
}

/**
 * Publish the inner Okool pages once.
 */
function okool_ensure_pages() {
	okool_ensure_page( 'about', __( 'About OKOOL', 'okool' ), 'about' );
	okool_ensure_page( 'services', __( 'Services', 'okool' ), 'services' );
}
add_action( 'init', 'okool_ensure_pages', 21 );
