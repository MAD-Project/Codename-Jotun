<?php

require_once 'IndexController.php';

class productosController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__ . '/../model/Conexion.php';
        require_once __DIR__ . '/../model/Producto.php';
        require_once __DIR__ . '/../model/Pedido.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }

    public function index(){

        $producto = new Producto($this->conexion);
        $productos = $producto->getAll();
        $categorias = $producto->categorias();

        $this->render("index", array(
            "productos" => $productos,
            "categorias" => $categorias
        ));
    }
}