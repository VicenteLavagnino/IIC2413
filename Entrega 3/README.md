# Entrega3_IIC2413

La presente entrega corresponde a la tercera entrega del proyecto del curso IIC2413 Bases de Datos. El grupo está compuesto por los siguientes integrantes:
- Javier del Valle
- Itzae Flores
- Vicente Lavagnino
- Ignacio Laval

Provenientes de los grupos 3 y 4.

## Instrucciones de uso

Para inicializar se debe correr el script que procesa los datasets y crea los archivos csv serán utilizados para poblar las tablas.

La clave de la base de datos es grupo3 y el usuario es grupo3, la base de datos se llama grupo3e3.

Para evaluar la entrega con el dataset se deben ubicar loas archivos .xlsx en la carpeta ```data```, fuera de las carpetas pares e impares, estos se deben llamar impares.xlsx y pares.xlsx respectivamente. Luego se debe correr el siguiente comando:
```bash
python3 data/preproces_y_generacion_csv.py
```
Este script genera los archivos csv que serán utilizados para poblar las tablas.
Es importantísimo que el nuevo dataset siga la misma estriuctura que el dataset original, es decir, que tenga las mismas columnas y que estas se llamen igual, distribuidas en las mismas hojas.

Luego se debe correr el script que crea las tablas y las pobla con los datos de los archivos csv. Antes por precaución se eliminan todas las tablas que puedan existir en la base de datos.



```bash
psql -h localhost -U grupo3 -d grupo3e3 -f functions/eliminador_tablas.sql
psql -h localhost -U grupo3 -d grupo3e3 -f functions/creador_tablas.sql
psql -h localhost -U grupo3 -d grupo3e3 -f functions/poblador_tablas.sql
```
Estos archivos, junto a otros scripts que se utilizaron para probar la base de datos, se encuentran en la carpeta ```functions```.


Una vez creadas las tablas se puede acceder a la aplicación web. Para esto se debe ir a 
el link [https://bachman.ing.puc.cl/~grupo3/index.php](https://bachman.ing.puc.cl/~grupo3/index.php) en el navegador.

El esquema relacional utilizado se describe e ilustra en el diagrama ```diagrama.png```.

Todo el detalle, archivos, etcétera están contenidos en la carpera ```Entrega3``` del servidor.

### Inconsistencias
Se detectó que habían actividades de usuarios con juegos que no tenían juegos asociados, por lo que se decidió eliminar estas actividades ya que no tenía sentido que existieran. Esto se hizo en el script que procesa los datasets.
Por otro lado para manejar mejor lso juegos que no tenían costo (NAN) se decidió asignarles un costo de 0,  ya que es equivalente a que no tengan costo o es válido asumirlo.

### Justificación 3NF
El modelo se puede considerar 3NF ya que cada base de datos en tiene una clave primaria única. Sumado a esto, los datos de la tabla se relacionan de manera directa. Por ultimo, en ningún caso hay un atributo clave que dependa de un atributo no clave.







solo pedimos un 5.05, muchas gracias
