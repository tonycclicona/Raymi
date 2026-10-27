# UNU RAYMI — Sistema Digital de Viajes de Lujo a Medida

Portal web de ultralujo y sistema de gestión de contenidos (CMS/Admin) para **Unu Raymi** (`unu-raymi.com` y `admin.unu-raymi.com`), clonado y optimizado a partir de la ingeniería inversa de Kuoda Travel.

---

## 🏛️ Arquitectura del Sistema

El proyecto está diseñado bajo un modelo de **cero costos recurrentes de licencias**, máxima velocidad, alta seguridad y compatibilidad directa con **Hostinger Web Business** (PHP 8.x + MySQL o JSON Storage):

```
├── api/                    -> API REST unificada en PHP (comunicación Frontend <-> Admin)
│   ├── config.php          -> Configuración de base de datos, CORS y credenciales
│   ├── db.php              -> Motor de almacenamiento dual (JSON atómico y MySQL)
│   ├── index.php           -> Router REST (/destinations, /tours, /styles, /leads, /settings)
│   └── seed.php            -> Generador de datos iniciales
├── admin/                  -> Panel Administrador (admin.unu-raymi.com)
│   ├── index.php           -> Dashboard con KPIs y leads recientes
│   ├── tours.php           -> Gestor de tours con editor de itinerario día a día interactivo
│   ├── destinations.php    -> Gestor de hubs geográficos y páginas de alta conversión
│   ├── leads.php           -> Bandeja CRM de solicitudes de clientes
│   ├── settings.php        -> Configuración de marca y canales de concierge
│   ├── login.php / auth.php-> Acceso y sesiones seguras
│   └── assets/             -> CSS y JS para modales y repetidores dinámicos
├── frontend/               -> Portal Público (unu-raymi.com)
│   ├── index.html          -> Portal SPA de ultralujo
│   ├── css/style.css       -> Estilos cinematográficos (Oro Andino, Pizarra, Terracota)
│   └── js/                 -> Sistema de Capas Superpuestas (Overlay Manager)
└── database/
    ├── data/               -> Base de datos en JSON con bloqueo atómico (Zero Setup)
    └── schema.sql          -> Esquema SQL listo para importar en phpMyAdmin de Hostinger
```

---

## 🚀 Innovación Clave: Sistema de Overlays en Capas (Zero Page Jumps)

Para evitar recargas lentas o saltos de pestañas que rompan la experiencia de navegación del cliente de lujo, toda la navegación se realiza dentro de una única ventana mediante capas superpuestas:

* **Capa Base (Nivel 0):** Portal principal con portada cinematográfica, colecciones destacadas y pilares de confianza.
* **Capa 1 (Overlay Sheet lateral):** Ficha editorial del destino geográfico (p. ej. *Cusco*, *Machu Picchu*, *Valle Sagrado*).
* **Capa 2 (Overlay Sheet anidado):** Ficha de tour detallada con **acordeón día a día interactivo**, inclusiones, exclusiones y ruta.
* **Capa 3 (Modal Superior):** Planificador de viaje y captador de leads estilo Gravity Forms.
* **Navegación Intuitiva:** El botón "Atrás", la tecla `Escape` o el clic en el fondo oscuro desapilan suavemente las capas. Soporta sincronización de URL (`#destination=machu-picchu`, `#tour=machu-picchu-luxury-tours`).

---

## 🛠️ Cómo Probar Localmente

En la terminal, dentro de la carpeta del proyecto:

```bash
# Opción 1: Usando el script automatizado
./dev.sh start

# Opción 2: Usando el servidor integrado de PHP con el enrutador
php -S localhost:8000 router.php
```

1. **Portal Web (Frontend en Inglés):** Abre en tu navegador `http://localhost:8000/`
   - Catálogo de Tours: `http://localhost:8000/tours`
   - Detalle de Tour: `http://localhost:8000/tour/machu-picchu-luxury-tours`
   - Destinos por País: `http://localhost:8000/destinations/peru`
   - Diseñador a Medida (Lead Capture): `http://localhost:8000/custom-journey`
2. **Panel de Administración (CMS & CRM):** Abre `http://localhost:8000/admin`
   - **Usuario:** `admin`
   - **Contraseña:** `UnuRaymi2025!`

---

## 🌐 Despliegue en Hostinger Web Business

### Opción A: Dominio y Subdominio (Recomendada)
1. **Frontend (`unu-raymi.com`):**
   - Sube el contenido de `frontend/` a la raíz de tu dominio principal (`public_html/`).
2. **Administrador (`admin.unu-raymi.com`):**
   - En el panel de Hostinger (hPanel), crea el subdominio `admin.unu-raymi.com`.
   - Asigna su carpeta raíz a `public_html/admin/` y sube los archivos de `admin/`.
3. **API (`api/`):**
   - Coloca la carpeta `api/` y `database/` en `public_html/api/` y `public_html/database/`.
   - Ajusta los permisos de `database/data/` a `755` para permitir la escritura de JSON.

### Opción B: Uso de Base de Datos MySQL (Opcional)
Si prefieres usar MySQL en lugar del motor JSON nativo:
1. En hPanel de Hostinger, crea una base de datos MySQL (ej. `u123456789_unuraymi`).
2. Entra a **phpMyAdmin** e importa el archivo `database/schema.sql`.
3. Abre `api/config.php` y cambia:
   ```php
   define('DB_DRIVER', 'mysql');
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tu_base_de_datos');
   define('DB_USER', 'tu_usuario');
   define('DB_PASS', 'tu_contraseña');
   ```
