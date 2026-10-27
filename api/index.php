<?php
/**
 * Unu Raymi - REST API
 * Unified controller for Frontend and Admin communication
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

apply_cors_headers();

header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normalize path: remove /api, /index.php, and script paths
$uri = preg_replace('#^.*?/api/?(index\.php/?)?#', '/', $uri);
$uri = preg_replace('#^/index\.php/?#', '/', $uri);
$uri = '/' . ltrim($uri, '/');

// Parse segments
$segments = array_values(array_filter(explode('/', $uri)));
$resource = $segments[0] ?? 'health';
$idOrSlug = $segments[1] ?? null;

// JSON request body parser
$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

function response(array $data, int $statusCode = 200): void {
    http_response_code($statusCode);
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

try {
    switch ($resource) {
        case 'health':
            response([
                'status' => 'online',
                'service' => 'Unu Raymi API',
                'version' => '1.0.0',
                'brand' => BRAND_NAME,
                'driver' => DB_DRIVER,
                'timestamp' => date('c')
            ]);
            break;

        case 'settings':
            if ($method === 'GET') {
                $all = DB::getAll('settings');
                response($all[0] ?? []);
            } elseif ($method === 'PUT' || $method === 'POST') {
                $updated = DB::update('settings', 1, $input);
                response(['success' => true, 'data' => $updated]);
            }
            break;

        case 'styles':
            if ($method === 'GET') {
                $styles = DB::getAll('travel_styles');
                response($styles);
            }
            break;

        case 'destinations':
            if ($method === 'GET') {
                if ($idOrSlug) {
                    $item = is_numeric($idOrSlug) ? DB::getById('destinations', $idOrSlug) : DB::getBySlug('destinations', $idOrSlug);
                    if (!$item) response(['error' => 'Destination not found'], 404);
                    response($item);
                } else {
                    $all = DB::getAll('destinations');
                    $country = $_GET['country'] ?? null;
                    if ($country) {
                        $all = array_values(array_filter($all, fn($d) => ($d['country'] ?? '') === $country));
                    }
                    response($all);
                }
            } elseif ($method === 'POST') {
                if (empty($input['name'])) response(['error' => 'Name is required'], 400);
                if (empty($input['slug'])) {
                    $input['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['name'])));
                }
                $created = DB::insert('destinations', $input);
                response(['success' => true, 'data' => $created], 201);
            } elseif ($method === 'PUT' && $idOrSlug) {
                $updated = DB::update('destinations', $idOrSlug, $input);
                if (!$updated) response(['error' => 'Destination not found'], 404);
                response(['success' => true, 'data' => $updated]);
            } elseif ($method === 'DELETE' && $idOrSlug) {
                $deleted = DB::delete('destinations', $idOrSlug);
                response(['success' => $deleted]);
            }
            break;

        case 'tours':
            if ($method === 'GET') {
                if ($idOrSlug) {
                    $item = is_numeric($idOrSlug) ? DB::getById('tours', $idOrSlug) : DB::getBySlug('tours', $idOrSlug);
                    if (!$item) response(['error' => 'Tour not found'], 404);
                    response($item);
                } else {
                    $all = DB::getAll('tours');
                    if (isset($_GET['featured'])) {
                        $all = array_values(array_filter($all, fn($t) => !empty($t['featured'])));
                    }
                    if (isset($_GET['category'])) {
                        $all = array_values(array_filter($all, fn($t) => ($t['category'] ?? '') === $_GET['category']));
                    }
                    response($all);
                }
            } elseif ($method === 'POST') {
                if (empty($input['title'])) response(['error' => 'Title is required'], 400);
                if (empty($input['slug'])) {
                    $input['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['title'])));
                }
                $created = DB::insert('tours', $input);
                response(['success' => true, 'data' => $created], 201);
            } elseif ($method === 'PUT' && $idOrSlug) {
                $updated = DB::update('tours', $idOrSlug, $input);
                if (!$updated) response(['error' => 'Tour not found'], 404);
                response(['success' => true, 'data' => $updated]);
            } elseif ($method === 'DELETE' && $idOrSlug) {
                $deleted = DB::delete('tours', $idOrSlug);
                response(['success' => $deleted]);
            }
            break;

        case 'leads':
            if ($method === 'POST') {
                // Public lead submission (Contact / Custom Trip Planner form)
                if (empty($input['first_name']) || empty($input['email'])) {
                    response(['error' => 'First name and email are required'], 400);
                }
                $lead = [
                    'first_name' => htmlspecialchars(trim($input['first_name'])),
                    'last_name' => htmlspecialchars(trim($input['last_name'] ?? '')),
                    'email' => filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL),
                    'phone' => htmlspecialchars(trim($input['phone'] ?? '')),
                    'destination' => htmlspecialchars(trim($input['destination'] ?? 'Peru')),
                    'travel_date' => htmlspecialchars(trim($input['travel_date'] ?? '')),
                    'trip_length' => htmlspecialchars(trim($input['trip_length'] ?? '')),
                    'travelers' => htmlspecialchars(trim($input['travelers'] ?? '2 adults')),
                    'budget' => htmlspecialchars(trim($input['budget'] ?? '$5,000 - $10,000 per person')),
                    'accommodation' => htmlspecialchars(trim($input['accommodation'] ?? 'Luxury (5-star)')),
                    'source' => htmlspecialchars(trim($input['source'] ?? 'Website Direct')),
                    'notes' => htmlspecialchars(trim($input['notes'] ?? '')),
                    'status' => 'New'
                ];
                $created = DB::insert('leads', $lead);
                response([
                    'success' => true,
                    'message' => 'Thank you for reaching out to Unu Raymi. A dedicated private concierge will contact you within 24 hours.',
                    'lead_id' => $created['id']
                ], 201);
            } elseif ($method === 'GET') {
                // Admin lead list
                $leads = DB::getAll('leads');
                // Sort newest first
                usort($leads, fn($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
                response($leads);
            } elseif ($method === 'PUT' && $idOrSlug) {
                $updated = DB::update('leads', $idOrSlug, $input);
                response(['success' => true, 'data' => $updated]);
            } elseif ($method === 'DELETE' && $idOrSlug) {
                $deleted = DB::delete('leads', $idOrSlug);
                response(['success' => $deleted]);
            }
            break;

        default:
            response(['error' => "Endpoint not found: {$resource}"], 404);
    }
} catch (Throwable $e) {
    response(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
}
