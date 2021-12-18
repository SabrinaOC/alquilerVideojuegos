# Aplicación web de gestión de videojuegos
Aplicación web desarrollada con PHP para la gestión de un videoclub. Diseño de vistas por tipo de clientes (normales y administradores) y CRUD.

## INICIO
* Página de inicio con todos los productos disponibles en tienda (vista sesión no iniciada).
<p align="center">
  <img width="630" src="./ss/inicio.PNG"/>
</p>


## LOG IN
* Log in para acceder como usuario registrado a la aplicación.
<p align="center">
  <img width="630" src="./ss/login.PNG"/>
</p>

* Control de intentos de sesión.
<p align="center">
  <img width="630" src="./ss/controlIntentos.PNG"/>
</p>

* Bloqueo de cuenta cuando se agotan los intentos.
<p align="center">
  <img width="630" src="./ss/bloqueoCuenta.PNG"/>
</p>


## INICIO LOGUEADO
* Página de inicio para usuario logueado, desde dónde se podrán ver los juegos disponibles para alquilar (los que actualmente se encuentran alquilados aparecen en escala de grises) y proceder a alquilarlos.
<p align="center">
  <img width="630" src="./ss/escalaGrisAlquilados.PNG"/>
</p>


## DEVOLVER JUEGO
* Espacio para ver los juegos alquilados actualmente y proceder a su devolución.
<p align="center">
  <img width="630" src="./ss/devolverJuego.PNG"/>
</p>

# VISTA ADMINISTRADOR
## DESBLOQUEO DE USUARIOS
* Si existen usuarios bloqueados, el administrador puede reactivar sus cuentas.
<p align="center">
  <img width="630" src="./ss/desbloquearUsuarios.PNG"/>
</p>

<p align="center">
  <img width="630" src="./ss/ceroUsuariosBloqueados.PNG"/>
</p>


## CRUD
<p align="center">
  <img width="630" src="./ss/crud.PNG"/>
</p>

### AÑADIR JUEGOS A LA TIENDA
* Página con un formulario para dar de alta nuevos juegos en la tienda.
<p align="center">
  <img width="630" src="./ss/nuevoJuego.PNG"/>
</p>


### MODIFICAR JUEGOS
* Espacio exclusivo del administrador para modificar los juegos existentes en tienda.
<p align="center">
  <img width="630" src="./ss/listaMod.PNG"/>
</p>

<p align="center">
  <img width="630" src="./ss/formModificar.PNG"/>
</p>

<p align="center">
  <img width="630" src="./ss/mensajeUpdateCorrecto.PNG"/>
</p>


### ELIMINAR JUEGOS
* Página para dar de baja juegos en tienda.
<p align="center">
  <img width="630" src="./ss/eliminarJuego.PNG"/>
</p>
