<?php

require_once 'Conexion.php';
require_once '../model/Alquiler.php';
/**
 * Description of AlquilerController
 *
 * @author DWES
 */
class AlquilerController {
    
    /**
     * 
     * @return \Alquiler
     */
    public static function findAll(){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            //SELECT J.Nombre_juego juego, A.DNI_cliente dni FROM `alquiler` A, juegos J where J.Codigo=A.Cod_juego and J.Alquilado='SI' order by A.Fecha_devol DESC;
            //$resultado = $con->query("SELECT J.Nombre_juego, A.DNI_cliente, A.Fecha_alquiler, A.Fecha_devol FROM alquiler A, juegos J where J.Codigo=A.Cod_juego and J.Alquilado='SI' order by A.Fecha_devol DESC;");
            
            //historial total
            $resultado = $con->query("SELECT J.Nombre_juego, A.DNI_cliente, A.Fecha_alquiler, A.Fecha_devol FROM alquiler A, juegos J where J.Codigo=A.Cod_juego order by A.Fecha_devol DESC;");

            //Mientras haya filas seguimos creando objetos y metiéndolos en lista
                while($fila= $resultado->fetch()){
                    $misAlquilados[] = new Alquiler($fila->Nombre_juego, $fila->DNI_cliente, $fila->Fecha_alquiler, $fila->Fecha_devol);
                             
                }
                return $misAlquilados;
           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    public static function findAllByUser($dni){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            //SELECT J.Nombre_juego juego, A.DNI_cliente dni FROM `alquiler` A, juegos J where J.Codigo=A.Cod_juego and J.Alquilado='SI' order by A.Fecha_devol DESC;
            $resultado = $con->query("SELECT DISTINCT J.Nombre_juego, A.DNI_cliente, A.Fecha_alquiler, A.Fecha_devol FROM alquiler A, juegos J where J.Codigo=A.Cod_juego and J.Alquilado='SI' and A.DNI_cliente='$dni' order by A.Fecha_devol DESC;");
            
            if($resultado->rowCount()>0){
                //Mientras haya filas seguimos creando objetos y metiéndolos en lista
                while($fila= $resultado->fetch()){
                    $listaAlquilados[] = new Alquiler($fila->Nombre_juego, $fila->DNI_cliente, $fila->Fecha_alquiler, $fila->Fecha_devol);
                             
                }
                return $listaAlquilados;
            } else {
                return false;
            }
            
           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    /**
     * 
     * @param type $datosAlquiler
     */
    public static function alquilarJuego($datosAlquiler){
        
        try{
            
            //hacemos conexión
            $con =  new Conexion();
            //transaction
            $con->beginTransaction();
            try{
               $inser = $con->exec("INSERT INTO alquiler (Cod_juego, DNI_cliente, Fecha_alquiler, Fecha_devol) values ('$datosAlquiler->codJuego', '$datosAlquiler->dni', '$datosAlquiler->fechaAlquiler', '$datosAlquiler->fechaDevolucion')");
             //si no se produce ningún error hacemos update en tabla juego
               $inser = $con->exec("UPDATE juegos SET Alquilado='SI' where Codigo='$datosAlquiler->codJuego'");
               $con->commit();
            } catch (PDOException $ex) {
                $con->rollBack();
                echo 'Error insert ' . $ex->getMessage();
            }
            
            //el insert en alquiler implica un update en juegos (alquilado)
        } catch (PDOException $ex) {
            echo 'Error conexión ' . $ex->getMessage();
        }
            
    }
}
