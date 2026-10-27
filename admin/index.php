<?php
/**
 * Unu Raymi Admin - Main Dashboard
 * admin.unu-raymi.com
 */

require_once __DIR__ . '/auth.php';
require_auth();

require_once __DIR__ . '/../api/db.php';

$tours = DB::getAll('tours');
$destinations = DB::getAll('destinations');
$leads = DB::getAll('leads');
$styles = DB::getAll('travel_styles');

$newLeadsCount = count(array_filter($leads, fn($l) => ($l['status'] ?? '') === 'New'));
$totalToursCount = count($tours);
$totalDestinationsCount = count($destinations);

// Recent leads (top 5)
usort($leads, fn($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
$recentLeads = array_slice($leads, 0, 5);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Unu Raymi Admin</title>
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
                <a href="index.php" class="nav-item active">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
                <a href="tours.php" class="nav-item">
                    <span class="nav-icon">🗓️</span> Tours & Itinerarios
                </a>
                <a href="destinations.php" class="nav-item">
                    <span class="nav-icon">📍</span> Destinos Geográficos
                </a>

                <div class="nav-label">Comercial & CRM</div>
                <a href="leads.php" class="nav-item">
                    <span class="nav-icon">📥</span> Bandeja de Leads
                    <?php if ($newLeadsCount > 0): ?>
                        <span class="badge badge-new" style="margin-left:auto;"><?php echo $newLeadsCount; ?></span>
                    <?php endif; ?>
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
                <div class="topbar-title">Panel de Control General</div>
                <div class="topbar-actions">
                    <a href="../frontend/index.html" target="_blank" class="view-site-link">
                        <span>Ver Sitio Web Unu Raymi</span> ↗
                    </a>
                </div>
            </header>

            <div class="content-body">
                <!-- Metrics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div>
                            <div class="stat-number"><?php echo $totalToursCount; ?></div>
                            <div class="stat-label">Tours Exclusivos</div>
                        </div>
                        <div class="stat-icon">🗓️</div>
                    </div>

                    <div class="stat-card">
                        <div>
                            <div class="stat-number"><?php echo $totalDestinationsCount; ?></div>
                            <div class="stat-label">Destinos y Hubs</div>
                        </div>
                        <div class="stat-icon">📍</div>
                    </div>

                    <div class="stat-card">
                        <div>
                            <div class="stat-number"><?php echo count($leads); ?></div>
                            <div class="stat-label">Consultas Recibidas</div>
                        </div>
                        <div class="stat-icon">📨</div>
                    </div>

                    <div class="stat-card">
                        <div>
                            <div class="stat-number"><?php echo $newLeadsCount; ?></div>
                            <div class="stat-label">Leads Nuevos (Sin Contactar)</div>
                        </div>
                        <div class="stat-icon">🔔</div>
                    </div>
                </div>

                <!-- Recent Leads Table -->
                <div class="table-card">
                    <div class="table-header">
                        <h3>Solicitudes Recientes de Viajeros (Leads CRM)</h3>
                        <a href="leads.php" class="btn btn-secondary btn-sm">Ver Todos los Leads →</a>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Viajero</th>
                                <th>Destino</th>
                                <th>Duración / Pasajeros</th>
                                <th>Presupuesto</th>
                                <th>Alojamiento</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recentLeads)): ?>
                                <tr>
                                    <td colspan="8" style="text-align:center; padding:32px; color:var(--text-muted);">
                                        No hay solicitudes registradas aún.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($recentLeads as $l): ?>
                                    <tr>
                                        <td style="color:var(--text-muted); font-size:12px;">
                                            <?php echo htmlspecialchars(substr($l['created_at'] ?? '', 0, 10)); ?>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars(($l['first_name'] ?? '') . ' ' . ($l['last_name'] ?? '')); ?></strong>
                                            <div style="font-size:12px; color:var(--text-muted);"><?php echo htmlspecialchars($l['email'] ?? ''); ?></div>
                                        </td>
                                        <td><?php echo htmlspecialchars($l['destination'] ?? 'Perú'); ?></td>
                                        <td>
                                            <?php echo htmlspecialchars($l['trip_length'] ?? ''); ?>
                                            <div style="font-size:12px; color:var(--text-muted);"><?php echo htmlspecialchars($l['travelers'] ?? ''); ?></div>
                                        </td>
                                        <td><?php echo htmlspecialchars($l['budget'] ?? 'No especificado'); ?></td>
                                        <td><?php echo htmlspecialchars($l['accommodation'] ?? 'Luxury'); ?></td>
                                        <td>
                                            <?php
                                            $st = $l['status'] ?? 'New';
                                            $badgeClass = match($st) {
                                                'New' => 'badge-new',
                                                'Contacted' => 'badge-contacted',
                                                'Booked' => 'badge-booked',
                                                default => 'badge-new'
                                            };
                                            ?>
                                            <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($st); ?></span>
                                        </td>
                                        <td>
                                            <a href="leads.php" class="btn btn-secondary btn-sm">Detalles</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Fast Actions Bar -->
                <div style="display:flex; gap:16px; margin-top:24px;">
                    <a href="tours.php" class="btn btn-primary">➕ Agregar Nuevo Tour</a>
                    <a href="destinations.php" class="btn btn-secondary">➕ Agregar Nuevo Destino</a>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/admin.js"></script>
</body>
</html>
