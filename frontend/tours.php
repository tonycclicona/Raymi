<?php
/**
 * Unu Raymi - Tours Catalog Dedicated Subpage
 * Features Carousel view, List/Grid view, Country & Category filters, and "Load More Tours" button
 */

require_once __DIR__ . '/../api/db.php';

$allTours = DB::getAll('tours');
$selectedCountry = strtolower($_GET['country'] ?? 'all');
$selectedCategory = $_GET['category'] ?? 'all';

$countryMeta = [
    'peru' => ['name' => 'Peru', 'flag' => '🇵🇪'],
    'chile' => ['name' => 'Chile', 'flag' => '🇨🇱'],
    'argentina' => ['name' => 'Argentina', 'flag' => '🇦🇷'],
    'bolivia' => ['name' => 'Bolivia', 'flag' => '🇧🇴'],
    'ecuador' => ['name' => 'Ecuador & Galapagos', 'flag' => '🇪🇨'],
    'colombia' => ['name' => 'Colombia', 'flag' => '🇨🇴']
];

$countryCounts = [
    'all' => count($allTours),
    'peru' => count(array_filter($allTours, fn($t) => strtolower($t['country'] ?? '') === 'peru')),
    'chile' => count(array_filter($allTours, fn($t) => strtolower($t['country'] ?? '') === 'chile')),
    'argentina' => count(array_filter($allTours, fn($t) => strtolower($t['country'] ?? '') === 'argentina')),
    'bolivia' => count(array_filter($allTours, fn($t) => strtolower($t['country'] ?? '') === 'bolivia')),
    'ecuador' => count(array_filter($allTours, fn($t) => strtolower($t['country'] ?? '') === 'ecuador')),
    'colombia' => count(array_filter($allTours, fn($t) => strtolower($t['country'] ?? '') === 'colombia'))
];

$page_title = 'Luxury Tours & Bespoke Itineraries in South America | Unu Raymi';
$meta_desc = 'Explore our exclusive collection of ' . count($allTours) . ' ultra-luxury itineraries in Peru, Chile, Argentina, Bolivia, Ecuador, and Colombia with dedicated 24/7 private host.';
$current_page = 'tours';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER (Kuoda Travel 100vh Standard) -->
<section class="subpage-hero content__banner" style="background-image: url('/assets/img/heroes/tours-catalog-hero.webp');">
    <div class="subpage-hero-content content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="subpage-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <span class="active">Tours &amp; Itineraries</span>
        </div>

        <span class="subpage-hero-tag">EXCLUSIVE COLLECTION ✦ DEDICATED 24/7 SERVICE</span>
        <h1 class="subpage-hero-title">Signature Itineraries in South America</h1>
        <p class="subpage-hero-subtitle">
            METICULOUSLY CRAFTED PRIVATE JOURNEYS FOR DISCERNING TRAVELERS WHO APPRECIATE QUIET LUXURY AND AUTHENTICITY
        </p>

        <!-- Action Buttons -->
        <div class="subpage-hero-actions">
            <a href="#tours-catalog" class="btn-hero-gold">
                View Collection
            </a>
            <a href="/custom-journey" class="btn-hero-outline">
                Design My Custom Journey →
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#tours-catalog" class="content__banner__next" aria-label="Scroll down to tours collection">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. TOURS CATALOG SECTION -->
<section class="section" id="tours-catalog" style="padding: 60px 0 20px; background: var(--bg-surface, #FAF8F5);">
    <div class="container text-center">
        <span class="section-tag">Collection by Destination</span>
        <h2 class="sub__title" style="margin-bottom: 14px;">Explore by Country or Region</h2>
        <p style="color: #666; max-width: 720px; margin: 0 auto 30px; font-size: 15px;">
            Select your destination of choice to filter our signature itineraries, or browse the complete collection in grid or carousel view.
        </p>

        <!-- Country Filter Tabs -->
        <div class="filter-tabs-bar" style="justify-content: center; margin-bottom: 25px;">
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'all') ? 'active' : ''; ?>" data-country="all" onclick="filterCatalogCountry('all')">
                🌎 All (<span id="cat-count-all"><?php echo $countryCounts['all']; ?></span>)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'peru') ? 'active' : ''; ?>" data-country="peru" onclick="filterCatalogCountry('peru')">
                🇵🇪 Peru (<?php echo $countryCounts['peru']; ?>)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'chile') ? 'active' : ''; ?>" data-country="chile" onclick="filterCatalogCountry('chile')">
                🇨🇱 Chile (<?php echo $countryCounts['chile']; ?>)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'argentina') ? 'active' : ''; ?>" data-country="argentina" onclick="filterCatalogCountry('argentina')">
                🇦🇷 Argentina (<?php echo $countryCounts['argentina']; ?>)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'bolivia') ? 'active' : ''; ?>" data-country="bolivia" onclick="filterCatalogCountry('bolivia')">
                🇧🇴 Bolivia (<?php echo $countryCounts['bolivia']; ?>)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'ecuador') ? 'active' : ''; ?>" data-country="ecuador" onclick="filterCatalogCountry('ecuador')">
                🇪🇨 Ecuador (<?php echo $countryCounts['ecuador']; ?>)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'colombia') ? 'active' : ''; ?>" data-country="colombia" onclick="filterCatalogCountry('colombia')">
                🇨🇴 Colombia (<?php echo $countryCounts['colombia']; ?>)
            </button>
        </div>
    </div>
