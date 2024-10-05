<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../views/perfilAdmin.css">

</head>
<body>

<?php
	
	include "../controllers/sesionController.php"; // Se incluye archivos que contiene lo referente a manejo de sesiones
	include "../controllers/funcionesAdmin.php";
	
// Comprueba si el usuario no está logueado o si el tipo de usuario no corresponde a "superadmin".
	if (!isset($_SESSION['valor']) || ($_SESSION['valor'] != "superadmin")) {
		// Si el tipo de usuario no es "superadmin", muestra un mensaje de falta de permisos.
		echo "No tienes permiso para estar aquí.";
		exit; // Detiene la ejecución del script para evitar que se muestre contenido no autorizado.
	}

?>

	<h1>Perfil del Administrador</h1><br>
	
	<a href="../views/index.php" class="button-link">Volver al inicio</a><br><br>
	<a href="../controllers/logout.php" class="button-link">Cerrar Sesión</a><br><br>
	
	<h3><u>"Tabla de Users Registrados"</b></u></h3>
	
<?php


		//Llama a la función pintaTablaUsuarios() para mostrar una tabla con información de usuarios.
		pintaTablaUsuarios();
		
		//Llama a la función para borrar el User
		if (isset($_GET['id_user'])) {
			$id_user = $_GET['id_user'];
		
		//Se devuelve true si el borrado fue exitoso y false en caso contrario
		if(borrarUser($id_user)) {
			header("Location: ../models/adminManager.php?mensaje=User borrado con éxito"); //Aparece ese mensaje
		
		} else {
			header("Location: ../models/adminManager.php?mensaje=User borrado con éxito");
    }
}

		
?>
	
	<br><b><u><h3>"Tabla de Productos Registrados"</b></h3></u><br>
			 
<?php

		/* Se verifica si no se ha proporcionado un parámetro "orden" en la URL. Si no se ha proporcionado establece el valor */
	
			if (!isset($_GET["orden"])) {
				$orden = "id_producto";
		//De lo contrario toma el valor proporcionado en la URL		
			} else {
				$orden = $_GET["orden"];
			}
			
			echo "<a href='../controllers/adminProductos.php?Anadir'>Añadir producto</a><br><br>";

				pintaProductos($orden); //Llama a la función que pinta la tabla de los productos según el orden establecido.
	
?>	

	<br><br><a href="../views/index.php" class="button-link">Volver al inicio</a><br><br>
	
</body>

</html>
