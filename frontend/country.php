<?php
/**
 * Unu Raymi - Country Destination Hub Dedicated Subpage
 * Dedicated luxury portal for each country (Peru, Chile, Bolivia, Ecuador, Colombia, Argentina)
 */

require_once __DIR__ . '/includes/db-loader.php';

$countrySlug = strtolower($_GET['country'] ?? 'peru');

// Load countries collection
$countriesFile = DATA_PATH . '/countries.json';
$allCountries = file_exists($countriesFile) ? json_decode(file_get_contents($countriesFile), true) : [];

$country = null;
foreach ($allCountries as $c) {
    if ($c['slug'] === $countrySlug) {
        $country = $c;
        break;
    }
}

if (!$country) {
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
                The requested destination is not available in our current catalog.
            </p>
            <a href="/destinations" class="cta-button">View All Destinations →</a>
        </div>
    </section>
    <?php
    include __DIR__ . '/includes/footer.php';
    exit;
}

// Fetch all tours and destinations for this country
$allTours = DB::getAll('tours');
$countryTours = array_values(array_filter($allTours, function($t) use ($countrySlug) {
    return strtolower($t['country'] ?? '') === $countrySlug;
}));

$allDests = DB::getAll('destinations');
$countryDests = array_values(array_filter($allDests, function($d) use ($countrySlug) {
    return strtolower($d['country'] ?? '') === $countrySlug;
}));

// Country specific titles
$isPeru = ($countrySlug === 'peru');
$heroMainTitle = $isPeru ? 'Machu Picchu & Peru Travel' : "{$country['name']} Luxury Travel";
$heroBadge = $isPeru ? 'CUSTOM LUXURY PERU TRAVEL & MACHU PICCHU' : strtoupper("{$country['name']} PRIVATE LUXURY JOURNEYS");
$introSectionTitle = $isPeru ? 'Unforgettable Peru Travel Adventures' : "Unforgettable {$country['name']} Travel Adventures";
$itinerariesSectionTitle = $isPeru ? 'Signature Peru Itineraries' : "Signature {$country['name']} Itineraries";
$landSectionTitle = $isPeru ? 'The Land of The Incas' : "Explore {$country['name']}";

$page_title = $isPeru 
    ? 'Customized Luxury Peru Travel & Machu Picchu | Unu Raymi'
    : "Bespoke Luxury Travel in {$country['name']} | Unu Raymi";
$meta_desc = substr(strip_tags($country['overview']), 0, 155) . '...';
$current_page = 'destinations';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER -->
<?php
$countryHeroBg = ($isPeru && file_exists(__DIR__ . '/assets/img/heroes/peru-dest-hero.webp'))
    ? '/assets/img/heroes/peru-dest-hero.webp'
    : htmlspecialchars($country['hero_image'] ?? '/assets/img/tours/peru.webp');
