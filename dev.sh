#!/usr/bin/env bash
# ==============================================================================
# Unu Raymi - Local Parallel Development Environment Controller
# Manages multi-service local environment (Frontend, API, Admin)
# ==============================================================================

HOST="127.0.0.1"

# Service Ports
PORT_MAIN=8000
PORT_API=8080
PORT_ADMIN=8081

# PID and Log Files
PID_MAIN=".server_main.pid"
PID_API=".server_api.pid"
PID_ADMIN=".server_admin.pid"

LOG_MAIN="server_main.log"
LOG_API="server_api.log"
LOG_ADMIN="server_admin.log"

is_running() {
    local pid_file=$1
    if [ -f "$pid_file" ] && kill -0 "$(cat "$pid_file")" 2>/dev/null; then
        return 0
    else
        return 1
    fi
}

start_service() {
    local name=$1
    local port=$2
    local command=$3
    local pid_file=$4
    local log_file=$5

    if is_running "$pid_file"; then
        echo "   ℹ️  $name ya está en ejecución (PID: $(cat "$pid_file")) en http://$HOST:$port"
    else
        nohup $command > "$log_file" 2>&1 &
        local pid=$!
        disown $pid 2>/dev/null
        echo $pid > "$pid_file"
        sleep 0.5
        if kill -0 "$pid" 2>/dev/null; then
            echo "   ✅ $name iniciado en http://$HOST:$port (PID: $pid)"
        else
            echo "   ❌ Error al iniciar $name. Revisa $log_file"
            rm -f "$pid_file"
        fi
    fi
}

stop_service() {
    local name=$1
    local pid_file=$2
    local port=$3

    if [ -f "$pid_file" ]; then
        local pid=$(cat "$pid_file")
        echo "   🛑 Deteniendo $name (PID: $pid)..."
        kill "$pid" 2>/dev/null
        rm -f "$pid_file"
    fi

    # Fallback to process search
    local extra_pids=$(pgrep -f "php -S $HOST:$port" 2>/dev/null)
    if [ -n "$extra_pids" ]; then
        kill $extra_pids 2>/dev/null
    fi
}

start() {
    echo "================================================================"
    echo "🚀 Levantando servicios locales de Unu Raymi en paralelo..."
    echo "================================================================"

    # 1. Main Monorepo Server (Unified Frontend, Router, Admin & API)
    start_service "Portal Principal (Frontend/Web App)" \
                  "$PORT_MAIN" \
                  "php -S $HOST:$PORT_MAIN router.php" \
                  "$PID_MAIN" \
                  "$LOG_MAIN"

    # 2. Dedicated API Server (api.unu-raymi.com mock)
    start_service "API REST Dedicada (Subdominio API)" \
                  "$PORT_API" \
                  "php -S $HOST:$PORT_API api/index.php" \
                  "$PID_API" \
                  "$LOG_API"

    # 3. Dedicated Admin Server (admin panel mock)
    start_service "Panel CMS / Admin Dedicado" \
                  "$PORT_ADMIN" \
                  "php -S $HOST:$PORT_ADMIN -t admin" \
                  "$PID_ADMIN" \
                  "$LOG_ADMIN"

    echo "================================================================"
    echo "🌐 SERVICIOS DISPONIBLES EN PARALELO:"
    echo "   1. Portal Web (Frontend):      http://$HOST:$PORT_MAIN/"
    echo "   2. Catálogo de Tours:          http://$HOST:$PORT_MAIN/tours"
    echo "   3. Diseñador de Viajes:        http://$HOST:$PORT_MAIN/custom-journey"
    echo "   4. API REST Dedicada:          http://$HOST:$PORT_API/health"
    echo "   5. Panel Administrativo CMS:   http://$HOST:$PORT_ADMIN/ (o :$PORT_MAIN/admin/)"
    echo "      -> Usuario:     admin"
    echo "      -> Contraseña:  UnuRaymi2025!"
    echo "================================================================"
}

stop() {
    echo "================================================================"
    echo "🛑 Deteniendo todos los servicios locales..."
    echo "================================================================"
    stop_service "Portal Principal" "$PID_MAIN" "$PORT_MAIN"
    stop_service "API REST" "$PID_API" "$PORT_API"
    stop_service "Admin Panel" "$PID_ADMIN" "$PORT_ADMIN"
    # Legacy PID clean
    [ -f ".server.pid" ] && kill "$(cat .server.pid)" 2>/dev/null && rm -f ".server.pid"
    echo "✅ Todos los servicios han sido detenidos con éxito."
}

status() {
    echo "================================================================"
    echo "📊 ESTADO DE SERVICIOS LOCALES:"
    echo "================================================================"
    
    if is_running "$PID_MAIN"; then
        echo "🟢 [1/3] Portal Principal: ACTIVO (PID $(cat "$PID_MAIN")) -> http://$HOST:$PORT_MAIN/"
    else
        echo "🔴 [1/3] Portal Principal: INACTIVO (:8000)"
    fi

    if is_running "$PID_API"; then
        echo "🟢 [2/3] API REST:         ACTIVO (PID $(cat "$PID_API")) -> http://$HOST:$PORT_API/health"
        curl -s "http://$HOST:$PORT_API/health" | head -n 4
    else
        echo "🔴 [2/3] API REST:         INACTIVO (:8080)"
    fi

    if is_running "$PID_ADMIN"; then
        echo "🟢 [3/3] Panel Admin:      ACTIVO (PID $(cat "$PID_ADMIN")) -> http://$HOST:$PORT_ADMIN/"
    else
        echo "🔴 [3/3] Panel Admin:      INACTIVO (:8081)"
    fi
    echo "================================================================"
}

case "$1" in
    start)
        start
        ;;
    stop)
        stop
        ;;
    restart)
        stop
        sleep 1
        start
        ;;
    status)
        status
        ;;
    logs)
        tail -f "$LOG_MAIN" "$LOG_API" "$LOG_ADMIN" 2>/dev/null
        ;;
    *)
        echo "Uso: ./dev.sh {start|stop|restart|status|logs}"
        exit 1
        ;;
esac
