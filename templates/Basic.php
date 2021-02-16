<?php

class Basic {
    
    /* ----------------------------------------------------------------
     * HTML START
     ------------------------------------------------------------------*/
    public static function htmlHead(string $pagina=''){?>
    <!Doctype html>
	<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex">
        <meta name="description" content="Luis Marin Web Developer">
        <meta name="author" content="">
        <title><?= $pagina ?></title>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="/../css/style.css" rel="stylesheet">
     </head>
    <?php }
    
    /* ----------------------------------------------------------------
     * HTML END
     ------------------------------------------------------------------
     */
    public static function htmlScripts(){?>
        <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"></script>
        <?php
        echo "<script type='text/JavaScript'>
                $(document).ready(function(){
                    $('.bxslider').bxSlider({
                    auto: true,
                    pager: true
                    });
                });
            </script>"
                ;
                ?>
    	<!-- Bootstrap -->
    	<script
    		src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    	<!-- Animation -->
    	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    	<?php  
        echo "<script type='text/JavaScript'>
            AOS.init();
        </script>"
        ;
        ?>
    	<!-- JS Scripts -->
    	<script type="text/javascript" src="/../js/scripts.js"></script>
    <?php }
    
    
    /* ----------------------------------------------------------------
     * HEADER HOME
     ------------------------------------------------------------------
     */
    public static function header(string $title='', string $claim='') {?>
    	
            <header class="container-fluid hero-home">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-txt">
                            <h1><?= $title ?></h1>
                        	<h2><?= $claim ?></h2>      					
                        </div>
                    </div>
                </div>
            </header>
            
     <?php }
     
     
     /* ----------------------------------------------------------------
      * HEADER INNER PAGES
      ------------------------------------------------------------------
      */
     public static function headerInner(string $pagina='') {?>
    	
            <header class="container-fluid hero-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-txt">
                        <h1><?= $pagina ?></h1>
                        </div>
                    </div>
                </div>
            </header>
            
     <?php }    
     
     
     /* ----------------------------------------------------------------
      * MENÚ NAVIGATION 
      ------------------------------------------------------------------
      */
     public static function nav() {?>
    
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-12">
                 <nav id="menu" class="navbar navbar-expand-md">
                    <div class="row">
                       <div class="col-md-12">
                          <!-- Toggler/collapsibe Button -->
                          <div class="row toogle-mob">
                              <div class="col-6">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                                </button>
                              </div>
                              <div class="col-6">
                                <a class="navbar-brand" href="/"><img src="/imagenes/logos/logo-mvc-white.png" class="logo-img" alt="Merging Language School"></a>
                              </div>
                          </div><!-- Fin Toggler/collapsibe Button -->
        
                          <div class="row not-toogle">
                              <!-- Navbar links -->
                              <div class="col-md-12">                                  
                                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                        <ul class="navbar-nav navbar-nav navbar-collapse collapse show">
                                            <li class="nav-item">
                                            <a href="/">Inicio</a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="/curso">Cursos</a>
                                            </li>
                    
                                            <li class="nav-item">
                                            <a href="/contacto">Contactar</a>
                                            </li>
                                            <?php if(Login::isAdmin() || Login::hasPrivilege(500)) {?>
                                            <li class="nav-item">
                                            <a href="/curso/create">Nuevo curso</a>
                                            </li>
                    
                                            <li class="nav-item">
                                            <a href="/usuario/list">Listado de Alumnos</a>
                                            </li>
                    
                                            <?php }?>
                    
                                            <li class="nav-item">
                                            <a href="/usuario/create">Regístrate</a>
                                            </li>
                                        </ul>
                                    </div>
                              </div><!-- /. Fin Navbar links -->

                              <div class="col-md-12 logo">
                                <a class="navbar-brand" href="/">
                                    <img src="/imagenes/logos/logo-mvc-white.png" class="logo-img" alt="Merging Language School">
                                </a>
                              </div>
                          </div>
                       </div>
                    </div>
                 </nav>
              </div>
           </div>
        </div>
     <?php }
     
     
     /* ----------------------------------------------------------------
      * LOGIN & REGISTER LINKS
      ------------------------------------------------------------------
      */
     
