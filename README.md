![React Logo](/public/img/ViajesParaTiLogo.png)
# :blue_book: Proyecto Proveedores

Se ha desarrollado con el framework **Symfony** un pequeño proyecto para introducir, en un sistema de base de datos en *MySQL*, los proveedores con los que se trabaja habitualmente.
## Datos de un proveedor:
1. Nombre
2. Correo electrónico
3. Teléfono de contacto
4. Tipo de proveedor:
   * hotel
   * pista
   * complemento
5. Si están activos o no.

## La aplicación puede hacer lo siguiente:
1. Mostrar un listado en formato tabla de todos los proveedores.
2. Crear un proveedor rellenando un formulario. Los datos introducidos serán validados en el controlador y también se comprobará que el correo electrónico no exista.
3. Editar un proveedor. Antes de modificar los datos, también se validarán y se comprobará que el correo tampoco exista en otro proveedor que no sea este mismo.
4. Mostrar los datos de un proveedor.
5. Eliminar un proveedor.

## Requisitos
- [x] Se requería que mínimo se usara la versión Symfony 4 y se ha usado la 6.
- [x] Se ha creado el CRUD manualmente.
- [x] Se ha utilizado Twig para las vistas.
- [x] Se ha creado la base de datos MySQL
- [x] Se ha creado un repositorio en GitHub y es este :smile:

## Experiencia propia
Me lo he pasado genial haciendo este proyecto. Nunca antes había usado Symfony, sí que algo de Laravel y he visto que se parecen un poco. La falta de tiempo (por mi horario reducido disponible) me ha imposibilitado acabar de perfeccionar el *responsive* y documentarme para desplegar el proyecto en *Docker*

added by Francesc
