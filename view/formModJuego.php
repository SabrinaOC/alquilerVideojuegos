<?php
require_once '../controller/JuegoController.php';
session_name('sesion');
session_start();



if (isset($_POST['enviar'])){
    echo $_FILES['foto']['size'] . "<br>";
    
    //si el tamaño de la imagen es 0 significa que no se ha seleccionado ninguna
    if($_FILES['foto']['size']<=0){
        $ruta = $_SESSION['img'];
    } else {
        //cambiamos el nombre del fichero y la ruta
        $fich = time().$_FILES['foto']['name'];
        $ruta = "imagenes/".$fich;
        
        
        //1 donde está y 2 dónde se quiere poner
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
    }
    
    
    //si se le ha dado a enviar hacemos update, pero primero creamos un objeto, el que mandaremos al update
    $juegoUpdt = new Juego($_POST['codJ'], $_POST['nomJ'], $_POST['plataformaJ'], $_POST['annoJ'], intval($_POST['precioJ']), $ruta, $_POST['descJ'], $_POST['alquilado']);
    
    
    
    $result = JuegoController::updateJuego($juegoUpdt);
    //dependiendo del resultado de la consulta redirigimos a un lugar u otro
    //$result ? header('Location: exito.php') : header('Location: error.php');
  
    //redireccionamos a info juegos
    header('Location: modificarJuegosLista.php');
} else {
    //buscamos juego por código para mostrar en formulario
    $juego = JuegoController::findJuegoById($_POST['modificar']);
    //guardamos en variable de sesión la imagen por si no se elige ninguna no cambiarla
    $_SESSION['img'] = $juego->imagen;
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
        <title>Modificar juego</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="estilosTiendaJuegos.css" rel="stylesheet" type="text/css">
    </head>
<body>
    <?php require_once './includes/nav.php'; ?>
<div class="container border my-5 bg-light" style="width: 60%">
    
    <form action='' method='post' enctype="multipart/form-data">
        
        <legend class="text-center">Modificar juego</legend>
        
        <div class="mb-3">
            <label for='cod' class="form-label">Código:</label>
            <input type='text' name='codJ' id='cod' class="form-control" value="<?php echo $juego->codJuego ?>" readonly="true"/>
        </div>
        
        <div class="mb-3">
            <label for='nom' class="form-label">Nombre:</label>
            <input type='text' name='nomJ' id='nom' class="form-control" value="<?php echo $juego->nomJuego ?>" required/>
        </div>
        
        <div class="mb-3">
            <label for='plat' class="form-label">Plataforma:</label>
            <input type='text' name='plataformaJ' id='plat' class="form-control" value="<?php echo $juego->nomConsola ?>" required/>
        </div>
        
        <div class="mb-3">
            <label for='anno' class="form-label">Año:</label>
            <input type='text' name='annoJ' id='anno' class="form-control" value="<?php echo $juego->anno ?>" required/>
        </div>
    
        <div class="mb-3">
            <label for='precio' class="form-label">Precio:</label>
            <input type='text' name='precioJ' id='precio' class="form-control" value="<?php echo $juego->precio ?>" required/>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Alquilado:</label><br>
            <input type='radio' name='alquilado' id='alqSi' class="form-check-input" value="SI" <?php if($juego->alquilado == 'SI') echo 'checked' ?>/>
            <label class="form-check-label" for="alqSi">Sí</label>
            <input type='radio' name='alquilado' id='alqNo' class="form-check-input" value="NO" <?php if($juego->alquilado == 'NO') echo 'checked' ?>/>
            <label class="form-check-label" for="alqNo">No</label>
        </div>
        
        <div class="mb-3">
            <label for='desc' class="form-label">Descripción:</label>
            <textarea name='descJ' id='desc' class="form-control" rows="6" required style="resize: none">
                <?php echo $juego->descripcion ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for='imagen' class="form-label d-flex justify-content-center">Imagen:</label>
            <div class="mb-3 ">
                <div class="row">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <img src="<?php echo $juego->imagen ?>" id='imagen' style="width: 200px"/>
                    </div>
                    
                    <div class="col-12 d-flex justify-content-center">
                        <input type="file" name="foto">
                    </div>
                                
                </div>
            </div>
            
        </div>
        
        <div class="my-3 d-flex justify-content-end ">
            <a href="modificarJuegosLista.php"><button type='button' class="btn btn-outline-success">Volver</button></a>
            <button type='submit' name='enviar' class="btn btn-success mx-3">Modificar</button>
        </div>
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



