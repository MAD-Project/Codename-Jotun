<?php

require_once 'IndexController.php';

class administradoresController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__ . '/../model/Conexion.php';
        require_once __DIR__ . '/../model/Administrador.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }

    public function logIn (){

        $this->render("adminLogIn",array());
    }

    public function comrpobarDatos(){
        $admin= new Administrador();
        $admin->setPassword($_POST["password"]);
        $admin->setUsuario($_POST["user"]);
        $admin->comprobarCredenciales();
    }
}