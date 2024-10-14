CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
mover_usuario (id int, nombre varchar(100), mail varchar(50), password varchar(50), usarname varchar(50), fecha_nacimiento date)



-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$



-- definimos nuestra función
BEGIN

    -- verificar si ya está en la tabla
    IF id NOT IN (SELECT id FROM usuario) THEN
        INSERT INTO usuarios values(id, nombre, mail, password, usarname, fecha_nacimiento);
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
   


-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql