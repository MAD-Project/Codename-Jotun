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

    public function tramitarPedido(){

        $pedido = new Pedido($this->conexion);
        $pedido->setId($_POST["idPedido"]);
        $pedido->setEstado($_POST["nuevoEstado"]);

        if($pedido->tramitarPedidoModel()){
            if ($_POST["nuevoEstado"] != "E") {
                switch ($_POST["nuevoEstado"]) {
                    case 'A':
                        exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Hola " . $_POST["nombre"] . ". Su pedido ha sido confirmado.</h2> Se le enviará la fecha de recogida una vez preparado.<br>' | mail -s 'Pedido - Escuela Hosteleria\nContent-Type: text/html' " . $_POST["email"] ."");
                    break;
                    
                    case 'R':
                        exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Hola " . $_POST["nombre"] . ". Su pedido ha sido rechazado. Disculpa las molestias.</h2><br>' | mail -s 'Pedido - Escuela Hosteleria\nContent-Type: text/html' " . $_POST["email"] ."");
                    break;
        
                    case 'N':
                        exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Hola " . $_POST["nombre"] . ". Su pedido ya esta preparado.</h2>Puede recogerlo el día " . $_POST["fechaEntrega"] . " <br>' | mail -s 'Pedido - Escuela Hosteleria\nContent-Type: text/html' " . $_POST["email"] ."");
                    break;
                }

                echo "enviado";
            }
        }

    }


}