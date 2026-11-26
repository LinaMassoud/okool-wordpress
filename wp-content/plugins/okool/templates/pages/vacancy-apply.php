<?php
/**
 * Application page for one vacancy (Figma 697:1658).
 *
 * Sample vacancies show the read-only demonstration from the design; real roles get a
 * working form that saves to Vacancies → Applications and emails the CV to the site admin.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$listing = get_post_type_archive_link( OKOOL_VACANCY_TYPE );
$back    = okool_asset( 'icons/svc-arrow-19.svg' );
$notice  = okool_application_notice();

get_header();

while ( have_posts() ) :
	the_post();
	$meta    = okool_vacancy_meta( get_the_ID() );
	$sample  = $meta['sample'];
	$parts   = array_values( array_filter( [ $meta['location_label'], $meta['department_label'], $meta['type_label'] ] ) );
	$off     = $sample ? ' disabled' : '';

	$okool_hero = [
		'modifier'   => 'apply',
		'back_url'   => get_permalink(),
		'back_label' => __( 'Back to job details', 'okool' ),
		'sample'     => $sample,
		'meta'       => [],
		'title'      => $sample ? __( 'Application demo', 'okool' ) : __( 'Apply for this role', 'okool' ),
		/* translators: %s: role title. */
		'intro'      => $sample ? __( 'These sample vacancies are for design review and are not currently open for applications.', 'okool' ) : sprintf( __( 'Complete the form and attach your CV to apply for the %s role.', 'okool' ), get_the_title() ),
	];
	?>
<main id="okool-content" class="vac-main">
	<?php require OKOOL_DIR . 'templates/parts/vacancy-hero.php'; ?>

	<?php /* Figma 697:1705 — form + role sidebar */ ?>
	<section class="vac-body">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap vac-layout">
			<form class="about-glass vac-form" id="application" method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"<?php echo $sample ? ' aria-describedby="vac-form-note"' : ''; ?>>
				<div class="vac-form__head">
					<?php if ( $sample ) : ?>
						<h2><?php esc_html_e( 'Read-only demonstration', 'okool' ); ?></h2>
						<p id="vac-form-note"><?php esc_html_e( 'This existing form is shown for design review only. It cannot accept an application or a CV.', 'okool' ); ?></p>
					<?php else : ?>
						<h2><?php esc_html_e( 'Your application', 'okool' ); ?></h2>
						<p><?php esc_html_e( 'Fields marked * are required. Your details are used only to assess your application.', 'okool' ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( $notice ) : ?>
					<p class="contact-notice contact-notice--<?php echo esc_attr( $notice['type'] ); ?> vac-form__wide" role="<?php echo 'success' === $notice['type'] ? 'status' : 'alert'; ?>"><?php echo esc_html( $notice['text'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! $sample ) : ?>
					<input type="hidden" name="action" value="<?php echo esc_attr( OKOOL_APPLICATION_ACTION ); ?>">
					<input type="hidden" name="vacancy" value="<?php echo (int) get_the_ID(); ?>">
					<?php wp_nonce_field( OKOOL_APPLICATION_ACTION, '_okool_apply_nonce', false ); ?>
					<label class="contact-hp" aria-hidden="true">Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
				<?php endif; ?>

				<label class="vac-input vac-form__wide">
					<span><?php esc_html_e( 'Role', 'okool' ); ?></span>
					<input type="text" value="<?php echo esc_attr( get_the_title() ); ?>" readonly>
				</label>
				<label class="vac-input vac-form__wide">
					<span><?php esc_html_e( 'Full name', 'okool' ); ?><?php echo $sample ? '' : ' *'; ?></span>
					<input type="text" name="full_name" maxlength="120" autocomplete="name"<?php echo $sample ? $off : ' required'; ?>>
				</label>
				<label class="vac-input">
					<span><?php esc_html_e( 'Email', 'okool' ); ?><?php echo $sample ? '' : ' *'; ?></span>
					<input type="email" name="email" maxlength="160" autocomplete="email"<?php echo $sample ? $off : ' required'; ?>>
				</label>
				<label class="vac-input">
					<span><?php esc_html_e( 'Phone', 'okool' ); ?></span>
					<input type="tel" name="phone" maxlength="40" autocomplete="tel"<?php echo $off; ?>>
				</label>

				<?php if ( $sample ) : ?>
					<div class="vac-upload vac-form__wide">
						<img src="<?php echo esc_url( okool_asset( 'icons/svc-document.svg' ) ); ?>" alt="" width="23.9941" height="23.9941">
						<span><?php esc_html_e( 'CV uploads are disabled for sample vacancies.', 'okool' ); ?></span>
					</div>
				<?php else : ?>
					<label class="vac-upload vac-form__wide">
						<img src="<?php echo esc_url( okool_asset( 'icons/svc-document.svg' ) ); ?>" alt="" width="23.9941" height="23.9941">
						<span>
							<strong><?php esc_html_e( 'Attach your CV *', 'okool' ); ?></strong>
							<small data-cv-name><?php esc_html_e( 'PDF or Word, up to 5 MB', 'okool' ); ?></small>
						</span>
						<input type="file" name="cv" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required data-cv-input>
					</label>
				<?php endif; ?>

				<label class="vac-input vac-form__wide">
					<span><?php esc_html_e( 'Message', 'okool' ); ?></span>
					<textarea name="message" rows="5" maxlength="5000"<?php echo $off; ?>></textarea>
				</label>

				<?php if ( $sample ) : ?>
					<button type="button" class="btn svc-btn svc-btn--wine vac-form__submit" disabled><?php esc_html_e( 'Applications are not open', 'okool' ); ?></button>
				<?php else : ?>
					<button type="submit" class="btn svc-btn svc-btn--wine vac-form__submit"><?php esc_html_e( 'Submit application', 'okool' ); ?></button>
				<?php endif; ?>
			</form>

			<aside class="about-glass vac-side">
				<?php if ( $sample ) : ?>
					<span class="vac-card__badge"><?php esc_html_e( 'Sample vacancy', 'okool' ); ?></span>
				<?php endif; ?>
				<h2><?php the_title(); ?></h2>
				<?php if ( $parts ) : ?>
					<span class="vac-meta">
						<?php foreach ( $parts as $part ) : ?>
							<span><?php echo esc_html( $part ); ?></span>
						<?php endforeach; ?>
					</span>
				<?php endif; ?>
				<p>
					<?php
					if ( $sample ) {
						esc_html_e( 'No application submission or CV upload is available for this sample role.', 'okool' );
					} else {
						esc_html_e( 'Our recruitment team reviews every application and will contact shortlisted candidates.', 'okool' );
					}
					?>
				</p>
				<a class="vac-back" href="<?php echo esc_url( okool_link( $listing ) ); ?>">
					<img src="<?php echo esc_url( $back ); ?>" alt="" width="18.9941" height="18.9941">
					<?php esc_html_e( 'Back to Careers', 'okool' ); ?>
				</a>
			</aside>
		</div>
	</section>
</main>
	<?php
endwhile;
?>
<script>
(function () {
	var input = document.querySelector('[data-cv-input]');
	var label = document.querySelector('[data-cv-name]');
	if (!input || !label) return;
	input.addEventListener('change', function () {
		if (input.files && input.files[0]) label.textContent = input.files[0].name;
	});
})();
</script>
<?php
get_footer();
