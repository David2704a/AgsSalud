-- CREATE PROCEDURE `almacenadoTmp` ()
-- BEGIN
--     -- Variables para manejar el bucle y almacenar temporalmente el ID de persona y usuario
--     DECLARE done INT DEFAULT FALSE;
    

--     -- Variables para los atributos de los elementos
--     DECLARE id_dispo_var VARCHAR(191);
--     DECLARE marca_var VARCHAR(225);
--     DECLARE referencia_var VARCHAR(225);
--     DECLARE serial_var VARCHAR(300);
--     DECLARE procesador_var VARCHAR(225);
--     DECLARE ram_var VARCHAR(225);
--     DECLARE disco_duro_var VARCHAR(500);
--     DECLARE tajeta_grafica_var VARCHAR(500);
--     DECLARE observacion_var VARCHAR(500);
--     DECLARE garantia_var VARCHAR(500);  


-- -- tabla user-persona
--     DECLARE documento_var VARCHAR(300);
--     DECLARE nombres_apellidos_var VARCHAR(225);


-- -- tabla factura
--     DECLARE fecha_compra_var VARCHAR(500);
--     DECLARE numero_factura_var VARCHAR(300);


-- --   tabla proveedor
--   DECLARE proveedor_var VARCHAR(225);
            

-- -- tabla categoria
--     DECLARE dispositivo_var INT;

--  -- tabla estado Elemento
--     DECLARE estado_var VARCHAR(500);



                                            



--     -- Variables para los nombres y apellidos
--     DECLARE nombre1_var VARCHAR(225);
--     DECLARE nombre2_var VARCHAR(225);
--     DECLARE apellido1_var VARCHAR(225);
--     DECLARE apellido2_var VARCHAR(225);

--     -- Cursor para recorrer los datos del excel
--     DECLARE cur CURSOR FOR
--         SELECT id_dispo, dispositivo, marca, referencia, serial, procesador, ram, disco_duro, tajeta_grafica,
--                documento, nombres_apellidos, fecha_compra, garantia, numero_factura, proveedor, estado, observacion
--         FROM almacenadoTmp;

--     -- Manejador para cuando no se encuentran más filas en el cursor
--     DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

--     -- Abrir el cursor
--     OPEN cur;

--     -- Inicio del bucle
--     read_loop: LOOP
--         FETCH cur INTO id_dispo_var, dispositivo_var, marca_var, referencia_var, serial_var, procesador_var, ram_var,
--                           disco_duro_var, tajeta_grafica_var, documento_var, nombres_apellidos_var, fecha_compra_var,
--                           garantia_var, numero_factura_var, proveedor_var, estado_var, observacion_var;

--         IF done THEN
--             LEAVE read_loop;
--         END IF;

--         -- Divide los nombres y apellidos
--         SET nombre1_var = SUBSTRING_INDEX(nombres_apellidos_var, ' ', 1);
--         SET nombre2_var = SUBSTRING_INDEX(nombres_apellidos_var, ' ', -1);
--         SET apellido1_var = SUBSTRING_INDEX(apellido1_var, ' ', 1);
--         SET apellido2_var = SUBSTRING_INDEX(apellido1_var, ' ', -1);

--         -- Inserta en persona y obtiene el ID
--         INSERT INTO persona (nombre1, nombre2, apellido1, apellido2)
--         VALUES (nombre1_var, nombre2_var, apellido1_var, apellido2_var);
--         SET @id_persona = LAST_INSERT_ID();

--         -- Inserta en users y obtiene el ID
--         INSERT INTO users (idpersona)
--         VALUES (@id_persona);
--         SET id_user_var = LAST_INSERT_ID();

--         -- Inserta en elemento
--         INSERT INTO elemento (id_dispo, marca, referencia, serial, procesador, ram, disco_duro, tajeta_grafica,
--                              idCategoria, idFactura, idUsuario, idEstadoEquipo, descripcion)
--         VALUES (id_dispo_var, marca_var, referencia_var, serial_var, procesador_var, ram_var, disco_duro_var,
--                 tajeta_grafica_var, dispositivo_var, numero_factura_var, id_user_var, estado_var, observacion_var);
--     END LOOP;

--     -- Cierra el cursor
--     CLOSE cur;
-- END //




