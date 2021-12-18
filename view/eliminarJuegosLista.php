<?php
require_once '../controller/JuegoController.php';
session_name('sesion');
session_start();

//buscamos todos los juegos
$todosJuegos = JuegoController::findAll();

if(isset($_POST['eliminar'])){
    $result = JuegoController::deleteJuego($_POST['eliminar']);
    
    //dependiendo del resultado de la consulta redirigimos a un lugar u otro
    $result ? header('Location: exito.php') : header('Location: error.php');
    
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
        <title>Eliminar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="estilosTiendaJuegos.css" rel="stylesheet" type="text/css">        
    </head>
<body>
    <?php require_once './includes/nav.php'; ?>
<div class="container my-5" id="tablaJuegos">
    <h3 class="text-center">Lista juegos eliminar</h3>
    <!-- Creamos div para presentar la lista de juegos existente -->
    <div class="d-flex justify-content-center" >
        
            
            <!-- Creamos div para presentar la lista de juegos existente -->
            <table class="table table-striped mt-5" style="width: 100%" >
                <tr class="text-center">
                    <th>Imagen</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Plataforma</th>
                    <th>Año</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th></th>
                </tr>
            <?php
            
            foreach ($todosJuegos as $key => $value){
                ?>
            <tr><form action="" method="post">
            <?php
                echo '<td><img src="'.$value->imagen.'" style="width:100px; height:150px;"></td><td>'
                        .$value->codJuego.'</td><td>'
                        .$value->nomJuego.'</td><td>'
                        .$value->nomConsola.'</td><td>'
                        .$value->anno.'</td><td>'
                        .$value->precio.'€</td><td>'
                        .$value->descripcion.'</td>';
                ?>
            <!--Metemos en el botón el código de juego para poder actualizar tabla juegos-->
            <td><button type="submit" class="btn btn-danger" name="eliminar" value="<?php echo $value->codJuego ?>">Eliminar</button></td>
            </form>
            </tr>
               <?php

            }
        ?>

        </table> 
    
    </div> 
    
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



