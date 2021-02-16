<?php

class ContactoController {
    
    //método por defecto de ContactoController
    public function index() {
        
        //carga la vista de contacto
        include 'views/contacto.php';
    }
    
    //método para enviar un mail
    public function send() {
        
        if(empty($_POST['enviar'])) {
            throw new Exception("No se recibió el formulario de contacto.");
        }
        //preparar el mail
        $to = CONTACT_EMAIL;
        $from = DB::escape($_POST['email']);
        $name = DB::escape($_POST['nombre']);
        $subject = DB::escape(empty($_POST['asunto']));
        $message = DB::escape($_POST['mensaje']);
        
        //enviar el mail
        $mail = new Email($to, $from, $name, $subject, $message);
        
        if(!$mail->enviar()) {
            throw new Exception('No se pudo enviar el email de contacto');
        }
        
        $mensaje = "Mensaje enviado, en breve recibirás una respuesta.";
        include 'views/exito.php';
    }

}