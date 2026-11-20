<?php
/**
 * Single News & Insights article, styled to match the news listing (Figma 2:1994).
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$okool_more = get_posts(
		[
			'post_type'      => OKOOL_NEWS_TYPE,
			'posts_per_page' => 3,
			'post__not_in'   => [ get_the_ID() ],
		]
	);
	?>
<main id="okool-content" class="news-main">
	<section class="news-hero news-hero--article">
		<span class="news-hero__glow" aria-hidden="true"></span>
		<div class="wrap news-article-wrap">
			<p class="about-eyebrow about-eyebrow--light">
				<a href="<?php echo esc_url( okool_link( get_post_type_archive_link( OKOOL_NEWS_TYPE ) ) ); ?>"><?php esc_html_e( 'News & Insights', 'okool' ); ?></a>
				<span aria-hidden="true">·</span>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( okool_date() ); ?></time>
			</p>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>

	<img class="news-contours" src="<?php echo esc_url( okool_asset( 'contact-contours.svg' ) ); ?>" alt="" aria-hidden="true" width="1058.78" height="354.764">

	<section class="news-body">
		<div class="wrap news-article-wrap">
			<article <?php post_class( 'about-glass news-article' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="news-article__media">
						<?php the_post_thumbnail( 'large', [ 'loading' => 'eager', 'fetchpriority' => 'high' ] ); ?>
					</figure>
				<?php endif; ?>
				<div class="news-article__content">
					<?php the_content(); ?>
				</div>
			</article>

			<a class="news-back" href="<?php echo esc_url( okool_link( get_post_type_archive_link( OKOOL_NEWS_TYPE ) ) ); ?>"><span aria-hidden="true">&larr;</span> <?php esc_html_e( 'All news & insights', 'okool' ); ?></a>
		</div>

		<?php if ( $okool_more ) : ?>
			<div class="wrap news-wrap news-more">
				<h2><?php esc_html_e( 'More insights', 'okool' ); ?></h2>
				<div class="news-grid">
					<?php foreach ( $okool_more as $okool_item ) : ?>
						<article class="news-card">
							<a class="news-card__media" href="<?php echo esc_url( okool_link( get_permalink( $okool_item ) ) ); ?>" tabindex="-1" aria-hidden="true">
								<img src="<?php echo esc_url( okool_news_image( $okool_item->ID, 'medium_large' ) ); ?>" alt="" loading="lazy">
							</a>
							<div class="news-card__body">
								<time class="news-card__date" datetime="<?php echo esc_attr( get_the_date( 'c', $okool_item ) ); ?>"><?php echo esc_html( okool_date( $okool_item ) ); ?></time>
								<h3><a href="<?php echo esc_url( okool_link( get_permalink( $okool_item ) ) ); ?>"><?php echo esc_html( get_the_title( $okool_item ) ); ?></a></h3>
								<a class="news-card__more" href="<?php echo esc_url( okool_link( get_permalink( $okool_item ) ) ); ?>"><?php esc_html_e( 'Read article', 'okool' ); ?> <span aria-hidden="true">&rarr;</span><span class="screen-reader-text">: <?php echo esc_html( get_the_title( $okool_item ) ); ?></span></a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</section>
</main>
	<?php
endwhile;

get_footer();
