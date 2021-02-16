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
		<section class="container st-content">
			<div
				class="row d-flex justify-content-md-center align-items-md-center">

				<div class="col-md-12">
					<h2>Confirmar borrado</h2>
				<?php if(!Login::isAdmin()) {?>
				<p>
						Estás a punto de borrar tu inscripción del <strong><?=$curso->nombre?></strong>.
					</p>
				<?php }?>
				
				<?php if(Login::isAdmin()) {?>
				<p>
						Estás a punto de borrar la inscripción del <strong><?=$curso->nombre?></strong>
						de <strong><?=$usuario->nombre?></strong> usuario: <strong><?=$usuario->usuario?></strong>.
					</p>
				<?php }?>
				
				<!-- FORM -->
					<form method="post" action="/inscripcion/destroy">

						<label>Por favor confirma el borrado:</label> <input type="hidden"
							name="id" value="<?=$id?>">

						<!-- SUBMIT -->
						<div class="st-btn-form">
							<input class="btn-submit" type="submit" name="borrar"
								value="Borrar">
						</div>
						<!-- /. FIN DEL SUBMIT -->
					</form>
					<!-- /. FIN DEL FORM -->

					<!-- LINKS CALL TO ACTION -->
					<div class="col-md-12 st-inner-links">
						<a href="/curso/show/<?=$curso->id?>">Volver a detalles del curso</a>
					</div>
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