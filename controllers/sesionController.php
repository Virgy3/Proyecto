<?php

	include "../models/conexion.php"; //Se incluye aquí el contenido del archivo "conexion.php" para conectar con la BBDD
	
/* Función que nos determina el tipo de usuario basándose en el email y contraseña proporcionada. Devuelve un valor indicando
el tipo de usuario "superadmin", "registrado" o "no registrado". */

	function tipoUser($email, $contrasena) {
		$conecta = crearConexion(); //Se crea una conexión a la BBDD utilizando esta función definida en "conexion.php"
		
		if (esSuperadmin($email, $contrasena)) { //Verifica si el usuario con email y contraseña es el "superadmin"
		
			return "superadmin"; //Si lo devuelve es "true"
			
		} else {
			
			//Consulta para obtener datos del usuario en la BBDD
			
			$consulta = "SELECT email, contrasena FROM users WHERE email ='$email' and contrasena = '$contrasena'";
			
			$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la BBDD
			
			cerrarConexion($conecta); //Se cierra la conexión a la base de datos
			
				
				if ($valor = mysqli_fetch_array($resultado)) { //Si se obtienen los resultados de la consulta
					
						return "registrado"; //Si el usuario está registrado en la BBDD, devuelve "registrado"
							
				} else {
					
					return "no registrado"; //Si el usuario no se encuentra en la base de datos, devuelve "no registrado"
				} 
			 
		}
	
	}

	
	function esSuperadmin($email,$contrasena) {
		
		$conecta = crearConexion(); //Se crea la conexión a la base de datos
		
			//Consulta SQL para verificar si el usuario con el email y la contraseña proporcionada es un "superadmin"
			$consulta = "SELECT users.id_user FROM users
						INNER JOIN setup ON users.id_user = setup.SuperAdmin
						WHERE users.email = '$email' and users.contrasena = '$contrasena'";
								
			$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta a la BBDD
			
		cerrarConexion($conecta); //Se cierra la conexion a la BBDD
		
		
		if ($valor = mysqli_fetch_array($resultado)) { //Si se obtienen resultados de la consulta y el valor almacenado de la "cookie"
		
			return true; //Si el usuario es un "superadmin" devuelve true
			
		} else {
			
			return false; //Si el usuario no es un "superadmin" devuelve false
		}
	}
	
	function getPermisos() {
		
		$conecta = crearConexion(); //Se crea la conexión a la base de datos
			
		//Consulta SQL para obtener el valor de "Autenticación" de la tabla "setup"
		$consulta = "SELECT Autenticacion FROM setup";
			
		//Se ejecuta la consulta y se obtiene el resultado como un array asociativo
			
		$resultado = mysqli_fetch_assoc(mysqli_query($conecta, $consulta));

		cerrarConexion($conecta); //Cierra la conexión a la base de datos
		
		return $resultado["Autenticacion"]; //Se devuelve el valor de "Autenticación" obtenido de la consulta
			
	}
	
	
	function getListaUsuarios() {
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL para seleccionar los campos de la tabla users.
		$consulta = "SELECT id_user, nombre, cumpleanos, direccion, codigo_postal, ciudad, telefono, email, contrasena FROM users";
		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado

		cerrarConexion($conecta); //Se cierra la conexión a la base de datos
		
		return $resultado; //Se devuelve el resultado de la consulta que puede ser procesado posteriormente en el código que llama a esta función

	}

	
	function getCategorias() {
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL para seleccionar las categorias
		$consulta = "SELECT id_categoria, descripcion FROM categorias";
		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado
		
		cerrarConexion($conecta); //Se cierra la conexión a la base de datos después de ejecutar la consulta
		
		return $resultado; //Se devuelve el resultado de la consulta que puede ser procesado posteriormente en el código que llama a esta función
		
	}
	
	
	function getProveedor() {
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL para seleccionar los datos del proveedor
		$consulta = "SELECT id_proveedor, nombre, direccion, telefono FROM proveedores";
		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado
		
		cerrarConexion($conecta); //Se cierra la conexión a la base de datos después de ejecutar la consulta
		
		return $resultado; //Se devuelve el resultado de la consulta que puede ser procesado posteriormente en el código que llama a esta función
		
	}
	

	function borrarUser($id_user) { 
			
			$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
			//Se construye una consulta SQL para borrar un producto de la tabla
			$consulta = "DELETE FROM users WHERE id_user = $id_user";
		
			$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado
		
			cerrarConexion($conecta); //Se cierra la conexión a la base de datos
		
			return $resultado; //Se devuelve el resultado de la consulta que indica si la eliminación tuvo éxito o no	
	
	}



	function getProducto($id_producto) { 
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL para seleccionar todos los campos de la tabla
		$consulta = "SELECT * FROM productos WHERE id_producto = $id_producto";
		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado

		cerrarConexion($conecta); //Se cierra la conexión a la base de datos
		
		return $resultado; // Se devuelve el resultado de la consulta que puede ser procesado posteriormente en el código que llama a esta función
		
	}


	function getProductos($orden) { 
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL que selecciona campos específicos de las tablas producto y proveedor mediante una operación de JOIN.
		$consulta = "SELECT productos.id_producto, productos.nombre, productos.descripcion, productos.precio, productos.id_categoria,
					proveedores.nombre as nombreProveedor, productos.stock
					FROM productos
					INNER JOIN proveedores
					ON productos.id_proveedor = proveedores.id_proveedor
					ORDER BY $orden"; //La variable $orden se utiliza para determinar el orden de los resultados

		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado
		
		cerrarConexion($conecta); //Se cierra la conexión a la base de datos
		
		return $resultado; //Se devuelve el resultado de la consulta, que puede ser procesado posteriormente en el código que llama a esta función
		
	}


	function anadirProducto($nombre, $descripcion, $precio, $categoria, $proveedor, $stock) {
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL para insertar un nuevo producto en la tabla product
		$consulta = "INSERT INTO productos (nombre, descripcion, precio, id_categoria, id_proveedor, stock) 
						VALUES ('$nombre', '$descripcion', '$precio', '$categoria', '$proveedor', '$stock')";
		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado
		
		cerrarConexion($conecta); //Se cierra la conexión a la base de datos
		
		return $resultado; //Se devuelve el resultado de la consulta
			
	}


	function borrarProducto($id_producto) {
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL para borrar un producto de la tabla productos
		$consulta = "DELETE FROM productos WHERE id_producto = $id_producto";
		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado
		
		cerrarConexion($conecta); //Se cierra la conexión a la base de datos
		
		return $resultado; //Se devuelve el resultado de la consulta que indica si la eliminación tuvo éxito o no.
		
	}


	function editarProducto($id_producto, $nombre, $descripcion, $precio, $categoria, $proveedor, $stock) {
		
		$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"
		
		//Se construye una consulta SQL para actualizar los datos de un producto en la tabla productos
		$consulta = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', 
					id_categoria = '$categoria', id_proveedor = '$proveedor', stock = '$stock' WHERE id_producto = $id_producto";
		
		$resultado = mysqli_query($conecta, $consulta); //Se ejecuta la consulta en la base de datos y se almacena el resultado
		
		cerrarConexion($conecta); //Se cierra la conexión a la base de datos
		
		return $resultado; //Se devuelve el resultado de la consulta que indica si la actualización tuvo éxito o no.
		
	}
	

	function historial($id_user) { //Se le pasa el parámetro de la id de usuario
	
	$conecta = crearConexion(); //Se crea una conexión a la base de datos utilizando esta función definida en "conexion.php"

		//Prepara una consulta SQL para seleccionar los detalles de la factura y producto asociado al user especifico con un JOIN
	    $stmt = $conecta->prepare("SELECT f.fecha, p.nombre, v.cantidad, v.precio_total 
                               FROM facturas f 
                               JOIN ventas v ON f.id_factura = v.id_factura 
                               JOIN productos p ON v.id_producto = p.id_producto 
                               WHERE f.id_user = ? 
                               ORDER BY f.fecha DESC");
    
	$stmt->bind_param("i", $id_user); //Asocia el parámetro "i" es un numero entero.
    $stmt->execute(); //Ejecuta la consulta
    $resultado = $stmt->get_result(); //Se obtiene el resultado de la consulta
    
    // Se pinta el inicio de la tabla HTML para poder mostrar los resultados
    echo "<table>\n
            <tr>\n
                <th>Fecha</th>\n
                <th>Producto</th>\n
                <th>Cantidad</th>\n
                <th>Precio</th>\n
            </tr>\n";

    if($resultado->num_rows > 0) { //Esto verifica si la consulta retornó filas
        while($fila = $resultado->fetch_assoc()) { // Se itera sobre cada fila en un array asociativo
            echo "<tr>\n";
            echo "<td>" . $fila['fecha'] . "</td>\n";
            echo "<td>" . $fila['nombre'] . "</td>\n";
            echo "<td>" . $fila['cantidad'] . "</td>\n";
            echo "<td>€" . $fila['precio_total'] . "</td>\n";
            echo "</tr>\n"; //Imprime la tabla
        }
    } else {
        echo "<tr><td colspan='4'>No se encontraron compras.</td></tr>\n"; //Si no hay filas, se muestra este mensaje
    }
    
    echo "</table>\n"; // Cierra la tabla
    $stmt->close(); //Cierra el objeto statement
    
}


	function restaStock($conecta, $id_producto, $cantidad) {
    
    // Primero, comprobar el stock actual del producto
    $stmt = $conecta->prepare("SELECT stock FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    
    if ($producto) {
        $stockActual = $producto['stock'];
        
        // Comprobar si hay suficiente stock
        if ($cantidad <= $stockActual) {
            // Hay suficiente stock, proceder a actualizar
			
			$nuevoStock = $stockActual - $cantidad;
            $consulta = $conecta->prepare("UPDATE productos SET stock = ? WHERE id_producto = ?"); //Actualiza el nuevo stock de productos
            $consulta->bind_param("ii", $nuevoStock, $id_producto);
            
            if ($consulta->execute()) {


                // Redirigir o mostrar mensaje de éxito
            } else {
                echo "<p class='message-fallo'>Error al actualizar el stock: " . $consulta->error . "</p>";
            }
            
            $consulta->close();
				return true; // Se pudo hacer la operación exitosamente
			
        } else {
            // No hay suficiente stock
            echo "<p class='message-fallo'>No hay suficiente stock para completar tu compra. </p>";
			return false; //No se puede realizar la operación porque falta stock
        }
    } else {
        echo "<p class='message-fallo'>Producto no encontrado. </p>";
		return false; //Esto indica que no se encontró el producto.
    }
    
    $stmt->close(); //Se cierra la conexión
  
}
	
?>
