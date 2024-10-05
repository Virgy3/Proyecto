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

	include "../controllers/sesionController.php"; //Se incluye este archivo que contiene lo referente a manejo de sesiones

?>

	<div class="contenedor1"
		<p> ¿No tienes cuenta? <a href="../models/registro.php">Regístrate </a></p>
	
<!-- Formulario HTML donde vamos a introducir el nombre de correo electrónico y la contraseña para validar -->	
	<form action="sesion.php" method="POST">
	
		<p><label for="email">Email: </label><input type="email" name="email"></p>
		<p><label for="contrasena">Contraseña: </label><input type="password" name="contrasena"></p>
		<p><input type="submit" name="Entrar"></p>
		
		<a href="../views/index.php">Volver al inicio</a></p>
	
	</form>

<?php
	
		if (isset($_POST['Entrar'])) { //Se verifica si se ha enviado el formulario (si se ha hecho click en el botón "Entrar")
			$email = $_POST['email']; //Se obtiene el valor ingresado en el campo email
			$contrasena = $_POST['contrasena']; //Se obtiene el valor ingresado en el campo contraseña
			$tipoUser = tipoUser($email, $contrasena); //Se llama a la función TipoUser para determinar el tipo de usuario
			
	
	$conecta = crearConexion();
	
	// Preparar la consulta SQL para obtener los datos del usuario
	$stmt = $conecta->prepare("SELECT id_user, nombre, direccion, codigo_postal, ciudad, telefono, email FROM users WHERE email = ?");
	$stmt->bind_param("s", $email); // "s" indica que el parámetro es un string
	$stmt->execute();
	$resultado = $stmt->get_result();

		if ($fila = $resultado->fetch_assoc()) {
			// Almacenar los datos del usuario en $_SESSION
			$_SESSION['usuario'] = $fila;
   
		} else {
			echo "Usuario no encontrado";
		}
	$stmt->close();
		
						
			$_SESSION['valor'] = $tipoUser; // Almacenamiento del tipo de usuario en la sesión
		
			
			if($tipoUser == 'superadmin') {
	
				echo "<div class='mensaje-admin'>¡Bienvenida Virginia! Pulsa <a href='adminManager.php'> AQUÍ </a> para entrar en tu perfil de Admin.</div>";
				
			
			} else if ($tipoUser == 'registrado') { //Si el usuario está 'registrado' en el sistema
	
				
				echo "<div class='mensaje-usuario'>¡Bienvenido! Pulsa <a href='users.php'> AQUÍ </a> para entrar en tu perfil de cliente.</div>";
			
				
			} else if ($tipoUser == 'no registrado') { //Si el usuario no está registrado en el sistema
				
				echo "<div class='mensaje-error'>Este usuario no está registrado en el sistema, puedes registrarte <a href='registro.php'> AQUÍ </a></div>";
			} 
		}
		
?>
	
	</div>
</body>
</html>