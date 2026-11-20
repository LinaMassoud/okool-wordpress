<?php
/**
 * Light page header for a role and its application page (Figma 697:1153 / 697:1662).
 *
 * Expects $okool_hero: back_url, back_label, sample (bool), meta (labels to list, may be empty),
 * title, intro (optional), modifier (optional class suffix).
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="vac-hero vac-hero--<?php echo esc_attr( $okool_hero['modifier'] ); ?>">
	<span class="about-surface" aria-hidden="true"></span>
	<span class="vac-hero__contours" aria-hidden="true">
		<img src="<?php echo esc_url( okool_asset( 'careers-contours.svg' ) ); ?>" alt="" width="847.013" height="283.809">
	</span>
	<div class="wrap vac-hero__inner">
		<div class="vac-hero__top">
			<a class="vac-back" href="<?php echo esc_url( okool_link( $okool_hero['back_url'] ) ); ?>">
				<img src="<?php echo esc_url( okool_asset( 'icons/svc-arrow-19.svg' ) ); ?>" alt="" width="18.9941" height="18.9941">
				<?php echo esc_html( $okool_hero['back_label'] ); ?>
			</a>
			<p class="about-eyebrow"><?php esc_html_e( 'OKOOL', 'okool' ); ?><?php if ( ! okool_is_ar() ) : ?> — <span lang="ar" dir="rtl">عقول</span><?php endif; ?></p>
		</div>

		<?php if ( $okool_hero['sample'] || $okool_hero['meta'] ) : ?>
			<div class="vac-hero__meta">
				<?php if ( $okool_hero['sample'] ) : ?>
					<span class="vac-card__badge"><?php esc_html_e( 'Sample vacancy', 'okool' ); ?></span>
				<?php endif; ?>
				<?php if ( $okool_hero['meta'] ) : ?>
					<span class="vac-meta">
						<?php foreach ( $okool_hero['meta'] as $okool_part ) : ?>
							<span><?php echo esc_html( $okool_part ); ?></span>
						<?php endforeach; ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<h1><?php echo esc_html( $okool_hero['title'] ); ?></h1>

		<?php if ( ! empty( $okool_hero['intro'] ) ) : ?>
			<p class="vac-hero__intro"><?php echo esc_html( $okool_hero['intro'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
