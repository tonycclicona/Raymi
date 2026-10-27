<?php
/**
 * Unu Raymi Admin - Tour & Itinerary Manager
 * Matches reverse engineered tour patterns (Day-by-Day accordion, inclusions, metadata)
 */

require_once __DIR__ . '/auth.php';
require_auth();

require_once __DIR__ . '/../api/db.php';

$success = '';
$error = '';

// Handle Form Submissions (Create / Update / Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'save';

    if ($action === 'delete') {
        $id = $_POST['id'] ?? 0;
        if (DB::delete('tours', $id)) {
            $success = 'Tour eliminado exitosamente.';
        } else {
            $error = 'Error al eliminar el tour.';
        }
    } elseif ($action === 'save') {
        $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

        // Build Itinerary Array from Repeater
        $itinerary = [];
        $dayTitles = $_POST['itinerary_title'] ?? [];
        $dayDescs = $_POST['itinerary_desc'] ?? [];
        for ($i = 0; $i < count($dayTitles); $i++) {
            if (!empty(trim($dayTitles[$i]))) {
                $itinerary[] = [
                    'day' => $i + 1,
                    'title' => trim($dayTitles[$i]),
                    'description' => trim($dayDescs[$i] ?? '')
                ];
            }
        }

        // Parse Inclusions & Exclusions
        $inclusions = array_values(array_filter(array_map('trim', explode("\n", $_POST['inclusions'] ?? ''))));
        $exclusions = array_values(array_filter(array_map('trim', explode("\n", $_POST['exclusions'] ?? ''))));

        $tourData = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => !empty($_POST['slug']) ? trim($_POST['slug']) : strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['title']))),
            'duration_days' => (int)($_POST['duration_days'] ?? 1),
            'category' => trim($_POST['category'] ?? 'Iconic Luxury'),
            'country' => trim($_POST['country'] ?? 'peru'),
            'featured' => !empty($_POST['featured']),
            'image' => trim($_POST['image'] ?? 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1200&q=80'),
            'tagline' => trim($_POST['tagline'] ?? ''),
            'overview' => trim($_POST['overview'] ?? ''),
            'inclusions' => $inclusions,
            'exclusions' => $exclusions,
            'itinerary' => $itinerary
        ];

        if ($id) {
            $res = DB::update('tours', $id, $tourData);
            $success = "Tour '{$tourData['title']}' actualizado con éxito.";
        } else {
            $res = DB::insert('tours', $tourData);
            $success = "Nuevo tour '{$tourData['title']}' creado con éxito.";
        }
    }
}

