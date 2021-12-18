<?php

//recogemos session
session_name('sesion');
session_start();
//cerramos sesión, eliminamos sesion
session_unset();//elimina la información de la memoria, pero no de los ficheros (el almacenamiento físico)
session_destroy();//elimina todo, la memoria y el almacenamiento físico
//también hay que quitar la sesión de las cookies
setcookie("sesion", "", time()-30, "/");

header('Location: index.php');

