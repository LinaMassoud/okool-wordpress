<?php
$okool_home = okool_link(home_url('/'));
$okool_is_front = is_front_page();
$okool_about = okool_link(okool_page_url('about', home_url('/#about')));
$okool_is_about = 'okool-about' === okool_current_page();
$okool_services = okool_link(okool_page_url('services', home_url('/#services')));
$okool_is_services = 'okool-services' === okool_current_page() || 0 === strpos(okool_current_design(), 'service-');
$okool_contact = okool_link(okool_page_url('contact', home_url('/#contact')));
$okool_is_contact = 'okool-contact' === okool_current_page();
$okool_careers = okool_link(okool_page_url('careers', home_url('/careers/')));
$okool_is_careers = 'okool-careers' === okool_current_page() || in_array(okool_current_design(), ['vacancies', 'vacancy-single', 'vacancy-apply'], true);
$okool_news = okool_link(okool_theme_news_url());
$okool_is_news = in_array(okool_current_design(), ['news', 'news-single'], true);
$okool_svc = static function ($anchor) use ($okool_services, $okool_home) {
    return okool_page_url('services') ? $okool_services . '#' . $anchor : okool_link(home_url('/#services'));
};
// A service detail page when it exists, otherwise the matching section of the Services page.
$okool_detail = static function ($design, $anchor) use ($okool_svc) {
    $url = okool_page_url($design);
    return $url ? okool_link($url) : $okool_svc($anchor);
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="site-header__bar">
        <a class="logo" href="<?php echo esc_url($okool_home); ?>">
            <img class="logo__mark" src="<?php echo esc_url(okool_asset('okool-logo.svg')); ?>" alt="OKOOL" width="160" height="39">
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
            <span class="nav-toggle__bars" aria-hidden="true"></span>
            <span class="screen-reader-text"><?php esc_html_e('Menu', 'okool'); ?></span>
        </button>

        <nav id="site-nav" class="site-nav" aria-label="<?php esc_attr_e('Primary', 'okool'); ?>">
            <a class="<?php echo $okool_is_front ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_home); ?>"><?php esc_html_e('Home', 'okool'); ?></a>
            <a class="<?php echo $okool_is_about ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_about); ?>"><?php esc_html_e('About OKOOL', 'okool'); ?></a>
            <div class="nav-drop">
                <a class="<?php echo $okool_is_services ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_services); ?>"><?php esc_html_e('Services', 'okool'); ?></a>
                <img class="nav-drop__icon" src="<?php echo esc_url(okool_asset('icon-chevron-down.svg')); ?>" alt="" aria-hidden="true" width="14" height="14">
                <div class="nav-drop__panel">
                    <div>
                        <a class="nav-drop__heading" href="<?php echo esc_url($okool_detail('service-workforce', 'workforce')); ?>"><?php esc_html_e('Workforce Solutions', 'okool'); ?></a>
                        <a href="<?php echo esc_url($okool_detail('service-talent', 'workforce')); ?>"><?php esc_html_e('Talent Acquisition & Recruitment', 'okool'); ?></a>
                        <a href="<?php echo esc_url($okool_detail('service-outsourcing', 'workforce')); ?>"><?php esc_html_e('Workforce Outsourcing', 'okool'); ?></a>
                        <a href="<?php echo esc_url($okool_detail('service-emiratisation', 'workforce')); ?>"><?php esc_html_e('Emiratisation & National Talent', 'okool'); ?></a>
                    </div>
                    <div>
                        <a class="nav-drop__heading" href="<?php echo esc_url($okool_svc('facilities')); ?>"><?php esc_html_e('Facilities Management', 'okool'); ?></a>
                        <a href="<?php echo esc_url($okool_detail('service-hard-fm', 'facilities')); ?>"><?php esc_html_e('Hard FM', 'okool'); ?></a>
                        <a href="<?php echo esc_url($okool_detail('service-soft-fm', 'facilities')); ?>"><?php esc_html_e('Soft FM', 'okool'); ?></a>
                    </div>
                    <div>
                        <a class="nav-drop__heading" href="<?php echo esc_url($okool_detail('service-security', 'security')); ?>"><?php esc_html_e('Security Services', 'okool'); ?></a>
                        <a href="<?php echo esc_url($okool_detail('service-security', 'security')); ?>"><?php esc_html_e('Manned security & site protection', 'okool'); ?></a>
                    </div>
                </div>
            </div>
            <a class="<?php echo $okool_is_news ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_news); ?>"><?php esc_html_e('News & Insights', 'okool'); ?></a>
            <a class="<?php echo $okool_is_careers ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_careers); ?>"><?php esc_html_e('Careers', 'okool'); ?></a>
            <a class="<?php echo $okool_is_contact ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_contact); ?>"><?php esc_html_e('Contact', 'okool'); ?></a>
        </nav>

        <div class="header-actions">
            <?php if (okool_is_ar()) : ?>
                <a class="header-lang" href="<?php echo esc_url(okool_switch_url()); ?>" hreflang="en" lang="en">English</a>
            <?php else : ?>
                <a class="header-lang" href="<?php echo esc_url(okool_switch_url()); ?>" hreflang="ar" lang="ar">العربية</a>
            <?php endif; ?>
            <a class="btn header-cta" href="<?php echo esc_url($okool_contact . (okool_page_url('contact') ? '#enquiry' : '')); ?>"><?php esc_html_e('Request a Service', 'okool'); ?></a>
        </div>
    </div>
</header>
