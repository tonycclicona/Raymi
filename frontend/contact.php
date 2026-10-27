<?php
/**
 * Unu Raymi - Contact & Bespoke Custom Journey Designer Subpage
 * Replicates Kuoda Travel's multi-step / rich Gravity Forms lead generation engine
 */

$page_title = 'Design Your Bespoke Journey | Unu Raymi Luxury Travel';
$meta_desc = 'Customize your private journey in Peru, Chile, and South America with our team of designers in Cusco. Bespoke trip planner and 24/7 concierge.';
$current_page = 'contact';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. FULL-SCREEN ADAPTIVE HERO BANNER (Kuoda Travel 100vh Standard) -->
<section class="subpage-hero content__banner" style="background-image: url('/assets/img/hero-banner.webp');">
    <div class="subpage-hero-content content__banner__text">
        
        <!-- Glassmorphism Breadcrumbs inside hero -->
        <div class="subpage-hero-breadcrumbs">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <span class="active">Plan My Trip / Contact</span>
        </div>

        <span class="subpage-hero-tag">BESPOKE LUXURY EXPEDITIONS ✦ 24-HOUR RESPONSE</span>
        <h1 class="subpage-hero-title">Start Planning Your Dream Journey</h1>
        <p class="subpage-hero-subtitle">
            HANDCRAFTED PRIVATE ITINERARIES ACROSS PERU &amp; SOUTH AMERICA BY OUR PRIVATE CURATORS IN CUSCO
        </p>

        <!-- Kuoda Travel Action Buttons (Matched to Reference Image) -->
        <div class="subpage-hero-actions">
            <a href="#bespoke-journey-form" class="btn-hero-gold">
                Begin Form
            </a>
            <a href="https://wa.me/51984123456?text=Hello%20Unu%20Raymi,%20I%20would%20like%20information%20for%20a%20bespoke%20luxury%20journey" target="_blank" rel="noopener noreferrer" class="btn-hero-outline">
                WhatsApp Concierge ↗
            </a>
        </div>
    </div>

    <!-- Bouncing Scroll Down Chevron Indicator -->
    <a href="#bespoke-journey-form" class="content__banner__next" aria-label="Scroll to journey planner">
        <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </a>
</section>

<!-- 2. BESPOKE TRIP PLANNER LEAD GENERATION (Exact Kuoda Travel Reference Standard) -->
<section class="kuoda-lead-section" id="bespoke-journey-form">
    <div class="kuoda-lead-container">
        <h3 class="kuoda-lead-title">
            Start planning your bespoke luxury adventure with Unu Raymi today and explore Peru in the most personalized, elegant way possible.
        </h3>

        <form id="bespoke-journey-form-el" onsubmit="submitCustomJourneyLead(event)">
            <div class="kuoda-lead-grid">
                <!-- Left Column -->
                <div class="kuoda-lead-col">
                    <select name="destination" class="kuoda-lead-input" required>
                        <option value="" disabled selected>Where would you like to go? *</option>
                        <option value="Peru">Peru</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Chile">Chile</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="More than one country">More than one country</option>
                    </select>

                    <div class="kuoda-lead-split-row">
                        <input type="text" name="travel_date" class="kuoda-lead-input" placeholder="When would you like to travel? *" required>
                        <input type="text" name="trip_length" class="kuoda-lead-input" placeholder="Preferred length of trip? *" required>
                    </div>

                    <input type="text" name="travelers" class="kuoda-lead-input" placeholder="Number of travelers? *" required>

                    <select name="accommodation" class="kuoda-lead-input" required>
                        <option value="" disabled selected>Level of accommodations? *</option>
                        <option value="Luxury ( 5-star )">Luxury ( 5-star )</option>
                        <option value="Deluxe ( 4-star )">Deluxe ( 4-star )</option>
                        <option value="Boutique ( 3-star )">Boutique ( 3-star )</option>
                    </select>

                    <input type="text" name="budget" class="kuoda-lead-input" placeholder="Budget (per person)?">
                </div>

                <!-- Right Column -->
                <div class="kuoda-lead-col">
                    <input type="text" name="first_name" class="kuoda-lead-input" placeholder="First name *" required>
                    <input type="text" name="last_name" class="kuoda-lead-input" placeholder="Last name*" required>
                    <input type="email" name="email" class="kuoda-lead-input" placeholder="Email *" required>
                    <input type="tel" name="phone" class="kuoda-lead-input" placeholder="Phone Number">
                    <textarea name="notes" class="kuoda-lead-input kuoda-lead-textarea" placeholder="Additional comments?"></textarea>
                </div>
            </div>

            <div class="kuoda-lead-submit-wrap">
                <button type="submit" class="kuoda-lead-submit-btn">Submit</button>
            </div>

            <div class="kuoda-lead-feedback" style="display: none;"></div>
        </form>
    </div>
