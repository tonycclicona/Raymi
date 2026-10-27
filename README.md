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

---

## ⚡ Despliegue Continuo Automatizado (CI/CD con GitHub Actions)

El repositorio incluye un flujo de trabajo automatizado en `.github/workflows/ci.yml` que valida la sintaxis PHP / integridad JSON y despliega automáticamente a **Hostinger Web Business** en cada `push` a la rama `main`:

### Configuración de Secretos en GitHub:
En tu repositorio de GitHub, ve a **Settings** > **Secrets and variables** > **Actions** y añade los siguientes **Repository Secrets**:

| Secret | Descripción | Ejemplo |
| :--- | :--- | :--- |
| `HOSTINGER_FTP_HOST` | Host o IP del servidor FTP provisto por Hostinger | `ftp.tu-dominio.com` o `185.xxx.xxx.xxx` |
| `HOSTINGER_FTP_USER` | Usuario de la cuenta FTP en hPanel | `u123456789@tu-dominio.com` |
| `HOSTINGER_FTP_PASSWORD` | Contraseña asignada a la cuenta FTP | `TuPasswordSeguro123!` |

*(Opcional)* En **Variables** (o Secrets) puedes definir:
- `HOSTINGER_SERVER_DIR`: Ruta destino en Hostinger (por defecto `public_html/`).
- `HOSTINGER_FTP_PORT`: Puerto FTP (por defecto `21`).

---

## 🌐 Despliegue Manual en Hostinger Web Business

### Opción A: Despliegue Unificado con `.htaccess` (Recomendada)
Sube todo el contenido a `public_html/`. El archivo `.htaccess` ya viene preconfigurado para enrutar automáticamente:
- El **Frontend** en la raíz `/`
- El **Admin** en `/admin`
- La **API REST** en `/api`

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

