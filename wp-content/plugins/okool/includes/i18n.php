<?php
/**
 * Arabic version of the front end.
 *
 * The language is chosen with `?lang=ar` and carried on every internal link via okool_link().
 * Template text is written in English with __( '…', 'okool' ) and translated from
 * languages/ar.php, so editing a translation never touches the templates.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OKOOL_LANG_ARG = 'lang';

/**
 * Whether the current front-end request is in Arabic.
 *
 * @return bool
 */
function okool_is_ar() {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return false;
	}

	return isset( $_GET[ OKOOL_LANG_ARG ] ) && 'ar' === $_GET[ OKOOL_LANG_ARG ]; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- language choice only.
}

/**
 * Add the current language to an internal URL. Leaves anchors, mailto: and tel: links alone.
 *
 * @param string $url URL.
 * @return string
 */
function okool_link( $url ) {
	if ( ! okool_is_ar() || '' === $url || '#' === $url[0] || preg_match( '/^(mailto|tel):/i', $url ) ) {
		return $url;
	}

	$hash = '';
	$pos  = strpos( $url, '#' );

	if ( false !== $pos ) {
		$hash = substr( $url, $pos );
		$url  = substr( $url, 0, $pos );
	}

	return add_query_arg( OKOOL_LANG_ARG, 'ar', $url ) . $hash;
}

/**
 * URL of the current page in the other language.
 *
 * @return string
 */
function okool_switch_url() {
	$url = remove_query_arg( [ OKOOL_LANG_ARG, 'enquiry' ] );

	return okool_is_ar() ? $url : add_query_arg( OKOOL_LANG_ARG, 'ar', $url );
}

/**
 * Arabic strings keyed by their English source.
 *
 * @return array<string, string>
 */
function okool_ar_strings() {
	static $strings = null;

	if ( null === $strings ) {
		$strings = require OKOOL_DIR . 'languages/ar.php';
	}

	return $strings;
}

/**
 * Translate okool strings on Arabic requests.
 *
 * @param string $translation Translated text.
 * @param string $text        Source text.
 * @return string
 */
function okool_gettext( $translation, $text ) {
	if ( ! okool_is_ar() ) {
		return $translation;
	}

	$strings = okool_ar_strings();

	return isset( $strings[ $text ] ) ? $strings[ $text ] : $translation;
}
add_filter( 'gettext_okool', 'okool_gettext', 10, 2 );

/**
 * Set lang="ar" dir="rtl" on the <html> element.
 *
 * @param string $output Language attributes.
 * @return string
 */
function okool_language_attributes( $output ) {
	return okool_is_ar() ? 'lang="ar" dir="rtl"' : $output;
}
add_filter( 'language_attributes', 'okool_language_attributes' );

/**
 * Body class for Arabic pages.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function okool_lang_body_class( $classes ) {
	if ( okool_is_ar() ) {
		$classes[] = 'okool-ar';
	}

	return $classes;
}
add_filter( 'body_class', 'okool_lang_body_class' );

/**
 * Tell search engines about both language versions.
 */
function okool_hreflang() {
	if ( ! function_exists( 'okool_current_design' ) || ! okool_current_design() ) {
		return;
	}

	$url = remove_query_arg( [ OKOOL_LANG_ARG, 'enquiry', 'paged' ], home_url( add_query_arg( [] ) ) );

	printf( '<link rel="alternate" hreflang="en" href="%s">' . "\n", esc_url( $url ) );
	printf( '<link rel="alternate" hreflang="ar" href="%s">' . "\n", esc_url( add_query_arg( OKOOL_LANG_ARG, 'ar', $url ) ) );
}
add_action( 'wp_head', 'okool_hreflang', 2 );

/**
 * A post date such as "19 November 2026" or "19 نوفمبر 2026".
 *
 * @param int|WP_Post|null $post Post.
 * @return string
 */
function okool_date( $post = null ) {
	if ( ! okool_is_ar() ) {
		return (string) get_the_date( 'j F Y', $post );
	}

	$months = [ 'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر' ];
	$month  = (int) get_the_date( 'n', $post );

	return get_the_date( 'j', $post ) . ' ' . $months[ $month - 1 ] . ' ' . get_the_date( 'Y', $post );
}

/**
 * Translate the browser tab title on Arabic pages.
 *
 * @param array<string, string> $parts Title parts.
 * @return array<string, string>
 */
function okool_document_title( $parts ) {
	if ( ! okool_is_ar() ) {
		return $parts;
	}

	if ( isset( $parts['title'] ) && ! is_singular( 'okool_news' ) ) {
		$parts['title'] = __( $parts['title'], 'okool' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- page titles are in the dictionary.
	}

	if ( isset( $parts['site'] ) ) {
		$parts['site'] = __( $parts['site'], 'okool' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- site name is in the dictionary.
	}

	if ( isset( $parts['tagline'] ) ) {
		$parts['tagline'] = __( $parts['tagline'], 'okool' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- tagline is in the dictionary.
	}

	return $parts;
}
add_filter( 'document_title_parts', 'okool_document_title' );
