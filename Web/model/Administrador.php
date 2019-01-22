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
        $select = $this->conexion->prepare("SELECT NOMBRE FROM $this->table where USUARIO=:user AND PASSWORD=:password");
        $select->execute(array(
            "nombre" => $this->nombre,
            "correo" => $this->correo,
            "telefono" => $this->telefono
        ));
        $result = $select->fetchAll();

        return $result;
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
