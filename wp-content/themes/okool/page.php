<?php get_header(); ?>
<main class="page-main">
<?php
while (have_posts()) {
    the_post();
    ?>
    <header class="page-hero">
        <div class="wrap">
            <p class="eyebrow eyebrow-dark">OKOOL</p>
            <h1><?php the_title(); ?></h1>
        </div>
    </header>
    <div class="wrap page-content">
        <?php the_content(); ?>
    </div>
    <?php
}
?>
</main>
<?php get_footer(); ?>
