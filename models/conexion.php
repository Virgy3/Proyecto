<?php

	function crearConexion() { //Definimos esta función para crear la conexión con la base de datos
		
//Variables para la conexión

		$host = "127.0.0.1:3308"; //Cambiar a "localhost" en el caso de que la BBDD esté en otro lugar
		$user = "root"; //Usuario administrador principal
		$pass = ""; //Sin contraseña
		$baseDatos = "castillo_juegos"; //Nombre de la base de datos de nuestro proyecto con la que vamos a conectar
		
//A continuación se usa la función "mysqli_connect" para conectar en la BBDD y el resultado se almacena en la variable $conexion
		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);
		
//Manejo de errores en caso de fallo de conexión
		
		if (!$conexion){
			
		//Utilizado para imprimir un mensaje de error y terminar la ejecución del script
				die("Conexion fallida: " . mysqli_connect_error());
		}
		
		return $conexion; //Si la conexión es exitosa, la función devuelve la conexión a la BBDD	
	}
	
//Función para cerrar la conexión con la base de datos
	function cerrarConexion($conexion) {
		
			mysqli_close($conexion); //Se cierra la conexión a la base de datos
	}
	
//Iniciar sesión

	session_start();

?>