<?php
(TEMPLATE)::htmlHead('Contacto');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Contacta');              
            (TEMPLATE)::login();
        ?>
    	
    	<!-- CONTACT FORM -->
    	<?php
    	(TEMPLATE)::contactForm('Haznos llegar tus comentarios');
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