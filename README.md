# HyperDir v2.0 - Sistema de Directorio y Anuncios

HyperDir es una plataforma moderna y ligera para la creación de directorios comerciales y clasificados. Construida sobre PHP y MySQL, ofrece una interfaz de usuario limpia tanto para los visitantes como para los administradores.

![HyperDir Dashboard](https://raw.githubusercontent.com/evilnapsis/hyperdir/master/screenshot.png)

## 🚀 Características Principales

### Sitio Público
- **Diseño Responsivo**: Totalmente optimizado para móviles y escritorio usando Bootstrap 5.
- **Buscador Avanzado**: Localiza rápidamente anuncios por palabras clave.
- **Navegación por Categorías**: Filtra el contenido de manera intuitiva.
- **Detalle de Anuncio**: Vista completa con imágenes, información de contacto y mapa de ubicación.
- **Anuncios Relacionados**: Sugerencias automáticas basadas en la categoría.
- **Sistema de Comentarios**: Interacción directa con los anuncios (con moderación).
- **Formulario de Contacto**: Mensajería directa integrada.

### Panel de Administración
- **Dashboard Analítico**: Gráficas de visitas en tiempo real (últimos 7 días).
- **Gestión de Anuncios**: CRUD completo para anuncios y páginas estáticas.
- **Control de Categorías**: Organización personalizada de contenidos.
- **Gestión de Mensajes y Comentarios**: Bandeja de entrada para consultas y moderación de comentarios.
- **Configuración Global**: Personaliza títulos, descripciones y textos del sitio fácilmente.
- **Gestión de Usuarios**: Control de acceso administrativo.

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP 7.4+ / 8.x
- **Base de Datos**: MySQL / MariaDB
- **Frontend**: HTML5, CSS3 (Vanilla), JavaScript
- **Framework UI**: Bootstrap 5 + CoreUI (Admin)
- **Librerías**: Chart.js, SweetAlert2, DataTables, Bootstrap Icons

## 📋 Requisitos del Sistema

- Servidor Web (Apache, Nginx, Litespeed)
- PHP 7.4 o superior
- MySQL 5.7 o MariaDB 10.3 o superior
- Extensión mysqli de PHP activada

## 🔧 Instalación

1.  **Clonar/Descargar**: Copia los archivos en tu servidor web (ej. `htdocs`).
2.  **Base de Datos**: Crea una base de datos llamada `hyperdir` e importa el archivo `schema.sql`.
3.  **Configuración**: Edita el archivo `admin/core/controller/Database.php` con tus credenciales de base de datos:
    ```php
    $this->user="tu_usuario";
    $this->pass="tu_contraseña";
    $this->host="localhost";
    $this->ddbb="hyperdir";
    ```
4.  **Acceso Admin**:
    - **URL**: `tu-dominio.com/admin/`
    - **Usuario**: `admin`
    - **Contraseña**: `admin`

## 📁 Estructura del Proyecto

- `/`: Sitio público y controladores principales.
- `/admin/`: Panel de administración y lógica de negocio.
- `/core/`: Lógica central del sitio público (MVC simplificado).
- `/admin/storage/`: Carpeta para imágenes y recursos subidos.
- `schema.sql`: Estructura de la base de datos.

---
Desarrollado con ❤️ por **Evilnapsis**