?>
<section class="dest-hero-section content__banner" style="background-image: url('<?php echo $countryHeroBg; ?>');">
    <div class="dest-hero-content content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="dest-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <a href="/destinations">Destinations</a>
            <span class="separator">/</span>
            <span class="active"><?php echo $country['flag'] . ' ' . htmlspecialchars($country['name']); ?></span>
        </div>

        <span class="dest-hero-tag"><?php echo $country['flag'] . ' ' . $heroBadge; ?></span>
        <h1 class="dest-hero-title"><?php echo htmlspecialchars($heroMainTitle); ?></h1>
        <p class="dest-hero-subtitle">
            <?php echo $isPeru 
                ? 'Handcrafted private journeys curated by local travel experts in Cusco for discerning travelers. Immersive culture, sacred archaeology, and world-class gastronomy.' 
                : htmlspecialchars($country['tagline']); ?>
        </p>

        <!-- Action Buttons -->
        <div class="subpage-hero-actions">
            <a href="#signature-itineraries" class="btn-hero-gold">
                Explore Itineraries (<?php echo count($countryTours); ?>)
            </a>
            <a href="/custom-journey?country=<?php echo $countrySlug; ?>" class="btn-hero-outline">
                Design My Custom Trip →
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#next_content" class="content__banner__next" aria-label="Scroll down to content">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. INTRO SECTION ("Unforgettable Peru Travel Adventures") -->
<section class="dest-intro-section" id="next_content">
    <div class="container dest-intro-content">
        <span class="dest-intro-tag">EXPERIENCE THE ALLURE OF <?php echo strtoupper($country['name']); ?></span>
        <h2 class="dest-intro-title"><?php echo htmlspecialchars($introSectionTitle); ?></h2>
        <p class="dest-intro-lead">
            “Our custom-designed itineraries are suited to the needs and preferences of each traveler, every time.”
        </p>
        <p class="dest-intro-text">
            <?php if ($isPeru): ?>
                Experience the ancient allure of Peru with Unu Raymi. Our journeys deliver an extraordinary tapestry of diverse landscapes, living history, and vibrant culture. From the silent majesty of Machu Picchu suspended high in the Andean cloud forest to the enigmatic Nazca Lines, the spiritual serenity of Lake Titicaca, and the untamed biodiversity of the Amazon basin. Every step of your expedition reveals a new facet of this ancient land, supported by your dedicated 24/7 private host and exclusive archaeological permits.
            <?php else: ?>
                <?php echo nl2br(htmlspecialchars($country['overview'])); ?>
            <?php endif; ?>
        </p>

        <!-- 4 Stat / Fast Fact Cards -->
        <div class="dest-stats-grid">
            <div class="dest-stat-card">
                <span class="icon">🌦️</span>
                <div class="label"><?php echo $isPeru ? '30 Microclimates' : 'Optimal Season'; ?></div>
                <div class="desc"><?php echo $isPeru ? 'Out of 32 worldwide, spanning the desert coast to alpine peaks and the Amazon' : htmlspecialchars($country['ideal_season']); ?></div>
            </div>
            <div class="dest-stat-card">
                <span class="icon">🍽️</span>
                <div class="label"><?php echo $isPeru ? 'Culinary Capital' : 'Signature Cuisine'; ?></div>
                <div class="desc"><?php echo $isPeru ? 'World’s Leading Culinary Destination for 10 consecutive years. Private tables at Central & Maido' : 'Native culinary heritage and fine highland wine pairings'; ?></div>
            </div>
            <div class="dest-stat-card">
                <span class="icon">🏛️</span>
                <div class="label"><?php echo $isPeru ? 'UNESCO World Heritage' : 'Living Heritage'; ?></div>
                <div class="desc"><?php echo $isPeru ? '12 World Heritage Sites explored with historian scholars and master guides' : count($countryDests) . ' signature geographic regions'; ?></div>
            </div>
            <div class="dest-stat-card">
                <span class="icon">🛡️</span>
                <div class="label">24/7 Dedicated Service</div>
                <div class="desc">Continuous on-the-ground concierge accompaniment without commercial middlemen</div>
            </div>
        </div>
    </div>
</section>

