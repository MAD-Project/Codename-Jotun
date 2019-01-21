<?php

class Cliente{
    private $table = "clientes";
    private $conexion;

    private $id;
    private $nombre;
    private $correo;
    private $telefono;

    private $pedido;

    public function __construct($conexion){
        $this->conexion=$conexion;
    }

    public function comprobarEmail(){
        $select = $this->conexion->prepare("SELECT * FROM $this->table WHERE CORREO=? LIMIT 1");
        $select -> execute([$this->correo]);
        if($select->rowcount()==0){
            $cliente=0;
        }else{
            $cliente=$select->fetch();
        }
        $this->conexion = null;

        return $cliente;
    }

    public function nuevoCliente(){

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

    /**
     * @return mixed
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * @param mixed $pedido
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
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


}