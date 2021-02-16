<?php
(TEMPLATE)::htmlHead('Borrar');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Borrar el Curso');              
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENIDO -->
    	<section class="container st-content">
    		<div class="row" data-aos="fade" data-aos-duration="1500">
    			<div class="col-md-12">
    			
    				<!-- FORM -->
    				<form method="post" action="/curso/destroy">
    				    <div class="row d-flex justify-content-md-center align-items-md-center">
    				    	
    				    	<!--IMAGEN -->
    				    	<div class="col-md-6">
            					<figure class="portada-curso">
            					<?php
            					echo $curso->imagen ?
            					"<img src='/$curso->imagen' alt='$curso->nombre'>":
            					"<img src='/imagenes/cursos/default.jpg' alt='$curso->nombre'>";
            					?>
            					</figure>
        					</div>
        				
        				    <!-- CONTENT -->
        					<div class="col-md-6">
                				<h2>Confirmar borrado</h2>
            					<p>Estás a punto de borrar el <strong><?=$curso->nombre ?></strong>.</p>
            					<input type="hidden" name="id" value="<?=$id?>">
            					
            				    <!-- SUBMIT -->
            					<div class="st-btn-form">
            						<input class="btn-submit" type="submit" name="borrar" value="Borrar">
            					</div><!-- /. FIN DEL SUBMIT -->
    				    	</div><!-- /. FIN DEL CONTENT -->
    					</div>
    				</form><!-- /. FIN DEL FORM -->
    				
    				<!-- LINKS CALL TO ACTION -->
        			<div class="col-md-12 st-inner-links">
        				<a href="/curso/list">Volver al listado</a>
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