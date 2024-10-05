
let mainImage = document.getElementById("mainImage"); //Selecciona la imagen principal 
let smallImage = document.getElementsByClassName("image"); //Selecciona las imágenes más pequeñas
	
	smallImage[0].onclick = () =>{
		mainImage.src = smallImage[0].src; //Al hacer click selecciona o una u otra de las imágenes
	}
	smallImage[1].onclick = () =>{
		mainImage.src = smallImage[1].src;
	}


//Variable de los productos

const productos = { //Detalles de cada producto, el número es su id de producto
    1: {
        nombre: "Colonos de Catán",
        precio: 30.99,
        descripcion: "Descripción: Juego de mesa de estrategia donde los jugadores tratan de colonizar una isla, negociando recursos y construyendo asentamientos",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/catan00.jpg", "../img/boardgames/catan01.jpg"]
    },
    2: {
        nombre: "Aventureros al Tren",
        precio: 35.50,
        descripcion: "Descripción: Juego de mesa de aventura donde los jugadores construyen rutas de ferrocarril a través de Norteamérica para completar objetivos y ganar puntos",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/aventureros00.jpg", "../img/boardgames/aventureros01.jpg"]
    },
   
	 3: {
        nombre: "Pandemic",
        precio: 29.99,
        descripcion: "Descripción: Juego de mesa cooperativo donde los jugadores trabajan juntos para detener la propagación de enfermedades mortales en todo el mundo",
		categoria: "Categoría: Cartas",
        imagenes: ["../img/boardgames/pandemic00.jpg", "../img/boardgames/pandemic01.jpg"]
    },
	
	 4: {
        nombre: "Risk",
        precio: 24.75,
        descripcion: "Descripción: Juego de mesa de estrategia de guerra donde los jugadores compiten por el dominio global, conquistando territorios y eliminando oponentes",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/risk00.jpg", "../img/boardgames/risk01.jpg"]
    },
	
	 5: {
        nombre: "Scrabble",
        precio: 19.99,
        descripcion: "Descripción: Juego de mesa de palabras donde los jugadores forman palabras cruzadas en un tablero utilizando fichas de letras con valores de puntuación",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/scrabble00.jpg", "../img/boardgames/scrabble01.jpg"]
    },
	
	 6: {
        nombre: "Dominion",
        precio: 34.99,
        descripcion: "Descripción: Juego de mesa de construcción de mazos donde los jugadores compiten por construir el mejor reino",
		categoria: "Categoría: Cartas",
        imagenes: ["../img/boardgames/dominion00.jpg", "../img/boardgames/dominion01.jpg"]
    },
	
	 7: {
        nombre: "Carcassonne",
        precio: 27.50,
        descripcion: "Descripción: Juego de mesa de colocación de losetas donde los jugadores construyen un paisaje medieval con ciudades, caminos y campos",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/carcassonne00.jpg", "../img/boardgames/carcassonne01.jpg"]
    },
	
	 8: {
        nombre: "Puerto Rico",
        precio: 39.95,
        descripcion: "Descripción: Juego de mesa de estrategia económica donde los jugadores desarrollan plantaciones, construyen edificios y envían mercancías en la época colonial",
		categoria: "Categoría: Dados",
        imagenes: ["../img/boardgames/puertorico00.jpg", "../img/boardgames/puertorico01.jpg"]
    },
	
	 9: {
        nombre: "7 Wonders",
        precio: 31.75,
        descripcion: "Descripción: Juego de mesa de civilizaciones donde los jugadores construyen maravillas, desarrollan tecnologías y gestionan recursos para construir la mejor civilización",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/7wonders00.jpg", "../img/boardgames/7wonders01.jpg"]
    },
	
	 10: {
        nombre: "Agricola",
        precio: 37.99,
        descripcion: "Descripción: Juego de mesa de agricultura donde los jugadores gestionan una granja, crían animales, cultivan cultivos y mejoran su hogar",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/agricola00.jpg", "../img/boardgames/agricola01.jpg"]
    },
	
	 11: {
        nombre: "Twilight Struggle",
        precio: 45.00,
        descripcion: "Descripción: Juego de mesa de simulación de la Guerra Fría donde los jugadores controlan las superpotencias y compiten por la influencia mundial",
		categoria: "Categoría: Cartas",
        imagenes: ["../img/boardgames/twilight00.jpg", "../img/boardgames/twilight01.jpg"]
    },
	
	 12: {
        nombre: "Codenames",
        precio: 20.50,
        descripcion: "Descripción: Juego de mesa de palabras y deducción donde los jugadores tratan de identificar a sus agentes secretos utilizando pistas dadas por un jefe de equipo",
		categoria: "Categoría: Cartas",
        imagenes: ["../img/boardgames/codenames00.jpg", "../img/boardgames/codenames01.jpg"]
    },
	
	 13: {
        nombre: "Terraforming Mars",
        precio: 42.25,
        descripcion: "Descripción: Juego de mesa de gestión de recursos donde los jugadores compiten por terraformar Marte, desarrollando infraestructura y colonizando el planeta",
		categoria: "Categoría: Tablero",
        imagenes: ["../img/boardgames/terraforming00.jpg", "../img/boardgames/terraforming01.jpg"]
    },
	
	 14: {
        nombre: "Splendor",
        precio: 28.99,
        descripcion: "Descripción: Juego de mesa de estrategia donde los jugadores compiten por construir la mejor red comercial de joyas y recursos preciosos",
		categoria: "Categoría: Cartas",
        imagenes: ["../img/boardgames/splendor00.jpg", "../img/boardgames/splendor01.jpg"]
    },
	
	 15: {
        nombre: "Dead of Winter",
        precio: 36.75,
        descripcion: "Descripción: Juego de mesa de supervivencia y traición donde los jugadores luchan por sobrevivir en un apocalipsis zombi mientras enfrentan amenazas internas y externas",
		categoria: "Categoría: Rol",
        imagenes: ["../img/boardgames/dead00.jpg", "../img/boardgames/dead01.jpg"]
    },
	
	 16: {
        nombre: "Dixit",
        precio: 29.99,
        descripcion: "Descripción: Juego de mesa de narración y deducción donde los jugadores intentan adivinar qué carta ha elegido un narrador basándose en sus descripciones",
		categoria: "Categoría: Cartas",
        imagenes: ["../img/boardgames/dixit00.jpg", "../img/boardgames/dixit01.jpg"]
    },
	
	 17: {
        nombre: "Math Bingo",
        precio: 19.99,
        descripcion: "Descripción: Juego de mesa que ayuda a practicar las habilidades matemáticas básicas, como sumar, restar, multiplicar y dividir, de manera divertida y competitiva",
		categoria: "Categoría: Infantil",
        imagenes: ["../img/boardgames/math00.jpg", "../img/boardgames/math01.jpg"]
    },
	
	 18: {
        nombre: "Scrabble Junior",
        precio: 21.50,
        descripcion: "Descripción: Versión simplificada del clásico juego de Scrabble diseñada para niños, ayuda a mejorar la ortografía y el vocabulario",
		categoria: "Categoría: Infantil",
        imagenes: ["../img/boardgames/scrabblejunior00.jpg", "../img/boardgames/scrabblejunior01.jpg"]
    },
	
	 19: {
        nombre: "Uno Moo!",
        precio: 16.75,
        descripcion: "Descripción: Versión adaptada del juego Uno, pero con animales de granja, ayuda a los niños a aprender colores, números y desarrollo de estrategias",
		categoria: "Categoría: Infantil",
        imagenes: ["../img/boardgames/unogranja00.jpg", "../img/boardgames/unogranja01.jpg"]
    },
	
	 20: {
        nombre: "Rush Hour Junior",
        precio: 29.99,
        descripcion: "Descripción: Juego de mesa de rompecabezas que enseña conceptos de lógica y pensamiento crítico a través de la resolución de problemas de tráfico",
		categoria: "Categoría: Infantil",
        imagenes: ["../img/boardgames/rush00.jpg", "../img/boardgames/rush01.jpg"]
    },
	
	 24: {
        nombre: "Dice Force",
        precio: 35.99,
        descripcion: "Descripción: Juego de desarrollo con dados de caras extraíbles",
		categoria: "Categoría: Dados",
        imagenes: ["../img/boardgames/dice00.jpg", "../img/boardgames/dice01.jpg"]
    }
	
};


