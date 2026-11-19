<?php
$okool_home = home_url('/');
$okool_is_front = is_front_page();
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
            <a href="<?php echo esc_url($okool_home . '#about'); ?>">About OKOOL</a>
            <div class="nav-drop">
                <a href="<?php echo esc_url($okool_home . '#services'); ?>">Services</a>
                <div class="nav-drop__panel">
                    <div>
                        <p>Workforce Solutions</p>
                        <a href="<?php echo esc_url($okool_home . '#services'); ?>">Talent Acquisition &amp; Recruitment</a>
                        <a href="<?php echo esc_url($okool_home . '#services'); ?>">Workforce Outsourcing</a>
                        <a href="<?php echo esc_url($okool_home . '#services'); ?>">Emiratisation &amp; National Talent</a>
                    </div>
                    <div>
                        <p>Facilities Management</p>
                        <a href="<?php echo esc_url($okool_home . '#services'); ?>">Hard FM</a>
                        <a href="<?php echo esc_url($okool_home . '#services'); ?>">Soft FM</a>
                    </div>
                    <div>
                        <p>Security Services</p>
                        <a href="<?php echo esc_url($okool_home . '#services'); ?>">Manned security &amp; site protection</a>
                    </div>
                </div>
            </div>
            <a href="<?php echo esc_url($okool_home . '#presence'); ?>">Industries We Serve</a>
            <a href="<?php echo esc_url(home_url('/news/')); ?>">News &amp; Insights</a>
            <a href="<?php echo esc_url(home_url('/careers/')); ?>">Careers</a>
            <a href="<?php echo esc_url($okool_home . '#contact'); ?>">Contact</a>
            <a class="header-lang" href="#" hreflang="ar" lang="ar">العربية</a>
        </nav>

        <a class="btn btn-deep btn-sm header-cta" href="<?php echo esc_url($okool_home . '#contact'); ?>">Request a Service</a>
    </div>
</header>
