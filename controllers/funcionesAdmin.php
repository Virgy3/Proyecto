<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Users</title>
	<link rel="stylesheet" type="text/css" href="../views/perfilAdmin.css">

</head>
<body>

<?php 

	function pintaTablaUsuarios(){ 
		
		//Se obtiene la lista de usuarios utilizando la función "getListaUsuarios()".
		
		$listaUsuarios = getListaUsuarios();
		
		//Se imprime el comienzo de la tabla HTML.
		echo "<table>\n

				<tr>\n 
					
					<th>ID</th>\n 
					<th>nombre</th>\n 
					<th>cumpleanos</th>\n
					<th>direccion</th>\n 
					<th>codigo_postal</th>\n 
					<th>ciudad</th>\n
					<th>telefono</th>\n 
					<th>email</th>\n 
					<th>contrasena</th>\n
					<th>Accion</th>\n
				
				</tr>\n";
		
		//Se inicia un bucle while para recorrer las filas de resultados obtenidas de la lista de usuarios.
		while ($fila = mysqli_fetch_assoc($listaUsuarios)) {
		
		//Se imprime una fila de la tabla para cada user
		
		echo "<tr>\n";
		
		echo "<td>" . $fila['id_user'] . "</td>\n";
		echo "<td>" . $fila['nombre'] . "</td>\n";
		echo "<td>" . $fila['cumpleanos'] . "</td>\n";
		echo "<td>" . $fila['direccion'] . "</td>\n";
		echo "<td>" . $fila['codigo_postal'] . "</td>\n";
		echo "<td>" . $fila['ciudad'] . "</td>\n";
		echo "<td>" . $fila['telefono'] . "</td>\n";
		echo "<td>" . $fila['email'] . "</td>\n";
		echo "<td>" . $fila['contrasena'] . "</td>\n";
		
		echo "<td><a href='../models/adminManager.php?id_user=" . $fila['id_user'] . "'>Borrar</a></td>\n";
				
		echo "</tr>\n";
		}
		
		//Se imprime el final de la tabla HTML.
		echo "</table>\n";
	}

	function pintaProductos($orden) { //Hecho
		
		//Se obtienen los productos ordenados según el parámetro recibido.
		$productos = getProductos($orden);
		
		//Se imprime el comienzo de la tabla HTML con encabezados de columna y enlaces para ordenar.
		echo "<table>\n 
		
				<tr>\n 
					
					<th><a href='../models/adminManager.php?orden=id_producto'>ID</a></th>\n 
					<th><a href='../models/adminManager.php?orden=nombre'>Nombre</a></th>\n
					<th><a href='../models/adminManager.php?orden=descripcion'>Descripción</a></th>\n
					<th><a href='../models/adminManager.php?orden=precio'>Precio</a></th>\n
					<th><a href='../models/adminManager.php?orden=id_categoria'>Categoria</a></th>\n
					<th><a href='../models/adminManager.php?orden=nombreProveedor'>Proveedor</a></th>\n
					<th><a href='../models/adminManager.php?orden=stock'>Stock</a></th>\n
					<th>Acciones</th>
					
				</tr>\n";
				
		//Se inicia un bucle while para recorrer las filas de resultados obtenidas de la lista de productos.	
		while ($fila = mysqli_fetch_assoc($productos)) {
			
			//Se imprime una fila de la tabla HTML con información sobre el producto.
			echo "<tr>\n 
			
					<td>" . $fila['id_producto'] . "</td>\n 
					<td>" . $fila['nombre'] . "</td>\n
					<td>" . $fila['descripcion'] . "</td>\n
					<td>" . $fila['precio'] . "</td>\n
					<td>" . $fila['id_categoria'] . "</td>\n
					<td>" . $fila['nombreProveedor'] . "</td>\n
					<td>" . $fila['stock'] . "</td>\n";
					 //Va imprimiendo una fila de la tabla con información sobre el producto.
				
				//Se imprime la columna de acciones con enlaces para editar y borrar productos.
				echo "<td><a href='../controllers/adminProductos.php?Editar=" . $fila['id_producto'] . "'>Editar</a> - <a href=
				'../controllers/adminProductos.php?Borrar=" . $fila['id_producto'] . "'>Borrar</a></td>";
			
			//Se cierra la fila de la tabla HTML.
			echo "</tr>\n";
		}
		
		//Se imprime el final de la tabla HTML.
		echo "</table>";
								
	}
	
	
	function pintaCategorias($defecto) {
		
		//Se obtienen las categorías de la base de datos utilizando la función getCategorias().
		$categorias = getCategorias();
		
		//Se inicia un bucle while para recorrer las filas de resultados obtenidas de las categorías.
		while($fila = mysqli_fetch_assoc($categorias)) {
			
			
			 // Se verifica si el id_categoria de la fila es igual al valor por defecto proporcionado.
        $selected = ($fila["id_categoria"] == $defecto) ? ' selected' : '';
        
        // Imprime una opción en el elemento <select>, mostrando solo el id_categoria.
        echo "<option value='" . $fila["id_categoria"] . "'" . $selected . ">" . $fila["id_categoria"] . "</option>";
    }
}
			
			
		function pintaProveedores($defecto) {
			
			$proveedores = getProveedor(); //Se obtienen los datos de la BBDD de los proveedores
		
			if ($proveedores) {
			
			while($fila = mysqli_fetch_assoc($proveedores)) {
            
			$selected = ($fila["id_proveedor"] == $defecto) ? 'selected' : '';
            
			echo "<option value='" . $fila["id_proveedor"] . "' $selected>" . $fila["nombre"] . "</option>";
        }
    }
}

?>

</body>

</html>
