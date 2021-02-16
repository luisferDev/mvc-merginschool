<?php

class UsuarioController{
    
    //default
    public function index() {
        $this->list(); // listado de usuarios
        
    }
    
    // --------------------------------------------
    // LISTA
    // --------------------------------------------
    public function list(){
        
        //solamente el admin puede listar usuarios
        if(!Login::isAdmin()) {
            throw new Exception("No tienes permiso para hacer esto");
        }
        
        $usuarios = Usuario::get();
        include 'views/usuario/lista.php';
    }
    
    // --------------------------------------------
    // DETALLES
    // --------------------------------------------
    public function show(int $id=0) {
        
        //o bien el ADMIN o bien el usuario de estos mismos datos
        if(!(Login::isAdmin() || Login::get()->id==$id)) {
            throw new Exception("No tienes los permisos necesarios.");
        }
        
        //comprobar que recibimos el id del usuario por parámetro
        if(!$usuario = Usuario::getById($id)) {
            throw new Exception("No se pudo recuperar el usuario.");
        }
        $inscripciones= $usuario->getUserInscripciones();
        
        include 'views/usuario/detalles.php';
    }
    
    // --------------------------------------------
    // CREATE
    // --------------------------------------------
    public function create() {
        include 'views/usuario/nuevo.php';
    }
    
    // --------------------------------------------
    // STORE
    // --------------------------------------------
    public function store() {
        
        //comprueba que el form con los datos
        if(empty($_POST['guardar'])) {
            throw new  Exception("No se recibieron los datos");
        }
        
        $usuario = new Usuario(); //crea el nuevo usuario con datos Post
        
        //recupera los datos del formulario que llegan del post
        $usuario->usuario=DB::escape($_POST['usuario']);
        $usuario->dni=DB::escape($_POST['dni']);
        $usuario->clave= md5($_POST['clave']);
        $usuario->nombre=DB::escape($_POST['nombre']);
        $usuario->apellido1=DB::escape($_POST['apellido1']);
        $usuario->apellido2=DB::escape($_POST['apellido2']);
        $usuario->privilegio = empty($_POST['privilegio']) ? 0 : 1;
        $usuario->administrador=empty($_POST['administrador'])? 0 : 2;
        $usuario->email=DB::escape($_POST['email']);
        
        
        
        //tratamiento del fichero imagen
        // -------------------------------------
        if(Upload::llegaFichero('imagen')) {
            $usuario->imagen = Upload::procesar(
                $_FILES['imagen'], 'imagenes/usuarios', true, 0, 'image/*');
            
        }
        
        if(!$usuario->guardar()) { //guarda el usuario en la BDD
            //si no se pudo guardar
            @unlink($usuario->imagen);//borra la imagen recién subida
            throw new Exception("No se pudo guardar $usuario->usuario");
        }
        
        //estas son las inscripciones del usuario        
        $inscripciones= $usuario->getUserInscripciones();
        $mensaje="Guardado del usuario $usuario->usuario correcto.";
        include 'views/usuario/detalles.php'; // muestra la vista éxito
    }
    
    // --------------------------------------------
    // EDIT
    // --------------------------------------------
    public function edit(int $id=0) {
        
        if(!(Login::isAdmin() || Login::get()->id== $id)) {
            throw new Exception("No tienes permiso para hacer esta acción");
        }
            
        //comprueba que llega el id del usuario a editar
        if(!$usuario = Usuario::getById($id)) {
            throw new Exception("No se indicó el usuario.");
        }
        
        // muestra la vista actualizar
        include 'views/usuario/actualizar.php';
    }
    
