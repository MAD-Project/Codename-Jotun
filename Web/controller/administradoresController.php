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

        if (!isset($_SESSION['login']) || $_SESSION['login'] == 0){

            $this->render("adminLogIn",array());

        }
        else {

            $producto = new Producto($this->conexion);
            $productos = $producto->getAll();

            $pedidos = new Pedido($this->conexion);
            $pedidos = $pedidos->getAll();

            $this->render("administrador",array(
                "nombreUsuario"=>$_SESSION["nombreUsuario"],
                "productos" => $productos,
                "pedidos" => $pedidos
            ));
        }
    }

    public function logOut (){

        $_SESSION['login'] = null;
        $_SESSION['nombreUsuario'] = null;

        header('Location: index.php?controller=administradores&action=logIn');
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

        header('Location: index.php?controller=administradores&action=logIn');

    }

}