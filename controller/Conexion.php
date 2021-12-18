<?php

//personalizamos pdo

/**
 * Description of Conexion
 *
 * @author DWES
 */
class Conexion extends PDO{
    //elementos que le pasaríamos a la conexión de mysqli
   private $dsn='mysql:host=localhost; dbname=alquiler_juegos; charset=utf8mb4', $usu = 'dwes', $pass = 'abc123.';
   private $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
   
   /**
    * 
    * @param type $host
    * @param type $usu
    * @param type $pass
    * @param type $dataBase
    */
   public function __construct() {
       
       try {
           //parent::__construct($this->host, $this->usu, $this->pass, $this->options);
           parent::__construct($this->dsn, $this->usu, $this->pass, $this->options);
       } catch (PDOException $ex) {
           echo 'Error en la conexión a la base de datos '.$ex->getMessage();
       }
       
       
   }

}
