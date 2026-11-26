<?php
$okool_svc_url  = okool_link(okool_page_url('services'));
$okool_svc_link = static function ($anchor) use ($okool_svc_url) {
    return $okool_svc_url ? $okool_svc_url . '#' . $anchor : okool_link(home_url('/#services'));
};
$okool_detail_link = static function ($design, $anchor) use ($okool_svc_link) {
    $url = okool_page_url($design);
    return $url ? okool_link($url) : $okool_svc_link($anchor);
};

/*
 * Social profiles. Add each official URL here (or through the `okool_social_links` filter);
 * an icon becomes a link once its URL is set, and the "Official links pending" note disappears
 * when every profile has one.
 */
$okool_social = apply_filters(
    'okool_social_links',
    [
        'linkedin'  => ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/okool/'],
        'instagram' => ['label' => 'Instagram', 'url' => 'https://www.instagram.com/okool_group/'],
        'facebook'  => ['label' => 'Facebook', 'url' => 'https://www.facebook.com/share/1HGYmnM9T2/'],
    ]
);
$okool_social_pending = in_array('', array_column($okool_social, 'url'), true);
?>
<?php /* Figma 697:153 — site footer */ ?>
<footer class="site-footer">
    <span class="site-footer__lighting" aria-hidden="true"></span>
    <span class="site-footer__contours" aria-hidden="true">
        <img src="<?php echo esc_url(okool_asset('footer-contours.svg')); ?>" alt="" width="1270.52" height="425.713">
    </span>

    <div class="site-footer__inner">
        <div class="site-footer__grid">
            <div class="site-footer__brand">
                <a class="site-footer__wordmark" href="<?php echo esc_url(okool_link(home_url('/'))); ?>">OKOOL</a>
                <p><?php esc_html_e('OKOOL is a UAE-based integrated services company delivering Workforce Solutions, Facilities Management and Security Services through one accountable operational platform.', 'okool'); ?></p>
            </div>
            <nav class="site-footer__col" aria-labelledby="footer-services">
                <h2 class="site-footer__heading" id="footer-services"><?php esc_html_e('Services', 'okool'); ?></h2>
                <a href="<?php echo esc_url($okool_detail_link('service-workforce', 'workforce')); ?>"><?php esc_html_e('Workforce Solutions', 'okool'); ?></a>
                <a href="<?php echo esc_url($okool_detail_link('service-talent', 'workforce')); ?>"><?php esc_html_e('Talent Acquisition & Recruitment', 'okool'); ?></a>
                <a href="<?php echo esc_url($okool_detail_link('service-outsourcing', 'workforce')); ?>"><?php esc_html_e('Workforce Outsourcing', 'okool'); ?></a>
                <a href="<?php echo esc_url($okool_detail_link('service-emiratisation', 'workforce')); ?>"><?php esc_html_e('Emiratisation & National Talent', 'okool'); ?></a>
                <a href="<?php echo esc_url($okool_detail_link('service-facilities', 'facilities')); ?>"><?php esc_html_e('Facilities Management', 'okool'); ?></a>
                <a href="<?php echo esc_url($okool_detail_link('service-hard-fm', 'facilities')); ?>"><?php esc_html_e('Hard FM', 'okool'); ?></a>
                <a href="<?php echo esc_url($okool_detail_link('service-soft-fm', 'facilities')); ?>"><?php esc_html_e('Soft FM', 'okool'); ?></a>
                <a href="<?php echo esc_url($okool_detail_link('service-security', 'security')); ?>"><?php esc_html_e('Security Services', 'okool'); ?></a>
            </nav>
            <nav class="site-footer__col" aria-labelledby="footer-company">
                <h2 class="site-footer__heading" id="footer-company"><?php esc_html_e('Company', 'okool'); ?></h2>
                <a href="<?php echo esc_url(okool_link(okool_page_url('about', home_url('/#about')))); ?>"><?php esc_html_e('About OKOOL', 'okool'); ?></a>
                <a href="<?php echo esc_url(okool_link(okool_page_url('services', home_url('/#services')))); ?>"><?php esc_html_e('Services', 'okool'); ?></a>
                <a href="<?php echo esc_url(okool_link(home_url('/#presence'))); ?>"><?php esc_html_e('Industries We Serve', 'okool'); ?></a>
                <a href="<?php echo esc_url(okool_link(okool_theme_news_url())); ?>"><?php esc_html_e('News & Insights', 'okool'); ?></a>
                <a href="<?php echo esc_url(okool_link(okool_page_url('careers', home_url('/careers/')))); ?>"><?php esc_html_e('Careers', 'okool'); ?></a>
                <a href="<?php echo esc_url(okool_link(okool_page_url('contact', home_url('/#contact')))); ?>"><?php esc_html_e('Contact', 'okool'); ?></a>
            </nav>
            <div class="site-footer__col site-footer__contact">
                <h2 class="site-footer__heading"><?php esc_html_e('Contact', 'okool'); ?></h2>
                <a href="mailto:info@okool.com">info@okool.com</a>
                <p><?php esc_html_e('Dubai · Garhoud Offices', 'okool'); ?></p>
                <a href="tel:+97148745445"><bdi dir="ltr">04-874 5445</bdi></a>
                <p><?php esc_html_e('Abu Dhabi · Abu Dhabi Mall Offices', 'okool'); ?></p>
                <a href="tel:+97125557971"><bdi dir="ltr">02-5557971</bdi></a>
                <p><?php esc_html_e('PO Boxes 123536 | 28862', 'okool'); ?></p>

                <div class="site-footer__social">
                    <h2 class="site-footer__social-title"><?php esc_html_e('Follow us', 'okool'); ?></h2>
                    <ul>
                        <?php foreach ($okool_social as $okool_key => $okool_profile) : ?>
                            <li>
                                <?php if ($okool_profile['url']) : ?>
                                    <a class="site-footer__social-icon" href="<?php echo esc_url($okool_profile['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($okool_profile['label']); ?>">
                                <?php else : ?>
                                    <span class="site-footer__social-icon" role="img" aria-label="<?php echo esc_attr($okool_profile['label']); ?>">
                                <?php endif; ?>
                                    <img src="<?php echo esc_url(okool_asset('social-' . $okool_key . '.svg')); ?>" alt="" width="21.9922" height="21.9922">
                                <?php echo $okool_profile['url'] ? '</a>' : '</span>'; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($okool_social_pending) : ?>
                        <p class="site-footer__social-note"><?php esc_html_e('Official links pending', 'okool'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="site-footer__base">
            <small>&copy; <?php echo esc_html(gmdate('Y')); ?> <?php esc_html_e('OKOOL. All rights reserved.', 'okool'); ?></small>
            <a href="<?php echo esc_url(okool_link(home_url('/privacy-notice/'))); ?>"><?php esc_html_e('Privacy Notice', 'okool'); ?></a>
        </div>
    </div>
</footer>
<script>
document.querySelector('.nav-toggle').addEventListener('click', function () {
    var header = document.querySelector('.site-header');
    var open = header.classList.toggle('is-open');
    this.setAttribute('aria-expanded', open ? 'true' : 'false');
});

// Services dropdown: opens on hovering Services and stays open until the pointer leaves the header.
(function () {
    var header = document.querySelector('.site-header');
    var drop = header && header.querySelector('.nav-drop');
    if (!drop) return;
    var desktop = window.matchMedia('(min-width: 1025px)');
    drop.addEventListener('mouseenter', function () {
        if (desktop.matches) drop.classList.add('is-open');
    });
    header.addEventListener('mouseleave', function () {
        drop.classList.remove('is-open');
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') drop.classList.remove('is-open');
    });
})();
</script>
<?php wp_footer(); ?>
</body>
</html>
