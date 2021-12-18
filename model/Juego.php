<?php

/**
 * Description of Juego
 *
 * @author DWES
 */
class Juego {
    public $codJuego, $nomJuego, $nomConsola, $anno, $precio, $alquilado, $imagen, $descripcion;
    
    /**
     * 
     * @param type $nomJuego
     * @param type $nomConsola
     * @param type $anno
     * @param type $precio
     * @param type $imagen
     * @param type $descripcion
     */
    public function __construct($codJuego, $nomJuego, $nomConsola, $anno, $precio, $imagen, $descripcion, $alquilado='NO') {
        $this->codJuego = $codJuego;
        $this->nomJuego = $nomJuego;
        $this->nomConsola = $nomConsola;
        $this->anno = $anno;
        $this->precio = $precio;
        $this->alquilado = $alquilado;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
    }
    
    /**
     * 
     * @param type $name
     */
    public function __get($name) {
        
    }

    /**
     * 
     * @param type $name
     * @param type $value
     */
    public function __set($name, $value) {
        
    }
    
    public function __toString() {
        return $this->nomJuego.' '. $this->precio .' ';
    }

        
    /**
     * Función para crear código de juego (Iniciales juego-NombreConsola)
     * 
     */
    public static function crearCodigoJuego($nomJuego, $nomConsola){
        
     $arrayPalabras = explode(" ", $nomJuego);
      //ahora recogemos la primera letra de cada palabra que compone el juego
      $codigoCreado = '';
      foreach ($arrayPalabras as $key => $value){
          $codigoCreado .= substr($value, 0, 1);
          echo $codigoCreado;
      }
      $codigoCreado .= '-' . $nomConsola;
      return $codigoCreado;
    }
    
    

}
