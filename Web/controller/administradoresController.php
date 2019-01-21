<?php

require_once 'IndexController.php';

class administradoresController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__.'/../model/clases/Conexion.php';
        require_once __DIR__ .'/../model/clases/Administrador.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }

}