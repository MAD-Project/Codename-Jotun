<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once __DIR__.'/../config/globalConfig.php';

isset($_GET['controller'])?:$_GET['controller'] = controladorAdmin;
isset($_GET['action'])?:$_GET['action'] = accionAdmin;


require_once __DIR__.'/../index.php';
