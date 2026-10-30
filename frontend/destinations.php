<?php
/**
 * Unu Raymi - Destinations Catalog Dedicated Subpage
 */

require_once __DIR__ . '/includes/db-loader.php';

$allDests = DB::getAll('destinations');
$selectedCountry = strtolower($_GET['country'] ?? 'all');

$page_title = 'Geographic Destinations in South America | Unu Raymi Luxury Travel';
$meta_desc = 'Discover the most iconic and sacred territories of Peru, Chile, Bolivia, Ecuador, Colombia, and Argentina with private high-end guides.';
$current_page = 'destinations';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER -->
<section class="subpage-hero content__banner" style="background-image: url('/assets/img/heroes/destinations-hero.webp');">
    <div class="subpage-hero-content content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="subpage-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <span class="active">Geographic Destinations</span>
        </div>

        <span class="subpage-hero-tag">SACRED TERRITORIES &amp; PRIVATE GUIDES</span>
        <h1 class="subpage-hero-title">The Local Experience Curator</h1>
        <p class="subpage-hero-subtitle">
            EXQUISITE, HANDCRAFTED PRIVATE JOURNEYS WITH POSITIVE IMPACT: TRAVEL TO SOUTH AMERICA
        </p>

        <!-- Hero Action Buttons -->
        <div class="subpage-hero-actions">
            <a href="#destinations-catalog" class="btn-hero-gold">
                Explore Destinations
            </a>
            <a href="/contact" class="btn-hero-outline">
                Design My Journey →
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#destinations-catalog" class="content__banner__next" aria-label="Scroll to destinations">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. DESTINATIONS CATALOG SECTION -->
<section class="section" id="destinations-catalog" style="padding: 60px 0 30px; background: var(--bg-surface, #FAF8F5);">
    <div class="container text-center">
        <span class="section-tag">Geographic Collection</span>
        <h2 class="sub__title" style="margin-bottom: 14px;">Curated South American Destinations</h2>
        <p style="color: #666; max-width: 720px; margin: 0 auto 30px; font-size: 15px;">
            From the sacred heights of the Peruvian Andes to the endless horizons of Patagonia and the celestial cosmos of the Atacama. Select a destination to explore its private curator guide.
        </p>

        <!-- Country Filter Tabs -->
        <div class="filter-tabs-bar" style="justify-content: center; margin-bottom: 20px;">
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'all') ? 'active' : ''; ?>" data-country="all" onclick="filterDestsCountry('all')">
                🌎 All (<span id="dests-count-all"><?php echo count($allDests); ?></span>)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'peru') ? 'active' : ''; ?>" data-country="peru" onclick="filterDestsCountry('peru')">
                🇵🇪 Peru (12)
            </button>
            <button type="button" class="filter-pill <?php echo ($selectedCountry === 'chile') ? 'active' : ''; ?>" data-country="chile" onclick="filterDestsCountry('chile')">
                🇨🇱 Chile & Patagonia (8)
            </button>
            <button type="button" class="filter-pill" data-country="bolivia" onclick="filterDestsCountry('bolivia')">
                🇧🇴 Bolivia
            </button>
            <button type="button" class="filter-pill" data-country="ecuador" onclick="filterDestsCountry('ecuador')">
                🇪🇨 Ecuador & Galápagos
            </button>
            <button type="button" class="filter-pill" data-country="colombia" onclick="filterDestsCountry('colombia')">
                🇨🇴 Colombia
            </button>
            <button type="button" class="filter-pill" data-country="argentina" onclick="filterDestsCountry('argentina')">
                🇦🇷 Argentina
            </button>
        </div>
    </div>
</section>

<!-- Destinations Grid -->
<section class="section" style="padding-top: 30px;">
    <div class="container">
        <div class="destinations-grid" id="dests-catalog-grid">
            <?php foreach ($allDests as $d): 
                $dCountry = strtolower($d['country'] ?? 'peru');
                $dFlag = ($dCountry === 'chile') ? '🇨🇱' : (($dCountry === 'peru') ? '🇵🇪' : '🌎');
            ?>
                <div class="destination-card dest-item-card" data-country="<?php echo $dCountry; ?>" style="background-image: url('<?php echo htmlspecialchars($d['image'] ?? ''); ?>');">
                    <div class="destination-card-content">
                        <span class="destination-card-country"><?php echo $dFlag . ' ' . strtoupper($dCountry); ?></span>
                        <h3 class="destination-card-title"><?php echo htmlspecialchars($d['name']); ?></h3>
                        <p class="destination-card-subtitle"><?php echo htmlspecialchars($d['subtitle'] ?? ''); ?></p>
                        
                        <?php if (!empty($d['highlights']) && is_array($d['highlights'])): ?>
                            <ul style="list-style:none; padding:0; margin:10px 0 16px; font-size:12px; color:#F1F5F9; line-height:1.6; text-shadow:0 1px 3px rgba(0,0,0,0.8);">
                                <?php foreach (array_slice($d['highlights'], 0, 2) as $h): ?>
                                    <li>✦ <?php echo htmlspecialchars($h); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <a href="/destination/<?php echo htmlspecialchars($d['slug']); ?>" class="cta-button" style="display:inline-block; padding:9px 18px; font-size:11px;">
                            Explore Destination →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
function filterDestsCountry(country) {
    document.querySelectorAll('.filter-tabs-bar .filter-pill').forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-country') === country);
    });

    document.querySelectorAll('.dest-item-card').forEach(card => {
        const c = card.getAttribute('data-country');
        if (country === 'all' || c === country) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?php
include __DIR__ . '/includes/footer.php';
?>
