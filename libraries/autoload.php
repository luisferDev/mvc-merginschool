<?php

function Load($clase) {
    global $classmap; //variable global
    foreach ($classmap as $directorio) {
        $ruta = "$directorio/$clase.php"; //calcula la ruta
        //echo $ruta.'<br/>';
        
        if(is_readable($ruta)) { // si es legible
            require_once $ruta; //carga la clase
            break; //detiene el bucle
        }
    }
}

spl_autoload_register('load');