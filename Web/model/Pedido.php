<?php

class Pedido{
    private $table = "pedidos";
    private $conexion;

    private $id;
    private $nombre;
    private $correo;
    private $telefono;
    private $comentario;
    private $fecha;
    private $fechaEntrega;
    private $estado;

    private $productos;

    public function __construct($conexion){
        $this->conexion=$conexion;
    }

    public function getAll(){

        $select = $this->conexion->prepare("SELECT * FROM $this->table ORDER BY ESTADO");
        $select->execute();
        $pedidos = $select->fetchAll();
        for($x = 0 ; $x< count($pedidos); $x++){
            $pedidos[$x]["productos"]=$this->getProductosPorPedido($pedidos[$x]["ID_PEDIDO"]);
        }
        $this->conexion = null;
        return $pedidos;

    }

    public function getProductosPorPedido($idPedido){
        $select = $this->conexion->prepare("SELECT prod.nombre as nombre,ppp.cantidad as cantidad FROM productos prod,productos_por_pedido ppp where prod.id_producto=ppp.id_producto AND id_pedido=?");
        $select->execute([$idPedido]);
        $productos=$select->fetchAll();

        return $productos;

    }

    public function nuevoPedido(){

        $insert = $this->conexion->prepare("INSERT INTO $this->table (NOMBRE, CORREO, TELEFONO) VALUES (:nombre,:correo,:telefono)");

        try{
            $insert->execute(array(
                "nombre" => $this->nombre,
                "correo" => $this->correo,
                "telefono" => $this->telefono
            ));
        } catch (PDOException $e) {
            $this->conexion = null;
            //devuelve false si ha ocurrido un error
            return false;
        }
        $this->conexion = null;

        return true;
    }

    public function tramitarPedido(){
        $update= $this->conexion->prepare("UPDATE pedidos SET ESTADO=:estado WHERE ID_PEDIDO=:idPedido");
        try{

            $update->execute(array(
                "estado" => $this->estado,
                "idPedido" => $this->id
            ));

            if($update->rowCount()!=1){
                $this->conexion = null;
                return false;
            }else{
                $this->conexion = null;
                return true;
            }

        } catch (PDOException $e) {
            $this->conexion = null;
            $update->rollback();
            //devuelve false si ha ocurrido un error
            $this->conexion = null;
            return false;
        }
    }


    /**
     * @return mixed
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * @param mixed $productos
     */
    public function setProductos($productos)
    {
        $this->productos = $productos;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * @param mixed $fechaEntrega
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }


}