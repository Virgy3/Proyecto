<?php

/* Funciones para controlar errores en el formulario de registro */

	function mostrarError($errores, $campo) { 
		
		$alerta = '';
		
		if(isset($errores[$campo]) && !empty($campo)) {
			$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
		}
		
		return $alerta; //Muestra los errores por pantalla del formulario de registro
	}


	function borrarErrores() {
		
		$borrado = false; //Indica si se ha realizado una limpieza de la sesión
		
		
		if(isset($_SESSION['errores'])) {
			$_SESSION['errores'] = null;
			$borrado = session_unset();
			
		}
		
		if(isset($_SESSION['completado'])) {
			$_SESSION['completado'] = null;
			session_unset();
			
		}
		
		return $borrado;
	}

?>