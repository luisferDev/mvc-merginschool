<?php
session_start();

//carga de recursos
require_once 'config/config.php';
require_once 'libraries/autoload.php';

//invocar al controlador frontal
FrontController::main();