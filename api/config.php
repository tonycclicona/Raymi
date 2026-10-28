<?php
/**
 * Unu Raymi - Configuration & Environment
 * Compatible with Hostinger Web Business & Local PHP Server
 */

// Error reporting for development (disable or tune for production)
ini_set('display_errors', '0');
error_reporting(E_ALL);

// Load environment variables from .env file if available
$envCandidates = [
    __DIR__ . '/.env',
    dirname(__DIR__) . '/.env',
    '/home/u209525223/domains/api.unu-raymi.com/public_html/.env',
    '/home/u209525223/domains/unu-raymi.com/public_html/.env'
];
foreach ($envCandidates as $envFile) {
    if (file_exists($envFile) && is_readable($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || str_starts_with($line, '#') || !str_contains($line, '=')) continue;
            list($envKey, $envVal) = explode('=', $line, 2);
            $envKey = trim($envKey);
            $envVal = trim(trim($envVal), "\"'\r\n");
            if (getenv($envKey) === false) {
                putenv("{$envKey}={$envVal}");
                $_ENV[$envKey] = $envVal;
                $_SERVER[$envKey] = $envVal;
            }
        }
        break;
    }
}

function env_get(string $key, $default = null) {
    $val = getenv($key);
    if ($val !== false && $val !== '') return $val;
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') return $_SERVER[$key];
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') return $_ENV[$key];
    return $default;
}

// Base Paths & Data Storage
$rootPath = dirname(__DIR__);
$dataCandidates = [
    __DIR__ . '/database/data',
    $rootPath . '/database/data',
    '/home/u209525223/domains/unu-raymi.com/public_html/database/data',
    '/home/u209525223/domains/unu-raymi.com/public_html/api/database/data',
    '/home/u209525223/domains/api.unu-raymi.com/public_html/database/data'
];
$dataPath = $rootPath . '/database/data';
foreach ($dataCandidates as $candidate) {
    if (file_exists($candidate) && is_dir($candidate)) {
        $dataPath = $candidate;
        break;
    }
}

define('ROOT_PATH', $rootPath);
define('DATA_PATH', env_get('DATA_PATH', $dataPath));

// Database Driver: 'json' (Zero config, native, instant) or 'mysql' (Hostinger MySQL)
define('DB_DRIVER', env_get('DB_DRIVER', 'json'));

// Hostinger MySQL credentials (used if DB_DRIVER is 'mysql')
define('DB_HOST', env_get('DB_HOST', 'localhost'));
define('DB_NAME', env_get('DB_NAME', 'u209525223_unuraymi'));
define('DB_USER', env_get('DB_USER', 'u209525223_admin'));
define('DB_PASS', env_get('DB_PASS', 'YourStrongPasswordHere'));
define('DB_PORT', (int)env_get('DB_PORT', 3306));

// Admin Credentials
define('ADMIN_USER', env_get('ADMIN_USER', 'admin'));
define('ADMIN_PASS_HASH', password_hash(env_get('ADMIN_PASS', 'UnuRaymi2025!'), PASSWORD_BCRYPT));

// Brand Information
define('BRAND_NAME', 'Unu Raymi');
define('BRAND_TAGLINE', 'Bespoke Luxury Journeys to Peru & South America');
define('BRAND_DOMAIN', 'unu-raymi.com');
define('API_DOMAIN', 'unu-raymi.com/api');
define('ADMIN_DOMAIN', 'unu-raymi.com/admin');

// Enable CORS for frontend and admin communication
function apply_cors_headers() {
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
    $allowedOrigins = [
        'https://unu-raymi.com',
        'https://www.unu-raymi.com',
        'https://api.unu-raymi.com',
        'http://localhost:8000',
        'http://127.0.0.1:8000',
        'http://localhost:3000'
    ];
    
    $allowOrigin = in_array($origin, $allowedOrigins) ? $origin : '*';
    header("Access-Control-Allow-Origin: {$allowOrigin}");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Allow-Credentials: true");
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }
}
