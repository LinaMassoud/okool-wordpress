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

require_once OKOOL_DIR . 'includes/i18n.php';
require_once OKOOL_DIR . 'includes/enquiries.php';
require_once OKOOL_DIR . 'includes/news.php';
require_once OKOOL_DIR . 'includes/service-pages.php';
require_once OKOOL_DIR . 'includes/vacancies.php';
require_once OKOOL_DIR . 'includes/applications.php';

/**
 * URL for a file under the plugin assets directory.
 *
 * Adds a short hash of the file's contents (?v=…) so browsers and page/CDN caches
 * fetch the new file whenever an image is replaced under the same name.
 *
 * @param string $file Relative path under assets/.
 * @return string
 */
function okool_asset( $file ) {
	static $versions = [];

	$file = ltrim( $file, '/' );

	if ( ! array_key_exists( $file, $versions ) ) {
		$path              = OKOOL_DIR . 'assets/' . $file;
		$hash              = is_readable( $path ) ? md5_file( $path ) : false;
		$versions[ $file ] = $hash ? substr( $hash, 0, 8 ) : '';
	}

	$url = OKOOL_URL . 'assets/' . $file;

	return '' === $versions[ $file ] ? $url : $url . '?v=' . $versions[ $file ];
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
		'contact'  => [
			'label' => __( 'Contact', 'okool' ),
		],
		'careers'  => [
			'label' => __( 'Careers', 'okool' ),
		],
		'service-workforce'     => [
			'label' => __( 'Service — Workforce Solutions', 'okool' ),
		],
		'service-talent'        => [
			'label' => __( 'Service — Talent Acquisition & Recruitment', 'okool' ),
		],
		'service-outsourcing'   => [
			'label' => __( 'Service — Workforce Outsourcing', 'okool' ),
		],
		'service-facilities'    => [
			'label' => __( 'Service — Facilities Management', 'okool' ),
		],
		'service-hard-fm'       => [
			'label' => __( 'Service — Hard Facilities Management', 'okool' ),
		],
		'service-soft-fm'       => [
			'label' => __( 'Service — Soft Facilities Management', 'okool' ),
		],
		'service-security'      => [
			'label' => __( 'Service — Security Services', 'okool' ),
		],
		'service-emiratisation' => [
			'label' => __( 'Service — Emiratisation', 'okool' ),
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
 * Design rendered for the current request: a page design name, `news` for the
 * news listing, `news-single` for one article, or an empty string.
 *
 * @return string
 */
function okool_current_design() {
	if ( is_post_type_archive( OKOOL_NEWS_TYPE ) ) {
		return 'news';
	}

	if ( is_singular( OKOOL_NEWS_TYPE ) ) {
		return 'news-single';
	}

	if ( is_post_type_archive( OKOOL_VACANCY_TYPE ) ) {
		return 'vacancies';
	}

	if ( okool_vacancy_is_apply() ) {
		return 'vacancy-apply';
	}

	if ( is_singular( OKOOL_VACANCY_TYPE ) ) {
		return 'vacancy-single';
	}

	$page = okool_current_page();

	return $page ? okool_pages()[ $page ]['design'] : '';
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
	$design = okool_current_design();

	if ( ! $design ) {
		return $template;
	}

	$file = OKOOL_DIR . 'templates/pages/' . $design . '.php';

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
	$design = okool_current_design();

	if ( $design ) {
		$classes[] = 'okool-page';
		$classes[] = 'okool-' . $design;

		if ( 0 === strpos( $design, 'service-' ) ) {
			$classes[] = 'okool-service-detail';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'okool_body_class' );

/**
 * Load page styles on Okool template pages.
 */
function okool_enqueue_assets() {
	$css  = OKOOL_DIR . 'assets/css/okool.css';
	$deps = [];

	if ( okool_current_design() ) {
		wp_dequeue_style( 'okool' );
	} elseif ( wp_style_is( 'okool', 'enqueued' ) ) {
		// Theme pages keep the theme's content styles; this sheet supplies the shared header and footer.
		$deps[] = 'okool';
	}

	wp_enqueue_style(
		'okool-pages',
		OKOOL_URL . 'assets/css/okool.css',
		$deps,
		file_exists( $css ) ? (string) filemtime( $css ) : OKOOL_VERSION
	);

	$count_js = OKOOL_DIR . 'assets/js/count-up.js';
	wp_enqueue_script(
		'okool-count-up',
		OKOOL_URL . 'assets/js/count-up.js',
		[],
		file_exists( $count_js ) ? (string) filemtime( $count_js ) : OKOOL_VERSION,
		[ 'in_footer' => true, 'strategy' => 'defer' ]
	);

	$float_js = OKOOL_DIR . 'assets/js/float-actions.js';
	wp_enqueue_script(
		'okool-float-actions',
		OKOOL_URL . 'assets/js/float-actions.js',
		[],
		file_exists( $float_js ) ? (string) filemtime( $float_js ) : OKOOL_VERSION,
		[ 'in_footer' => true, 'strategy' => 'defer' ]
	);
}
add_action( 'wp_enqueue_scripts', 'okool_enqueue_assets', 100 );

/**
 * Print the "Request a Service" and phone buttons.
 *
 * @param bool   $okool_pinned Pinned to the bottom of the window from the start.
 * @param string $okool_href   Link target for "Request a Service".
 */
function okool_render_float_actions( $okool_pinned, $okool_href ) {
	include OKOOL_DIR . 'templates/parts/float-actions.php';
}

/**
 * Pin the buttons on every page except home, which shows them in its hero bar.
 */
function okool_footer_float_actions() {
	if ( 'home' === okool_current_design() ) {
		return;
	}

	okool_render_float_actions( true, okool_link( okool_page_url( 'contact', home_url( '/#contact' ) ) ) );
}
add_action( 'wp_footer', 'okool_footer_float_actions', 5 );

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
 * ID of the first published page using an Okool design, or 0.
 *
 * @param string $design Design name.
 * @return int
 */
function okool_page_id( $design ) {
	$url = okool_page_url( $design );

	return $url ? (int) url_to_postid( $url ) : 0;
}

/**
 * Publish a page for an Okool design once, unless one already exists.
 *
 * @param string $design        Design name.
 * @param string $title         Page title.
 * @param string $slug          Page slug.
 * @param string $parent_design Design of the parent page, e.g. `services`, or '' for a top-level page.
 */
function okool_ensure_page( $design, $title, $slug, $parent_design = '' ) {
	$option = 'okool_' . $design . '_page';

	if ( wp_installing() || get_option( $option ) ) {
		return;
	}

	if ( okool_page_url( $design ) ) {
		update_option( $option, 1, false );
		return;
	}

	$parent_id = $parent_design ? okool_page_id( $parent_design ) : 0;

	if ( $parent_design && ! $parent_id ) {
		return; // Wait until the parent page exists.
	}

	// Adopt an existing page with the same path (e.g. a plain "Careers" page) instead of adding a duplicate.
	$path     = $parent_id ? get_page_uri( $parent_id ) . '/' . $slug : $slug;
	$existing = get_page_by_path( $path, OBJECT, 'page' );

	if ( $existing && 'publish' === $existing->post_status ) {
		update_post_meta( $existing->ID, '_wp_page_template', 'okool-' . $design );
		update_option( $option, (int) $existing->ID, false );
		return;
	}

	$created = wp_insert_post(
		[
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_parent' => $parent_id,
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
	okool_ensure_page( 'contact', __( 'Contact', 'okool' ), 'contact' );
	okool_ensure_page( 'careers', __( 'Careers', 'okool' ), 'careers' );
}
add_action( 'init', 'okool_ensure_pages', 21 );