CREATE DEFINER=`root`@`localhost` PROCEDURE `almacenadoTmp`()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE id_dispo_var VARCHAR(191);
    DECLARE dispositivo_var VARCHAR(225);
    DECLARE estado_var VARCHAR(500);
    DECLARE marca_var VARCHAR(225);
    DECLARE referencia_var VARCHAR(225);
    DECLARE serial_var VARCHAR(300);
    DECLARE procesador_var VARCHAR(225);
    DECLARE ram_var VARCHAR(225);
    DECLARE disco_duro_var VARCHAR(500);
    DECLARE tarjeta_grafica_var VARCHAR(500);
    DECLARE observacion_var VARCHAR(500);
    DECLARE garantia_var VARCHAR(500);

    DECLARE idCategoria_var INT;
    DECLARE idEstadoEquipo_var INT;

    DECLARE cur CURSOR FOR
        SELECT id_dispo, dispositivo, estado, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, observacion, garantia
        FROM almacenadoTmp;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO id_dispo_var, dispositivo_var, estado_var, marca_var, referencia_var, serial_var, procesador_var, ram_var, disco_duro_var, tarjeta_grafica_var, observacion_var, garantia_var;

        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Busca el modelo de Categoria correspondiente
        SELECT idCategoria INTO idCategoria_var
        FROM categoria
        WHERE nombre COLLATE utf8mb4_unicode_ci = dispositivo_var COLLATE utf8mb4_unicode_ci
        LIMIT 1;

        -- Si no se encuentra, inserta un nuevo registro en la tabla 'categoria'
        IF idCategoria_var IS NULL THEN
            INSERT INTO categoria (nombre) VALUES (dispositivo_var COLLATE utf8mb4_unicode_ci);
            SET idCategoria_var = LAST_INSERT_ID();
        END IF;

        -- Busca el modelo de EstadoElemento correspondiente
        SELECT idEstadoE INTO idEstadoEquipo_var
        FROM estadoElemento
        WHERE estado COLLATE utf8mb4_unicode_ci = estado_var COLLATE utf8mb4_unicode_ci
        LIMIT 1;

        -- Si no se encuentra, inserta un nuevo registro en la tabla 'estadoElemento'
        IF idEstadoEquipo_var IS NULL THEN
            INSERT INTO estadoElemento (estado) VALUES (estado_var COLLATE utf8mb4_unicode_ci);
            SET idEstadoEquipo_var = LAST_INSERT_ID();
        END IF;

        -- Inserta en la tabla 'elemento'
        INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia)
        VALUES (id_dispo_var, idCategoria_var, idEstadoEquipo_var, marca_var, referencia_var, serial_var, procesador_var, ram_var, disco_duro_var, tarjeta_grafica_var, observacion_var, garantia_var);
    END LOOP;

    CLOSE cur;
END




-- funciona pero duplica algunas cosas
BEGIN
INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Busca y agrega nuevos estados si no existen
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

    -- Inserta en la tabla 'elemento'
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad)
    SELECT a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado);

END


-- funciona para cuando vuelva a subir un archivo solo con modificaciones olo agregue las nuevas mas no las que existen
INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento'
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

    -- Inserta en la tabla 'elemento' evitando duplicados
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad)
    SELECT a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    WHERE el.id_dispo IS NULL
    AND NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
    );

END



-- si funciona para todo ahora solo falta user 
BEGIN
  DECLARE proveedorId INT;

    -- Inserción en la tabla 'proveedor' evitando duplicados
    INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para NO REGISTRA basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento'
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

    -- Inserta en la tabla 'elemento' evitando duplicados
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura)
    SELECT a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    WHERE el.id_dispo IS NULL
    AND NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
    );
END



-- funciona para perosnas y user los crea ADDUser
 BEGIN
 DECLARE proveedorId INT;
   DECLARE usuarioId INT;
  DECLARE emailCounter INT;

    -- Inserción en la tabla 'proveedor' evitando duplicados
    INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para NO REGISTRA basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento'
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;




 INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
SELECT 
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', 1)
        ELSE nombres_apellidos
    END AS nombre1,
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN 
            CASE 
                WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)
                ELSE NULL
            END
        ELSE NULL
    END AS nombre2,
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN 
            CASE 
                WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)
                ELSE NULL
            END
        ELSE NULL
    END AS apellido1,
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', -1)
        ELSE NULL
    END AS apellido2,
    documento AS identificacion
FROM almacenadoTmp
WHERE nombres_apellidos IS NOT NULL
AND documento IS NOT NULL;

-- Inserta en la tabla 'users'
INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
SELECT 
    CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
    CONCAT('agssaludgerencia', p.id, '@gmail.com'),
    PASSWORD('agsadministracionDev123'),
    p.id,
    NOW(),
    NOW()
FROM persona p;
  
    -- Inserta en la tabla 'elemento' evitando duplicados y asignando idFactura
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura)
    SELECT a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    WHERE el.id_dispo IS NULL
    AND NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
    );
    END





BEGIN
 DECLARE proveedorId INT;
   DECLARE usuarioId INT;
  DECLARE emailCounter INT;

    -- Inserción en la tabla 'proveedor' evitando duplicados
    INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para NO REGISTRA basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento'
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;




 INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
