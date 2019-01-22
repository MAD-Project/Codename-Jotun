<?php

class indexController{

    public function render($view,$parameters){

        $loader = new Twig_Loader_Filesystem(__DIR__.'/../view');
        $twig = new Twig_Environment($loader);
        echo $twig->render($view.'View.twig',$parameters);
    }

    public function run($accion){
        try {
            $this->$accion();
        }
        catch (Error $e){
            die($e->getMessage());
            $this->index();
        }
    }

}