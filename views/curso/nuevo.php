<?php
(TEMPLATE)::htmlHead('Nuevo');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Nuevo Curso');              
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENT -->
    	<section class="container-fluid st-content st-cursos-list d-flex justify-content-center align-items-center">
    		<div class="row" data-aos="fade" data-aos-duration="1500">
    			<div class="col-md-12">
    				<h2>Creación de un nuevo curso</h2>
    				
            				<form class="st-form" method="post" action="/curso/store" enctype="multipart/form-data">
            					<label>Código</label>
            					<input type="text" name="codigo">
            					
            					<label>Nombre</label>
            					<input type="text" name="nombre">
            					
            					<label>Imagen:</label>
            					<input type="file" name="imagen">
            					
            					<label>Descripción</label>
            					<input type="text" name="descripcion">
            					
            					<label>Inicio</label>
            					<input type="date" name="inicio">
            					
            					<label>Fin</label>
            					<input type="date" name="fin">
            					
            					<!-- SUBMIT -->
            					<div class="st-btn-form d-flex justify-content-md-center">
            						<input class="btn-submit" type="submit" name="guardar" value="Guardar">
            					</div><!-- /. FIN DEL CONTENT -->
            				</form><!-- /. FIN DEL FORM -->
    				
    				<!-- LINKS CALL TO ACTION -->
        			<div class="col-md-12 st-inner-links">
    					<a href="/curso/list">Volver al listado</a>
    				</div><!-- /. FIN LINKS CALL TO ACTION -->
    			</div>
    		</div>
    	</section><!-- /. FIN CONTENT -->
	
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