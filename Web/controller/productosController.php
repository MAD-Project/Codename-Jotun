<?php

require_once 'IndexController.php';

class productosController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__.'/../model/clases/Conexion.php';
        require_once __DIR__ . '/../model/clases/Producto.php';
        require_once __DIR__ . '/../model/clases/Pedido.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }
}