<!-- 3. SIGNATURE ITINERARIES (.carousel__itineraries, .item, .diascards, .button__web__white) -->
<section id="signature-itineraries" class="dest-signature-section">
    <div class="container">
        
        <div class="dest-signature-header">
            <p class="textoh4">BROWSE THROUGH SAMPLE</p>
            <h2 class="sub__title"><?php echo htmlspecialchars($itinerariesSectionTitle); ?></h2>
            <h3>Our custom-designed itineraries are suited to the needs and preferences of each traveler, every time.</h3>
            <p>
                When planning with Unu Raymi, we take all of your desires into account: whether exploring the biodiversity of the Amazon, savoring Latin America's top dining experiences in Lima, or ascending to the ancient citadel of Machu Picchu in private sunrise hours. Below is a curated selection of sample itineraries.
            </p>
        </div>

        <!-- Category Filter Pills -->
        <div class="filter-tabs-bar" style="margin-bottom: 36px; justify-content: center;">
            <button type="button" class="filter-pill active" data-category="all" onclick="filterCountryCategory('all')">
                All (<?php echo count($countryTours); ?>)
            </button>
            <button type="button" class="filter-pill" data-category="Lujo" onclick="filterCountryCategory('Lujo')">
                Iconic Luxury
            </button>
            <button type="button" class="filter-pill" data-category="Aventura" onclick="filterCountryCategory('Aventura')">
                Adventure &amp; Treks
            </button>
            <button type="button" class="filter-pill" data-category="Gastronomía" onclick="filterCountryCategory('Gastronomía')">
                Gastronomy
            </button>
            <button type="button" class="filter-pill" data-category="Familia" onclick="filterCountryCategory('Familia')">
                Family &amp; Romance
            </button>
        </div>

        <!-- Signature Itineraries Grid -->
        <div class="carousel__itineraries" id="country-tours-container">
            <?php 
            foreach ($countryTours as $index => $t): 
                $tourCategory = $t['category'] ?? 'Lujo';
                $tourImage = $t['card_image'] ?? $t['hero_image'] ?? '/assets/img/tours/machu-picchu-luxury-travel.webp';
                $tourDays = $t['duration_days'] ?? 8;
                
                // Route/Hubs extraction
                $route = '';
                if (!empty($t['hubs']) && is_array($t['hubs'])) {
                    $route = implode(', ', $t['hubs']);
                } elseif (!empty($t['subtitle'])) {
                    $route = $t['subtitle'];
                } elseif (!empty($t['tagline'])) {
                    $route = $t['tagline'];
                } else {
                    $route = 'Cusco, Lima, Machu Picchu, Sacred Valley';
                }
                
                // Show first 6 initially; rest revealable
                $isExtra = ($index >= 6);
            ?>
                <div class="item country-tour-item <?php echo $isExtra ? 'tour-item-extra' : ''; ?>" data-category="<?php echo htmlspecialchars($tourCategory); ?>" style="<?php echo $isExtra ? 'display: none;' : ''; ?>">
                    <a class="item-img-link" href="/tour/<?php echo htmlspecialchars($t['slug']); ?>">
                        <img decoding="async" src="<?php echo htmlspecialchars($tourImage); ?>" alt="<?php echo htmlspecialchars($t['title']); ?> Travel Itinerary">
                    </a>
                    <p class="diascards"><?php echo $tourDays; ?> DAYS</p>
                    <div class="item-content">
                        <h4><?php echo htmlspecialchars($t['title']); ?></h4>
                        <p><i><?php echo htmlspecialchars($route); ?></i></p>
                        <p>
                            <a class="button__web__white" href="/tour/<?php echo htmlspecialchars($t['slug']); ?>">
                                Discover
                            </a>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($countryTours) > 6): ?>
            <div id="country-load-more-box" style="text-align: center; margin-top: 36px;">
                <button type="button" class="btn-outline-gold" id="btn-load-more-country" onclick="toggleCountryTours()" style="padding: 13px 36px; font-size: 11px; letter-spacing: 0.18em; text-transform: uppercase;">
                    View All <?php echo htmlspecialchars($country['name']); ?> Itineraries (<?php echo count($countryTours); ?>) ↓
                </button>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- 4. WHY TRAVEL WITH US (4 Dark Pillars) -->
<section class="dest-why-section">
    <div class="container">
        <div style="text-align: center; max-width: 820px; margin: 0 auto;">
            <span class="section-tag" style="color: var(--gold); font-size: 11px; letter-spacing: 0.25em; text-transform: uppercase; font-weight: 600;">
                THE UNU RAYMI DIFFERENCE
            </span>
            <h2 style="font-family: 'Playfair Display', Georgia, serif; font-size: 40px; color: #1D1E20; margin: 12px 0 16px; font-weight: 400;">
                Why travel with us?
            </h2>
            <p style="color: #55595F; font-size: 15px; line-height: 1.7;">
                We design every journey around your specific interests, ensuring an authentic connection to the heart and soul of South America. Your travels directly support local Andean communities while you experience the ultimate standard in quiet luxury.
            </p>
        </div>

        <div class="dest-why-grid">
            <div class="dest-why-card">
                <span class="why-icon">🧭</span>
                <h4>100% Handcrafted &amp; Tailor-Made</h4>
                <p>No standard packages. Our Cusco designers build your journey from scratch to match your pace, preferences, and personal travel style.</p>
            </div>

            <div class="dest-why-card">
                <span class="why-icon">🗝️</span>
                <h4>Private VIP Access &amp; Elite Guides</h4>
                <p>Master bilingual guides specializing in archaeology, after-hours monument access, and private luxury train cars.</p>
            </div>

            <div class="dest-why-card">
                <span class="why-icon">🛡️</span>
                <h4>24/7 Dedicated Concierge</h4>
                <p>Proactive supervision in real time from your arrival in Lima to your departure flight, with immediate resolution of any request.</p>
            </div>

            <div class="dest-why-card">
                <span class="why-icon">✨</span>
                <h4>Authentic Cultural Connection</h4>
                <p>Genuine encounters with local communities, master weavers, and ancient traditions preserved with utmost respect and intimacy.</p>
            </div>
        </div>
    </div>
</section>

<!-- 5. THE LAND OF THE INCAS (Geographic Hubs) -->
<section class="dest-land-section">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
            <span class="dest-intro-tag">KEY TERRITORIES &amp; REGIONS</span>
            <h2 class="dest-intro-title"><?php echo htmlspecialchars($landSectionTitle); ?></h2>
            <p style="font-size: 14.5px; color: #44313A; line-height: 1.7;">
                <?php if ($isPeru): ?>
                    From the snow-capped Andes to coastal desert oases and the dense Amazonian rainforest: 30 microclimates united in one extraordinary land. Explore Peru's iconic regions.
                <?php else: ?>
                    Explore the landmark territories and sanctuaries of <?php echo htmlspecialchars($country['name']); ?>.
                <?php endif; ?>
            </p>
        </div>

        <?php if (!empty($countryDests)): ?>
            <div class="dest-hubs-grid">
                <?php foreach (array_slice($countryDests, 0, 6) as $d): ?>
                    <a href="/destination/<?php echo htmlspecialchars($d['slug']); ?>" class="dest-hub-card" style="background-image: url('<?php echo htmlspecialchars($d['image'] ?? '/assets/img/tours/machu-picchu-luxury-travel.webp'); ?>');">
                        <div class="dest-hub-overlay"></div>
                        <div class="dest-hub-info">
                            <span class="dest-hub-badge">SACRED DESTINATION</span>
                            <h3 class="dest-hub-title"><?php echo htmlspecialchars($d['name']); ?></h3>
                            <p class="dest-hub-desc"><?php echo htmlspecialchars($d['subtitle'] ?? ''); ?></p>
                            <span class="dest-hub-link">Explore Destination →</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- 6. EXPERIENCE REGION -->