SELECT 
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', 1)
        ELSE nombres_apellidos
    END AS nombre1,
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN 
            CASE 
                WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)
                ELSE NULL
            END
        ELSE NULL
    END AS nombre2,
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN 
            CASE 
                WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)
                ELSE NULL
            END
        ELSE NULL
    END AS apellido1,
    CASE 
        WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', -1)
        ELSE NULL
    END AS apellido2,
    documento AS identificacion
FROM almacenadoTmp
WHERE nombres_apellidos IS NOT NULL
AND documento IS NOT NULL;

-- Inserta en la tabla 'users'
INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
SELECT 
    CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
    CONCAT('agssaludgerencia', p.id, '@gmail.com'),
    PASSWORD('agsadministracionDev123'),
    p.id,
    NOW(),
    NOW()
FROM persona p;
  
    -- Inserta en la tabla 'elemento' evitando duplicados y asignando idFactura
  INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura, u.id AS idUsuario
    FROM 
        almacenadoTmp a
        JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
        JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
        JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
        LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
        JOIN persona p ON TRIM(a.nombres_apellidos) = TRIM(CONCAT(p.nombre1, ' ', p.nombre2, ' ', p.apellido1, ' ', p.apellido2)) AND a.documento = p.identificacion
        JOIN users u ON p.id = u.idpersona
    WHERE 
        el.id_dispo IS NULL;
END




-- fi funciona y me crea todos los registros pero aun user no BEGIN
 DECLARE proveedorId INT;
 DECLARE usuarioId INT;
 DECLARE emailCounter INT;

    -- Inserción en la tabla 'proveedor' evitando duplicados
    INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para NO REGISTRA basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento'
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;


    -- Inserta en la tabla 'persona'
    INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT 
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', 1)
            ELSE a.nombres_apellidos
        END AS nombre1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(a.nombres_apellidos) - LENGTH(REPLACE(a.nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(a.nombres_apellidos, ' ', 2), ' ', -1)
                    ELSE NULL
                END
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(a.nombres_apellidos) - LENGTH(REPLACE(a.nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(a.nombres_apellidos, ' ', -2), ' ', 1)
                    ELSE NULL
                END
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', -1)
            ELSE NULL
        END AS apellido2,
        a.documento AS identificacion
    FROM almacenadoTmp a
    WHERE a.nombres_apellidos IS NOT NULL
    AND a.documento IS NOT NULL;

    -- Inserta en la tabla 'users'
    INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p;

    -- Inserta en la tabla 'elemento' evitando duplicados y asignando idFactura
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura)
    SELECT 
        a.id_dispo,
        c.idCategoria,
        e.idEstadoE,
        a.marca,
        a.referencia,
        a.serial,
        a.procesador,
        a.ram,
        a.disco_duro,
        a.tarjeta_grafica,
        a.observacion,
        a.garantia,
        a.cantidad,
        COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1)) AS idFactura
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    WHERE el.id_dispo IS NULL
    AND NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
    );
END






BEGIN
  DECLARE proveedorId INT;
    DECLARE usuarioId INT;
    DECLARE emailCounter INT;

    -- Inserción en la tabla 'proveedor' evitando duplicados
    INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para NO REGISTRA basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento'
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;




    -- Inserta en la tabla 'persona' y verifica duplicados
INSERT IGNORE INTO persona (nombre1, apellido1, apellido2, identificacion)
SELECT 
    DISTINCT
    CASE 
        WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', 1)
        ELSE a.nombres_apellidos
    END AS nombre1,
    CASE 
        WHEN a.nombres_apellidos REGEXP ' ' THEN 
            CASE 
                WHEN LENGTH(a.nombres_apellidos) - LENGTH(REPLACE(a.nombres_apellidos, ' ', '')) >= 2
                THEN SUBSTRING_INDEX(SUBSTRING_INDEX(a.nombres_apellidos, ' ', -2), ' ', 1)
                ELSE NULL
            END
        ELSE NULL
    END AS apellido1,
    CASE 
        WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', -1)
        ELSE NULL
    END AS apellido2,
    NULLIF(TRIM(NULLIF(a.documento, '')), '') AS identificacion
FROM almacenadoTmp a
WHERE a.nombres_apellidos IS NOT NULL
AND a.nombres_apellidos != 'LIBRE';

    
    
    
    
-- Inserta en la tabla 'users'
INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
SELECT 
    CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
    CONCAT('agssaludgerencia', p.id, '@gmail.com'),
    PASSWORD('agsadministracionDev123'),
    p.id,
    NOW(),
    NOW()
FROM persona p;

