<?php
/**
 * Vacancies listing (Figma 697:579) at /careers/vacancies/.
 *
 * Filters work as a plain GET form; a small script then filters instantly as you type.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img         = static function ( $file ) {
	return esc_url( okool_asset( $file ) );
};
$departments = okool_vacancy_departments();
$locations   = okool_vacancy_locations();

// phpcs:disable WordPress.Security.NonceVerification.Recommended -- read-only filters.
$filter_q    = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
$filter_dept = isset( $_GET['department'] ) ? sanitize_key( wp_unslash( $_GET['department'] ) ) : '';
$filter_loc  = isset( $_GET['location'] ) ? sanitize_key( wp_unslash( $_GET['location'] ) ) : '';
// phpcs:enable

// Collect every vacancy once, so filters, the count and the cards agree.
$vacancies    = [];
$used_locs    = [];
$all_samples  = true;
while ( have_posts() ) {
	the_post();
	$meta   = okool_vacancy_meta( get_the_ID() );
	$title  = get_the_title();
	$excerpt = get_the_excerpt();
	$haystack = function_exists( 'mb_strtolower' ) ? mb_strtolower( $title . ' ' . $excerpt . ' ' . $meta['department_label'] ) : strtolower( $title . ' ' . $excerpt . ' ' . $meta['department_label'] );
	$needle   = function_exists( 'mb_strtolower' ) ? mb_strtolower( $filter_q ) : strtolower( $filter_q );

	$vacancies[] = [
		'url'     => get_permalink(),
		'title'   => $title,
		'excerpt' => $excerpt,
		'meta'    => $meta,
		'text'    => $haystack,
		'match'   => ( '' === $filter_dept || $filter_dept === $meta['department'] )
			&& ( '' === $filter_loc || $filter_loc === $meta['location'] )
			&& ( '' === $needle || false !== strpos( $haystack, $needle ) ),
	];

	if ( $meta['location'] ) {
		$used_locs[ $meta['location'] ] = true;
	}
	$all_samples = $all_samples && $meta['sample'];
}
wp_reset_postdata();

$shown  = count( array_filter( wp_list_pluck( $vacancies, 'match' ) ) );
$labels = $all_samples
	? [ __( '1 sample vacancy', 'okool' ), __( '%d sample vacancies', 'okool' ) ]
	: [ __( '1 vacancy', 'okool' ), __( '%d vacancies', 'okool' ) ];
$count  = static function ( $n ) use ( $labels ) {
	return 1 === $n ? $labels[0] : sprintf( $labels[1], $n );
};

get_header();
?>
<main id="okool-content" class="vac-main">
	<?php /* Figma 697:583 — page header */ ?>
	<section class="vac-hero">
		<span class="about-surface" aria-hidden="true"></span>
		<span class="vac-hero__contours" aria-hidden="true">
			<img src="<?php echo $img( 'careers-contours.svg' ); ?>" alt="" width="847.013" height="283.809">
		</span>
		<div class="wrap vac-hero__inner">
			<p class="about-eyebrow"><?php esc_html_e( 'OKOOL', 'okool' ); ?><?php if ( ! okool_is_ar() ) : ?> — <span lang="ar" dir="rtl">عقول</span><?php endif; ?></p>
			<h1><?php esc_html_e( 'Careers at OKOOL', 'okool' ); ?></h1>
			<p><?php esc_html_e( 'Explore the kinds of roles that support our workforce, facilities, and security operations.', 'okool' ); ?></p>
		</div>
	</section>

	<?php /* Figma 697:609 — filters and vacancy cards */ ?>
	<section class="vac-listing">
		<span class="about-surface" aria-hidden="true"></span>
		<div class="wrap">
			<h2 class="vac-listing__title"><?php esc_html_e( 'Explore opportunities', 'okool' ); ?></h2>
			<?php if ( $vacancies && $all_samples ) : ?>
				<p class="vac-listing__intro"><?php esc_html_e( 'These sample vacancies are for design review and are not currently open for applications.', 'okool' ); ?></p>
			<?php elseif ( $vacancies ) : ?>
				<p class="vac-listing__intro"><?php esc_html_e( 'Browse current openings and view the details of each role.', 'okool' ); ?></p>
			<?php endif; ?>

			<?php if ( $vacancies ) : ?>
				<form class="about-glass vac-filters" method="get" action="<?php echo esc_url( get_post_type_archive_link( OKOOL_VACANCY_TYPE ) ); ?>" role="search" data-vac-filters>
					<?php if ( okool_is_ar() ) : ?>
						<input type="hidden" name="<?php echo esc_attr( OKOOL_LANG_ARG ); ?>" value="ar">
					<?php endif; ?>
					<label class="vac-field">
						<span><?php esc_html_e( 'Search vacancies', 'okool' ); ?></span>
						<input type="search" name="q" value="<?php echo esc_attr( $filter_q ); ?>" placeholder="<?php esc_attr_e( 'Role or keyword', 'okool' ); ?>" data-vac-q>
					</label>
					<label class="vac-field">
						<span><?php esc_html_e( 'Department', 'okool' ); ?></span>
						<select name="department" data-vac-department style="--chevron: url('<?php echo $img( 'select-chevron-dark.svg' ); ?>')">
							<option value=""><?php esc_html_e( 'All departments', 'okool' ); ?></option>
							<?php foreach ( $departments as $key => $dept ) : ?>
								<option value="<?php echo esc_attr( $key ); ?>"<?php selected( $filter_dept, $key ); ?>><?php echo esc_html( $dept[0] ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="vac-field">
						<span><?php esc_html_e( 'Location', 'okool' ); ?></span>
						<select name="location" data-vac-location style="--chevron: url('<?php echo $img( 'select-chevron-dark.svg' ); ?>')">
							<option value=""><?php esc_html_e( 'All locations', 'okool' ); ?></option>
							<?php foreach ( $locations as $key => $label ) : ?>
								<?php if ( isset( $used_locs[ $key ] ) ) : ?>
									<option value="<?php echo esc_attr( $key ); ?>"<?php selected( $filter_loc, $key ); ?>><?php echo esc_html( $label ); ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</label>
					<noscript><button type="submit" class="btn svc-btn svc-btn--wine"><?php esc_html_e( 'Search', 'okool' ); ?></button></noscript>
				</form>

				<p class="vac-status" role="status" data-vac-count data-one="<?php echo esc_attr( $labels[0] ); ?>" data-many="<?php echo esc_attr( $labels[1] ); ?>"><?php echo esc_html( $count( $shown ) ); ?></p>

				<div class="vac-grid">
					<?php foreach ( $vacancies as $vac ) : ?>
						<a class="about-glass vac-card" href="<?php echo esc_url( okool_link( $vac['url'] ) ); ?>" data-vac-card data-department="<?php echo esc_attr( $vac['meta']['department'] ); ?>" data-location="<?php echo esc_attr( $vac['meta']['location'] ); ?>" data-text="<?php echo esc_attr( $vac['text'] ); ?>"<?php echo $vac['match'] ? '' : ' hidden'; ?>>
							<span class="vac-card__top">
								<span class="vac-card__icon" aria-hidden="true"><img src="<?php echo $img( 'icons/' . $vac['meta']['icon'] . '.svg' ); ?>" alt="" width="23.9941" height="23.9941"></span>
								<?php if ( $vac['meta']['sample'] ) : ?>
									<span class="vac-card__badge"><?php esc_html_e( 'Sample vacancy', 'okool' ); ?></span>
								<?php endif; ?>
							</span>
							<h3><?php echo esc_html( $vac['title'] ); ?></h3>
							<span class="vac-meta">
								<?php foreach ( array_filter( [ $vac['meta']['location_label'], $vac['meta']['department_label'], $vac['meta']['type_label'] ] ) as $part ) : ?>
									<span><?php echo esc_html( $part ); ?></span>
								<?php endforeach; ?>
							</span>
							<span class="vac-card__text"><?php echo esc_html( $vac['excerpt'] ); ?></span>
							<span class="vac-card__more"><?php esc_html_e( 'View job details', 'okool' ); ?> <img src="<?php echo $img( 'icons/svc-arrow-19.svg' ); ?>" alt="" width="18.9941" height="18.9941"></span>
						</a>
					<?php endforeach; ?>
				</div>

				<p class="vac-empty" data-vac-empty<?php echo $shown ? ' hidden' : ''; ?>><?php esc_html_e( 'No vacancies match your search. Try another keyword or clear the filters.', 'okool' ); ?></p>
			<?php else : ?>
				<div class="about-glass vac-none">
					<p><?php esc_html_e( 'No vacancies are currently published.', 'okool' ); ?></p>
					<a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url( 'mailto:info@okool.com?subject=' . rawurlencode( 'CV submission' ) ); ?>"><?php esc_html_e( 'Submit your CV', 'okool' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<script>
(function () {
	var form = document.querySelector('[data-vac-filters]');
	if (!form) return;
	var q = form.querySelector('[data-vac-q]');
	var dept = form.querySelector('[data-vac-department]');
	var loc = form.querySelector('[data-vac-location]');
	var cards = document.querySelectorAll('[data-vac-card]');
	var count = document.querySelector('[data-vac-count]');
	var empty = document.querySelector('[data-vac-empty]');

	function apply() {
		var needle = q.value.trim().toLowerCase();
		var shown = 0;
		cards.forEach(function (card) {
			var ok = (!dept.value || card.dataset.department === dept.value)
				&& (!loc.value || card.dataset.location === loc.value)
				&& (!needle || card.dataset.text.indexOf(needle) !== -1);
			card.hidden = !ok;
			if (ok) shown++;
		});
		count.textContent = shown === 1 ? count.dataset.one : count.dataset.many.replace('%d', shown);
		empty.hidden = shown !== 0;

		// Keep the address shareable without reloading the page.
		var url = new URL(window.location.href);
		[['q', q.value.trim()], ['department', dept.value], ['location', loc.value]].forEach(function (pair) {
			if (pair[1]) url.searchParams.set(pair[0], pair[1]); else url.searchParams.delete(pair[0]);
		});
		history.replaceState(null, '', url);
	}

	form.addEventListener('submit', function (e) { e.preventDefault(); apply(); });
	q.addEventListener('input', apply);
	dept.addEventListener('change', apply);
	loc.addEventListener('change', apply);
})();
</script>

<?php
get_footer();
