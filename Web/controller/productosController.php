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

    public function modificar(){

        $producto = new Producto($this->conexion);
        $producto->setId($_GET['idProducto']);
        $producto->setNombre($_POST['nombreProducto']);
        $producto->setCategoria($_POST['categoriaProducto']);
        $producto->setMedida($_POST['medidaProducto']);
        $producto->setPrecio($_POST['precioProducto']);
        $producto->setPedidoMin($_POST['pedidoMinProducto']);
        $producto->update();

        header('Location: index.php?controller=administradores&action=comprobarDatos');

    }

    public function borrar(){

        $producto = new Producto($this->conexion);
        $producto->setId($_GET['idProducto']);
        $producto->del();

        header('Location: index.php?controller=administradores&action=comprobarDatos');

    }
}