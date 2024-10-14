# este archivo es para tomar cada hoja de excel y generar un csv por cada una
# de ellas, para que luego se pueda importar a la base de datos


import pandas as pd

# se lee el archivo excel, primero las hojas impares y luego las pares
impares = pd.read_excel('data/impares.xlsx', sheet_name=None)

# corregimos el nombre de la columna de año ya que está mal decodificada
columnas = impares['multimedia'].columns
columnas = sorted(list(columnas))

impares['multimedia'].rename(columns={columnas[0] : 'año'}, inplace=True)


genero_subgenero = impares['genero']
generos = genero_subgenero[['genero']].drop_duplicates()
genero_subgenero.dropna(inplace=True)

genero_subgenero.rename_axis('id', inplace=True)





multimedia = impares['multimedia']
capitulos = multimedia[multimedia.cid.notna()][[
    'sid','cid', 'titulo', "duracion", "clasificacion",	"puntuacion","año","numero","serie","genero"
    ]]

genero_en_capitulos = capitulos[['sid','cid','titulo','genero']]
genero_en_capitulos = genero_en_capitulos.astype({'cid': 'int64', 'sid': 'int64'})
genero_en_capitulos.rename_axis('id', inplace=True)

capitulos = capitulos.drop(columns=['genero']).drop_duplicates()
capitulos = capitulos.astype({'cid': 'int64', 'sid': 'int64', 'numero': 'int64'}, copy=True)
capitulos.set_index('cid', inplace=True)

series = capitulos[['sid','serie']].drop_duplicates()
series = series.astype({'sid': 'int64'}, copy=True)
series.set_index('sid', inplace=True)

peliculas = multimedia[multimedia.pid.notna()][[
    'pid', 'titulo', "duracion", "clasificacion", "puntuacion",	"año",	"genero"
                                                ]]

genero_en_pelicula = peliculas[['genero','pid']]
genero_en_pelicula.rename_axis('id', inplace=True)
genero_en_pelicula = genero_en_pelicula.astype({'pid': 'int64'})

peliculas = peliculas.drop(columns=['genero']).drop_duplicates()
peliculas = peliculas.astype({'pid': 'int64'}, copy=True)
peliculas.set_index('pid', inplace=True)

pagos_multimedia = impares['pago']
pago_subscripcion = pagos_multimedia[pagos_multimedia.subs_id.notna()][['pago_id','monto', 'fecha', 'uid','subs_id']]
pago_subscripcion = pago_subscripcion.astype({'pago_id': 'int64', 'monto': 'int64', 'uid': 'int64', 'subs_id': 'int64'})
pago_subscripcion.set_index('pago_id', inplace=True)

pago_extra = pagos_multimedia[pagos_multimedia.subs_id.isna()][['pago_id','monto', 'fecha', 'uid', 'pid','pro_id']]
pago_extra = pago_extra.astype({'pago_id': 'int64', 'monto': 'int64', 'uid': 'int64', 'pid': 'int64', 'pro_id': 'int64'})
pago_extra.set_index('pago_id', inplace=True)

proveedores = impares['proveedores']

proveedores_pelis = proveedores[proveedores.pid.notna()][['id','nombre','pid']]
proveedores_pelis = proveedores_pelis.astype({'id': 'int64', 'pid': 'int64'}, copy=True)
proveedores_pelis.rename(columns={'id': 'pro_id'}, inplace=True)
proveedores_pelis.rename_axis('id', inplace=True)

proveedores_series = proveedores[proveedores.sid.notna()][['id','nombre','sid']]
proveedores_series = proveedores_series.astype({'id': 'int64', 'sid': 'int64'}, copy=True)
proveedores_series = proveedores_series.rename(columns={'id': 'pro_id'}, copy=True)
proveedores_series.rename_axis('id', inplace=True)

proveedores = proveedores.drop(columns=['pid','sid', 'disponibilidad', 'precio']).drop_duplicates()
proveedores = proveedores.astype({'id': 'int64'}, copy=True)
# queremos eliminar el index y fijar la columna id como index
proveedores.set_index('id', inplace=True)


suscripciones = impares['suscripciones']
suscripciones = suscripciones[['id', 'estado','fecha_inicio', 'pro_id', 'uid','fecha_termino']]
suscripciones.set_index('id', inplace=True)


usuarios = impares['usuarios']
usuarios = usuarios[['id', 'nombre', 'mail', 'password', 'username', 'fecha_nacimiento']]
usuarios.set_index('id', inplace=True)

visualizaciones = impares['visualizaciones']

visualizaciones.rename_axis('id', inplace=True)

visualizaciones_peliculas = visualizaciones[visualizaciones.pid.notna()][['uid', 'pid', 'fecha']]
visualizaciones_peliculas = visualizaciones_peliculas.astype({'pid': 'int64'}, copy=True)

visualizaciones_series = visualizaciones[visualizaciones.cid.notna()][['uid', 'cid', 'fecha']]
visualizaciones_series = visualizaciones_series.astype({'cid': 'int64'}, copy=True)

# ahora seguimos con las hojas pares

pares = pd.read_excel('data/pares.xlsx', sheet_name=None)


suscripciones_videojuegos = pares['subscripciones']
suscripciones_videojuegos.set_index('id', inplace=True)


genero_subgenero_videojuegos = pares['genero']
generos_videojuegos = genero_subgenero_videojuegos[['genero']].drop_duplicates()
genero_subgenero_videojuegos.dropna(inplace=True)
genero_subgenero_videojuegos.rename_axis('id', inplace=True)

