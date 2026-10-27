<?php
/**
 * Unu Raymi - Tour Subpage View
 * Replicates Kuoda Travel's full-width editorial standard:
 * 1. Adaptive 100vh Hero Banner with background image & breadcrumbs
 * 2. Route Bar and Overview headline
 * 3. Highlights in clean 2-column bulleted grid
 * 4. Interactive day-by-day itinerary accordion with photos
 * 5. Lead form with immediate assignment to Cusco designers
 * 6. Price & Inclusions 3-column breakdown
 * 7. Guest reviews & sustainability pillars
 * 8. Related sample itineraries carousel
 */

require_once __DIR__ . '/includes/db-loader.php';

$slug = $_GET['slug'] ?? '';
$tour = DB::getBySlug('tours', $slug);

if (!$tour) {
    http_response_code(404);
    $page_title = 'Tour Not Found | Unu Raymi';
    include __DIR__ . '/includes/header.php';
    echo '<div class="container" style="padding: 120px 20px; text-align: center;">
            <h1 style="font-family: var(--font-serif); font-size: 36px; margin-bottom: 20px;">Tour Not Found</h1>
            <p style="color: var(--text-secondary); margin-bottom: 30px;">The requested itinerary does not exist or has been relocated.</p>
            <a href="/tours" class="btn-hero-gold">Return to Tours Catalog</a>
          </div>';
    include __DIR__ . '/includes/footer.php';
    exit;
}

$daysCount = (int)($tour['duration_days'] ?? 8);
$nightsCount = max(1, $daysCount - 1);
$countryCode = strtolower($tour['country'] ?? 'peru');

$countryNames = [
    'peru' => 'Peru',
    'chile' => 'Chile',
    'bolivia' => 'Bolivia',
    'argentina' => 'Argentina',
    'ecuador' => 'Ecuador',
    'colombia' => 'Colombia'
];
$countryFlags = [
    'peru' => '🇵🇪',
    'chile' => '🇨🇱',
    'bolivia' => '🇧🇴',
    'argentina' => '🇦🇷',
    'ecuador' => '🇪🇨',
    'colombia' => '🇨🇴'
];

$countryName = $countryNames[$countryCode] ?? ucfirst($countryCode);
$countryFlag = $countryFlags[$countryCode] ?? '✦';

$page_title = htmlspecialchars($tour['title']) . ' | Unu Raymi Luxury Travel';
$meta_desc = htmlspecialchars(substr(strip_tags($tour['overview'] ?? $tour['tagline'] ?? ''), 0, 155)) . '...';
$current_page = 'tour-detail';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER (Kuoda Travel 100vh Standard) -->
<section class="tour-kuoda-hero content__banner" style="background-image: url('<?php echo htmlspecialchars($tour['hero_image'] ?? $tour['card_image'] ?? '/assets/img/tours/Luxury-Machu-Picchu-Tours.webp'); ?>');">
    <div class="tour-kuoda-hero-inner content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="subpage-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <a href="/tours">Tours &amp; Itineraries</a>
            <span class="separator">/</span>
            <a href="/tours?country=<?php echo strtolower($tour['country'] ?? 'peru'); ?>"><?php echo $countryFlag . ' ' . $countryName; ?></a>
            <span class="separator">/</span>
            <span class="active"><?php echo htmlspecialchars($tour['title']); ?></span>
        </div>

        <div class="tour-kuoda-badge">
            <span><?php echo $countryFlag; ?> <?php echo strtoupper($countryName); ?> ✦ <?php echo $daysCount; ?> DAYS / <?php echo $nightsCount; ?> NIGHTS ✦ 100% PRIVATE SERVICE</span>
        </div>

        <h1 class="tour-kuoda-title"><?php echo htmlspecialchars($tour['title']); ?></h1>
        <h2 class="subpage-hero-h2"><?php echo htmlspecialchars($tour['overview_headline'] ?? 'Unveiling South America’s Timeless Wonders'); ?></h2>

        <?php if (!empty($tour['route']) && is_array($tour['route'])): ?>
            <p class="subpage-hero-subtitle" style="margin-bottom: 24px;">
                <?php echo htmlspecialchars(implode(' • ', $tour['route'])); ?>
            </p>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="subpage-hero-actions">
            <a href="#lead-form-section" class="btn-hero-gold">
                Plan My Custom Trip
            </a>
            <a href="#itinerary-section" class="btn-hero-outline">
                View Day-by-Day Itinerary ↓
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#tour-overview" class="content__banner__next" aria-label="Scroll down to overview">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. OVERVIEW & DESTINATIONS ROUTE (Kuoda Standard) -->
<section class="tour-section tour-overview-section" id="tour-overview">
    <div class="tour-narrow-container">
        <h2 class="sub__title text-center"><?php echo htmlspecialchars($tour['overview_headline'] ?? 'Unveiling South America’s Timeless Wonders'); ?></h2>

        <?php if (!empty($tour['route']) && is_array($tour['route'])): ?>
            <div class="tour-route-bar text-center">
                <?php foreach ($tour['route'] as $i => $city): ?>
                    <span class="tour-route-point"><?php echo htmlspecialchars($city); ?></span>
                    <?php if ($i < count($tour['route']) - 1): ?>
                        <span class="tour-route-sep">•</span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($tour['overview_lead'])): ?>
            <div class="tour-overview-lead">
                <?php echo htmlspecialchars($tour['overview_lead']); ?>
            </div>
        <?php endif; ?>

        <div class="tour-overview-body">
            <?php 
            $overviewText = $tour['overview'] ?? '';
            if (!empty($tour['overview_lead']) && str_starts_with($overviewText, $tour['overview_lead'])) {
                $overviewText = trim(substr($overviewText, strlen($tour['overview_lead'])));
            }
            echo nl2br(htmlspecialchars($overviewText));
            ?>
        </div>
    </div>
