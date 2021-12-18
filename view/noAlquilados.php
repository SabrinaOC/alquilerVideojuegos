<?php
require_once '../controller/JuegoController.php';
require_once '../controller/AlquilerController.php';
require_once '../model/Cliente.php';
session_name('sesion');
session_start();



$listaJuegos = JuegoController::findAllNoAlquilados();

//controlamos alquiler de juego
if(isset($_POST['alquilar'])){
    //$deco = json_decode($_POST['alquilar']);
    $deco = $_POST['alquilar'];
   // echo var_dump($deco).'<br>';
    //echo $_SESSION['usuario']->dni;
    //llamamos a controlador para hacer insert
    AlquilerController::alquilarJuego(new Alquiler($deco, $_SESSION['usuario']->dni, Alquiler::fechaDeHoy(), Alquiler::calcularFechaDevolucion()));
    header('Location: index.php');
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
        <title>Inicio</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="estilosTiendaJuegos.css" rel="stylesheet" type="text/css">
    </head>
<body>
    <?php require_once './includes/nav.php'; ?>
<div class="container my-5">
    <h3 class="text-center">Juegos disponibles en tienda</h3>
    <!-- Creamos div para presentar la lista de juegos existente -->
    <div class="d-flex flex-wrap bg-light justify-content-center mt-5">
        <?php
        foreach ($listaJuegos as $key => $value){
            //echo $value;
            ?>
        <div class="row m-2">
            <div class="col-12 d-flex justify-content-center">
            
        <?php
            //hacemos una columna por cada
            echo "<a href='detalleJuego.php?juego=". json_encode($value)
                    ."'><img src='". $value->imagen ."' width='250px' height='400px'";
            if ($value->alquilado != 'NO') {
                echo "class='JuegoAlquilado'></a>";
            } else {
                echo "</a>";
            }
            ?>
            </div>  
                <?php
            //si el usuario está logueado mostramos opción alquilar
            if(isset($_SESSION['logueado']) && $_SESSION['logueado']){
                
                ?>
            <div class="col-12 d-flex justify-content-center mt-2 mb-5">
                <form action="" method="post">
                    
                    <button type="submit" class="btn btn-success" name="alquilar"
                        value="<?php echo $value->codJuego ?>" style="width:100%">Alquilar</button>
           
                </form>
            </div>
                <?php
            }
            ?>
            
        </div>
            <?php
        } ?>
    
    </div> 
    
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>



