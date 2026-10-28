<?php
/**
 * Unu Raymi Admin - Leads & Inquiries CRM
 * Inbox for custom trip planner submissions
 */

require_once __DIR__ . '/auth.php';
require_auth();

require_once __DIR__ . '/db-loader.php';

$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        $id = $_POST['id'] ?? 0;
        DB::delete('leads', $id);
        $success = 'Lead eliminado del historial.';
    } elseif ($action === 'update_status') {
        $id = $_POST['id'] ?? 0;
        $status = $_POST['status'] ?? 'New';
        DB::update('leads', $id, ['status' => $status]);
        $success = 'Estado actualizado.';
    }
}

$leads = DB::getAll('leads');
usort($leads, fn($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon & Browser Touch Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">

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
                    <img src="/assets/img/logo-icon.png" alt="Unu Raymi" class="admin-sidebar-logo" style="height: 38px; width: auto; flex-shrink: 0;">
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
                <a href="destinations.php" class="nav-item">
                    <span class="nav-icon">📍</span> Destinos Geográficos
                </a>

                <div class="nav-label">Comercial & CRM</div>
                <a href="leads.php" class="nav-item active">
                    <span class="nav-icon">📥</span> Bandeja de Leads
                    <span class="badge badge-new" style="margin-left:auto;"><?php echo count($leads); ?></span>
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
                <div class="topbar-title">Bandeja de Entrada de Solicitudes (Leads)</div>
            </header>

            <div class="content-body">
                <?php if ($success): ?>
                    <div class="alert" style="background:rgba(34,197,94,0.15); border:1px solid #22C55E; color:#4ADE80; padding:14px; border-radius:8px; margin-bottom:20px;">
                        ✓ <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <div class="table-card">
                    <div class="table-header">
                        <h3>Solicitudes de Viajeros Recibidas desde el Frontend</h3>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Viajero</th>
                                <th>Contacto</th>
                                <th>Destino Deseado</th>
                                <th>Viajeros / Duración</th>
                                <th>Presupuesto</th>
                                <th>Alojamiento</th>
                                <th>Estado CRM</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($leads)): ?>
                                <tr>
                                    <td colspan="9" style="text-align:center; padding:32px; color:var(--text-muted);">
                                        No hay solicitudes registradas aún.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($leads as $l): ?>
                                    <tr>
                                        <td style="color:var(--text-muted); font-size:12px;">
                                            <?php echo htmlspecialchars(substr($l['created_at'] ?? '', 0, 16)); ?>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars(($l['first_name'] ?? '') . ' ' . ($l['last_name'] ?? '')); ?></strong>
                                            <div style="font-size:11px; color:var(--gold);">Origen: <?php echo htmlspecialchars($l['source'] ?? 'Directo'); ?></div>
                                        </td>
                                        <td>
                                            <a href="mailto:<?php echo htmlspecialchars($l['email'] ?? ''); ?>" style="font-size:12px;"><?php echo htmlspecialchars($l['email'] ?? ''); ?></a>
                                            <div style="font-size:11px; color:var(--text-muted);"><?php echo htmlspecialchars($l['phone'] ?? 'Sin tel'); ?></div>
                                        </td>
                                        <td><strong><?php echo htmlspecialchars($l['destination'] ?? 'Perú'); ?></strong></td>
                                        <td>
                                            <?php echo htmlspecialchars($l['travelers'] ?? ''); ?>
                                            <div style="font-size:11px; color:var(--text-muted);"><?php echo htmlspecialchars($l['trip_length'] ?? ''); ?></div>
                                        </td>
                                        <td><?php echo htmlspecialchars($l['budget'] ?? 'No especificado'); ?></td>
                                        <td><?php echo htmlspecialchars($l['accommodation'] ?? 'Luxury'); ?></td>
                                        <td>
                                            <select class="form-control lead-status-select" data-lead-id="<?php echo $l['id']; ?>" style="padding:4px 8px; font-size:12px; width:auto;">
                                                <option value="New" <?php echo ($l['status'] ?? '') === 'New' ? 'selected' : ''; ?>>🟢 Nuevo</option>
                                                <option value="Contacted" <?php echo ($l['status'] ?? '') === 'Contacted' ? 'selected' : ''; ?>>🟡 Contactado</option>
                                                <option value="Booked" <?php echo ($l['status'] ?? '') === 'Booked' ? 'selected' : ''; ?>>⭐ Reservado</option>
                                                <option value="Archived" <?php echo ($l['status'] ?? '') === 'Archived' ? 'selected' : ''; ?>>Archivado</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div style="display:flex; gap:6px;">
                                                <button type="button" class="btn btn-secondary btn-sm" onclick='viewLeadModal(<?php echo json_encode($l, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>
                                                    👁️
                                                </button>
                                                <form method="POST" action="leads.php" onsubmit="return confirm('¿Eliminar este lead?');" style="margin:0;">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="id" value="<?php echo $l['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal: Lead Details View -->
    <div class="modal-backdrop" id="lead-view-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title" id="lead-modal-title">Detalles de la Solicitud</h3>
                <button type="button" class="modal-close" data-modal-close>✕</button>
            </div>
            <div class="modal-body" id="lead-modal-content">
                <!-- Injected via JS -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-modal-close>Cerrar</button>
            </div>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
    <script>
        function viewLeadModal(l) {
            document.getElementById('lead-modal-title').textContent = 'Solicitud de ' + (l.first_name || '') + ' ' + (l.last_name || '');
            const content = document.getElementById('lead-modal-content');
            content.innerHTML = `
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Correo:</strong><br><a href="mailto:${l.email}">${l.email}</a></div>
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Teléfono / WhatsApp:</strong><br>${l.phone || 'No especificado'}</div>
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Destino de Interés:</strong><br>${l.destination || 'Perú'}</div>
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Fecha Estimada:</strong><br>${l.travel_date || 'Flexible'}</div>
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Duración del Viaje:</strong><br>${l.trip_length || 'No especificado'}</div>
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Número de Pasajeros:</strong><br>${l.travelers || '2'}</div>
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Presupuesto Estimado:</strong><br>${l.budget || 'Luxury'}</div>
                    <div><strong style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Categoría de Hotel:</strong><br>${l.accommodation || '5 estrellas'}</div>
                </div>
                <div style="background:var(--bg-input); border:1px solid var(--border); border-radius:8px; padding:16px; margin-top:16px;">
                    <strong style="color:var(--gold); font-size:12px; display:block; margin-bottom:6px;">Notas / Deseos Especiales del Viajero:</strong>
                    <p style="margin:0; line-height:1.6; color:var(--text-primary);">${l.notes || 'Sin comentarios adicionales.'}</p>
                </div>
            `;
            openModal('lead-view-modal');
        }
    </script>
</body>
</html>
