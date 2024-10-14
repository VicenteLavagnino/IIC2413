CREATE OR REPLACE FUNCTION

cancelacion_subscripciones()

RETURNS void AS $$
-- definimos nuestra función
BEGIN

    UPDATE subscripciones SET estado = 'cancelada' WHERE (fecha_fin < now() AND estado = 'activa');

    UPDATE subscripciones_videojuegos SET estado = 'canceled' WHERE (fecha_fin < now() AND estado = 'active');

END