<section class="dest-experience-section">
    <div class="exp-peru-container">
        <h2 class="exp-peru-title">Experience <?php echo htmlspecialchars($country['name']); ?></h2>

        <?php if ($isPeru): ?>
            <!-- GASTRONOMY -->
            <div class="cuadro_imagen_texto">
                <div class="exp-row-inner">
                    <div class="exp-img-box">
                        <img decoding="async" src="/assets/img/destinations/gastronomy.jpg" alt="Peru Travel Gastronomy">
                    </div>
                    <div class="exp-text-box">
                        <h5>GASTRONOMY</h5>
                        <p>Whether from the city, the desert, or the highlands - one thing that unites Peruvian people is their pride in their cuisine. For nine consecutive years, Peru has reigned supreme as the world’s leading culinary destination. Guests can dine at the fourth and seventh best restaurants worldwide, as ranked by The World’s 50 Best!</p>
                    </div>
                </div>
            </div>

            <!-- CULTURE -->
            <div class="cuadro_imagen_texto">
                <div class="exp-row-inner">
                    <div class="exp-img-box">
                        <img decoding="async" src="/assets/img/destinations/gastronomy2.jpg" alt="Peru Travel Culture">
                    </div>
                    <div class="exp-text-box">
                        <h5>CULTURE</h5>
                        <p>Peru boasts 12 UNESCO World Heritage Sites, spanning the cultural and natural spectrum which should all be on your Peru travel itineraries for your luxury trip to Peru. Take a voyage through time visiting pre–Inca and Inca archeological sites, national parks, historical centers, fly over the Nazca Lines, and explore Caral - the oldest city in the Americas. Your luxury Peru Travel is incomplete without exploring the cultural relics and ancient cities that make Peru the cultural powerhouse that it is today.</p>
                    </div>
                </div>
            </div>

            <!-- ADVENTURE -->
            <div class="cuadro_imagen_texto">
                <div class="exp-row-inner">
                    <div class="exp-img-box">
                        <img decoding="async" src="/assets/img/destinations/gastronomy3.jpg" alt="Peru Travel Adventure">
                    </div>
                    <div class="exp-text-box">
                        <h5>ADVENTURE</h5>
                        <p>Peru’s varied landscapes, exotic wildlife, and mysterious Incan sites intertwined with its natural beauty make it the most epic backdrop for the adventure of a lifetime. Whether it's surfing off Peru’s dazzling North Coast, trekking through Peru’s mountainous, snowcapped Huascarán National Park, hiking the legendary Inca Trail, or boarding down one of the world's tallest sand dunes in the desert oasis of Ica - one thing is for sure - your luxury Peru Travel could use a little adventure.</p>
                    </div>
                </div>
            </div>

            <!-- NATURE -->
            <div class="cuadro_imagen_texto">
                <div class="exp-row-inner">
                    <div class="exp-img-box">
                        <img decoding="async" src="/assets/img/destinations/gastronomy4.jpg" alt="Peru Travel Nature">
                    </div>
                    <div class="exp-text-box">
                        <h5>NATURE</h5>
                        <p>Peru is the second-largest country in Latin America in terms of forest area, and hosts ecosystems of high biodiversity value, large protected areas, ever-changing landscape mosaics with dynamic ecosystem transitions, and a diverse community of indigenous peoples and cultures. As one of the most biodiverse places on the planet, Peru is a wildlife lover’s dream.</p>
                    </div>
                </div>
            </div>

            <!-- WELLNESS -->
            <div class="cuadro_imagen_texto">
                <div class="exp-row-inner">
                    <div class="exp-img-box">
                        <img decoding="async" src="/assets/img/destinations/gastronomy5.jpg" alt="Peru Travel Wellness">
                    </div>
                    <div class="exp-text-box">
                        <h5>WELLNESS</h5>
                        <p>Rest, reset, recharge - we all live such fast-paced lives that it's essential to take time out of our busy schedules to energize the mind, body and soul - and there’s no better place to do this than Peru. Indulge in a variety of wellness retreats with unique holistic goals. Whether you are working on improved eating and sleeping patterns, reducing stress and detoxing the body, or reconnecting with your higher self spiritually, there is an experience that will meet your needs.</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="cuadro_imagen_texto">
                <div class="exp-row-inner">
                    <div class="exp-img-box">
                        <img decoding="async" src="<?php echo htmlspecialchars($country['hero_image']); ?>" alt="<?php echo htmlspecialchars($country['name']); ?>">
                    </div>
                    <div class="exp-text-box">
                        <h5>CURATED EXPERIENCES</h5>
                        <p><?php echo htmlspecialchars($country['overview']); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- 7. FAQS FOR PLANNING YOUR TRIP (Interactive Accordion) -->
