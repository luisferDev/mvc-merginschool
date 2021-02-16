<?php
(TEMPLATE)::htmlHead('Detalles');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Detalles del Curso');              
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENIDO -->
    	<section class="container st-content st-detalle">
    		<div class="row justify-content-md-start align-content-md-center">
    			
    			<!--IMAGEN -->
    			<div class="col-md-6">    			
    				<figure class="portada-detalles">
    					<?php
    					echo $curso->imagen ? 
    					"<img src='/$curso->imagen' alt='$curso->nombre'>":
    					"<img src='/imagenes/cursos/default.jpg' alt='$curso->nombre'>";
    					?>
    				</figure>
    			</div>
    			
    			<!-- FICHA -->
    			<div class="col-md-6 st-det-ficha">
    			
    				<h2><?=$curso->nombre?></h2>
    				
    				<p><strong>Código:</strong><?=$curso->codigo?></p>
    				<p><strong>Nombre:</strong><?=$curso->nombre?></p>
    				<p><strong>Descripción:</strong><?=$curso->descripcion?></p>
    				<p><strong>Inicio:</strong><?=$curso->inicio?></p>
    				<p><strong>Fin:</strong><?=$curso->fin?></p>    				
    			</div>
    			
    			<!-- LISTADO INSCRIPCIONES -->
    			<div class="col-md-12 st-det-incripciones">
    				<?php if(Login::isAdmin()) {?>                
                    <h2>Inscripciones actuales</h2>
        				<?php
        				if (is_array($inscripciones) && sizeof($inscripciones)>0) {
                            echo "<ul>";
                            // muestra cada uno de las inscripciones del usuario en una lista html
                            foreach ($inscripciones as $inscripcion)
                                echo "<li>El usuario: <strong>$inscripcion->idusuario</strong>, fecha $inscripcion->fecha <a href='/inscripcion/delete/$inscripcion->id'>Borrar</a></li>";
                    
                            echo "</ul>";
                            // si no hay inscripciones
                        } else
                            echo "<p>No se han encontrado inscripciones de este usuario.</p>";
                        ?>
    				<?php }?>
    			</div>
    			
    			<!-- LINKS CALL TO ACTION -->
    			<div class="col-md-12 d-flex st-btn-form justify-content-md-center">
    				<?php 
    				if(Login::get() && !Login::isAdmin() && !$inscrito) {
    				echo "<a class='btn-submit' href='/inscripcion/store/$curso->id'>INSCRIBIRME</a>";
    				} 
    				
    				if($inscrito)
    				    echo "<h5>Ya te has inscrito a este curso previamente</h5>";
    				?>
    			</div>
    			<div class="col-md-12 st-inner-links">
        			<?php if(Login::isAdmin()) {?>
        				<a href="/curso/edit/<?=$curso->id?>">Editar curso</a>
        				<a href="/curso/delete/<?=$curso->id?>">Borrar curso </a>
    				<?php }?> 				
    				
    					<a href="/curso/list">Volver a la lista de cursos</a>
    					
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