</section>

<!-- Tours Catalog Listing -->
<section class="section" style="padding-top: 10px;">
    <div class="container">
        
        <!-- Controls Bar: View Switcher (Carousel vs Grid) and Category Filter -->
        <div class="catalog-controls-bar">
            <div class="category-selector-group">
                <label for="catalog-cat-select" style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em;">
                    Category:
                </label>
                <select id="catalog-cat-select" class="form-control" style="width: auto; padding: 6px 14px; font-size: 13px;" onchange="filterCatalogCategory(this.value)">
                    <option value="all">All Categories</option>
                    <option value="Lujo">Iconic Luxury</option>
                    <option value="Aventura">Adventure &amp; Treks</option>
                    <option value="Gastronomía">Gastronomy &amp; Wine</option>
                    <option value="Romance">Romance &amp; Honeymoon</option>
                    <option value="Familia">Family Expeditions</option>
                </select>
            </div>

            <!-- View Switcher -->
            <div class="view-mode-switcher">
                <span style="font-size: 12px; color: var(--text-muted); margin-right: 8px;">View Mode:</span>
                <button type="button" class="view-mode-btn active" id="btn-view-grid" onclick="switchViewMode('grid')" title="Grid View">
                    ▦ Grid
                </button>
                <button type="button" class="view-mode-btn" id="btn-view-carousel" onclick="switchViewMode('carousel')" title="Carousel View">
                    🎠 Carousel
                </button>
            </div>
        </div>

        <!-- 1. CAROUSEL VIEW CONTAINER -->
        <div class="carousel-view-wrapper" id="carousel-wrapper" style="display: none;">
            <div class="carousel-nav-arrows">
                <button type="button" class="carousel-arrow prev" onclick="slideCarousel(-1)">‹</button>
                <button type="button" class="carousel-arrow next" onclick="slideCarousel(1)">›</button>
            </div>
            <div class="carousel-track-container" id="carousel-track">
                <?php foreach ($allTours as $t): 
                    $tCountryKey = strtolower($t['country'] ?? 'peru');
                    $tourImg = $t['card_image'] ?? $t['hero_image'] ?? $t['image'] ?? '/assets/img/tours/machu-picchu-luxury-travel.webp';
                ?>
                    <div class="carousel-slide-item tour-item-card" data-country="<?php echo $tCountryKey; ?>" data-category="<?php echo htmlspecialchars($t['category'] ?? ''); ?>">
                        <a href="/tour/<?php echo htmlspecialchars($t['slug']); ?>" class="tour-card" title="<?php echo htmlspecialchars($t['title']); ?>">
                            <div class="tour-card-image" style="background-image: url('<?php echo htmlspecialchars($tourImg); ?>');"></div>
                            <div class="tour-card-overlay"></div>
                            <div class="tour-card-content">
                                <h3 class="tour-card-title"><?php echo htmlspecialchars($t['title']); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 2. GRID / LIST VIEW CONTAINER -->
        <div class="tours-grid" id="catalog-grid">
            <?php foreach ($allTours as $index => $t): 
                $tCountryKey = strtolower($t['country'] ?? 'peru');
                $tourImg = $t['card_image'] ?? $t['hero_image'] ?? $t['image'] ?? '/assets/img/tours/machu-picchu-luxury-travel.webp';
                // Initially show first 9 tours; rest hidden until "Load More"
                $initialHidden = ($index >= 9);
            ?>
                <a href="/tour/<?php echo htmlspecialchars($t['slug']); ?>" 
                   class="tour-card tour-item-card <?php echo $initialHidden ? 'initially-hidden' : ''; ?>" 
                   data-country="<?php echo $tCountryKey; ?>" 
                   data-category="<?php echo htmlspecialchars($t['category'] ?? ''); ?>" 
                   title="<?php echo htmlspecialchars($t['title']); ?>"
                   style="<?php echo $initialHidden ? 'display: none;' : ''; ?>">
                    <div class="tour-card-image" style="background-image: url('<?php echo htmlspecialchars($tourImg); ?>');"></div>
                    <div class="tour-card-overlay"></div>
                    <div class="tour-card-content">
                        <h3 class="tour-card-title"><?php echo htmlspecialchars($t['title']); ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- "Load More Tours" Button Container -->
        <div class="load-more-container" id="load-more-box" style="text-align: center; margin-top: 48px;">
            <p id="tours-showing-counter" style="color: var(--text-muted); font-size: 13px; margin-bottom: 16px;">
                Showing <span id="current-visible-count">9</span> of <span id="total-matching-count"><?php echo count($allTours); ?></span> itineraries
            </p>
            <button type="button" class="btn-outline-gold" id="load-more-btn" onclick="loadMoreTours()" style="padding: 14px 36px; font-size: 12px; letter-spacing: 0.15em;">
                ⬇ Load More Tours
            </button>
        </div>

    </div>
