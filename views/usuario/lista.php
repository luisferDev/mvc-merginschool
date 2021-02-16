<?php
(TEMPLATE)::htmlHead('Lista');
?>

<body>
<!-- MAIN CONTAINER -->
    <div class=main>
        
        <!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Lista de Usuarios');
            (TEMPLATE)::login();
        ?>
        
        
    	<section class='container st-content st-cursos-list'>
    		<div class='row justify-content-md-start align-content-md-center'>
    			<div class='col-md-12'>
    			
    			 <!-- FILTRO DE USUARIOS -->
                   <form class="search-form" method="post" action="/usuario/buscar">
                   
                      <div class="row container">
                         <div class="col-md-12">
                            <div class="search-form-container">
                               <div class="row st-filter">
                                  <div class="col-md-12">
                                     <label class="bg-orange">Filtrar por</label>
                                     <select name="campo">
                                     	<option value="nombre" <?=!empty($campo) && $campo=='nombre' ? 'selected' : '' ;?>>Nombre</option>
                                     	<option value="apellido1" <?=!empty($campo) && $campo=='apellido1' ? 'selected' : '' ;?>>Apellido</option>
                                        <option value="usuario" <?=!empty($campo) && $campo=='usuario' ? 'selected' : '' ;?>>Usuario</option>
                                        <option value="dni" <?=!empty($campo) && $campo=='dni' ? 'selected' : '' ;?>>Dni</option>
                                        <option value="email" <?=!empty($campo) && $campo=='email' ? 'selected' : '' ;?>>Email</option>
                                     </select>
                                     <!-- <label class="bg-yellow">Palabra:</label> -->
                                     <input type="text" name="valor" value="<?=!empty($valor) ? $valor : '';?>">
                                  </div>
                                  <div class="col-md-12">                                  
                                     <input type="radio" name="sentido" value="ASC" <?=empty($sentido) || $sentido=='ASC' ? ' checked' : ''
                                        ;?>>
                                     <label class="pd-lft">ascendente</label>
                                     <input type="radio" name="sentido" value="DESC" <?=!empty($sentido) && $sentido=='DESC' ? ' checked'
                                        : '' ;?>>
                                     <label  class="pd-lft">descendente</label>
                                  </div>
                               </div>
                            </div>
                         </div>
                   
                         <div class="col-md-12">
                            <div class="row">
                               <div class="col-md-12 st-filter">
                                	<div class="remove-filter bg-blue--light"><a href="/curso/list">Quitar filtros</a></div>
                               		<input type="submit" class="bg-navy" name="buscar" value="Buscar">
                               </div>
                            </div>
                         </div>
                      </div>
                   
                   </form><!-- /. FIN DE FILTRO DE CURSOS -->	
				
				
				<!-- CARDS -->
                <div class='user-card row justify-content-center align-content-center'>
                   <?php
                   foreach ($usuarios as $usuario) {
                      echo "<div class='col-md-8' data-aos='fade-up' data-aos-duration='1000'>";
                      /*echo "<a href='/usuario/show/$usuario->id'>";*/
                      echo "<div class='card'>";
                      echo "<div class='row'>";
                      echo "<div class='col-md-4'>";
                      echo "<figure>";
                      echo $usuario->imagen ? "<img class='card-img-top' src='/$usuario->imagen' alt='$usuario->usuario'>" : 
                      "<img class='card-img-left' src='/imagenes/usuarios/default.jpg' alt='$usuario->usuario'>";
                      echo "</figure>";
                      echo "</div>";
                      echo "<div class='col-md-8 d-flex justify-content-start align-items-end'>";
                      echo "<div class='card-body'>";
                      if ($usuario->administrador) {
                          echo "<div class='ribbon-top'><span class='user-ribbon'>Admin</span></div>";
                      }
                      echo "<p class='card-title'>Usuario: <span class='user h5'>$usuario->usuario</span></p>";
                      echo "<p class='card-text'>Nombre: <span class='user-name h5'>$usuario->nombre</span></p>";
                      echo "<p class='card-text'>Apellidos: <span class='user-name h5'>$usuario->apellido1 $usuario->apellido2</span></p>";
                      echo "<div class='inner-nav'>";
                      echo "<a href='/usuario/show/$usuario->id'>Ver</a><i class='fas fa-circle'></i>";
                      echo "<a href='/usuario/edit/$usuario->id'>Actualizar</a><i class='fas fa-circle'></i>";
                      echo "<a href='/usuario/delete/$usuario->id'>Borrar</a>";
                      echo "</div>";
                      echo "</div>";
                      echo "</div>";
                      echo "</div>";
                      echo "</div>";
                      /*echo "</a>";*/
                      echo "</div>";
                   }
                   ?>
                </div><!-- /. FIN CARDS -->
			
			</div>
		</div>
	</section><!-- /. fin de CONTENT -->
	
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