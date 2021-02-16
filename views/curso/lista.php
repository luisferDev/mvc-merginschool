<?php
(TEMPLATE)::htmlHead('Cursos');
?>

<body>
<!-- MAIN CONTAINER -->
    <div class=main>
        
        <!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Aprende con Nosotros');
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENT -->
    	<section class='container st-cursos-list'>
    		<div class='row justify-content-md-start align-content-md-center'>
    			<div class='col-md-12'>
    			
    			<!-- FILTRO DE CURSOS -->
                   <form class="search-form" method="post" action="/curso/buscar">
                   
                      <div class="row container">
                         <div class="col-md-12">
                            <div class="search-form-container">
                               <div class="row st-filter">
                                  <div class="col-md-12">
                                     <label class="bg-orange">Filtrar por</label>
                                     <select name="campo">
                                        <option value="nombre" <?=!empty($campo) && $campo=='nombre' ? 'selected' : '' ;?>>Nombre</option>
                                        <option value="inicio" <?=!empty($campo) && $campo=='inicio' ? 'selected' : '' ;?>>Inicio</option>
                                        <option value="fin" <?=!empty($campo) && $campo=='fin' ? 'selected' : '' ;?>>Fin</option>
                                     </select>
                                     <label class="bg-yellow">Palabra:</label>
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
        				<div class='curso-card row justify-content-center align-content-center'>
                                <?php
                                
                                foreach ($cursos as $curso) {
                                    echo "<div class='col-xs-12 col-sm-6 col-lg-4' data-aos='fade-up' data-aos-duration='1000'>";
                                    echo "<a href='/curso/show/$curso->id'>";
                                    echo "<div class='card'>";
                                    echo "<figure>";
                                    echo $curso->imagen ? "<img class='card-img-top' src='/$curso->imagen' alt='$curso->nombre'>" : 
                                    "<img class='card-img-left' src='/imagenes/cursos/default.jpg' alt='$curso->nombre'>";
                                    echo "</figure>";
                                    echo "<div class='card-body text-center'>";
                                    echo "<h2 class='card-title h3'>$curso->nombre</h2>";
                                    /*echo "<p class='card-text'>$curso->descripcion</p>";*/
                                    echo "<div class='inner-nav'>";
                                    echo "<a href='/curso/show/$curso->id'>+ Info</a>";
                                    if (Login::isAdmin()) {
                                        echo "<a href='/curso/edit/$curso->id'>Actualizar</a>";
                                        echo "<a href='/curso/delete/$curso->id'>Borrar</a>";
                                    }
                                    
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</a>";
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