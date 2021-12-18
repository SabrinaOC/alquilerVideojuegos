<?php
require_once '../controller/ClienteController.php';
require_once '../model/Cliente.php';
session_name('sesion');
session_start();

    //buscamos todos los usuarios bloqueados
    $bloqueados = ClienteController::findAllUsuariosBloqueados();


//controlamos devolución de juego
if(isset($_POST['desbloquear'])){
    echo var_dump($_POST['desbloquar']);
    
    //llamamos a controlador para hacer insert
    $result = ClienteController::desbloquearUsuario($_POST['desbloquear']);
    //dependiendo del resultado de la consulta redirigimos a un lugar u otro
    //$result ? header('Location: exito.php') : header('Location: error.php');
    header('Location: desbloquearUsuarios.php');
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
<div class="container my-5" id="tablaJuegos">
    <h3 class="text-center">Usuarios bloqueados</h3>
    <!-- Creamos div para presentar la lista de juegos existente -->
    <div class="d-flex justify-content-center" >
        
            <?php
            //si la búsqueda no arroja ningún resultado, mostramos mensaje de lista vacía
            
            if($bloqueados){
                
                ?>
            <!-- Creamos div para presentar la lista de juegos existente -->
            <table class="table table-striped  mt-5" style="width: 80%" >
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th></th>
                </tr>
            <?php
            
            foreach ($bloqueados as $key => $value){
                ?>
            <tr><form action="" method="post">
            <?php
                echo '<td>'.$value->dni.'</td><td>'
                        .$value->nombre.'</td><td>'
                        .$value->apellidos.'</td>';
                ?>
            <!--Metemos en el botón el código de juego para poder actualizar tabla juegos-->
            <td><button type="submit" class="btn btn-danger" name="desbloquear" value="<?php echo $value->dni ?>">Desbloquear</button></td>
            </form>
            </tr>
               <?php

            }
            //Si entra en el else es porque no hay usuarios bloqueados
            }else {
                
                ?>
                    <script>
                    document.querySelectorAll('h3')[0].innerHTML = 'No existen usuarios bloqueados';
                    </script>
            <div class="container d-flex justify-content-center mt-5">
                <img src="./imagenes/yay.png">
            </div>
            
                    <?php
                
            }
?>

        </table> 
    
    </div> 
    
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



