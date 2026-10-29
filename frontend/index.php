<?php
/**
 * Unu Raymi - Main Homepage
 * Multi-page navigation (links directly to subpages, zero overlays)
 */

require_once __DIR__ . '/includes/db-loader.php';

$allTours = DB::getAll('tours');
$allDests = DB::getAll('destinations');

$page_title = 'Unu Raymi | Bespoke Luxury Travel in Peru & South America';
$meta_desc = 'Handcrafted ultra-luxury private journeys across Peru, Chile, Bolivia, Galapagos, and Colombia. Dedicated 24/7 host & exclusive archaeological access.';
$current_page = 'home';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. HERO BANNER SECTION -->
<section class="hero-section" id="hero">
    <div class="hero-overlay"></div>
    <div class="container hero-container-clean">
        <div class="hero-clean-box">
            <h1 class="hero-clean-title">
                The Local<br>
                Experience Curator
            </h1>
            <p class="hero-clean-subtitle">
                EXQUISITE, HANDCRAFTED PRIVATE JOURNEYS<br>
                WITH POSITIVE IMPACT: TRAVEL TO SOUTH AMERICA
            </p>
            <div class="hero-clean-actions">
                <a href="#tours" class="hero-btn-small hero-btn-explore">
                    Explore
                </a>
                <a href="/custom-journey" class="hero-btn-small hero-btn-design">
                    Plan My Trip
                </a>
            </div>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#tours" class="content__banner__next" aria-label="Scroll down to tours">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. CORPORATE INTRO & FORBES RECOGNITION -->
<section class="section" style="padding: 70px 0 40px; text-align: center; background: var(--bg-surface);">
    <div class="container" style="max-width: 900px;">
        <span class="section-tag">Bespoke Travel to South America</span>
        <h2 class="section-title" style="font-size: 34px; margin-bottom: 20px;">
            Genuine Hospitality, Absolute Privacy &amp; Meticulous Care
        </h2>
        <p style="color: var(--text-secondary); line-height: 1.8; font-size: 16px; margin-bottom: 32px;">
            Founded in Cusco and operating with bespoke craftsmanship, Unu Raymi is a family-owned luxury travel agency dedicated to designing private expeditions in South America. Each of our itineraries is an exclusive creation, tailored to your own pace, with VIP priority access and continuous accompaniment by your dedicated private host in destination.
        </p>

        <!-- Forbes Banner Badge -->
        <div class="forbes-banner-badge" style="display: inline-flex; align-items: center; gap: 16px; padding: 14px 28px; background: rgba(154,102,21,0.08); border: 1px solid rgba(154,102,21,0.22); border-radius: 8px;">
            <span style="font-size: 20px; font-family: var(--font-serif); color: var(--gold-light); font-weight: 700; letter-spacing: 0.1em;">Forbes</span>
            <span style="font-size: 13px; color: var(--text-primary); text-align: left;">
                <em>"The expert guide to luxury bespoke travel in Peru and the Sacred Valley"</em>
            </span>
        </div>
    </div>
</section>

<!-- 3. THREE VALUE PILLARS -->
<section class="section" style="padding: 60px 0; background: var(--bg-dark);">
    <div class="container">
        <div class="trust-grid">
            <div class="trust-item" style="background: #FFFFFF; padding: 32px 24px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                <span style="font-size: 32px; display: block; margin-bottom: 12px;">🧭</span>
                <h3 style="font-size: 17px; color: #1D1E20; margin-bottom: 8px; font-weight: 700;">CURATED JOURNEYS</h3>
                <p>100% individualized itineraries. No two journeys are alike; we adapt every day to your passions, culinary tastes, and rhythm.</p>
            </div>
            <div class="trust-item" style="background: #FFFFFF; padding: 32px 24px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                <span style="font-size: 32px; display: block; margin-bottom: 12px;">🏛️</span>
                <h3 style="font-size: 17px; color: #1D1E20; margin-bottom: 8px; font-weight: 700;">AUTHENTIC EXPERIENCES</h3>
                <p>After-hours access to Incan sanctuaries, intimate encounters with master artisans, and the region's finest scholar historian guides.</p>
            </div>
            <div class="trust-item" style="background: #FFFFFF; padding: 32px 24px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                <span style="font-size: 32px; display: block; margin-bottom: 12px;">💧</span>
                <h3 style="font-size: 17px; color: #1D1E20; margin-bottom: 8px; font-weight: 700;">TRAVEL RESPONSIBLY</h3>
                <p>Active commitment to clean water conservation and rural education in Quechua communities through our social initiative, Yaku Kunan.</p>
            </div>
        </div>
    </div>
