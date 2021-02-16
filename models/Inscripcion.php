<?php

class Inscripcion {
    
    //propiedades
    public $id=0, $idusuario=0, $idcurso=0, $fecha='';

    // ----------------------------------------------
    //recuperar todas las inscripciones
    // ----------------------------------------------  
    public static function get(int $id) : ? Inscripcion {
        $consulta = "SELECT * FROM inscripciones";
        return DB::select($consulta, self::class);
    }
    
    // ----------------------------------------------
    //recuperar un inscripcion por su id
    // ----------------------------------------------    
    public static function getInscripcion(int $id = 0) : ? Inscripcion {
        $consulta = "SELECT * FROM inscripciones WHERE id=$id";
        return DB::select($consulta, self::class);
    }
    
    // ----------------------------------------------    
    //recuperar el usuario al que pertenece la inscripcion por id
    // ----------------------------------------------    
    public static function getInscripcionByUsuario(int $id=0): array {
        $consulta = "SELECT * FROM inscripciones WHERE idusuario=$id";
        return DB::select($consulta, self::class);
    }
    
    // ----------------------------------------------    
    //recuperar el curso al que pertenece la inscripcion
    // ----------------------------------------------    
    
    
    public function getCurso(): ? Curso {
        $consulta = "SELECT * FROM cursos WHERE id=$this->idcurso";
        return DB::select($consulta, 'Curso');
    }
    
    // ----------------------------------------------    
    //nuevo inscripcion
    // ----------------------------------------------    
    public function guardar() {
        
        $consulta="INSERT INTO v_inscripciones_curso_usuario (idusuario, idcurso, fecha)
                    VALUES($this->idusuario, $this->idcurso, '$this->fecha')";
        return DB::insert($consulta);
    }
    
    // ----------------------------------------------    
    //borrar inscripcion
    // ----------------------------------------------    
    public static function borrar(int $id) {
        $consulta="DELETE FROM inscripciones WHERE id=$id";
        return DB::delete($consulta);
    }
    
    public static function comprobar(int $idusuario=0, int $idcurso=0):bool{
        $consulta = "SELECT * FROM inscripciones WHERE idusuario=$idusuario AND idcurso=$idcurso";
        return DB::select($consulta,'Inscripcion')? true : false;
    }
    
    
    //toString NO SE RECOMIENDA USARLO AQUI
    public function __toString() : string {
        return "$this->id: Usuario: $this->idusuario - Curso: $this->idcurso, fecha: '$this->fecha'";
    }
        
    
}