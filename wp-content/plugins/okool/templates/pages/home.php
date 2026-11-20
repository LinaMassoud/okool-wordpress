<?php
/**
 * Okool homepage design.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img = static function ( $file ) {
	return esc_url( okool_asset( $file ) );
};

get_header();
?>
<main id="okool-content">
    <section class="hero">
        <div class="hero__glows" aria-hidden="true">
            <span class="hero__glow hero__glow--rose"></span>
            <span class="hero__glow hero__glow--cream"></span>
            <span class="hero__glow hero__glow--gold"></span>
        </div>
        <svg class="hero__arcs" viewBox="0 0 1890 787" preserveAspectRatio="none" aria-hidden="true" fill="none">
            <path d="M-224.16 605.6C141.588 407.051 329.687 804.149 688.468 626.5C1047.25 448.85 1134.33 -192.08 1587.16 -0.497234C2039.99 191.085 1928.53 379.184 2231.58 156.252" stroke-width="2.96082" stroke-linecap="round" stroke="url(#hero-contour-0)"/>
            <path d="M-224.16 633.466C141.588 434.917 329.687 832.015 688.468 654.366C1047.25 476.717 1134.33 -164.213 1587.16 27.3692C2039.99 218.952 1928.53 407.051 2231.58 184.118" stroke-width="2.96082" stroke-linecap="round" stroke="url(#hero-contour-1)"/>
            <path d="M-224.16 661.333C141.588 462.784 329.687 859.882 688.468 682.233C1047.25 504.583 1134.33 -136.347 1587.16 55.2357C2039.99 246.818 1928.53 434.917 2231.58 211.985" stroke-width="2.96082" stroke-linecap="round" stroke="url(#hero-contour-2)"/>
            <path d="M-224.16 689.199C141.588 490.65 329.687 887.748 688.468 710.099C1047.25 532.45 1134.33 -108.48 1587.16 83.1024C2039.99 274.685 1928.53 462.784 2231.58 239.852" stroke-width="2.96082" stroke-linecap="round" stroke="url(#hero-contour-3)"/>
            <path d="M-224.16 717.066C141.588 518.517 329.687 915.615 688.468 737.966C1047.25 560.317 1134.33 -80.6135 1587.16 110.969C2039.99 302.551 1928.53 490.65 2231.58 267.718" stroke-width="2.96082" stroke-linecap="round" stroke="url(#hero-contour-4)"/>
            <defs>
                <linearGradient id="hero-contour-0" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497286" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="hero-contour-1" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497353" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="hero-contour-2" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497419" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="hero-contour-3" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497242" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="hero-contour-4" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497309" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
            </defs>
        </svg>
        <div class="wrap hero__grid">
            <div class="hero__copy">
                <p class="hero__eyebrow"><?php esc_html_e('Integrated services. One accountable partner.', 'okool'); ?></p>
                <h1><?php echo wp_kses(__('Workforce Solutions,<br>Facilities Management <span class="amp">&amp;</span><br>Security Services in the<br>UAE', 'okool'), ['br' => [], 'span' => ['class' => []]]); ?></h1>
                <p class="lede"><?php esc_html_e('OKOOL is a UAE-based integrated services company providing Workforce Solutions, Facilities Management and Security Services through one accountable operational platform.', 'okool'); ?></p>
                <div class="hero__actions">
                    <a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url(okool_link(okool_page_url('contact', '#contact'))); ?>"><?php esc_html_e('Request a Service', 'okool'); ?></a>
                    <a class="btn svc-btn svc-btn--light" href="#services"><?php esc_html_e('Explore Our Services', 'okool'); ?></a>
                </div>
            </div>
            <figure class="hero__photo">
                <img class="hero__main" src="<?php echo $img('home-hero-team.jpg'); ?>" alt="<?php esc_attr_e('Professional team planning together', 'okool'); ?>">
                <span class="hero__badge"><?php esc_html_e('Integrated services', 'okool'); ?></span>
                <img class="hero__inset" src="<?php echo $img('home-hero-inset.jpg'); ?>" alt="">
            </figure>
        </div>
    </section>

    <div class="hero__bar">
        <div class="wrap hero__bar-inner">
            <ul class="stats">
                <li><strong data-count="13" data-suffix="+">13+</strong><span><?php esc_html_e('years of UAE market experience', 'okool'); ?></span></li>
                <li><strong data-count="3000" data-suffix="+">3,000+</strong><span><?php esc_html_e('professionals', 'okool'); ?></span></li>
                <li><strong data-count="10000" data-suffix="+">10,000+</strong><span><?php esc_html_e('placements', 'okool'); ?></span></li>
            </ul>
        </div>
    </div>

    <div class="hero__bar-actions">
        <a class="btn btn-hero-request" href="#contact">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 6.5A2.5 2.5 0 0 1 7.5 4h9A2.5 2.5 0 0 1 19 6.5v6A2.5 2.5 0 0 1 16.5 15H12l-3.5 3v-3H7.5A2.5 2.5 0 0 1 5 12.5v-6z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M8.25 8.25h7.5M8.25 11h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <?php esc_html_e('Request a Service', 'okool'); ?>
        </a>
        <a class="btn btn-icon btn-icon-phone" href="#contact" aria-label="<?php esc_attr_e('Contact OKOOL', 'okool'); ?>">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M7 3.8h2.2l1.2 3-1.5 1a12.5 12.5 0 0 0 6.3 6.3l1-1.5 3 1.2V18a2 2 0 0 1-2.2 2A16.2 16.2 0 0 1 4 6a2 2 0 0 1 2-2.2H7z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

    <section class="partner" id="about">
        <img class="partner__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <svg class="partner__contours" viewBox="520 -40 1480 900" preserveAspectRatio="xMaxYMax meet" aria-hidden="true" fill="none" overflow="visible">
            <path d="M-224.16 605.6C141.588 407.051 329.687 804.149 688.468 626.5C1047.25 448.85 1134.33 -192.08 1587.16 -0.497234C2039.99 191.085 1928.53 379.184 2231.58 156.252" stroke-width="2.96082" stroke-linecap="round" stroke="url(#partner-bc-0)"/>
            <path d="M-224.16 633.466C141.588 434.917 329.687 832.015 688.468 654.366C1047.25 476.717 1134.33 -164.213 1587.16 27.3692C2039.99 218.952 1928.53 407.051 2231.58 184.118" stroke-width="2.96082" stroke-linecap="round" stroke="url(#partner-bc-1)"/>
            <path d="M-224.16 661.333C141.588 462.784 329.687 859.882 688.468 682.233C1047.25 504.583 1134.33 -136.347 1587.16 55.2357C2039.99 246.818 1928.53 434.917 2231.58 211.985" stroke-width="2.96082" stroke-linecap="round" stroke="url(#partner-bc-2)"/>
            <path d="M-224.16 689.199C141.588 490.65 329.687 887.748 688.468 710.099C1047.25 532.45 1134.33 -108.48 1587.16 83.1024C2039.99 274.685 1928.53 462.784 2231.58 239.852" stroke-width="2.96082" stroke-linecap="round" stroke="url(#partner-bc-3)"/>
            <path d="M-224.16 717.066C141.588 518.517 329.687 915.615 688.468 737.966C1047.25 560.317 1134.33 -80.6135 1587.16 110.969C2039.99 302.551 1928.53 490.65 2231.58 267.718" stroke-width="2.96082" stroke-linecap="round" stroke="url(#partner-bc-4)"/>
            <defs>
                <linearGradient id="partner-bc-0" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497286" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="partner-bc-1" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497353" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="partner-bc-2" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497419" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="partner-bc-3" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497242" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="partner-bc-4" x1="19.6717" y1="696.166" x2="1970.33" y2="-0.497309" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#B27F84" stop-opacity="0"/>
                    <stop offset="0.2" stop-color="#B27F84" stop-opacity="0.75"/>
                    <stop offset="0.55" stop-color="#FCFAF7" stop-opacity="0.8"/>
                    <stop offset="0.82" stop-color="#B27F84" stop-opacity="0.7"/>
                    <stop offset="1" stop-color="#B27F84" stop-opacity="0"/>
                </linearGradient>
            </defs>
        </svg>
        <div class="wrap partner__grid">
            <figure class="partner__photo">
                <img src="<?php echo $img('about-handshake.jpg'); ?>" alt="<?php esc_attr_e('Colleagues shaking hands in a meeting', 'okool'); ?>">
            </figure>
            <div class="partner__card">
                <p class="partner__eyebrow"><?php esc_html_e('About OKOOL', 'okool'); ?></p>
                <h2><?php esc_html_e('Your operations. Our integrated support.', 'okool'); ?></h2>
                <p><?php esc_html_e('OKOOL is a UAE-based integrated services company supporting government, semi-government and private-sector organizations. We combine local market experience, scalable workforce capability and compliance-led delivery to help clients operate safely, efficiently and confidently.', 'okool'); ?></p>
                <a class="btn svc-btn svc-btn--wine" href="<?php echo esc_url(okool_link(okool_page_url('about', '#about'))); ?>"><?php esc_html_e('Discover OKOOL', 'okool'); ?></a>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <span class="about-surface" aria-hidden="true"></span>
        <div class="wrap services__inner">
            <div class="services__head">
                <p class="services__index">01 — 03</p>
                <h2><?php esc_html_e('Our Service', 'okool'); ?></h2>
            </div>
            <div class="service-grid">
                <article class="service-card">
                    <img src="<?php echo $img('svc-meeting.jpg'); ?>" alt="<?php esc_attr_e('Workforce planning meeting', 'okool'); ?>">
                    <div class="service-card__body">
                        <p class="service-card__index">01</p>
                        <h3><?php esc_html_e('Workforce Solutions', 'okool'); ?></h3>
                        <p><?php esc_html_e('Connect your organization with professional, technical, skilled and support talent—from recruitment to outsourcing and employee administration.', 'okool'); ?></p>
                        <a href="<?php echo esc_url(okool_link(okool_page_url('service-workforce', okool_page_url('services') ? okool_page_url('services') . '#workforce' : '#contact'))); ?>"><?php esc_html_e('Explore service', 'okool'); ?> <span aria-hidden="true">&rarr;</span></a>
                    </div>
                </article>
                <article class="service-card">
                    <img src="<?php echo $img('svc-site-team.jpg'); ?>" alt="<?php esc_attr_e('Site team reviewing a maintenance plan', 'okool'); ?>">
                    <div class="service-card__body">
                        <p class="service-card__index">02</p>
                        <h3><?php esc_html_e('Facilities Management', 'okool'); ?></h3>
                        <p><?php esc_html_e('Support facility performance through technical maintenance, cleaning, housekeeping and workplace support.', 'okool'); ?></p>
                        <a href="<?php echo esc_url(okool_link(okool_page_url('service-hard-fm', okool_page_url('services') ? okool_page_url('services') . '#facilities' : '#contact'))); ?>"><?php esc_html_e('Explore service', 'okool'); ?> <span aria-hidden="true">&rarr;</span></a>
                    </div>
                </article>
                <article class="service-card">
                    <img src="<?php echo $img('svc-security.jpg'); ?>" alt="<?php esc_attr_e('Security officer on duty', 'okool'); ?>">
                    <div class="service-card__body">
                        <p class="service-card__index">03</p>
                        <h3><?php esc_html_e('Security Services', 'okool'); ?></h3>
                        <p><?php esc_html_e('Protect people, facilities and operations with professional personnel and structured procedures within approved scope.', 'okool'); ?></p>
                        <a href="<?php echo esc_url(okool_link(okool_page_url('service-security', okool_page_url('services') ? okool_page_url('services') . '#security' : '#contact'))); ?>"><?php esc_html_e('Explore service', 'okool'); ?> <span aria-hidden="true">&rarr;</span></a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="why">
        <img class="why__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <div class="wrap why__grid">
            <figure class="why__photo">
                <img src="<?php echo $img('home-why.jpg'); ?>" alt="<?php esc_attr_e('Professional team in a workplace discussion', 'okool'); ?>">
                <figcaption class="why__caption">
                    <p class="why__eyebrow"><?php esc_html_e('Why OKOOL', 'okool'); ?></p>
                    <h2><?php esc_html_e('One partner. Accountable delivery.', 'okool'); ?></h2>
                </figcaption>
            </figure>
            <ol class="why__list">
                <li><span>01</span><?php esc_html_e('One service partner', 'okool'); ?></li>
                <li><span>02</span><?php esc_html_e('Established UAE experience', 'okool'); ?></li>
                <li><span>03</span><?php esc_html_e('Scalable workforce support', 'okool'); ?></li>
                <li><span>04</span><?php esc_html_e('Compliance-led processes', 'okool'); ?></li>
                <li><span>05</span><?php esc_html_e('Dedicated operational teams', 'okool'); ?></li>
                <li><span>06</span><?php esc_html_e('A people-focused approach', 'okool'); ?></li>
            </ol>
        </div>
    </section>

    <section class="presence" id="presence">
        <img class="presence__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <div class="wrap presence__grid">
            <div class="presence__card">
                <p class="presence__eyebrow"><?php esc_html_e('Industries we serve', 'okool'); ?></p>
                <h2><?php esc_html_e('Supporting organizations across the UAE', 'okool'); ?></h2>
                <p><?php esc_html_e('Each operating environment comes with its own workforce, facility and security requirements. We shape our services around your organization\'s priorities to support reliable day-to-day operations.', 'okool'); ?></p>
                <ul class="presence__industries">
                    <li><?php esc_html_e('Government & Semi-Government', 'okool'); ?></li>
                    <li><?php esc_html_e('Construction & Infrastructure', 'okool'); ?></li>
                    <li><?php esc_html_e('Banking & Financial Services', 'okool'); ?></li>
                    <li><?php esc_html_e('Hospitality', 'okool'); ?></li>
                    <li><?php esc_html_e('Healthcare', 'okool'); ?></li>
                    <li><?php esc_html_e('FMCG', 'okool'); ?></li>
                    <li><?php esc_html_e('Energy & Industrial', 'okool'); ?></li>
                    <li><?php esc_html_e('Logistics', 'okool'); ?></li>
                    <li><?php esc_html_e('Telecommunications', 'okool'); ?></li>
                    <li><?php esc_html_e('Education', 'okool'); ?></li>
                    <li><?php esc_html_e('Commercial Facilities', 'okool'); ?></li>
                </ul>
            </div>
            <div class="presence__photos">
                <img src="<?php echo $img('presence-warehouse.jpg'); ?>" alt="<?php esc_attr_e('Warehouse team reviewing a delivery', 'okool'); ?>">
                <img src="<?php echo $img('presence-cleaning.jpg'); ?>" alt="<?php esc_attr_e('Facilities specialist cleaning a lobby', 'okool'); ?>">
                <img src="<?php echo $img('presence-corridor.jpg'); ?>" alt="<?php esc_attr_e('Team reviewing work on a tablet', 'okool'); ?>">
            </div>
        </div>
    </section>

    <section class="process">
        <div class="wrap">
            <div class="process__panel">
                <img class="process__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
                <div class="process__head">
                    <h2><?php esc_html_e('Structured from planning to delivery', 'okool'); ?></h2>
                    <p><?php esc_html_e('We align requirements, prepare personnel and resources, coordinate deployment and use reporting and feedback to strengthen ongoing delivery.', 'okool'); ?></p>
                </div>
                <ol class="process__steps">
                    <li><span>1</span><?php esc_html_e('Understand', 'okool'); ?></li>
                    <li><span>2</span><?php esc_html_e('Plan', 'okool'); ?></li>
                    <li><span>3</span><?php esc_html_e('Mobilise', 'okool'); ?></li>
                    <li><span>4</span><?php esc_html_e('Deploy', 'okool'); ?></li>
                    <li><span>5</span><?php esc_html_e('Supervise', 'okool'); ?></li>
                    <li><span>6</span><?php esc_html_e('Measure', 'okool'); ?></li>
                    <li><span>7</span><?php esc_html_e('Improve', 'okool'); ?></li>
                </ol>
            </div>
        </div>
    </section>

    <section class="clients">
        <img class="clients__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <div class="wrap clients__inner">
            <div class="clients__head">
                <h2><?php esc_html_e('Our Valued Clients', 'okool'); ?></h2>
                <div class="clients__nav" aria-label="<?php esc_attr_e('Client logos', 'okool'); ?>">
                    <button type="button" class="clients__nav-btn" data-clients-dir="-1" aria-label="<?php esc_attr_e('Previous clients', 'okool'); ?>">
                        <img src="<?php echo $img('arrow-left.svg'); ?>" alt="" width="20" height="20">
                    </button>
                    <button type="button" class="clients__nav-btn" data-clients-dir="1" aria-label="<?php esc_attr_e('Next clients', 'okool'); ?>">
                        <img src="<?php echo $img('arrow-right.svg'); ?>" alt="" width="20" height="20">
                    </button>
                </div>
            </div>
            <div class="clients__track" data-clients-track>
                <ul class="clients__logos">
                    <li><img src="<?php echo $img('clients/adafsa.png'); ?>" alt="<?php esc_attr_e('Abu Dhabi Agriculture and Food Safety Authority', 'okool'); ?>"></li>
                    <li><img src="<?php echo $img('clients/mohre.png'); ?>" alt="<?php esc_attr_e('Ministry of Human Resources & Emiratisation', 'okool'); ?>"></li>
                    <li><img src="<?php echo $img('clients/insurance-pool.png'); ?>" alt="<?php esc_attr_e('Insurance Pool', 'okool'); ?>"></li>
                    <li><img src="<?php echo $img('clients/rta.png'); ?>" alt="<?php esc_attr_e('Roads & Transport Authority', 'okool'); ?>"></li>
                    <li><img src="<?php echo $img('clients/silal.png'); ?>" alt="<?php esc_attr_e('Silal', 'okool'); ?>"></li>
                    <li><img src="<?php echo $img('clients/network.png'); ?>" alt="<?php esc_attr_e('Network International', 'okool'); ?>"></li>
                </ul>
            </div>
        </div>
        <script>
          (function () {
            var track = document.querySelector('[data-clients-track]');
            if (!track) return;
            var buttons = document.querySelectorAll('[data-clients-dir]');
            buttons.forEach(function (btn) {
              btn.addEventListener('click', function () {
                var dir = Number(btn.getAttribute('data-clients-dir')) || 1;
                track.scrollBy({ left: dir * Math.max(220, track.clientWidth * 0.45), behavior: 'smooth' });
              });
            });
            // Dim the arrow that can't scroll any further.
            function sync() {
              var max = track.scrollWidth - track.clientWidth - 1;
              buttons.forEach(function (btn) {
                var dir = Number(btn.getAttribute('data-clients-dir'));
                btn.disabled = dir < 0 ? track.scrollLeft <= 0 : track.scrollLeft >= max;
              });
            }
            track.addEventListener('scroll', sync, { passive: true });
            window.addEventListener('resize', sync);
            sync();
          })();
        </script>
    </section>

    <section class="cta" id="contact">
        <div class="cta__glow" aria-hidden="true"></div>
        <div class="cta__surface" aria-hidden="true">
            <span class="cta__surface-light cta__surface-light--rose"></span>
            <span class="cta__surface-light cta__surface-light--cream"></span>
            <span class="cta__surface-light cta__surface-light--gold"></span>
        </div>
        <div class="wrap cta__inner">
            <div class="cta__panel">
                <div class="cta__copy">
                    <h2><?php esc_html_e('Let’s discuss your requirements', 'okool'); ?></h2>
                    <p><?php esc_html_e('Tell us what your organization needs. Our team will discuss the right workforce, facilities or security support.', 'okool'); ?></p>
                </div>
                <a class="btn svc-btn svc-btn--light" href="<?php echo esc_url(okool_link(okool_page_url('contact', 'mailto:info@okool.com'))); ?>"><?php esc_html_e('Request a Service', 'okool'); ?></a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
