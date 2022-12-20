<?php

class Bd
{
    private $servidor = 'localhost';
    private $usuario = 'admin';
    private $password = 'admin';
    private $nombre_bd='contactarte2';


    public function __construct(){
        $this->conectar();
    }

    private function conectar(){
        $conexion = mysqli_connect($this->servidor,$this->usuario,$this->password,$this->nombre_bd);
        $errorMsg = "";
        if (mysqli_connect_errno()){
            $errorMsg = "Error al conectarse a la base de datos.";
            echo $errorMsg;
        }
            return $conexion;
    }
}