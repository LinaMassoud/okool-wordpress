<?php
/**
 * Job details for one vacancy (Figma 697:1149).
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$listing = get_post_type_archive_link( OKOOL_VACANCY_TYPE );
$back    = okool_asset( 'icons/svc-arrow-19.svg' );

get_header();

while ( have_posts() ) :
	the_post();
	$meta = okool_vacancy_meta( get_the_ID() );

	$okool_hero = [
		'modifier'   => 'detail',
		'back_url'   => $listing,
		'back_label' => __( 'Back to Careers', 'okool' ),
		'sample'     => $meta['sample'],
		'meta'       => array_values( array_filter( [ $meta['location_label'], $meta['department_label'], $meta['type_label'] ] ) ),
		'title'      => get_the_title(),
	];
	?>
<main id="okool-content" class="vac-main">
	<?php require OKOOL_DIR . 'templates/parts/vacancy-hero.php'; ?>

	<?php /* Figma 697:1200 — description card + application sidebar */ ?>
	<section class="vac-body">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap vac-layout">
			<article class="about-glass vac-detail">
				<?php if ( has_excerpt() ) : ?>
					<h2><?php esc_html_e( 'Overview', 'okool' ); ?></h2>
					<p class="vac-detail__overview"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<div class="vac-detail__content">
					<?php the_content(); ?>
				</div>
			</article>

			<aside class="about-glass vac-side">
				<?php if ( $meta['sample'] ) : ?>
					<span class="vac-card__badge"><?php esc_html_e( 'Sample vacancy', 'okool' ); ?></span>
					<h2><?php esc_html_e( 'Application demo', 'okool' ); ?></h2>
					<p><?php esc_html_e( 'These sample vacancies are for design review and are not currently open for applications.', 'okool' ); ?></p>
					<a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url( okool_link( okool_vacancy_apply_url( get_the_ID() ) ) ); ?>"><?php esc_html_e( 'View application demo', 'okool' ); ?></a>
				<?php else : ?>
					<h2><?php esc_html_e( 'Apply for this role', 'okool' ); ?></h2>
					<p><?php esc_html_e( 'Send us your details and CV. Our recruitment team will be in touch if your profile matches the role.', 'okool' ); ?></p>
					<a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url( okool_link( okool_vacancy_apply_url( get_the_ID() ) ) ); ?>"><?php esc_html_e( 'Apply now', 'okool' ); ?></a>
				<?php endif; ?>
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

get_footer();
