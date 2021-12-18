<?php
require_once '../controller/AlquilerController.php';
session_name('sesion');
session_start();

$listaAlquilados = AlquilerController::findAll();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo: Ejemplo: Tienda web. login.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Alquilados</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="estilosTiendaJuegos.css" rel="stylesheet" type="text/css">
    </head>
<body>
     <?php require_once './includes/nav.php'; ?>
<div class="container my-5 ">
    <h3 class="text-center">Historial alquilados</h3>
    <!-- Creamos div para presentar la lista de juegos existente -->
    <table class="table table-striped mt-5" >
        <tr>
            <th>Nombre</th>
            <th>Alquilado</th>
            <th>Fecha devolución</th>
        </tr>
        <?php
        //echo var_dump($listaAlquilados);
        foreach ($listaAlquilados as $key => $value){
            echo '<tr><td>'.$value->codJuego.'</td><td>'
                    .$value->dni.'</td><td>'
                    .$value->fechaDevolucion.'</td>'
            . '</tr>';
            
            
            
        } ?>
    
    </table> 
    
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



