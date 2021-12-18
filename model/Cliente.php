<?php


/**
 * Description of Cliente
 *
 * @author DWES
 */
class Cliente {
    public $dni, $nombre, $apellidos, $direccion, $localidad, $clave, $tipo, $intentos;
    
    public function __construct($dni, $nombre, $apellidos, $direccion, $localidad, $clave, $tipo, $intentos=3) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->direccion = $direccion;
        $this->localidad = $localidad;
        $this->clave = $clave;
        $this->tipo = $tipo;
        $this->intentos = $intentos;
    }
    
    public function __get($name) {
        
    }

    public function __set($name, $value) {
        
    }


}
