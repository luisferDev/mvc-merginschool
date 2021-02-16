<?php
(TEMPLATE)::htmlHead('Actualizar');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Actualiza tus Datos');              
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
					<form method="post" action="/usuario/update" enctype="multipart/form-data">
    					
    					<div class="row d-flex justify-content-md-center align-items-md-start">
    					 
    					   <!--FICHA -->
            				<div class="col-md-6 st-det-ficha">
            				    <!-- TITLE -->
            				    <h2 class="h1"><?="$usuario->nombre <span class='h3 destacat'>$usuario->email</span>"?></h2>
            				    
                				<input type="hidden" name="id" value="<?=$usuario->id?>">
                				
            					<label>Usuario</label>
            					<input type="text" name="usuario" value="<?=$usuario->usuario?>">
            					
            					<label>DNI</label>
            					<input type="text" name="dni" value="<?=$usuario->dni?>">
            					
            					<label>Clave</label>
            					<input type="password" name="clave" value="<?=$usuario->clave?>">
            					<label><span>En blanco para no cambiar la clave actual</span></label>
            					
            					<label>Nombre</label>
            					<input type="text" name="nombre" value="<?=$usuario->nombre?>">
            					
            					<label>Primer Apellido</label>
            					<input type="text" name="apellido1" value="<?=$usuario->apellido1?>">
            					
            					<label>Segundo Apellido</label>
            					<input type="text" name="apellido2" value="<?=$usuario->apellido2?>">
            					
            					<label>Email</label>
            					<input type="email" name="email" value="<?=$usuario->email?>">
							
							</div>
							
							<!--IMAGEN -->
                			<div class="col-md-6">    			
                				<figure class="portada-curso">
                					<?php
                					if($usuario->imagen){
                					    echo "<img class='user-cover-det' src='/$usuario->imagen' alt='$usuario->usuario'><br/>";
                					    echo "<input type='checkbox' name='eliminarimagen' value='1'>";
                					    echo "<label>Eliminar la imagen</label><br/>";
                					} else {
                					    echo "<img class='user-cover-det' src='/imagenes/usuarios/default.jpg' alt='$usuario->usuario'>";
                					}
                					?>
            					</figure>
            					<label>Nueva imagen:</label>
            					<input type="file" name="imagen"><span>(no indicar si no se desea cambiar)</span>
            					
            					
								<div class="st-form">
    								<?php
                					if(Login::isAdmin()){
                					    echo "<p class='destacat'>Operaciones sólo para el admin</p><br/>";
                					    echo "<label>Privilegio</label> ";
                					    echo "<input type='number' value='0' min='0' max='9999' name='privilegio' value='<?=$usuario->email?>'><br/>";					    
                					    echo "<input type='checkbox' name='administrador' value='1' <?=empty($usuario->administrador) ? '':' checked'?>";
                					    echo "<label>Conceder privilegio de administrador</label><br/>";
                					}?>
            					</div>
    						</div>
    						
							<div class="col-md-12">
    							<div class="d-flex st-btn-form justify-content-md-center">
            						<input class="btn-submit" type="submit" name="actualizar" value="Actualizar">
            					</div>
        					</div>
        				</div>
    				</form>
    				
    				<!-- LINKS CALL TO ACTION -->
        			<div class="col-md-12 st-inner-links">
        				<a href="/usuario/show/<?=$usuario->id?>">Mis datos</a>
        				<?php if(Login::isAdmin()) {?>
        				<a href="/usuario/list">Volver al listado</a>
        				<?php }?>
    				</div><!--  /. FIN LINKS CALL TO ACTION -->
    			</div>

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