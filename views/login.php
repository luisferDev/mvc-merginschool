<?php
(TEMPLATE)::htmlHead('Login');
?>

<body>
    <!-- MAIN CONTAINER -->
	<div class=main>
	
    	<!-- HEADER -->
    	<?php
            (TEMPLATE)::nav();  
            (TEMPLATE)::headerInner('Accede con tus datos');              
            (TEMPLATE)::login();
        ?>
        
        <!-- FORM LOGIN -->
    	<?php
    	(TEMPLATE)::loginForm('Ingresa');
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