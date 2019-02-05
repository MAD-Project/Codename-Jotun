<?php

require_once 'indexController.php';

class pedidosController extends IndexController {
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

        $pedidos = json_decode($_POST['pedidos']);

        $pedido = new Pedido($this->conexion);

        $pedido->setNombre($pedidos[0]->nombre);
        $pedido->setCorreo($pedidos[0]->correo);
        $pedido->setTelefono($pedidos[0]->telefono);
        $pedido->setFecha($pedidos[0]->fecha);
        $pedido->setFechaEntrega($pedidos[0]->fechaEntrega);
        $pedido->setComentario($pedidos[0]->comentario);
        $pedido->setEstado($pedidos[0]->estado);

        $pedido->setProductos($pedidos);

        if ($pedido->nuevoPedido()){
            die("bien");
        }
        else {
            die("mal");
        }

    }

    public function enviarMail(){
        exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Su pedido ha sido confirmado.</h2> Puede pasar a recogerlo dentro de 4 días laborables.<br>' | mail -s 'This is the subject\nContent-Type: text/html' " . $_POST['email'] ."");
    }

    public function tramitarPedido(){

        $pedido = new Pedido($this->conexion);
        $pedido->setId($_POST["idPedido"]);
        $pedido->setEstado($_POST["nuevoEstado"]);

        if($pedido->tramitarPedido()){
            if ($_POST["nuevoEstado"] != "E") {
                enviarMail();
            }
            return true;
        }
        return false;

    }

}