-- Inserta en la tabla 'elemento' evitando duplicados y asignando idFactura
INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura)
SELECT 
    a.id_dispo,
    c.idCategoria,
    e.idEstadoE,
    a.marca,
    a.referencia,
    a.serial,
    a.procesador,
    a.ram,
    a.disco_duro,
    a.tarjeta_grafica,
    a.observacion,
    a.garantia,
    a.cantidad,
    COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1)) AS idFactura
FROM almacenadoTmp a
JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
WHERE el.id_dispo IS NULL
AND NOT EXISTS (
    SELECT 1
    FROM elemento el2
    WHERE el2.id_dispo = a.id_dispo
);
END











BEGIN
    DECLARE userId INT;  -- Variable para almacenar el id del usuario

    -- Insertar en la tabla 'persona' si no existe
    INSERT IGNORE INTO persona (nombre1, apellido1, apellido2, identificacion)
    SELECT 
        DISTINCT
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', 1)
            ELSE a.nombres_apellidos
        END AS nombre1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(a.nombres_apellidos) - LENGTH(REPLACE(a.nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(a.nombres_apellidos, ' ', -2), ' ', 1)
                    ELSE NULL
                END
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', -1)
            ELSE NULL
        END AS apellido2,
        NULLIF(TRIM(NULLIF(a.documento, '')), '') AS identificacion
    FROM almacenadoTmp a
    WHERE a.nombres_apellidos IS NOT NULL
    AND a.nombres_apellidos != ' ';

    -- Obtener el id de la persona recién creada o existente
    SELECT p.id INTO userId
    FROM persona p
    WHERE p.nombre1 = COALESCE(p.nombre1, '') 
      AND p.apellido1 = COALESCE(p.apellido1, '') 
      AND p.apellido2 = COALESCE(p.apellido2, '') 
      AND p.identificacion = COALESCE(p.identificacion, '')
    LIMIT 1;

    -- Insertar en la tabla 'users' si no existe
    INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE NOT EXISTS (
        SELECT 1
        FROM users u
        WHERE u.idpersona = p.id
    );

    -- Obtener el id del usuario recién creado o existente
    SELECT u.id INTO userId
    FROM users u
    JOIN persona p ON u.idpersona = p.id
    WHERE p.nombre1 = COALESCE(p.nombre1, '') 
      AND p.apellido1 = COALESCE(p.apellido1, '') 
      AND p.apellido2 = COALESCE(p.apellido2, '') 
      AND p.identificacion = COALESCE(p.identificacion, '')
    LIMIT 1;

    -- Insertar en la tabla 'elemento' evitando duplicados y asignando idFactura e idUsuario
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT
        a.id_dispo,
        c.idCategoria,
        e.idEstadoE,
        a.marca,
        a.referencia,
        a.serial,
        a.procesador,
        a.ram,
        a.disco_duro,
        a.tarjeta_grafica,
        a.observacion,
        a.garantia,
        a.cantidad,
        COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1)) AS idFactura,
        userId AS idUsuario
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    WHERE NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
          AND el2.idCategoria = c.idCategoria
          AND el2.idEstadoEquipo = e.idEstadoE
          AND el2.idUsuario = userId
          AND el2.idFactura = COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1))
    );
END;




    INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Eliminar duplicados en 'factura' basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Eliminar duplicados en 'factura' para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA' AND f1.idProveedor IS NOT NULL AND f1.idFactura > f2.idFactura;

    -- Inserción en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

    -- Insertar en la tabla 'persona'
    INSERT IGNORE INTO persona (nombre1, apellido1, apellido2, identificacion)
    SELECT 
        DISTINCT
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', 1)
            ELSE a.nombres_apellidos
        END AS nombre1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(a.nombres_apellidos) - LENGTH(REPLACE(a.nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(a.nombres_apellidos, ' ', -2), ' ', 1)
                    ELSE NULL
                END
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', -1)
            ELSE NULL
        END AS apellido2,
        NULLIF(TRIM(NULLIF(a.documento, '')), '') AS identificacion
    FROM almacenadoTmp a
    WHERE a.nombres_apellidos IS NOT NULL AND TRIM(a.nombres_apellidos) != '';

    -- Insertar en la tabla 'users'
    INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p;

    -- Insertar en la tabla 'elemento' evitando duplicados y asignando idFactura e idUsuario
    INSERT IGNORE INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT
        a.id_dispo,
        c.idCategoria,
        e.idEstadoE,
        a.marca,
        a.referencia,
        a.serial,
        a.procesador,
        a.ram,
        a.disco_duro,
        a.tarjeta_grafica,
        a.observacion,
        a.garantia,
        a.cantidad,
        COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1)) AS idFactura,
        u.id AS idUsuario
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN persona p ON TRIM(a.nombres_apellidos) = TRIM(p.nombre1) AND TRIM(a.documento) = TRIM(p.identificacion)
    LEFT JOIN users u ON p.id = u.idpersona
    WHERE NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
          AND el2.idCategoria = c.idCategoria
          AND el2.idEstadoEquipo = e.idEstadoE
          AND el2.idUsuario = u.id
          AND el2.idFactura = COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1))
    );
