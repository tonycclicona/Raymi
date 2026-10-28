<?php
/**
 * Unu Raymi - Universal Database Loader for Frontend
 * Resolves db.php dynamically across local development and Hostinger production
 */

if (!class_exists('DB')) {
    $searchPaths = [
        // 1. Hostinger Web Business unified production path (unu-raymi.com)
        '/home/u209525223/domains/unu-raymi.com/public_html/api/db.php',
        ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/api/db.php',
        dirname(__DIR__) . '/api/db.php',
        dirname(__DIR__, 2) . '/api/db.php',
        // 2. Legacy / Subdomain path fallback
        '/home/u209525223/domains/api.unu-raymi.com/public_html/db.php',
        dirname(__DIR__, 3) . '/api.unu-raymi.com/public_html/db.php',
        // 3. Local development path (monorepo root)
        __DIR__ . '/../../api/db.php',
        __DIR__ . '/../api/db.php'
    ];

    $loaded = false;
    foreach ($searchPaths as $path) {
        if (file_exists($path)) {
            require_once $path;
            $loaded = true;
            break;
        }
    }

    if (!$loaded) {
        error_log("Unu Raymi Frontend: Could not locate db.php in candidates list.");
    }
}