</section>

<!-- Custom Tailor-Made Journey Callout -->
<section class="section" style="background: linear-gradient(180deg, rgba(17,22,34,0.6) 0%, rgba(9,12,17,0.95) 100%); border-top: 1px solid var(--border); text-align: center;">
    <div class="container" style="max-width: 800px;">
        <span class="section-tag">Looking for something completely unique?</span>
        <h2 class="section-title" style="margin-bottom: 16px;">Design Your 100% Tailor-Made Journey</h2>
        <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: 28px;">
            None of our itineraries are set in stone. Our expert designers in Cusco craft journeys completely tailored to your personal dreams, pace, and dates.
        </p>
        <a href="/custom-journey" class="cta-button" style="padding: 16px 36px; font-size: 12px;">
            Start Planning with a Private Concierge ↗
        </a>
    </div>
</section>

<script>
let activeCountry = '<?php echo $selectedCountry; ?>';
let activeCategory = '<?php echo $selectedCategory; ?>';
let currentBatch = 9;
const batchStep = 6;

function filterCatalogCountry(country) {
    activeCountry = country;
    document.querySelectorAll('.filter-tabs-bar .filter-pill').forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-country') === country);
    });
    
    // Update URL query parameter cleanly without reloading
    const newUrl = new URL(window.location.href);
    if (country === 'all') {
        newUrl.searchParams.delete('country');
    } else {
        newUrl.searchParams.set('country', country);
    }
    window.history.replaceState({}, '', newUrl);

    applyFilters();
}

function filterCatalogCategory(category) {
    activeCategory = category;
    
    const newUrl = new URL(window.location.href);
    if (category === 'all') {
        newUrl.searchParams.delete('category');
    } else {
        newUrl.searchParams.set('category', category);
    }
    window.history.replaceState({}, '', newUrl);

    applyFilters();
}

