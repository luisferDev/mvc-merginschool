<?php
(TEMPLATE)::htmlHead('Inicio');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::header('','Prototipo | Escuela de idiomas');              
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENIDO -->
    	<?php
    	(TEMPLATE)::content('
    	    
    	    <h2 class="hero-title">Esto es una APP Modelo Vista Controlador</h2>
    	    
    	    <div class="st-presentacion">
    	    <p>Somos una academia de idiomas en Barcelona. Nuestro principal
    	    objetivo es que aprendas inglés y por ello, nuestros cursos están
    	    diseñados para que conozcas los idiomas en cada clase. Nuestros cursos están
    	    pensados para que mejores tus posibilidades laborales.</p>
    	    
    	    <p>Merging School, es una escuela
    	    especializada en cursos de chino y en los cursos que
    	    ofrecemos se enseñan ya sea para uso diario o técnico y siempre nos
    	    adaptamos al alumno.</p><br>
            <div class="col-md-12 d-flex st-btn-form justify-content-center" data-aos="fade" data-aos-duration="1000">
                <a class="btn-submit" href="/curso">Nuestros cursos</a>
            </div>



    	    
    	    ');
        ?>
    	
    	<!-- HERO -->
    	<?php
    	(TEMPLATE)::banner();
          ?>
          
        <!-- SLIDER -->
    	<?php
    	(TEMPLATE)::sliderQuote();
          ?>
    	
    	<!-- SECTION 50/50 IFRAME -->
    	<?php
    	(TEMPLATE)::sectVid();
          ?>
        
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