</section>

<?php
// Signature Itineraries
$signatureTours = [
    [
        'title' => 'INDULGING IN THE WATERS & WINES OF ARGENTINA',
        'duration' => '12D/11N',
        'country' => 'Argentina',
        'image' => '/assets/img/tours/argentina-travel-itinerary.webp',
        'slug' => 'waters-and-wines-of-argentina'
    ],
    [
        'title' => 'DESERT LANDSCAPES & AMAZING LAKES OF CHILE',
        'duration' => '10D/9N',
        'country' => 'Chile',
        'image' => '/assets/img/tours/chile-travel-itinerary.webp',
        'slug' => 'desert-landscapes-and-amazing-lakes-of-chile'
    ],
    [
        'title' => 'JOURNEY TO THE UYUNI SALT FLATS',
        'duration' => '5D/4N',
        'country' => 'Bolivia',
        'image' => '/assets/img/tours/bolivia-travel-itinerary.webp',
        'slug' => 'journey-to-the-uyuni-salt-flats'
    ],
    [
        'title' => 'MACHU PICCHU LUXURY TOUR',
        'duration' => '8D/7N',
        'country' => 'Peru',
        'image' => '/assets/img/tours/machu-picchu-luxury-travel.webp',
        'slug' => 'machu-picchu-luxury-tours'
    ],
    [
        'title' => 'EXTRAORDINARY ECUADOR & THE GALAPAGOS ISLANDS',
        'duration' => '16D/15N',
        'country' => 'Ecuador',
        'image' => '/assets/img/tours/ecuador-travel-itinerary.webp',
        'slug' => 'extraordinary-ecuador-the-galapagos-islands'
    ],
    [
        'title' => 'EXPLORING THE MAGICAL WONDERS OF COLOMBIA',
        'duration' => '10D/9N',
        'country' => 'Colombia',
        'image' => '/assets/img/tours/colombia-travel-itinerary.webp',
        'slug' => 'exploring-the-magical-wonders-of-colombia'
    ]
];
?>

<!-- 4. SIGNATURE ITINERARIES -->
<section id="signature-itineraries" class="signature-itineraries-section">
    <div class="sig-container">
        
        <!-- Header -->
        <div class="sig-header">
            <span class="sig-tag">BROWSE THROUGH SAMPLE</span>
            <h2 class="sig-title">Signature Itineraries</h2>
            <p class="sig-lead">
                Adventurous mountain hikes, luxurious river cruises, or leisurely horseback rides through the countryside.
            </p>
            <p class="sig-sub">
                Every journey is uniquely handcrafted by Unu Raymi's expert travel designers to your desire. Browse through a few sample itineraries below to get a preview of what your custom vacation to South America could look like.
            </p>
        </div>

        <!-- Carousel Wrapper with Navigation Arrows -->
        <div class="sig-carousel-wrapper">
            <button type="button" class="sig-nav-arrow sig-prev" onclick="moveSigCarousel(-1)" aria-label="Previous Itineraries">
                ‹
            </button>

            <div class="sig-carousel-viewport" id="sig-carousel-viewport">
                <div class="sig-carousel-track" id="sig-carousel-track">
                    <?php foreach ($signatureTours as $index => $st): ?>
                        <div class="sig-slide" data-index="<?php echo $index; ?>">
                            <a href="/tour/<?php echo htmlspecialchars($st['slug']); ?>" class="sig-card">
                                <div class="sig-card-media" style="background-image: url('<?php echo htmlspecialchars($st['image']); ?>');">
                                </div>
                                <div class="sig-card-footer">
                                    <h3 class="sig-card-title"><?php echo htmlspecialchars($st['title']); ?></h3>
                                    <span class="sig-card-duration"><?php echo htmlspecialchars($st['duration']); ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="button" class="sig-nav-arrow sig-next" onclick="moveSigCarousel(1)" aria-label="Next Itineraries">
                ›
            </button>
        </div>

        <!-- Pagination Dots (6 Rectangular Blocks matching Image 2) -->
        <div class="sig-pagination-dots" id="sig-pagination-dots">
            <?php foreach ($signatureTours as $i => $st): ?>
                <button type="button" class="sig-dot <?php echo ($i === 0) ? 'active' : ''; ?>" onclick="goSigSlide(<?php echo $i; ?>)" aria-label="Slide <?php echo $i + 1; ?>"></button>
            <?php endforeach; ?>
        </div>

        <!-- Catalog Callout Button -->
        <div class="sig-catalog-link-box">
            <a href="/tours" class="sig-view-all-btn">
                VIEW FULL ITINERARIES COLLECTION (<?php echo count($allTours); ?>) →
            </a>
        </div>

    </div>
