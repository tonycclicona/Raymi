<?php
/**
 * Unu Raymi - Geographic Destination Subpage Dedicated View
 * Full standalone, SEO-rich luxury subpage
 */

require_once __DIR__ . '/includes/db-loader.php';

$slug = $_GET['slug'] ?? '';
$dest = null;

if (!empty($slug)) {
    $dest = DB::getBySlug('destinations', $slug);
    if (!$dest && is_numeric($slug)) {
        $dest = DB::getById('destinations', (int)$slug);
    }
}

if (!$dest) {
    http_response_code(404);
    $page_title = 'Destination Not Found | Unu Raymi';
    $current_page = 'destinations';
    include __DIR__ . '/includes/header.php';
    ?>
    <section class="section" style="padding: 160px 0 100px; text-align: center;">
        <div class="container">
            <span class="section-tag">404</span>
            <h1 class="section-title">Destination Not Found</h1>
            <p style="color: var(--text-secondary); max-width: 500px; margin: 0 auto 30px;">
                The requested destination was not found in our active records. We invite you to explore our full collection of destinations.
            </p>
            <a href="/destinations" class="cta-button">View All Destinations (25+) →</a>
        </div>
    </section>
    <?php
    include __DIR__ . '/includes/footer.php';
    exit;
}

$countryName = (strtolower($dest['country'] ?? '') === 'chile') ? 'Chile' : ((strtolower($dest['country'] ?? '') === 'peru') ? 'Peru' : ucfirst($dest['country'] ?? 'Peru'));
$countryFlag = (strtolower($dest['country'] ?? '') === 'chile') ? '🇨🇱' : '🇵🇪';