$tours = DB::getAll('tours');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tours & Itinerarios | Unu Raymi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <span class="brand-crest">✦</span>
                    <div class="brand-text">
                        <h2>UNU RAYMI</h2>
                        <span>CMS & Portal Admin</span>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-label">Catálogo & Contenidos</div>
                <a href="index.php" class="nav-item">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
                <a href="tours.php" class="nav-item active">
                    <span class="nav-icon">🗓️</span> Tours & Itinerarios
                </a>
                <a href="destinations.php" class="nav-item">
                    <span class="nav-icon">📍</span> Destinos Geográficos
                </a>

                <div class="nav-label">Comercial & CRM</div>
                <a href="leads.php" class="nav-item">
                    <span class="nav-icon">📥</span> Bandeja de Leads
                </a>

                <div class="nav-label">Configuración</div>
                <a href="settings.php" class="nav-item">
                    <span class="nav-icon">⚙️</span> Configuración General
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-user-info">
                    <div class="user-avatar">UR</div>
                    <div class="user-meta">
                        <div class="user-name"><?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?></div>
                        <div class="user-role">Super Admin</div>
                    </div>
                </div>
                <a href="login.php?logout=1" title="Cerrar sesión" style="color:var(--text-muted); font-size:16px;">🚪</a>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="main-content">
            <header class="topbar">
                <div class="topbar-title">Catálogo de Tours Exclusivos (<?php echo count($tours); ?>)</div>
                <div class="topbar-actions">
                    <button type="button" class="btn btn-primary" onclick="openCreateTourModal()">
                        ➕ Crear Nuevo Tour
                    </button>
                </div>
            </header>

            <div class="content-body">
                <?php if ($success): ?>
                    <div class="alert" style="background:rgba(34,197,94,0.15); border:1px solid #22C55E; color:#4ADE80; padding:14px; border-radius:8px; margin-bottom:20px;">
                        ✓ <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-error">
                        ⚠️ <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <div class="table-card">
                    <div class="table-header">
                        <h3>Listado de Paquetes & Itinerarios Día a Día (<?php echo count($tours); ?>)</h3>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <label style="font-size:11px; color:var(--text-muted); text-transform:uppercase; margin:0; letter-spacing:0.1em;">Filtrar País:</label>
                            <select id="admin-country-filter" class="form-control" style="width:auto; padding:6px 12px; font-size:12px;" onchange="filterAdminTours(this.value)">
                                <option value="all">🌎 Todos los Países (<?php echo count($tours); ?>)</option>
                                <option value="peru">🇵🇪 Perú (<?php echo count(array_filter($tours, fn($t) => ($t['country'] ?? '') === 'peru')); ?>)</option>
                                <option value="chile">🇨🇱 Chile (<?php echo count(array_filter($tours, fn($t) => ($t['country'] ?? '') === 'chile')); ?>)</option>
                            </select>
                        </div>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Portada</th>
                                <th>Nombre del Tour</th>
                                <th>País</th>
                                <th>Duración</th>
                                <th>Categoría</th>
                                <th>Días en Itinerario</th>
                                <th>Destacado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tours as $t): ?>
                                <tr data-country="<?php echo strtolower($t['country'] ?? 'peru'); ?>">
                                    <td style="width:70px;">
                                        <img src="<?php echo htmlspecialchars($t['image'] ?? ''); ?>" alt="Thumbnail" style="width:50px; height:38px; object-fit:cover; border-radius:4px; border:1px solid var(--border);">
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($t['title'] ?? ''); ?></strong>
                                        <div style="font-size:12px; color:var(--text-muted);">/<?php echo htmlspecialchars($t['slug'] ?? ''); ?>/</div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background:rgba(255,255,255,0.08); color:var(--text-primary);">
                                            <?php echo strtoupper(htmlspecialchars($t['country'] ?? 'PERU')); ?>
                                        </span>
                                    </td>
                                    <td><strong><?php echo (int)($t['duration_days'] ?? 1); ?> Días</strong></td>
                                    <td><?php echo htmlspecialchars($t['category'] ?? ''); ?></td>
                                    <td><?php echo count($t['itinerary'] ?? []); ?> días detallados</td>
                                    <td>
                                        <?php if (!empty($t['featured'])): ?>
                                            <span class="badge badge-featured">⭐ Destacado</span>
                                        <?php else: ?>
                                            <span style="color:var(--text-muted); font-size:12px;">Estándar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button type="button" class="btn btn-secondary btn-sm edit-tour-btn" data-tour-id="<?php echo $t['id']; ?>">
                                                ✏️ Editar
                                            </button>
                                            <form method="POST" action="tours.php" onsubmit="return confirm('¿Seguro que deseas eliminar este tour?');" style="margin:0;">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal: Tour Editor with Day-by-Day Repeater -->
    <div class="modal-backdrop" id="tour-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title" id="tour-modal-title">Editar Tour & Itinerario</h3>
                <button type="button" class="modal-close" data-modal-close>✕</button>
            </div>
            <form method="POST" action="tours.php" id="tour-form">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" id="form-tour-id" value="">

                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group" style="flex:2;">
                            <label>Título del Tour *</label>
                            <input type="text" name="title" id="form-tour-title" required placeholder="Ej: Machu Picchu Luxury Tours">
                        </div>
                        <div class="form-group" style="flex:1;">
                            <label>Slug URL (automático o personalizado)</label>
                            <input type="text" name="slug" id="form-tour-slug" placeholder="machu-picchu-luxury-tours">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Duración (Días) *</label>
                            <input type="number" name="duration_days" id="form-tour-days" min="1" max="60" value="8" required>
                        </div>
                        <div class="form-group">
                            <label>Categoría</label>
                            <input type="text" name="category" id="form-tour-category" placeholder="Ej: Iconic Luxury, Gastronomy, Adventure">
                        </div>
                        <div class="form-group">
                            <label>País Principal</label>
                            <select name="country" id="form-tour-country" class="form-control">
                                <option value="peru">Perú</option>
                                <option value="bolivia">Bolivia</option>
                                <option value="ecuador">Ecuador & Galápagos</option>
                                <option value="chile">Chile</option>
                                <option value="colombia">Colombia</option>
                                <option value="argentina">Argentina</option>
                            </select>
                        </div>
                        <div class="form-group" style="display:flex; align-items:center; gap:8px; margin-top:24px;">
                            <label style="margin:0; cursor:pointer;">
                                <input type="checkbox" name="featured" id="form-tour-featured" value="1">
                                Tour Destacado en Home
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>URL de Imagen de Portada</label>
                        <input type="text" name="image" id="form-tour-image" placeholder="https://images.unsplash.com/...">
                    </div>

                    <div class="form-group">
                        <label>Subtítulo / Tagline</label>
                        <input type="text" name="tagline" id="form-tour-tagline" placeholder="Una frase atractiva de presentación">
                    </div>

                    <div class="form-group">
                        <label>Descripción General (Overview)</label>
                        <textarea name="overview" id="form-tour-overview" rows="3" placeholder="Resumen editorial del viaje para el cliente..."></textarea>
                    </div>

                    <!-- Itinerary Day-by-Day Section -->
                    <div style="margin-top:24px;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                            <label style="font-size:14px; color:var(--gold-light); margin:0;">🗓️ Itinerario Día a Día</label>
                            <button type="button" class="btn btn-secondary btn-sm" id="add-day-btn">➕ Agregar Día</button>
                        </div>
                        <div class="itinerary-repeater" id="itinerary-container">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                    <!-- Inclusions & Exclusions -->
                    <div class="form-row" style="margin-top:20px;">
                        <div class="form-group">
                            <label>Qué Incluye (1 por línea)</label>
                            <textarea name="inclusions" id="form-tour-inclusions" rows="4" placeholder="Todos los traslados privados&#10;Hoteles Belmond 5 estrellas&#10;Guía privado oficial"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Qué Excluye (1 por línea)</label>
                            <textarea name="exclusions" id="form-tour-exclusions" rows="4" placeholder="Vuelos internacionales&#10;Propinas discrecionales"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-modal-close>Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Tour</button>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
    <script>
        function openCreateTourModal() {
            document.getElementById('tour-modal-title').textContent = 'Crear Nuevo Tour';
            document.getElementById('form-tour-id').value = '';
            document.getElementById('form-tour-title').value = '';
            document.getElementById('form-tour-slug').value = '';
            document.getElementById('form-tour-days').value = '7';
            document.getElementById('form-tour-category').value = 'Iconic Luxury';
            document.getElementById('form-tour-country').value = 'peru';
            document.getElementById('form-tour-featured').checked = false;
            document.getElementById('form-tour-image').value = 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1200&q=80';
            document.getElementById('form-tour-tagline').value = '';
            document.getElementById('form-tour-overview').value = '';
            document.getElementById('form-tour-inclusions').value = "Traslados privados 24/7\nAlojamiento boutique / 5 estrellas\nGuía oficial bilingüe privado\nDesayunos gourmet";
            document.getElementById('form-tour-exclusions').value = "Vuelos internacionales\nSeguro de viaje";

            const container = document.getElementById('itinerary-container');
            container.innerHTML = '';
            appendDayItem(container, 1, 'Llegada y Bienvenida Privada', 'Recepción en el aeropuerto y traslado a su suite.');
            appendDayItem(container, 2, 'Exploración Cultural Privada', 'Visita guiada exclusiva a los sitios emblemáticos.');

            openModal('tour-modal');
        }

        function editTour(t) {
            document.getElementById('tour-modal-title').textContent = 'Editar Tour: ' + t.title;
            document.getElementById('form-tour-id').value = t.id || '';
            document.getElementById('form-tour-title').value = t.title || '';
            document.getElementById('form-tour-slug').value = t.slug || '';
            document.getElementById('form-tour-days').value = t.duration_days || 1;
            document.getElementById('form-tour-category').value = t.category || '';
            document.getElementById('form-tour-country').value = t.country || 'peru';
            document.getElementById('form-tour-featured').checked = !!t.featured;
            document.getElementById('form-tour-image').value = t.image || '';
            document.getElementById('form-tour-tagline').value = t.tagline || '';
            document.getElementById('form-tour-overview').value = t.overview || '';
            document.getElementById('form-tour-inclusions').value = (t.inclusions || []).join('\n');
            document.getElementById('form-tour-exclusions').value = (t.exclusions || []).join('\n');

            const container = document.getElementById('itinerary-container');
            container.innerHTML = '';
            if (t.itinerary && t.itinerary.length > 0) {
                t.itinerary.forEach((d, idx) => {
                    appendDayItem(container, idx + 1, d.title || '', d.description || '');
                });
            } else {
                appendDayItem(container, 1, 'Día 1', 'Actividades del día...');
            }

            openModal('tour-modal');
        }

        const ALL_TOURS = <?php echo json_encode($tours, JSON_UNESCAPED_UNICODE); ?>;

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.edit-tour-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = parseInt(btn.getAttribute('data-tour-id'));
                    const tour = ALL_TOURS.find(t => t.id === id);
                    if (tour) editTour(tour);
                });
            });
        });

        function filterAdminTours(country) {
            document.querySelectorAll('tbody tr[data-country]').forEach(row => {
                if (country === 'all' || row.getAttribute('data-country') === country) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
