<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Buscar producto</title>
	<link rel="stylesheet" type="text/css" href="../views/pago.css">
	
</head>

<body>
		<div class='message-container'>	

<?php

	include '../models/conexion.php'; //Incluye el archivo de conexión a la base de datos

	$busqueda = $_GET['busqueda'] ?? ''; //Obtén el término de búsqueda del formulario a través del método GET y ?? es para manejar un término null

		if (!empty($busqueda)) { //Verifica que la variable "búsqueda" no esté vacia
			
			$conecta = crearConexion(); //Crear conexión a la BBDD
			$stmt = $conecta->prepare("SELECT id_producto FROM productos WHERE nombre LIKE ? LIMIT 1"); //Busca solo un producto que coincida
			$busquedaParam = "%$busqueda%"; //Agrega comodines para la cláusula LIKE
			$stmt->bind_param("s", $busquedaParam); //Vincula la variable y "s" es un string
			$stmt->execute(); //Ejecuta la declaración preparada
			$resultado = $stmt->get_result(); //Obtiene resultado 

		if ($fila = $resultado->fetch_assoc()) { //Verifica si hay al menos una fila en el resultado
        
		//Si encuentra el producto, redirige a la página de compra de ese producto
			header("Location: ../views/productoUnitario.html?id_producto=".$fila['id_producto']);
			exit();
		} else {
			
		//Si no encuentra el producto, muestra un mensaje
        echo "<div class='message-container'><p class='message-alert'>No se encontraron productos con ese nombre.</p></div>";
		}

		$stmt->close(); //Cierra la declaración preparada
		} else {
		
		// Si la búsqueda está vacía, muestra un mensaje
		echo "<div class='message-container'><p class='message-info'>Por favor, ingrese un término de búsqueda.</p></div>";
	}

?>
	
		<a href='../views/index.php' class="boton2">Volver al inicio</a>
	</div>
	
</body>

</html>