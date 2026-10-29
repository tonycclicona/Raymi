<?php
/**
 * Unu Raymi - Global Header with Transparent Sticky Navbar & Visual Mega-Menus
 */
$current_page = $current_page ?? '';
$page_title = $page_title ?? 'Unu Raymi | Bespoke Luxury Travel in Peru & South America';
$meta_desc = $meta_desc ?? 'Handcrafted ultra-luxury private journeys across Peru, Chile, Bolivia, Galapagos, Colombia, and Argentina. Dedicated 24/7 host & exclusive archaeological access.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc); ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_desc); ?>">
    <meta property="og:type" content="website">
    
    <!-- Google Fonts: Cinzel & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon & Browser Touch Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#FBF9F5">

    <!-- Global Stylesheet -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Global API Configuration -->
    <script>
        window.API_BASE = '/api';
    </script>
</head>
<body class="page-<?php echo htmlspecialchars($current_page ?: 'home'); ?>">

    <!-- Main Navigation Bar (Transparent on initial load, sticky luxury on scroll) -->
    <header class="header-nav" id="main-header-nav">
        <div class="container nav-inner">
            <a href="/" class="brand-logo" title="Unu Raymi Expeditions">
                <img src="/assets/img/logo.png" alt="Unu Raymi Expeditions" class="brand-logo-img" height="60">
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="nav-desktop">
                <ul class="nav-links">
                    <!-- Dropdown: Destinations (Visual Country Grid) -->
                    <li class="nav-item-dropdown" data-dropdown="destinations">
                        <a href="/destinations" class="nav-link <?php echo ($current_page === 'destinations') ? 'active' : ''; ?>">
                            Destinations <span class="dropdown-arrow">▾</span>
                        </a>
                        <div class="mega-menu destinations-visual-menu">
                            <div class="mega-menu-topbar">
                                <span class="mega-menu-title">✦ Exclusive South American Destinations</span>
                                <a href="/destinations" class="mega-menu-all-link">View Full Catalog (25+ Hubs) →</a>
                            </div>
                            <div class="visual-countries-grid">
                                <a href="/destinations/peru" class="country-visual-card">
                                    <div class="card-bg" style="background-image: url('/assets/img/tours/peru.webp');"></div>
                                    <div class="card-overlay"></div>
                                    <div class="card-info">
                                        <div class="card-header-line">
                                            <span class="card-flag">🇵🇪</span>
                                            <h4>Peru</h4>
                                        </div>
                                        <p>Machu Picchu, Cusco & Gastronomy (17 Tours • 12 Hubs)</p>
                                    </div>
                                </a>

                                <a href="/destinations/chile" class="country-visual-card">
                                    <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=600&q=80');"></div>
                                    <div class="card-overlay"></div>
                                    <div class="card-info">
                                        <div class="card-header-line">
                                            <span class="card-flag">🇨🇱</span>
                                            <h4>Chile & Patagonia</h4>
                                        </div>
                                        <p>Atacama, Torres del Paine & Wine (6 Tours • 8 Hubs)</p>
                                    </div>
                                </a>

                                <a href="/destinations/bolivia" class="country-visual-card">
                                    <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1518182170546-07661fd94144?auto=format&fit=crop&w=600&q=80');"></div>
                                    <div class="card-overlay"></div>
                                    <div class="card-info">
                                        <div class="card-header-line">
                                            <span class="card-flag">🇧🇴</span>
                                            <h4>Bolivia</h4>
                                        </div>
                                        <p>Uyuni Salt Flats & Sacred Lake Titicaca</p>
                                    </div>
                                </a>

                                <a href="/destinations/ecuador" class="country-visual-card">
                                    <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80');"></div>
                                    <div class="card-overlay"></div>
                                    <div class="card-info">
                                        <div class="card-header-line">
                                            <span class="card-flag">🇪🇨</span>
                                            <h4>Ecuador & Galapagos</h4>
                                        </div>
                                        <p>Darwin's Enchanted Isles & Andean Volcanoes</p>
                                    </div>
                                </a>

                                <a href="/destinations/colombia" class="country-visual-card">
                                    <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1518638150340-f706e86654de?auto=format&fit=crop&w=600&q=80');"></div>
                                    <div class="card-overlay"></div>
                                    <div class="card-info">
                                        <div class="card-header-line">
                                            <span class="card-flag">🇨🇴</span>
                                            <h4>Colombia</h4>
                                        </div>
                                        <p>Colonial Cartagena, Coffee Triangle & Tayrona</p>
                                    </div>
                                </a>

                                <a href="/destinations/argentina" class="country-visual-card">
                                    <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=600&q=80');"></div>
                                    <div class="card-overlay"></div>
                                    <div class="card-info">
                                        <div class="card-header-line">
                                            <span class="card-flag">🇦🇷</span>
                                            <h4>Argentina</h4>
                                        </div>
                                        <p>Perito Moreno Glacier, Porteño Tango & Malbec</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Dropdown: Tours & Itineraries -->
                    <li class="nav-item-dropdown" data-dropdown="tours">
                        <a href="/tours" class="nav-link <?php echo ($current_page === 'tours') ? 'active' : ''; ?>">
                            Tours & Itineraries <span class="dropdown-arrow">▾</span>
                        </a>
                        <div class="mega-menu simple-dropdown">
                            <div class="dropdown-links-list">
                                <a href="/tours" class="dropdown-sublink">
                                    <strong>🌟 Full Collection (32 Tours)</strong>
                                    <span>Signature private itineraries across 6 South American destinations</span>
                                </a>
                                <a href="/tours?country=peru" class="dropdown-sublink">
                                    <strong>🇵🇪 Peru (17 Itineraries)</strong>
                                    <span>Machu Picchu, Sacred Valley, Amazon & fine gastronomy</span>
                                </a>
                                <a href="/tours?country=chile" class="dropdown-sublink">
                                    <strong>🇨🇱 Chile & Patagonia (6 Itineraries)</strong>
                                    <span>Atacama, Torres del Paine, lakes & boutique wineries</span>
                                </a>
                                <a href="/tours?country=argentina" class="dropdown-sublink">
                                    <strong>🇦🇷 Argentina (3 Itineraries)</strong>
                                    <span>Iguazu Falls, Mendoza wine country, Patagonia & Salta</span>
                                </a>
                                <a href="/tours?country=bolivia" class="dropdown-sublink">
                                    <strong>🇧🇴 Bolivia (2 Itineraries)</strong>
                                    <span>Uyuni Salt Flats, La Paz & Sacred Lake Titicaca</span>
                                </a>
                                <a href="/tours?country=ecuador" class="dropdown-sublink">
                                    <strong>🇪🇨 Ecuador & Galapagos (2 Itineraries)</strong>
                                    <span>Darwin's Archipelago, Colonial Quito & Avenue of Volcanoes</span>
                                </a>
                                <a href="/tours?country=colombia" class="dropdown-sublink">
                                    <strong>🇨🇴 Colombia (2 Itineraries)</strong>
                                    <span>Colonial Cartagena, Coffee Cultural Landscape & Caribbean</span>
                                </a>
                                <a href="/tours?category=Aventura" class="dropdown-sublink">
                                    <strong>🏔️ Adventure & Elite Treks</strong>
                                    <span>Private Inca Trail, Salkantay Lodge-to-Lodge, W-Trek</span>
                                </a>
                                <a href="/tours?category=Gastronomía" class="dropdown-sublink">
                                    <strong>🍷 Culinary & Enology Experiences</strong>
                                    <span>Tasting menus at Central & Maido, Colchagua & Mendoza</span>
                                </a>
                                <a href="/tours?category=Romance" class="dropdown-sublink">
                                    <strong>💍 Honeymoon & Romance</strong>
                                    <span>Andean honeymoons in private villas & luxury glamping</span>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Dropdown: Travel Styles -->
                    <li class="nav-item-dropdown" data-dropdown="styles">
                        <a href="/#estilos" class="nav-link">
                            Travel Styles <span class="dropdown-arrow">▾</span>
                        </a>
                        <div class="mega-menu simple-dropdown">
                            <div class="dropdown-links-list">
                                <a href="/tours?style=solo" class="dropdown-sublink">
                                    <strong>Solo Travel</strong>
                                    <span>Independent exploration with absolute privacy & private local host</span>
                                </a>
                                <a href="/tours?style=family" class="dropdown-sublink">
                                    <strong>Friends & Family</strong>
                                    <span>Private villas and seamless multigenerational expeditions</span>
                                </a>
                                <a href="/tours?style=romance" class="dropdown-sublink">
                                    <strong>Love & Romance</strong>
                                    <span>Honeymoons, milestone anniversaries & scenic hideaways</span>
                                </a>
                                <a href="/tours?style=adventure" class="dropdown-sublink">
                                    <strong>Activity & Adventure</strong>
                                    <span>High-altitude treks, horseback expeditions & glacier kayaking</span>
                                </a>
                                <a href="/tours?style=gastronomy" class="dropdown-sublink">
                                    <strong>Gastronomy & Enology</strong>
                                    <span>World-renowned dining and exclusive cellar tastings</span>
                                </a>
                                <a href="/tours?style=culture" class="dropdown-sublink">
                                    <strong>History & Culture</strong>
                                    <span>Living archaeology and heritage with historian scholars</span>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Dropdown: About Us -->
                    <li class="nav-item-dropdown" data-dropdown="about">
                        <a href="/about-us" class="nav-link <?php echo ($current_page === 'about') ? 'active' : ''; ?>">
                            About Us <span class="dropdown-arrow">▾</span>
                        </a>
                        <div class="mega-menu simple-dropdown">
                            <div class="dropdown-links-list">
                                <a href="/about-us" class="dropdown-sublink">
                                    <strong>The Unu Raymi Difference</strong>
                                    <span>Cusco-based boutique firm & dedicated 24/7 personal host</span>
                                </a>
                                <a href="/responsible-travel" class="dropdown-sublink">
                                    <strong>Responsible Travel & Philanthropy</strong>
                                    <span>Yaku Kunan Project: clean water and education for Andean communities</span>
                                </a>
                                <a href="/about-us#reviews" class="dropdown-sublink">
                                    <strong>Reviews & Testimonials</strong>
                                    <span>5★ ratings on Trustpilot & TripAdvisor Travelers' Choice</span>
                                </a>
                                <a href="/contact-us" class="dropdown-sublink">
                                    <strong>Contact Concierge</strong>
                                    <span>Cusco Headquarters & bespoke journey planning</span>
                                </a>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="/responsible-travel" class="nav-link">
                            Responsible Travel
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Right Actions: Phone + CTA Button + Mobile Toggle -->
            <div class="nav-actions-right">
                <a href="tel:+51915082539" class="nav-phone-link" title="Call or WhatsApp 24/7">
                    <span class="phone-icon">📞</span>
                    <span class="phone-number">(+51) 915 082 539</span>
                </a>

                <a href="/custom-journey" class="cta-button nav-cta-btn">
                    Plan My Trip
                </a>

                <!-- Mobile Hamburger Toggle -->
                <button type="button" class="mobile-nav-toggle" id="mobile-toggle" aria-label="Open Navigation Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-drawer-backdrop" id="mobile-drawer-backdrop"></div>
    <div class="mobile-drawer" id="mobile-drawer">
        <div class="mobile-drawer-header">
            <a href="/" class="brand-logo" title="Unu Raymi Expeditions">
                <img src="/assets/img/logo.png" alt="Unu Raymi Expeditions" class="brand-logo-img" style="height: 48px; width: auto;">
            </a>
            <button type="button" class="mobile-drawer-close" id="mobile-close" aria-label="Close">✕</button>
        </div>
        <div class="mobile-drawer-body">
            <div class="mobile-nav-group">
                <div class="mobile-nav-heading">Destinations</div>
                <a href="/destinations/peru" class="mobile-nav-link">🇵🇪 Peru (17 Tours • 12 Hubs)</a>
                <a href="/destinations/chile" class="mobile-nav-link">🇨🇱 Chile & Patagonia (6 Tours • 8 Hubs)</a>
                <a href="/destinations/bolivia" class="mobile-nav-link">🇧🇴 Bolivia (Uyuni Salt Flats)</a>
                <a href="/destinations/ecuador" class="mobile-nav-link">🇪🇨 Ecuador & Galapagos</a>
                <a href="/destinations/colombia" class="mobile-nav-link">🇨🇴 Colombia</a>
                <a href="/destinations/argentina" class="mobile-nav-link">🇦🇷 Argentina</a>
                <a href="/destinations" class="mobile-nav-link" style="color:var(--gold); font-weight:600;">View All Destinations (25+) →</a>
            </div>
            <div class="mobile-nav-group">
                <div class="mobile-nav-heading">Tours & Itineraries</div>
                <a href="/tours" class="mobile-nav-link">All Tours (32 Itineraries)</a>
                <a href="/tours?country=peru" class="mobile-nav-link">Tours in Peru</a>
                <a href="/tours?country=chile" class="mobile-nav-link">Tours in Chile</a>
            </div>
            <div class="mobile-nav-group">
                <div class="mobile-nav-heading">About Us</div>
                <a href="/about-us" class="mobile-nav-link">The Unu Raymi Difference</a>
                <a href="/responsible-travel" class="mobile-nav-link">Responsible Travel & Yaku Kunan</a>
                <a href="/contact-us" class="mobile-nav-link">Contact Concierge</a>
            </div>
            <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border);">
                <a href="/custom-journey" class="cta-button" style="display:block; text-align:center; padding:14px;">
                    Plan My Custom Trip
                </a>
            </div>
        </div>
    </div>
