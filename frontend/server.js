/**
 * Unu Raymi Frontend - Node.js Express Gateway
 * Entrypoint for Hostinger Web Apps when configured for frontend/server.js
 */

const express = require('express');
const http = require('http');
const { spawn } = require('child_process');
const path = require('path');
const fs = require('fs');

const app = express();
const PORT = process.env.PORT || 3000;
const PHP_PORT = process.env.PHP_PORT || 8083;

let phpProcess = null;

function startPhpFrontend() {
    const rootDir = path.resolve(__dirname, '..');
    const routerScript = path.join(rootDir, 'router.php');
    const script = fs.existsSync(routerScript) ? 'router.php' : 'index.php';
    const cwd = fs.existsSync(routerScript) ? rootDir : __dirname;

    try {
        phpProcess = spawn('php', ['-S', `127.0.0.1:${PHP_PORT}`, script], {
            cwd: cwd,
            stdio: ['ignore', 'pipe', 'pipe']
        });
        phpProcess.on('error', (err) => console.error('[Frontend PHP Error]:', err.message));
    } catch (e) {
        console.error('[Frontend Spawn Error]:', e.message);
    }
}

// Serve static assets directly
app.use('/assets', express.static(path.join(__dirname, 'assets')));
app.use('/css', express.static(path.join(__dirname, 'css')));
app.use('/js', express.static(path.join(__dirname, 'js')));

// Proxy all requests
app.all('*', (req, res) => {
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

    proxyReq.on('error', () => {
        const indexHtml = path.join(__dirname, 'index.html');
        if (fs.existsSync(indexHtml)) {
            res.sendFile(indexHtml);
        } else {
            res.status(502).send('Frontend initializing...');
        }
    });

    if (req.method !== 'GET' && req.method !== 'HEAD') {
        req.pipe(proxyReq);
    } else {
        proxyReq.end();
    }
});

startPhpFrontend();

app.listen(PORT, '0.0.0.0', () => {
    console.log(`[Unu Raymi Frontend] Listening on port ${PORT}`);
});
