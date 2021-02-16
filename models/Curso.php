<?php

class Curso {
    
    //propiedades
    public $id=0, $codigo='', $nombre='', $descripcion='',
    $inicio='', $fin='', $imagen='';

    // -----------------------------
    //
    //   MÉTODOS DEL CRUD
    //
    // -----------------------------
    //recuperar todos los cursos
    public static function get(): array {
        $consulta = "SELECT * FROM cursos"; //preparar la consulta
        return DB::selectAll($consulta, self::class);
    }
    
    // ----------------------------------------------
    //recuperar un curso concreto por id
    // ----------------------------------------------
    public static function getCurso(int $id):?Curso {
        $consulta = "SELECT * FROM cursos 
                    WHERE id = $id"; //preparar la consulta
        return DB::select($consulta, self::class);//ejecutar y retornar el resultado
    }
    
    // ----------------------------------------------
    //Insertar un nuevo curso
    // ----------------------------------------------
    public function guardar() {
        $consulta="INSERT INTO cursos(codigo,nombre,descripcion, 
                                inicio, fin, imagen)
                    VALUES('$this->codigo',
                           '$this->nombre',
                           '$this->descripcion',
                           '$this->inicio',
                           '$this->fin',
                           '$this->imagen')";
        return DB::insert($consulta);
    }
    
    // ----------------------------------------------
    //borrar un curso por ID
    // ----------------------------------------------
    public static function borrar(int $id) {
        $consulta = "DELETE FROM cursos WHERE id = $id";//preparar la consulta
        return DB::delete($consulta);
    }
    
    // ----------------------------------------------
    //actualizar un curso
    // ----------------------------------------------
    public function actualizar() {
        $consulta = "UPDATE cursos SET
                        codigo='$this->codigo',
                        nombre='$this->nombre',  
                        descripcion='$this->descripcion',
                        inicio='$this->inicio',
                        fin='$this->fin', 
                        imagen='$this->imagen'
                    WHERE id=$this->id";
        //echo $consulta;
        return DB::update($consulta);
    }
    
    
    // -----------------------------
    //
    //   FILTRADOS
    //
    // ----------------------------------------------
    // filtro por el título
    // ----------------------------------------------
    public static function getCursosPorNombre(string $nombre=''):array {
        $consulta= "SELECT * FROM cursos 
                    WHERE nombre like '%$nombre%'";
        
        return DB::selectAll($consulta, self::class);
    }
        
    
    // ----------------------------------------------
    // filtro avanzado
    // ----------------------------------------------
    public static function getFiltered(string $campo='', string $valor='',
        string $orden='id', string $sentido='ASC'):array {
        
            $consulta= "SELECT * FROM cursos
                        WHERE $campo like '%$valor%'
                        ORDER BY $orden $sentido";
        
        return DB::selectAll($consulta, self::class);
    }
    
    // ----------------------------------------------
    // Método objeto que recupera inscripciones de un alumno
    // ----------------------------------------------
    //public static function getInscripciones(int $idcurso):array{
        //$consulta = "SELECT * FROM v_inscripciones_curso_usuario
                    //WHERE idcurso=$this->id";
        //return DB::selectAll($consulta, 'Inscripcion');
        
    //}
    
    public function getCursoInscripciones():array{
        $consulta = "SELECT * FROM v_inscripciones
                    WHERE idcurso=$this->id";
        return DB::selectAll($consulta, 'Inscripcion');
        
    }
    
    
    // ----------------------------------------------
    //Imprime la string
    // ----------------------------------------------
    public function __toString():string {
        return "$this->id Este curso: $this->codigo $this->nombre, iniciará el
                $this->inicio, y finaliza el $this->fin";
    }
           
}