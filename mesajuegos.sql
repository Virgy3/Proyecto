CREATE DATABASE IF NOT EXISTS castillo_juegos;
USE castillo_juegos;

-- Crear tablas

-- Estructura para la tabla 'users'

CREATE TABLE users (
id_user int (15) auto_increment PRIMARY KEY NOT NULL,
nombre varchar (50) NOT NULL,
cumpleanos date DEFAULT NULL,
direccion varchar (50) DEFAULT NULL,
codigo_postal varchar (5) DEFAULT NULL,
ciudad varchar (50) DEFAULT NULL,
telefono varchar (12) DEFAULT NULL,
email varchar (100) UNIQUE NOT NULL,
contrasena varchar (50) NOT NULL
)ENGINE=InnoDB;


-- Volcado de datos para la tabla 'users'

INSERT INTO users VALUES
(1, 'Leliana Garcia', '1995-08-03', 'Calle Picara 3', '11500', 'Cadiz', '666330033', 'leliana@gmail.com', '123'),
(2, 'Virginia Benzo Lopez', '1985-06-01', 'Avenida Europa 61', '29003', 'Malaga', '678010203', 'ladydark3@gmail.com', '123patata'),
(3, 'Pepita Ramirez', '1998-01-20', 'Calle Piruleta 55', '28080', 'Madrid', '653440055', 'pepita_ramirez@hotmail.com', '0123'),
(4, 'Miguel Gomez', '1960-12-29', 'Urbanizacion Rota 12', '28080', 'Madrid', '677121212', 'miguelito60@hotmail.com', 'ilerna');

-- Estructura para la tabla 'setup'

CREATE TABLE setup (
	Host varchar (50) NOT NULL,
    Autenticacion int (15) NOT NULL,
    SuperAdmin int (15) NOT NULL,
    CONSTRAINT setup_pk PRIMARY KEY (SuperAdmin),
    CONSTRAINT setup_fk FOREIGN KEY (SuperAdmin) REFERENCES users (id_user)
)ENGINE=InnoDB;

-- Volcado de datos para la tabla 'setup'

INSERT INTO setup VALUES ('localhost', 1, 2);

--
-- Estructura para la tabla 'facturas'

CREATE TABLE facturas (
id_factura int (15) auto_increment PRIMARY KEY NOT NULL,
id_user int (15) NOT NULL,
fecha date NOT NULL,
CONSTRAINT id_user_fk FOREIGN KEY (id_user) REFERENCES users (id_user)
)ENGINE=InnoDB;

--
-- Estructura para la tabla 'ventas'

CREATE TABLE ventas (
id_venta int (15) auto_increment PRIMARY KEY NOT NULL,
id_factura int (15) NOT NULL,
id_producto int (10) NOT NULL,
cantidad int (15) NOT NULL,
precio_total DECIMAL(10, 2),
CONSTRAINT id_factura_fk FOREIGN KEY (id_factura) REFERENCES facturas (id_factura),
CONSTRAINT id_producto_fk FOREIGN KEY (id_producto) REFERENCES productos (id_producto)
)ENGINE=InnoDB;

--
-- Estructura para la tabla 'productos'