$page_title = "{$dest['name']} - Luxury Travel Guide & Private Journeys | Unu Raymi";
$meta_desc = substr(strip_tags($dest['excerpt'] ?? "Discover {$dest['name']} in {$countryName} with Unu Raymi's ultra-luxury private travel curation."), 0, 155) . '...';
$current_page = 'destinations';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER -->
<section class="subpage-hero tour-detail-hero content__banner" style="background-image: url('<?php echo htmlspecialchars($dest['image'] ?? 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=2000&q=80'); ?>');">
    <div class="subpage-hero-content content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="subpage-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <a href="/destinations">Destinations</a>
            <span class="separator">/</span>
            <a href="/destinations/<?php echo strtolower($dest['country'] ?? 'peru'); ?>"><?php echo $countryFlag . ' ' . $countryName; ?></a>
            <span class="separator">/</span>
            <span class="active"><?php echo htmlspecialchars($dest['name']); ?></span>
        </div>

        <div class="subpage-hero-tag">
            <span><?php echo $countryFlag . ' ' . strtoupper($countryName); ?> ✦ EXCLUSIVE TERRITORY</span>
        </div>

        <h1 class="subpage-hero-title"><?php echo htmlspecialchars($dest['name']); ?></h1>
        <p class="subpage-hero-subtitle">
            <?php echo htmlspecialchars($dest['subtitle'] ?? "A land of mysticism, pristine nature, and warm Andean hospitality."); ?>
        </p>

        <!-- Hero Action Buttons -->
        <div class="subpage-hero-actions">
            <a href="#destination-details" class="btn-hero-gold">
                Explore Private Guide
            </a>
            <a href="/contact?destination=<?php echo urlencode($dest['name']); ?>" class="btn-hero-outline">
                Design Journey to <?php echo htmlspecialchars($dest['name']); ?> →
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#destination-details" class="content__banner__next" aria-label="Scroll to guide">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. DESTINATION MAIN CONTENT & SIDEBAR -->
<section class="section tour-body-section" id="destination-details">
    <div class="container">
        <div class="tour-layout-grid">
            
            <!-- Left Main Column -->
            <div class="tour-main-content">
                
                <!-- Storytelling & Editorial Excerpt -->
                <div class="tour-block">
                    <span class="section-tag">Essence of Destination</span>
                    <h2 class="block-title">The Soul of <?php echo htmlspecialchars($dest['name']); ?></h2>
                    <div class="tour-narrative">
                        <?php echo nl2br(htmlspecialchars($dest['excerpt'] ?? '')); ?>
                    </div>
                </div>

                <!-- Highlights & Insider Experiences -->
                <?php if (!empty($dest['highlights']) && is_array($dest['highlights'])): ?>
                    <div class="tour-block">
                        <span class="section-tag">Curated Experiences</span>
                        <h2 class="block-title">Unforgettable Moments in <?php echo htmlspecialchars($dest['name']); ?></h2>
                        <div class="highlights-grid">
                            <?php foreach ($dest['highlights'] as $highlight): ?>
                                <div class="highlight-card">
                                    <span class="highlight-bullet">✦</span>
                                    <p><?php echo htmlspecialchars($highlight); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Recommended Tours that visit this destination -->
                <div class="tour-block">
                    <span class="section-tag">Signature Itineraries</span>
                    <h2 class="block-title">Tours Featuring <?php echo htmlspecialchars($dest['name']); ?></h2>
                    
                    <div class="tours-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 20px;">
                        <?php
                        $allTours = DB::getAll('tours');
                        $destSlug = $dest['slug'] ?? '';
                        $destNameLower = strtolower($dest['name'] ?? '');
                        
                        // Match tours that mention this destination in slug, title, or overview
                        $matchedTours = array_filter($allTours, function($t) use ($destSlug, $destNameLower, $dest) {
                            $matchesName = stripos($t['title'] ?? '', $destNameLower) !== false;
                            $matchesOverview = stripos($t['overview'] ?? '', $destNameLower) !== false;
                            $sameCountry = strtolower($t['country'] ?? '') === strtolower($dest['country'] ?? '');
                            return $matchesName || ($sameCountry && $matchesOverview);
                        });

                        if (empty($matchedTours)) {
                            // Fallback to tours of the same country
                            $matchedTours = array_filter($allTours, function($t) use ($dest) {
                                return strtolower($t['country'] ?? '') === strtolower($dest['country'] ?? '');
                            });
                        }

                        $matchedTours = array_slice($matchedTours, 0, 4);

                        foreach ($matchedTours as $tourItem):
                            $tourImg = $tourItem['card_image'] ?? $tourItem['hero_image'] ?? $tourItem['image'] ?? '/assets/img/tours/machu-picchu-luxury-travel.webp';
                        ?>
                            <a href="/tour/<?php echo htmlspecialchars($tourItem['slug']); ?>" class="tour-card" style="margin-bottom:0; height: 320px;" title="<?php echo htmlspecialchars($tourItem['title']); ?>">
                                <div class="tour-card-image" style="background-image: url('<?php echo htmlspecialchars($tourImg); ?>');"></div>
                                <div class="tour-card-overlay"></div>
                                <div class="tour-card-content">
                                    <h3 class="tour-card-title" style="font-size: 17px;"><?php echo htmlspecialchars($tourItem['title']); ?></h3>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <!-- Right Sticky Sidebar Column (Custom Destination Trip Request) -->
            <aside class="tour-sidebar">
                <div class="sticky-booking-card">
                    <div class="booking-card-header">
                        <span class="booking-eyebrow">✦ Plan Your Visit</span>
                        <h3 class="booking-tour-name">Include <?php echo htmlspecialchars($dest['name']); ?> in Your Journey</h3>
                        <div class="booking-pricing-notice">
                            Our bespoke journey designers will handcraft an itinerary around your personal passions.
                        </div>
                    </div>

                    <form class="sidebar-lead-form" onsubmit="submitSidebarTourLead(event)">
                        <input type="hidden" name="destination" value="<?php echo htmlspecialchars($dest['name'] . ', ' . $countryName); ?>">
                        <input type="hidden" name="source" value="Destination Subpage: <?php echo htmlspecialchars($dest['name']); ?>">

                        <div class="form-group-sm">
                            <label>Full Name *</label>
                            <input type="text" name="first_name" required placeholder="e.g., Eleanor Vance">
                        </div>

                        <div class="form-group-sm">
                            <label>Email Address *</label>
                            <input type="email" name="email" required placeholder="eleanor@example.com">
                        </div>

                        <div class="form-group-sm">
                            <label>WhatsApp / Phone</label>
                            <input type="tel" name="phone" placeholder="+1 (555) 000-0000">
                        </div>

                        <div class="form-row-sm">
                            <div class="form-group-sm">
                                <label>Travelers</label>
                                <select name="travelers">
                                    <option value="1 traveler">1 traveler</option>
                                    <option value="2 travelers" selected>2 travelers</option>
                                    <option value="3-4 travelers">3-4 travelers</option>
                                    <option value="5+ travelers">5+ travelers</option>
                                </select>
                            </div>
                            <div class="form-group-sm">
                                <label>Estimated Days</label>
                                <input type="text" name="trip_length" placeholder="e.g., 10 days">
                            </div>
                        </div>

                        <div class="form-group-sm">
                            <label>Notes / Places to combine</label>
                            <textarea name="notes" rows="2" placeholder="I would love to combine with Machu Picchu and the Uyuni Salt Flats..."></textarea>
                        </div>

                        <button type="submit" class="cta-button" style="width:100%; padding:14px; font-size:12px; margin-top:8px;">
                            Design Custom Route ↗
                        </button>

                        <div class="sidebar-form-feedback" id="sidebar-feedback"></div>
                    </form>

                    <div class="trust-guarantees">
                        <div class="trust-guarantee-item">
                            <span class="icon">✨</span>
                            <div>
                                <strong>Private Archaeological Access</strong>
                                <span>Permits and visits outside regular public hours</span>
                            </div>
                        </div>
                        <div class="trust-guarantee-item">
                            <span class="icon">🛎️</span>
                            <div>
                                <strong>Impeccable Logistics</strong>
                                <span>Private Mercedes-Benz fleet & VIP scenic trains</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>