     public static function login() {
         
         $identificado = Login::get();
         
         echo "<section class='container st-login'>";
         echo "<div class='row'>";
         echo "<div class='col-md-12'>";
         echo "<div class='login'>";
         echo $identificado ?
         "Hola <a href='/usuario/show/$identificado->id' class='logname'>$identificado->usuario</a>|
         <a href='/login/logout' class='logout'>salir</a>" :
         "<a href='/login' class='regis-link'>Identifícate</a><a class='regis-link' href='/usuario/create'>Regístrate</a>";
         
         echo "</div>";
         
         echo "</div>";
         echo "</div>";
         echo "</section>";
         
     }
     
     /* ----------------------------------------------------------------
      * SECTION CONTENT
      ------------------------------------------------------------------
      */
     
     public static function content($content='') {?>

    <section class="container st-content">
    	<div
    		class="row d-flex justify-content-center align-content-center text-center">
    		<div class="col-md-12">
    			<!-- block1 -->
    			<div><?= $content ?></div>
    		</div>
    
    	</div>
    </section>

	<?php

}
     
     
     /* ----------------------------------------------------------------
      * HOME HERO BANNER
      ------------------------------------------------------------------
      */
     public  static function banner() {?>
     
        <section class="container-fluid st-banner" data-aos="fade-up" data-aos-duration="800">
        	<div class="row container">
        		<div class="col-md-12">
        			<h3 class="hero-title-w text-center">Nos adaptamos a ti</h3>
        			<ul>
        				<li><i class="far fa-clock"></i> <span>Elige tu horario</span></li>
        				<li><i class="far fa-heart"></i><span>Tarifa plana</span></li>
        				<li><i class="far fa-calendar-check"></i><span>Empieza cuando
        						quieras</span></li>
        			</ul>
        			<ul>
        				<li><i class="fas fa-university"></i> <span>Clases en la academia y
        						en videoconferencia</span></li>
        				<li><i class="fas fa-edit"></i><span>Tutorías personalizadas con tu
        						Coach de Idioma</span></li>
        			</ul>
        		</div>
        	</div>
        </section>
        
	<?php }
	
	
	/* ----------------------------------------------------------------
	 * SLIDER QUOTE
	 ------------------------------------------------------------------
	 */
	public  static function sliderQuote() {?>
	
    <section class="st-slider">
    	<div class="row justify-content-md-center align-items-md-center">
    		<div class="col-md-9">
    			<ul class="bxslider text-center">
    				<li>
    					<q class="sl-txt"><i class="fas fa-quote-left"></i>Me ha encantado la experiencia en esta academia, no me esperaba que fuera a ser una experiencia tan gratificante y agradezco al staff de profesores por ello.<i class="fas fa-quote-right"></i></q>
    					<p class="sl-autor">Jennifer Quiensea</p>
    				</li>
    				<li>
    					<q class="sl-txt"><i class="fas fa-quote-left"></i>Nunca olvidaré esta formación, porque me ha permitido alcanzar unas metas que veía imposible.<i class="fas fa-quote-right"></i></q>
    					<p class="sl-autor">Antonio Quiensea</p>
    				</li>
    				<li>
    					<q class="sl-txt"><i class="fas fa-quote-left"></i>Ya puedo decir que ahora sí, no hay quien me detenga.<i class="fas fa-quote-right"></i></q>
    					<p class="sl-autor">Franco Quiensea</p>
    				</li>
    				<li>
    					<q class="sl-txt"><i class="fas fa-quote-left"></i>Aún me encuentro en un proceso de formación, pero sin duda es la formación, mas gratificante que he podido tener.<i class="fas fa-quote-right"></i></q>
    					<p class="sl-autor">Beyoncè Quiensea</p>
    				</li>
    			</ul>
    		</div>
    	</div>
    </section>
    
    <?php }

    
    /* ----------------------------------------------------------------
     * SECTION IFRAME
     ------------------------------------------------------------------
     */
    public static function sectVid() {?>

    <section class="container-fluid st-vid" data-aos="fade">
    	<div class="row container">
    		<div class="col-md-5">
    			<div class="st-txt">
    				<h3>Descubre con nosotros</h3>
    				<h2>lo interesante de hablar con muchos más</h2>
    
    			</div>
    		</div>
    		<div class="col-md-7">
    			<div class="video">
    				<iframe width="" height="" src="https://www.youtube.com/embed/gIae3wGVfX8?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    			</div>
    		</div>
    	</div>
    </section>

	<?php }
	
	
	/* ----------------------------------------------------------------
	 * CONTACT FORM
	 ------------------------------------------------------------------
	 */
	public static function contactForm(string $title='') {?>
	
    <section class="container d-flex justify-content-center align-content-center">
    	<div class="row" data-aos="fade" data-aos-duration="1500">
    		<div class="col-md-12">
    		<h2 class="text-center"><?= $title ?></h2>
    			<div class="login-box">
    				<form method="post" action="/contacto/send">
    					<div class="user-box">
    						<input type="text" name="nombre" /><label>Nombre</label>
    					</div>
    
    					<div class="user-box">
    						<input type="email" name="email" /> <label>Email</label>
    					</div>
    
    					<div class="user-box form-toogle">
    						<label for="select">Motivo</label> <select id="select"
    							name="motivo">
    							<option>Información general</option>
    							<option>Consulta personalizada</option>
    							<option>Otra</option>
    						</select>
    					</div>
    					<div class="user-box form-txtarea">
    						<textarea name="mensaje" rows="4" cols="20" required></textarea>
    						<label for="campo">Consulta</label>
    					</div>
    					<div class="d-flex justify-content-md-center">
    						<input type="submit" name="enviar" value="Enviar">
    					</div>
    				</form>
    			</div>
    
    		</div>
    		<!--  /.. FIN FORMULARIO  -->
    	</div>
    </section>

	<?php }
	
	
	/* ----------------------------------------------------------------
	 * CONTACT FORM
	 ------------------------------------------------------------------
	 */
	public static function loginForm(string $title='') {?>
	
    <section class="container st-form d-flex justify-content-md-center align-content-md-center">
    	<div class="row" data-aos='fade' data-aos-duration='1500'>
    		<div class="col-md-12">
    		<h2 class="text-center"><?= $title ?></h2>

    			<div class="login-box">    
    				<form method="post" action="/login/login">
    					<div class="user-box">
    						<input type="text" name="usuario" /> <label>Usuario o email</label>
    					</div>
    					<div class="user-box">
    						<input type="password" name="clave" /> <label>Clave</label>
    					</div>
    					<div class="d-flex justify-content-md-center">
    						<input type="submit" name="identificar" value="Identificarse">
    					</div>
    					
    				</form>
    				<br />
    				<p>
    					<a class="form-recover" href="/forgotpassword">Olvidé mi clave</a>
    				</p>
    			</div>
			    <!--  /.. FIN FORMULARIO  -->
    		</div>
    	</div>
    </section>

	<?php }

    /* ----------------------------------------------------------------
     * FOOTER
     * ------------------------------------------------------------------
     */
    public static function footer() {?>
     
         <footer>
             <div class="row justify-content-md-center">     
                 <div class="col-md-8">
                     <h2 class="h4">Prototipo MVC</h2>            
                     <div class="contact-legal">
                     	<p>Derechos reservados, Luisfer - Desarrollador Web</p>
                     </div>
                 </div>          
             </div>
         </footer>
              
      <?php }
}



