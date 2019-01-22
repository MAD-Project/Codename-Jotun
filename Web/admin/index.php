<?php

require_once __DIR__.'/../config/globalConfig.php';

$_GET['controller'] = controladorAdmin;
$_GET['action'] = accionAdmin;

require_once __DIR__.'/../index.php';
