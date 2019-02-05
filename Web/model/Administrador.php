<?php

class Administrador {
    private $table = "administradores";
    private $conexion;

    private $id;
    private $nombre;
    private $usuario;
    private $password;

    public function __construct($conexion){
        $this->conexion=$conexion;
    }

    public function comprobarCredenciales(){

        $select = $this->conexion->prepare("SELECT NOMBRE FROM $this->table where USUARIO=:usuario AND PASSWORD=:password");

        $select->execute(array(
            "usuario" => $this->usuario,
            "password" => $this->password
        ));

        if ($select->rowCount() == 0){

            return false;
        }
        else {

            $this->setNombre($select->fetchObject()->NOMBRE);
            return true;
        }
    }

    public function deshabilitarPedidos(){
        try{
            $insert = $this->conexion->prepare("INSERT INTO pedidos_deshabilitados(ID_ADMINISTRADOR_BAJA,FECHA_BAJA) VALUES((SELECT ID_ADMINISTRADOR FROM ADMINISTRADORES WHERE NOMBRE = :nombre),now())");

            $insert->execute(array(
                "nombre" => $this->nombre
            ));
        }catch (PDOException $e){
            $insert->rollback();

        }
        $this->conexion = null;
    }

    public function habilitarPedidos(){
        try{
            $update = $this->conexion->prepare("UPDATE pedidos_deshabilitados SET ID_ADMINISTRADOR_ALTA = (SELECT ID_ADMINISTRADOR FROM ADMINISTRADORES WHERE NOMBRE = :nombre),FECHA_ALTA = now() WHERE ID_ADMINISTRADOR_ALTA is null;");
            $update->execute(array(
                "nombre" => $this->nombre
            ));
        }catch (PDOException $e){
            $update->rollback();

        }
        $this->conexion = null;
    }

    public function isPedidosHabilitado(){
        $select = $this->conexion->prepare("SELECT * FROM pedidos_deshabilitados where FECHA_ALTA IS NULL");

        $select->execute();

        if ($select->rowCount() == 0){
        //si rowcount 0, los pedidos estan habilitados
            return true;
        }
        else {
            //si rowcount !=0, los pedidos estan deshabilitados
            return false;
        }
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
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}
