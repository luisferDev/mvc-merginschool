<?php
(TEMPLATE)::htmlHead('Borrar');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Baja del Usuario');              
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENIDO -->
    	<section class="container st-content">
    		<div class="row">
    			<div class="col-md-12">
    			
    				<!-- FORM -->
    				<form method="post" action="/usuario/destroy">
    				    <div class="row d-flex justify-content-md-center align-items-md-center" data-aos="fade" data-aos-duration="1500">
    				    	
    				    	<!--IMAGEN -->
    				    	<div class="col-md-6">
            					<figure class="portada-curso">
                					<?php
                					echo $usuario->imagen ?
                					"<img class='user-cover-det' src='/$usuario->imagen' alt='$usuario->usuario'>":
                					"<img class='user-cover-det' src='/imagenes/usuarios/default.jpg' alt='$usuario->usuario'>";
                					?>
            					</figure>
            				</div>
            				
            				<!-- CONTENT -->
        					<div class="col-md-6">
								<h2>Confirmar baja de usuario</h2>
								<p><?="$usuario->usuario ($usuario->email)"?></p>
								<p>Confirmar el borrado del usuario <strong><?=$usuario->usuario?></strong>.</p>
								<input class="btn-submit" type="hidden" name="id" value="<?=$id?>">					
					
					            <!-- SUBMIT -->
            					<div class="st-btn-form">
            						<input class="btn-submit" type="submit" name="borrar" value="Borrar">
            					</div><!-- /. FIN DEL SUBMIT -->
    				    	</div><!-- /. FIN DEL CONTENT -->
    					</div>
    				</form><!-- /. FIN DEL FORM -->
				
    				<!-- LINKS CALL TO ACTION -->
            		<div class="col-md-12 st-inner-links">
        				<a href="/usuario/show/<?=$usuario->id?>">Detalles </a>
        				<a href="/usuario/list">Volver al listado</a>
        			</div><!-- /. FIN LINKS CALL TO ACTION -->    					
    			</div>
    		</div>
    	</section><!-- /. FIN DEL CONTENIDO -->

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