<?php
/**
 * Service detail page — content in includes/service-pages.php.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$okool_service = okool_service_pages()['service-soft-fm'];
require OKOOL_DIR . 'templates/parts/service-detail.php';
