<?php
/**
 * Okool Careers page design (Figma 2:1511).
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img = static function ( $file ) {
	return esc_url( okool_asset( $file ) );
};

/*
 * Where the two call-to-action buttons go. Point them at a jobs board or an application
 * form later, here or through the `okool_careers_links` filter.
 */
$links = apply_filters(
	'okool_careers_links',
	[
		'vacancies' => okool_link( get_post_type_archive_link( OKOOL_VACANCY_TYPE ) ),
		'cv'        => 'mailto:info@okool.com?subject=' . rawurlencode( 'CV submission' ),
	]
);

$faqs = [
	[ __( 'What does an integrated services company provide?', 'okool' ), __( 'An integrated services company coordinates more than one operational service through a single relationship. OKOOL’s three pillars are Workforce Solutions, Facilities Management and Security Services.', 'okool' ) ],
	[ __( 'Which services can businesses request from OKOOL?', 'okool' ), __( 'Businesses can discuss recruitment, workforce outsourcing, Emiratisation, hard and soft facilities management, and security support. The final service scope is agreed according to operational requirements and approved capabilities.', 'okool' ) ],
	[ __( 'Where are OKOOL’s UAE offices?', 'okool' ), __( 'The company profile lists offices in Abu Dhabi Mall Offices, Abu Dhabi, and Garhoud Offices, Dubai. Contact OKOOL to confirm office directions and discuss your requirements.', 'okool' ) ],
];

get_header();
?>
<main id="okool-content">
	<?php /* Figma 2:1515 — hero: glass intro card beside the photo */ ?>
	<section class="split-hero">
		<span class="about-surface" aria-hidden="true"></span>
		<img class="about-hero__contours split-hero__contours" src="<?php echo $img( 'about-contours.svg' ); ?>" alt="" aria-hidden="true" width="2458.7" height="823.836">
		<div class="wrap split-hero__grid">
			<div class="about-glass split-hero__card">
				<nav class="split-hero__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'okool' ); ?>">
					<a href="<?php echo esc_url( okool_link( home_url( '/' ) ) ); ?>"><?php esc_html_e( 'Home', 'okool' ); ?></a>
					<span aria-hidden="true">/</span>
					<span aria-current="page"><?php esc_html_e( 'Careers', 'okool' ); ?></span>
				</nav>
				<h1><?php esc_html_e( 'Build Your Career with OKOOL', 'okool' ); ?></h1>
				<p><?php esc_html_e( 'Explore professional, technical, skilled and support roles, or share your CV for future requirements.', 'okool' ); ?></p>
			</div>
			<figure class="split-hero__photo">
				<img src="<?php echo $img( 'careers-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Professional working in a modern operational office', 'okool' ); ?>" width="1400" height="1400" fetchpriority="high">
				<figcaption class="split-hero__chip"><?php esc_html_e( 'Integrated support', 'okool' ); ?></figcaption>
			</figure>
		</div>
	</section>

	<?php /* Figma 2:1544 — explore opportunities / share your CV */ ?>
	<section class="careers-paths">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap careers-paths__grid">
			<article class="about-glass careers-path">
				<p class="careers-path__index">01</p>
				<h2><?php esc_html_e( 'Explore opportunities', 'okool' ); ?></h2>
				<?php if ( wp_count_posts( OKOOL_VACANCY_TYPE )->publish ) : ?>
					<p><?php esc_html_e( 'Browse current roles across our workforce, facilities and security teams.', 'okool' ); ?></p>
				<?php else : ?>
					<p><?php esc_html_e( 'No vacancies are currently published.', 'okool' ); ?></p>
				<?php endif; ?>
				<a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url( $links['vacancies'] ); ?>"><?php esc_html_e( 'View vacancies', 'okool' ); ?></a>
			</article>
			<article class="about-glass careers-path">
				<p class="careers-path__index">02</p>
				<h2><?php esc_html_e( 'Share your CV', 'okool' ); ?></h2>
				<p><?php esc_html_e( 'Submission does not guarantee a vacancy, interview or placement.', 'okool' ); ?></p>
				<a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url( $links['cv'] ); ?>"><?php esc_html_e( 'Submit your CV', 'okool' ); ?></a>
			</article>
		</div>
	</section>

	<?php /* Figma 2:1571 — CTA (shares the home page CTA) */ ?>
	<section class="cta careers-cta" id="contact">
		<div class="cta__glow" aria-hidden="true"></div>
		<div class="wrap cta__inner">
			<div class="cta__panel">
				<div class="cta__copy">
					<h2><?php esc_html_e( 'Let’s discuss your requirements', 'okool' ); ?></h2>
					<p><?php esc_html_e( 'Tell us what your organization needs. Our team will discuss the right workforce, facilities or security support.', 'okool' ); ?></p>
				</div>
				<a class="btn svc-btn svc-btn--light" href="<?php echo esc_url( okool_link( okool_page_url( 'contact', 'mailto:info@okool.com' ) ) . ( okool_page_url( 'contact' ) ? '#enquiry' : '' ) ); ?>"><?php esc_html_e( 'Request a Service', 'okool' ); ?></a>
			</div>
		</div>
	</section>

	<?php /* Figma 2:1588 — FAQ (same component as the About page) */ ?>
	<section class="about-faq">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-faq__grid">
			<h2><?php esc_html_e( 'Frequently asked questions', 'okool' ); ?></h2>
			<div class="about-glass about-faq__list">
				<?php foreach ( $faqs as $faq ) : ?>
					<details>
						<summary><?php echo esc_html( $faq[0] ); ?></summary>
						<p><?php echo esc_html( $faq[1] ); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
