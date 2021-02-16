<?php
(TEMPLATE)::htmlHead('Nuevo');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Nuevo Usuario');
            (TEMPLATE)::login();
        ?>
    <!-- CONTENT -->
	<section class="container-fluid st-content st-cursos-list d-flex justify-content-center align-items-center">
		<div class="row" data-aos="fade" data-aos-duration="1500">
			<div class="col-md-12">
				<h2>Date de Alta</h2>
				
				<form class="st-form" method="post" action="/usuario/store" enctype="multipart/form-data">
					<label>Usuario</label>
					<input type="text" name="usuario">
					
					<label>DNI</label>
					<input type="text" name="dni">
					
					<label>Clave</label>
					<input type="password" name="clave">
					
					<label>Imagen:</label>
					<input type="file" name="imagen">
					
					<label>Nombre</label>
					<input type="text" name="nombre">
					
					<label>Primer Apellido</label>
					<input type="text" name="apellido1">
					
					<label>Segundo Apellido</label>
					<input type="text" name="apellido2">
					
					<label>Email</label>
					<input type="email" min="0" name="email">
										
					<label class="alta-alumno">Alta como Alumno</label>
					<input type="checkbox" name="privilegio" value="1" checked>
					
					<?php if(Login::isAdmin()) {?>
					<p class="destacat">Operaciones sólo para el admin</p>
					<input type="checkbox" name="administrador" value="2">
					<label class="alta-privilegio">Conceder privilegio de administrador</label>
					<?php }?>
					<!-- SUBMIT -->
        			<div class="st-btn-form d-flex justify-content-md-center">
						<input class="btn-submit" type="submit" name="guardar" value="Guardar">
					</div><!-- /. FIN DEL CONTENT -->
        		</form><!-- /. FIN DEL FORM -->
				
				<!-- LINKS CALL TO ACTION -->
				<?php if(Login::isAdmin()) {?>
    			<div class="col-md-12 st-inner-links">
					<a href="/usuario/list">Volver al listado</a>
				</div><!-- /. FIN LINKS CALL TO ACTION -->
				<?php }?>
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