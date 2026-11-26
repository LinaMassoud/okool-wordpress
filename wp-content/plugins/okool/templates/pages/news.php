<?php
/**
 * News & Insights listing (Figma 2:1994), rendered for the okool_news archive at /news/.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="okool-content" class="news-main">
	<?php /* Figma 2:1995 — dark page header */ ?>
	<section class="news-hero">
		<span class="news-hero__glow" aria-hidden="true"></span>
		<div class="wrap">
			<p class="about-eyebrow about-eyebrow--light"><?php esc_html_e( 'OKOOL', 'okool' ); ?><?php if ( ! okool_is_ar() ) : ?> — <span lang="ar" dir="rtl">عقول</span><?php endif; ?></p>
			<h1><?php esc_html_e( 'News & Insights', 'okool' ); ?></h1>
		</div>
	</section>

	<img class="news-contours" src="<?php echo esc_url( okool_asset( 'contact-contours.svg' ) ); ?>" alt="" aria-hidden="true" width="1058.78" height="354.764">

	<section class="news-body">
		<div class="wrap news-wrap">
			<?php if ( have_posts() ) : ?>
				<div class="news-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article <?php post_class( 'news-card' ); ?>>
							<a class="news-card__media" href="<?php echo esc_url( okool_link( get_permalink() ) ); ?>" tabindex="-1" aria-hidden="true">
								<img src="<?php echo esc_url( okool_news_image( get_the_ID(), 'medium_large' ) ); ?>" alt="" loading="lazy">
							</a>
							<div class="news-card__body">
								<time class="news-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( okool_date() ); ?></time>
								<h2><a href="<?php echo esc_url( okool_link( get_permalink() ) ); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
								<a class="news-card__more" href="<?php echo esc_url( okool_link( get_permalink() ) ); ?>"><?php esc_html_e( 'Read article', 'okool' ); ?> <span aria-hidden="true">&rarr;</span><span class="screen-reader-text">: <?php the_title(); ?></span></a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<?php
				the_posts_pagination(
					[
						'mid_size'           => 1,
						'prev_text'          => '&larr; <span class="screen-reader-text">' . esc_html__( 'Previous page', 'okool' ) . '</span>',
						'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'okool' ) . '</span> &rarr;',
						'screen_reader_text' => __( 'News pages', 'okool' ),
						'class'              => 'news-pagination',
					]
				);
				?>
			<?php else : ?>
				<?php /* Figma 2:2014 — empty state */ ?>
				<div class="about-glass news-empty">
					<span class="about-surface" aria-hidden="true"></span>
					<p><?php esc_html_e( 'Editorial updates', 'okool' ); ?></p>
					<h2><?php esc_html_e( 'Updates will appear here once published.', 'okool' ); ?></h2>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
