<?php

require_once 'indexController.php';

class pedidosController extends indexController {
    private $conectar;
    private $conexion;

    public function __construct(){
        require_once __DIR__ . '/../model/clases/Conexion.php';
        require_once __DIR__ . '/../model/clases/Pedido.php';
        require_once __DIR__ . '/../model/clases/Producto.php';

        $this->conectar = new Conexion();
        $this->conexion = $this->conectar->conexion();
    }
    public function cargarFormulario(){
        $this->render("formularioPedido",array());
    }
    
    public function realizarPedido(){

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
}