CREATE TABLE productos (
id_producto int (10) auto_increment PRIMARY KEY NOT NULL, 
nombre varchar (50) NOT NULL,
descripcion MEDIUMTEXT,
precio decimal (10,2) NOT NULL,
id_categoria varchar (20) NOT NULL,
id_proveedor int (15) NOT NULL,
stock int NOT NULL,
CONSTRAINT id_categoria_fk FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT id_proveedor_fk FOREIGN KEY (id_proveedor) REFERENCES proveedores (id_proveedor) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB auto_increment=25;

INSERT INTO productos VALUES

(1, 'Catan', 'Juego de mesa de estrategia donde los jugadores tratan de colonizar una isla, negociando recursos y construyendo asentamientos', 30.99, 'Tablero', 1, 10),
(2, 'Aventureros al tren', 'Juego de mesa de aventura donde los jugadores construyen rutas de ferrocarril a través de Norteamérica para completar objetivos y ganar puntos', 35.50, 'Tablero', 2, 10),
(3, 'Pandemic', 'Juego de mesa cooperativo donde los jugadores trabajan juntos para detener la propagación de enfermedades mortales en todo el mundo', 29.99, 'Cartas', 1, 5),
(4, 'Risk', 'Juego de mesa de estrategia de guerra donde los jugadores compiten por el dominio global, conquistando territorios y eliminando oponentes', 24.75, 'Tablero', 4, 2),
(5, 'Scrabble', 'Juego de mesa de palabras donde los jugadores forman palabras cruzadas en un tablero utilizando fichas de letras con valores de puntuación', 19.99, 'Tablero', 5, 3),
(6, 'Dominion', 'Juego de mesa de construcción de mazos donde los jugadores compiten por construir el mejor reino', 34.99, 'Cartas', 3, 6),
(7, 'Carcassonne', 'Juego de mesa de colocación de losetas donde los jugadores construyen un paisaje medieval con ciudades, caminos y campos', 27.50, 'Tablero', 1, 20),
(8, 'Puerto Rico', 'Juego de mesa de estrategia económica donde los jugadores desarrollan plantaciones, construyen edificios y envían mercancías en la época colonial', 39.95, 'Dados', 5, 18),
(9, '7 Wonders', 'Juego de mesa de civilizaciones donde los jugadores construyen maravillas, desarrollan tecnologías y gestionan recursos para construir la mejor civilización', 31.75, 'Tablero', 1, 15),
(10, 'Agricola', 'Juego de mesa de agricultura donde los jugadores gestionan una granja, crían animales, cultivan cultivos y mejoran su hogar', 37.99, 'Tablero', 2, 5),
(11, 'Twilight Struggle', 'Juego de mesa de simulación de la Guerra Fría donde los jugadores controlan las superpotencias y compiten por la influencia mundial', 45.00, 'Cartas', 4, 12),
(12, 'Codenames', 'Juego de mesa de palabras y deducción donde los jugadores tratan de identificar a sus agentes secretos utilizando pistas dadas por un jefe de equipo', 20.50, 'Cartas', 4, 6),
(13, 'Terraforming Mars', 'Juego de mesa de gestión de recursos donde los jugadores compiten por terraformar Marte, desarrollando infraestructura y colonizando el planeta', 42.25, 'Tablero', 3, 14),
(14, 'Splendor', 'Juego de mesa de estrategia donde los jugadores compiten por construir la mejor red comercial de joyas y recursos preciosos', 28.99, 'Cartas', 1, 10),
(15, 'Dead of Winter', 'Juego de mesa de supervivencia y traición donde los jugadores luchan por sobrevivir en un apocalipsis zombi mientras enfrentan amenazas internas y externas', 36.75, 'Rol', 3, 20),
(16, 'Dixit', 'Juego de mesa de narración y deducción donde los jugadores intentan adivinar qué carta ha elegido un narrador basándose en sus descripciones', 29.99, 'Cartas', 5, 10),
(17, 'Math Bingo', 'Juego de mesa que ayuda a practicar las habilidades matemáticas básicas, como sumar, restar, multiplicar y dividir, de manera divertida y competitiva', 19.99, 'Infantil', 5, 8),
(18, 'Scrabble Junior', 'Versión simplificada del clásico juego de Scrabble diseñada para niños, ayuda a mejorar la ortografía y el vocabulario', 21.50, 'Infantil', 2, 3),
(19, 'Uno Moo!', 'Versión adaptada del juego Uno, pero con animales de granja, ayuda a los niños a aprender colores, números y desarrollo de estrategias', 16.75, 'Infantil', 1, 10),
(20, 'Rush Hour Jr.', 'Juego de mesa de rompecabezas que enseña conceptos de lógica y pensamiento crítico a través de la resolución de problemas de tráfico', 29.99, 'Infantil', 1, 8),
(23, 'Spartacus', 'Juego de mesa ambientado en la Antigua Roma, plagado de conspiraciones de traición, feroces pujas, ¡y sangrientos combates entre Gladiadores!', 33.50, 'Tablero', 3, 15),
(24, 'Dice Forge', 'Juego de desarrollo con dados de caras extraíbles', 35.99, 'Dados', 5, 8);

--
-- Estructura para la tabla 'categorias'

CREATE TABLE categorias (
id_categoria varchar (20) PRIMARY KEY NOT NULL,
descripcion MEDIUMTEXT
)ENGINE=InnoDB;

INSERT INTO categorias VALUES 
('Infantil', 'Juegos de mesa para niños de 3 a 10 años'),
('Tablero', 'Juegos de tablero a partir de 12 años'),
('Cartas', 'Juegos de cartas a partir de 10 años'),
('Dados', 'Juegos de mesa que se juegan con dados a partir de 12 años'),
('Rol', 'Juegos de rol a partir de 16 años');

--
-- Estructura para la tabla 'proveedores'

CREATE TABLE proveedores (
id_proveedor int (15) PRIMARY KEY NOT NULL,
nombre varchar (50) NOT NULL,
direccion varchar (50) NOT NULL,
telefono varchar (12) NOT NULL
)ENGINE=InnoDB;

INSERT INTO proveedores VALUES
(1, 'TodoJuegos', 'Poligono San Luis num 18, Málaga', '951334455'),
(2, 'DEVIR', 'Calle de los Martirios s/n, nave 57, Madrid', '91403940'),
(3, 'Jugatoys', 'Calle Alcalde Márquez num 9, Barcelona', '982266331'),
(4, 'Dispersa Juguetes', 'Poligono La Azucarera num 41, Málaga', '951001200'),
(5, 'Last Level', 'Poligono Industrial Juan Martín num 35, Valencia', '931057484');

