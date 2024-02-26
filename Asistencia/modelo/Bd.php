<?php
class Bd{
    private $server = "localhost:3306";
    private $usuario = "root";
    private $pass = "marsupilami00";
    private $basedatos = "ListaDeEstudiantes";

    private $conexion;
    private $resultado;

    public function __construct(){
        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass, $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");
    }

    public function escapar($valor) {
        return $this->conexion->real_escape_string($valor);
    }


    public function consulta($sql){
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;
        return $res;
    }
    
    public function __destruct() {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }

    
    
}