    // --------------------------------------------
    // UPDATE
    // --------------------------------------------
    public function update() {
        
        $id = intval($_POST['id']);// necesitamos el id para el update
        
        //comprobar que la petición venga del formulario
        if(empty($_POST['actualizar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        //comprobar que existe el usuario
        if(!$usuario = Usuario::getById($id)) {
            throw new Exception("No existe el usuario $id.");
        }
        
        //recuperar los nuevos valores
        $usuario->usuario=DB::escape($_POST['usuario']);
        $usuario->dni=DB::escape($_POST['dni']);
        $usuario->clave= md5($_POST['clave']);
        $usuario->nombre=DB::escape($_POST['nombre']);
        $usuario->apellido1=DB::escape($_POST['apellido1']);
        $usuario->apellido2=DB::escape($_POST['apellido2']);
        $usuario->privilegio = empty($_POST['privilegio'])? 0 : 1;
        $usuario->administrador=empty($_POST['administrador'])? 0 : 2;
        $usuario->email=DB::escape($_POST['email']);
        
        
        $id = $_POST['id'];
        
        //la clave solamente cambia si se indica una nueva
        if(!empty($_POST['clave'])) {
            $usuario->clave = md5($_POST['clave']);
        }
        
        //mirar si nos piden eliminar la imagen actual
        if(!empty($_POST['eliminarimagen'])) {
            
            //recuerda la imagen antigua para borrarla si se actuaaliza bien la imagen
            $imagenABorrar= $usuario->imagen;
            
            //quitamos la imagen de los datos del usuario
            $usuario->imagen = '';
        }
        
        //mirar si nos envían una imagen nueva
        if(Upload::llegaFichero('imagen')) {
            $imagenASustituir = $usuario->imagen;
            
            $usuario->imagen=Upload::procesar(
                $_FILES['imagen'], 'imagenes/usuarios', true, 0, 'image/*');
        }
        
        //actualizar el usuario en la BDD
        if($usuario->actualizar()===false) {
            //si falla la actualizacion
            @unlink($usuario->imagen);//borra la imagen recien subida
            
            throw new Exception("No se pudo actualizar $usuario->usuario");
        }
        
        //borra las imagenes que no hacen falta
        @unlink($imagenABorrar);
        @unlink($imagenASustituir);
        
        //prepara un mensaje
        $GLOBALS['mensaje'] = "<h5>Actualización del usuario $usuario->usuario correcta.</h5>";
        
        $this->edit($usuario->id);
    }
    
    
    // --------------------------------------------
    // DELETE
    // --------------------------------------------
    public function delete(int $id=0) {
        
        //o bien el ADMIN o bien el usuario de estos mismos datos
        if(!(Login::isAdmin() || Login::get()->id==$id)) {
            throw new Exception("No tienes los permisos necesarios.");
        }
        
        // mirar si llega el id del usuario por GET
        if(!$usuario = Usuario::getById($id)) {
            throw new Exception("No existe el usuario $id.");
        }
        
        include 'views/usuario/borrar.php';//carga la confirmación de borrado
        
    }
    
    
    // --------------------------------------------
    // DESTROY
    // --------------------------------------------
    public function destroy() {
        
        //o bien el ADMIN o bien el usuario de estos mismos datos
        if(!(Login::isAdmin() || Login::get()->id==$id)) {
            throw new Exception("No tienes los permisos necesarios.");
        }
        //comprueba que llegue el form de confirmación
        if(empty($_POST['borrar'])) {
            throw new Exception("No se recibió información");
        }
        
        //recupera el identificado via POST
        $id = empty($_POST['id']) ? 0 : intval($_POST['id']);
        
        //para poder borrar el usuario del BDD
        if(!$usuario = Usuario::getById($id)) {
            throw new Exception("No existe el usuario indicado");
        }
        
        //intenta borrar el usuario de la bdd
        if(!Usuario::borrar($id)) {
            throw new Exception("No se pudo dar de baja el usuario $id.");
        }
        
        @unlink($usuario->imagen); // borra la img del servidor
        
        //muestra vista de éxito
        $mensaje = "El usuario ha sido dado de baja correctamente.";
        include 'views/exito.php';
    }
    
    // --------------------------------------------
    // BUSCAR
    // --------------------------------------------
    public function buscar() {
        
        //tomar valores con el filtro
        $c = empty($_POST['campo'])? 'dni' : $_POST['campo'];
        $v = empty($_POST['valor'])? '' : DB::escape($_POST['valor']);
        $o = empty($_POST['orden'])? 'id' : $_POST['orden'];
        $s = empty($_POST['sentido'])? 'ASC' : $_POST['sentido'];
        
        //recuperar la lista de socios
        $usuarios = Usuario::getFiltered($c, $v, $o, $s);
        
        //Carga la vista para mostrar la lista
        require_once 'views/usuario/lista.php';
    }
}