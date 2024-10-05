<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pago con éxito</title>
	<link rel="stylesheet" type="text/css" href="../views/pago.css">
	
</head>

<body>
	
<?php
	
	include "../controllers/sesionController.php"; //Manejo de sesiones y llamadas a funciones varias

// Hay que iniciar la sesión correctamente y ser registrado
if (!isset($_SESSION['valor']) || $_SESSION['valor'] != 'registrado') {
    header('Location: ../models/sesion.php'); //Te redirecciona al formulario para que inicies sesión si no lo has hecho
    exit;
}

	$conecta = crearConexion(); //Se crea la conexión a la BBDD

	//Se pasan todos estos parámetros de la BBDD
	if (isset($_POST['id_producto'], $_POST['cantidad'], $_POST['precio'], $_SESSION['usuario']['id_user'])) {
    
	$id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $precioTotalConIVA = $_POST['precio'];
    $id_user = $_SESSION['usuario']['id_user'];

    //A continuación va la lógica para insertar la factura, restar el stock, y registrar la venta.
	
	  //Intenta restar el stock y procede solo si hay éxito.
        if (restaStock($conecta, $id_producto, $cantidad)) {
            //Inserta la factura
            $stmt = $conecta->prepare("INSERT INTO facturas (id_user, fecha) VALUES (?, CURDATE())");
            $stmt->bind_param("i", $id_user);
            
			if ($stmt->execute()) {
                $id_factura = $conecta->insert_id;
                
                //Inserta en ventas, incluyendo el precio total con IVA
                $stmt = $conecta->prepare("INSERT INTO ventas (id_factura, id_producto, cantidad, precio_total) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $id_factura, $id_producto, $cantidad, $precioTotalConIVA);
                
				if ($stmt->execute()) {
                    echo "<p class='message-exito'>¡Gracias por tu compra! Tu pago ha sido procesado con éxito. 
					En breves recibirás un e-mail con los detalles de tu compra.</p>"; //Imprime mensaje de éxito
                } else {
                    echo "<p class='message-fallo'>Error al insertar factura: " . $conecta->error . "</p>"; //Imprime mensaje de error
                }
					$stmt->close();
           
        } 
		
    } else {
        echo "<p class='message-noti'>No se puede hacer la transacción. ¡Sentimos las molestias!</p>"; //Imprime mensaje de error si no hay stock
    }
}
		
?>

	<a href="../views/index.php" class="boton">Volver al inicio</a>
  
	
</body>
	
</html>


