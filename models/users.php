<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Users</title>
	<link rel="stylesheet" type="text/css" href="../views/perfilUser.css">

</head>
<body>

<?php

	include "../controllers/sesionController.php"; // Se incluye este archivo que contiene lo referente a manejo de sesiones

// 	Comprueba si el usuario no está logueado o si el tipo de usuario no corresponde a "superadmin".
		if (!isset($_SESSION['valor']) || ($_SESSION['valor'] != "registrado")) {
			// Si el tipo de usuario no es "registrado", muestra un mensaje de falta de permisos.
			header('Location: ../models/sesion.php');
			exit; // Detiene la ejecución del script para evitar que se muestre contenido no autorizado.
		}
		
?>

	<h2>Perfil del USUARIO</h2>
	
	<h3>"Tus datos personales"</h3>
	
<?php	

	$conecta = crearConexion(); //Establece la conexión con la BBDD
	
	if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
	} else {
		//Se buscan en la BBDD los datos del usuario que ha iniciado sesión 
  
    $usuario = [
        'nombre' => '',
        'direccion' => '',
        'codigo_postal' => '',
        'ciudad' => '',
        'telefono' => '',
        'email' => ''
    ]; // Asignar valores vacíos 
}

	if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id_user'])) {
		$id_user = $_SESSION['usuario']['id_user'];
		$usuario = $_SESSION['usuario'];
}
	
?>	
		<fieldset>
			<p><input type="hidden" name="id_user" value="id_user"></p>
			<p>Nombre y apellidos: <input type="text" name="nombre" value="<?php echo ($usuario['nombre']); ?>"readonly></p>
			<p>Dirección: <input type="text" name="direccion" value="<?php echo ($usuario['direccion']); ?>"readonly></p>
			<p>Código postal: <input type="text" name="codigo" value="<?php echo ($usuario['codigo_postal']); ?>"readonly></p>
			<p>Ciudad: <input type="text" name="ciudad" value="<?php echo ($usuario['ciudad']); ?>"readonly></p>
			<p>Teléfono: <input type="text" name="telefono" value="<?php echo ($usuario['telefono']); ?>"readonly></p>
			<p>Email: <input type="text" name="email" value="<?php echo ($usuario['email']); ?>"readonly></p>
		</fieldset>
		<!-- Botón Editar que dirige al formulario de edición -->
			<br><a href="../controllers/editarPerfil.php" class="button-link">Editar Perfil</a><br>


			<br><h3>"Historial de Compras" </h3>
	
	
		<?php historial($id_user); ?> <!-- Llama a la función de historial para mostrarla en pantalla -->

			<br><a href="../views/index.php" class="button-link">Volver al inicio</a><br>
			<br><a href="../controllers/logout.php"><input class="button-link" type="submit" value="Cerrar sesión"></a><br><br>
	
</body>

</html>