window.onload = function() { //Al cargar la página inicia funciones
    cargarDetallesProducto(); //Carga los datos de cada producto
    document.getElementById("first").addEventListener('input', actualizarCarrito); //Cuando hay cambios de cantidad actualiza el precio
	getId(); //Extrae la id del producto por la URL
};

function cargarDetallesProducto() { //Obtiene la id del producto desde la URL y actualiza el DOM con los detalles del producto
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id_producto = urlParams.get('id_producto');
	const producto = productos[id_producto];



//Actualiza los valores del formulario de compra
function seleccionarProducto(id_producto, precioProducto) {
    document.querySelector('input[name="id_producto"]').value = id_producto;
    document.querySelector('input[name="precio"]').value = precioProducto;
}

//Actualiza en el DOM los detalles del producto
function actualizarDetallesProducto(idProducto, precio) { 
    document.getElementById('formProductoId').value = idProducto;
    document.getElementById('precioProducto').value = precio;
    
//Actualizar los valores visibles si se cambian
    document.getElementById('productoNombre').textContent = 'Nombre del Producto';
    document.getElementById('productoPrecio').textContent = precio + '€';
}
	

    if (producto) {
        document.getElementById("productoNombre").innerText = producto.nombre;
        document.getElementById("productoPrecio").innerText = `${producto.precio}€`;
        document.getElementById("productoPrecio").dataset.precio = producto.precio;
        document.getElementById("descripcion").innerText = producto.descripcion;
		document.getElementById("categoria").innerText = producto.categoria;
        document.getElementById("mainImage").src = producto.imagenes[0];

        const smallImages = document.getElementsByClassName("image");
        smallImages[0].src = producto.imagenes[0];
        smallImages[1].src = producto.imagenes[1];
    }
}

//Calcula el subtotal, IVA y total basado en la cantidad introducida y actualiza los valores del formulario
function actualizarCarrito() {
    const cantidad = parseFloat(document.getElementById("first").value) || 0;
    const precio = parseFloat(document.getElementById("productoPrecio").dataset.precio);

    const subTotal = cantidad * precio;
    const iva = subTotal * 0.21;
    const total = subTotal + iva;

    document.getElementById("second").value = subTotal.toFixed(2);
    document.getElementById("third").value = iva.toFixed(2);
    document.getElementById("fourth").value = total.toFixed(2);
}


	function getId() {

	//Obtiene la URL actual
	const urlActual = window.location.href;

	//Crea un objeto URL a partir de la URL actual
	const url = new URL(urlActual);

	//Accede a los parámetros de búsqueda de la URL
	const parametrosURL = new URLSearchParams(url.search);

	//Extrae el valor del parámetro del id_producto
	const idProducto = parametrosURL.get('id_producto');

	console.log (idProducto);

 document.getElementById("formProductoId").value = idProducto;

}


