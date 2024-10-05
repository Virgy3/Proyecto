
<?php

	include "../controllers/sesionController.php"; //Manejo de sesiones y llamadas a funciones varias
	
	if (isset($_POST['comprar']) && isset($_SESSION['valor']) == 'registrado') { //Usuario con valor registrado puede comprar
    
	$conecta = crearConexion(); //Crear conexión con la BBDD
	
	if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
   //Datos del usuario registrado que se recogen en su inicio de sesión para completar el form de compra
    $usuario = [
        'nombre' => '',
        'direccion' => '',
        'codigo_postal' => '',
        'ciudad' => '',
        'telefono' => '',
        'email' => ''
    ]; // Asignar valores vacíos que se rellenarán
}
	
	}
	
	//Obtener valores del formulario
	$id_producto = $_POST['id_producto'];
	$precio = $_POST['precio'];
	$cantidad = $_POST['cantidad']; 
	
	$datosProducto = mysqli_fetch_array(getProducto($id_producto)); //Viene de la bbdd
	
 // Asumiendo que $usuario['id_user'] almacena el ID del usuario logueado
    if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id_user'])) {
        $id_user = $_SESSION['usuario']['id_user'];
        $usuario = $_SESSION['usuario'];
		
// Captura los valores enviados desde el formulario
	$id_producto = $_POST['id_producto'];
	$cantidad = $_POST['cantidad'];
	$precioTotalConIVA = $_POST['precio']; // Este valor ya incluye el IVA

	}

?>

<?php	if (isset($_POST['comprar']) && isset($_SESSION['valor']) == 'registrado') {

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Página de Compra y Pago</title>
	<link rel="stylesheet" type="text/css" href="../views/pago.css">

</head>

	<body>
	
	<form action="../controllers/confirmPago.php" method="POST">
	
	 <div class="container-flex">
		<fieldset>
		
			<h2 class="encabezado">Datos del comprador</h2><br>
		<!-- Formulario de pago con los datos que se obtienen de la sesión del usuario registrado -->	
			<p><input type="hidden" name="id_user" value="<?php echo $usuario['id_user']; ?>"></p>
			<p>Nombre y apellidos: <input type="text" name="nombre" value="<?php echo ($usuario['nombre']); ?>"readonly></p>
			<p>Dirección: <input type="text" name="direccion" value="<?php echo ($usuario['direccion']); ?>"readonly></p>
			<p>Código postal: <input type="text" name="codigo" value="<?php echo ($usuario['codigo_postal']); ?>"readonly></p>
			<p>Ciudad: <input type="text" name="ciudad" value="<?php echo ($usuario['ciudad']); ?>"readonly></p>
			<p>Teléfono: <input type="text" name="telefono" value="<?php echo ($usuario['telefono']); ?>"readonly></p>
			<p>Email: <input type="text" name="email" value="<?php echo ($usuario['email']); ?>"readonly></p>
	
			<!-- Campo oculto para enviar el ID del producto -->
			<p><input type="hidden" name="id_producto" value="<?php echo $datosProducto["id_producto"]; ?>"readonly></p>
			<!-- Campos para el nombre, coste y precio del producto -->
			<p><label>Producto: </label><input type="text" name="nombre" value="<?php echo $datosProducto['nombre']; ?>"readonly></p>
			<p><label>Cantidad: </label><input type="number" name="cantidad" value="<?php echo ($cantidad); ?>"readonly></p>
			<p><label>Precio: </label><input type="text" name="precio" value="<?php echo ($precio); ?>"readonly></p>
			
		</fieldset>
		
		<fieldset>
			<h2 class="encabezado">Pago</h2><br>
			<!-- Método de pago -->
			<label>Selecciona un método de pago para realizar tu compra: </label><br><br>
			
			<div class="imagen-pago">
				<div class="payment-option">
					<input type="radio" name="pago" value="Visa"><img src="../img/visaLogo.png" alt="Visa"><br>
				</div>
				<div class="payment-option">
					<input type="radio" name="pago" value="Mastercard"><img src="../img/masterLogo.png" alt="Mastercard"><br>
				</div>	
				<div class="payment-option">
					<input type="radio" name="pago" value="Paypal"><img src="../img/paypalLogo.png" alt="Paypal"><br>
				</div>	
				<div class="payment-option">
					<input type="radio" name="pago" value="Bizum"><img src="../img/bizumLogo.jpg" alt="Bizum"><br>
				</div>	
			</div>
		
				<p><input type="checkbox" name="compra" value="aceptaCompra"> <b>Acepto las condiciones de compra</b></p><br>
			
					<input class="boton" type="submit" name="enviar" value="Proceder al pago"><br><br>
					
					<button><a href="../views/index.php">Volver al inicio</a></button>
					
			</form>
			
		</fieldset>
	
	</body>
	
</html>

<?php
    
} else {
    
	header('Location: ../models/sesion.php'); //Si el usuario no está registrado te manda al formulario de inicio de sesión para poder comprar
	exit;
}

?>