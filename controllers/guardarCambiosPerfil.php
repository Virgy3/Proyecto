
<?php

include "../controllers/sesionController.php";  // Manejo de la sesión y la conexión a la BBDD

if (!isset($_SESSION['usuario'])) {
    // Redirecciona al usuario a iniciar sesión si no está logueado
    header('Location: ../models/sesion.php');
    exit;
}

	$id_user = $_SESSION['usuario']['id_user']; //Se almacena el id del usuario en la sesión


// Recoger los nuevos valores
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$codigo_postal = $_POST['codigo_postal'];
	$ciudad = $_POST['ciudad'];
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];
	
	$conecta = crearConexion();

// Preparar la consulta SQL para actualizar los datos
$stmt = $conecta->prepare("UPDATE users SET nombre=?, direccion=?, codigo_postal=?, ciudad=?, telefono=?, email=? WHERE id_user=?");
$stmt->bind_param("ssssssi", $nombre, $direccion, $codigo_postal, $ciudad, $telefono, $email, $id_user);

if ($stmt->execute()) {
	
	$_SESSION['usuario']['nombre'] = $nombre;
	$_SESSION['usuario']['direccion'] = $direccion;
	$_SESSION['usuario']['codigo_postal'] = $codigo_postal;
	$_SESSION['usuario']['ciudad'] = $ciudad;
	$_SESSION['usuario']['telefono'] = $telefono;
	$_SESSION['usuario']['email'] = $email;
	
    // Redirigir al usuario a su perfil con un mensaje de éxito
    header('Location: ../models/users.php?actualizacion=exito');
} else {
    // Manejar el error
    echo "Error al actualizar los datos: " . $conecta->error;
}

$stmt->close();

?>