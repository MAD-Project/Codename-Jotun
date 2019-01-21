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