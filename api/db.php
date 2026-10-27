<?php
/**
 * Unu Raymi - Storage Engine & Data Access Layer
 * Supports atomic JSON file storage (zero setup, ultra-fast) and Hostinger MySQL
 */

require_once __DIR__ . '/config.php';

class DB {
    private static ?PDO $pdo = null;

    /**
     * Get MySQL PDO connection if driver is mysql
     */
    public static function getPDO(): ?PDO {
        if (DB_DRIVER !== 'mysql') {
            return null;
        }

        if (self::$pdo === null) {
            $dsn = sprintf("mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4", DB_HOST, DB_PORT, DB_NAME);
            self::$pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }
        return self::$pdo;
    }

    /**
     * File path for JSON collection
     */
    private static function getFilePath(string $collection): string {
        if (!is_dir(DATA_PATH)) {
            mkdir(DATA_PATH, 0755, true);
        }
        return DATA_PATH . '/' . preg_replace('/[^a-zA-Z0-9_\-]/', '', $collection) . '.json';
    }

    /**
     * Read all records from a collection
     */
    public static function getAll(string $collection): array {
        if (DB_DRIVER === 'mysql') {
            $stmt = self::getPDO()->query("SELECT * FROM `{$collection}`");
            return $stmt->fetchAll();
        }

        $file = self::getFilePath($collection);
        if (!file_exists($file)) {
            return [];
        }

        $fp = fopen($file, 'r');
        if (!$fp) return [];
        flock($fp, LOCK_SH);
        $content = stream_get_contents($fp);
        flock($fp, LOCK_UN);
        fclose($fp);

        $data = json_decode($content, true);
        return is_array($data) ? $data : [];
    }

    /**
     * Find single record by ID
     */
    public static function getById(string $collection, int|string $id): ?array {
        $all = self::getAll($collection);
        foreach ($all as $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Find single record by slug
     */
    public static function getBySlug(string $collection, string $slug): ?array {
        $all = self::getAll($collection);
        foreach ($all as $item) {
            if (isset($item['slug']) && $item['slug'] === $slug) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Save all records back to JSON file atomically
     */
    private static function saveAll(string $collection, array $data): bool {
        $file = self::getFilePath($collection);
        $fp = fopen($file, 'c+');
        if (!$fp) return false;

        if (flock($fp, LOCK_EX)) {
            ftruncate($fp, 0);
            fwrite($fp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            fflush($fp);
            flock($fp, LOCK_UN);
            fclose($fp);
            return true;
        }

        fclose($fp);
        return false;
    }

    /**
     * Insert new record into collection
     */
    public static function insert(string $collection, array $record): array {
        $all = self::getAll($collection);
        
        // Auto-increment ID
        $maxId = 0;
        foreach ($all as $item) {
            if (isset($item['id']) && is_numeric($item['id']) && $item['id'] > $maxId) {
                $maxId = (int)$item['id'];
            }
        }
        $record['id'] = $maxId + 1;
        $record['created_at'] = date('Y-m-d H:i:s');
        $record['updated_at'] = date('Y-m-d H:i:s');

        $all[] = $record;
        self::saveAll($collection, $all);
        return $record;
    }

    /**
     * Update existing record in collection
     */
    public static function update(string $collection, int|string $id, array $changes): ?array {
        $all = self::getAll($collection);
        $updated = null;

        foreach ($all as &$item) {
            if (isset($item['id']) && $item['id'] == $id) {
                $changes['id'] = $item['id'];
                $changes['created_at'] = $item['created_at'] ?? date('Y-m-d H:i:s');
                $changes['updated_at'] = date('Y-m-d H:i:s');
                $item = array_merge($item, $changes);
                $updated = $item;
                break;
            }
        }

        if ($updated !== null) {
            self::saveAll($collection, $all);
        }
        return $updated;
    }

    /**
     * Delete record from collection
     */
    public static function delete(string $collection, int|string $id): bool {
        $all = self::getAll($collection);
        $filtered = [];
        $found = false;

        foreach ($all as $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                $found = true;
                continue;
            }
            $filtered[] = $item;
        }

        if ($found) {
            self::saveAll($collection, $filtered);
            return true;
        }
        return false;
    }
}
