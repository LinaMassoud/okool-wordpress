<?php
/**
 * "Request a Service" and phone buttons.
 *
 * On the home page they start in the hero bar and float once scrolled
 * (assets/js/float-actions.js). On every other page they are pinned from the start.
 *
 * @var bool   $okool_pinned Pinned to the bottom of the window from the start.
 * @var string $okool_href   Where "Request a Service" links to (the Contact page).
 *
 * The phone button always calls the Dubai office.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="hero__bar-actions<?php echo $okool_pinned ? ' is-floating' : ''; ?>"<?php echo $okool_pinned ? ' data-pinned' : ''; ?>>
	<a class="btn btn-hero-request" href="<?php echo esc_url( $okool_href ); ?>">
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
			<path d="M5 6.5A2.5 2.5 0 0 1 7.5 4h9A2.5 2.5 0 0 1 19 6.5v6A2.5 2.5 0 0 1 16.5 15H12l-3.5 3v-3H7.5A2.5 2.5 0 0 1 5 12.5v-6z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
			<path d="M8.25 8.25h7.5M8.25 11h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
		</svg>
		<?php esc_html_e( 'Request a Service', 'okool' ); ?>
	</a>
	<a class="btn btn-icon btn-icon-phone" href="tel:+97148745445" aria-label="<?php esc_attr_e( 'Call OKOOL on +971 4 874 5445', 'okool' ); ?>">
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
			<path d="M7 3.8h2.2l1.2 3-1.5 1a12.5 12.5 0 0 0 6.3 6.3l1-1.5 3 1.2V18a2 2 0 0 1-2.2 2A16.2 16.2 0 0 1 4 6a2 2 0 0 1 2-2.2H7z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
		</svg>
	</a>
</div>
