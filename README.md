![datos_1](https://github.com/user-attachments/assets/9809f359-e4a4-4c77-8144-7fc5a4b55a58)
![grind_colour](https://github.com/user-attachments/assets/c3194929-c906-4cc7-9d4f-9e1912a0121c)
![login](https://github.com/user-attachments/assets/99c60e1c-8005-4969-bfc0-30450f318a02)
![registro_login](https://github.com/user-attachments/assets/f712c74f-cc8b-4bb6-9541-e89ace61786c)
![header](https://github.com/user-attachments/assets/7e3bcec4-bfd2-4a69-b373-7d8ce0364b49)
![tendencias](https://github.com/user-attachments/assets/1c44578e-ccf2-4f81-a069-5dcba2fd9348)
![tendencias_double](https://github.com/user-attachments/assets/b4e8a139-4ea6-49b3-aa20-60eb2111e716)
![reseñass](https://github.com/user-attachments/assets/5d30b8d5-7ceb-401d-a6e7-78a5805bf518)
![reseñas completas](https://github.com/user-attachments/assets/55e17d81-d3a2-4810-baae-0f954e0fb85e)
![Pjs](https://github.com/user-attachments/assets/aaacda69-1feb-4910-821b-d9806b6e9811)
![footer](https://github.com/user-attachments/assets/32d21ec9-fbcc-4abe-bb08-f767a596327a)



# Pixela.io


**Pixela.io** es una plataforma interactiva que permite a los usuarios explorar series populares, agregar reseñas, puntuarlas y administrar su experiencia personal. El proyecto está desarrollado en PHP y utiliza una base de datos para gestionar usuarios, series y reseñas.

## Características

- **Inicio de sesión y registro de usuarios:** Los usuarios pueden crear cuentas y acceder a su perfil para escribir reseñas.
- **Reseñas y puntuaciones:** Los usuarios pueden calificar series y escribir opiniones personalizadas.
- **Sincronización con API:** Integra datos de una API externa para mostrar tendencias y series destacadas.
- **Interfaz amigable:** Un diseño moderno con funcionalidad intuitiva para una experiencia de usuario mejorada.

## Modularización del Proyecto

Inicialmente, el proyecto carecía de una adecuada modularización en cuanto a los objetos. La mayoría de los objetos se creaban directamente en la máquina de estados, lo que dificultaba el mantenimiento y la escalabilidad del código.

Observando cómo el profesor estructuraba el código, modularizando y creando clases para mantener todo más ordenado, decidí adoptar este enfoque. De esta manera, intenté generar todas las clases de objetos posibles para evitar que las máquinas de estados se saturaran con demasiada lógica.

Además, he creado una carpeta `INC` para almacenar elementos estáticos, como el navegador y las sesiones. Esto permite una mejor organización y reutilización de componentes dentro del proyecto, facilitando el desarrollo y la gestión del mismo.

## Estructura del Proyecto Pixela.io

![Estructura del Proyecto](https://github.com/user-attachments/assets/ec19e8c4-2831-4bd6-b2e2-54a219b81a8d)

El proyecto consta de los siguientes archivos principales:

### 1. `index.php`
- **Descripción:** Página principal para el inicio de sesión.
- **Funcionalidad:** Valida credenciales y redirige a `home.php` si el inicio de sesión es exitoso.

### 2. `registro.php`
- **Descripción:** Permite a los usuarios crear una cuenta.
- **Funcionalidad:** Realiza validaciones de entrada y almacena la información en la base de datos de usuarios.

### 3. `home.php`
- **Descripción:** Página principal para usuarios autenticados.
- **Funcionalidad:** Muestra series destacadas y sincroniza datos desde una API externa.

### 4. `ficha.php`
- **Descripción:** Página de detalles de una serie específica.
- **Funcionalidad:** Muestra información como sinopsis, puntuaciones y reseñas de usuarios.

### 5. `review.php`
- **Descripción:** Permite a los usuarios agregar, editar o eliminar reseñas de series.
- **Funcionalidad:** Incluye validaciones para títulos, puntuaciones y textos de reseñas.

## Tecnologías Utilizadas

- **Backend:** PHP
- **Frontend:** HTML, CSS (estilos personalizados para cada página)
- **Base de Datos:** MySQL (gestión de usuarios, series y reseñas)
- **Integración API:** Sincronización de datos de series populares.

## Requisitos del Sistema

- **PHP:** 7.4 o superior.
- **Servidor Web:** Compatible (Apache, Nginx, etc.).
- **Base de Datos:** MySQL configurada.
- **Composer:** Para gestionar dependencias.