</section>

<!-- 5. WHY TRAVEL WITH UNU RAYMI -->
<section id="por-que-nosotros" class="section trust-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">The Unu Raymi Difference</span>
            <h2 class="section-title">Why Travel With Us?</h2>
            <p class="section-subtitle">
                We personally oversee every detail of your journey with our own local team, without commercial intermediaries.
            </p>
        </div>

        <div class="trust-grid">
            <div class="trust-item">
                <h4>✦ 100% On-the-Ground Cusco Operations</h4>
                <p>Our headquarters 239 San Agustin Street, Cusco, 3 blocks from the Plaza de Armas supervises your journey in real time, ensuring immediate 24/7 assistance.</p>
            </div>
            <div class="trust-item">
                <h4>✦ Scholar Historian Guides</h4>
                <p>Exclusive access to archaeological landmarks led by internationally published historians and archaeologists.</p>
            </div>
            <div class="trust-item">
                <h4>✦ Dedicated 24/7 Private Host</h4>
                <p>A bilingual private concierge is at your disposal around the clock to coordinate reservations, transfers, or spontaneous itinerary tweaks.</p>
            </div>
            <div class="trust-item">
                <h4>✦ Yaku Kunan Social Initiative</h4>
                <p>A direct percentage of each booking funds clean water infrastructure and education in remote Andean Quechua villages.</p>
            </div>
        </div>
    </div>
</section>

<!-- 6. GUEST REVIEWS / TESTIMONIALS -->
<section class="section" style="background: var(--bg-surface);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Verified Guest Reviews</span>
            <h2 class="section-title">Moments That Leave a Lasting Impression</h2>
            <p class="section-subtitle">
                Distinguished travelers who entrusted our team with their most cherished milestones.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-top: 30px;">
            <div class="highlight-card" style="display: block; padding: 28px;">
                <div style="color: var(--gold); font-size: 16px; margin-bottom: 12px;">★★★★★</div>
                <p style="font-style: italic; font-size: 14px; line-height: 1.8; color: var(--text-secondary); margin-bottom: 16px;">
                    "Our anniversary journey through the Sacred Valley, Machu Picchu, and Atacama was a true masterpiece. The Unu Raymi team made us feel like Andean royalty. Simply unbeatable."
                </p>
                <div style="color: var(--text-primary); font-weight: 600; font-size: 13px;">— Robert &amp; Claire Vance</div>
                <span style="color: var(--text-muted); font-size: 11px;">San Francisco, California • TripAdvisor Travelers' Choice</span>
            </div>

            <div class="highlight-card" style="display: block; padding: 28px;">
                <div style="color: var(--gold); font-size: 16px; margin-bottom: 12px;">★★★★★</div>
                <p style="font-style: italic; font-size: 14px; line-height: 1.8; color: var(--text-secondary); margin-bottom: 16px;">
                    "The family expedition on the Amazon luxury cruise and the Belmond Hiram Bingham train will remain etched in our children's hearts forever. Flawless attention to detail at every step."
                </p>
                <div style="color: var(--text-primary); font-weight: 600; font-size: 13px;">— Elena &amp; Mateo Rossi</div>
                <span style="color: var(--text-muted); font-size: 11px;">Milan, Italy • Verified Trustpilot Review</span>
            </div>

            <div class="highlight-card" style="display: block; padding: 28px;">
                <div style="color: var(--gold); font-size: 16px; margin-bottom: 12px;">★★★★★</div>
                <p style="font-style: italic; font-size: 14px; line-height: 1.8; color: var(--text-secondary); margin-bottom: 16px;">
                    "We completed the Salkantay Lodge Trek and the logistics were perfection. The guides knew precisely how to navigate trails away from crowds. 100% recommended."
                </p>
                <div style="color: var(--text-primary); font-weight: 600; font-size: 13px;">— Jonathan Wright</div>
                <span style="color: var(--text-muted); font-size: 11px;">Melbourne, Australia • Google 5-Star Review</span>
            </div>
        </div>
    </div>