END;





-- funciona pero solo agrega 5 user a elemento ADDBEGIN
    -- Inserción en la tabla 'proveedor' evitando duplicados
    INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para NO REGISTRA basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento'
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

    -- Inserta en la tabla 'persona' evitando duplicados
    INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT 
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', 1)
            ELSE nombres_apellidos
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)
                    ELSE NULL
                END
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)
                    ELSE NULL
                END
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', -1)
            ELSE NULL
        END AS apellido2,
        documento AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento IS NOT NULL;

    -- Inserta en la tabla 'users'
    INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p;

    -- Inserta en la tabla 'elemento' evitando duplicados
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura, u.id AS idUsuario
    FROM 
        almacenadoTmp a
        JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
        JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
        JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
        LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
        JOIN persona p ON TRIM(a.nombres_apellidos) = TRIM(CONCAT(p.nombre1, ' ', p.nombre2, ' ', p.apellido1, ' ', p.apellido2)) AND a.documento = p.identificacion
        JOIN users u ON p.id = u.idpersona;
END;






-- funciona pero aun no agrega el usesr
BEGIN
  INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Eliminar duplicados en 'factura' basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Eliminar duplicados en 'factura' para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA' AND f1.idProveedor IS NOT NULL AND f1.idFactura > f2.idFactura;

    -- Inserción en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

    -- Insertar en la tabla 'persona'
    INSERT IGNORE INTO persona (nombre1, apellido1, apellido2, identificacion)
    SELECT 
        DISTINCT
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', 1)
            ELSE a.nombres_apellidos
        END AS nombre1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(a.nombres_apellidos) - LENGTH(REPLACE(a.nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(a.nombres_apellidos, ' ', -2), ' ', 1)
                    ELSE NULL
                END
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', -1)
            ELSE NULL
        END AS apellido2,
        NULLIF(TRIM(NULLIF(a.documento, '')), '') AS identificacion
    FROM almacenadoTmp a
    WHERE a.nombres_apellidos IS NOT NULL AND TRIM(a.nombres_apellidos) != '';

    -- Insertar en la tabla 'users'
    INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p;

    -- Insertar en la tabla 'elemento' evitando duplicados y asignando idFactura e idUsuario
    INSERT IGNORE INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT
        a.id_dispo,
        c.idCategoria,
        e.idEstadoE,
        a.marca,
        a.referencia,
        a.serial,
        a.procesador,
        a.ram,
        a.disco_duro,
        a.tarjeta_grafica,
        a.observacion,
        a.garantia,
        a.cantidad,
        COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1)) AS idFactura,
        u.id AS idUsuario
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN persona p ON TRIM(a.nombres_apellidos) = TRIM(p.nombre1) AND TRIM(a.documento) = TRIM(p.identificacion)
    LEFT JOIN users u ON p.id = u.idpersona
    WHERE NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
          AND el2.idCategoria = c.idCategoria
          AND el2.idEstadoEquipo = e.idEstadoE
          AND el2.idUsuario = u.id
          AND el2.idFactura = COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1))
    );
END







-- agrega user perso solo todos con el mismo id 

BEGIN

 DECLARE userId INT;

  INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Eliminar duplicados en 'factura' basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Eliminar duplicados en 'factura' para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA' AND f1.idProveedor IS NOT NULL AND f1.idFactura > f2.idFactura;

    -- Inserción en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

    -- Insertar en la tabla 'persona'
      

       INSERT IGNORE INTO persona (nombre1, apellido1, apellido2, identificacion)
SELECT 
    DISTINCT
    CASE 
        WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', 1)
        ELSE a.nombres_apellidos
    END AS nombre1,
    CASE 
        WHEN a.nombres_apellidos REGEXP ' ' THEN 
            CASE 
                WHEN LENGTH(a.nombres_apellidos) - LENGTH(REPLACE(a.nombres_apellidos, ' ', '')) >= 2
                THEN SUBSTRING_INDEX(SUBSTRING_INDEX(a.nombres_apellidos, ' ', -2), ' ', 1)
                ELSE NULL
            END
        ELSE NULL
    END AS apellido1,
    CASE 
        WHEN a.nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(a.nombres_apellidos, ' ', -1)
        ELSE NULL
    END AS apellido2,
    NULLIF(TRIM(NULLIF(a.documento, '')), '') AS identificacion
