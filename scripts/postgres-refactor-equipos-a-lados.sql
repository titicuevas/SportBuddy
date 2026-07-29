BEGIN;

ALTER TABLE partidos
    ADD COLUMN IF NOT EXISTS equipo_local_nombre VARCHAR(255) DEFAULT 'Equipo Azul',
    ADD COLUMN IF NOT EXISTS equipo_visitante_nombre VARCHAR(255) DEFAULT 'Equipo Naranja';

UPDATE partidos
SET
    equipo_local_nombre = COALESCE(equipo_local_nombre, 'Equipo Azul'),
    equipo_visitante_nombre = COALESCE(equipo_visitante_nombre, 'Equipo Naranja');

ALTER TABLE asignamientos
    ADD COLUMN IF NOT EXISTS lado SMALLINT;

UPDATE asignamientos a
SET lado = CASE
    WHEN a.equipo_id = p.equipo1 THEN 1
    WHEN a.equipo_id = p.equipo2 THEN 2
    ELSE 1
END
FROM partidos p
WHERE p.id = a.partido_id
  AND a.lado IS NULL;

UPDATE asignamientos
SET lado = 1
WHERE lado IS NULL;

COMMIT;
