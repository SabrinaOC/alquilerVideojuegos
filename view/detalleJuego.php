<?php
require_once '../controller/JuegoController.php';
session_name('sesion');
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo: Ejemplo: Tienda web. login.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Detalle juego</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="estilosTiendaJuegos.css" rel="stylesheet" type="text/css">
    </head>
<body>
     <?php require_once './includes/nav.php'; ?>
<div class="container border my-5 bg-light">
    <!-- Creamos tabla para presentar la lista de juegos existente -->
    <div class="row">
        <?php
               
        //Hacemos consulta con código de get
        $juego = JuegoController::findJuegoById($_GET['juego']);
        
        ?>
        <div class="col-lg-4 p-4 d-flex justify-content-center">
            <img src="<?php echo $juego->imagen ?>" width="350px"/>
        </div>
        
        <div class="col-lg-8 pl-4">
            <div class="row">
                <div class="col-12"><h3 class="text-center pt-4"><?php echo $juego->nomJuego ?></h3></div>
                
                <div class="col-12 d-flex justify-content-end align-items-center"><?php if ($juego->alquilado != 'NO'){
                    echo '<h6 class="text-danger px-4">Alquilado</h6>';
                }else{
                    echo '<h6 class="text-success px-4">Disponible</h6>';
                }
              ?></div>
                <div class="col-12">Precio: <?php echo $juego->precio . '€' ?></div>
                <div class="col-12">Plataforma: <?php echo $juego->nomConsola ?></div>
                <div class="col-12">Año: <?php echo $juego->anno ?></div>
                <div class="col-12 pt-5"><?php echo $juego->descripcion ?></div>
                <div class="col-12  mt-5"><a href='index.php'><button class='btn btn-lg btn-outline-dark'>Volver</button></a></div>
               
                
            </div>
        </div>
    
    </div>
    
    
    
    
    
    
    
    
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



