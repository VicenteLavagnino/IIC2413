

CREATE TABLE IF NOT EXISTS SERIES(
sid INT NOT NULL PRIMARY KEY,
serie varchar(100) NOT NULL
);
CREATE TABLE IF NOT EXISTS generos (
    id INT UNIQUE NOT NULL,
    genero varchar(100) UNIQUE NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS capitulos (
    cid INT UNIQUE NOT NULL,
    sid INT NOT NULL,
    titulo varchar(100) NOT NULL,
    duracion FLOAT NOT NULL,
    clasificacion VARCHAR(5) CHECK (
        clasificacion IN ('G', 'PG', 'PG-13', 'R', 'NC-17')
    ),
    puntuacion FLOAT,
    año INT NOT NULL CHECK (
        año < EXTRACT(
            YEAR
            FROM CURRENT_DATE
        )
    ),
    numero INT,
    serie varchar(100) NOT NULL,
    PRIMARY KEY (cid, sid),
    FOREIGN KEY (sid) REFERENCES series(sid),
    CHECK (
        sid IS NOT NULL
        AND cid IS NOT NULL
    )
);

CREATE TABLE IF NOT EXISTS usuarios(
id INT NOT NULL,
nombre varchar(100) NOT NULL,
mail varchar(100) NOT NULL,
password varchar(100) NOT NULL,
username varchar(100) NOT NULL UNIQUE,
fecha_de_nacimiento DATE NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS proveedores(
id INT NOT NULL,
nombre varchar(100) NOT NULL,
costo FLOAT,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS suscripciones(
id INT NOT NULL,
estado varchar(100),
fecha_inicio DATE NOT NULL, -- FALTA EL CHECKEOOOO
pro_id INT NOT NULL,
uid INT NOT NULL,
fecha_termino DATE NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (pro_id) REFERENCES proveedores(id),
FOREIGN KEY (uid) REFERENCES usuarios(id)
);
CREATE TABLE IF NOT EXISTS genero_subgenero(
id INT NOT NULL,
genero varchar(100) NOT NULL,
subgenero varchar(100) NOT NULL,
PRIMARY KEY (id),
CHECK (genero <> subgenero),
FOREIGN KEY (genero) REFERENCES generos(genero)
);

CREATE TABLE IF NOT EXISTS peliculas(
pid INT NOT NULL PRIMARY KEY,
titulo varchar(100) NOT NULL,
duracion FLOAT NOT NULL,
clasificacion VARCHAR(5) CHECK (
    clasificacion IN ('G', 'PG', 'PG-13', 'R', 'NC-17')
),
puntuacion FLOAT,
año INT NOT NULL -- FALTA EL CHECKEOOOO
);
CREATE TABLE IF NOT EXISTS pago_subscripcion(
pago_id INT NOT NULL,
monto FLOAT NOT NULL,
fecha DATE NOT NULL,
uid INT NOT NULL,
subs_id INT NOT NULL,
PRIMARY KEY (pago_id),
FOREIGN KEY (uid) REFERENCES usuarios(id),
FOREIGN KEY (subs_id) REFERENCES suscripciones(id)
);
CREATE TABLE IF NOT EXISTS proveedores_pelis(
id INT NOT NULL,
pro_id INT NOT NULL,
nombre varchar(100) NOT NULL,
pid INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (pro_id) REFERENCES proveedores(id),
FOREIGN KEY (pid) REFERENCES peliculas(pid)
);
CREATE TABLE IF NOT EXISTS proveedores_series(
id INT NOT NULL,
pro_id INT NOT NULL,
nombre varchar(100) NOT NULL,
sid INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (pro_id) REFERENCES proveedores(id),
FOREIGN KEY (sid) REFERENCES series(sid)
);
CREATE TABLE IF NOT EXISTS visualizaciones_peliculas(
id_visualizacion INT NOT NULL,
uid INT NOT NULL,
pid INT NOT NULL,
fecha DATE NOT NULL,
PRIMARY KEY (id_visualizacion),
FOREIGN KEY (uid) REFERENCES usuarios(id),
FOREIGN KEY (pid) REFERENCES peliculas(pid)
);
CREATE TABLE IF NOT EXISTS visualizaciones_series(
id_visualizacion INT NOT NULL,
uid INT NOT NULL,
cid INT NOT NULL,
fecha DATE NOT NULL,
PRIMARY KEY (id_visualizacion),
FOREIGN KEY (uid) REFERENCES usuarios(id),
FOREIGN KEY (cid) REFERENCES capitulos(cid)
);
CREATE TABLE IF NOT EXISTS genero_en_capitulos(
id INT NOT NULL,
sid INT NOT NULL,
cid INT NOT NULL,
titulo varchar(100) NOT NULL,
genero varchar(100) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (sid) REFERENCES series(sid),
FOREIGN KEY (cid) REFERENCES capitulos(cid)
);
CREATE TABLE IF NOT EXISTS genero_en_pelicula(
id INT NOT NULL,
genero varchar(100) NOT NULL,
pid INT NOT NULL,
PRIMARY KEY (id),
-- FOREIGN KEY (id) REFERENCES genero_subgenero(id),
FOREIGN KEY (pid) REFERENCES peliculas(pid)
--- el genero debe estar en la tabla genero_subgenero
);

CREATE TABLE IF NOT EXISTS pago_extra(
pago_id INT NOT NULL,
monto FLOAT NOT NULL,
fecha DATE NOT NULL,
uid INT NOT NULL,
pid INT NOT NULL,
pro_id INT NOT NULL,
PRIMARY KEY (pago_id),
FOREIGN KEY (uid) REFERENCES usuarios(id),
FOREIGN KEY (pid) REFERENCES peliculas(pid),
FOREIGN KEY (pro_id) REFERENCES proveedores(id)
);

-- PARTE 2

CREATE TABLE IF NOT EXISTS usuarios_videojuegos(
id_usuario INT NOT NULL UNIQUE,
nombre varchar(100) NOT NULL,
mail varchar(100) NOT NULL,
password varchar(100) NOT NULL,
username varchar(100) NOT NULL UNIQUE,
PRIMARY KEY (id_usuario)
);

CREATE TABLE IF NOT EXISTS generos_videojuegos(
id INT NOT NULL UNIQUE,
genero varchar(100) NOT NULL UNIQUE,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS videojuegos(
id_videojuego INT NOT NULL,
titulo varchar(100) NOT NULL,
puntuacion FLOAT NOT NULL,
clasificacion VARCHAR(12) CHECK (
    clasificacion IN ('M', 'T', 'E', 'E10','Three','Twelve','Seven','Sixteen','Eighteen','A','RP')),
fecha_de_lanzamiento DATE NOT NULL,
beneficio_preorden varchar(100),
mensualidad FLOAT,
PRIMARY KEY (id_videojuego)
);
CREATE TABLE IF NOT EXISTS genero_subgenero_videojuegos(
id INT NOT NULL,
genero varchar(100) NOT NULL,
subgenero varchar(100) NOT NULL,
PRIMARY KEY (id),
CHECK (genero <> subgenero)
);

CREATE TABLE IF NOT EXISTS genero_en_videojuego(
id INT NOT NULL UNIQUE,
id_videojuego INT NOT NULL,
genero varchar(100) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);


CREATE TABLE IF NOT EXISTS proveedores_videojuegos(
id INT NOT NULL,
nombre varchar(100) NOT NULL,
plataforma varchar(100) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS suscripciones_videojuegos(
id INT NOT NULL,
estado varchar(100),
fecha_inicio DATE NOT NULL, -- FALTA EL CHECKEOOOO
-- pro_id INT NOT NULL, esta no aparece en eñl excel, corregir!!!
id_usuario INT NOT NULL,
fecha_termino DATE NOT NULL,
id_videojuego INT NOT NULL,
mensualidad FLOAT NOT NULL,
PRIMARY KEY (id),
-- FOREIGN KEY (pro_id) REFERENCES proveedores_videojuegos(id),
FOREIGN KEY (id_usuario) REFERENCES usuarios_videojuegos(id_usuario),
FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);



CREATE TABLE IF NOT EXISTS pagos_subscripcion_videojuegos(
pago_id INT NOT NULL,
monto FLOAT NOT NULL,
fecha DATE NOT NULL,
id_usuario INT NOT NULL,
subs_id INT NOT NULL,
PRIMARY KEY (pago_id),
FOREIGN KEY (id_usuario) REFERENCES usuarios_videojuegos(id_usuario),
FOREIGN KEY (subs_id) REFERENCES suscripciones_videojuegos(id)
);
CREATE TABLE IF NOT EXISTS pagos_videojuegos(
pago_id INT NOT NULL,
monto INT NOT NULL,
fecha DATE NOT NULL,
id_usuario INT NOT NULL,
id_proveedor INT NOT NULL,
id_videojuego INT NOT NULL,
PRIMARY KEY (pago_id),
FOREIGN KEY (id_usuario) REFERENCES usuarios_videojuegos(id_usuario),
FOREIGN KEY (id_proveedor) REFERENCES proveedores_videojuegos(id),
FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);
CREATE TABLE IF NOT EXISTS usuario_proveedor_videojuegos(
id_usuario INT NOT NULL,
id_proveedor INT NOT NULL,
PRIMARY KEY (id_usuario, id_proveedor),
FOREIGN KEY (id_usuario) REFERENCES usuarios_videojuegos(id_usuario),
FOREIGN KEY (id_proveedor) REFERENCES proveedores_videojuegos(id)
);
CREATE TABLE IF NOT EXISTS usuario_actividades_videojuegos(
id_actividad INT NOT NULL UNIQUE,
id_usuario INT NOT NULL,
id_videojuego INT NOT NULL,
fecha DATE NOT NULL,
cantidad FLOAT NOT NULL,
veredicto varchar(100),
titulo varchar(100),
texto varchar(500),
PRIMARY KEY (id_actividad),
FOREIGN KEY (id_usuario) REFERENCES usuarios_videojuegos(id_usuario),
FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);
CREATE TABLE IF NOT EXISTS provee_videojuego(
pid INT NOT NULL,
nombre varchar(100) NOT NULL,
plataforma varchar(100) NOT NULL,
id_videojuego INT NOT NULL,
precio FLOAT ,
precio_preorden FLOAT,
PRIMARY KEY (pid, id_videojuego),
FOREIGN KEY (pid) REFERENCES proveedores_videojuegos(id),
FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);
