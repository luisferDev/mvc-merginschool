<?php
    
    class InscripcionController {
        
        // --------------------------------------------
        // CREATE
        // --------------------------------------------
        public function create(int $idcurso=0) {
            
            if(!Login::get())
                throw new Exception("Debes estar identificado");
            
            //recupera el curso
            $curso = Curso::getCurso($idcurso);
            
            //si no hay filtro
            if(!$curso) {
                throw new Exception("No se encontró el curso");
            }            
            
            (new CursoController())->show(Login::get()->id);
            //include 'views/inscripcion/nuevo.php';
        }
        
        // --------------------------------------------
        // STORE
        // --------------------------------------------
        //guarda la nueva inscripción
        public function store(int $idcurso){
            if(!Login::get()) {
                throw new Exception("Debes estar identificado");
            }
                
            
            //alumno
            if(Login::isAdmin(0)) {
                throw new Exception("Debes ser un alumno para preinscribirte.");
            }
                 
            
            if(!Inscripcion::comprobar(Login::get()->id, $idcurso)){
                
                $inscripcion = new Inscripcion(); //crea una inscripcion con datos Post
                //recupera los datosque llegan del post
                $inscripcion->idusuario= Login::get()->id;
                $inscripcion->idcurso= $idcurso;
                $inscripcion->fecha= date('Y-m-d');
                
                if (!$inscripcion->guardar()) {
                    throw new Exception('No hemos podido apuntarte al curso');
                }
                            
                $GLOBALS['mensaje']= "<h5>Te has inscrito correctamente en el curso.</h5>";
            }
            //recupero id del usuario            
            $inscripciones = Login::get()->getUserInscripciones();
            //mensaje            
            (new UsuarioController())->show(Login::get()->id);
        }
        
        
        // --------------------------------------------
        // DELETE
        // --------------------------------------------
        //muestra el formulario de confirmación de eliminación
        public function delete(int $id = 0) {
            
            $inscripcion= Inscripcion::getInscripcion($id);
            
            //recupero el formulario para mostrar info
            if(!$inscripcion = Inscripcion::get($id)) {
                throw new Exception("No se encontró la inscripción $id.");
            }
            
            //recupero el id del User para poder mostrar info
            $usuario= Usuario::getByID($inscripcion->idusuario);
            
            //recupero información del curso y declaro idcurso
            $curso= Curso::getCurso($inscripcion->idcurso);
            
            include 'views/inscripcion/borrar.php';
        }
        
        // --------------------------------------------
        // DESTROY
        // --------------------------------------------
        //eliminar la inscripcion
        public function destroy() {          
            
            //cualquiera logueado
            if(!(Login::isAdmin() || Login::get()->id)) {
                throw new Exception("Debes estar identificado");
            }
            
            //comprueba que llegue el formulario de confirmación
            if(empty($_POST['borrar'])) {
                throw new Exception("No se recibió confirmación");
            }
            
            $id = intval($_POST['id']); //recupera el identificador via post
                        
            //recupero la inscripción para poder mostrar info
            if(!$inscripcion = Inscripcion::get($id)) {
                throw new Exception("No se encontró la inscripción $id.");
            }
            
            //intenta borrar la inscripción de la BDD
            if(Inscripcion::borrar($id)===false) {
                throw new Exception("No se pudo borrar");
            }
            
            //prepara un mensaje
            $GLOBALS['mensaje']= "<h5>Te has borrado correctamente del curso</h5>";
            
            //redireccionar UserioController::show($id);
            (new UsuarioController())->show(Login::get()->id);
        }
        
        //TODO resto de métodos de la clase
        
    }
    