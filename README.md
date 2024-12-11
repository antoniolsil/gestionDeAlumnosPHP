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

- Servidor web con soporte para PHP (por ejemplo, Apache).
- Base de datos MariaDB o MySQL.
- PHP 7.4 o superior.

## Instalación

1. **Clona el repositorio**:
   ```bash
   git clone https://github.com/tuusuario/nombre-del-repositorio.git
   ```

2. **Configura la base de datos**:
   - Importa el archivo SQL proporcionado para crear las tablas necesarias (`students` y `users`).

3. **Configura las credenciales de la base de datos**:
   - Edita el archivo de configuración donde se definen las credenciales de acceso a la base de datos.

4. **Inicia el servidor**:
   - Si estás utilizando PHP integrado:
     ```bash
     php -S localhost:8000
     ```

## Uso

1. Accede a la aplicación desde tu navegador en `http://localhost:8000`.
2. Navega entre las secciones para gestionar estudiantes y usuarios.
3. Usa el formulario de exportación para guardar los datos de los estudiantes en un archivo CSV.

## Archivos Principales

- `añadirEstudiantes.php`: Página para añadir nuevos estudiantes.
- `añadirUsuarios.php`: Página para añadir nuevos usuarios.
- `cambiarContraseña.php`: Página para cambiar contraseñas.
- `exportarCSV.php`: Lógica para exportar datos de estudiantes a CSV.
- `estadisticas.php`: Página para mostrar estadísticas de estudiantes.

## Funcionalidades Adicionales

- Validación de entradas en el lado del servidor.
- Manejo de sesiones para mensajes de error y éxito.

## Contribuciones

Si deseas contribuir al proyecto:

1. Haz un fork del repositorio.
2. Crea una rama para tu característica o corrección:
   ```bash
   git checkout -b nueva-funcionalidad
   ```
3. Realiza tus cambios y súbelos:
   ```bash
   git commit -m "Descripción de los cambios"
   git push origin nueva-funcionalidad
   ```
4. Abre un pull request explicando tus cambios.

## Autor

Desarrollado por Antonio León Silva.

## Licencia

Consulta el archivo `LICENSE` para más detalles.
