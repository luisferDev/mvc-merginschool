<?php

class Usuario
{
    
    // propiedades
    public $id = 0, $usuario = '', $dni='', $clave = '', $nombre = '', $apellido1 = '',
    $apellido2 = '', $privilegio = 0, $administrador = 0,
    $email = '', $imagen = '', $created_at = '', $updated_at = '';
    
    // Método que usaremos para comprobar el login
    // Identificacion por email o usuario
    public static function identificar(string $u = '', string $p = ''): ?usuario {
        $consulta = "SELECT * FROM usuarios
                    WHERE (usuario='$u' OR email='$u') AND clave='$p'";
        
        return DB::select($consulta, self::class);
    }
    
    // -----------------------------
    //
    // MÉTODOS DEL CRUD
    //
    // -----------------------------
    
    // Insertar un nuevo usuario
    // ----------------------------------------------
    public function guardar(){
        $consulta = "INSERT INTO usuarios(usuario, dni, clave, nombre,
                    apellido1, apellido2, privilegio, administrador, email, imagen)
                    VALUES ('$this->usuario',
                            '$this->dni',
                            '$this->clave',
                            '$this->nombre',
                            '$this->apellido1',
                            '$this->apellido2',
                            $this->privilegio,
                            $this->administrador,
                            '$this->email',
                            '$this->imagen')";
                            
                            return DB::insert($consulta); //conectar y ejecutar
    }
    // ----------------------------------------------
    // recuperar todos los usuarios
    // ----------------------------------------------
    public static function get(): array
    {
        $consulta = "SELECT * FROM usuarios"; // preparar la consulta
        return DB::selectAll($consulta, self::class);
    }
    
    // ----------------------------------------------
    // recuperar un usuario concreto por id
    // ----------------------------------------------
    public static function getById(int $id): ?Usuario
    {
        $consulta = "SELECT * FROM usuarios WHERE id = $id"; // preparar la consulta
        return DB::select($consulta, self::class); // ejecutar y retornar el resultado
    }
    
    // ----------------------------------------------
    // filtro avanzado
    // ----------------------------------------------
    public static function getFiltered(string $c = 'user', string $v = '',
        string $o = 'id', string $s = 'ASC'): array
        {
            $consulta = "SELECT * FROM usuarios
                    WHERE $c like '%$v%'
                        ORDER BY $o $s";
            
            return DB::selectAll($consulta, self::class);
    }
    
    // ----------------------------------------------
    // actualizar un usuario
    // ----------------------------------------------
    public function actualizar()
    {
        $consulta = "UPDATE usuarios SET
                        usuario='$this->usuario',
                        dni='$this->dni',
                        clave='$this->clave',
                        nombre='$this->nombre',
                        apellido1='$this->apellido1',
                        apellido2='$this->apellido2',
                        privilegio= $this->privilegio,
                        administrador= $this->administrador,
                        email= '$this->email',
                        imagen='$this->imagen'
                    WHERE id=$this->id";
        return DB::update($consulta);
    }
    
    // ----------------------------------------------
    // borrar un usuario existente
    // ----------------------------------------------
    public static function borrar(int $id)
    {
        $consulta = "DELETE FROM usuarios WHERE id = $id"; // preparar la consulta
        return DB::delete($consulta);
    }
    
    
    // ----------------------------------------------
    // Imprime la string
    // ----------------------------------------------
    public function __toString(): string
    {
        return "$this->id $this->usuario  ($this->email) $this->nombre $this->apellido1";
    }
    
    
    // ----------------------------------------------
    // GET USER BY MAIL
    // ----------------------------------------------
    public static function getByUserMail(string $u, string $e) : ? Usuario {
        $consulta= "SELECT * FROM usuarios
                    WHERE usuario='$u' AND email='$e'";
        return DB::select($consulta, self::class);        
    }
    
    // ----------------------------------------------
    // GET USER BY INSCRIPCIONES
    // ----------------------------------------------
    public function getUserInscripciones():array {
        $consulta= "SELECT * FROM v_inscripciones_curso_usuario
                    WHERE idusuario=$this->id";
        return DB::selectAll($consulta,  'Inscripcion');
    }

}