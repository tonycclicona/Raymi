<?php
/**
 * Unu Raymi Admin - Geographic Destinations & Hubs Manager
 */

require_once __DIR__ . '/auth.php';
require_auth();

require_once __DIR__ . '/../api/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'save';

    if ($action === 'delete') {
        $id = $_POST['id'] ?? 0;
        if (DB::delete('destinations', $id)) {
            $success = 'Destino eliminado exitosamente.';
        } else {
            $error = 'Error al eliminar el destino.';
        }
    } elseif ($action === 'save') {
        $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

        $highlights = array_values(array_filter(array_map('trim', explode("\n", $_POST['highlights'] ?? ''))));

        $destData = [
            'name' => trim($_POST['name'] ?? ''),
            'slug' => !empty($_POST['slug']) ? trim($_POST['slug']) : strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name']))),
            'country' => trim($_POST['country'] ?? 'peru'),
            'subtitle' => trim($_POST['subtitle'] ?? ''),
            'image' => trim($_POST['image'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'has_form' => !empty($_POST['has_form']),
            'highlights' => $highlights,
        ];

        if ($id) {
            DB::update('destinations', $id, $destData);
            $success = "Destino '{$destData['name']}' actualizado.";
        } else {
            DB::insert('destinations', $destData);
            $success = "Nuevo destino '{$destData['name']}' creado.";
        }
    }
}

$destinations = DB::getAll('destinations');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos Geográficos | Unu Raymi Admin</title>
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
                <a href="tours.php" class="nav-item">
                    <span class="nav-icon">🗓️</span> Tours & Itinerarios
                </a>
                <a href="destinations.php" class="nav-item active">
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
                <div class="topbar-title">Destinos Geográficos & Hubs (<?php echo count($destinations); ?>)</div>
                <div class="topbar-actions">
                    <button type="button" class="btn btn-primary" onclick="openCreateDestModal()">
                        ➕ Agregar Destino
                    </button>
                </div>
            </header>

            <div class="content-body">
                <?php if ($success): ?>
                    <div class="alert" style="background:rgba(34,197,94,0.15); border:1px solid #22C55E; color:#4ADE80; padding:14px; border-radius:8px; margin-bottom:20px;">
                        ✓ <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <div class="table-card">
                    <div class="table-header" style="display:flex; justify-content:space-between; align-items:center;">
                        <h3>Hubs Editoriales & Páginas Regionales</h3>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <span style="font-size:13px; color:var(--text-muted);">Filtrar por país:</span>
                            <select id="country-filter" class="form-control" style="width:180px; padding:6px 12px; font-size:13px;" onchange="filterAdminDests(this.value)">
                                <option value="all">Todos los países (<?php echo count($destinations); ?>)</option>
                                <option value="peru">🇵🇪 Perú</option>
                                <option value="chile">🇨🇱 Chile</option>
                                <option value="international">🌎 Regional / Otros</option>
                            </select>
                        </div>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>País</th>
                                <th>Subtítulo</th>
                                <th>Highlights</th>
                                <th>Form Directo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($destinations as $d): ?>
                                <tr data-country="<?php echo strtolower(htmlspecialchars($d['country'] ?? 'peru')); ?>">
                                    <td style="width:70px;">
                                        <img src="<?php echo htmlspecialchars($d['image'] ?? ''); ?>" alt="Cover" style="width:50px; height:38px; object-fit:cover; border-radius:4px; border:1px solid var(--border);">
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($d['name'] ?? ''); ?></strong>
                                        <div style="font-size:12px; color:var(--text-muted);">/<?php echo htmlspecialchars($d['slug'] ?? ''); ?>/</div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background:rgba(255,255,255,0.08); color:var(--text-primary);">
                                            <?php echo strtoupper(htmlspecialchars($d['country'] ?? 'PERU')); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($d['subtitle'] ?? ''); ?></td>
                                    <td><?php echo count($d['highlights'] ?? []); ?> puntos clave</td>
                                    <td>
                                        <?php if (!empty($d['has_form'])): ?>
                                            <span class="badge badge-booked">Sí (Alta Conversión)</span>
                                        <?php else: ?>
                                            <span style="color:var(--text-muted); font-size:12px;">CTA Estándar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button type="button" class="btn btn-secondary btn-sm edit-dest-btn" data-dest-id="<?php echo $d['id']; ?>">
                                                ✏️
                                            </button>
                                            <form method="POST" action="destinations.php" onsubmit="return confirm('¿Eliminar este destino?');" style="margin:0;">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
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

    <!-- Modal: Destination Editor -->
    <div class="modal-backdrop" id="dest-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title" id="dest-modal-title">Editar Destino Geográfico</h3>
                <button type="button" class="modal-close" data-modal-close>✕</button>
            </div>
            <form method="POST" action="destinations.php">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" id="form-dest-id" value="">

                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group" style="flex:2;">
                            <label>Nombre del Destino *</label>
                            <input type="text" name="name" id="form-dest-name" required placeholder="Ej: Cusco, Sacred Valley, Salar de Uyuni">
                        </div>
                        <div class="form-group" style="flex:1;">
                            <label>Slug URL</label>
                            <input type="text" name="slug" id="form-dest-slug" placeholder="cusco">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>País / Región</label>
                            <select name="country" id="form-dest-country" class="form-control">
                                <option value="peru">🇵🇪 Perú</option>
                                <option value="chile">🇨🇱 Chile</option>
                                <option value="bolivia">🇧🇴 Bolivia</option>
                                <option value="ecuador">🇪🇨 Ecuador / Galápagos</option>
                                <option value="colombia">🇨🇴 Colombia</option>
                                <option value="argentina">🇦🇷 Argentina</option>
                                <option value="international">🌎 Sudamérica / Regional</option>
                            </select>
                        </div>
                        <div class="form-group" style="display:flex; align-items:center; gap:8px; margin-top:24px;">
                            <label style="margin:0; cursor:pointer;">
                                <input type="checkbox" name="has_form" id="form-dest-has-form" value="1">
                                Formulario de Captura Directo (Landing Page de Conversión)
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subtítulo Evocativo</label>
                        <input type="text" name="subtitle" id="form-dest-subtitle" placeholder="Ej: The Legendary Citadel in the Clouds">
                    </div>

                    <div class="form-group">
                        <label>URL de Imagen Principal</label>
                        <input type="text" name="image" id="form-dest-image" placeholder="https://images.unsplash.com/...">
                    </div>

                    <div class="form-group">
                        <label>Extracto Editorial (Storytelling)</label>
                        <textarea name="excerpt" id="form-dest-excerpt" rows="3" placeholder="Párrafo sensorial que introduce la magia de este destino..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Puntos Destacados / Highlights (1 por línea)</label>
                        <textarea name="highlights" id="form-dest-highlights" rows="4" placeholder="Acceso privado al amanecer&#10;Tren Belmond Hiram Bingham&#10;Ceremonia con chamán andino"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-modal-close>Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Destino</button>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
    <script>
        function openCreateDestModal() {
            document.getElementById('dest-modal-title').textContent = 'Crear Nuevo Destino';
            document.getElementById('form-dest-id').value = '';
            document.getElementById('form-dest-name').value = '';
            document.getElementById('form-dest-slug').value = '';
            document.getElementById('form-dest-country').value = 'peru';
            document.getElementById('form-dest-has-form').checked = false;
            document.getElementById('form-dest-subtitle').value = '';
            document.getElementById('form-dest-image').value = 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1600&q=80';
            document.getElementById('form-dest-excerpt').value = '';
            document.getElementById('form-dest-highlights').value = "Visitas privadas sin aglomeraciones\nGuías arqueológicos especializados\nHoteles boutique de lujo";
            openModal('dest-modal');
        }

        function editDest(d) {
            document.getElementById('dest-modal-title').textContent = 'Editar Destino: ' + d.name;
            document.getElementById('form-dest-id').value = d.id || '';
            document.getElementById('form-dest-name').value = d.name || '';
            document.getElementById('form-dest-slug').value = d.slug || '';
            document.getElementById('form-dest-country').value = d.country || 'peru';
            document.getElementById('form-dest-has-form').checked = !!d.has_form;
            document.getElementById('form-dest-subtitle').value = d.subtitle || '';
            document.getElementById('form-dest-image').value = d.image || '';
            document.getElementById('form-dest-excerpt').value = d.excerpt || '';
            document.getElementById('form-dest-highlights').value = (d.highlights || []).join('\n');
            openModal('dest-modal');
        }

        function filterAdminDests(country) {
            document.querySelectorAll('.data-table tbody tr').forEach(row => {
                const rowCountry = row.getAttribute('data-country');
                if (country === 'all' || rowCountry === country) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        const ALL_DESTS = <?php echo json_encode($destinations, JSON_UNESCAPED_UNICODE); ?>;

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.edit-dest-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = parseInt(btn.getAttribute('data-dest-id'));
                    const dest = ALL_DESTS.find(d => d.id === id);
                    if (dest) editDest(dest);
                });
            });
        });
    </script>
</body>
</html>
