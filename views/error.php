<?php
(TEMPLATE)::htmlHead('Error');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Oops');              
            (TEMPLATE)::login();
        ?>
        
        <!-- CONTENIDO -->
    	<section class="container st-content st-cursos-list d-flex justify-content-md-center align-content-md-center">
        	<div class="row">
        		<div class="col-md-12 text-center">        	    
            	    <h2>¡Vaya, algo no ha ido bien!</h2>
                    <p class="error"><?=$mensaje?></p>
        	    </div>
        	</div>
    	</section>
    	
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