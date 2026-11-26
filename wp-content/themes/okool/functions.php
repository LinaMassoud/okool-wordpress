<?php

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'okool',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css')
    );
});

if ( ! function_exists( 'okool_asset' ) ) {
	/**
	 * Theme asset URL (used when the Okool Pages plugin is not active).
	 *
	 * @param string $file Relative path under assets/.
	 * @return string
	 */
	function okool_asset( $file ) {
		return get_template_directory_uri() . '/assets/' . ltrim( $file, '/' );
	}
}

/*
 * The shared header and footer use these Okool Pages plugin helpers. The fallbacks
 * below keep every page rendering if the plugin is switched off.
 */
if ( ! function_exists( 'okool_link' ) ) {
	function okool_link( $url ) {
		return $url;
	}
}

if ( ! function_exists( 'okool_is_ar' ) ) {
	function okool_is_ar() {
		return false;
	}
}

if ( ! function_exists( 'okool_switch_url' ) ) {
	function okool_switch_url() {
		return '#';
	}
}

if ( ! function_exists( 'okool_page_url' ) ) {
	function okool_page_url( $design, $fallback = '' ) {
		return $fallback;
	}
}

if ( ! function_exists( 'okool_current_page' ) ) {
	function okool_current_page() {
		return '';
	}
}

if ( ! function_exists( 'okool_current_design' ) ) {
	function okool_current_design() {
		return '';
	}
}

/**
 * News listing URL.
 *
 * @return string
 */
function okool_theme_news_url() {
	$url = defined( 'OKOOL_NEWS_TYPE' ) ? get_post_type_archive_link( OKOOL_NEWS_TYPE ) : '';

	return $url ? $url : home_url( '/news/' );
}