<!-- Explore Other Destinations -->
<section class="section" style="background: rgba(0,0,0,0.25); border-top: 1px solid var(--border);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Other Territories</span>
            <h2 class="section-title">Explore More Destinations in <?php echo $countryName; ?></h2>
        </div>

        <div class="destinations-grid" style="margin-top: 30px;">
            <?php
            $allDests = DB::getAll('destinations');
            $otherDests = array_filter($allDests, function($d) use ($dest) {
                return $d['id'] != $dest['id'] && ($d['country'] ?? '') === ($dest['country'] ?? '');
            });
            $otherDests = array_slice($otherDests, 0, 3);
            foreach ($otherDests as $od):
            ?>
                <div class="destination-card" style="background-image: linear-gradient(180deg, rgba(9,12,17,0.2) 0%, rgba(9,12,17,0.9) 100%), url('<?php echo htmlspecialchars($od['image'] ?? ''); ?>');">
                    <div class="destination-card-content">
                        <span class="destination-card-country"><?php echo strtoupper($od['country'] ?? ''); ?></span>
                        <h3 class="destination-card-title"><?php echo htmlspecialchars($od['name']); ?></h3>
                        <p class="destination-card-subtitle"><?php echo htmlspecialchars($od['subtitle'] ?? ''); ?></p>
                        <a href="/destination/<?php echo htmlspecialchars($od['slug']); ?>" class="cta-button" style="display:inline-block; padding:8px 14px; font-size:10px; margin-top:10px;">
                            Explore Destination →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
function submitSidebarTourLead(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const feedback = document.getElementById('sidebar-feedback');
    const originalText = btn.textContent;

    btn.disabled = true;
    btn.textContent = 'Submitting Request...';
    feedback.innerHTML = '';

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    fetch((window.API_BASE || '/api') + '/leads', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(json => {
        if (json.success) {
            feedback.innerHTML = '<div style="color:#4ADE80; background:rgba(74,222,128,0.1); border:1px solid #4ADE80; padding:10px; border-radius:6px; font-size:12px; margin-top:12px;">✓ Request received! A private luxury designer will contact you within 24 hours.</div>';
            form.reset();
        } else {
            feedback.innerHTML = '<div style="color:#F87171; background:rgba(248,113,113,0.1); border:1px solid #F87171; padding:10px; border-radius:6px; font-size:12px; margin-top:12px;">✕ ' + (json.error || 'Error submitting request') + '</div>';
        }
    })
    .catch(err => {
        feedback.innerHTML = '<div style="color:#F87171; background:rgba(248,113,113,0.1); border:1px solid #F87171; padding:10px; border-radius:6px; font-size:12px; margin-top:12px;">✕ Network error. Please try again.</div>';
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
