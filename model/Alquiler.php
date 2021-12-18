<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alquiler
 *
 * @author DWES
 */
class Alquiler {
    public $codJuego, $dni, $fechaAlquiler, $fechaDevolucion;
    
    /**
     * 
     * @param type $codJuego
     * @param type $dni
     */
    public function __construct($codJuego, $dni, $fechaAlquiler, $fechaDevolucion) {
        $this->codJuego = $codJuego;
        $this->dni = $dni;
        
           // $this->fechaAlquiler = Date('Y-m-d', time());
      
            $this->fechaAlquiler = $fechaAlquiler;
       
            $this->fechaDevolucion = $fechaDevolucion;
        
        
        
    }
    
    /**
     * 
     * @param type $name
     * @param type $value
     */
    public function __set($name, $value) {
        
    }

    /**
     * 
     */
    public function __get($name) {
        
    }

    public static function calcularFechaDevolucion(){
        return Date('Y-m-d', time()+3600*24*7);
    }
    
    public static function fechaDeHoy(){
        return Date('Y-m-d', time());
    }

}
