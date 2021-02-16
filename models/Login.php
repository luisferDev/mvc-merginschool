<?php

class Login {
    //propiedades
    private static $identificado = NULL;
    
    //------------------------------------------------
    //
    //      MÉTODOS requeridos
    //    
    //------------------------------------------------
    
    
    // Recupera el usuario identificado
    // desde la variable de sesión
    // será usado desde el FrontController
    //------------------------------------------------
    public static function init() {
        if(!empty($_SESSION['usuario'])) {
            self::$identificado = unserialize($_SESSION['usuario']);
        }
    }
    
    //------------------------------------------------
    // Establece el usuario identificado
    // será usado desde el LoginController, login()
    //------------------------------------------------
    public static function set(Usuario $u) {
        self::$identificado = $u;
        $_SESSION['usuario'] = serialize($u);
    }
    
    //------------------------------------------------
    // Elimina el usuario identificado
    // será usado desde el LoginController, logout()
    //------------------------------------------------
    public static function clear() {
        self::$identificado = NULL;
        unset($_SESSION['usuario']);
    }
    
    
    //------------------------------------------------
    //
    //      MÉTODOS útiles
    //
    //------------------------------------------------
    
    //------------------------------------------------
    // Recupera el usuario identificado (o Null si no hay)
    //------------------------------------------------
    public static function get() : ? Usuario {
        return self::$identificado;
    }
    
    //------------------------------------------------
    // Retorna si el usuario identificado es ADMIN
    //------------------------------------------------
    public static function isAdmin() : bool {
        return self::$identificado && self::$identificado->administrador;
    }
    
    //------------------------------------------------
    // Retorna si el usuario identificado tiene un nivel
    // de privilegio determinado o más
    //------------------------------------------------
    public static function hasPrivilege(int $p) : bool {
        return self::$identificado && self::$identificado->privilegio >= $p;
    }
    
    
}

