#!/usr/bin/env python3
"""
Unu Raymi - Unified Production Build Script (Python)
Generates clean unified dist/ output for Hostinger Web Business:
- /domains/unu-raymi.com/public_html/ (Frontend)
- /domains/unu-raymi.com/public_html/admin/ (Admin Panel)
- /domains/unu-raymi.com/public_html/api/ (REST API)
- /domains/unu-raymi.com/public_html/database/data/ (JSON Databases)
"""

import os
import shutil

ROOT_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DIST_DIR = os.path.join(ROOT_DIR, "dist")

print(f"[Build.py] Packaging Unu Raymi unified production build in {DIST_DIR}...")

if os.path.exists(DIST_DIR):
    shutil.rmtree(DIST_DIR)
os.makedirs(DIST_DIR, exist_ok=True)

def copy_dir(src, dst):
    if not os.path.exists(src):
        return
    os.makedirs(dst, exist_ok=True)
    for root, dirs, files in os.walk(src):
        dirs[:] = [d for d in dirs if d not in ['.git', 'node_modules', 'dist', '__pycache__', '.idea', '.vscode']]
        rel_path = os.path.relpath(root, src)
        dest_root = os.path.join(dst, rel_path) if rel_path != "." else dst
        os.makedirs(dest_root, exist_ok=True)
        for f in files:
            # Skip obsolete and temp files
            if f.endswith('.log') or f.endswith('.pid') or f == 'index.html' or f == 'overlay-manager.js':
                continue
            shutil.copy2(os.path.join(root, f), os.path.join(dest_root, f))

# 1. Copy Frontend files to dist/ root (so unu-raymi.com serves the website directly)
frontend_dir = os.path.join(ROOT_DIR, "frontend")
copy_dir(frontend_dir, DIST_DIR)

# Also preserve dist/frontend/ copy for backward-compatibility
copy_dir(frontend_dir, os.path.join(DIST_DIR, "frontend"))

# 2. Copy Admin to dist/admin/ (so unu-raymi.com/admin/ serves the CMS)
admin_dir = os.path.join(ROOT_DIR, "admin")
copy_dir(admin_dir, os.path.join(DIST_DIR, "admin"))

# 3. Copy API to dist/api/ (so unu-raymi.com/api/ serves the REST API)
api_dir = os.path.join(ROOT_DIR, "api")
copy_dir(api_dir, os.path.join(DIST_DIR, "api"))

# 4. Copy Database data to dist/database/data/ and dist/api/database/data/
db_data = os.path.join(ROOT_DIR, "database", "data")
if os.path.exists(db_data):
    copy_dir(db_data, os.path.join(DIST_DIR, "database", "data"))
    copy_dir(db_data, os.path.join(DIST_DIR, "api", "database", "data"))

# 5. Copy essential root helpers
for fname in ["server.js", "package.json", "router.php"]:
    src_f = os.path.join(ROOT_DIR, fname)
    if os.path.exists(src_f):
        shutil.copy2(src_f, os.path.join(DIST_DIR, fname))

# 6. Ensure the unified .htaccess is placed at dist root
htaccess_src = os.path.join(ROOT_DIR, ".htaccess")
if os.path.exists(htaccess_src):
    shutil.copy2(htaccess_src, os.path.join(DIST_DIR, ".htaccess"))

print("✅ [Build.py] Clean unified distribution generated in dist/")
print("   ├── /              -> Frontend (index.php, tours.php, destinations.php, assets, css, js)")
print("   ├── /admin/        -> Admin Panel (index.php, login.php, leads.php, tours.php)")
print("   ├── /api/          -> REST API (index.php, config.php, db.php)")
print("   └── /database/data -> Storage JSON (tours.json, destinations.json, leads.json)")
