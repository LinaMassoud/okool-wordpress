<?php
/**
 * Plugin Name: Okool News Cleanup
 * Description: One-time tool. On activation it permanently deletes every Okool News article, its Arabic text and the images uploaded with it. Deactivate and delete this plugin when it reports that it is finished.
 * Version: 1.0.0
 * Requires at least: 5.9
 * Requires PHP: 7.4
 *
 * @package OkoolNewsCleanup
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OKOOL_NEWS_CLEANUP_TYPE   = 'okool_news';
const OKOOL_NEWS_CLEANUP_STATUS = 'okool_news_cleanup';
const OKOOL_NEWS_CLEANUP_BATCH  = 100;

/**
 * IDs of news articles still in the database, in any status.
 *
 * @param int $limit Maximum number of IDs.
 * @return int[]
 */
function okool_news_cleanup_ids( $limit ) {
	global $wpdb;

	return array_map(
		'intval',
		$wpdb->get_col( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s ORDER BY ID LIMIT %d", OKOOL_NEWS_CLEANUP_TYPE, $limit )
		)
	);
}

/**
 * Number of news articles still in the database.
 *
 * @return int
 */
function okool_news_cleanup_remaining() {
	global $wpdb;

	return (int) $wpdb->get_var( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = %s", OKOOL_NEWS_CLEANUP_TYPE )
	);
}

/**
 * Delete one batch of articles, their meta and the images uploaded to them.
 * Batches keep large clean-ups within the server's time limit.
 */
function okool_news_cleanup_batch() {
	$status = get_option( OKOOL_NEWS_CLEANUP_STATUS );

	if ( ! is_array( $status ) || ! empty( $status['done'] ) ) {
		return;
	}

	foreach ( okool_news_cleanup_ids( OKOOL_NEWS_CLEANUP_BATCH ) as $post_id ) {
		// Images uploaded to the article (featured images). Shared media elsewhere is left alone.
		$images = get_posts(
			[
				'post_type'      => 'attachment',
				'post_status'    => 'any',
				'post_parent'    => $post_id,
				'posts_per_page' => -1,
				'fields'         => 'ids',
			]
		);

		foreach ( $images as $image_id ) {
			if ( wp_delete_attachment( $image_id, true ) ) {
				++$status['images'];
			}
		}

		// Deletes the post together with all of its meta (Arabic title, summary and text included).
		if ( wp_delete_post( $post_id, true ) ) {
			++$status['articles'];
		}
	}

	if ( 0 === okool_news_cleanup_remaining() ) {
		$status['done'] = true;

		// Keep the "samples already created" flags set so older Okool Pages versions never re-create sample articles.
		update_option( 'okool_news_seeded', 1, false );
		update_option( 'okool_news_ar_seeded', 1, false );
		update_option( 'okool_news_deduped', 1, false );
		delete_option( 'okool_news_rewrite' );
		flush_rewrite_rules( false );
	}

	update_option( OKOOL_NEWS_CLEANUP_STATUS, $status, false );
}

/**
 * Start the clean-up when the plugin is activated.
 */
function okool_news_cleanup_activate() {
	update_option(
		OKOOL_NEWS_CLEANUP_STATUS,
		[
			'articles' => 0,
			'images'   => 0,
			'done'     => false,
		],
		false
	);

	okool_news_cleanup_batch();
}
register_activation_hook( __FILE__, 'okool_news_cleanup_activate' );

/**
 * Continue an unfinished clean-up on each admin page load.
 */
function okool_news_cleanup_continue() {
	if ( current_user_can( 'activate_plugins' ) ) {
		okool_news_cleanup_batch();
	}
}
add_action( 'admin_init', 'okool_news_cleanup_continue' );

/**
 * Progress / finished notice.
 */
function okool_news_cleanup_notice() {
	$status = get_option( OKOOL_NEWS_CLEANUP_STATUS );

	if ( ! is_array( $status ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	if ( empty( $status['done'] ) ) {
		printf(
			'<div class="notice notice-warning"><p><strong>Okool News Cleanup:</strong> %1$d articles deleted so far, %2$d left. <a href="%3$s">Reload this page</a> to continue.</p></div>',
			(int) $status['articles'],
			(int) okool_news_cleanup_remaining(),
			esc_url( admin_url( 'plugins.php' ) )
		);
		return;
	}

	printf(
		'<div class="notice notice-success"><p><strong>Okool News Cleanup finished:</strong> %1$d news articles and %2$d images were permanently deleted. You can now deactivate and delete this plugin.</p></div>',
		(int) $status['articles'],
		(int) $status['images']
	);
}
add_action( 'admin_notices', 'okool_news_cleanup_notice' );

/**
 * Remove the plugin's own status record when it is deactivated.
 */
function okool_news_cleanup_deactivate() {
	delete_option( OKOOL_NEWS_CLEANUP_STATUS );
}
register_deactivation_hook( __FILE__, 'okool_news_cleanup_deactivate' );
