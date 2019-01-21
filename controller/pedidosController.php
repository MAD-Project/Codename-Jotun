<?php

require_once 'IndexController.php';

class pedidosController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__.'/../model/clases/Conexion.php';
        require_once __DIR__ . '/../model/clases/Pedido.php';
        require_once __DIR__ . '/../model/clases/Producto.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }
}