</section>

<!-- 7. SOUTH AMERICA DESTINATIONS SHOWCASE -->
<section id="destinos" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Sacred Lands</span>
            <h2 class="section-title">Geographic Destinations &amp; Hubs</h2>
            <p class="section-subtitle">
                Explore our dedicated subpages by country and region to discover each sanctuary in depth.
            </p>
        </div>

        <div class="destinations-grid" id="home-destinations-grid">
            <?php 
            $featuredDests = array_slice($allDests, 0, 6);
            foreach ($featuredDests as $d): 
                $dCountry = strtolower($d['country'] ?? 'peru');
                $dFlag = ($dCountry === 'chile') ? '🇨🇱' : '🇵🇪';
            ?>
                <div class="destination-card" style="background-image: linear-gradient(180deg, rgba(9,12,17,0.2) 0%, rgba(9,12,17,0.95) 100%), url('<?php echo htmlspecialchars($d['image'] ?? ''); ?>');">
                    <div class="destination-card-content">
                        <span class="destination-card-country"><?php echo $dFlag . ' ' . strtoupper($dCountry); ?></span>
                        <h3 class="destination-card-title"><?php echo htmlspecialchars($d['name']); ?></h3>
                        <p class="destination-card-subtitle"><?php echo htmlspecialchars($d['subtitle'] ?? ''); ?></p>
                        <a href="/destination/<?php echo htmlspecialchars($d['slug']); ?>" class="cta-button" style="display:inline-block; padding:8px 16px; font-size:11px; margin-top:10px;">
                            Explore Destination →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 36px;">
            <a href="/destinations" class="btn-outline-gold" style="padding: 12px 30px; font-size: 12px;">
                View All 25 Geographic Destinations in South America →
            </a>
        </div>
    </div>
</section>

<!-- 8. TRAVEL STYLES -->
<section id="estilos" class="section" style="background: var(--bg-surface);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Absolute Personalization</span>
            <h2 class="section-title">Travel Tailored to Your Passion &amp; Focus</h2>
            <p class="section-subtitle">
                Every journey is handcrafted around your individual motivations, pace, and travel style.
            </p>
        </div>

        <div class="styles-grid">
            <div class="style-card" onclick="window.location.href='/tours?style=romance'">
                <div class="style-card-image" style="background-image: url('https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="style-card-content">
                    <h3 class="style-card-title">Love &amp; Romance</h3>
                    <p class="style-card-description">Andean honeymoons, holistic wellness spas, and private dinners under the starry southern sky.</p>
                </div>
            </div>

            <div class="style-card" onclick="window.location.href='/tours?style=adventure'">
                <div class="style-card-image" style="background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="style-card-content">
                    <h3 class="style-card-title">Activity &amp; Adventure</h3>
                    <p class="style-card-description">Private high-altitude treks, legendary Inca trails, and Patagonian glacial explorations.</p>
                </div>
            </div>

            <div class="style-card" onclick="window.location.href='/tours?style=gastronomy'">
                <div class="style-card-image" style="background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="style-card-content">
                    <h3 class="style-card-title">Gastronomy &amp; Enology</h3>
                    <p class="style-card-description">Exclusive chef tables in Lima's world-ranked restaurants and private vineyard cellar tastings.</p>
                </div>
            </div>

            <div class="style-card" onclick="window.location.href='/tours?style=family'">
                <div class="style-card-image" style="background-image: url('https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="style-card-content">
                    <h3 class="style-card-title">Friends &amp; Family</h3>
                    <p class="style-card-description">Private luxury villas, ceramics workshops, and seamless multigenerational travel designed for all ages.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 9. PRESS & ACCREDITATIONS -->
