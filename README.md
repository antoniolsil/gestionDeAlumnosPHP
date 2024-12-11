# Gestion de alumnos con PHP

Este proyecto consiste en un sistema web desarrollado con PHP, MaríaDB, y Bootstrap para gestionar estudiantes y los usuarios que pueden acceder al sitio. Permite realizar operaciones como añadir registros, actualizar datos, exportar información a CSV, y realizar cambios de contraseñas de usuarios.

Este es un proyecto escolar. Muy probablemente tenga muchos errores (por ejemplo, las contraseñas de los usuarios están almacenadas en la base de datos están en texto plano ), pero cumple la función para la que se diseñó. 

## IMPORTANTE
Se puede acceder con el usuario *antoniols* y la contraseña *administrador*. Posteriormente, desde el propio sitio web podrá tanto modificar la contraseña del usuario *antoniols* como crear uno nuevo. También puede modificar la tabla *users* de la base de datos con la que se trabaja y cuyo fichero de importación se incluye. 

## Características Principales

### Gestión de Estudiantes
- Añadir nuevos estudiantes a la base de datos.
- Exportar datos de los estudiantes a un archivo CSV.
- Visualizar estadísticas sobre las calificaciones de los estudiantes.

### Gestión de Usuarios que pueden manipular los registros de los u
- Añadir nuevos usuarios con un nombre de usuario y contraseña.
- Verificar la existencia de un usuario antes de registrarlo.
- Cambiar la contraseña de un usuario existente.

### Diseño
- Interfaz de usuario desarrollada con Bootstrap.
- Mensajes de error y éxito para proporcionar retroalimentación al usuario.
 
## Requisitos

- Servidor web con soporte para PHP (como Apache o Nginx).
- Base de datos MariaDB o MySQL.
- PHP 8.1.2 o superior.

## Instalación

1. **Clona el repositorio**:
   ```bash
   git clone https://github.com/tuusuario/nombre-del-repositorio.git
   ```

## Uso

1. Accede a la aplicación desde tu navegador en `http://localhost:8000`.
2. Navega entre las secciones para gestionar estudiantes y usuarios.
3. Usa el formulario de exportación para guardar los datos de los estudiantes en un archivo CSV.


## Autor

Desarrollado por Antonio León Silva.

## Licencia

Consulta el archivo `LICENSE` para más detalles.
