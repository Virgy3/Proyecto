<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Index</title>
	<link rel="stylesheet" type="text/css" href="../views/formularios.css">

</head>

	<body>
	
<?php
	
	include "../models/conexion.php"; //Se incluye aquí el contenido del archivo "conexion.php" para conectar con la BBDD
	require_once '../controllers/funcionesRegistro.php'; //Incluye otras funciones. En este caso de control de errores del formulario.

?>
	
	<div class="contenedor2">
	
		<h3><b> REGÍSTRATE </b></h3>
	
		<form class="formulario" action="registro.php" method="POST">
		
		
			<p><label for="nombre">Nombre completo: </label><input type="text" name="nombre"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
			
			<p><label for="cumpleanos">Cumpleaños: </label><input type="date" name="cumpleanos"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'cumpleanos') : ''; ?>
			
			<p><label for="direccion">Dirección completa: </label><input type="text" name="direccion"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'direccion') : ''; ?>
			
			<p><label for="codigo_postal">Código_postal: </label><input type="number" name="codigo_postal"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'codigo_postal') : ''; ?>
			
			<p><label for="ciudad">Ciudad: </label><input type="text" name="ciudad"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'ciudad') : ''; ?>
			
			<p><label for="telefono">Teléfono: </label><input type="number" name="telefono"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'telefono') : ''; ?>
			
			<p><label for="email">Email: </label><input type="email" name="email"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>
			
			<p><label for="contrasena">Contraseña: </label><input type="password" name="contrasena"></p>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'contrasena') : ''; ?>
			
			<p><input type="submit" value= "Registrar" name="registrar"></p>
			
			<a href="../models/sesion.php">Volver</a></p>
					
		</form>
		
		<?php borrarErrores(); ?>
		
<?php

	
/* Recogemos los valores del formulario de registro y vamos a usar un "operador ternario" para reducir el código */

	if (isset($_POST['registrar'])) {
		
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; //Esto es lo mismo que un if..else pero reducido
		$cumpleanos = isset($_POST['cumpleanos']) ? $_POST['cumpleanos'] : false;
		$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
		$codigo_postal = isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] :false;
		$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
		$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
		$email = isset($_POST['email']) ? $_POST['email'] : false;
		$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
		
		
	//Array de errores
	
	$errores = array();
	
	
	//Validar los datos antes de guardarlos en la base de datos (BBDD).
		if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) { //Validar campo nombre.
			$nombre_validado = true;
			//echo "El nombre es válido";
		
			} else {
				$nombre_validado = false;
				$errores['nombre'] = "*El nombre no es válido*";	
			}
			
		if (!empty($cumpleanos)) { //Validar campo cumpleaños
			$cumpleanos_validado = true;
			//echo "El cumpleaños es válido";
		
			} else {
				$cumpleanos_validado = false;
				$errores['cumpleanos'] = "*El cumpleaños está vacío*";	
			}
		
		if (!empty($direccion)) { //Validar campo direccion
			$direccion_validado = true;
			//echo "La dirección es válida";
		
			} else {
				$direccion_validado = false;
				$errores['direccion'] = "*La dirección está vacía*";	
			}
		
		if (!empty($codigo_postal)) { //Validar campo codigo postal.
			$codigo_postal_validado = true;
			//echo "El código postal es válido";
		
			} else {
				$codigo_postal_validado = false;
				$errores['codigo_postal'] = "*El código postal está vacío*";	
			}
		
		if (!empty($ciudad)) { //Validar campo ciudad
			$ciudad_validado = true;
			//echo "La ciudad es válida";
		
			} else {
				$ciudad_validado = false;
				$errores['ciudad'] = "*La ciudad está vacía*";
			}
		

	
		if (!empty($telefono) && is_numeric($telefono) && preg_match("/[0-9]/", $telefono)) { //Validar campo teléfono.
			$telefono_validado = true;
			//echo "El teléfono es válido";
		
			} else {
				$telefono_validado = false;
				$errores['telefono'] = "*El telefono no es válido*";	
			}
		
		if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) { //Validar campo email.
			$email_validado = true;
			//echo "El email es válido";
		
			} else {
				$email_validado = false;
				$errores['email'] = "*El email no es válido*";	
			}
			
		if (!empty($contrasena)) { //Validar campo contraseña
			$contrasena_validado = true;
			//echo "La contraseña es válida";
		
			} else {
				$contrasena_validado = false;
				$errores['contrasena'] = "*La contraseña está vacía*";	
			}
				
	
		//Comprobación de errores
		
		$guardar_usuario = false;
		
		if (count($errores) == 0) {
			
			$guardar_usuario = true;
				
		//Insertar User en la tabla de USERS de la BBDD
		
		$conecta = crearConexion();
		$consulta = "INSERT INTO users VALUES(null, '$nombre', '$cumpleanos', '$direccion', '$codigo_postal',
				'$ciudad', '$telefono', '$email', '$contrasena')";
		
		$guardar = mysqli_query($conecta, $consulta);
		
		
			if ($guardar) {
				
				$_SESSION['completado'] = "El registrado se ha completado con éxito";
					
					echo "El registro se ha completado con éxito";
							
	
			} else {
				
				$_SESSION['errores']['general'] = "Fallo al guardar el usuario";
					
					echo "Fallo al registrar el usuario";
			}
			
		} else {
			$_SESSION['errores'] = $errores;
				
				header('Location: ../models/registro.php');
		}
		
	}
	
	
?>

	</div>
	
	</body>

</html>