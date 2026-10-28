/**
 * Unu Raymi - Unified Production Build Script (Node.js)
 * Generates clean unified dist/ output for Hostinger Web Business:
 * - /domains/unu-raymi.com/public_html/ (Frontend)
 * - /domains/unu-raymi.com/public_html/admin/ (Admin Panel)
 * - /domains/unu-raymi.com/public_html/api/ (REST API)
 * - /domains/unu-raymi.com/public_html/database/data/ (JSON Databases)
 */

const fs = require('fs');
const path = require('path');

const ROOT_DIR = path.resolve(__dirname, '..');
const DIST_DIR = path.join(ROOT_DIR, 'dist');

console.log('[Build.js] Packaging Unu Raymi unified production build in ' + DIST_DIR + '...');

function copyDirSync(src, dest) {
    if (!fs.existsSync(src)) return;
    fs.mkdirSync(dest, { recursive: true });
    const entries = fs.readdirSync(src, { withFileTypes: true });

    for (const entry of entries) {
        const srcPath = path.join(src, entry.name);
        const destPath = path.join(dest, entry.name);

        if (entry.name === '.git' || entry.name === 'node_modules' || entry.name === 'dist' || 
            entry.name === '__pycache__' || entry.name === '.idea' || entry.name === '.vscode') {
            continue;
        }

        if (entry.isDirectory()) {
            copyDirSync(srcPath, destPath);
        } else {
            // Skip obsolete and temp files
            if (entry.name.endsWith('.log') || entry.name.endsWith('.pid') || 
                entry.name === 'index.html' || entry.name === 'overlay-manager.js') {
                continue;
            }
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

// 1. Reset dist directory
if (fs.existsSync(DIST_DIR)) {
    fs.rmSync(DIST_DIR, { recursive: true, force: true });
}
fs.mkdirSync(DIST_DIR, { recursive: true });

// 2. Copy Frontend files to dist/ root (so unu-raymi.com serves the website directly)
const frontendDir = path.join(ROOT_DIR, 'frontend');
copyDirSync(frontendDir, DIST_DIR);

// Also preserve dist/frontend/ for backward compatibility
copyDirSync(frontendDir, path.join(DIST_DIR, 'frontend'));

// 3. Copy Admin to dist/admin/ (so unu-raymi.com/admin/ serves the CMS)
const adminDir = path.join(ROOT_DIR, 'admin');
copyDirSync(adminDir, path.join(DIST_DIR, 'admin'));

// 4. Copy API to dist/api/ (so unu-raymi.com/api/ serves the REST API)
const apiDir = path.join(ROOT_DIR, 'api');
copyDirSync(apiDir, path.join(DIST_DIR, 'api'));

// 5. Copy Database data to dist/database/data/ and dist/api/database/data/
const dbData = path.join(ROOT_DIR, 'database', 'data');
if (fs.existsSync(dbData)) {
    copyDirSync(dbData, path.join(DIST_DIR, 'database', 'data'));
    copyDirSync(dbData, path.join(DIST_DIR, 'api', 'database', 'data'));
}

// 6. Copy essential root helpers
const entryFiles = ['server.js', 'package.json', 'router.php'];
for (const fname of entryFiles) {
    const srcF = path.join(ROOT_DIR, fname);
    if (fs.existsSync(srcF)) {
        fs.copyFileSync(srcF, path.join(DIST_DIR, fname));
    }
}

// 7. Ensure unified .htaccess is placed at dist root
const htaccessSrc = path.join(ROOT_DIR, '.htaccess');
if (fs.existsSync(htaccessSrc)) {
    fs.copyFileSync(htaccessSrc, path.join(DIST_DIR, '.htaccess'));
}

console.log('✅ [Build.js] Clean unified distribution generated in dist/');
console.log('   ├── /              -> Frontend (index.php, tours.php, destinations.php, assets, css, js)');
console.log('   ├── /admin/        -> Admin Panel (index.php, login.php, leads.php, tours.php)');
console.log('   ├── /api/          -> REST API (index.php, config.php, db.php)');
console.log('   └── /database/data -> Storage JSON (tours.json, destinations.json, leads.json)');
