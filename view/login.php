<?php
require_once '../controller/ClienteController.php';
session_name('sesion');
session_start();


if(isset($_POST['enviar'])){
    
    $_SESSION['logueado'] = false;
    //si se le ha dado a enviar comprobamos que los datos introducidos son correctos
    $usuario = ClienteController::findbyDniAndPassword($_POST['dni'], md5($_POST['pass']));

    //echo var_dump($usuario);
    //si no se devuelve falso, es porque el usuario existe
    if ($usuario){
        //en este caso creamos variable de sesión logueado y redirigimos a index
        $_SESSION['logueado'] = true;
        //guardamos datos de usuario
        $_SESSION['usuario'] = $usuario;
        //comprobamos si es admin
        if ($usuario->tipo == 'admin'){
            $_SESSION['admin'] = true;
        }else {
            $_SESSION['admin'] = false;
        }
        header ('Location: index.php');
    } else {
        //en ese caso tenemos que comprobar que el usuario introducido existe y reducir su número de intentos
        $dniExiste = ClienteController::findbyDni($_POST['dni']);
        echo var_dump($dniExiste);
        //si no devuelve falso, consultamos cuentos intentos quedan
        
    }


}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo: Ejemplo: Tienda web. login.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="estilosTiendaJuegos.css" rel="stylesheet" type="text/css">
    </head>
<body>
    <?php require_once './includes/nav.php'; ?>
<div class="container border my-5 bg-light" style="width: 30%">
    
    <form action='' method='post'>
        <?php 
        if(isset($_POST['enviar']) && $dniExiste===false){
            echo '<div style="color:red;">*Cuenta no registrada</div>';
        }
        
        if(isset($_POST['enviar']) && $dniExiste>0){
            echo '<div style="color:red;">*Intentos restantes ' . $dniExiste . '</div>';
        }     
        
        if(isset($_POST['enviar']) && $dniExiste<=0){
            echo '<div style="color:red;">*Cuenta bloqueada, contacte con el administrador</div>';
        }
        ?>
        <legend>Log in!</legend>
        
        <div class="mb-3">
            <label for='dniUsu' class="form-label">Dni:</label><br/>
            <input type='text' name='dni' id='dniUsu' class="form-control" value="" placeholder="Ej: 12345678A" /><br/>
        </div>
        
        <div class="mb-3">
            <label for='password' class="form-label">Contraseña:</label><br/>
            <input type='password' name='pass' id='password' class="form-control" value="" /><br/>
        </div>
    
        <!--
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="recordar" value="rembember" id="flexCheckDefault"
                   <?php // if(isset($_COOKIE['recordar'])) echo 'checked' ?>>
            <label class="form-check-label" for="flexCheckDefault">
                Recordar contraseña
            </label>
        </div>-->
        
        <div class="my-3">
            <button type='submit' name='enviar' class="btn btn-primary">Entrar</button>
        </div>
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



