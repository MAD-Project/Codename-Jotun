<?php

require_once 'indexController.php';

class productosController extends IndexController {
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
        $carrito=isset($_COOKIE['productosCarrito'])?$this->llenarCarrito($productos):"";
        $this->render("index", array(
            "productos" => $productos,
            "categorias" => $categorias,
            "carrito" => $carrito
        ));
    }

    public function llenarCarrito($productos){
        $cookie = json_decode($_COOKIE['productosCarrito'],true);
        for ($x=0;$x<count($cookie);$x++){
            foreach ($productos as $producto) {
                if($cookie[$x]["id"]==$producto["ID_PRODUCTO"]){
                    $cookie[$x]["nombre"]=$producto["NOMBRE"];
                    $cookie[$x]["min"]=$producto["PEDIDO_MIN"];
                    
                }
            }
        }
        return $cookie;

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

        header('Location: index.php?controller=Administradores&action=comprobarDatos');

    }

    public function borrar(){

        $producto = new Producto($this->conexion);
        $producto->setId($_GET['idProducto']);
        $producto->del();

        header('Location: index.php?controller=Administradores&action=comprobarDatos');

    }

    public function anadirProducto(){

        $producto = new Producto($this->conexion);
        $producto->setNombre($_POST['nombreProducto']);
        $producto->setCategoria($_POST['categoriaProducto']);
        $producto->setMedida($_POST['medidaProducto']);
        $producto->setPrecio($_POST['precioProducto']);
        $producto->setPedidoMin($_POST['pedidoMinProducto']);
        $producto->anadir();

        header('Location: index.php?controller=Administradores&action=comprobarDatos');
    }
}