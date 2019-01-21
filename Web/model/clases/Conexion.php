<?php

class Conexion{
    private $driver;
    private $host,$user,$pass,$database;

    public function __construct(){
        require_once 'config/dbConfig.php';
        $this->driver=dbDriver;
        $this->host=dbHost;
        $this->user=dbUser;
        $this->pass=dbPass;
        $this->database=dbDatabase;
    }

    public function conexion(){
        $bbdd = $this->driver.':host='.$this->host.';dbname='.$this->database;

        try{
            $connection = new PDO($bbdd,$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }
        catch (PDOException $e){
            throw new Exception('Problemas al establecer la conexión.');
        }
    }

}