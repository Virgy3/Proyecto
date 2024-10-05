
/*Este evento se dispara cuando todo el contenido del documento (HTML) ha sido completamente cargado*/
document.addEventListener("DOMContentLoaded", function() { 

//Busca el elemento con el id de 'enlace-productos' y añade un 'listener' para el evento de 'click'.
    document.getElementById("enlace-productos").addEventListener("click", function(e) {
        e.preventDefault(); // Evita que el enlace navegue directamente a la página
        cargarProductos(); //Se carga la función cuando se da click en el enlace.
    });
});

function cargarProductos() {
    fetch('../views/productos.html') //Se solicita el contenido del "productos.html"
        .then(function(response) { //Recibe la respuesta
            return response.text(); //Devuelve respuesta
        })
        .then(function(html) {
            document.getElementById('contenido-main').innerHTML = html; //Establece el contenido en el "main" de la pág principal y se inserta
        })
        .catch(function(err) { //Manejo de errores por si sale algo mal
            console.warn('Algo salió mal.', err);
        });
}
