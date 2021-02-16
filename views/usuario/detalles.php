<?php
(TEMPLATE)::htmlHead('Detalles');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner($usuario->administrador? "Eres Administador":"Eres Alumno");              
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENIDO -->
    	<section class="container st-content st-detalle">
    		<div class="row justify-content-md-start align-content-md-center">
    			
    			<!--MENSAJE -->
    			<div class="col-md-12"> 
    			<?=empty($GLOBALS['mensaje']) ? "" : "<h5><strong>". $GLOBALS['mensaje']."</strong></h5>"?>
    			</div>
    			
    			<!--IMAGEN -->
    			<div class="col-md-6">    			
    				<figure class="portada-detalles">
    					<?php
    					echo $usuario->imagen ? 
    					"<img class='user-cover-det' src='/$usuario->imagen' alt='$usuario->usuario'>":
    					"<img class='user-cover-det' src='/imagenes/usuarios/default.jpg' alt='$usuario->usuario'>";
    					?>
    				</figure>
    			</div>
			
			 <!-- FICHA -->
    			<div class="col-md-6 st-det-ficha">
			
					<h2>Tus datos <span class="h1"><?=$usuario->nombre?></span></h2>
				
    				<p><strong>Usuario:</strong><?=$usuario->usuario?></p>
    				<p><strong>DNI:</strong> <?=$usuario->dni?></p>
    				<p><strong>Nombre:</strong> <?=$usuario->nombre?></p>
    				<p><strong>Apellidos:</strong> <?="$usuario->apellido1 $usuario->apellido2"?></p>
    				<!-- <p><strong>Privilegio:</strong><?=$usuario->privilegio?></p> -->
					<p><strong>Email:</strong><?=$usuario->email?></p>
				</div>
				
				<!-- LISTADO INSCRIPCIONES ALUMNO-->
    			<div class="col-md-12 st-det-incripciones">
    				<?php if(!Login::isAdmin()) {?>
    				<h2>Tus inscripciones</h2>
        				<?php
        				if (is_array($inscripciones) && sizeof($inscripciones)>0) {
                            echo "<ul>";
                            // muestra cada uno de las inscripciones del usuario en una lista html
                            foreach ($inscripciones as $inscripcion)
                                echo "<li><strong>$inscripcion->curso</strong>, fecha $inscripcion->fecha <a href='/inscripcion/delete/$inscripcion->id'>Borrar</a></li>";
                    
                            echo "</ul>";
                            // si no hay inscripciones
                        } else
                            echo "<p>No se han encontrado inscripciones en nuestros cursos.</p>";
                        ?>
    				<?php }?>
				</div><!-- /. FIN LISTADO INSCRIPCIONES ALUMNO-->
				
				<!-- LISTADO INSCRIPCIONES ALUMNO-->
    			<div class="col-md-12 st-det-incripciones">
    				<?php if(Login::isAdmin()) {?>
    				<h2>Inscripciones de este usuario</h2>
        				<?php
        				if (is_array($inscripciones) && sizeof($inscripciones)>0) {
                            echo "<ul>";
                            // muestra cada uno de las inscripciones del usuario en una lista html
                            foreach ($inscripciones as $inscripcion)
                                echo "<li><strong>$inscripcion->curso</strong>, fecha $inscripcion->fecha <a href='/inscripcion/delete/$inscripcion->id'>Borrar</a></li>";
                    
                            echo "</ul>";
                            // si no hay inscripciones
                        } else
                            echo "<p>No se han encontrado inscripciones del alumno.</p>";
                        ?>
    				<?php }?>
				</div><!-- /. FIN LISTADO INSCRIPCIONES ALUMNO-->
				
				
				<!-- BTN REGISTRADOS NO LOGUEADOS -->
    			<?php if(!Login::get()) {?>
    				<div class="col-md-12 st-btn-form">
        				<div class="d-flex justify-content-md-center align-items-md-center">
        					<a href="/login/" class="btn-submit text-center">Accede a tu Escuela</a>
        				</div>
        			</div><!-- /. FIN BTN NOT LOGIN -->
    			<?php }?>
    			
    			
				<!-- LINKS CALL TO ACTION -->
    			<div class="col-md-12 st-inner-links">
    				<?php if(Login::get()) {?>				
        				<a href="/usuario/edit/<?=$usuario->id?>">Editar usuario</a>
    				<?php }?>    				
    				<?php if(Login::isAdmin()) {?>
        				<a href="/usuario/delete/<?=$usuario->id?>">Borrar usuario </a>				
        				<a href="/usuario/list">Lista de usuarios</a>
    				<?php }?>
				</div><!-- /. FIN LINKS CALL TO ACTION -->
			</div>
		</section>

        <!-- FOOTER -->
    	<?php
            (TEMPLATE)::footer();
        ?>
        
	</div><!-- /. FIN MAIN CONTAINER -->


    <!----------------------------------
            Scripts
    ----------------------------------->
    <?php
    (TEMPLATE)::htmlScripts();
     ?>

</body>
</html>