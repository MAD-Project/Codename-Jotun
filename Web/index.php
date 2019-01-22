<?php
session_start();
    require_once __DIR__.'/twig/vendor/autoload.php';

    require_once __DIR__.'/config/globalConfig.php';

    if (isset($_GET['controller'])){

        $controllerObj = cargarControlador($_GET['controller']);

        lanzarAccion($controllerObj);
    }
    else {

        $controllerObj = cargarControlador(controladorDefecto);

        lanzarAccion($controllerObj);
    }

    function cargarControlador($controller){

        try {

            $strFileController='controller/'.$controller.'Controller.php';

            if (!@include_once $strFileController){

                throw new Exception('Error');
            }
            else {

                require_once $strFileController;
            }

            $nombreController = $controller.'Controller';
            $controllerObj = new $nombreController();

            return $controllerObj;
        }
        catch (Exception $e){
            header('Location: index.php');
        }

        return null;

    }

    function lanzarAccion($controllerObj){

        if (isset($_GET['action'])){

            $controllerObj->run($_GET['action']);
        }
        else {

            $controllerObj->run(accionDefecto);
        }
    }
