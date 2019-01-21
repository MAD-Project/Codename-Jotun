<?php

require_once 'IndexController.php';

class clientesController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__.'/../model/clases/Conexion.php';
        require_once __DIR__ . '/../model/clases/Cliente.php';
        require_once __DIR__ . '/../model/clases/Pedido.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }

    public function cargarFormulario(){
        $this->render("formularioCliente",array());
    }

    public function realizarPedido(){

        $cliente = new Cliente($this->conexion);
        $cliente->setCorreo($_POST['email']);
        $idCliente=$cliente->comprobarEmail();

        if($idCliente==0){
            $cliente->setNombre($_POST['nombre']);
            $cliente->setTelefono($_POST['telefono']);
            if($cliente->nuevoCliente()){
                $mensaje="todo bien";
            }else{
                $mensaje="todo mal";
            }
        }else{
            $mensaje="aun no esta";
        }

        $this->render("formularioCliente",array("mensaje"=>$mensaje));
    }
}