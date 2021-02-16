<?php

class CursoController {
    
    //operación por defecto
    public function index() {
        $this->list(); // redirige a la lista de los cursos
    }
    
    //operación para listar todos los cursos
    public function list() {
        //recuperar la lista de cursos
        $cursos = Curso::get();
        
        include 'views/curso/lista.php';
    }
    
    //método para mostrar los detalles de un curso
    public function show(int $id) {
        
        //comprobar que recibimos el id del curso por parámetro
        if(!$id) {
            throw new Exception("No se indicó el curso.");
        }
        // recuperar el curso con dicho código
        $curso = Curso::getCurso($id);
        
        //comprobar que el curso se haya recuperado correctamente en la BDD
        if(!$curso) {
            throw new Exception("No se ha encontrado el curso $id");
        }
        
        //recuperar los inscripciones del curso
        $inscripciones = $curso->getCursoInscripciones();

        if(Login::get())
            $inscrito = Inscripcion::comprobar(Login::get()->id, $id);
        else 
            $inscrito = false;
        
        include 'views/curso/detalles.php';
    }
    
    // --------------------------------------------
    // CREATE paso 1
    // --------------------------------------------
    public function create() {
        
        //solamente el admin o privilegios de 500
        if(! (Login::isAdmin())) {
            throw new Exception("No tienes permiso para hacer esto");
        }
        
        include 'views/curso/nuevo.php';
    }
    
    // --------------------------------------------
    // STORE paso 2
    // --------------------------------------------
    public function store() {
        
        //sólo el admin podrá
        if(!Login::isAdmin()) {
            throw new Exception("No tienes permiso para hacer esta acción");
        }
        
        //comprueba que el form con los datos
        if(empty($_POST['guardar'])) {
            throw new  Exception("No se recibieron los datos");
        }
        
        $curso = new Curso(); //crea el nuevo curso con datos Post
        
        //recupera los datos del formulario que llegan del post
        $curso->codigo=DB::escape($_POST['codigo']);
        $curso->nombre=DB::escape($_POST['nombre']);
        $curso->descripcion=DB::escape($_POST['descripcion']);
        $curso->inicio=DB::escape($_POST['inicio']);
        $curso->fin=DB::escape($_POST['fin']);
        
        //tratamiento del fichero imagen
        // -------------------------------------
        if(Upload::llegaFichero('imagen')) {
            $curso->imagen = Upload::procesar(
                $_FILES['imagen'], 'imagenes/cursos', true, 0, 'image/*');
        }
        
        if(!$curso->guardar()) { //guarda el curso en la BDD
            //si no se pudo guardar
            @unlink($curso->imagen);//borra la imagen recién subida
            throw new Exception("No se pudo guardar $curso->nombre");
        }
        
        $mensaje="Guardado del curso $curso->nombre correcto.";
        include 'views/exito.php'; // muestra la vista éxito
    }
        
    // --------------------------------------------
    // EDIT
    // --------------------------------------------
    public function edit(int $id=0) {
        
        //sólo el admin podrá
        if(!Login::isAdmin()) {
            throw new Exception("No tienes permiso para hacer esta acción");
        }
        
        //comprueba que llega el id del curso a editar
        if(!$id) {
            throw new Exception("No se indicó el curso.");
        }
        
        //recupera el curso con ese id
        $curso = Curso::getCurso($id);
        
        //comprueba que el curso se pudo recuperar de la BDD
        if(!$curso){
            throw new Exception("No existe el curso $id.");
        }
        
        // muestra la vista actualizar
        include 'views/curso/actualizar.php';
    }
    
