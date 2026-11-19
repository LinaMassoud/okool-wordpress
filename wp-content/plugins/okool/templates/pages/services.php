<?php
/**
 * Okool Services overview design (Figma 2:892).
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img = static function ( $file ) {
	return esc_url( okool_asset( $file ) );
};

$pillars = [
	[
		'id'     => 'workforce',
		'title'  => 'Workforce Solutions',
		'text'   => 'Recruitment, contract staffing, workforce outsourcing, skilled workforce supply, professional outsourcing and project-based hiring. Our support also covers payroll administration, employee lifecycle management, visa and documentation coordination and workforce compliance.',
		'links'  => [ 'Talent Acquisition & Recruitment', 'Workforce Outsourcing', 'Emiratisation & National Talent' ],
		'image'  => 'svc-meeting.jpg',
		'alt'    => 'Workforce planning meeting in a modern office',
		'layout' => 'image-first',
	],
	[
		'id'     => 'facilities',
		'title'  => 'Facilities Management',
		'text'   => 'Technical services, preventive and corrective maintenance, soft services and on-site operational support designed around facility and asset requirements.',
		'links'  => [ 'Hard Facilities Management', 'Soft Facilities Management' ],
		'image'  => 'svc-site-team.jpg',
		'alt'    => 'Site team in safety gear reviewing a maintenance plan',
		'layout' => 'card-first',
	],
	[
		'id'     => 'security',
		'title'  => 'Security Services',
		'text'   => 'Manned guarding, access control, patrolling, incident reporting and related site support within approved licensing and operational scope.',
		'links'  => [],
		'image'  => 'svc-security.jpg',
		'alt'    => 'Security officer on duty in a shopping mall',
		'layout' => 'image-first',
	],
];

$faqs = [
	[ 'How do I choose the right OKOOL service?', 'Choose Workforce Solutions for hiring and workforce administration, Facilities Management for building maintenance and workplace support, or Security Services for guarding and related site security. Multiple requirements can be discussed together.' ],
	[ 'Can workforce and facility services be coordinated together?', 'Yes. OKOOL’s integrated model enables clients to coordinate workforce, facilities and security requirements through one operational relationship. The scope and responsibilities are agreed for the engagement.' ],
	[ 'What information is needed for a service enquiry?', 'Include your company name, operating location, required service and a description of the roles, site or operational support needed.' ],
];

require OKOOL_DIR . 'templates/partials/header.php';
?>
<main id="okool-content">
	<?php /* Figma 2:896 — hero: wine glass card + three-photo collage */ ?>
	<section class="about-hero svc-hero">
		<span class="about-surface" aria-hidden="true"></span>
		<img class="about-hero__contours svc-hero__contours" src="<?php echo $img( 'about-contours.svg' ); ?>" alt="" aria-hidden="true" width="2458.7" height="823.836">
		<div class="wrap svc-hero__grid">
			<div class="about-glass about-glass--wine svc-hero__card">
				<p class="about-eyebrow about-eyebrow--light">OKOOL — <span lang="ar" dir="rtl">عقول</span></p>
				<h1>Integrated Services for People, Facilities &amp; Operations</h1>
				<p>OKOOL’s service offering is organized into three pillars: workforce services for hiring and employee administration; facilities management for technical maintenance and workplace support; and security services for personnel and site protection.</p>
				<p>Coordinate your workforce, facilities and security requirements through one operational relationship. OKOOL combines three specialized service pillars with a structured approach to planning, mobilisation and ongoing support.</p>
			</div>
			<div class="svc-hero__collage" aria-hidden="true">
				<img class="svc-hero__frame svc-hero__frame--1" src="<?php echo $img( 'svc-site-team.jpg' ); ?>" alt="">
				<img class="svc-hero__frame svc-hero__frame--2" src="<?php echo $img( 'svc-meeting.jpg' ); ?>" alt="">
				<img class="svc-hero__frame svc-hero__frame--3" src="<?php echo $img( 'svc-security.jpg' ); ?>" alt="">
			</div>
		</div>
	</section>

	<?php /* Figma 2:937 / 2:961 / 2:978 — service pillars */ ?>
	<?php foreach ( $pillars as $i => $pillar ) : ?>
		<section class="svc-pillar svc-pillar--<?php echo esc_attr( $pillar['id'] ); ?>" id="<?php echo esc_attr( $pillar['id'] ); ?>">
			<div class="wrap svc-pillar__grid svc-pillar__grid--<?php echo esc_attr( $pillar['layout'] ); ?>">
				<figure class="about-photo svc-pillar__photo">
					<img src="<?php echo $img( $pillar['image'] ); ?>" alt="<?php echo esc_attr( $pillar['alt'] ); ?>">
				</figure>
				<div class="about-glass svc-pillar__card">
					<p class="svc-pillar__index"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></p>
					<h2><?php echo esc_html( $pillar['title'] ); ?></h2>
					<p class="svc-pillar__text"><?php echo esc_html( $pillar['text'] ); ?></p>
					<?php if ( $pillar['links'] ) : ?>
						<ul class="svc-pillar__links">
							<?php foreach ( $pillar['links'] as $link ) : ?>
								<li><a href="#contact"><?php echo esc_html( $link ); ?> <span aria-hidden="true">→</span></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<a class="btn svc-btn <?php echo 'security' === $pillar['id'] ? 'svc-btn--light' : 'svc-btn--wine'; ?>" href="#contact">Explore this service</a>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<?php /* Figma 2:990 — service plan panel */ ?>
	<section class="svc-plan">
		<div class="wrap">
			<div class="about-glass svc-plan__panel">
				<span class="about-surface" aria-hidden="true"></span>
				<img class="svc-plan__contours" src="<?php echo $img( 'svc-plan-contours.svg' ); ?>" alt="" aria-hidden="true" width="976.421" height="327.169">
				<h2>A service plan shaped around your requirements</h2>
				<p>Our process begins with your operating environment, required service scope and workforce needs. We then coordinate planning, mobilisation, deployment and supervision according to agreed requirements.</p>
			</div>
		</div>
	</section>

	<?php /* Figma 2:1007 — CTA (shares the home page CTA) */ ?>
	<section class="cta about-cta svc-cta" id="contact">
		<div class="cta__glow" aria-hidden="true"></div>
		<div class="wrap cta__inner">
			<div class="cta__panel">
				<div class="cta__copy">
					<h2>Let’s discuss your requirements</h2>
					<p>Tell us what your organization needs. Our team will discuss the right workforce, facilities or security support.</p>
				</div>
				<a class="btn btn-light" href="mailto:info@okool.com">Discuss Your Service Requirements</a>
			</div>
		</div>
	</section>

	<?php /* Figma 2:1023 — FAQ (same component as the About page) */ ?>
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
