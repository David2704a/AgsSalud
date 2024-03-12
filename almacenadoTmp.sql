CREATE PROCEDURE `almacenadoTmp` ()

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