function applyFilters() {
    const gridCards = document.querySelectorAll('#catalog-grid .tour-item-card');
    const carouselCards = document.querySelectorAll('#carousel-track .tour-item-card');
    
    // 1. Filter Carousel Cards
    carouselCards.forEach(card => {
        const cCountry = card.getAttribute('data-country');
        const cCat = card.getAttribute('data-category') || '';
        const matchCountry = (activeCountry === 'all' || cCountry === activeCountry);
        const matchCat = (activeCategory === 'all' || cCat.toLowerCase().includes(activeCategory.toLowerCase()));
        card.style.display = (matchCountry && matchCat) ? 'block' : 'none';
    });

    // 2. Filter Grid Cards with pagination
    let matchingGrid = [];
    gridCards.forEach(card => {
        const cCountry = card.getAttribute('data-country');
        const cCat = card.getAttribute('data-category') || '';
        const matchCountry = (activeCountry === 'all' || cCountry === activeCountry);
        const matchCat = (activeCategory === 'all' || cCat.toLowerCase().includes(activeCategory.toLowerCase()));

        if (matchCountry && matchCat) {
            matchingGrid.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    const isCarousel = document.getElementById('carousel-wrapper').style.display !== 'none';
    if (!isCarousel) {
        currentBatch = 9;
        matchingGrid.forEach((card, idx) => {
            if (idx < currentBatch) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });

        const loadMoreBox = document.getElementById('load-more-box');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const visibleCount = Math.min(currentBatch, matchingGrid.length);
        document.getElementById('current-visible-count').textContent = visibleCount;
        document.getElementById('total-matching-count').textContent = matchingGrid.length;

        if (visibleCount >= matchingGrid.length) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'inline-block';
        }
    }
}

function loadMoreTours() {
    currentBatch += batchStep;
    const gridCards = document.querySelectorAll('#catalog-grid .tour-item-card');
    let matchingGrid = [];
    gridCards.forEach(card => {
        const cCountry = card.getAttribute('data-country');
        const cCat = card.getAttribute('data-category') || '';
        const matchCountry = (activeCountry === 'all' || cCountry === activeCountry);
        const matchCat = (activeCategory === 'all' || cCat.toLowerCase().includes(activeCategory.toLowerCase()));
        if (matchCountry && matchCat) {
            matchingGrid.push(card);
        }
    });

    matchingGrid.forEach((card, idx) => {
        if (idx < currentBatch) {
            card.style.display = 'flex';
        }
    });

    const visibleCount = Math.min(currentBatch, matchingGrid.length);
    document.getElementById('current-visible-count').textContent = visibleCount;
    if (visibleCount >= matchingGrid.length) {
        document.getElementById('load-more-btn').style.display = 'none';
    }
}

function switchViewMode(mode) {
    const grid = document.getElementById('catalog-grid');
    const carousel = document.getElementById('carousel-wrapper');
    const loadMoreBox = document.getElementById('load-more-box');
    const btnGrid = document.getElementById('btn-view-grid');
    const btnCarousel = document.getElementById('btn-view-carousel');

    if (mode === 'carousel') {
        grid.style.display = 'none';
        loadMoreBox.style.display = 'none';
        carousel.style.display = 'block';
        btnGrid.classList.remove('active');
        btnCarousel.classList.add('active');
    } else {
        carousel.style.display = 'none';
        grid.style.display = 'grid';
        loadMoreBox.style.display = 'block';
        btnGrid.classList.add('active');
        btnCarousel.classList.remove('active');
    }
    applyFilters();
}

let carouselOffset = 0;
function slideCarousel(direction) {
    const track = document.getElementById('carousel-track');
    const visibleCards = track.querySelectorAll('.carousel-slide-item:not([style*="display: none"])');
    if (visibleCards.length === 0) return;

    const cardWidth = visibleCards[0].offsetWidth + 24; // width + gap
    const maxOffset = Math.max(0, (visibleCards.length * cardWidth) - track.parentElement.offsetWidth);
    
    carouselOffset += direction * cardWidth * 2;
    if (carouselOffset < 0) carouselOffset = 0;
    if (carouselOffset > maxOffset) carouselOffset = maxOffset;
    
    track.style.transform = `translateX(-${carouselOffset}px)`;
}

document.addEventListener('DOMContentLoaded', () => {
    applyFilters();
});
</script>

<?php
include __DIR__ . '/includes/footer.php';
?>
