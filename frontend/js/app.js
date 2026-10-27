/**
 * Unu Raymi - Main Client Application
 * Communicates with REST API (api/index.php) and manages portal state
 */
class App {
    constructor() {
        this.apiBase = window.location.pathname.startsWith('/frontend') ? '../api/index.php' : '/api';
        this.tours = [];
        this.destinations = [];
        this.styles = [];
        this.settings = {};
        this.currentCountry = 'all';

        this.init();
    }

    async init() {
        if (typeof OverlayManager !== 'undefined') {
            window.overlayManager = new OverlayManager();
        }

        // Navbar scroll effect
        const handleScroll = () => {
            const nav = document.querySelector('.header-nav');
            if (nav) {
                if (window.scrollY > 40) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();

        // Dropdown hover continuity & safety delay
        this.initDropdownHover();

        // Mobile drawer navigation
        this.initMobileDrawer();

        // Load data from API if dynamic containers exist
        if (document.getElementById('tours-container') || document.getElementById('destinations-container')) {
            await this.loadInitialData();
        }

        // Form handler
        this.initPlannerForm();

        // Mega menu interactive hover
        this.initMegaMenuPreview();

        // Check initial hash if overlayManager exists
        if (window.overlayManager && typeof window.overlayManager.syncFromHash === 'function') {
            window.overlayManager.syncFromHash();
        }
    }

    async loadInitialData() {
        try {
            const [toursRes, destsRes, stylesRes, settingsRes] = await Promise.all([
                fetch(`${this.apiBase}/tours`),
                fetch(`${this.apiBase}/destinations`),
                fetch(`${this.apiBase}/styles`),
                fetch(`${this.apiBase}/settings`)
            ]);

            this.tours = await toursRes.json();
            this.destinations = await destsRes.json();
            this.styles = await stylesRes.json();
            this.settings = await settingsRes.json();

            this.updateBadgeCounts();
            this.renderBrandSettings();
            this.renderTours(this.tours);
            this.renderDestinations(this.destinations);
            this.renderStyles(this.styles);
        } catch (err) {
            console.error('Error loading API data:', err);
        }
    }

    updateBadgeCounts() {
        const peruTours = this.tours.filter(t => t.country === 'peru').length;
        const chileTours = this.tours.filter(t => t.country === 'chile').length;
        const allTours = this.tours.length;

        const peruDests = this.destinations.filter(d => d.country === 'peru').length;
        const chileDests = this.destinations.filter(d => d.country === 'chile').length;
        const allDests = this.destinations.length;

        const setTxt = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.textContent = val;
        };

        setTxt('count-tours-all', allTours);
        setTxt('count-tours-peru', peruTours);
        setTxt('count-tours-chile', chileTours);
        setTxt('count-dests-all', allDests);
        setTxt('count-dests-peru', peruDests);
        setTxt('count-dests-chile', chileDests);
        setTxt('count-all', allDests);
    }

    filterByCountry(country) {
        this.currentCountry = country;

        // Filter tours
        const filteredTours = country === 'all' 
            ? this.tours 
            : this.tours.filter(t => (t.country || '').toLowerCase() === country.toLowerCase());
        this.renderTours(filteredTours);

        // Filter destinations
        const filteredDests = country === 'all' 
            ? this.destinations 
            : this.destinations.filter(d => (d.country || '').toLowerCase() === country.toLowerCase());
        this.renderDestinations(filteredDests);

        // Update active class on filter tabs
        document.querySelectorAll('[data-filter]').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-filter') === country);
        });
        document.querySelectorAll('[data-dest-filter]').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-dest-filter') === country);
        });
        document.querySelectorAll('.country-nav-item').forEach(item => {
            item.classList.toggle('active', item.getAttribute('data-country') === country);
        });
    }

    filterDestByCountry(country) {
        const filteredDests = country === 'all'
            ? this.destinations
            : (country === 'international' 
                ? this.destinations.filter(d => d.country !== 'peru' && d.country !== 'chile')
                : this.destinations.filter(d => (d.country || '').toLowerCase() === country.toLowerCase()));

        this.renderDestinations(filteredDests);

        document.querySelectorAll('[data-dest-filter]').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-dest-filter') === country);
        });
    }

    initMegaMenuPreview() {
        const previews = {
            all: {
                title: "🌎 Ultra-Luxury South America",
                desc: "Bespoke journeys curated with dedicated 24/7 private concierges across the continent's most fascinating enclaves.",
                highlights: ["Machu Picchu & VIP Inca Trail", "Atacama Desert & Cosmic Skies", "Torres del Paine & Glaciers", "Amazon River Expedition Cruises"]
            },
            peru: {
                title: "🇵🇪 Imperial & Gastronomic Peru",
                desc: "Cradle of the Incan Empire and Latin America's most celebrated gastronomy. Privileged access to the sanctuary of Machu Picchu.",
                highlights: ["Belmond Hiram Bingham Train", "The World's 50 Best Restaurants", "Private Estates in the Sacred Valley", "Lake Titicaca & Belmond Andean Explorer"]
            },
            chile: {
                title: "🇨🇱 Chile: From Desert to Patagonia",
                desc: "A mesmerizing land of colossal contrasts between the starlit Atacama and the glaciers of Torres del Paine.",
                highlights: ["Private Observatories in San Pedro de Atacama", "Guided Trekking in Torres del Paine", "The Mystery of Moais on Rapa Nui", "Carménère Wine Estates in Colchagua"]
            },
            bolivia: {
                title: "🇧🇴 Mystical Bolivia & Uyuni Salt Flats",
                desc: "The infinite mirror of the world's largest salt flat and surreal high-Andean landscapes.",
                highlights: ["Airstream Campers on Uyuni Salt Flats", "La Paz & Cable Cars in the Clouds", "Megaliths of Tiwanaku", "Colored Lagoons & Volcanic Wonders"]
            },
            ecuador: {
                title: "🇪🇨 Ecuador & the Galápagos Archipelago",
                desc: "Charles Darwin's living laboratory explored aboard ultra-luxury expedition catamarans.",
                highlights: ["Private Expedition Yachts in Galápagos", "Unique Marine & Terrestrial Wildlife", "Colonial Haciendas at Cotopaxi Volcano", "Mashpi Lodge in the Andean Cloud Forest"]
            },
            colombia: {
                title: "🇨🇴 Colombia: Magical Realism & Coffee",
                desc: "The Caribbean charm of Cartagena de Indias and the lush coffee plantations of the Andes.",
                highlights: ["Private Restored Mansions in Cartagena", "Pristine Beaches of Tayrona National Park", "Single-Origin Coffee Tastings", "Caño Cristales Liquid Rainbow"]
            },
            argentina: {
                title: "🇦🇷 Argentina: Passion, Glaciers & Malbec",
                desc: "From the bohemian elegance of Buenos Aires to the awe of Perito Moreno Glacier and Mendoza's wine valleys.",
                highlights: ["Private Walkways at Perito Moreno Glacier", "Malbec Vineyards in Uco Valley", "Iguazú Falls Private Encounters", "Tango & Haute Cuisine in Buenos Aires"]
            }
        };

        document.querySelectorAll('.country-nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                const country = item.getAttribute('data-country');
                const p = previews[country] || previews.all;

                const tEl = document.getElementById('mega-preview-title');
                const dEl = document.getElementById('mega-preview-desc');
                const lEl = document.getElementById('mega-preview-list');

                if (tEl) tEl.textContent = p.title;
                if (dEl) dEl.textContent = p.desc;
                if (lEl) {
                    lEl.innerHTML = p.highlights.map(h => `<li>${h}</li>`).join('');
                }
            });
        });
    }

    initDropdownHover() {
        const dropdownItems = document.querySelectorAll('.nav-item-dropdown');
        dropdownItems.forEach(item => {
            let closeTimer = null;

            const openMenu = () => {
                if (closeTimer) {
                    clearTimeout(closeTimer);
                    closeTimer = null;
                }
                dropdownItems.forEach(other => {
                    if (other !== item) {
                        other.classList.remove('is-active', 'menu-open');
                    }
                });
                item.classList.add('is-active', 'menu-open');
            };

            const scheduleClose = () => {
                closeTimer = setTimeout(() => {
                    item.classList.remove('is-active', 'menu-open');
                }, 240); // 240ms grace period ensures effortless cursor navigation
            };

            item.addEventListener('mouseenter', openMenu);
            item.addEventListener('mouseleave', scheduleClose);

            const menu = item.querySelector('.mega-menu, .simple-dropdown');
            if (menu) {
                menu.addEventListener('mouseenter', openMenu);
                menu.addEventListener('mouseleave', scheduleClose);
            }

            // Click support: clicking the nav link toggles menu on hybrid/touch devices
            const trigger = item.querySelector('.nav-link');
            if (trigger) {
                trigger.addEventListener('click', (e) => {
                    if (window.innerWidth > 1024 && !item.classList.contains('menu-open')) {
                        e.preventDefault();
                        openMenu();
                    }
                });
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.nav-item-dropdown')) {
                dropdownItems.forEach(item => {
                    item.classList.remove('is-active', 'menu-open');
                });
            }
        });
    }

    initMobileDrawer() {
        const toggleBtn = document.getElementById('mobile-toggle');
        const closeBtn = document.getElementById('mobile-close');
        const backdrop = document.getElementById('mobile-drawer-backdrop');
        const drawer = document.getElementById('mobile-drawer');

        const openDrawer = () => {
            if (drawer) drawer.classList.add('active');
            if (backdrop) backdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closeDrawer = () => {
            if (drawer) drawer.classList.remove('active');
            if (backdrop) backdrop.classList.remove('active');
            document.body.style.overflow = '';
        };

        if (toggleBtn) toggleBtn.addEventListener('click', openDrawer);
        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        if (backdrop) backdrop.addEventListener('click', closeDrawer);

        if (drawer) {
            drawer.querySelectorAll('a').forEach(a => {
                a.addEventListener('click', closeDrawer);
            });
        }
    }

    renderBrandSettings() {
        if (!this.settings) return;
        const brandNames = document.querySelectorAll('.dynamic-brand-name');
        brandNames.forEach(el => el.textContent = this.settings.brand_name || 'Unu Raymi');

        const taglines = document.querySelectorAll('.dynamic-brand-tagline');
        taglines.forEach(el => el.textContent = this.settings.tagline || 'Bespoke Luxury Journeys');

        const emails = document.querySelectorAll('.dynamic-email');
        emails.forEach(el => {
            el.textContent = this.settings.email;
            if (el.tagName === 'A') el.href = `mailto:${this.settings.email}`;
        });

        const phones = document.querySelectorAll('.dynamic-phone');
        phones.forEach(el => el.textContent = this.settings.phone);
    }

    renderTours(toursList) {
        const container = document.getElementById('tours-container');
        if (!container) return;

        container.innerHTML = toursList.map(t => `
            <a href="/tour/${t.slug}" class="tour-card" onclick="event.preventDefault(); window.app.openTourBySlug('${t.slug}')" title="${t.title}">
                <div class="tour-card-image" style="background-image: url('${t.card_image || t.image || t.hero_image || ''}');"></div>
                <div class="tour-card-overlay"></div>
                <div class="tour-card-content">
                    <h3 class="tour-card-title">${t.title}</h3>
                </div>
            </a>
        `).join('');
    }

    renderDestinations(destsList) {
        const container = document.getElementById('destinations-container');
        if (!container) return;

        container.innerHTML = destsList.map(d => `
            <div class="destination-card" onclick="window.app.openDestinationBySlug('${d.slug}')">
                <img src="${d.image}" alt="${d.name}" class="destination-bg" loading="lazy">
                <div class="destination-gradient"></div>
                <div class="destination-info">
                    <span class="destination-country-tag">${d.country ? d.country.toUpperCase() : 'PERÚ'}</span>
                    <h3 class="destination-name">${d.name}</h3>
                    <p class="destination-subtitle">${d.subtitle || ''}</p>
                </div>
            </div>
        `).join('');
    }

    renderStyles(stylesList) {
        const container = document.getElementById('styles-container');
        if (!container) return;

        container.innerHTML = stylesList.map(s => `
            <div class="style-card">
                <span class="style-icon">✦</span>
                <h4 class="style-title">${s.name}</h4>
                <p class="style-desc">${s.description}</p>
            </div>
        `).join('');
    }

    openDestinationBySlug(slug) {
        window.location.href = `/destination/${slug}`;
    }

    openTourBySlug(slug) {
        window.location.href = `/tour/${slug}`;
    }

    initPlannerForm() {
        const form = document.getElementById('planner-form');
        const feedback = document.getElementById('planner-feedback');
        if (!form) return;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending request to Concierge...';

            const payload = {
                first_name: form.first_name.value,
                last_name: form.last_name.value,
                email: form.email.value,
                phone: form.phone.value,
                destination: form.destination.value,
                travel_date: form.travel_date.value,
                trip_length: form.trip_length.value,
                travelers: form.travelers.value,
                budget: form.budget.value,
                accommodation: form.accommodation.value,
                source: form.source.value,
                notes: form.notes.value
            };

            try {
                const res = await fetch(`${this.apiBase}/leads`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();

                if (data.success) {
                    form.reset();
                    feedback.style.display = 'block';
                    feedback.innerHTML = `
                        <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid #22C55E; color: #4ADE80; padding: 20px; border-radius: 8px; text-align: center;">
                            <h4 style="font-size: 18px; margin-bottom: 6px;">Request Received Successfully!</h4>
                            <p style="font-size: 14px; margin: 0;">${data.message || 'A private luxury travel designer will contact you within 24 hours.'}</p>
                        </div>
                    `;
                    submitBtn.textContent = 'Request Sent ✓';
                    setTimeout(() => {
                        window.overlayManager.closePlanner();
                        feedback.style.display = 'none';
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Send Request to Private Concierge';
                    }, 4000);
                } else {
                    alert(data.error || 'An error occurred while submitting the form.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Retry Submission';
                }
            } catch (err) {
                alert('Connection error with the server.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Retry Submission';
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    window.app = new App();
});