</section>

<!-- 4. HIGHLIGHTS (Kuoda 2-Column Grid) -->
<?php if (!empty($tour['highlights']) && is_array($tour['highlights'])): ?>
<section class="tour-section tour-highlights-section">
    <div class="tour-narrow-container">
        <h2 class="sub__title text-center">Highlights</h2>

        <div class="tour-highlights-grid">
            <?php foreach ($tour['highlights'] as $hl): ?>
                <div class="tour-highlight-item">
                    <span class="tour-highlight-dot">✦</span>
                    <p><?php echo htmlspecialchars($hl); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 5. ITINERARY (Interactive Accordion Matching Kuoda vc_tta-accordion) -->
<?php if (!empty($tour['itinerary']) && is_array($tour['itinerary'])): ?>
<section id="itinerary-section" class="tour-section tour-itinerary-section">
    <div class="tour-narrow-container">
        <div class="itinerary-header-row">
            <h2 class="sub__title text-center" style="margin-bottom:0;">Itinerary</h2>
            <button type="button" class="btn-text-gold" id="toggle-all-days-btn" onclick="toggleAllDays()">
                Expand All Days
            </button>
        </div>

        <div class="tour-accordion-container" id="tour-accordion">
            <?php foreach ($tour['itinerary'] as $idx => $day): ?>
                <div class="tour-accordion-panel <?php echo ($idx === 0) ? 'active' : ''; ?>" id="accordion-day-<?php echo $idx; ?>">
                    <div class="tour-panel-heading" onclick="toggleDayAccordion(<?php echo $idx; ?>)">
                        <h4 class="tour-panel-title">
                            <span class="day-num-text"><?php echo htmlspecialchars($day['title'] ?? 'DAY ' . ($idx + 1)); ?></span>
                            <span class="panel-icon"><?php echo ($idx === 0) ? '−' : '+'; ?></span>
                        </h4>
                    </div>
                    <div class="tour-panel-body">
                        <div class="tour-day-layout">
                            <?php if (!empty($day['image'])): ?>
                                <div class="tour-day-image">
                                    <img decoding="async" src="<?php echo htmlspecialchars($day['image']); ?>" alt="<?php echo htmlspecialchars($day['title'] ?? ''); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="tour-day-text <?php echo empty($day['image']) ? 'full-width' : ''; ?>">
                                <?php if (!empty($day['subtitle'])): ?>
                                    <h4 class="tour-day-subtitle"><?php echo htmlspecialchars($day['subtitle']); ?></h4>
                                <?php endif; ?>
                                <div class="tour-day-narrative">
                                    <?php echo nl2br(htmlspecialchars($day['description'] ?? '')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 6. LEAD CAPTURE SECTION ("Your Trip Begins Here" - Kuoda Standard) -->
<section id="lead-form-section" class="tour-section tour-lead-section">
    <div class="tour-narrow-container">
        <h2 class="sub__title text-center">Your Trip Begins Here</h2>
        <p class="text-center tour-form-lead-p">
            Each journey is 100% handcrafted by our luxury travel specialists. Share your details to receive your personalized proposal within 24 hours.
        </p>

        <form class="tour-inquiry-form" id="tour-detail-lead-form" onsubmit="submitTourDetailLead(event)">
            <input type="hidden" name="tour_name" value="<?php echo htmlspecialchars($tour['title']); ?>">
            <input type="hidden" name="destination" value="<?php echo htmlspecialchars($countryName); ?>">

            <div class="form-row-2">
                <div class="form-group-field">
                    <label>Destination or Tour of Interest</label>
                    <input type="text" name="tour_interest" readonly value="<?php echo htmlspecialchars($tour['title']); ?> (<?php echo $countryName; ?>)">
                </div>
                <div class="form-group-field">
                    <label>When would you like to travel?</label>
                    <input type="text" name="travel_date" placeholder="e.g. October 2026 / Flexible">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group-field">
                    <label>First &amp; Last Name *</label>
                    <input type="text" name="first_name" required placeholder="e.g. Eleanor Vance">
                </div>
                <div class="form-group-field">
                    <label>Email Address *</label>
                    <input type="email" name="email" required placeholder="eleanor@example.com">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group-field">
                    <label>Phone Number / WhatsApp *</label>
                    <input type="tel" name="phone" required placeholder="+1 (555) 000-0000">
                </div>
                <div class="form-group-field">
                    <label>Number of Travelers</label>
                    <select name="travelers">
                        <option value="1 traveler">1 traveler (Solo Travel)</option>
                        <option value="2 travelers" selected>2 travelers (Couple)</option>
                        <option value="3-4 travelers">3-4 travelers (Family / Friends)</option>
                        <option value="5+ travelers">5+ travelers (Private Group)</option>
                    </select>
                </div>
            </div>

            <div class="form-group-field">
                <label>Special Requests or Accommodation Preferences</label>
                <textarea name="notes" rows="3" placeholder="Culinary interests, anniversary celebrations, preferred pace, or room preferences..."></textarea>
            </div>

            <div class="text-center" style="margin-top: 24px;">
                <button type="submit" class="cta-button" style="padding: 16px 48px; font-size: 13px;">
                    Request Private Proposal &amp; Quote →
                </button>
            </div>

            <div class="tour-lead-feedback" id="tour-lead-feedback"></div>
        </form>
    </div>
</section>

<!-- 7. PRICE & INCLUSIONS (Kuoda 3-Column Standard) -->
<section class="tour-section tour-price-section">
    <div class="tour-narrow-container">
        <h2 class="sub__title text-center">Price &amp; Inclusions</h2>
        <p class="text-center" style="color: #44313A; max-width: 800px; margin: 0 auto 12px; line-height: 1.7; font-size: 14.5px;">
            Each journey is tailored to your specific needs and desires, and so our prices vary depending on the number of people traveling, level of accommodations desired, and activities included, among other factors.
        </p>
        <p class="text-center" style="color: #44313A; max-width: 800px; margin: 0 auto 40px; line-height: 1.7; font-size: 14.5px;">
            Our travel designers will curate a journey specifically for you. If you have a budget you want us to work with, please let us know, and we will do our best to achieve it.
        </p>

        <div class="tour-price-grid">
            <!-- Col 1: PRICE INCLUDES -->
            <div class="tour-price-col includes">
                <h3>PRICE INCLUDES</h3>
                <ul>
                    <?php if (!empty($tour['inclusions']) && is_array($tour['inclusions'])): ?>
                        <?php foreach ($tour['inclusions'] as $inc): ?>
                            <li><?php echo htmlspecialchars($inc); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Personalized itinerary planning</li>
                        <li>An Unu Raymi host to assist you in every location</li>
                        <li>The majority of meals in the itinerary</li>
                        <li>Daily activities and excursions as indicated in the itinerary</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Col 2: NOT INCLUDED -->
            <div class="tour-price-col not__includes">
                <h3>NOT INCLUDED</h3>
                <ul>
                    <?php if (!empty($tour['exclusions']) && is_array($tour['exclusions'])): ?>
                        <?php foreach ($tour['exclusions'] as $exc): ?>
                            <li><?php echo htmlspecialchars($exc); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>International flights to and from your home country</li>
                        <li>Travel insurance</li>
                        <li>Meals not specified</li>
                        <li>All gratuities</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Col 3: ACCOMMODATIONS -->
            <div class="tour-price-col accommodations">
                <h3>ACCOMMODATIONS</h3>
                <p>
                    <?php echo htmlspecialchars($tour['accommodations_text'] ?? "From luxury properties to boutique hotels, our staff handpicks your ideal stay to ensure you get the ultimate comfort during your travels."); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 8. REVIEWS SECTION (Check Our Reviews) -->
<section class="tour-section tour-reviews-section">
    <div class="tour-narrow-container">
        <h2 class="sub__title text-center">Check Our Reviews</h2>
        
        <div class="tour-reviews-grid">
            <div class="tour-review-card">
                <div class="review-stars">★★★★★</div>
                <p class="review-quote">
                    "My family of 4 used Unu Raymi for a two week trip to Peru. We're so glad we booked with them! The trip was smooth, seamless, and completely unforgettable. The guides and hosts were so helpful, knowledgeable, and kind."
                </p>
                <div class="review-author">Jeanne S. <span>| Jun. 2026</span></div>
            </div>

            <div class="tour-review-card">
                <div class="review-stars">★★★★★</div>
                <p class="review-quote">
                    "We highly recommend Unu Raymi; their 5.0-star reputation is definitely accurate. Their team curated every detail of our Machu Picchu and Sacred Valley journey to perfection, from the Hiram Bingham train to private hacienda visits."
                </p>
                <div class="review-author">David &amp; Sarah M. <span>| Sep. 2026</span></div>
            </div>

            <div class="tour-review-card">
                <div class="review-stars">★★★★★</div>
                <p class="review-quote">
                    "An exceptional experience from start to finish. Having a private concierge in Cusco gave us complete peace of mind, and the access to archaeological sites before crowds arrived was simply priceless."
                </p>
                <div class="review-author">Elena R. <span>| Oct. 2026</span></div>
            </div>
        </div>
    </div>
</section>

<!-- 9. SUSTAINABLE TRAVEL -->
<section class="tour-section tour-sustainable-section">
    <div class="tour-narrow-container">
        <h2 class="sub__title text-center">Sustainable Travel</h2>
        <p class="text-center" style="color: #44313A; max-width: 800px; margin: 0 auto 30px; font-size: 15px; line-height: 1.75;">
            With Unu Raymi, every step of your journey is guided by purpose and respect, creating a positive legacy for the places you explore and the people you meet. Together, we can travel with intention and make a lasting impact.
        </p>

        <div class="sustainable-pills-grid">
            <div class="sustainable-pill">
                <span class="icon">🌿</span>
                <strong>Environmental Stewardship</strong>
                <p>Active support for ecological preservation and reduced-carbon travel practices.</p>
            </div>
            <div class="sustainable-pill">
                <span class="icon">🍲</span>
                <strong>Organic Gastronomy</strong>
                <p>Meals crafted with fresh, locally sourced organic produce from Andean growers.</p>
            </div>
            <div class="sustainable-pill">
                <span class="icon">🤝</span>
                <strong>Heritage Communities</strong>
                <p>Direct, fair, and respectful partnerships with local master weavers and artisans.</p>
            </div>
        </div>
    </div>
</section>

<!-- 10. SAMPLE ITINERARIES (Kuoda Style) -->
<section class="tour-section tour-related-section">
    <div class="container">
        <p class="text-center textoh4" style="color: #9A6615; letter-spacing: 0.18em; font-size: 12px; margin-bottom: 8px;">MORE SAMPLE</p>
        <h2 class="sub__title text-center"><?php echo htmlspecialchars($countryName); ?> Itineraries</h2>

        <div class="carousel__itineraries" style="margin-top: 35px;">
            <?php
            $allTours = DB::getAll('tours');
            $related = array_filter($allTours, function($t) use ($tour) {
                return $t['id'] != $tour['id'] && ($t['country'] ?? '') === ($tour['country'] ?? '');
            });
            $related = array_slice($related, 0, 3);
            if (empty($related)) {
                $related = array_slice($allTours, 0, 3);
            }
            foreach ($related as $rel):
                $rDays = (int)($rel['duration_days'] ?? 8);
            ?>
                <div class="item">
                    <a class="item-img-link" href="/tour/<?php echo htmlspecialchars($rel['slug']); ?>">
                        <img decoding="async" src="<?php echo htmlspecialchars($rel['card_image'] ?? $rel['hero_image'] ?? '/assets/img/tours/Peru-Adventure-Tours.webp'); ?>" alt="<?php echo htmlspecialchars($rel['title']); ?>">
                    </a>
                    <div class="diascards"><?php echo $rDays; ?> DAYS</div>
                    <h4><?php echo htmlspecialchars($rel['title']); ?></h4>
                    <p class="tour-card-route">
                        <?php 
                        if (!empty($rel['route']) && is_array($rel['route'])) {
                            echo htmlspecialchars(implode(', ', array_slice($rel['route'], 0, 4)));
                        } else {
                            echo htmlspecialchars($rel['tagline'] ?? $countryName);
                        }
                        ?>
                    </p>
                    <div class="item-footer">
                        <a class="button__web__white" href="/tour/<?php echo htmlspecialchars($rel['slug']); ?>">
                            Discover →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
function toggleDayAccordion(idx) {
    const panel = document.getElementById('accordion-day-' + idx);
    if (!panel) return;
    const isActive = panel.classList.contains('active');
    panel.classList.toggle('active');
    const icon = panel.querySelector('.panel-icon');
    if (icon) {
        icon.textContent = isActive ? '+' : '−';
    }
}

let allDaysExpanded = false;
function toggleAllDays() {
    allDaysExpanded = !allDaysExpanded;
    const panels = document.querySelectorAll('.tour-accordion-panel');
    const btn = document.getElementById('toggle-all-days-btn');
    panels.forEach(p => {
        if (allDaysExpanded) {
            p.classList.add('active');
            const icon = p.querySelector('.panel-icon');
            if (icon) icon.textContent = '−';
        } else {
            p.classList.remove('active');
            const icon = p.querySelector('.panel-icon');
            if (icon) icon.textContent = '+';
        }
    });
    if (btn) {
        btn.textContent = allDaysExpanded ? 'Collapse All Days' : 'Expand All Days';
    }
}

function submitTourDetailLead(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const feedback = document.getElementById('tour-lead-feedback');
    const originalText = btn.textContent;

    btn.disabled = true;
    btn.textContent = 'Submitting Your Request...';
    feedback.innerHTML = '';

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    data.source = 'Tour Detail Page: ' + (data.tour_name || 'Generic');

    fetch((window.API_BASE || '/api') + '/leads', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(json => {
        if (json.success) {
            feedback.innerHTML = '<div style="color:#4ADE80; background:rgba(74,222,128,0.12); border:1px solid #4ADE80; padding:18px; border-radius:6px; font-size:13.5px; text-align:center; margin-top:16px;">✓ Thank you, ' + data.first_name + '! Your inquiry for <strong>' + data.tour_name + '</strong> has been received. Our senior travel designers in Cusco will review your preferences and contact you within 24 hours.</div>';
            form.reset();
        } else {
            feedback.innerHTML = '<div style="color:#F87171; background:rgba(248,113,113,0.12); border:1px solid #F87171; padding:14px; border-radius:6px; font-size:13px; margin-top:16px;">✕ ' + (json.error || 'Error submitting request. Please try again.') + '</div>';
        }
    })
    .catch(err => {
        feedback.innerHTML = '<div style="color:#F87171; background:rgba(248,113,113,0.12); border:1px solid #F87171; padding:14px; border-radius:6px; font-size:13px; margin-top:16px;">✕ Connection error. Please try again or reach out directly via WhatsApp.</div>';
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
