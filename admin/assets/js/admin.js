/**
 * Unu Raymi Admin - Client Controller
 */

document.addEventListener('DOMContentLoaded', () => {
    initModals();
    initItineraryRepeater();
    initLeadStatusUpdaters();
});

// Modal Controller
function initModals() {
    const triggers = document.querySelectorAll('[data-modal-target]');
    triggers.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-modal-target');
            openModal(targetId);
        });
    });

    const closeBtns = document.querySelectorAll('.modal-close, [data-modal-close]');
    closeBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const modal = e.target.closest('.modal-backdrop');
            if (modal) closeModal(modal.id);
        });
    });

    // Close on click backdrop
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) {
                closeModal(backdrop.id);
            }
        });
    });
}

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Day-by-Day Itinerary Repeater
function initItineraryRepeater() {
    const container = document.getElementById('itinerary-container');
    const addBtn = document.getElementById('add-day-btn');
    if (!container || !addBtn) return;

    addBtn.addEventListener('click', () => {
        const currentDays = container.querySelectorAll('.day-item').length;
        const nextDay = currentDays + 1;
        appendDayItem(container, nextDay, '', '');
    });

    // Event delegation for day removal
    container.addEventListener('click', (e) => {
        if (e.target.closest('.day-remove-btn')) {
            const item = e.target.closest('.day-item');
            if (item) {
                item.remove();
                renumberDays(container);
            }
        }
    });
}

function appendDayItem(container, dayNumber, title = '', description = '') {
    const div = document.createElement('div');
    div.className = 'day-item';
    div.innerHTML = `
        <div class="day-item-header">
            <span class="day-badge">Día ${dayNumber}</span>
            <button type="button" class="day-remove-btn">✕ Eliminar día</button>
        </div>
        <div class="form-group" style="margin-bottom: 8px;">
            <input type="text" name="itinerary_title[]" class="form-control" placeholder="Título del día (Ej: Llegada a Lima y Cena de Bienvenida)" value="${escapeHtml(title)}" required>
        </div>
        <div class="form-group" style="margin-bottom: 0;">
            <textarea name="itinerary_desc[]" class="form-control" rows="2" placeholder="Detalle de actividades, traslados y experiencias..." required>${escapeHtml(description)}</textarea>
        </div>
    `;
    container.appendChild(div);
}

function renumberDays(container) {
    const items = container.querySelectorAll('.day-item');
    items.forEach((item, idx) => {
        const badge = item.querySelector('.day-badge');
        if (badge) badge.textContent = `Día ${idx + 1}`;
    });
}

// Lead Status Quick Updater
function initLeadStatusUpdaters() {
    const selectors = document.querySelectorAll('.lead-status-select');
    selectors.forEach(select => {
        select.addEventListener('change', async (e) => {
            const leadId = select.getAttribute('data-lead-id');
            const newStatus = select.value;

            try {
                const isProduction = window.location.hostname === 'unu-raymi.com' || window.location.hostname.endsWith('unu-raymi.com');
                const apiBase = isProduction ? 'https://api.unu-raymi.com' : (window.location.pathname.startsWith('/admin') ? '/api' : '../api/index.php');
                const apiEndpoint = `${apiBase}/leads/${leadId}`;
                const res = await fetch(apiEndpoint, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ status: newStatus })
                });
                const data = await res.json();
                if (data.success) {
                    showToast(`Lead #${leadId} actualizado a "${newStatus}"`);
                }
            } catch (err) {
                alert('Error al actualizar el estado del lead.');
            }
        });
    });
}

function showToast(msg) {
    let toast = document.getElementById('admin-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'admin-toast';
        toast.style.cssText = 'position:fixed;bottom:24px;right:24px;background:#22C55E;color:#000;font-weight:600;padding:12px 20px;border-radius:8px;z-index:9999;box-shadow:0 10px 25px rgba(0,0,0,0.4);transition:opacity 0.3s;';
        document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.style.opacity = '1';
    setTimeout(() => { toast.style.opacity = '0'; }, 3000);
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
