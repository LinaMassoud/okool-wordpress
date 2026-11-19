<?php

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'okool-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,520;9..144,620&family=Manrope:wght@400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'okool',
        get_stylesheet_uri(),
        ['okool-fonts'],
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
