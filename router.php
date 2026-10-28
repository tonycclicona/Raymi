<?php
/**
 * Unu Raymi - Local Development Router for PHP Built-in Server
 * Usage: php -S localhost:8000 router.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 1. Direct file check in workspace root or subdirectories
$targetFile = __DIR__ . $uri;
if ($uri !== '/' && file_exists($targetFile) && !is_dir($targetFile)) {
    return false; // Built-in server serves it directly
}

// 2. Static asset fallback for frontend/ (css, js, images) when accessed from root
$frontendAsset = __DIR__ . '/frontend' . $uri;
if (file_exists($frontendAsset) && !is_dir($frontendAsset)) {
    $ext = strtolower(pathinfo($frontendAsset, PATHINFO_EXTENSION));
    $mimes = [
        'css' => 'text/css; charset=UTF-8',
        'js' => 'application/javascript; charset=UTF-8',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'svg' => 'image/svg+xml',
        'json' => 'application/json',
        'webp' => 'image/webp',
        'woff2' => 'font/woff2',
        'woff' => 'font/woff'
    ];
    if (isset($mimes[$ext])) {
        header('Content-Type: ' . $mimes[$ext]);
    }
    readfile($frontendAsset);
    exit;
}

// 3. Map /admin to Admin Panel
if ($uri === '/admin' || $uri === '/admin/') {
    header('Location: /admin/index.php');
    exit;
}
if (str_starts_with($uri, '/admin/')) {
    $adminFile = __DIR__ . $uri;
    if (file_exists($adminFile) && !is_dir($adminFile)) {
        return false;
    }
}

// 4. Map /api to API Router
if (str_starts_with($uri, '/api')) {
    require __DIR__ . '/api/index.php';
    exit;
}

// 5. Clean URLs for Subpages (Multi-page routing matching kuodatravel.com)
$trimmedUri = rtrim($uri, '/');

// Tours Catalog
if ($trimmedUri === '/tours') {
    require __DIR__ . '/frontend/tours.php';
    exit;
}

// Tour Detail Page: /tour/{slug} or /tours/{slug}
if (preg_match('#^/tours?/([a-zA-Z0-9_\-]+)$#', $trimmedUri, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/frontend/tour.php';
    exit;
}

// Destinations Catalog
if ($trimmedUri === '/destinations') {
    require __DIR__ . '/frontend/destinations.php';
    exit;
}

// Country Destination Page: /destinations/{country} (matching Kuoda Travel /destinations/peru/, /destinations/chile/, etc.)
if (preg_match('#^/destinations?/(peru|chile|bolivia|ecuador|colombia|argentina)$#i', $trimmedUri, $matches)) {
    $_GET['country'] = strtolower($matches[1]);
    require __DIR__ . '/frontend/country.php';
    exit;
}

// Geographic Destination Detail Page: /destination/{slug} or /destinations/{slug}
if (preg_match('#^/destinations?/([a-zA-Z0-9_\-]+)$#', $trimmedUri, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/frontend/destination.php';
    exit;
}

// Contact / Custom Journey Designer
if (in_array($trimmedUri, ['/contact', '/contact-us', '/custom-journey', '/plan-your-trip'])) {
    require __DIR__ . '/frontend/contact.php';
    exit;
}

// About Us / The Unu Raymi Difference
if (in_array($trimmedUri, ['/about', '/about-us', '/the-unu-raymi-difference'])) {
    require __DIR__ . '/frontend/about.php';
    exit;
}

// Responsible Travel
if ($trimmedUri === '/responsible-travel') {
    require __DIR__ . '/frontend/responsible-travel.php';
    exit;
}

// Direct php execution in frontend if requested
$frontendPhp = __DIR__ . '/frontend' . $uri;
if (file_exists($frontendPhp) && !is_dir($frontendPhp) && str_ends_with($frontendPhp, '.php')) {
    require $frontendPhp;
    exit;
}

// 6. Map Root or fallback to Frontend Index
if ($uri === '/' || $uri === '' || $uri === '/index.php') {
    include __DIR__ . '/frontend/index.php';
    exit;
}

return false;
