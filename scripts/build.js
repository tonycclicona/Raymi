/**
 * Unu Raymi - Unified Monorepo Production Build Script
 * Generates dist/ output with all entrypoints and modules for Hostinger Web Apps & Apache
 */

const fs = require('fs');
const path = require('path');

const ROOT_DIR = path.resolve(__dirname, '..');
const DIST_DIR = path.join(ROOT_DIR, 'dist');

console.log('[Build] Starting Unu Raymi Monorepo build...');

// Helper to copy recursively
function copyDirSync(src, dest) {
    if (!fs.existsSync(src)) return;
    fs.mkdirSync(dest, { recursive: true });
    const entries = fs.readdirSync(src, { withFileTypes: true });

    for (const entry of entries) {
        const srcPath = path.join(src, entry.name);
        const destPath = path.join(dest, entry.name);

        if (entry.name === '.git' || entry.name === 'node_modules' || entry.name === 'dist') {
            continue;
        }

        if (entry.isDirectory()) {
            copyDirSync(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

// 1. Reset / Create dist directory
if (fs.existsSync(DIST_DIR)) {
    fs.rmSync(DIST_DIR, { recursive: true, force: true });
}
fs.mkdirSync(DIST_DIR, { recursive: true });

// 2. Build multi-target staging structures
const targetApi = path.join(DIST_DIR, 'api');
const targetFrontend = path.join(DIST_DIR, 'frontend');
const targetAdmin = path.join(DIST_DIR, 'admin');

// Copy modules
copyDirSync(path.join(ROOT_DIR, 'api'), targetApi);
copyDirSync(path.join(ROOT_DIR, 'frontend'), targetFrontend);
copyDirSync(path.join(ROOT_DIR, 'admin'), targetAdmin);

// Copy database data into API and root dist
const dbDataSrc = path.join(ROOT_DIR, 'database', 'data');
if (fs.existsSync(dbDataSrc)) {
    copyDirSync(dbDataSrc, path.join(targetApi, 'database', 'data'));
    copyDirSync(dbDataSrc, path.join(DIST_DIR, 'database', 'data'));
}

// 3. Populate root dist/ with full web application (for platforms syncing dist/ to public_html)
copyDirSync(path.join(ROOT_DIR, 'frontend'), DIST_DIR);
copyDirSync(path.join(ROOT_DIR, 'admin'), path.join(DIST_DIR, 'admin'));
copyDirSync(path.join(ROOT_DIR, 'api'), path.join(DIST_DIR, 'api'));

// Ensure entry files exist in dist root
const entryFiles = ['server.js', 'package.json', 'index.php', 'router.php'];
for (const f of entryFiles) {
    const src = path.join(ROOT_DIR, f);
    if (fs.existsSync(src)) {
        fs.copyFileSync(src, path.join(DIST_DIR, f));
    }
}

// Ensure .htaccess exists in dist root
const frontendHtaccess = path.join(ROOT_DIR, 'frontend', '.htaccess');
if (fs.existsSync(frontendHtaccess)) {
    fs.copyFileSync(frontendHtaccess, path.join(DIST_DIR, '.htaccess'));
}

// 4. Also structure domains directory for direct full-tree sync
const domainsApi = path.join(DIST_DIR, 'domains', 'api.unu-raymi.com', 'public_html');
const domainsFrontend = path.join(DIST_DIR, 'domains', 'unu-raymi.com', 'public_html');
const domainsAdmin = path.join(domainsFrontend, 'admin');

copyDirSync(targetApi, domainsApi);
copyDirSync(targetFrontend, domainsFrontend);
copyDirSync(targetAdmin, domainsAdmin);

console.log('✅ [Build] Successfully generated complete distribution in dist/');
console.log('   - Root entrypoints: server.js, index.php, package.json, router.php, .htaccess');
console.log('   - Modules: dist/api, dist/frontend, dist/admin');
console.log('   - Hostinger domains tree: dist/domains/...');
