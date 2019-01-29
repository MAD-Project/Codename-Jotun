<?php

require_once 'indexController.php';

class pedidosController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__ . '/../model/Conexion.php';
        require_once __DIR__ . '/../model/Pedido.php';
        require_once __DIR__ . '/../model/Producto.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }
    public function cargarFormulario(){
        $this->render("formularioPedido",array());
    }
    
    public function realizarPedido(){

        die(print_r(json_decode($_POST['productos'])));

        $pedido = new Pedido($this->conexion);

        $pedido->setCorreo($_POST['email']);
        $pedido->setNombre($_POST['nombre']);
        $pedido->setTelefono($_POST['telefono']);
        $pedido->setComentario($_POST['comentario']);

        if($pedido->nuevoPedido()){
            $mensaje="todo bien";
        }else{
            $mensaje="todo mal";
        }

        $this->render("formularioPedido",array("mensaje"=>$mensaje));
    }

    public function enviarMail(){
        /*Hacer esto una vez en el server, con servidor de correo
         * $headers =  'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: Mikel <mklferreiro@gmail.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        mail('mklferreiro@gmail.com', 'Mi título', "prueba de mensaje",$headers);*/
    }

    public function tramitarPedido(){

        $pedido = new Pedido($this->conexion);
        $pedido->setId($_POST["idPedido"]);
        $pedido->setEstado($_POST["nuevoEstado"]);

        die(0);

    }

}