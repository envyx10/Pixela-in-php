# Pixela.io

Pixela.io es una plataforma interactiva que permite a los usuarios explorar series y películas populares, agregar reseñas, puntuarlas y administrar su experiencia personal. El proyecto está desarrollado en PHP y utiliza una base de datos para gestionar usuarios, series y reseñas.

## Características

- **Inicio de sesión y registro de usuarios:** Los usuarios pueden crear cuentas y acceder a su perfil para escribir reseñas.
- **Reseñas y puntuaciones:** Los usuarios pueden calificar series y escribir opiniones personalizadas.
- **Sincronización con API:** Integra datos de una API externa para mostrar tendencias y series destacadas.
- **Interfaz amigable:** Un diseño moderno con funcionalidad intuitiva para una experiencia de usuario mejorada.

## Estructura del proyecto

El proyecto consta de los siguientes archivos principales:

### 1. `index.php`
- Página principal para el inicio de sesión.
- Valida credenciales y redirige a `home.php` si el inicio de sesión es exitoso.

### 2. `registro.php`
- Permite a los usuarios crear una cuenta.
- Realiza validaciones de entrada y almacena la información en la base de datos de usuarios.

### 3. `home.php`
- Página principal para usuarios autenticados.
- Muestra series destacadas y sincroniza datos desde una API externa.

### 4. `ficha.php`
- Página de detalles de una serie específica.
- Muestra información como sinopsis, puntuaciones y reseñas de usuarios.

### 5. `review.php`
- Permite a los usuarios agregar, editar o eliminar reseñas de series.
- Incluye validaciones para títulos, puntuaciones y textos de reseñas.

## Tecnologías utilizadas

- **Backend:** PHP
- **Frontend:** HTML, CSS (estilos personalizados para cada página)
- **Base de datos:** MySQL (gestión de usuarios, series y reseñas)
- **Integración API:** Sincronización de datos de series populares.

## Requisitos del sistema

- PHP 7.4 o superior.
- Servidor web compatible (Apache, Nginx, etc.).
- Base de datos MySQL configurada.
- Composer para gestionar dependencias.

## Instalación y configuración

1. Clona este repositorio:
   ```bash
   git clone https://github.com/tuusuario/pixela.git
