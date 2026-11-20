<?php
/**
 * Okool About page design (Figma 2:496).
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img = static function ( $file ) {
	return esc_url( okool_asset( $file ) );
};

$values = [
	[ __( 'Integrity', 'okool' ), __( 'Operate transparently and responsibly.', 'okool' ) ],
	[ __( 'Accountability', 'okool' ), __( 'Take ownership of service delivery.', 'okool' ) ],
	[ __( 'Operational Excellence', 'okool' ), __( 'Improve quality and performance.', 'okool' ) ],
	[ __( 'Compliance', 'okool' ), __( 'Meet regulatory and safety requirements.', 'okool' ) ],
	[ __( 'Partnership', 'okool' ), __( 'Build relationships based on trust.', 'okool' ) ],
];

$steps = [ __( 'Understand', 'okool' ), __( 'Plan', 'okool' ), __( 'Mobilise', 'okool' ), __( 'Deploy', 'okool' ), __( 'Supervise', 'okool' ), __( 'Measure', 'okool' ), __( 'Improve', 'okool' ) ];

$faqs = [
	[ __( 'Who is OKOOL?', 'okool' ), __( 'OKOOL is a UAE-based company delivering Workforce Solutions, Facilities Management and Security Services through one accountable operational platform.', 'okool' ) ],
	[ __( 'How does OKOOL manage service delivery?', 'okool' ), __( 'OKOOL’s delivery model follows seven stages: understand, plan, mobilise, deploy, supervise, measure and improve.', 'okool' ) ],
	[ __( 'What principles guide OKOOL’s operations?', 'okool' ), __( 'Integrity, accountability, operational excellence, compliance and partnership guide OKOOL’s approach to clients, employees and service delivery.', 'okool' ) ],
];

get_header();
?>
<main id="okool-content">
	<?php /* Figma 2:500 — brand hero: photo frame with overlapping wine glass card */ ?>
	<section class="about-hero">
		<span class="about-surface" aria-hidden="true"></span>
		<img class="about-hero__contours" src="<?php echo $img( 'about-contours.svg' ); ?>" alt="" aria-hidden="true" width="2458.7" height="823.836">
		<div class="wrap about-hero__stage">
			<figure class="about-hero__photo">
				<img src="<?php echo $img( 'about-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Professional team in a workplace meeting', 'okool' ); ?>">
			</figure>
			<div class="about-glass about-glass--wine about-hero__card">
				<p class="about-eyebrow about-eyebrow--light"><?php esc_html_e( 'OKOOL', 'okool' ); ?><?php if ( ! okool_is_ar() ) : ?> — <span lang="ar" dir="rtl">عقول</span><?php endif; ?></p>
				<h1><?php esc_html_e( 'An Integrated Services Partner for UAE Organizations', 'okool' ); ?></h1>
				<p><?php esc_html_e( 'OKOOL supports UAE organizations with people, facility operations and security personnel. Its integrated model combines local market experience with workforce administration, site support, supervision and service performance review.', 'okool' ); ?></p>
			</div>
		</div>
	</section>

	<?php /* Figma 2:526 + 2:545 — who we are + stats */ ?>
	<section class="about-intro">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-intro__grid">
			<div class="about-glass about-intro__card">
				<p class="about-eyebrow"><?php esc_html_e( 'Who we are', 'okool' ); ?></p>
				<h2><?php esc_html_e( 'One platform. Accountable support.', 'okool' ); ?></h2>
				<p><?php esc_html_e( 'OKOOL delivers Workforce Solutions, Facilities Management and Security Services through one accountable operational platform. We support government, semi-government and private-sector organizations with scalable people solutions, reliable facility operations and professional security services.', 'okool' ); ?></p>
				<p><?php esc_html_e( 'With more than 13 years of UAE market experience, a workforce of over 3,000 professionals and more than 10,000 placements, our approach combines local knowledge with structured operational support. We help clients focus on their core business while coordinating the people and services that support their operations.', 'okool' ); ?></p>
			</div>
			<figure class="about-photo about-intro__photo">
				<img src="<?php echo $img( 'about-intro.jpg' ); ?>" alt="<?php esc_attr_e( 'The OKOOL leadership team', 'okool' ); ?>">
			</figure>
		</div>
		<div class="wrap about-stats-wrap">
			<ul class="about-glass about-stats">
				<li><strong data-count="13" data-suffix="+">13+</strong><span><?php esc_html_e( 'years of UAE market experience', 'okool' ); ?></span></li>
				<li><strong data-count="3000" data-suffix="+">3,000+</strong><span><?php esc_html_e( 'professionals', 'okool' ); ?></span></li>
				<li><strong data-count="10000" data-suffix="+">10,000+</strong><span><?php esc_html_e( 'placements', 'okool' ); ?></span></li>
			</ul>
		</div>
	</section>

	<?php /* Figma 2:567 — vision & mission */ ?>
	<section class="about-band about-purpose">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-purpose__grid">
			<article class="about-glass about-purpose__card">
				<p class="about-purpose__index">01</p>
				<h2><?php esc_html_e( 'Our vision', 'okool' ); ?></h2>
				<p><?php esc_html_e( 'To be a trusted integrated services partner in the UAE, recognized for reliable people solutions, efficient operations and consistently high standards of service.', 'okool' ); ?></p>
			</article>
			<article class="about-glass about-glass--wine about-purpose__card">
				<p class="about-purpose__index">02</p>
				<h2><?php esc_html_e( 'Our mission', 'okool' ); ?></h2>
				<p><?php esc_html_e( 'To support organizations through dependable Workforce Solutions, Facilities Management and Security Services delivered with professionalism, accountability and a strong commitment to compliance.', 'okool' ); ?></p>
			</article>
		</div>
	</section>

	<?php /* Figma 2:587 — values */ ?>
	<section class="about-values">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-values__grid">
			<div class="about-values__head">
				<p class="about-eyebrow"><?php esc_html_e( 'Our values', 'okool' ); ?></p>
				<h2><?php esc_html_e( 'How we work', 'okool' ); ?></h2>
				<p><?php esc_html_e( 'Our values guide how we work with clients, employees and partners.', 'okool' ); ?></p>
			</div>
			<ol class="about-glass about-values__list">
				<?php foreach ( $values as $i => $value ) : ?>
					<li>
						<span class="about-values__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<h3><?php echo esc_html( $value[0] ); ?></h3>
						<p><?php echo esc_html( $value[1] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<?php /* Figma 2:642 — governance, compliance and HSE */ ?>
	<section class="about-band about-hse">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-hse__grid">
			<figure class="about-photo about-hse__photo">
				<img src="<?php echo $img( 'about-hse.jpg' ); ?>" alt="<?php esc_attr_e( 'Technician carrying out a safety inspection', 'okool' ); ?>">
			</figure>
			<div class="about-glass about-hse__card">
				<p class="about-eyebrow"><?php esc_html_e( 'Responsible delivery', 'okool' ); ?></p>
				<h2><?php esc_html_e( 'Governance, compliance and HSE', 'okool' ); ?></h2>
				<p><?php esc_html_e( 'Responsible service delivery is supported by workforce documentation, ethical recruitment practices, quality assurance, corporate governance and health, safety and environmental practices. Our operating approach supports UAE labour-law compliance, employee records management, data privacy and confidentiality.', 'okool' ); ?></p>
			</div>
		</div>
	</section>

	<?php /* Figma 2:658 — delivery model (shares the home page process panel) */ ?>
	<section class="process about-process">
		<div class="wrap">
			<div class="process__panel">
				<img class="process__surface" src="<?php echo $img( 'brand-surface-light.svg' ); ?>" alt="" aria-hidden="true">
				<div class="process__head">
					<h2><?php esc_html_e( 'One platform. Structured delivery.', 'okool' ); ?></h2>
					<p><?php esc_html_e( 'We understand your requirements, develop a service plan, mobilise personnel and resources, deploy services, provide supervision, measure performance and improve delivery through reporting and feedback.', 'okool' ); ?></p>
				</div>
				<ol class="process__steps">
					<?php foreach ( $steps as $i => $step ) : ?>
						<li><span><?php echo (int) $i + 1; ?></span><?php echo esc_html( $step ); ?></li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
	</section>

	<?php /* Figma 2:706 — CTA (shares the home page CTA) */ ?>
	<section class="cta about-cta" id="contact">
		<div class="cta__glow" aria-hidden="true"></div>
		<div class="wrap cta__inner">
			<div class="cta__panel">
				<div class="cta__copy">
					<h2><?php esc_html_e( 'Let’s discuss your requirements', 'okool' ); ?></h2>
					<p><?php esc_html_e( 'Tell us what your organization needs. Our team will discuss the right workforce, facilities or security support.', 'okool' ); ?></p>
				</div>
				<a class="btn btn-light" href="mailto:info@okool.com"><?php esc_html_e( 'Speak to Our Team', 'okool' ); ?></a>
			</div>
		</div>
	</section>

	<?php /* Figma 2:722 — FAQ */ ?>
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
