<?php
require_once '../controller/JuegoController.php';
session_name('sesion');
session_start();



if (isset($_POST['enviar'])){
    
    
    
        //cambiamos el nombre del fichero y la ruta
        $fich = time().$_FILES['foto']['name'];
        $ruta = "imagenes/".$fich; 
        
        
        //1 donde está y 2 dónde se quiere poner
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
   
    $cod = Juego::crearCodigoJuego($_POST['nomJ'], $_POST['plataformaJ']);
    //echo var_dump($cod);
    //si se le ha dado a enviar hacemos update, pero primero creamos un objeto, el que mandaremos al update
    $juegoNuevo = new Juego($cod, $_POST['nomJ'], $_POST['plataformaJ'], $_POST['annoJ'], intval($_POST['precioJ']), $ruta, $_POST['descJ']);
    
    //echo '<br>Juego creado de formulario: '.var_dump($juegoNuevo);
    
    $r = JuegoController::insertJuego($juegoNuevo);
    
  
    //redireccionamos a info juegos
    header('Location: modificarJuegosLista.php');
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
        <title>Nuevo juego</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="estilosTiendaJuegos.css" rel="stylesheet" type="text/css">
    </head>
<body>
    <?php require_once './includes/nav.php'; ?>
<div class="container border my-5 bg-light" style="width: 60%">
    
    <form action='' method='post' enctype="multipart/form-data">
        
        <legend class="text-center">Nuevo juego</legend>
        
        
        <div class="mb-3">
            <label for='nom' class="form-label">Nombre:</label>
            <input type='text' name='nomJ' id='nom' class="form-control" placeholder="Ej: Mario Kart" required/>
        </div>
        
        <div class="mb-3">
            <label for='plat' class="form-label">Plataforma:</label>
            <input type='text' name='plataformaJ' id='plat' class="form-control" placeholder="Ej: Nintendo Switch" required/>
        </div>
        
        <div class="mb-3">
            <label for='anno' class="form-label">Año:</label>
            <input type='text' name='annoJ' id='anno' class="form-control" placeholder="Ej: 2020" required/>
        </div>
    
        <div class="mb-3">
            <label for='precio' class="form-label">Precio:</label>
            <input type='number' name='precioJ' id='precio' class="form-control" placeholder="Ej: 65" required/>
        </div>
        
        <div class="mb-3">
            <label for='desc' class="form-label">Descripción:</label>
            <textarea name='descJ' id='desc' class="form-control" rows="6" required style="resize: none" placeholder="Escriba aquí una breve descripción del juego">
                </textarea>
        </div>
        
        
        <label for='imagen' class="form-label">Imagen:</label>
        <div class="mb-3 ">
            <input type="file" name="foto" required>

        </div>
            
        
        
        <div class="my-3 d-flex justify-content-end ">
            <a href="index.php"><button type='button' class="btn btn-outline-success">Volver</button></a>
            <button type='submit' name='enviar' class="btn btn-success mx-3">Aceptar</button>
        </div>
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



