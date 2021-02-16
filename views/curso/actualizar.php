<?php
(TEMPLATE)::htmlHead('Actualizar');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Actualizar el Curso');              
            (TEMPLATE)::login();
        ?>


        <!-- CONTENIDO -->
    	<section class="container st-content st-detalle">
    		<div class="row justify-content-md-start align-content-md-center">
    			
    			<!--MENSAJE -->
    			<div class="col-md-12"> 
    			<?=empty($GLOBALS['mensaje']) ? "" : "<h5><strong>". $GLOBALS['mensaje']."</strong></h5>"?>
    			</div>
    			
    			<div class="col-md-12">
    				<!-- FORM -->
    				<form method="post" action="/curso/update" enctype="multipart/form-data">
    				
        				<div class="row d-flex justify-content-md-center align-items-md-start">
        				   
        				    <!--IMAGEN -->
                			<div class="col-md-6">    			
                				<figure class="portada-curso">
                					<?php
                					if($curso->imagen){
                					    echo "<img src='/$curso->imagen' alt='$curso->nombre'>";
                					    echo "<input type='checkbox' name='eliminarimagen' value='1'>";
                					    echo "<label>Eliminar la imagen</label>";
                					} else {
                					    echo "<img class='lib-cover-det' src='/imagenes/cursos/default.jpg' alt='$curso->nombre'>";
                					}
                					?>
                				</figure>            				
                				<label>Nueva portada de presentación:</label>
                				<input type="file" name="imagen"><span>(no indicar si no se dese cambiar)</span><br/>
                			</div>
                			
                			<!--FICHA -->
            				<div class="col-md-6 st-det-ficha">
            				    <!-- TITLE -->
            					<h2><?=$curso->nombre?></h2>
            					
                				<input type="hidden" name="id" value="<?=$curso->id?>">
                				
            					<label>Código</label>
            					<input type="text" name="codigo" value="<?=$curso->codigo?>">
            					
            					<label>Nombre del Curso</label>
            					<input type="text" name="nombre" value="<?=$curso->nombre?>">
            					    					
            					<label>Descripción</label>
            					<input type="text" name="descripcion" value="<?=$curso->descripcion?>">
            					
            					<label>Inicio de curso</label>
            					<input type="date" name="inicio" value="<?=$curso->inicio?>">
            					
            					<label>Fin de curso</label>
            					<input type="date" name="fin" value="<?=$curso->fin?>">
            				</div>
        				</div>
    				    
    					<div class="d-flex st-btn-form justify-content-md-center">
    						<input class="btn-submit" type="submit" name="actualizar" value="ACTUALIZAR">
    					</div>
    				    
        			</form>		
    			</div>
    			
    			<!-- LINKS CALL TO ACTION -->
    			<div class="col-md-12 st-inner-links">
    				<a href="/curso/show/<?=$curso->id?>">Detalles</a>
    				<a href="/curso">Volver al listado</a>   			
    			</div><!--  /. FIN LINKS CALL TO ACTION -->
    			    
    		</div>
    	</section><!-- /. FIN CONTENIDO -->
	
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