FROM almacenadoTmp a
WHERE a.nombres_apellidos IS NOT NULL
AND a.nombres_apellidos != ' ';


    -- Obtener el id de la persona recién creada o existente
    SELECT p.id INTO userId
    FROM persona p
    WHERE p.nombre1 = COALESCE(p.nombre1, '') 
      AND p.apellido1 = COALESCE(p.apellido1, '') 
      AND p.apellido2 = COALESCE(p.apellido2, '') 
      AND p.identificacion = COALESCE(p.identificacion, '')
    LIMIT 1;

    -- Insertar en la tabla 'users' si no existe

    INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        CONCAT(COALESCE(p.nombre1, ''), ' ', COALESCE(p.apellido1, '')),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p;



    -- Obtener el id del usuario recién creado o existente
    SELECT p.id INTO userId
    FROM persona p
    WHERE p.id = userId;

    -- Insertar en la tabla 'elemento' evitando duplicados y asignando idFactura e idUsuario
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT
        a.id_dispo,
        c.idCategoria,
        e.idEstadoE,
        a.marca,
        a.referencia,
        a.serial,
        a.procesador,
        a.ram,
        a.disco_duro,
        a.tarjeta_grafica,
       a.observacion, -- Cambié a descripcion
        a.garantia,
        a.cantidad,
        COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1)) AS idFactura,
        userId AS idUsuario
    FROM almacenadoTmp a
    JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    WHERE NOT EXISTS (
        SELECT 1
        FROM elemento el2
        WHERE el2.id_dispo = a.id_dispo
          AND el2.idUsuario = userId
          AND el2.idCategoria = c.idCategoria
          AND el2.idEstadoEquipo = e.idEstadoE
          AND el2.marca = a.marca
          AND el2.referencia = a.referencia
          AND el2.serial = a.serial
          AND el2.procesador = a.procesador
          AND el2.ram = a.ram
          AND el2.disco_duro = a.disco_duro
          AND el2.tarjeta_grafica = a.tarjeta_grafica
          AND el2.descripcion = a.observacion-- Cambié a descripcion
          AND el2.garantia = a.garantia
          AND el2.cantidad = a.cantidad
          AND el2.idFactura = COALESCE(f.idFactura, (SELECT idFactura FROM factura WHERE codigoFactura = 'NO REGISTRA' LIMIT 1))
    );   
    
END






-- funciona pero etoy trtando de arreglar a  persona ADD    
INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', 1)
            ELSE nombres_apellidos
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)
                    ELSE NULL
                END
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)
                    ELSE NULL
                END
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN SUBSTRING_INDEX(nombres_apellidos, ' ', -1)
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;

    -- Actualiza en la tabla 'users' evitando duplicados y actualiza name
    INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL;





-- agrega los nombre de 2, 4 palbras en orden 
BEGIN

 
INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

   
    -- Inserta en la tabla 'persona' evitando duplicados
    INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
            ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                CASE 
                    WHEN LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2
                    THEN SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -1), ' ', 1)  -- Apellido1
                    ELSE NULL
                END
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 3 THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;

    


    
    
    -- Inserta en la tabla 'elemento' evitando duplicados y actualiza idUsuario
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura, u.id AS idUsuario
    FROM 
        almacenadoTmp a
        JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
        JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
        JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
        LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
        JOIN persona p ON TRIM(a.nombres_apellidos) = TRIM(CONCAT(p.nombre1, ' ', p.nombre2, ' ', p.apellido1, ' ', p.apellido2)) AND a.documento = p.identificacion
        JOIN users u ON p.id = u.idpersona;
END





-- duplica  registros cuando tiene 3 palabras duplica la de nombre2 y lo pasa a  apellido1
BEGIN

 
INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

   
    -- Inserta en la tabla 'persona' evitando duplicados
        INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
            ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 1 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)  -- Primer apellido
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;


        INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '@gmail.com'),
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL;



    
    -- Inserta en la tabla 'elemento' evitando duplicados y actualiza idUsuario
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura, u.id AS idUsuario
    FROM 
        almacenadoTmp a
        JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
        JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
        JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
        LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
        JOIN persona p ON TRIM(a.nombres_apellidos) = TRIM(CONCAT(p.nombre1, ' ', p.nombre2, ' ', p.apellido1, ' ', p.apellido2)) AND a.documento = p.identificacion
        JOIN users u ON p.id = u.idpersona;
END




-- crea correos a el azar pero me duplica registroa
 INSERT INTO users (name, email, password, idpersona, created_at, updated_at)
 SELECT 
  COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia',UUID_SHORT(), '@gmail.com'),
     PASSWORD('agsadministracionDev123'),
       p.id,
       NOW(),
        NOW()
 FROM persona p
   WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL ;





