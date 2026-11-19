<?php
/**
 * Okool Contact design (Figma 2:1753) with the business enquiry form.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img    = static function ( $file ) {
	return esc_url( okool_asset( $file ) );
};
$notice = okool_enquiry_notice();
$fields = okool_enquiry_fields();

$input = static function ( $name, $type = 'text', $autocomplete = '' ) use ( $fields ) {
	$field = $fields[ $name ];
	printf(
		'<label class="contact-field"><span>%1$s</span><input type="%2$s" name="%3$s" maxlength="%4$d"%5$s%6$s></label>',
		esc_html( $field[0] ),
		esc_attr( $type ),
		esc_attr( $name ),
		(int) $field[2],
		$autocomplete ? ' autocomplete="' . esc_attr( $autocomplete ) . '"' : '',
		$field[1] ? ' required' : ''
	);
};

require OKOOL_DIR . 'templates/partials/header.php';
?>
<main id="okool-content" class="contact-main">
	<?php /* Figma 2:1757 — page intro */ ?>
	<section class="contact-hero">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap">
			<h1>Contact OKOOL</h1>
			<p>Tell us about your workforce, facility or security requirements. Our team will discuss your needs and the appropriate service scope.</p>
		</div>
	</section>

	<?php /* Figma 2:1762 — contours run across the intro into the form section */ ?>
	<img class="contact-contours" src="<?php echo $img( 'contact-contours.svg' ); ?>" alt="" aria-hidden="true" width="1058.78" height="354.764">

	<?php /* Figma 2:1778 — enquiry form + offices */ ?>
	<section class="contact-body">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap contact-body__grid">
			<form class="about-glass contact-form" id="enquiry" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<h2>Send a business enquiry</h2>

				<?php if ( $notice ) : ?>
					<p class="contact-notice contact-notice--<?php echo esc_attr( $notice['type'] ); ?>" role="<?php echo 'success' === $notice['type'] ? 'status' : 'alert'; ?>">
						<?php echo esc_html( $notice['text'] ); ?>
					</p>
				<?php endif; ?>

				<input type="hidden" name="action" value="<?php echo esc_attr( OKOOL_ENQUIRY_ACTION ); ?>">
				<?php wp_nonce_field( OKOOL_ENQUIRY_ACTION, '_okool_nonce', false ); ?>
				<label class="contact-hp" aria-hidden="true">Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>

				<div class="contact-form__grid">
					<?php
					$input( 'name', 'text', 'name' );
					$input( 'company', 'text', 'organization' );
					$input( 'email', 'email', 'email' );
					$input( 'phone', 'tel', 'tel' );
					$input( 'location', 'text', 'address-level2' );
					?>
					<label class="contact-field">
						<span><?php echo esc_html( $fields['service'][0] ); ?></span>
						<select name="service" required style="--chevron: url('<?php echo $img( 'select-chevron.svg' ); ?>')">
							<option value=""><?php esc_html_e( 'Select a service', 'okool' ); ?></option>
							<?php foreach ( okool_enquiry_services() as $value => $label ) : ?>
								<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="contact-field contact-field--wide">
						<span><?php echo esc_html( $fields['details'][0] ); ?></span>
						<textarea name="details" rows="6" maxlength="<?php echo (int) $fields['details'][2]; ?>" required></textarea>
					</label>
				</div>

				<button type="submit" class="btn svc-btn svc-btn--wine contact-submit">Submit Enquiry</button>
			</form>

			<aside class="contact-offices" aria-labelledby="contact-offices-title">
				<h2 id="contact-offices-title">UAE offices</h2>
				<div class="about-glass about-glass--wine contact-office">
					<h3>Abu Dhabi office</h3>
					<p>Abu Dhabi Mall Offices, Abu Dhabi</p>
					<p><a href="tel:+97125557971">02-5557971</a></p>
				</div>
				<div class="about-glass about-glass--wine contact-office">
					<h3>Dubai office</h3>
					<p>Garhoud Offices, Dubai</p>
					<p><a href="tel:+97148745445">04-874 5445</a></p>
				</div>
				<div class="about-glass about-glass--wine contact-office">
					<h3>General contact</h3>
					<p><a href="mailto:info@okool.com">info@okool.com</a></p>
					<p><bdi>www.okool.com</bdi></p>
					<p>PO Boxes: 123536 | 28862</p>
				</div>
			</aside>
		</div>
	</section>
</main>

<?php
require OKOOL_DIR . 'templates/partials/footer.php';
