<?php
/**
 * Unu Raymi - Responsible Travel & Social Impact Dedicated Subpage
 */

$page_title = 'Responsible Travel & Philanthropy | Yaku Kunan Project | Unu Raymi';
$meta_desc = 'Discover our commitment to regenerative luxury travel across Peru and the Andes: water preservation and education in high-altitude Quechua communities.';
$current_page = 'about';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER -->
<section class="subpage-hero content__banner" style="background-image: url('/assets/img/heroes/responsible-hero.webp');">
    <div class="subpage-hero-content content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="subpage-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <span class="active">Responsible Travel &amp; Yaku Kunan</span>
        </div>

        <span class="subpage-hero-tag">REGENERATIVE TOURISM ✦ SOCIAL IMPACT</span>
        <h1 class="subpage-hero-title">Ultra-Luxury Travel with Purpose</h1>
        <p class="subpage-hero-subtitle">
            WATER CONSERVATION, ANCESTRAL WISDOM, AND COMMUNITY FLOURISHING IN THE ANDES
        </p>

        <!-- Hero Action Buttons -->
        <div class="subpage-hero-actions">
            <a href="#yaku-kunan" class="btn-hero-gold">
                Yaku Kunan Initiative
            </a>
            <a href="/contact" class="btn-hero-outline">
                Design Sustainable Journey →
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#yaku-kunan" class="content__banner__next" aria-label="Scroll to initiative">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. INITIATIVE CONTENT SECTION -->
<section class="section" id="yaku-kunan" style="padding-top: 60px; background: var(--bg-surface, #FAF8F5);">
    <div class="container" style="max-width: 900px;">
        <div class="tour-block">
            <span class="section-tag">Signature Initiative</span>
            <h2 class="block-title">The Yaku Kunan Project: Water and Ancestral Wisdom</h2>
            <div class="tour-narrative">
                <p>
                    In the Quechua language, <em>Yaku Kunan</em> translates to <em>"Water Now"</em>. A dedicated portion of every journey booked with Unu Raymi is directly channeled to community water infrastructure and the restoration of traditional Incan qochas (ancestral rainwater retention reservoirs) in isolated high-Andean communities of Cusco and the Sacred Valley.
                </p>
                <p>
                    Furthermore, we actively support rural bilingual primary schools with classroom supplies and fund traditional textile masterclasses taught by elder master weavers to ensure ancient textile wisdom thrives for generations to come.
                </p>
            </div>
        </div>

        <div class="tour-block">
            <span class="section-tag">Our Pledge</span>
            <h2 class="block-title">Environmental &amp; Ethical Commitments</h2>
            <div class="trust-grid" style="margin-top: 24px;">
                <div class="trust-item">
                    <h4>✦ Single-Use Plastic-Free Operations</h4>
                    <p>We provide handcrafted thermal refillable bottles to all guests and water stations in our private Mercedes fleet.</p>
                </div>
                <div class="trust-item">
                    <h4>✦ Fair Living Wages &amp; Dignity</h4>
                    <p>Our porters, field staff, specialist guides, and drivers earn wages far above industry norms with comprehensive private medical coverage.</p>
                </div>
                <div class="trust-item">
                    <h4>✦ Carbon Neutrality &amp; Reforestation</h4>
                    <p>We measure and offset ground logistics carbon emissions through active reforestation programs planting native high-Andean Polylepis (Queñua) forests.</p>
                </div>
                <div class="trust-item">
                    <h4>✦ Cultural Dignity &amp; Authentic Encounters</h4>
                    <p>We strictly oppose staged performances or human zoos. Every cultural interaction with local weaving and farming families is voluntary, respectful, and mutually enriching.</p>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 48px; padding: 40px; background: rgba(212,175,55,0.06); border: 1px solid var(--border-gold); border-radius: 12px;">
            <h3 style="color: #FFF; font-size: 24px; margin-bottom: 12px;">Travel with Deeper Meaning</h3>
            <p style="color: var(--text-secondary); max-width: 600px; margin: 0 auto 24px;">
                Discover how your bespoke journey across South America creates an enduring legacy of gratitude and mutual preservation.
            </p>
            <a href="/custom-journey" class="cta-button" style="padding: 14px 32px; font-size: 12px;">
                Design My Purposeful Journey ↗
            </a>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/footer.php';
?>
