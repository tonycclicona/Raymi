/**
 * Raymi Monorepo - Node.js Express Entrypoint for Hostinger Web Apps / Cloud
 * Serves static assets and acts as a high-performance bridge to PHP router
 */

const express = require('express');
const http = require('http');
const { spawn } = require('child_process');
const path = require('path');
const fs = require('fs');

const app = express();
const PORT = process.env.PORT || 3000;
const PHP_PORT = process.env.PHP_PORT || 8081;

let phpProcess = null;
let phpReady = false;

// 1. Launch PHP built-in server with router.php
function startPhpBackend() {
    const routerPath = path.join(__dirname, 'router.php');
    if (!fs.existsSync(routerPath)) {
        console.warn(`[Raymi Server] router.php not found at ${routerPath}`);
        return;
    }

    console.log(`[Raymi Server] Starting PHP backend on 127.0.0.1:${PHP_PORT} via router.php...`);
    try {
        phpProcess = spawn('php', ['-S', `127.0.0.1:${PHP_PORT}`, 'router.php'], {
            cwd: __dirname,
            stdio: ['ignore', 'pipe', 'pipe']
        });

        phpProcess.stdout.on('data', (chunk) => {
            console.log(`[PHP stdout] ${chunk.toString().trim()}`);
        });

        phpProcess.stderr.on('data', (chunk) => {
            const msg = chunk.toString();
            if (msg.includes('Development Server') || msg.includes('started')) {
                phpReady = true;
            }
            console.log(`[PHP] ${msg.trim()}`);
        });

        phpProcess.on('error', (err) => {
            console.error('[PHP spawn error]:', err.message);
            phpReady = false;
        });

        phpProcess.on('exit', (code, sig) => {
            console.log(`[PHP exited] code=${code} signal=${sig}`);
            phpReady = false;
        });
    } catch (err) {
        console.error('[Raymi Server] Failed to launch PHP child process:', err.message);
    }
}

// Cleanup PHP process on exit
function cleanup() {
    if (phpProcess) {
        try {
            phpProcess.kill('SIGTERM');
        } catch (_) {}
    }
    process.exit(0);
}
process.on('SIGTERM', cleanup);
process.on('SIGINT', cleanup);

// 2. Forward request to PHP backend
function forwardToPhp(req, res, attempt = 0) {
    const options = {
        hostname: '127.0.0.1',
        port: PHP_PORT,
        path: req.originalUrl || req.url,
        method: req.method,
        headers: {
            ...req.headers,
            'host': req.headers.host || `localhost:${PORT}`,
            'x-forwarded-for': req.ip || (req.socket && req.socket.remoteAddress),
            'x-forwarded-proto': req.protocol || 'http',
            'x-forwarded-port': PORT.toString()
        }
    };

    const proxyReq = http.request(options, (proxyRes) => {
        res.writeHead(proxyRes.statusCode, proxyRes.headers);
        proxyRes.pipe(res);
    });

    proxyReq.on('error', (err) => {
        // If connection refused (PHP still booting), retry up to 5 times
        if (err.code === 'ECONNREFUSED' && attempt < 6) {
            setTimeout(() => {
                forwardToPhp(req, res, attempt + 1);
            }, 200);
            return;
        }

        console.error(`[Proxy Error] ${req.method} ${req.url}:`, err.message);
        if (!res.headersSent) {
            res.status(502).send(`
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>502 Bad Gateway | Raymi Luxury Travel</title>
                    <style>
                        body { background: #090C11; color: #FAF8F5; font-family: sans-serif; text-align: center; padding: 60px 20px; }
                        h1 { color: #D4AF37; font-family: serif; font-size: 32px; margin-bottom: 12px; }
                        p { color: #A0A5B5; font-size: 16px; max-width: 600px; margin: 0 auto 16px; line-height: 1.6; }
                    </style>
                </head>
                <body>
                    <h1>UNU RAYMI</h1>
                    <p>The luxury travel backend is initializing. Please refresh in a moment.</p>
                </body>
                </html>
            `);
        }
    });

    // Forward request payload directly
    req.pipe(proxyReq);
}

// 3. Static Assets Caching & Delivery
const frontendDir = path.join(__dirname, 'frontend');
if (fs.existsSync(frontendDir)) {
    app.use('/assets', express.static(path.join(frontendDir, 'assets')));
    app.use('/css', express.static(path.join(frontendDir, 'css')));
    app.use('/js', express.static(path.join(frontendDir, 'js')));
}

const adminAssets = path.join(__dirname, 'admin', 'assets');
if (fs.existsSync(adminAssets)) {
    app.use('/admin/assets', express.static(adminAssets));
}

// 4. Fallback route for all PHP and dynamic endpoints
app.use((req, res) => {
    forwardToPhp(req, res);
});

// 5. Initialize PHP backend and start Express listener
startPhpBackend();

app.listen(PORT, '0.0.0.0', () => {
    console.log(`=======================================================`);
    console.log(`🚀 Raymi Platform running on port ${PORT}`);
    console.log(`⚡ Express reverse proxy connected to PHP on 127.0.0.1:${PHP_PORT}`);
    console.log(`=======================================================`);
});
