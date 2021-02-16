<!Doctype html>
<html lang='es'>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="/../css/style.css" rel="stylesheet">

</head>
<div class=main>
<?php
        (TEMPLATE)::nav();  
        (TEMPLATE)::header();
    ?>
	<section class="container">
		<div class="row justify-content-md-start align-content-md-center">
			<div class="col-md-12">
				
				<h2 class="text-center">Recuperar clave</h2>
				<div class="login-box">
                          
                        <form method="post" action="/forgotpassword/send">
        						<div class="user-box">
        							<input type="text" name="usuario"/> 
        							<label>Usuario</label>
        						</div>
        						<div class="user-box">
        							<input type="email" name="email"/> 
        							<label>Email</label>
        						</div>
        						<!-- <div class="user-box">
        							<input type="password" name="clave" required /> 
        							<label>Clave</label>
        						</div> -->
        						<input type="submit" name="generar" value="Generar nueva clave">
        					</form>
        					<br/>
        					
                       </div>
    				<!--  /.. FIN FORMULARIO  -->							
			</div>
		</div>
	</section>
	
	<?php
	   (TEMPLATE)::footer();
      ?>
</div>
	<!----------------------------------
        Scripts
    ----------------------------------->	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>