--    FUNCIONA PARA USERRRRRRRRS
  INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '_', UUID_SHORT(), '@gmail.com'), -- Utilizar UUID_SHORT() para generar un número único
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL
    ON DUPLICATE KEY UPDATE idpersona = idpersona; 
    





--  FUNCIONA PERO AUN NO EN ELEMENTO
BEGIN

 
INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
    INSERT IGNORE INTO categoria (nombre)
    SELECT DISTINCT TRIM(dispositivo) FROM almacenadoTmp;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
    INSERT IGNORE INTO estadoElemento (estado)
    SELECT DISTINCT TRIM(estado) FROM almacenadoTmp;

   
    -- Inserta en la tabla 'persona' evitando duplicados
        INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
            ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 1 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)  -- Primer apellido
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;




   
      INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '_', UUID_SHORT(), '@gmail.com'), -- Utilizar UUID_SHORT() para generar un número único
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL
    ON DUPLICATE KEY UPDATE idpersona = idpersona; 
    


    
INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
SELECT 
    a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura, NULL
  --  u.id AS idUsuario
FROM almacenadoTmp a
JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
LEFT JOIN users u ON TRIM(a.nombres_apellidos) = TRIM(u.name)
LEFT JOIN elemento el ON a.id_dispo = el.id_dispo;
END




-- si funciona todo pero voy a cambiar para que registro de elemento no se haga comparaciones con nombres_apellidos de la tabla users si no de persona
BEGIN

 
INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
INSERT INTO categoria (nombre)
SELECT DISTINCT TRIM(dispositivo) AS nombre
FROM almacenadoTmp a
LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
WHERE c.nombre IS NULL AND TRIM(a.dispositivo) IS NOT NULL;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
INSERT INTO estadoElemento (estado)
SELECT DISTINCT TRIM(a.estado) AS estado
FROM almacenadoTmp a
LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
WHERE e.estado IS NULL AND TRIM(a.estado) IS NOT NULL;


   
    -- Inserta en la tabla 'persona' evitando duplicados
        INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
            ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 1 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)  -- Primer apellido
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;




   
      INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '_', UUID_SHORT(), '@gmail.com'), -- Utilizar UUID_SHORT() para generar un número único
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL
    ON DUPLICATE KEY UPDATE idpersona = idpersona; 
    


    
    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura,
        CASE 
            WHEN a.nombres_apellidos IS NOT NULL AND u.id IS NOT NULL THEN u.id
            ELSE NULL
        END AS idUsuario
    FROM almacenadoTmp a
    LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    LEFT JOIN users u ON TRIM(a.nombres_apellidos) = TRIM(u.name)
    WHERE el.id_dispo IS NULL;
END



-- ya funciona paar todo y rectifica por documento 
BEGIN
INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
INSERT INTO categoria (nombre)
SELECT DISTINCT TRIM(dispositivo) AS nombre
FROM almacenadoTmp a
LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
WHERE c.nombre IS NULL AND TRIM(a.dispositivo) IS NOT NULL;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
INSERT INTO estadoElemento (estado)
SELECT DISTINCT TRIM(a.estado) AS estado
FROM almacenadoTmp a
LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
WHERE e.estado IS NULL AND TRIM(a.estado) IS NOT NULL;

   
    -- Inserta en la tabla 'persona' evitando duplicados
        INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
            ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 1 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)  -- Primer apellido
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;

      INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '_', UUID_SHORT(), '@gmail.com'), -- Utilizar UUID_SHORT() para generar un número único
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL
    ON DUPLICATE KEY UPDATE idpersona = idpersona; 
    

    INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura,
        CASE 
            WHEN a.documento IS NOT NULL AND p.id IS NOT NULL THEN u.id
            ELSE NULL
        END AS idUsuario
    FROM almacenadoTmp a
    LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    LEFT JOIN persona p ON a.documento = p.identificacion
    LEFT JOIN users u ON p.id = u.idpersona
    WHERE el.id_dispo IS NULL;
    
END


-- si funciona para todo producto final ADDBEGIN

