<?php
/**
 * Unu Raymi Admin - Login Screen
 */

require_once __DIR__ . '/auth.php';

$error = '';

if (isset($_GET['logout'])) {
    handle_logout();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    // Check credentials (supports config password or env override)
    if ($user === ADMIN_USER && password_verify($pass, ADMIN_PASS_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $user;
        $_SESSION['admin_login_time'] = time();
        header('Location: index.php');
        exit;
    } else {
        $error = 'Credenciales no válidas. Por favor verifique usuario y contraseña.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrador | Unu Raymi</title>
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
<body class="login-body">
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-brand" style="text-align: center; margin-bottom: 24px;">
                <img src="/assets/img/logo-light.png" alt="Unu Raymi Expeditions" style="max-height: 85px; width: auto; margin-bottom: 12px; display: inline-block;">
                <p class="brand-subtitle">Panel de Control & CMS de Viajes de Lujo</p>
                <div class="admin-host-badge">unu-raymi.com/admin</div>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <span>⚠️ <?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php" class="login-form">
                <div class="form-group">
                    <label for="username">Usuario Administrador</label>
                    <input type="text" id="username" name="username" placeholder="admin" required autofocus value="admin">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required value="UnuRaymi2025!">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Ingresar al Panel</button>
            </form>

            <div class="login-footer">
                <p>Credenciales por defecto: <code>admin</code> / <code>UnuRaymi2025!</code></p>
                <p class="security-note">Compatible con Hostinger Web Business & PHP 8.x</p>
            </div>
        </div>
    </div>
</body>
</html>
