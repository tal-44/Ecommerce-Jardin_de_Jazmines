-- ============================================================
-- EXTENSIÓN BASE DE DATOS: RAMOS PRE-HECHOS
-- Archivo: databases/extension_ramos.sql
-- ============================================================

-- 1. CREAR NUEVA TABLA PARA RAMOS PRE-FABRICADOS
-- ============================================================

--      He aprovechado que no sabia si esta tabla existia para probar copilot y ver como lo hacia una IA. Por lo tanto hay q revisarlo.

CREATE TABLE IF NOT EXISTS `ramos_prefabricados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `temporada` enum('verano','primavera','otoño','invierno','todo_año') NOT NULL,
  `ocasion` varchar(100) DEFAULT NULL COMMENT 'Ej: cumpleaños, aniversario, condolencias, bodas',
  `tamaño` enum('pequeño','mediano','grande') NOT NULL DEFAULT 'mediano',
  `imagen` varchar(255) DEFAULT NULL,
  `plantas_incluidas` text DEFAULT NULL COMMENT 'JSON con IDs de plantas del ramo',
  `colores_predominantes` varchar(100) DEFAULT NULL COMMENT 'Ej: rojos, pasteles, tropicales',
  `incluye_envoltorio` tinyint(1) DEFAULT 1,
  `incluye_tarjeta` tinyint(1) DEFAULT 1,
  `tiempo_preparacion_dias` int(11) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 2. INSERTAR NUEVA CATEGORÍA EN CATEGORIAS
-- ============================================================
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
	(8, 'Ramos Pre-hechos', 'Ramos de flores y plantas preparados por nuestros expertos floristas. Listos para regalar en cualquier ocasión especial.');

-- 3. DATOS DE EJEMPLO PARA RAMOS PRE-FABRICADOS
-- ============================================================
DELETE FROM `ramos_prefabricados`;
INSERT INTO `ramos_prefabricados` 
(`id`, `nombre`, `descripcion`, `precio`, `stock`, `temporada`, `ocasion`, `tamaño`, `imagen`, `plantas_incluidas`, `colores_predominantes`, `incluye_envoltorio`, `incluye_tarjeta`, `tiempo_preparacion_dias`) 
VALUES
	(1, 'Ramo Primavera Romántica', 
	 'Delicado ramo con begonias maculata y lirios de la paz. Tonos blancos y rosados perfectos para ocasiones románticas. Envuelto en papel kraft natural con lazo de yute.', 
	 45.00, 12, 'primavera', 'aniversario', 'mediano', 'ramo_primavera.jpg', 
	 '[{"planta_id": 4, "cantidad": 3}, {"planta_id": 23, "cantidad": 2}]', 
	 'blancos y rosados', 1, 1, 1),
	
	(2, 'Ramo Tropical Vibrante', 
	 'Explosión de color con anturios rojos y follaje tropical. Ideal para celebraciones alegres y cumpleaños. Envoltorio en celofán transparente con moño rojo.', 
	 52.00, 8, 'verano', 'cumpleaños', 'grande', 'ramo_tropical.jpg', 
	 '[{"planta_id": 22, "cantidad": 5}, {"planta_id": 12, "cantidad": 2}]', 
	 'rojos y verdes', 1, 1, 1),
	
	(3, 'Ramo Elegancia Clásica', 
	 'Composición elegante con lirios de la paz blancos. Sobrio y refinado, perfecto para condolencias o eventos formales. Envoltorio negro con cinta blanca.', 
	 38.00, 15, 'todo_año', 'condolencias', 'mediano', 'ramo_elegancia.jpg', 
	 '[{"planta_id": 23, "cantidad": 7}]', 
	 'blancos puros', 1, 1, 2),
	
	(4, 'Ramo Pastel Dreams', 
	 'Mezcla suave de begonias y flores en tonos pastel. Delicado y dulce, ideal para baby showers y celebraciones tiernas. Envoltorio rosa empolvado.', 
	 42.00, 10, 'primavera', 'baby shower', 'pequeño', 'ramo_pastel.jpg', 
	 '[{"planta_id": 4, "cantidad": 5}, {"planta_id": 23, "cantidad": 1}]', 
	 'rosas y lavandas', 1, 1, 1),
	
	(5, 'Ramo Felicitaciones', 
	 'Ramo alegre y colorido con anturios y begonias. Perfecto para felicitar logros, promociones o graduaciones. Envoltorio multicolor festivo.', 
	 48.00, 12, 'todo_año', 'felicitaciones', 'mediano', 'ramo_felicitaciones.jpg', 
	 '[{"planta_id": 22, "cantidad": 3}, {"planta_id": 4, "cantidad": 3}]', 
	 'rojos y blancos', 1, 1, 1),
	
	(6, 'Ramo Mini Sorpresa', 
	 'Pequeño detalle con begonias maculata. Perfecto para decir "gracias" o alegrar el día de alguien. Formato compacto y económico.', 
	 28.00, 20, 'todo_año', 'agradecimiento', 'pequeño', 'ramo_mini.jpg', 
	 '[{"planta_id": 4, "cantidad": 3}]', 
	 'blancos y rosados', 1, 1, 1),
	
	(7, 'Ramo Boda Primaveral', 
	 'Elegante ramo nupcial con lirios blancos y follaje delicado. Diseño romántico para el día más especial. Incluye cintas de satén blanco.', 
	 75.00, 5, 'primavera', 'boda', 'grande', 'ramo_boda.jpg', 
	 '[{"planta_id": 23, "cantidad": 10}, {"planta_id": 4, "cantidad": 3}]', 
	 'blancos puros', 1, 1, 3),
	
	(8, 'Ramo Get Well Soon', 
	 'Ramo alegre para desear pronta recuperación. Tonos cálidos y optimistas con anturios y begonias. Levanta el ánimo con color.', 
	 40.00, 10, 'todo_año', 'recuperación', 'mediano', 'ramo_recovery.jpg', 
	 '[{"planta_id": 22, "cantidad": 2}, {"planta_id": 4, "cantidad": 3}]', 
	 'rojos y rosados', 1, 1, 1),
	
	(9, 'Ramo Otoño Cálido', 
	 'Mezcla de tonos otoñales con anturios y follaje de temporada. Perfecto para Acción de Gracias o celebraciones de otoño.', 
	 46.00, 8, 'otoño', 'acción de gracias', 'grande', 'ramo_otono.jpg', 
	 '[{"planta_id": 22, "cantidad": 4}, {"planta_id": 23, "cantidad": 2}]', 
	 'rojos y naranjas', 1, 1, 2),
	
	(10, 'Ramo Día de la Madre', 
	 'Ramo especial con la selección favorita de mamá. Mezcla de lirios blancos y begonias rosadas. Con tarjeta personalizable.', 
	 55.00, 15, 'primavera', 'día de la madre', 'grande', 'ramo_madre.jpg', 
	 '[{"planta_id": 23, "cantidad": 5}, {"planta_id": 4, "cantidad": 5}]', 
	 'blancos y rosados', 1, 1, 1);

-- 4. ACTUALIZAR PRODUCTOS EXISTENTES (marcar más plantas como aptas para ramos)
-- ============================================================
-- NOTA: Esto es opcional, puedes añadir más plantas marcándolas como aptas para ramos
UPDATE `productos` SET `es_para_ramo` = 1 WHERE `id` IN (4, 22, 23);

-- ============================================================
-- INSTRUCCIONES DE USO:
-- ============================================================
-- 1. Importar este archivo SQL en tu base de datos después de ecommerce_plantas.sql
-- 2. Esto creará:
--    - Nueva tabla 'ramos_prefabricados' con 10 ramos de ejemplo
--    - Nueva categoría (ID 8) "Ramos Pre-hechos"
-- 3. Los ramos incluyen referencia JSON a plantas existentes en la tabla productos
-- 4. Cada ramo tiene precio, stock, temporada, ocasión, tamaño e imágenes
--
-- PENDIENTE PARA IMPLEMENTACIÓN COMPLETA:
-- - Añadir imágenes reales en img/ramos/ (actualmente usa nombres placeholder)
-- - Crear página ramo.php para detalle individual de cada ramo
-- - Implementar sistema de carrito que maneje tanto productos como ramos
-- - Opcional: crear tabla intermedia ramos_productos para relaciones más complejas
-- ============================================================
