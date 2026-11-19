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
	[ 'Integrity', 'Operate transparently and responsibly.' ],
	[ 'Accountability', 'Take ownership of service delivery.' ],
	[ 'Operational Excellence', 'Improve quality and performance.' ],
	[ 'Compliance', 'Meet regulatory and safety requirements.' ],
	[ 'Partnership', 'Build relationships based on trust.' ],
];

$steps = [ 'Understand', 'Plan', 'Mobilise', 'Deploy', 'Supervise', 'Measure', 'Improve' ];

$faqs = [
	[ 'Who is OKOOL?', 'OKOOL is a UAE-based company delivering Workforce Solutions, Facilities Management and Security Services through one accountable operational platform.' ],
	[ 'How does OKOOL manage service delivery?', 'OKOOL’s delivery model follows seven stages: understand, plan, mobilise, deploy, supervise, measure and improve.' ],
	[ 'What principles guide OKOOL’s operations?', 'Integrity, accountability, operational excellence, compliance and partnership guide OKOOL’s approach to clients, employees and service delivery.' ],
];

require OKOOL_DIR . 'templates/partials/header.php';
?>
<main id="okool-content">
	<?php /* Figma 2:500 — brand hero: photo frame with overlapping wine glass card */ ?>
	<section class="about-hero">
		<span class="about-surface" aria-hidden="true"></span>
		<img class="about-hero__contours" src="<?php echo $img( 'about-contours.svg' ); ?>" alt="" aria-hidden="true" width="2458.7" height="823.836">
		<div class="wrap about-hero__stage">
			<figure class="about-hero__photo">
				<img src="<?php echo $img( 'about-hero.jpg' ); ?>" alt="Professional team in a workplace meeting">
			</figure>
			<div class="about-glass about-glass--wine about-hero__card">
				<p class="about-eyebrow about-eyebrow--light">OKOOL — <span lang="ar" dir="rtl">عقول</span></p>
				<h1>An Integrated Services Partner for UAE Organizations</h1>
				<p>OKOOL supports UAE organizations with people, facility operations and security personnel. Its integrated model combines local market experience with workforce administration, site support, supervision and service performance review.</p>
			</div>
		</div>
	</section>

	<?php /* Figma 2:526 + 2:545 — who we are + stats */ ?>
	<section class="about-intro">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-intro__grid">
			<div class="about-glass about-intro__card">
				<p class="about-eyebrow">Who we are</p>
				<h2>One platform. Accountable support.</h2>
				<p>OKOOL delivers Workforce Solutions, Facilities Management and Security Services through one accountable operational platform. We support government, semi-government and private-sector organizations with scalable people solutions, reliable facility operations and professional security services.</p>
				<p>With more than 13 years of UAE market experience, a workforce of over 3,000 professionals and more than 10,000 placements, our approach combines local knowledge with structured operational support. We help clients focus on their core business while coordinating the people and services that support their operations.</p>
			</div>
			<figure class="about-photo about-intro__photo">
				<img src="<?php echo $img( 'about-intro.jpg' ); ?>" alt="The OKOOL leadership team">
			</figure>
		</div>
		<div class="wrap about-stats-wrap">
			<ul class="about-glass about-stats">
				<li><strong>13+</strong><span>years of UAE market experience</span></li>
				<li><strong>3,000+</strong><span>professionals</span></li>
				<li><strong>10,000+</strong><span>placements</span></li>
			</ul>
		</div>
	</section>

	<?php /* Figma 2:567 — vision & mission */ ?>
	<section class="about-band about-purpose">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-purpose__grid">
			<article class="about-glass about-purpose__card">
				<p class="about-purpose__index">01</p>
				<h2>Our vision</h2>
				<p>To be a trusted integrated services partner in the UAE, recognized for reliable people solutions, efficient operations and consistently high standards of service.</p>
			</article>
			<article class="about-glass about-glass--wine about-purpose__card">
				<p class="about-purpose__index">02</p>
				<h2>Our mission</h2>
				<p>To support organizations through dependable Workforce Solutions, Facilities Management and Security Services delivered with professionalism, accountability and a strong commitment to compliance.</p>
			</article>
		</div>
	</section>

	<?php /* Figma 2:587 — values */ ?>
	<section class="about-values">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-values__grid">
			<div class="about-values__head">
				<p class="about-eyebrow">Our values</p>
				<h2>How we work</h2>
				<p>Our values guide how we work with clients, employees and partners.</p>
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
				<img src="<?php echo $img( 'about-hse.jpg' ); ?>" alt="Technician carrying out a safety inspection">
			</figure>
			<div class="about-glass about-hse__card">
				<p class="about-eyebrow">Responsible delivery</p>
				<h2>Governance, compliance and HSE</h2>
				<p>Responsible service delivery is supported by workforce documentation, ethical recruitment practices, quality assurance, corporate governance and health, safety and environmental practices. Our operating approach supports UAE labour-law compliance, employee records management, data privacy and confidentiality.</p>
			</div>
		</div>
	</section>

	<?php /* Figma 2:658 — delivery model (shares the home page process panel) */ ?>
	<section class="process about-process">
		<div class="wrap">
			<div class="process__panel">
				<img class="process__surface" src="<?php echo $img( 'brand-surface-light.svg' ); ?>" alt="" aria-hidden="true">
				<div class="process__head">
					<h2>One platform. Structured delivery.</h2>
					<p>We understand your requirements, develop a service plan, mobilise personnel and resources, deploy services, provide supervision, measure performance and improve delivery through reporting and feedback.</p>
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
					<h2>Let’s discuss your requirements</h2>
					<p>Tell us what your organization needs. Our team will discuss the right workforce, facilities or security support.</p>
				</div>
				<a class="btn btn-light" href="mailto:info@okool.com">Speak to Our Team</a>
			</div>
		</div>
	</section>

	<?php /* Figma 2:722 — FAQ */ ?>
	<section class="about-faq">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap about-faq__grid">
			<h2>Frequently asked questions</h2>
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
require OKOOL_DIR . 'templates/partials/footer.php';
