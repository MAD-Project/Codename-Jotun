<?php

class indexController{

    public function render($view,$parameters){

        $loader = new Twig_Loader_Filesystem('view');
        $twig = new Twig_Environment($loader);
        echo $twig->render($view.'View.twig',$parameters);
    }

    public function run($accion){

        try {

            $this->$accion();
        }
        catch (Error $e){

            $this->index();
        }
    }

    public function index(){

        $this->render('index',array());
    }
}