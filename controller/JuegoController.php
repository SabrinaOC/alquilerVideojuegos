<?php
require_once 'Conexion.php';
require_once '../model/Juego.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JuegoController
 *
 * @author DWES
 */

class JuegoController {
    
    /**
     * 
     * @return \Juego
     */
    public static function findAll(){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            $resultado = $con->query("SELECT * FROM juegos");
            

            //Mientras haya filas seguimos creando objetos y metiéndolos en lista
                while($fila= $resultado->fetch()){
                    $listaJuegos[] = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Imagen, $fila->descripcion, $fila->Alquilado,);
                    
                }
                return $listaJuegos;
           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    public static function findJuegoById($cod){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            $resultado = $con->query("SELECT * FROM juegos where Codigo='$cod'");
            

            //Mientras haya filas seguimos creando objetos y metiéndolos en lista
            $fila= $resultado->fetch();
             $juego = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Imagen, $fila->descripcion, $fila->Alquilado,);
                    
                
                return $juego;
           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    public static function findAllNoAlquilados(){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            $resultado = $con->query("SELECT * FROM juegos where Alquilado='NO'");
            

            //Mientras haya filas seguimos creando objetos y metiéndolos en lista
                while($fila= $resultado->fetch()){
                    $listaJuegos[] = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Imagen, $fila->descripcion, $fila->Alquilado,);
                    
                }
                return $listaJuegos;
           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    /**
     * 
     * @param type $codJ
     */
    public static function devolverJuego($nomJ){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            
             //si no se produce ningún error hacemos update en tabla juego
             $updt = $con->exec("UPDATE juegos SET Alquilado='NO' where Nombre_juego='$nomJ'");
              
        } catch (PDOException $ex) {
            echo 'Error conexión ' . $ex->getMessage();
        }
            
    }
    
    /**
     * 
     * @param type $juego
     * @return boolean
     */
    public static function updateJuego($juego){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            
             //si no se produce ningún error hacemos update en tabla juego
             $updt = $con->exec("UPDATE juegos SET Nombre_juego='$juego->nomJuego', Nombre_consola='$juego->nomConsola', Anno='$juego->anno', Precio=$juego->precio, Alquilado='$juego->alquilado', Imagen='$juego->imagen', descripcion='$juego->descripcion' where Codigo='$juego->codJuego'");
             return $updt;
        } catch (PDOException $ex) {
            echo 'Error conexión ' . $ex->getMessage();
            return false;
        }
            
    }
    
    /**
     * 
     * @param type $juego
     * @return type
     */
    public static function insertJuego($juego){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //para evitar problemas de  '' usamos consulta preparada
            //preparamos consulta. Esto nos devuelve un objeto de la clase pdoStatement o falso si da error
            $prepar = $con->prepare("INSERT INTO juegos (Codigo, Nombre_juego, Nombre_consola, Anno, Precio, Alquilado, Imagen, descripcion) VALUES (:codJuego, :nomJuego, :nomConsola, :anno, :precio, :alquilado, :imagen, :descripcion)");
            //pasamos parámetros
            $prepar->bindParam(':codJuego', $juego->codJuego);
            $prepar->bindParam(':nomJuego', $juego->nomJuego);
            $prepar->bindParam(':nomConsola', $juego->nomConsola);
            $prepar->bindParam(':anno', $juego->anno);
            $prepar->bindParam(':precio', $juego->precio);
            $prepar->bindParam(':alquilado', $juego->alquilado);
            $prepar->bindParam(':imagen', $juego->imagen);
            $prepar->bindParam(':descripcion', $juego->descripcion);
            
            //ejecutamos consulta
            $prepar->execute();

            //si no se produce ningún error hacemos update en tabla juego
             //$updt = $con->exec("INSERT INTO juegos VALUES ('$juego->codJuego', '$juego->nomJuego', '$juego->nomConsola', '$juego->anno', $juego->precio, '$juego->alquilado', '$juego->imagen', '$juego->descripcion');");
            // print_r($con->errorInfo());
        } catch (PDOException $ex) {
            echo 'Error conexión ' . $ex->getMessage();
            return $ex->getMessage();
        }
            
    }
    
    /**
     * 
     * @param type $nomJ
     */
    public static function deleteJuego($codJuego){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            
             //si no se produce ningún error hacemos update en tabla juego
             $updt = $con->exec("DELETE FROM juegos where Codigo='$codJuego'");
              return $updt;
        } catch (PDOException $ex) {
            echo 'Error conexión ' . $ex->getMessage();
        }
            
    }
}
