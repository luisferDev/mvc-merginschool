<?php

/** Clase Upload
 */

class Upload {
    
    //Médotdo para comprobar fichero
    public static function llegaFichero(string $index='fichero') {
        return !empty($_FILES[$index]) && $_FILES[$index]['error']!=4;
    }
    
    //Método nombres únicos ficheros
    public static function nombreUnico(string $ext='', string $pre=''):string {
        $nombre = uniqid($pre);
        
        //nuevo nombre con la extensión(si se indicó)
        return $ext ? "$nombre.$ext" : $nombre;
    }
    
    public static function procesar (
        array $file, string $folder, bool $unique=true, int $max=0, string $mime='.'):string {
        
            if($e = $file['error']) {
                throw new Exception("Error en la subida del fichero con código $e");
            }
            
            if($max && $file['size']>$max) {
                throw new Exception("El fichero supera los $max bytes");
            }
            
            $rutaTmp = $file['tmp_name']; //ruta temporal
            
            //Comprobación del tipo de fichero
            //recupera el tipo mime
            $tipo = (new finfo(FILEINFO_MIME_TYPE))->file($rutaTmp);
            
            //anti fallo la expresión regular con la comprobación
            $mimetmp = str_replace('*','',$mime); 
            $mimetmp = preg_quote($mimetmp,'/'); 
            
            if(!preg_match("/^$mimetmp/i",$tipo)) {
                throw new Exception("El fichero no es de tipo $mime");
            }
            
            //calcular ruta final
            $ruta = $unique ?
                $ruta = $folder."/".self::nombreUnico(pathinfo($file['name'], PATHINFO_EXTENSION)):
                $ruta = $folder."/".$file['name'];
            
            //mover el fichero a destino
            if(!move_uploaded_file($rutaTmp, $ruta)) {
                throw new Exception("Error al mover de $rutaTmp a $ruta");
            }
                
                return $ruta;
    
    }
}