<?php

// controlador frontal
class FrontController {

    // método principal del controlador frontal
    public static function main() {
        try {
            
            //Inicializa el sistema de login
            //recupera el usuario identificado esde las variables de sesión
            Login::init();
            // -------------------------------
            // Gestión de peticiones
            // -------------------------------
            
            // recuperar controler de la petición
            $c = empty($_GET['c']) ? DEFAULT_CONTROLLER : ucfirst(DB::escape($_GET['c'])) . 'Controller';

            // recuperar el método de la petición
            $m = empty($_GET['m']) ? DEFAULT_METHOD : DB::escape($_GET['m']);

            // recuperar el parámetro de la petición
            $p = empty($_GET['p']) ? false : DB::escape($_GET['p']);

            // cargar el controlador correspondiente
            $controlador = new $c();

            // comprobar si existe el método
            if (! is_callable([$controlador, $m])) {
                throw new Exception("No existe la operación $m");
            }

            // Llama al método del controlador, pasando el parámetro
            $controlador->$m($p);

            // si se produce un error
        } catch (Throwable $e) {
            $mensaje = $e->getMessage(); // mensaje de error
            include 'views/error.php'; // carga vista error
        }
    }
}