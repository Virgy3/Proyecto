/* Función Slider o carrusel de imágenes */

var contador = 1;

setInterval(function(){ //Establece intervalos que ejecuta la función cada 5 seg (5000 milisegundos).
	
	document.getElementById('radio' + contador).checked = true; //Obtiene el elemento del botón con elemento id "radio1"
	
	contador++; //Incrementa en uno el valor para pasar a la siguiente imagen.
	
	if(contador > 4){ //Si supera 4 de las 4 imagenes que hay, reinicia el contador de imágenes.
		contador = 1;
	}
	
}, 5000); //Tiempo en milisegundos (5 seg).
		