pagos_videojuegos = pares['pagos']
pagos_videojuegos.rename(columns={'Unnamed: 0': 'pago_id'}, inplace=True)


pagos_subscripcion_videojuegos = pagos_videojuegos[pagos_videojuegos.subs_id.notna()][['pago_id','monto', 'fecha', 'id_usuario','subs_id']]
pagos_subscripcion_videojuegos = pagos_subscripcion_videojuegos.astype({'pago_id': 'int64', 'monto': 'int64', 'id_usuario': 'int64', 'subs_id': 'int64'})
pagos_subscripcion_videojuegos.set_index('pago_id', inplace=True)

pagos_videojuegos = pagos_videojuegos[pagos_videojuegos.subs_id.isna()][['pago_id','monto', 'fecha', 'id_usuario','id_proveedor' ,'id_videojuego']]
pagos_videojuegos = pagos_videojuegos.astype({'pago_id': 'int64', 'monto': 'int64', 'id_usuario': 'int64', 'id_proveedor': 'int64', 'id_videojuego': 'int64'})
pagos_videojuegos.set_index('pago_id', inplace=True)

proveedores_videojuegos = pares['proveedores']
proveedores_videojuegos.fillna(0, inplace=True) # asumimos que si no hay precio, es gratis
provee_videojuego = proveedores_videojuegos.copy()

proveedores_videojuegos = proveedores_videojuegos.drop(columns=['id_videojuego', 'precio_preorden', 'precio']).drop_duplicates()
proveedores_videojuegos.set_index('id', inplace=True)

usuario_proveedor_videojuegos = pares['usuario proveedor']

usuario_actividades_videojuegos = pares['usuario actividades']

usuario_actividades_videojuegos.dropna(subset=['id_videojuego', 'fecha v'], inplace=True) # eliminamos las filas que no tienen id_videojuego, porque no nos sirven
usuario_actividades_videojuegos = usuario_actividades_videojuegos.astype({'id_videojuego': 'int64'})

usuarios_videojuegos = usuario_actividades_videojuegos[['id_usuario', 'nombre', 'mail', 'password', 'username']].drop_duplicates()
# omitimos fecha de nacimiento porque hay múltiples entradas con el mismo id_usuario, está corrupto.
usuarios_videojuegos.set_index('id_usuario', inplace=True)

usuario_actividades_videojuegos.drop(columns=['nombre', 'mail', 'password', 'username', 'fecha_nacimiento'], inplace=True)




videojuegos = pares['videojuego']
videojuegos = videojuegos.drop(columns=['nombre']).drop_duplicates()
videojuegos.set_index('id_videojuego', inplace=True)

genero_en_videojuego = pares['videojuego genero']

genero_en_videojuego.rename_axis('id', inplace=True)


# AHORA GUARDAMOS TODAS LAS TABLAS CREADAS EN SU RESPECTIVO CSV
generos.to_csv('data/impares/generos.csv', index=True)
genero_subgenero.to_csv('data/impares/genero_subgenero.csv', index=True)
genero_en_capitulos.to_csv('data/impares/genero_en_capitulos.csv', index=True)
genero_en_pelicula.to_csv('data/impares/genero_en_pelicula.csv', index=True)
capitulos.to_csv('data/impares/capitulos.csv', index=True)
series.to_csv('data/impares/series.csv', index=True)
peliculas.to_csv('data/impares/peliculas.csv', index=True)
pago_subscripcion.to_csv('data/impares/pago_subscripcion.csv', index=True)
pago_extra.to_csv('data/impares/pago_extra.csv', index=True)
proveedores_pelis.to_csv('data/impares/proveedores_pelis.csv', index=True)
proveedores_series.to_csv('data/impares/proveedores_series.csv', index=True)
proveedores.to_csv('data/impares/proveedores.csv')
suscripciones.to_csv('data/impares/suscripciones.csv', index=True)
usuarios.to_csv('data/impares/usuarios.csv', index=True)
visualizaciones_peliculas.to_csv('data/impares/visualizaciones_peliculas.csv', index=True)
visualizaciones_series.to_csv('data/impares/visualizaciones_series.csv', index=True)

suscripciones_videojuegos.to_csv('data/pares/suscripciones_videojuegos.csv', index=True)
generos_videojuegos.to_csv('data/pares/generos_videojuegos.csv', index=True)
genero_subgenero_videojuegos.to_csv('data/pares/genero_subgenero_videojuegos.csv', index=True)
genero_en_videojuego.to_csv('data/pares/genero_en_videojuego.csv', index=True)
pagos_subscripcion_videojuegos.to_csv('data/pares/pagos_subscripcion_videojuegos.csv', index=True)
pagos_videojuegos.to_csv('data/pares/pagos_videojuegos.csv', index=True)
proveedores_videojuegos.to_csv('data/pares/proveedores_videojuegos.csv', index=True)
provee_videojuego.to_csv('data/pares/provee_videojuego.csv', index=False)
usuario_proveedor_videojuegos.to_csv('data/pares/usuario_proveedor_videojuegos.csv', index=False)
usuario_actividades_videojuegos.to_csv('data/pares/usuario_actividades_videojuegos.csv', index=True)
usuarios_videojuegos.to_csv('data/pares/usuarios_videojuegos.csv', index=True)
videojuegos.to_csv('data/pares/videojuegos.csv', index=True)

print('Se generaron los csvs!!!')