<?php
require_once '../controller/JuegoController.php';
require_once '../controller/AlquilerController.php';
require_once '../model/Cliente.php';
session_name('sesion');
session_start();

//como puede acceder alguien sin loguearse, comprobamos que hay usuario logueado antes de hacer consulta
if(isset($_SESSION['logueado']) && $_SESSION['logueado']){
    //buscamos todos los alquilados por el usuario logueado
    $misAlquilados = AlquilerController::findAllByUser($_SESSION['usuario']->dni);
    //echo var_dump($misAlquilados);
} else {
    $misAlquilados = false;
}



//controlamos devolución de juego
if(isset($_POST['devolver'])){
    echo var_dump($_POST['devolver']);
    
    //llamamos a controlador para hacer insert
   JuegoController::devolverJuego($_POST['devolver']);
    
    header('Location: misAlquilados.php');
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
    <h3 class="text-center">Mis juegos alquilados</h3>
    <!-- Creamos div para presentar la lista de juegos existente -->
    <div class="d-flex justify-content-center" >
        
            <?php
            //si la búsqueda no arroja ningún resultado, mostramos mensaje de lista vacía
            
            if($misAlquilados){
                
                ?>
            <!-- Creamos div para presentar la lista de juegos existente -->
            <table class="table table-striped  mt-5" style="width: 80%" >
                <tr>
                    <th>Nombre</th>
                    <th>Alquilado</th>
                    <th>Fecha devolución</th>
                    <th></th>
                </tr>
            <?php
            
            foreach ($misAlquilados as $key => $value){
                ?>
            <tr><form action="" method="post">
            <?php
                echo '<td>'.$value->codJuego.'</td><td>'
                        .$value->dni.'</td><td>'
                        .$value->fechaDevolucion.'</td>';
                ?>
            <!--Metemos en el botón el código de juego para poder actualizar tabla juegos-->
            <td><button type="submit" class="btn btn-danger" name="devolver" value="<?php echo $value->codJuego ?>">Devolver</button></td>
            </form>
            </tr>
               <?php

            }
            }else {
                //si hay usuario logueado pero no hay resultados es porque no tiene ningún juego en alquiler actualmente
                if(isset($_SESSION['logueado'])){
                ?>
            <script>
            document.querySelectorAll('h3')[0].innerHTML = 'Actualmente no existen juegos en alquiler';
            </script>
            <?php
                //si no está logueado, no puede ver esta información
                } else {
                 ?>
                    <script>
                    document.querySelectorAll('h3')[0].innerHTML = 'Inicie sesión para ver esta información';
                    </script>
            <div class="container d-flex justify-content-center mt-5">
                <img src="./imagenes/oops.png">
            </div>
            
                    <?php
                }
            }
?>

        </table> 
    
    </div> 
    
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



