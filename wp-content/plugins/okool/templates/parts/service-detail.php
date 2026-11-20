<?php
/**
 * Shared layout for the service detail pages (Figma 625:4073 / 625:6967 / 625:5842).
 *
 * Expects $okool_service: one entry from okool_service_pages().
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img      = static function ( $file ) {
	return esc_url( okool_asset( $file ) );
};
$services = okool_page_url( 'services', home_url( '/' ) );
$contact  = okool_page_url( 'contact' );
$enquiry  = $contact ? $contact . '#enquiry' : 'mailto:info@okool.com';
$related  = okool_related_services();
$titled   = ! empty( $okool_service['section_title'] );

$faqs = [
	[ __( 'What does an integrated services company provide?', 'okool' ), __( 'An integrated services company coordinates more than one operational service through a single relationship. OKOOL’s three pillars are Workforce Solutions, Facilities Management and Security Services.', 'okool' ) ],
	[ __( 'Which services can businesses request from OKOOL?', 'okool' ), __( 'Businesses can discuss recruitment, workforce outsourcing, Emiratisation, hard and soft facilities management, and security support. The final service scope is agreed according to operational requirements and approved capabilities.', 'okool' ) ],
	[ __( 'Where are OKOOL’s UAE offices?', 'okool' ), __( 'The company profile lists offices in Abu Dhabi Mall Offices, Abu Dhabi, and Garhoud Offices, Dubai. Contact OKOOL to confirm office directions and discuss your requirements.', 'okool' ) ],
];

get_header();
?>
<main id="okool-content">
	<?php /* Hero: wine glass card beside the photo */ ?>
	<section class="split-hero">
		<span class="about-surface" aria-hidden="true"></span>
		<img class="about-hero__contours split-hero__contours" src="<?php echo $img( 'about-contours.svg' ); ?>" alt="" aria-hidden="true" width="2458.7" height="823.836">
		<div class="wrap split-hero__grid">
			<div class="about-glass about-glass--wine split-hero__card">
				<nav class="split-hero__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'okool' ); ?>">
					<a href="<?php echo esc_url( okool_link( home_url( '/' ) ) ); ?>"><?php esc_html_e( 'Home', 'okool' ); ?></a>
					<span aria-hidden="true">/</span>
					<a href="<?php echo esc_url( okool_link( $services ) ); ?>"><?php esc_html_e( 'Services', 'okool' ); ?></a>
				</nav>
				<h1><?php echo esc_html( $okool_service['heading'] ); ?></h1>
				<p><?php echo esc_html( $okool_service['intro'] ); ?></p>
			</div>
			<figure class="split-hero__photo">
				<img src="<?php echo $img( $okool_service['image'] ); ?>" alt="<?php echo esc_attr( $okool_service['alt'] ); ?>" fetchpriority="high"<?php echo empty( $okool_service['image_position'] ) ? '' : ' style="object-position: ' . esc_attr( $okool_service['image_position'] ) . '"'; ?>>
				<figcaption class="split-hero__chip"><?php esc_html_e( 'Integrated support', 'okool' ); ?></figcaption>
			</figure>
		</div>
	</section>

	<?php /* Service information: three capability cards */ ?>
	<section class="svd-info">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap">
			<?php if ( $titled ) : ?>
				<h2 class="svd-info__title"><?php echo esc_html( $okool_service['section_title'] ); ?></h2>
			<?php endif; ?>

			<?php if ( ! empty( $okool_service['lead'] ) ) : ?>
				<div class="svd-lead">
					<h2><?php echo esc_html( $okool_service['lead'][0] ); ?></h2>
					<p><?php echo esc_html( $okool_service['lead'][1] ); ?></p>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $okool_service['process'] ) ) : ?>
				<div class="svd-process">
					<h2><?php echo esc_html( $okool_service['process'][0] ); ?></h2>
					<ol>
						<?php foreach ( $okool_service['process'][1] as $okool_i => $okool_step ) : ?>
							<li><span class="svd-process__num"><bdi><?php echo esc_html( sprintf( '%02d', $okool_i + 1 ) ); ?></bdi></span><?php echo esc_html( $okool_step ); ?></li>
						<?php endforeach; ?>
					</ol>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $okool_service['checklist'] ) ) : ?>
				<div class="svd-checklist">
					<h2><?php echo esc_html( $okool_service['checklist'][0] ); ?></h2>
					<ul>
						<?php foreach ( $okool_service['checklist'][1] as $okool_item ) : ?>
							<li><?php echo esc_html( $okool_item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $okool_service['tiles'] ) ) : ?>
				<h2 class="svd-tiles__title"><?php echo esc_html( $okool_service['tiles'][0] ); ?></h2>
				<ul class="svd-tiles">
					<?php foreach ( $okool_service['tiles'][1] as $okool_tile ) : ?>
						<li>
							<img src="<?php echo $img( 'icons/' . $okool_tile[0] . '.svg' ); ?>" alt="" width="23.9941" height="23.9941">
							<span><?php echo esc_html( $okool_tile[1] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ( ! empty( $okool_service['cards'] ) ) : ?>
			<div class="svd-cards<?php echo empty( $okool_service['card_layout'] ) ? '' : ' svd-cards--' . esc_attr( $okool_service['card_layout'] ); ?>">
				<?php foreach ( $okool_service['cards'] as $okool_card ) : ?>
					<article class="about-glass svd-card">
						<div class="svd-card__head">
							<span class="svd-card__icon" aria-hidden="true">
								<img src="<?php echo $img( 'icons/' . $okool_card[0] . '.svg' ); ?>" alt="" width="23.9941" height="23.9941">
							</span>
							<?php if ( $titled ) : ?>
								<h3><?php echo esc_html( $okool_card[1] ); ?></h3>
							<?php else : ?>
								<h2><?php echo esc_html( $okool_card[1] ); ?></h2>
							<?php endif; ?>
						</div>
						<?php if ( is_array( $okool_card[2] ) ) : ?>
							<ul class="svd-card__list">
								<?php foreach ( $okool_card[2] as $okool_item ) : ?>
									<li><?php echo esc_html( $okool_item ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php else : ?>
							<p><?php echo esc_html( $okool_card[2] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $okool_service['note'] ) ) : ?>
				<div class="svd-note<?php echo empty( $okool_service['note_style'] ) ? '' : ' svd-note--' . esc_attr( $okool_service['note_style'] ); ?>">
					<h2><?php echo esc_html( $okool_service['note'][0] ); ?></h2>
					<p><?php echo esc_html( $okool_service['note'][1] ); ?></p>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $okool_service['links'] ) ) : ?>
				<ul class="svd-links">
					<?php foreach ( $okool_service['links'] as $okool_row ) : ?>
						<?php $okool_href = 'enquiry' === $okool_row[1] ? $enquiry : okool_page_url( $okool_row[1], $enquiry ); ?>
						<li>
							<a href="<?php echo esc_url( okool_link( $okool_href ) ); ?>">
								<span><?php echo esc_html( $okool_row[0] ); ?></span>
								<img src="<?php echo $img( 'icons/svc-arrow.svg' ); ?>" alt="" width="17.998" height="17.998">
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</section>

	<?php /* CTA (shares the home page CTA) */ ?>
	<section class="cta" id="contact">
		<div class="cta__glow" aria-hidden="true"></div>
		<div class="wrap cta__inner">
			<div class="cta__panel">
				<div class="cta__copy">
					<h2><?php esc_html_e( 'Let’s discuss your requirements', 'okool' ); ?></h2>
					<p><?php esc_html_e( 'Tell us what your organization needs. Our team will discuss the right workforce, facilities or security support.', 'okool' ); ?></p>
				</div>
				<a class="btn svc-btn svc-btn--light" href="<?php echo esc_url( okool_link( $enquiry ) ); ?>"><?php esc_html_e( 'Request a Service', 'okool' ); ?></a>
			</div>
		</div>
	</section>

	<?php /* FAQ (same component as the About page) */ ?>
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

	<?php /* Related services */ ?>
	<section class="svd-related">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap">
			<h2><?php esc_html_e( 'Related Services', 'okool' ); ?></h2>
			<div class="svd-related__grid">
				<?php foreach ( $okool_service['related'] as $okool_key ) : ?>
					<?php $okool_rel = $related[ $okool_key ]; ?>
					<article class="about-glass svd-related__card svd-related__card--<?php echo esc_attr( $okool_key ); ?>">
						<img src="<?php echo $img( $okool_rel['image'] ); ?>" alt="" loading="lazy">
						<div class="svd-related__body">
							<h3><?php echo esc_html( $okool_rel['title'] ); ?></h3>
							<p><?php echo esc_html( $okool_rel['text'] ); ?></p>
							<a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url( okool_link( $okool_rel['url'] ) ); ?>"><?php esc_html_e( 'Explore service', 'okool' ); ?><span class="screen-reader-text">: <?php echo esc_html( $okool_rel['title'] ); ?></span></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
