#!/usr/bin/env bash
# ==============================================================================
# Unu Raymi - Local Development Server Controller
# ==============================================================================

PORT=8000
HOST="127.0.0.1"
PID_FILE=".server.pid"
LOG_FILE="server.log"

start() {
    if [ -f "$PID_FILE" ] && kill -0 "$(cat "$PID_FILE")" 2>/dev/null; then
        echo "⚠️  El servidor de desarrollo ya está corriendo (PID: $(cat "$PID_FILE"))."
        echo "🌐 Portal Web:    http://$HOST:$PORT/"
        echo "⚙️  Admin Panel:   http://$HOST:$PORT/admin/"
        echo "🔌 API Health:    http://$HOST:$PORT/api/health"
        return 0
    fi

    echo "🚀 Levantando entorno de desarrollo Unu Raymi en http://$HOST:$PORT..."
    nohup php -S "$HOST:$PORT" router.php > "$LOG_FILE" 2>&1 &
    SERVER_PID=$!
    echo $SERVER_PID > "$PID_FILE"
    sleep 1

    if kill -0 "$SERVER_PID" 2>/dev/null; then
        echo "✓ Servidor iniciado con éxito (PID: $SERVER_PID)"
        echo "--------------------------------------------------------"
        echo "🌐 Frontend (Portal Público):   http://$HOST:$PORT/"
        echo "⚙️  Admin (Panel CMS):           http://$HOST:$PORT/admin/"
        echo "   -> Usuario:     admin"
        echo "   -> Contraseña:  UnuRaymi2025!"
        echo "🔌 API REST:                    http://$HOST:$PORT/api/health"
        echo "📝 Logs de actividad:           $LOG_FILE"
        echo "--------------------------------------------------------"
    else
        echo "❌ Error al iniciar el servidor. Revisa $LOG_FILE:"
        cat "$LOG_FILE"
        rm -f "$PID_FILE"
        return 1
    fi
}

stop() {
    if [ -f "$PID_FILE" ]; then
        PID=$(cat "$PID_FILE")
        echo "🛑 Deteniendo servidor (PID: $PID)..."
        kill "$PID" 2>/dev/null
        rm -f "$PID_FILE"
        echo "✓ Servidor detenido."
    else
        # Fallback: kill any php -S on that port
        PIDS=$(pgrep -f "php -S $HOST:$PORT")
        if [ -n "$PIDS" ]; then
            echo "🛑 Deteniendo procesos residuales de PHP en puerto $PORT..."
            kill $PIDS 2>/dev/null
            echo "✓ Detenido."
        else
            echo "ℹ️  No hay ningún servidor de desarrollo corriendo."
        fi
    fi
}

status() {
    if [ -f "$PID_FILE" ] && kill -0 "$(cat "$PID_FILE")" 2>/dev/null; then
        echo "🟢 Servidor ACTIVO (PID: $(cat "$PID_FILE")) en http://$HOST:$PORT"
        echo "Prueba de estado de API:"
        curl -s "http://$HOST:$PORT/api/health" | head -n 10
    else
        echo "🔴 Servidor INACTIVO."
    fi
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
        tail -f "$LOG_FILE"
        ;;
    *)
        echo "Uso: ./dev.sh {start|stop|restart|status|logs}"
        exit 1
        ;;
esac
