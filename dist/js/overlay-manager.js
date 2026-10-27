/**
 * Unu Raymi - Multi-Layered Overlays System
 * Seamless navigation without leaving the main window
 */

class OverlayManager {
    constructor() {
        this.stack = [];
        this.backdrop = document.getElementById('overlay-backdrop');
        this.layer1 = document.getElementById('overlay-layer-1');
        this.layer2 = document.getElementById('overlay-layer-2');
        this.plannerModal = document.getElementById('planner-modal');

        this.initEventListeners();
    }

    initEventListeners() {
        // Backdrop click pops top layer
        if (this.backdrop) {
            this.backdrop.addEventListener('click', () => this.pop());
        }

        // Close buttons on layers
        document.querySelectorAll('[data-overlay-close]').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetLayer = btn.getAttribute('data-overlay-close');
                if (targetLayer === 'all') {
                    this.clearAll();
                } else {
                    this.pop();
                }
            });
        });

        // Layer 2 back button (pops to Layer 1)
        const backBtnL2 = document.getElementById('layer-2-back-btn');
        if (backBtnL2) {
            backBtnL2.addEventListener('click', () => this.pop());
        }

        // Escape key listener
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.stack.length > 0) {
                this.pop();
            }
        });

        // Hash change navigation
        window.addEventListener('popstate', () => {
            this.syncFromHash();
        });
    }

    /**
     * Push Destination Hub Overlay (Layer 1)
     */
    openDestination(slug, destData, relatedTours = []) {
        this.renderDestinationContent(destData, relatedTours);
        
        this.layer1.classList.add('active');
        this.backdrop.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Add to stack if not already there
        if (!this.stack.some(s => s.layer === 1 && s.slug === slug)) {
            // If already at layer 2, pop it first
            if (this.stack.length > 1) {
                this.layer2.classList.remove('active');
                this.stack = this.stack.filter(s => s.layer === 1);
            }
            this.stack.push({ layer: 1, type: 'destination', slug });
        }

        window.history.pushState(null, '', `#destination=${slug}`);
    }

    /**
     * Push Tour Deep Dive Overlay (Layer 2 - Stacked over Layer 1 or Direct)
     */
    openTour(slug, tourData) {
        this.renderTourContent(tourData);

        this.layer2.classList.add('active');
        this.backdrop.classList.add('active');
        document.body.style.overflow = 'hidden';

        this.stack.push({ layer: 2, type: 'tour', slug });
        window.history.pushState(null, '', `#tour=${slug}`);
    }

    /**
     * Push Bespoke Trip Planner Modal (Layer 3 - Top Modal)
     */
    openPlanner(preselectedDestination = '', preselectedTour = '') {
        const destSelect = document.getElementById('planner-destination');
        const notesArea = document.getElementById('planner-notes');

        if (destSelect && preselectedDestination) {
            destSelect.value = preselectedDestination;
        }
        if (notesArea && preselectedTour) {
            notesArea.value = `Interested in the tour: ${preselectedTour}`;
        }

        this.plannerModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        this.stack.push({ layer: 3, type: 'planner' });
    }

    closePlanner() {
        this.plannerModal.classList.remove('active');
        this.stack = this.stack.filter(s => s.layer !== 3);
        if (this.stack.length === 0) {
            this.backdrop.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    /**
     * Pop top-most overlay
     */
    pop() {
        if (this.stack.length === 0) return;

        const top = this.stack.pop();

        if (top.layer === 3) {
            this.plannerModal.classList.remove('active');
        } else if (top.layer === 2) {
            this.layer2.classList.remove('active');
            // If returning to layer 1, update hash
            const prev = this.stack[this.stack.length - 1];
            if (prev && prev.layer === 1) {
                window.history.pushState(null, '', `#destination=${prev.slug}`);
            } else {
                window.history.pushState(null, '', ' ');
            }
        } else if (top.layer === 1) {
            this.layer1.classList.remove('active');
            window.history.pushState(null, '', ' ');
        }

        if (this.stack.length === 0) {
            this.backdrop.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    /**
     * Clear all overlays
     */
    clearAll() {
        this.plannerModal.classList.remove('active');
        this.layer2.classList.remove('active');
        this.layer1.classList.remove('active');
        this.backdrop.classList.remove('active');
        document.body.style.overflow = '';
        this.stack = [];
        window.history.pushState(null, '', ' ');
    }

    /**
     * Render HTML inside Layer 1 (Destination Hub)
     */
    renderDestinationContent(d, tours) {
        const body = document.getElementById('layer-1-body');
        const titleHeader = document.getElementById('layer-1-header-title');
        if (titleHeader) titleHeader.textContent = d.name;

        const highlightsHtml = (d.highlights || []).map(h => `<li>${h}</li>`).join('');

        let relatedToursHtml = '';
        if (tours && tours.length > 0) {
            relatedToursHtml = `
                <div style="margin-top: 40px;">
                    <h4 style="font-size: 18px; color: var(--gold-light); margin-bottom: 20px;">
                        Exclusive Tours in ${d.name}
                    </h4>
                    <div style="display: grid; gap: 16px;">
                        ${tours.map(t => `
                            <div class="tour-card" onclick="window.app.openTourBySlug('${t.slug}')" style="cursor: pointer; flex-direction: row; align-items: center; padding: 16px;">
                                <img src="${t.image}" style="width: 100px; height: 80px; object-fit: cover; border-radius: 6px; margin-right: 18px;">
                                <div style="flex: 1;">
                                    <h5 style="color: #FFF; font-size: 16px; margin-bottom: 4px;">${t.title}</h5>
                                    <div style="font-size: 12px; color: var(--gold);">${t.duration_days} Days • ${t.category}</div>
                                </div>
                                <span class="view-itinerary-btn">View Itinerary <span>→</span></span>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        body.innerHTML = `
            <div class="overlay-hero">
                <img src="${d.image}" alt="${d.name}">
                <div class="overlay-hero-gradient">
                    <span class="overlay-hero-tag">${d.country ? d.country.toUpperCase() : 'PERU'}</span>
                    <h2 class="overlay-hero-title">${d.name}</h2>
                    <p class="overlay-hero-subtitle">${d.subtitle || ''}</p>
                </div>
            </div>

            <div class="editorial-text">
                <p>${d.excerpt || ''}</p>
            </div>

            <div class="highlights-box">
                <h4>✦ Exclusive Unu Raymi Curated Moments in ${d.name}</h4>
                <ul class="highlights-list">
                    ${highlightsHtml}
                </ul>
            </div>

            <div style="display: flex; gap: 16px; margin: 30px 0;">
                <button type="button" class="cta-button" onclick="window.overlayManager.openPlanner('${d.name}')">
                    Design Custom Journey to ${d.name}
                </button>
            </div>

            ${relatedToursHtml}
        `;
    }

    /**
     * Render HTML inside Layer 2 (Tour Deep Dive with Day-by-Day Accordion)
     */
    renderTourContent(t) {
        const body = document.getElementById('layer-2-body');
        const titleHeader = document.getElementById('layer-2-header-title');
        if (titleHeader) titleHeader.textContent = t.title;

        // Build Day-by-Day Accordion
        let itineraryHtml = '';
        if (t.itinerary && t.itinerary.length > 0) {
            itineraryHtml = t.itinerary.map((day, idx) => `
                <div class="accordion-item ${idx === 0 ? 'open' : ''}" onclick="this.classList.toggle('open')">
                    <div class="accordion-header">
                        <span class="accordion-day-tag">Day ${day.day || (idx + 1)}</span>
                        <span class="accordion-title">${day.title}</span>
                        <span class="accordion-chevron">▼</span>
                    </div>
                    <div class="accordion-content">
                        ${day.description}
                    </div>
                </div>
            `).join('');
        }

        const inclusionsHtml = (t.inclusions || []).map(i => `<li>${i}</li>`).join('');
        const exclusionsHtml = (t.exclusions || []).map(e => `<li>${e}</li>`).join('');

        body.innerHTML = `
            <div class="overlay-hero" style="height: 280px;">
                <img src="${t.image}" alt="${t.title}">
                <div class="overlay-hero-gradient">
                    <span class="overlay-hero-tag">${t.duration_days} DAYS • ${t.category.toUpperCase()}</span>
                    <h2 class="overlay-hero-title" style="font-size: 26px;">${t.title}</h2>
                    <p class="overlay-hero-subtitle">${t.tagline || ''}</p>
                </div>
            </div>

            <div class="editorial-text">
                <p>${t.overview || ''}</p>
            </div>

            <div style="margin: 32px 0;">
                <h4 style="font-size: 18px; color: var(--gold-light); margin-bottom: 16px;">
                    🗓️ Comprehensive Day-by-Day Itinerary
                </h4>
                <div class="accordion-wrapper">
                    ${itineraryHtml}
                </div>
            </div>

            <div class="inclusions-grid">
                <div class="inclusions-card inc">
                    <h5>✓ What's Included</h5>
                    <ul>${inclusionsHtml}</ul>
                </div>
                <div class="inclusions-card exc">
                    <h5>✕ Not Included</h5>
                    <ul>${exclusionsHtml}</ul>
                </div>
            </div>

            <div style="background: rgba(212, 175, 55, 0.08); border: 1px solid var(--border-gold); border-radius: 12px; padding: 24px; text-align: center; margin-top: 36px;">
                <h4 style="color: #FFF; font-size: 18px; margin-bottom: 8px;">Ready to experience this journey?</h4>
                <p style="color: var(--text-secondary); font-size: 13px; margin-bottom: 18px;">
                    All our journeys are 100% private and tailored to your personal schedule, pace, and accommodation preferences.
                </p>
                <button type="button" class="cta-button" onclick="window.overlayManager.openPlanner('${t.country || 'Peru'}', '${t.title}')">
                    Inquire About This Tour
                </button>
            </div>
        `;
    }

    syncFromHash() {
        const hash = window.location.hash.substring(1);
        if (!hash) {
            this.clearAll();
            return;
        }
        const params = new URLSearchParams(hash);
        if (params.has('destination')) {
            window.app.openDestinationBySlug(params.get('destination'));
        } else if (params.has('tour')) {
            window.app.openTourBySlug(params.get('tour'));
        }
    }
}

window.OverlayManager = OverlayManager;
