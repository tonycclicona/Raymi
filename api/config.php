<?php
/**
 * Unu Raymi - Configuration & Environment
 * Compatible with Hostinger Web Business & Local PHP Server
 */

// Error reporting for development (disable or tune for production)
ini_set('display_errors', '0');
error_reporting(E_ALL);

// Base Paths
define('ROOT_PATH', dirname(__DIR__));
define('DATA_PATH', ROOT_PATH . '/database/data');

// Database Driver: 'json' (Zero config, native, instant) or 'mysql' (Hostinger MySQL)
define('DB_DRIVER', getenv('DB_DRIVER') ?: 'json');

// Hostinger MySQL credentials (used if DB_DRIVER is 'mysql')
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'u123456789_unuraymi');
define('DB_USER', getenv('DB_USER') ?: 'u123456789_admin');
define('DB_PASS', getenv('DB_PASS') ?: 'YourStrongPasswordHere');
define('DB_PORT', getenv('DB_PORT') ?: 3306);

// Admin Credentials
define('ADMIN_USER', getenv('ADMIN_USER') ?: 'admin');
define('ADMIN_PASS_HASH', password_hash(getenv('ADMIN_PASS') ?: 'UnuRaymi2025!', PASSWORD_BCRYPT));

// Brand Information
define('BRAND_NAME', 'Unu Raymi');
define('BRAND_TAGLINE', 'Bespoke Luxury Journeys to Peru & South America');
define('BRAND_DOMAIN', 'unu-raymi.com');
define('ADMIN_DOMAIN', 'admin.unu-raymi.com');

// Enable CORS
function apply_cors_headers() {
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
    header("Access-Control-Allow-Origin: {$origin}");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Allow-Credentials: true");
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }
}
