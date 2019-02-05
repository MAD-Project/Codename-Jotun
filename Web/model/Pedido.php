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

        try{

            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conexion->beginTransaction();

            $insert = $this->conexion->prepare("INSERT INTO $this->table (NOMBRE, CORREO, TELEFONO, COMENTARIO, FECHA, FECHA_ENTREGA, ESTADO) VALUES (:nombre,:correo,:telefono,:comentario,:fecha,:fechaEntrega,:estado)");

            $insert->execute(array(
                "nombre" => $this->nombre,
                "correo" => $this->correo,
                "telefono" => $this->telefono,
                "comentario" => $this->comentario,
                "fecha" => $this->fecha,
                "fechaEntrega" => $this->fechaEntrega,
                "estado" => $this->estado
            ));

            $id = $this->conexion->lastInsertId();

            for ($x=1;$x<count($this->productos);$x++){
                $insert = $this->conexion->prepare("INSERT INTO productos_por_pedido(id_pedido,id_producto,cantidad) VALUES(:idPedido,:idProducto,:cantidad)");
                $insert->execute(array(
                    "idPedido" => $id,
                    "idProducto" =>  $this->productos[$x]->id,
                    "cantidad" => $this->productos[$x]->cantidad
                ));
            }

            $this->conexion->commit();

        } catch (PDOException $e) {

            $this->conexion->rollBack();
            $this->conexion = null;
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
            $update->rollback();
            //devuelve false si ha ocurrido un error
            $this->conexion = null;
            return false;
        }
    }

    public function estadisticasClientes(){

        $select = $this->conexion->prepare("SELECT COUNT(*) as clientes FROM pedidos WHERE CORREO IN (select CORREO from pedidos GROUP by CORREO HAVING COUNT(CORREO) = 1) UNION ALL SELECT COUNT(DISTINCT(CORREO)) as clientes FROM pedidos WHERE CORREO IN (select DISTINCT(CORREO) from pedidos GROUP by CORREO HAVING COUNT(CORREO) > 1) AND CORREO IN (SELECT DISTINCT(CORREO) from pedidos GROUP BY CORREO HAVING COUNT(CORREO) < 5) UNION ALL SELECT COUNT(DISTINCT(CORREO)) as clientes FROM pedidos WHERE CORREO IN (select DISTINCT(CORREO) from pedidos GROUP by CORREO HAVING COUNT(CORREO) > 5)");
        $select->execute();
        $result = $select->fetchAll();

        $this->conexion = null;

        return $result;
    }

    public  function estadisticasProductos(){

        $select = $this->conexion->prepare("select po.nombre, sum(pp.CANTIDAD) as cantidad from productos po, pedidos pe, productos_por_pedido pp WHERE pp.ID_PEDIDO = pe.ID_PEDIDO and po.ID_PRODUCTO = pp.ID_PRODUCTO and pe.ESTADO = 'E' GROUP by po.NOMBRE");
        $select->execute();
        $result = $select->fetchAll();

        $this->conexion = null;

        return $result;
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