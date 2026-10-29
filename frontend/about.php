<?php
/**
 * Unu Raymi - About Us & The Difference Dedicated Subpage
 */

$page_title = 'Why Travel With Unu Raymi | Local Luxury Curators';
$meta_desc = 'Discover the story of Unu Raymi: a Cusco-born boutique enterprise specializing in bespoke ultra-luxury journeys across Peru & South America with 24/7 private concierge.';
$current_page = 'about';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER -->
<section class="subpage-hero content__banner" style="background-image: url('/assets/img/heroes/about-hero.webp');">
    <div class="subpage-hero-content content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="subpage-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <span class="active">About Us &amp; The Unu Raymi Difference</span>
        </div>

        <span class="subpage-hero-tag">OUR HERITAGE ✦ PASSION FOR BESPOKE LUXURY</span>
        <h1 class="subpage-hero-title">The Art of Curating Transformative Journeys</h1>
        <p class="subpage-hero-subtitle">
            GENUINE ANDEAN HOSPITALITY COMBINED WITH PRIVILEGED ARCHAEOLOGICAL &amp; CULTURAL ACCESS
        </p>

        <!-- Hero Action Buttons -->
        <div class="subpage-hero-actions">
            <a href="#our-story" class="btn-hero-gold">
                Our Story
            </a>
            <a href="/contact" class="btn-hero-outline">
                Design My Journey →
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#our-story" class="content__banner__next" aria-label="Scroll to our story">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. STORY & CORE PHILOSOPHY SECTION -->
<section class="section" id="our-story" style="padding-top: 60px; background: var(--bg-surface, #FAF8F5);">
    <div class="container">
        <div class="tour-layout-grid">
            <div class="tour-main-content">
                <div class="tour-block">
                    <span class="section-tag">Our Heritage</span>
                    <h2 class="block-title">Genuine Hospitality with Andean Roots</h2>
                    <div class="tour-narrative">
                        <p>
                            Unu Raymi was founded on an unshakeable conviction: genuine contemporary luxury does not lie in excess, but in authenticity, the exclusivity of time, and access to intimate encounters that cannot be bought in mass-market travel catalogs.
                        </p>
                        <p>
                            Headquartered in 239 San Agustin Street, Cusco, 3 blocks from the Plaza de Armas, our team comprises native journey designers, master archaeologists, historians, and local concierges who know every secret trail, every sacred Incan hall, and every remote corner of the Andes and Patagonia.
                        </p>
                    </div>
                </div>

                <!-- The 4 Pillars of the Unu Raymi Difference -->
                <div class="tour-block">
                    <span class="section-tag">Operational Excellence</span>
                    <h2 class="block-title">The 4 Pillars of the Unu Raymi Difference</h2>
                    
                    <div class="trust-grid" style="margin-top: 24px;">
                        <div class="trust-item">
                            <h4>✦ 24/7 Dedicated In-Destination Host</h4>
                            <p>From the moment you touch down to your farewell, an exclusive personal concierge coordinates every detail in real time.</p>
                        </div>
                        <div class="trust-item">
                            <h4>✦ Scholar & Master Naturalist Guides</h4>
                            <p>No improvised guides. We work exclusively with accredited historians, archaeologists, and naturalists with a pedagogical gift.</p>
                        </div>
                        <div class="trust-item">
                            <h4>✦ VIP After-Hours Archaeological Access</h4>
                            <p>Special permits to explore Incan sanctuaries at sunrise or dusk, far away from public crowds.</p>
                        </div>
                        <div class="trust-item">
                            <h4>✦ Signature Boutique Accommodations</h4>
                            <p>A rigorous handpicked selection of South America's most distinguished sanctuaries: Belmond, explora, Tierra, and private colonial estates.</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonials / Trustpilot -->
                <div class="tour-block" id="reviews">
                    <span class="section-tag">Real Guest Experiences</span>
                    <h2 class="block-title">What Our Guests Say</h2>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 24px;">
                        <div class="highlight-card" style="display:block;">
                            <div style="color:var(--gold); font-size:16px; margin-bottom:8px;">★★★★★</div>
                            <p style="font-style:italic; font-size:13px; line-height:1.7; color:var(--text-secondary); margin-bottom:12px;">
                                "Our journey to Peru and Chile surpassed every expectation. The private access to Machu Picchu with Dr. Mendoza and the thoughtful attention from our host in Cusco were extraordinary."
                            </p>
                            <strong style="color:#FFF; font-size:12px;">— The Kensington Family, London (United Kingdom)</strong>
                        </div>
                        <div class="highlight-card" style="display:block;">
                            <div style="color:var(--gold); font-size:16px; margin-bottom:8px;">★★★★★</div>
                            <p style="font-style:italic; font-size:13px; line-height:1.7; color:var(--text-secondary); margin-bottom:12px;">
                                "The seamless combination of the Atacama Desert and the Sacred Valley was pure magic. Every detail of health, cuisine, and logistics was managed with absolute perfection."
                            </p>
                            <strong style="color:#FFF; font-size:12px;">— David &amp; Sarah Miller, New York (USA)</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar CTA -->
            <aside class="tour-sidebar">
                <div class="sticky-booking-card">
                    <span class="booking-eyebrow">✦ Plan With Us</span>
                    <h3 class="booking-tour-name">Ready to Begin?</h3>
                    <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 20px;">
                        Let us understand your desires and travel window. We will craft an interactive bespoke itinerary with no obligation.
                    </p>
                    <a href="/custom-journey" class="cta-button" style="display:block; text-align:center; padding:14px; font-size:12px;">
                        Design My Custom Journey ↗
                    </a>
                    
                    <div style="margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--border); font-size: 12px; color: var(--text-muted); line-height: 1.6;">
                        📞 Direct WhatsApp: (+51) 915 082 539<br>
                        ✉️ info@unu-raymi.com
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/footer.php';
?>
