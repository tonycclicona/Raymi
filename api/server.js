/**
 * Unu Raymi API - Node.js Express Gateway & Server
 * Entrypoint for Hostinger Web Apps when configured for api/server.js
 */

const express = require('express');
const http = require('http');
const { spawn } = require('child_process');
const path = require('path');
const fs = require('fs');

const app = express();
const PORT = process.env.PORT || 3000;
const PHP_PORT = process.env.PHP_PORT || 8082;

let phpProcess = null;
let phpReady = false;

// 1. Launch PHP process for API
function startPhpApi() {
    const indexPath = path.join(__dirname, 'index.php');
    if (!fs.existsSync(indexPath)) {
        console.error(`[API Server] index.php not found at ${indexPath}`);
        return;
    }

    try {
        phpProcess = spawn('php', ['-S', `127.0.0.1:${PHP_PORT}`, 'index.php'], {
            cwd: __dirname,
            stdio: ['ignore', 'pipe', 'pipe']
        });

        phpProcess.stderr.on('data', (chunk) => {
            const msg = chunk.toString();
            if (msg.includes('Development Server') || msg.includes('started')) {
                phpReady = true;
            }
        });

        phpProcess.on('error', (err) => {
            console.error('[API PHP spawn error]:', err.message);
            phpReady = false;
        });
    } catch (e) {
        console.error('[API Spawn exception]:', e.message);
    }
}

// 2. Forward API requests to PHP backend
function proxyToPhp(req, res, attempt = 0) {
    const options = {
        hostname: '127.0.0.1',
        port: PHP_PORT,
        path: req.originalUrl || req.url,
        method: req.method,
        headers: {
            ...req.headers,
            'host': req.headers.host || `localhost:${PORT}`
        }
    };

    const proxyReq = http.request(options, (proxyRes) => {
        res.writeHead(proxyRes.statusCode, proxyRes.headers);
        proxyRes.pipe(res);
    });

    proxyReq.on('error', (err) => {
        if (err.code === 'ECONNREFUSED' && attempt < 5) {
            setTimeout(() => proxyToPhp(req, res, attempt + 1), 200);
            return;
        }

        // Direct fallback: if PHP server failed to start, serve health status
        if (req.url === '/health' || req.url === '/api/health') {
            res.json({
                status: 'online',
                service: 'Unu Raymi API (Node Gateway)',
                version: '1.0.0',
                php_status: phpReady ? 'connected' : 'initializing'
            });
            return;
        }

        res.status(502).json({
            error: 'API Gateway Timeout',
            message: 'PHP backend is initializing. Please retry in a few seconds.'
        });
    });

    if (req.method !== 'GET' && req.method !== 'HEAD') {
        req.pipe(proxyReq);
    } else {
        proxyReq.end();
    }
}

// Enable CORS
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    if (req.method === 'OPTIONS') {
        return res.sendStatus(200);
    }
    next();
});

// Route everything through proxy
app.all('*', (req, res) => {
    proxyToPhp(req, res);
});

// Start PHP and listen
startPhpApi();

app.listen(PORT, '0.0.0.0', () => {
    console.log(`[Unu Raymi API] Node.js gateway listening on port ${PORT}`);
});
