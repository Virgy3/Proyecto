<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de editar perfil de usuario</title>
	<link rel="stylesheet" type="text/css" href="../views/perfilUser.css">
</head>

	<body>
	
<?php
	
	include "../controllers/sesionController.php";

	if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id_user'])) {
    // Redirige al usuario al login si no está definido o es null
		header('Location: ../models/sesion.php');
		exit;
	}

		$usuario = $_SESSION['usuario'];

?>
	
	<fieldset>
	<!-- Formulario para que el User registrado actualice sus datos personales -->
		<form method="POST" action="../controllers/guardarCambiosPerfil.php">
			<p>Nombre: <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"></p>
			<p>Dirección: <input type="text" name="direccion" value="<?php echo $usuario['direccion']; ?>"></p>
			<p>Código Postal: <input type="text" name="codigo_postal" value="<?php echo $usuario['codigo_postal']; ?>"></p>
			<p>Ciudad: <input type="text" name="ciudad" value="<?php echo $usuario['ciudad']; ?>"></p>
			<p>Teléfono: <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>"></p>
			<p>Email: <input type="email" name="email" value="<?php echo $usuario['email']; ?>"></p>
			<input type="hidden" name="id_user" value="<?php echo $usuario['id_user']; ?>">
			<input type="submit" value="Guardar Cambios">
		</form>
	</fieldset>
	
	<br><br><a href="../models/users.php" class="button-link">Volver</a><br><br>

	</body>
	
</html>