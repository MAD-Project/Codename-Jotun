<?php

require_once 'indexController.php';

class administradoresController extends IndexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__ . '/../model/Conexion.php';
        require_once __DIR__ . '/../model/Administrador.php';
        require_once __DIR__ . '/../model/Producto.php';
        require_once __DIR__ . '/../model/Pedido.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }

    public function logIn (){

        if (!isset($_SESSION['login']) || $_SESSION['login'] == 0){

            $this->render("adminLogIn",array());

        }
        else {

            $producto = new Producto($this->conexion);
            $productos = $producto->getAll();

            $pedidos = new Pedido($this->conexion);
            $pedidos = $pedidos->getAll();

            $administrador=new Administrador($this->conexion);
            $pedidosHabilitado=$administrador->isPedidosHabilitado();

            $this->render("administrador",array(
                "nombreUsuario"=>$_SESSION["nombreUsuario"],
                "productos" => $productos,
                "pedidos" => $pedidos,
                "pedidosHabilitado" => $pedidosHabilitado
            ));
        }
    }

    public function logOut (){

        $_SESSION['login'] = null;
        $_SESSION['nombreUsuario'] = null;

        header('Location: index.php?controller=Administradores&action=logIn');
    }

    public function comprobarDatos(){

        if (!isset($_SESSION['login'])){
            $_SESSION['login'] = 0;
        }

        if (isset($_POST['usuarioAdmin'],$_POST['passwordAdmin'])){

            $admin= new Administrador($this->conexion);
            $admin->setUsuario($_POST["usuarioAdmin"]);
            $admin->setPassword($_POST["passwordAdmin"]);
            $_SESSION['login'] = $admin->comprobarCredenciales();
            $_SESSION["nombreUsuario"]=$admin->getNombre();

        }

        header('Location: index.php?controller=Administradores&action=logIn');

    }

    public function estadisticasClientes(){

        if ($_SESSION['login'] == 1){

            $pedido = new Pedido($this->conexion);
            $estadisticasClientes = $pedido->estadisticasClientes();

            die(json_encode($estadisticasClientes));
        }
        else {

            die(json_encode("noLogin"));
        }
    }

    public function estadisticasProductos(){

        if ($_SESSION['login'] == 1){

            $pedido = new Pedido($this->conexion);
            $estadisticasProductos = $pedido->estadisticasProductos();

            die(json_encode($estadisticasProductos));
        }
        else {

            die(json_encode("noLogin"));
        }
    }

    public function habilitarPedidos(){

        $administrador=new Administrador($this->conexion);
        $administrador->setNombre($_POST["nombreAdmin"]);

        if($_POST["habilitar"] == 'true'){
            $administrador->habilitarPedidos();
        }else{

            $administrador->deshabilitarPedidos();
        }
    }
}