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