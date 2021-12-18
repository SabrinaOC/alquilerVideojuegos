<?php

require_once 'Conexion.php';
require_once '../model/Cliente.php';

/**
 * Description of ClienteController
 *
 * @author DWES
 */
class ClienteController {
    
    /**
     * 
     * @return \Cliente
     */
    public static function findAll(){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            $resultado = $con->query("SELECT * FROM cliente");
            

            //Mientras haya filas seguimos creando objetos y metiéndolos en lista
                while($fila= $resultado->fetch()){
                    $listaClientes[] = new Cliente($fila->Dni, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo, $fila->intentos,);
                    //$listaJuegos[] = new Juego($codJuego, $nomJuego, $nomConsola, $anno, $precio, $imagen, $descripcion, $alquilado)
                    
                }
                return $listaClientes;
           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    /**
     * 
     * @param type $dni
     * @param type $pass
     * @return boolean|\Cliente
     */
    public static function findbyDniAndPassword($dni, $pass){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            $resultado = $con->query("SELECT * FROM cliente where Dni='$dni' and Clave='$pass' and intentos>0");
            
            //si se encuentra coincidencia le devolvemos una instancia de cliente, 
            //si no, false
            if($resultado->rowCount()>0){
                $fila = $resultado->fetch();
                return new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo, $fila->intentos);
            } else {
                return false;
            }           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    /**
     * 
     * @param type $dni
     * @return boolean
     */
    public static function findbyDni($dni){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            $resultado = $con->query("SELECT * FROM cliente where Dni='$dni'");
            
            //si se encuentra coincidencia le devolvemos una instancia de cliente, 
            //si no, false
            if($resultado->rowCount()>0){
                //si existe, restamos un intento
                $resultado = $con->exec("UPDATE cliente SET intentos= intentos-1 where Dni='$dni'");
                //devolvemos intentos restantes
                $intentos = $con->query("SELECT intentos from cliente where Dni='$dni'");
                $result = $intentos->fetch();
                //$n = new num
                return $result->intentos;
                //$fila = $resultado->fetch();
               // return new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo, $fila->intentos);
            } else {
                //si no existe devolvemos false
                return false;
            }           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    /**
     * 
     * @return boolean|\Cliente
     */
    public static function findAllUsuariosBloqueados(){
        
        try{
            //hacemos conexión
            $con =  new Conexion();
            //hacemos select
            $resultado = $con->query("SELECT * FROM cliente where intentos<1");
            
            //si hay resultados los metemos en lista y devolvemos
            if($resultado->rowCount()>0){
                //Mientras haya filas seguimos creando objetos y metiéndolos en lista
                while($fila= $resultado->fetch()){
                    $listaClientes[] = new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo, $fila->intentos);
                                        
                }
                return $listaClientes;
            }else{
                return false;
            }
            
           
            
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
    
    public static function desbloquearUsuario($dni){
        
            //hacemos conexión
            $con =  new Conexion();
        try{
            
            $updt = $con->exec("UPDATE cliente SET intentos=3 where DNI='$dni'");          
            return $updt;
        } catch (PDOException $ex) {
            echo 'Error en select ' . $ex->getMessage();
        }  
        
    }
}
