<?php
/**
 * Unu Raymi Admin - Portal & Brand Settings
 */

require_once __DIR__ . '/auth.php';
require_auth();

require_once __DIR__ . '/../api/db.php';

$success = '';
$allSettings = DB::getAll('settings');
$current = $allSettings[0] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = [
        'brand_name' => trim($_POST['brand_name'] ?? 'Unu Raymi'),
        'tagline' => trim($_POST['tagline'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'whatsapp' => trim($_POST['whatsapp'] ?? ''),
        'address' => trim($_POST['address'] ?? ''),
        'currency' => trim($_POST['currency'] ?? 'USD'),
        'instagram' => trim($_POST['instagram'] ?? ''),
        'facebook' => trim($_POST['facebook'] ?? ''),
        'social_impact_initiative' => trim($_POST['social_impact_initiative'] ?? ''),
    ];

    DB::update('settings', 1, $updated);
    $current = array_merge($current, $updated);
    $success = 'Configuración actualizada exitosamente.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración General | Unu Raymi Admin</title>
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
                <a href="destinations.php" class="nav-item">
                    <span class="nav-icon">📍</span> Destinos Geográficos
                </a>

                <div class="nav-label">Comercial & CRM</div>
                <a href="leads.php" class="nav-item">
                    <span class="nav-icon">📥</span> Bandeja de Leads
                </a>

                <div class="nav-label">Configuración</div>
                <a href="settings.php" class="nav-item active">
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
                <div class="topbar-title">Configuración de Marca & Canales de Contacto</div>
            </header>

            <div class="content-body">
                <?php if ($success): ?>
                    <div class="alert" style="background:rgba(34,197,94,0.15); border:1px solid #22C55E; color:#4ADE80; padding:14px; border-radius:8px; margin-bottom:20px;">
                        ✓ <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <div class="table-card" style="padding:28px;">
                    <form method="POST" action="settings.php">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nombre Comercial de la Empresa</label>
                                <input type="text" name="brand_name" value="<?php echo htmlspecialchars($current['brand_name'] ?? 'Unu Raymi'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Moneda Base</label>
                                <input type="text" name="currency" value="<?php echo htmlspecialchars($current['currency'] ?? 'USD'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Lema / Tagline Oficial</label>
                            <input type="text" name="tagline" value="<?php echo htmlspecialchars($current['tagline'] ?? ''); ?>">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Correo de Concierge & Reservas</label>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($current['email'] ?? ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Teléfono Oficial (Oficina Cusco)</label>
                                <input type="text" name="phone" value="<?php echo htmlspecialchars($current['phone'] ?? ''); ?>">
                            </div>
                            <div class="form-group">
                                <label>WhatsApp Concierge 24/7</label>
                                <input type="text" name="whatsapp" value="<?php echo htmlspecialchars($current['whatsapp'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Dirección Física en Cusco, Perú</label>
                            <input type="text" name="address" value="<?php echo htmlspecialchars($current['address'] ?? ''); ?>">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Instagram URL</label>
                                <input type="text" name="instagram" value="<?php echo htmlspecialchars($current['instagram'] ?? ''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Facebook URL</label>
                                <input type="text" name="facebook" value="<?php echo htmlspecialchars($current['facebook'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Iniciativa Social / Sostenibilidad (Responsabilidad Social)</label>
                            <input type="text" name="social_impact_initiative" value="<?php echo htmlspecialchars($current['social_impact_initiative'] ?? ''); ?>">
                        </div>

                        <div style="margin-top:28px;">
                            <button type="submit" class="btn btn-primary">Guardar Configuración</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/admin.js"></script>
</body>
</html>