<section class="section" style="padding: 50px 0; background: var(--bg-dark); border-top: 1px solid var(--border);">
    <div class="container" style="text-align: center;">
        <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.2em; color: var(--text-muted); display: block; margin-bottom: 24px;">
            ✦ International Recognition &amp; Quality Seals
        </span>
        <div style="display: flex; justify-content: center; align-items: center; gap: 48px; flex-wrap: wrap; opacity: 0.75;">
            <span style="font-family: var(--font-serif); font-size: 22px; color: #1D1E20; font-weight: 700; letter-spacing: 0.1em;">Forbes</span>
            <span style="font-family: var(--font-serif); font-size: 20px; color: #2B2E33; letter-spacing: 0.05em;">The New York Times</span>
            <span style="font-family: var(--font-serif); font-size: 20px; color: #2B2E33; letter-spacing: 0.05em;">CNN Travel</span>
            <span style="font-family: var(--font-serif); font-size: 18px; color: #2B2E33; letter-spacing: 0.05em;">Condé Nast Traveler</span>
            <span style="font-family: var(--font-serif); font-size: 16px; color: var(--gold); letter-spacing: 0.1em;">TripAdvisor 2026</span>
        </div>
    </div>
</section>

<!-- 10. BESPOKE TRIP PLANNER LEAD GENERATION -->
<section id="contacto" class="unu-lead-section">
    <div class="unu-lead-container">
        <h3 class="unu-lead-title">
            Start planning your bespoke luxury adventure with Unu Raymi today and explore Peru in the most personalized, elegant way possible.
        </h3>

        <form id="home-direct-lead-form" onsubmit="submitHomeDirectLead(event)">
            <div class="unu-lead-grid">
                <!-- Left Column -->
                <div class="unu-lead-col">
                    <select name="destination" class="unu-lead-input" required>
                        <option value="" disabled selected>Where would you like to go? *</option>
                        <option value="Peru">Peru</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Chile">Chile</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="More than one country">More than one country</option>
                    </select>

                    <div class="unu-lead-split-row">
                        <input type="text" name="travel_date" class="unu-lead-input" placeholder="When would you like to travel? *" required>
                        <input type="text" name="trip_length" class="unu-lead-input" placeholder="Preferred length of trip? *" required>
                    </div>

                    <input type="text" name="travelers" class="unu-lead-input" placeholder="Number of travelers? *" required>

                    <select name="accommodation" class="unu-lead-input" required>
                        <option value="" disabled selected>Level of accommodations? *</option>
                        <option value="Luxury ( 5-star )">Luxury ( 5-star )</option>
                        <option value="Deluxe ( 4-star )">Deluxe ( 4-star )</option>
                        <option value="Boutique ( 3-star )">Boutique ( 3-star )</option>
                    </select>

                    <input type="text" name="budget" class="unu-lead-input" placeholder="Budget (per person)?">
                </div>

                <!-- Right Column -->
                <div class="unu-lead-col">
                    <input type="text" name="first_name" class="unu-lead-input" placeholder="First name *" required>
                    <input type="text" name="last_name" class="unu-lead-input" placeholder="Last name*" required>
                    <input type="email" name="email" class="unu-lead-input" placeholder="Email *" required>
                    <input type="tel" name="phone" class="unu-lead-input" placeholder="Phone Number">
                    <textarea name="notes" class="unu-lead-input unu-lead-textarea" placeholder="Additional comments?"></textarea>
                </div>
            </div>

            <div class="unu-lead-submit-wrap">
                <button type="submit" class="unu-lead-submit-btn">Submit</button>
            </div>

            <div class="unu-lead-feedback" style="display: none;"></div>
        </form>
    </div>
</section>

<script>
// Signature Itineraries Carousel Controller
let sigCurrentIndex = 0;
const sigTotalCards = 6;

