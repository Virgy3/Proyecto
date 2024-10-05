<?php

session_start(); // Iniciamos sesión aquí porque más abajo tenemos una variable $_SESSION y es necesario

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Index</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
	
</head>

<body>

	<!--CABECERA -->
	
	<header id="header">
			
			<!--LOGO -->
			<div><a href="index.php">
				<img id="logo" src="../img/logocastillo.png" alt="Logo de mi aplicación web"></a>
			</div>
					
			<div class="container">
			
				<!--MENU -->
				<nav id="navigation">
					<ul>
						<li><form action="../models/buscarProducto.php" method="get">
								<input type="text" name="busqueda" placeholder="Buscar productos...">
								<button type="submit"><img id="lupa" src="../img/lupa.png" alt="Buscar"></button>
							</form>
						</li>	
						<li><a href="../views/productos.html" id="enlace-productos">Productos</a></li>
						<li><a href="../views/informacion.html">Acerca de</a></li>
						<li><a href="../views/formUser.html">Contacto</a></li>
						<li><a href="../models/users.php"><img id="profile" src="../img/profile.png" alt="Icono de tarjeta"></a></li>
						<li><a href="../models/sesion.php"><img id="sesion" src="../img/sesion.png" alt="Icono de sesion"></a></li>
						
				<?php if (isset($_SESSION['valor'])): ?>
						<!-- Cerrar sesión si el usuario está logueado -->		
						<li><a href="../controllers/logout.php"><img id="cerrarSesion" src="../img/cerrarSesion.png" alt="Icono de sesion"></a></li>
						
				<?php endif; ?>			
				
					</ul>
				</nav>	
			</div>
					
	</header>
	
		<!-- CAJA PRINCIPAL -->
		<div id="principal">
		
			<h1>~ Compra juegos de mesa en Castillo de Juegos ~</h1><br><br>
			
				<article class="entrada">
					<h4> En Castillo de Juegos puedes <b>comprar</b> tus juegos de mesa.
					    Te ofrecemos las últimas <b>novedades</b> y te llevamos a casa tus juegos.<br><br>
						<p>Utiliza el buscador de productos para saber si tenemos lo que buscas.</h4></p><br><br><br>
				</article>
			
		<main id="contenido-main">
			<!-- Este script hace que la pág de juegos se cargue en el main manteniendo cabecera y pie -->
			<script src="cargarContenido.js"></script> 

		<div class="contenedor-slider">
		
			<!-- Empieza el deslizamiento de imágenes en el main -->
			<div class = "slider">
			
				<div class = "slides">
				
					<!-- Creamos radio buttons -->
						
						<input type="radio" name="radio-btn" id="radio1">
						<input type="radio" name="radio-btn" id="radio2">
						<input type="radio" name="radio-btn" id="radio3">
						<input type="radio" name="radio-btn" id="radio4">
					<!-- Terminan los radio buttons -->
				
				<!-- Deslizamiento de imágenes-->
				
				<div class="slide first">
					<img src="../img/boardgames/dead00.jpg" alt="Imagen 1"/>	
				</div>
				
				<div class="slide">
					<img src="../img/boardgames/agricola00.jpg" alt="Imagen 2"/>	
				</div>
				
				<div class="slide">
					<img src="../img/boardgames/unogranja00.jpg" alt="Imagen 3"/>	
				</div>
				
				<div class="slide">
					<img src="../img/boardgames/7wonders00.jpg" alt="Imagen 4"/>	
				</div>
				
				<!-- Fin del deslizamiento de imágenes-->
				
				<!-- Navegación automática de imágenes-->
				
					<div class="navigation-auto">
						<div class="auto-btn1"></div>
						<div class="auto-btn2"></div>
						<div class="auto-btn3"></div>
						<div class="auto-btn4"></div>
					</div>
				
				<!-- Termina la navegación automática de imágenes-->
				</div>
				<!-- Navegación manual de imágenes-->
				
				<div class="navigation-manual">
					<label for="radio1" class="manual-btn"></label>
					<label for="radio2" class="manual-btn"></label>
					<label for="radio3" class="manual-btn"></label>
					<label for="radio4" class="manual-btn"></label>
				
				</div>
				<!-- Termina el deslizamiento manual de imágenes -->
				
			</div>
			<!-- Termina el deslizamiento de imágenes en el main -->
			
	<script type="text/javascript" src="../views/slider.js"></script>
		
		</div>
			
			<div class="parrafo"> 
				<p> Explora nuestra gama de juegos de mesa y encuentra el entretenimiento perfecto para ti y tus seres queridos.</p>
				<p> ¡Tenemos juegos de mesa para todas las edades! </p>
				<img src="../img/boardgames/catan02.jpg" alt="juegocatan02"/>
			</div>
			
			<div class="img-menu">
				<ul>
					<li><img id="entrega" src="../img/entrega.png" alt="Icono de entrega">
						<p><b> Envío gratuito a partir de 30 € de compra y te llega a casa en 24/48 horas de plazo máximo.</b></p>
					</li>
					
					<li><img id="devolucion" src="../img/devolucion.png" alt="Icono de devolucion">
						<p><b> Garantia de devolución del producto si no quedas satisfecho con el.</b></p>
					</li>
					
					<li><img id="pagoseguro" src="../img/pagoseguro.png" alt="Icono de pagoseguro">
						<p><b> Pago seguro con tarjeta y otras formas de pago seguras.</b></p>
					</li>
				</ul>				
			</div>	
			
		</main>	
			<!--Este método sirve para solucionar problemas de flujo de elementos -->
			<div class="clearfix"></div>
			
		</div>
		
	
	<!--PIE DE PÁGINA -->
	<footer id="footer">
	
		<div class="contenedor-pie">
		
			<a href="index.php">Inicio</a>
			<a href="../views/informacion.html">Información</a>
			<a href="../models/users.php">Mi cuenta</a>
			<a href="../views/guiaCompra.html">Guia de compra</a>
	
		</div>	
	</footer>

</body>

</html>