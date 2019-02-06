<?php

class Producto{
    private $table = "productos";
    private $conexion;

    private $id;
    private $nombre;
    private $categoria;
    private $medida;
    private $precio;
    private $pedidoMin;

    private $pedidos;

    public function __construct($conexion){
        $this->conexion=$conexion;
    }

    public function getAll(){

        $select = $this->conexion->prepare("SELECT * FROM $this->table ORDER BY CASE WHEN categoria = 'entrantes' THEN 1 WHEN CATEGORIA like '%TARTAS%' THEN 3 WHEN CATEGORIA='variedades' THEN 4 ELSE 2 END");
        $select->execute();
        $result = $select->fetchAll();

        return $result;
    }

    public function categorias(){

        $select = $this->conexion->prepare("SELECT DISTINCT categoria FROM $this->table ORDER BY CASE WHEN categoria = 'entrantes' THEN 1 WHEN CATEGORIA like '%TARTAS%' THEN 3 WHEN CATEGORIA='variedades' THEN 4 ELSE 2 END");
        $select->execute();
        $result = $select->fetchAll();
        $this->conexion = null;

        return $result;
    }

    public function update(){

        $update = $this->conexion->prepare("UPDATE productos SET nombre=:nombre, categoria=:categoria, medida=:medida, precio=:precio, pedido_min=:pedidoMin WHERE id_producto = :idProducto");
        $update->execute(array(
            "idProducto" => $this->id,
            "nombre" => $this->nombre,
            "categoria" => $this->categoria,
            "medida" => $this->medida,
            "precio" => $this->precio,
            "pedidoMin" => $this->pedidoMin
        ));

        $this->conexion = null;

    }

    public function del(){

        $delete = $this->conexion->prepare("DELETE FROM productos WHERE id_producto = :idProducto");
        $delete->execute(array(
           "idProducto" => $this->id
        ));

        $this->conexion = null;

    }

    public function anadir(){

        $insert = $this->conexion->prepare("INSERT INTO productos(nombre,categoria,medida,precio,pedido_min) VALUES(:nombre,:categoria,:medida,:precio,:pedido_min)");

        $insert->execute(array(
           "nombre" => $this->nombre,
           "categoria" => $this->categoria,
           "medida" => $this->medida,
           "precio" => $this->precio,
           "pedido_min" => $this->pedidoMin
        ));

        $this->conexion = null;
    }

    /**
     * @return mixed
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }

    /**
     * @param mixed $pedidos
     */
    public function setPedidos($pedidos)
    {
        $this->pedidos = $pedidos;
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
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getMedida()
    {
        return $this->medida;
    }

    /**
     * @param mixed $medida
     */
    public function setMedida($medida)
    {
        $this->medida = $medida;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getPedidoMin()
    {
        return $this->pedidoMin;
    }

    /**
     * @param mixed $pedidoMin
     */
    public function setPedidoMin($pedidoMin)
    {
        $this->pedidoMin = $pedidoMin;
    }


}