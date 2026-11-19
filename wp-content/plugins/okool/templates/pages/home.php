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

require OKOOL_DIR . 'templates/partials/header.php';
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
                <p class="hero__eyebrow">Integrated services. One accountable partner.</p>
                <h1>Workforce Solutions,<br>Facilities Management <span class="amp">&amp;</span><br>Security Services in the<br>UAE</h1>
                <p class="lede">OKOOL is a UAE-based integrated services company providing Workforce Solutions, Facilities Management and Security Services through one accountable operational platform.</p>
                <div class="hero__actions">
                    <a class="btn btn-deep" href="#contact">Request a Service</a>
                    <a class="btn btn-light" href="#services">Explore Our Services</a>
                </div>
            </div>
            <figure class="hero__photo">
                <img class="hero__main" src="<?php echo $img('hero-team.jpg'); ?>" alt="Team in a meeting around a conference table">
                <span class="hero__badge">Integrated services</span>
                <img class="hero__inset" src="<?php echo $img('workforce.jpg'); ?>" alt="">
            </figure>
        </div>
    </section>

    <div class="hero__bar">
        <div class="wrap hero__bar-inner">
            <ul class="stats">
                <li><strong>13+</strong><span>years of UAE market experience</span></li>
                <li><strong>3,000+</strong><span>professionals</span></li>
                <li><strong>10,000+</strong><span>placements</span></li>
            </ul>
        </div>
    </div>

    <div class="hero__bar-actions">
        <a class="btn btn-hero-request" href="#contact">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 6.5A2.5 2.5 0 0 1 7.5 4h9A2.5 2.5 0 0 1 19 6.5v6A2.5 2.5 0 0 1 16.5 15H12l-3.5 3v-3H7.5A2.5 2.5 0 0 1 5 12.5v-6z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M8.25 8.25h7.5M8.25 11h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            Request a Service
        </a>
        <a class="btn btn-icon btn-icon-phone" href="#contact" aria-label="Contact OKOOL">
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
                <img src="<?php echo $img('about-handshake.jpg'); ?>" alt="Colleagues shaking hands in a meeting">
            </figure>
            <div class="partner__card">
                <p class="partner__eyebrow">About OKOOL</p>
                <h2>Your operations. Our integrated support.</h2>
                <p>OKOOL is a UAE-based integrated services company supporting government, semi-government and private-sector organizations. We combine local market experience, scalable workforce capability and compliance-led delivery to help clients operate safely, efficiently and confidently.</p>
                <a class="btn btn-solid" href="#about">Discover OKOOL</a>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <img class="services__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <div class="wrap services__inner">
            <div class="services__head">
                <p class="services__index">01 — 03</p>
                <h2>Our Service</h2>
            </div>
            <div class="service-grid">
                <article class="service-card">
                    <img src="<?php echo $img('workforce.jpg'); ?>" alt="Team meeting about workforce planning">
                    <p class="service-card__index">01</p>
                    <h3>Workforce Solutions</h3>
                    <p>Connect your organization with professional, technical, skilled and support talent—from recruitment to outsourcing and employee administration.</p>
                    <a href="#contact">Explore service <span aria-hidden="true">&rarr;</span></a>
                </article>
                <article class="service-card">
                    <img src="<?php echo $img('facilities.jpg'); ?>" alt="Facilities team on an operational site">
                    <p class="service-card__index">02</p>
                    <h3>Facilities Management</h3>
                    <p>Support facility performance through technical maintenance, cleaning, housekeeping and workplace support.</p>
                    <a href="#contact">Explore service <span aria-hidden="true">&rarr;</span></a>
                </article>
                <article class="service-card">
                    <img src="<?php echo $img('security.jpg'); ?>" alt="A commercial workplace supported by security services">
                    <p class="service-card__index">03</p>
                    <h3>Security Services</h3>
                    <p>Protect people, facilities and operations with professional personnel and structured procedures within approved scope.</p>
                    <a href="#contact">Explore service <span aria-hidden="true">&rarr;</span></a>
                </article>
            </div>
        </div>
    </section>

    <section class="why">
        <img class="why__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <div class="wrap why__grid">
            <figure class="why__photo">
                <img src="<?php echo $img('meeting.jpg'); ?>" alt="Leadership team in a meeting">
                <figcaption class="why__caption">
                    <p class="why__eyebrow">Why OKOOL</p>
                    <h2>One partner. Accountable delivery.</h2>
                </figcaption>
            </figure>
            <ol class="why__list">
                <li><span>01</span>One service partner</li>
                <li><span>02</span>Established UAE experience</li>
                <li><span>03</span>Scalable workforce support</li>
                <li><span>04</span>Compliance-led processes</li>
                <li><span>05</span>Dedicated operational teams</li>
                <li><span>06</span>A people-focused approach</li>
            </ol>
        </div>
    </section>

    <section class="presence" id="presence">
        <img class="presence__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <div class="wrap presence__grid">
            <div class="presence__card">
                <p class="presence__eyebrow">Industries we serve</p>
                <h2>Supporting organizations across the UAE</h2>
                <p>Each operating environment comes with its own workforce, facility and security requirements. We shape our services around your organization's priorities to support reliable day-to-day operations.</p>
                <ul class="presence__industries">
                    <li>Government &amp; Semi-Government</li>
                    <li>Construction &amp; Infrastructure</li>
                    <li>Banking &amp; Financial Services</li>
                    <li>Hospitality</li>
                    <li>Healthcare</li>
                    <li>FMCG</li>
                    <li>Energy &amp; Industrial</li>
                    <li>Logistics</li>
                    <li>Telecommunications</li>
                    <li>Education</li>
                    <li>Commercial Facilities</li>
                </ul>
            </div>
            <div class="presence__photos">
                <img src="<?php echo $img('presence-warehouse.jpg'); ?>" alt="Warehouse team reviewing a delivery">
                <img src="<?php echo $img('presence-cleaning.jpg'); ?>" alt="Facilities specialist cleaning a lobby">
                <img src="<?php echo $img('presence-corridor.jpg'); ?>" alt="Team reviewing work on a tablet">
            </div>
        </div>
    </section>

    <section class="process">
        <div class="wrap">
            <div class="process__panel">
                <img class="process__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
                <div class="process__head">
                    <h2>Structured from planning to delivery</h2>
                    <p>We align requirements, prepare personnel and resources, coordinate deployment and use reporting and feedback to strengthen ongoing delivery.</p>
                </div>
                <ol class="process__steps">
                    <li><span>1</span>Understand</li>
                    <li><span>2</span>Plan</li>
                    <li><span>3</span>Mobilise</li>
                    <li><span>4</span>Deploy</li>
                    <li><span>5</span>Supervise</li>
                    <li><span>6</span>Measure</li>
                    <li><span>7</span>Improve</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="clients">
        <img class="clients__surface" src="<?php echo $img('brand-surface-light.svg'); ?>" alt="" aria-hidden="true">
        <div class="wrap clients__inner">
            <div class="clients__head">
                <h2>Our Valued Clients</h2>
                <div class="clients__nav" aria-label="Client logos">
                    <button type="button" class="clients__nav-btn" data-clients-dir="-1" aria-label="Previous clients">
                        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M14.5 5.5 8 12l6.5 6.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button type="button" class="clients__nav-btn" data-clients-dir="1" aria-label="Next clients">
                        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M9.5 5.5 16 12l-6.5 6.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </div>
            <div class="clients__track" data-clients-track>
                <ul class="clients__logos">
                    <li><img src="<?php echo $img('clients/adafsa.png'); ?>" alt="Abu Dhabi Agriculture and Food Safety Authority"></li>
                    <li><img src="<?php echo $img('clients/mohre.png'); ?>" alt="Ministry of Human Resources &amp; Emiratisation"></li>
                    <li><img src="<?php echo $img('clients/insurance-pool.png'); ?>" alt="Insurance Pool"></li>
                    <li><img src="<?php echo $img('clients/rta.png'); ?>" alt="Roads &amp; Transport Authority"></li>
                    <li><img src="<?php echo $img('clients/silal.png'); ?>" alt="Silal"></li>
                </ul>
            </div>
        </div>
        <script>
          (function () {
            var track = document.querySelector('[data-clients-track]');
            if (!track) return;
            document.querySelectorAll('[data-clients-dir]').forEach(function (btn) {
              btn.addEventListener('click', function () {
                var dir = Number(btn.getAttribute('data-clients-dir')) || 1;
                track.scrollBy({ left: dir * Math.max(220, track.clientWidth * 0.45), behavior: 'smooth' });
              });
            });
          })();
        </script>
    </section>

    <section class="cta" id="contact">
        <div class="cta__glow" aria-hidden="true"></div>
        <div class="wrap cta__inner">
            <div class="cta__panel">
                <div class="cta__copy">
                    <h2>Let’s discuss your requirements</h2>
                    <p>Tell us what your organization needs. Our team will discuss the right workforce, facilities or security support.</p>
                </div>
                <a class="btn btn-light" href="mailto:info@okool.com">Request a Service</a>
            </div>
        </div>
    </section>
</main>

<?php
require OKOOL_DIR . 'templates/partials/footer.php';
