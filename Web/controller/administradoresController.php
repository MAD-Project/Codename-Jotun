<?php

require_once 'IndexController.php';

class administradoresController extends indexController {
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

        $this->render("adminLogIn",array());
    }

    public function logOut (){
        $_SESSION = array();
        session_destroy();
        header('Location: index.php?controller=administradores&action=logIn');
    }

    public function comprobarDatos(){

        if(!isset($_SESSION["nombreUsuario"]) && (isset($_POST["password"]) && isset($_POST["user"]))){
            $admin= new Administrador($this->conexion);
            $admin->setPassword($_POST["password"]);
            $admin->setUsuario($_POST["user"]);
            unset($_POST["password"]);
            unset($_POST["user"]);
            $nombreUsuario=$admin->comprobarCredenciales();
        }else{
            $nombreUsuario["NOMBRE"]=$_SESSION["nombreUsuario"] ?? false;
        }

        if($nombreUsuario){
            $_SESSION["nombreUsuario"]=$nombreUsuario["NOMBRE"];
            $producto = new Producto($this->conexion);
            $productos = $producto->getAll();

            $pedidos = new Pedido($this->conexion);
            $pedidos = $pedidos->getAll();

            $this->render("administrador",array(
                "nombreUsuario"=>$nombreUsuario["NOMBRE"],
                "productos" => $productos,
                "pedidos" => $pedidos
            ));
        }else{
            $this->render("adminLogIn",array("error"=>true));
        }

    }
}