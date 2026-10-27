#!/usr/bin/env python3
"""
Unu Raymi - Unified Monorepo Production Build Script (Python)
Generates dist/ output with all entrypoints and modules for Hostinger Web Apps & Apache
"""

import os
import shutil
import sys

ROOT_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DIST_DIR = os.path.join(ROOT_DIR, "dist")

print(f"[Build.py] Building Unu Raymi production package in {DIST_DIR}...")

if os.path.exists(DIST_DIR):
    shutil.rmtree(DIST_DIR)
os.makedirs(DIST_DIR, exist_ok=True)

def copy_dir(src, dst):
    if not os.path.exists(src):
        return
    os.makedirs(dst, exist_ok=True)
    for root, dirs, files in os.walk(src):
        # Skip git, node_modules, dist
        dirs[:] = [d for d in dirs if d not in ['.git', 'node_modules', 'dist', '__pycache__']]
        rel_path = os.path.relpath(root, src)
        dest_root = os.path.join(dst, rel_path) if rel_path != "." else dst
        os.makedirs(dest_root, exist_ok=True)
        for f in files:
            shutil.copy2(os.path.join(root, f), os.path.join(dest_root, f))

# 1. Target modules
target_api = os.path.join(DIST_DIR, "api")
target_frontend = os.path.join(DIST_DIR, "frontend")
target_admin = os.path.join(DIST_DIR, "admin")

copy_dir(os.path.join(ROOT_DIR, "api"), target_api)
copy_dir(os.path.join(ROOT_DIR, "frontend"), target_frontend)
copy_dir(os.path.join(ROOT_DIR, "admin"), target_admin)

# 2. Database data
db_data = os.path.join(ROOT_DIR, "database", "data")
if os.path.exists(db_data):
    copy_dir(db_data, os.path.join(target_api, "database", "data"))
    copy_dir(db_data, os.path.join(DIST_DIR, "database", "data"))

# 3. Top-level dist structure for platforms syncing dist/ to public_html
copy_dir(os.path.join(ROOT_DIR, "frontend"), DIST_DIR)
copy_dir(os.path.join(ROOT_DIR, "admin"), os.path.join(DIST_DIR, "admin"))
copy_dir(os.path.join(ROOT_DIR, "api"), os.path.join(DIST_DIR, "api"))

# Entry files
for fname in ["server.js", "package.json", "index.php", "router.php"]:
    src_f = os.path.join(ROOT_DIR, fname)
    if os.path.exists(src_f):
        shutil.copy2(src_f, os.path.join(DIST_DIR, fname))

frontend_ht = os.path.join(ROOT_DIR, "frontend", ".htaccess")
if os.path.exists(frontend_ht):
    shutil.copy2(frontend_ht, os.path.join(DIST_DIR, ".htaccess"))

# 4. Domains tree for Hostinger multi-domain direct sync
domains_api = os.path.join(DIST_DIR, "domains", "api.unu-raymi.com", "public_html")
domains_front = os.path.join(DIST_DIR, "domains", "unu-raymi.com", "public_html")
domains_admin = os.path.join(domains_front, "admin")

copy_dir(target_api, domains_api)
copy_dir(target_frontend, domains_front)
copy_dir(target_admin, domains_admin)

print("✅ [Build.py] Build successfully completed.")
