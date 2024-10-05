<?php

	session_start(); //Se inicia la sesión

	$mensaje = ""; // Inicializa $mensaje

	if(isset($_SESSION['valor'])) {
		
		if($_SESSION['valor'] == 'superadmin') {
        $mensaje = "El Admin ha cerrado sesión correctamente"; //El administrador cierra la sesión correctamente
		
    } elseif ($_SESSION['valor'] == 'registrado') {
        $mensaje = "El usuario registrado ha cerrado sesión correctamente"; //El user registrado cierra su sesión correctamente
    }
    
    session_destroy(); //Se destruye la sesión 
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="../views/formularios.css">
</head>
<body>

	<div class="contenedor-sesion">
		<h3>Cerrar Sesión</h3>
    
			<p class="mensaje-sesion"><?php echo $mensaje; ?></p> 
    
			<br><br><a href="../views/index.php">Volver al inicio</a><br><br>
	
	</div>

</body>
</html>


