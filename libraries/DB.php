<?php

class DB {
    
    //propiedades
    private static $conexion=null;
    
    // ----------------------
    //MÉTODOS
    // ----------------------
    
    //Método que conecta/recupera la conexión con la BDD
    public static function get():mysqli{
        if(!self::$conexion){ //si no estabamos conectados
            //conecta la BDD
            self::$conexion= @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if(self::$conexion->connect_errno) {// si se produce un error
                throw new Exception('Error al conectar con la BDD');
            }
            self::$conexion->set_charset(DB_CHARSET); //charset
               
        }
        return self::$conexion;//retorna la conexión
    }
    
    //Método consultas SELECT una fila
    public static function select(string $consulta, string $class='stdClass') {
        $resultado = self::get()->query($consulta);
        $objeto = $resultado->fetch_object($class);
        $resultado->free();
        return $objeto;
    }
    
    //Método consultas SELECT múltiples filas
    public static function selectAll(string $consulta, string $class='stdClass'): array {
        $resultados = self::get()->query($consulta);
        $objetos = [];
        
        while($r = $resultados->fetch_object($class)) {
            $objetos[]=$r;
        }
        
        $resultados->free();
        return $objetos;
        
    }
    
    //Método consultas INSERT    
    public static function insert($consulta) {
        return self::get()->query($consulta)? self::get()->insert_id : false;
    }
    
    //Método consultas UPDATE
    public static function update($consulta) {
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
    
    //Método consultas DELETE
    public static function delete($consulta) {
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
    
    /**
     * 
     * 
     * Método para escape caracteres especiales
     * 
     * 
     */
    public static function escape(string $texto, bool $entities = true) {
        //escapa texto de entrada con el método de mysqli
        $texto = self::get()->real_escape_string($texto);
        
        //retorna el texto con los carácteres especiales convertidos en entidad
        return $entities? htmlspecialchars($texto) : $texto;
    }
}