</section>

<!-- 3. CONCIERGE & CUSCO HEADQUARTERS INFORMATION -->
<section class="section" style="padding: 70px 0; background: #090C11; border-top: 1px solid rgba(255,255,255,0.06);">
    <div class="container" style="max-width: 980px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            
            <div class="contact-info-card" style="margin: 0;">
                <span class="section-tag" style="margin-bottom: 8px;">Direct Contact</span>
                <h3 style="font-size: 20px; color: #FFF; margin-bottom: 22px; font-family: 'Playfair Display', Georgia, serif;">Cusco Headquarters</h3>
                
                <div class="contact-channel">
                    <span class="icon">📍</span>
                    <div>
                        <strong>Physical Address</strong>
                        <span>Plaza Nazarenas 211, Historic Center, Cusco, Peru</span>
                    </div>
                </div>

                <div class="contact-channel">
                    <span class="icon">📞</span>
                    <div>
                        <strong>24/7 Phone &amp; WhatsApp</strong>
                        <a href="tel:+51984123456">+51 984 123 456</a>
                    </div>
                </div>

                <div class="contact-channel">
                    <span class="icon">✉️</span>
                    <div>
                        <strong>Direct Inquiries</strong>
                        <a href="mailto:info@unu-raymi.com">info@unu-raymi.com</a>
                    </div>
                </div>

                <a href="https://wa.me/51984123456?text=Hello%20Unu%20Raymi,%20I%20would%20like%20information%20for%20a%20bespoke%20luxury%20journey" target="_blank" rel="noopener noreferrer" class="btn-hero-outline" style="width: 100%; justify-content: center; margin-top: 20px; font-size: 11px;">
                    Chat on WhatsApp ↗
                </a>
            </div>

            <div class="contact-info-card" style="margin: 0; background: rgba(212,175,55,0.06); border-color: rgba(212,175,55,0.4);">
                <h4 style="color: var(--gold-light); font-size: 16px; margin-bottom: 12px; font-family: 'Playfair Display', serif;">✦ The Unu Raymi Promise</h4>
                <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 14px;">
                    We do not sell off-the-shelf packages or mass tourism. Every proposal is a bespoke work of art handcrafted by local specialists born in the Andes, granting privileged access to the most exclusive corners.
                </p>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 12px; color: var(--text-secondary); line-height: 1.9;">
                    <li>✓ 100% Customized and flexible</li>
                    <li>✓ Dedicated 24/7 private concierge &amp; host</li>
                    <li>✓ Access to ultra-luxury lodges and scenic trains</li>
                </ul>
            </div>

    </div>
</section>

<script>
function submitCustomJourneyLead(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const feedback = form.querySelector('.kuoda-lead-feedback');
    const originalText = btn.textContent;

    btn.disabled = true;
    btn.textContent = 'Submitting...';
    feedback.style.display = 'none';
    feedback.className = 'kuoda-lead-feedback';
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
        source: 'Custom Journey Page (/custom-journey)'
    };

    fetch((window.API_BASE || '/api') + '/leads', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(json => {
        if (json.success) {
            feedback.className = 'kuoda-lead-feedback success';
            feedback.innerHTML = `<strong>Thank you, ${payload.first_name}!</strong> Your bespoke inquiry has been received. Our private travel designers in Cusco will craft your personalized journey and contact you within 24 hours.`;
            feedback.style.display = 'block';
            form.reset();
            feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else {
            feedback.className = 'kuoda-lead-feedback error';
            feedback.innerHTML = '✕ ' + (json.error || 'There was an error submitting your request. Please try again.');
            feedback.style.display = 'block';
        }
    })
    .catch(err => {
        feedback.className = 'kuoda-lead-feedback error';
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
