<?php
$okool_home = home_url('/');
$okool_is_front = is_front_page();
$okool_about = okool_page_url('about', $okool_home . '#about');
$okool_is_about = 'okool-about' === okool_current_page();
$okool_services = okool_page_url('services', $okool_home . '#services');
$okool_is_services = 'okool-services' === okool_current_page();
$okool_contact = okool_page_url('contact', $okool_home . '#contact');
$okool_is_contact = 'okool-contact' === okool_current_page();
$okool_svc = static function ($anchor) use ($okool_services, $okool_home) {
    return okool_page_url('services') ? $okool_services . '#' . $anchor : $okool_home . '#services';
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
            <img class="logo__mark" src="<?php echo esc_url(okool_asset('okool-logo.png')); ?>" alt="OKOOL" width="160" height="41">
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
            <span class="nav-toggle__bars" aria-hidden="true"></span>
            <span class="screen-reader-text">Menu</span>
        </button>

        <nav id="site-nav" class="site-nav" aria-label="Primary">
            <a class="<?php echo $okool_is_front ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_home); ?>">Home</a>
            <a class="<?php echo $okool_is_about ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_about); ?>">About OKOOL</a>
            <div class="nav-drop">
                <a class="<?php echo $okool_is_services ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_services); ?>">Services</a>
                <div class="nav-drop__panel">
                    <div>
                        <p>Workforce Solutions</p>
                        <a href="<?php echo esc_url($okool_svc('workforce')); ?>">Talent Acquisition &amp; Recruitment</a>
                        <a href="<?php echo esc_url($okool_svc('workforce')); ?>">Workforce Outsourcing</a>
                        <a href="<?php echo esc_url($okool_svc('workforce')); ?>">Emiratisation &amp; National Talent</a>
                    </div>
                    <div>
                        <p>Facilities Management</p>
                        <a href="<?php echo esc_url($okool_svc('facilities')); ?>">Hard FM</a>
                        <a href="<?php echo esc_url($okool_svc('facilities')); ?>">Soft FM</a>
                    </div>
                    <div>
                        <p>Security Services</p>
                        <a href="<?php echo esc_url($okool_svc('security')); ?>">Manned security &amp; site protection</a>
                    </div>
                </div>
            </div>
            <a href="<?php echo esc_url($okool_home . '#presence'); ?>">Industries We Serve</a>
            <a href="<?php echo esc_url(home_url('/news/')); ?>">News &amp; Insights</a>
            <a href="<?php echo esc_url(home_url('/careers/')); ?>">Careers</a>
            <a class="<?php echo $okool_is_contact ? 'is-active' : ''; ?>" href="<?php echo esc_url($okool_contact); ?>">Contact</a>
        </nav>

        <div class="header-actions">
            <a class="header-lang" href="#" hreflang="ar" lang="ar">العربية</a>
            <a class="btn header-cta" href="<?php echo esc_url($okool_contact . (okool_page_url('contact') ? '#enquiry' : '')); ?>">Request a Service</a>
        </div>
    </div>
</header>