function getSigVisibleCards() {
    if (window.innerWidth <= 680) return 1;
    if (window.innerWidth <= 1024) return 2;
    return 3;
}

function updateSigCarousel() {
    const track = document.getElementById('sig-carousel-track');
    const dots = document.querySelectorAll('.sig-dot');
    if (!track) return;

    const visibleCards = getSigVisibleCards();
    const maxIndex = Math.max(0, sigTotalCards - visibleCards);
    if (sigCurrentIndex > maxIndex) {
        sigCurrentIndex = maxIndex;
    }
    if (sigCurrentIndex < 0) {
        sigCurrentIndex = 0;
    }

    const slides = track.querySelectorAll('.sig-slide');
    if (slides.length > 0) {
        const slideWidth = slides[0].getBoundingClientRect().width;
        const gap = 22;
        const offsetPx = sigCurrentIndex * (slideWidth + gap);
        track.style.transform = `translateX(-${offsetPx}px)`;
    }

    dots.forEach((dot, idx) => {
        dot.classList.toggle('active', idx === sigCurrentIndex);
    });
}

function moveSigCarousel(dir) {
    const visibleCards = getSigVisibleCards();
    const maxIndex = Math.max(0, sigTotalCards - visibleCards);
    sigCurrentIndex += dir;
    if (sigCurrentIndex > maxIndex) {
        sigCurrentIndex = 0;
    } else if (sigCurrentIndex < 0) {
        sigCurrentIndex = maxIndex;
    }
    updateSigCarousel();
}

function goSigSlide(idx) {
    sigCurrentIndex = idx;
    updateSigCarousel();
}

// Touch swipe support for mobile
document.addEventListener('DOMContentLoaded', () => {
    updateSigCarousel();
    const sigViewport = document.getElementById('sig-carousel-viewport');
    if (sigViewport) {
        let touchStartX = 0;
        let touchEndX = 0;
        sigViewport.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        sigViewport.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 45) {
                moveSigCarousel(1);
            } else if (touchEndX - touchStartX > 45) {
                moveSigCarousel(-1);
            }
        }, { passive: true });
    }
});

window.addEventListener('resize', () => {
    updateSigCarousel();
});

function submitHomeDirectLead(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const feedback = form.querySelector('.unu-lead-feedback');
    const originalText = btn.textContent;

    btn.disabled = true;
    btn.textContent = 'Submitting...';
    feedback.style.display = 'none';
    feedback.className = 'unu-lead-feedback';
    feedback.innerHTML = '';

    const formData = new FormData(form);

    const payload = {
        first_name: formData.get('first_name'),
        last_name: formData.get('last_name') || '',
        email: formData.get('email'),
        phone: formData.get('phone') || '',
        destination: formData.get('destination') || 'Peru',
        trip_length: formData.get('trip_length') || '',
        travel_date: formData.get('travel_date') || '',
        travelers: formData.get('travelers') || '',
        accommodation: formData.get('accommodation') || '',
        budget: formData.get('budget') || '',
        notes: formData.get('notes') || '',
        source: 'Homepage Bespoke Planner'
    };

    fetch((window.API_BASE || '/api') + '/leads', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(json => {
        if (json.success) {
            feedback.className = 'unu-lead-feedback success';
            feedback.innerHTML = `<strong>Thank you, ${payload.first_name}!</strong> Your bespoke inquiry has been received. Our private travel designers in Cusco will craft your personalized journey and contact you within 24 hours.`;
            feedback.style.display = 'block';
            form.reset();
            feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else {
            feedback.className = 'unu-lead-feedback error';
            feedback.innerHTML = '✕ ' + (json.error || 'There was an error submitting your request. Please try again.');
            feedback.style.display = 'block';
        }
    })
    .catch(err => {
        feedback.className = 'unu-lead-feedback error';
        feedback.innerHTML = '✕ Connection error. Please try again or reach out directly via WhatsApp.';
        feedback.style.display = 'block';
    })
    .finally(() => {
        btn.disabled = false;
        btn.textContent = originalText;
    });
}
</script>

<?php
include __DIR__ . '/includes/footer.php';
?>