<section class="dest-faq-section">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
            <span class="dest-intro-tag">FREQUENTLY ASKED QUESTIONS</span>
            <h2 class="dest-intro-title"><?php echo htmlspecialchars($country['name']); ?> FAQs for Planning Your Trip</h2>
            <p style="font-size: 14.5px; color: #44313A; line-height: 1.7;">
                Essential guidance from our regional specialists to ensure a seamless, safe, and truly unforgettable journey.
            </p>
        </div>

        <div class="faq-accordion-container">
            <div class="faq-accordion-item open">
                <div class="faq-accordion-header" onclick="toggleFaq(this)">
                    <span>What is the best time of year to visit Peru and Machu Picchu?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-accordion-body">
                    <p>The dry season in the Peruvian Andes runs from May to October, offering clear blue skies and sunny days—ideal for hiking the Inca Trail and visiting Machu Picchu and Cusco. For Lima and the coast, summer runs from December to April. Nonetheless, Peru is a captivating year-round destination; the green season (November to April) offers lush emerald valleys, vibrant orchids, and fewer crowds.</p>
                </div>
            </div>

            <div class="faq-accordion-item">
                <div class="faq-accordion-header" onclick="toggleFaq(this)">
                    <span>How can I prevent and adjust to altitude sickness in the Andes?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-accordion-body">
                    <p>At Unu Raymi, our itineraries are medically designed for gradual acclimatization: upon landing at Cusco Airport (3,400 m / 11,150 ft), we escort guests directly down to the Sacred Valley of the Incas (2,800 m / 9,200 ft), where the lower elevation ensures restful adaptation. Our private vehicles carry medical oxygen, and we provide natural herbal coca infusions and continuous hydration guidance.</p>
                </div>
            </div>

            <div class="faq-accordion-item">
                <div class="faq-accordion-header" onclick="toggleFaq(this)">
                    <span>How far in advance should I book Machu Picchu permits and tickets?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-accordion-body">
                    <p>Official Classic Inca Trail permits are strictly capped by Peru's Ministry of Culture at 500 individuals per day (including guides and porters) and routinely sell out 4 to 6 months ahead. For luxury train journeys to Machu Picchu with Huayna Picchu or Machu Picchu Mountain hiking permits, we recommend booking at least 2 to 3 months in advance.</p>
                </div>
            </div>

            <div class="faq-accordion-item">
                <div class="faq-accordion-header" onclick="toggleFaq(this)">
                    <span>Which luxury train services travel to Machu Picchu?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-accordion-body">
                    <p>The flagship journey is the legendary <em>Belmond Hiram Bingham</em>, styled in the glamour of 1920s Pullman cars. It features a 4-course gourmet dining experience, open bar with artisanal Peruvian cocktails, and an open-air observation car with live Andean folk musicians. We also coordinate the <em>Inca Rail First Class</em> service featuring curated tasting menus and panoramic observation decks.</p>
                </div>
            </div>

            <div class="faq-accordion-item">
                <div class="faq-accordion-header" onclick="toggleFaq(this)">
                    <span>Do I need a tourist visa or specific vaccines to enter Peru?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-accordion-body">
                    <p>Citizens of the United States, Canada, the European Union, the United Kingdom, and Australia do not require an advance visa for tourist stays up to 90 days; a valid passport with at least 6 months remaining validity is required. For excursions into the Amazon basin (Tambopata or Iquitos), a Yellow Fever vaccination is recommended at least 10 days before travel.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 9. BESPOKE TRIP PLANNER LEAD GENERATION -->
<section id="dest-planner" class="unu-lead-section">
    <div class="unu-lead-container">
        <h3 class="unu-lead-title">
            Start planning your bespoke luxury adventure with Unu Raymi Expeditions today and explore <?php echo htmlspecialchars($country['name']); ?> in the most personalized, elegant way possible.
        </h3>

        <form onsubmit="submitCountryLead(event)">
            <input type="hidden" name="source" value="Destination Page: <?php echo htmlspecialchars($country['name']); ?>">
            <div class="unu-lead-grid">
                <!-- Left Column -->
                <div class="unu-lead-col">
                    <select name="destination" class="unu-lead-input" required>
                        <option value="<?php echo htmlspecialchars($country['name']); ?>" selected><?php echo htmlspecialchars($country['name']); ?></option>
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

            <div class="unu-lead-feedback" id="country-lead-feedback" style="display: none;"></div>
        </form>
    </div>