BEGIN 
INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
INSERT INTO categoria (nombre)
SELECT DISTINCT TRIM(dispositivo) AS nombre
FROM almacenadoTmp a
LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
WHERE c.nombre IS NULL AND TRIM(a.dispositivo) IS NOT NULL;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
INSERT INTO estadoElemento (estado)
SELECT DISTINCT TRIM(a.estado) AS estado
FROM almacenadoTmp a
LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
WHERE e.estado IS NULL AND TRIM(a.estado) IS NOT NULL;


   
    -- Inserta en la tabla 'persona' evitando duplicados
        INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
            ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 1 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)  -- Primer apellido
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;




   
      INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '_', UUID_SHORT(), '@gmail.com'), -- Utilizar UUID_SHORT() para generar un número único
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL
    ON DUPLICATE KEY UPDATE idpersona = idpersona; 
    


    
    
    
    
 INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura,
        CASE 
            WHEN a.documento IS NOT NULL AND p.id IS NOT NULL THEN u.id
            ELSE NULL
        END AS idUsuario
    FROM almacenadoTmp a
    LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    LEFT JOIN persona p ON a.documento = p.identificacion
    LEFT JOIN users u ON p.id = u.idpersona
    WHERE el.id_dispo IS NULL AND a.id_dispo IS NOT NULL; -- Agregamos esta condición para evitar nulos

    -- Insertar en la tabla 'elementonoid' cuando id_dispo sea nulo
    INSERT INTO elementonoid (cantidad, idCategoria, marca, referencia, observacion, created_at, updated_at)
    SELECT 
        a.cantidad, c.idCategoria, a.marca, a.referencia, a.observacion, NOW(), NOW()
    FROM almacenadoTmp a
    LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    WHERE a.id_dispo IS NULL;
    
    DELETE FROM almacenadoTmp;
    
END



-- +esta si funciona para todo y en si no duplica ningun registro ni en elementonoid y vacea almacenadotmp cuando termina de distribuir todos los registros
BEGIN

 
INSERT INTO proveedor (nombre)
    SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
    WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);

    -- Inserción en la tabla 'factura' evitando duplicados
    INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
    SELECT p.idProveedor, a.numero_factura, STR_TO_DATE(a.fecha_compra, '%Y-%m-%d')
    FROM almacenadoTmp a
    JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);

    -- Asegurarnos de que no haya duplicados basados en código de factura y fecha
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.fechaCompra = f2.fechaCompra
    WHERE f1.idFactura > f2.idFactura;

    -- Elimina los registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
    DELETE f1 FROM factura f1
    JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
    AND f1.idProveedor = f2.idProveedor
    WHERE f1.codigoFactura = 'NO REGISTRA'
    AND f1.idProveedor IS NOT NULL
    AND f1.idFactura > f2.idFactura;

    -- Inserta en la tabla 'categoria' evitando duplicados
INSERT INTO categoria (nombre)
SELECT DISTINCT TRIM(dispositivo) AS nombre
FROM almacenadoTmp a
LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
WHERE c.nombre IS NULL AND TRIM(a.dispositivo) IS NOT NULL;

    -- Inserción en la tabla 'estadoElemento' evitando duplicados
INSERT INTO estadoElemento (estado)
SELECT DISTINCT TRIM(a.estado) AS estado
FROM almacenadoTmp a
LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
WHERE e.estado IS NULL AND TRIM(a.estado) IS NOT NULL;

   
    -- Inserta en la tabla 'persona' evitando duplicados
        INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
    SELECT DISTINCT
        CASE 
            WHEN nombres_apellidos REGEXP ' ' THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
            ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
        END AS nombre1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 1 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)  -- Primer apellido
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN documento REGEXP '^[0-9]+$' THEN documento
            ELSE NULL
        END AS identificacion
    FROM almacenadoTmp
    WHERE nombres_apellidos IS NOT NULL
    AND documento REGEXP '^[0-9]+$'
    AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
    AND documento IS NOT NULL;

   
      INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
    SELECT 
        COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
        CONCAT('agssaludgerencia', p.id, '_', UUID_SHORT(), '@gmail.com'), -- Utilizar UUID_SHORT() para generar un número único
        PASSWORD('agsadministracionDev123'),
        p.id,
        NOW(),
        NOW()
    FROM persona p
    WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL
    ON DUPLICATE KEY UPDATE idpersona = idpersona; 

    
 INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
    SELECT 
        a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura,
        CASE 
            WHEN a.documento IS NOT NULL AND p.id IS NOT NULL THEN u.id
            ELSE NULL
        END AS idUsuario
    FROM almacenadoTmp a
    LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
    LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
    LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') = f.fechaCompra
    LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
    LEFT JOIN persona p ON a.documento = p.identificacion
    LEFT JOIN users u ON p.id = u.idpersona
    WHERE el.id_dispo IS NULL AND a.id_dispo IS NOT NULL; -- Agregamos esta condición para evitar nulos

    -- Insertar en la tabla 'elementonoid' cuando id_dispo sea nulo
    INSERT IGNORE INTO elementonoid (cantidad, idCategoria, marca, referencia, observacion, created_at, updated_at)
SELECT 
    a.cantidad, c.idCategoria, a.marca, a.referencia, a.observacion, NOW(), NOW()
FROM almacenadoTmp a
LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
WHERE a.id_dispo IS NULL;
    
    DELETE FROM almacenadoTmp;
    
END



-