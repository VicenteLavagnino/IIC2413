-- comandos para poblar las tablas de la base de datos en psql

\COPY SERIES FROM 'data/impares/series.csv' DELIMITER ',' CSV HEADER;
\COPY capitulos FROM 'data/impares/capitulos.csv' DELIMITER ',' CSV HEADER;
\COPY generos FROM 'data/impares/generos.csv' DELIMITER ',' CSV HEADER;
\COPY usuarios FROM 'data/impares/usuarios.csv' DELIMITER ',' CSV HEADER;
\COPY proveedores FROM 'data/impares/proveedores.csv' DELIMITER ',' CSV HEADER;
\COPY suscripciones FROM 'data/impares/suscripciones.csv' DELIMITER ',' CSV HEADER;
\COPY genero_subgenero FROM 'data/impares/genero_subgenero.csv' DELIMITER ',' CSV HEADER;
\COPY peliculas FROM 'data/impares/peliculas.csv' DELIMITER ',' CSV HEADER;
\COPY pago_subscripcion FROM 'data/impares/pago_subscripcion.csv' DELIMITER ',' CSV HEADER;
\COPY proveedores_pelis FROM 'data/impares/proveedores_pelis.csv' DELIMITER ',' CSV HEADER;
\COPY proveedores_series FROM 'data/impares/proveedores_series.csv' DELIMITER ',' CSV HEADER;
\COPY visualizaciones_peliculas FROM 'data/impares/visualizaciones_peliculas.csv' DELIMITER ',' CSV HEADER;
\COPY visualizaciones_series FROM 'data/impares/visualizaciones_series.csv' DELIMITER ',' CSV HEADER;
\COPY genero_en_capitulos FROM 'data/impares/genero_en_capitulos.csv' DELIMITER ',' CSV HEADER;
\COPY genero_en_pelicula FROM 'data/impares/genero_en_pelicula.csv' DELIMITER ',' CSV HEADER;
\COPY pago_extra FROM 'data/impares/pago_extra.csv' DELIMITER ',' CSV HEADER;


-- PARTE 2

\COPY videojuegos FROM 'data/pares/videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY usuarios_videojuegos FROM 'data/pares/usuarios_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY genero_subgenero_videojuegos FROM 'data/pares/genero_subgenero_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY generos_videojuegos FROM 'data/pares/generos_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY genero_en_videojuego FROM 'data/pares/genero_en_videojuego.csv' DELIMITER ',' CSV HEADER;
\COPY proveedores_videojuegos FROM 'data/pares/proveedores_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY suscripciones_videojuegos FROM 'data/pares/suscripciones_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY pagos_subscripcion_videojuegos FROM 'data/pares/pagos_subscripcion_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY pagos_videojuegos FROM 'data/pares/pagos_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY usuario_proveedor_videojuegos FROM 'data/pares/usuario_proveedor_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY usuario_actividades_videojuegos FROM 'data/pares/usuario_actividades_videojuegos.csv' DELIMITER ',' CSV HEADER;
\COPY provee_videojuego FROM 'data/pares/provee_videojuego.csv' DELIMITER ',' CSV HEADER;

