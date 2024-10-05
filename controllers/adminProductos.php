<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>

	<?php 
	
	
	include "../controllers/sesionController.php"; //Se incluye este archivo que contiene lo referente a manejo de sesiones
	
	include "../controllers/funcionesAdmin.php"; 
	
	
	// Comprueba si el usuario no está logueado o si el tipo de usuario no corresponde a "superadmin".
		if (!isset($_SESSION['valor']) || ($_SESSION['valor'] != "superadmin")) {
			// Si el tipo de usuario no es "superadmin", muestra un mensaje de falta de permisos.
			echo "No tienes permiso para estar aquí.";
			exit; // Detiene la ejecución del script para evitar que se muestre contenido no autorizado.
		}
	
	?>

	<?php
	
		
		//Si se ha enviado el parámetro 'Editar' a través de la URL obtiene los datos del producto a editar.
		if (isset($_GET["Editar"])) {
					
			$datosProducto = mysqli_fetch_array(getProducto($_GET["Editar"]));
				
			//Si se ha enviado el parámetro 'Borrar' a través de la URL obtiene los datos del producto a borrar.
				} else if (isset($_GET["Borrar"])) {
					
					$datosProducto = mysqli_fetch_array(getProducto($_GET["Borrar"]));
				
					} else {
					
					//Si no se ha enviado 'Editar' ni 'Borrar' inicializa los datos del producto con valores predeterminados.
					
					$datosProducto = ["id_producto" => "",
												"nombre" => "",
												"descripcion" => "",
												"precio" => 0,
												"categoria" => "",
												"proveedor" => "",
												"stock" => 0];
						
				}
		
	?>
	
	<!-- Formulario HTML con un conjunto de campos para editar o añadir un producto -->
	
		<form action="../controllers/adminProductos.php" method="GET">
			 <!-- Campo para mostrar el ID del producto (desactivado para que no sea editable) -->
			<p><label>ID: </label><input type="text" value="<?php echo $datosProducto["id_producto"]; ?>" disabled></p>
			<!-- Campo oculto para enviar el ID del producto -->
			<p><input type="hidden" name="id_producto" value="<?php echo $datosProducto["id_producto"]; ?>"></p>
			
			<!-- Campos para el nombre, descripcion , precio del producto, stock categoria y proveedor -->
			<p><label>Nombre: </label><input type="text" name="nombre" value="<?php echo $datosProducto['nombre']; ?>"></p>
			<p><label>Descripcion: </label><input type="text" name="descripcion" value="<?php echo $datosProducto['descripcion']; ?>"></p>
			<p><label>Precio: </label><input type="number" name="precio" value="<?php echo $datosProducto['precio']; ?>"></p>
			<p><label>Stock: </label><input type="number" name="stock" value="<?php echo $datosProducto['stock']; ?>"></p>
	
			<p><label>Categoría: </label>
				<select name="categoria">			
				<?php pintaCategorias($datosProducto['id_categoria']); ?>
				</select></p>
				
			<p><label>Proveedor: </label>
				<select name="proveedor">		
				<?php pintaProveedores($defecto['id_proveedor']); ?>
				</select></p>			
		
		
			<?php
			
				//Determina el valor del botón de acción (Editar, Borrar, Añadir) dependiendo de la situación.
				if (isset($_GET["Editar"])) {
					
					echo "<input type='submit' name='Accion' value='Editar'>";
				
				} else if (isset($_GET["Borrar"])) {
					
					echo "<input type='submit' name='Accion' value='Borrar'>";
					
				} else {
					
					echo "<input type='submit' name='Accion' value='Añadir'>";
				}
			?>
			
			<?php
					//Si se ha enviado una acción (Editar, Borrar, Añadir) realiza la acción correspondiente.
					if (isset($_GET["Accion"])) {
						
						switch ($_GET["Accion"]) {

							case 'Editar':
							
								//Llama a la función "editarProducto" con los datos del formulario y muestra un mensaje de éxito o error.
								
								if (editarProducto($_GET["id_producto"], $_GET["nombre"],  $_GET["descripcion"], $_GET["precio"],  $_GET["categoria"],
									$_GET["proveedor"], $_GET["stock"])) {
									
									echo "Se ha editado el producto.";
								
								} else {
									
									echo "No se ha editado el producto.";
								}
								break;
							
							case 'Borrar':
							
								//Llama a la función "borrarProducto" con el ID del producto y muestra un mensaje de éxito o error.
								
								if (borrarProducto($_GET["id_producto"])) {
									
									echo "Se ha borrado el producto.";
								
								} else {
									
									echo "No se ha borrado el producto.";
								}
								break;
							
							case 'Añadir':
							
								//Llama a la función "anadirProducto" con los datos del formulario y muestra un mensaje de éxito o error.
							
								if (anadirProducto($_GET["nombre"], $_GET["descripcion"], $_GET["precio"], $_GET["categoria"], 
									$_GET["proveedor"], $_GET["stock"])) {
									
									echo "Se ha añadido el producto.";
								
								} else {
									
									echo "No se ha añadido el producto.";
								}
								break;
						}
					}
						
				?>				
								
				<a href="../models/adminManager.php">Volver</a>
		</form>
								
</body>
</html>