</section>

<!-- 10. EXPLORE OTHER SOUTH AMERICAN COUNTRIES -->
<section class="section" style="background: var(--bg-surface-elevated); border-top: 1px solid var(--border); padding: 75px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 30px;">
            <span class="section-tag" style="color: var(--gold); font-size: 11px; letter-spacing: 0.25em; text-transform: uppercase;">
                COMBINE SOUTH AMERICAN TERRITORIES
            </span>
            <h2 style="font-family: 'Playfair Display', Georgia, serif; font-size: 32px; color: #1D1E20; margin: 10px 0 0; font-weight: 400;">
                Explore Other Private Destinations
            </h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 24px;">
            <?php foreach ($allCountries as $otherC): 
                if ($otherC['slug'] === $countrySlug) continue;
            ?>
                <a href="/destinations/<?php echo $otherC['slug']; ?>" class="highlight-card" style="display:block; text-decoration:none; padding:22px 18px; transition:all 0.3s ease; background: #FFFFFF; border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 14px rgba(0,0,0,0.03); text-align: center; border-radius: 4px;">
                    <div style="font-size: 28px; margin-bottom: 8px;"><?php echo $otherC['flag']; ?></div>
                    <h4 style="color:#1D1E20; font-size: 16px; margin-bottom: 6px; font-family: 'Playfair Display', Georgia, serif;"><?php echo htmlspecialchars($otherC['name']); ?></h4>
                    <span style="font-size: 11px; color: var(--gold); letter-spacing: 0.1em; text-transform: uppercase;">View Itineraries →</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
// Category Filtering for Country Tours
function filterCountryCategory(cat) {
    document.querySelectorAll('.filter-tabs-bar .filter-pill').forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-category') === cat);
    });

    const items = document.querySelectorAll('.country-tour-item');
    items.forEach(it => {
        const itemCat = it.getAttribute('data-category') || '';
        if (cat === 'all' || itemCat.toLowerCase().includes(cat.toLowerCase())) {
            it.style.display = 'flex';
        } else {
            it.style.display = 'none';
        }
    });
}

// Toggle Reveal for all country tours
let countryToursExpanded = false;
function toggleCountryTours() {
    countryToursExpanded = !countryToursExpanded;
    const extras = document.querySelectorAll('.tour-item-extra');
    const btn = document.getElementById('btn-load-more-country');
    
    extras.forEach(el => {
        el.style.display = countryToursExpanded ? 'flex' : 'none';
    });

    if (btn) {
        btn.textContent = countryToursExpanded 
            ? 'Show Fewer Itineraries ↑' 
            : 'View All <?php echo htmlspecialchars($country['name']); ?> Itineraries (<?php echo count($countryTours); ?>) ↓';
    }
}

// Interactive FAQs Accordion
function toggleFaq(headerEl) {
    const item = headerEl.parentElement;
    const isOpen = item.classList.contains('open');
    
    // Close other FAQ items
    document.querySelectorAll('.faq-accordion-item').forEach(it => {
        it.classList.remove('open');
    });

    if (!isOpen) {
        item.classList.add('open');
    }
}

// Country Lead Form Handler
function submitCountryLead(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const feedback = document.getElementById('country-lead-feedback');
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
        destination: formData.get('destination') || '<?php echo htmlspecialchars($country['name']); ?>',
        trip_length: formData.get('trip_length') || '',
        travel_date: formData.get('travel_date') || '',
        travelers: formData.get('travelers') || '',
        accommodation: formData.get('accommodation') || '',
        budget: formData.get('budget') || '',
        notes: formData.get('notes') || '',
        source: 'Destination Page: <?php echo htmlspecialchars($country['name']); ?>'
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
            feedback.innerHTML = `<strong>Thank you, ${payload.first_name}!</strong> Your inquiry for <?php echo htmlspecialchars($country['name']); ?> has been received. Our private travel designers in Cusco will craft your personalized journey and contact you within 24 hours.`;
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