    // --------------------------------------------
    // UPDATE
    // --------------------------------------------
    public function update() {
        
        //comprobar que la petición venga del formulario
        if(empty($_POST['actualizar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        //sólo el admin podrá
        if(!Login::isAdmin()) {
            throw new Exception("No tienes permiso para hacer esta acción");
        }
        
        //recuperar el curso de la Bddd
        $curso = Curso::getCurso(intval($_POST['id']));
        
        if(!$curso) {
            throw new Exception('No existe el curso.');
        }
        
        //recuperar los nuevos valores
        $curso->codigo=DB::escape($_POST['codigo']);
        $curso->nombre=DB::escape($_POST['nombre']);
        $curso->descripcion=DB::escape($_POST['descripcion']);
        $curso->inicio=DB::escape($_POST['inicio']);
        $curso->fin=DB::escape($_POST['fin']);
        
        //mirar si nos piden eliminar la imagen actual
        if(!empty($_POST['eliminarimagen'])) {
            
            //recuerda la imagen antigua para borrarla si se actuaaliza bien la imagen
            $imagenABorrar= $curso->imagen;
            
            //quitamos la imagen de los datos del curso
            $curso->imagen = '';
        }
        
        //mirar si nos envían una imagen nueva
        if(Upload::llegaFichero('imagen')) {
            $imagenASustituir = $curso->imagen;
            
            $curso->imagen=Upload::procesar(
                $_FILES['imagen'], 'imagenes/cursos', true, 0, 'image/*');
        }
        
        //actualizar el curso en la BDD
        if($curso->actualizar()===false) {
            //si falla la actualizacion
            @unlink($curso->imagen);//borra la imagen recien subida
            
            throw new Exception("No se pudo actualizar $curso->nombre");
        }
        
        //borra las imanges que no hacen falta
        @unlink($imagenABorrar);
        @unlink($imagenASustituir);
        
        //prepara un mensaje
        $GLOBALS['mensaje'] = "<h5>Actualización del curso $curso->nombre correcta.</h5>";
        
        $this->edit($curso->id);
    }
    
    
    // --------------------------------------------
    // DELETE | paso 1
    // --------------------------------------------
    public function delete(int $id=0) {
        
        //sólo el admin podrá
        if(!Login::isAdmin()) {
            throw new Exception("No tienes permiso para hacer esta acción");
        }
        
        // mirar si llega el id del curso por GET
        if(!$id) {
            throw new Exception("No se indicó el curso a borrar.");
        }
        
        // recuperar el curso de la BDD
        $curso = Curso::getCurso($id);
        
        //comprobar si existe el curso indicado
        if (!$curso) { // mirar si existe el curso
            throw new Exception("No existe el curso $id.");
        }
        
        include 'views/curso/borrar.php';//carga la confirmación de borrado
        
    }
    
    
    // --------------------------------------------
    // DELETE | paso 2
    // --------------------------------------------
    public function destroy() {
        
        //sólo el admin podrá
        if(!Login::isAdmin()) {
            throw new Exception("No tienes permiso para hacer esta acción");
        }
        
        //comprueba que llegue el form de confirmación
        if(empty($_POST['borrar'])) {
            throw new Exception("No se recibió información");
        }
        
        //recupera el identificado via POST
        $id = intval($_POST['id']);
        
        //para poder borrar la imagen
        if(!$curso = Curso::getCurso($id)) {
            throw new Exception("No existe el curso indicado");
        }
        
        //intenta borrar el curso de la bdd
        if(Curso::borrar($id)===false) {
            throw new Exception("No se pudo borrar");
        }
        
        @unlink($curso->imagen); // borra la img del servidor
        
        //muestra vista de éxito
        $mensaje = "Borrado del curso $id correcto.";
        include 'views/exito.php';
    }
    
    // --------------------------------------------
    // BUSCAR
    // --------------------------------------------
    public function buscar() {
        
        
        //tomar valores con el filtro
        $campo = empty($_POST['campo'])? 'nombre' : $_POST['campo'];
        $valor = empty($_POST['valor'])? '' : DB::escape($_POST['valor']);
        $orden = empty($_POST['orden'])? 'id' : $_POST['orden'];
        $sentido = empty($_POST['sentido'])? 'ASC' : $_POST['sentido'];
        
        //recuperar la lista de cursos
        $cursos = Curso::getFiltered($campo, $valor, $orden, $sentido);
        
        //Carga la vista para mostrar la lista
        require_once 'views/curso/lista.php';
    }
    
    
    
    
    //TODO resto de métodos de la clase
}
