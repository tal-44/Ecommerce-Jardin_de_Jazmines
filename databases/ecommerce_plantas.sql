-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para ecommerce_plantas
CREATE DATABASE IF NOT EXISTS `ecommerce_plantas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ecommerce_plantas`;

-- Volcando estructura para tabla ecommerce_plantas.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ecommerce_plantas.categorias: ~7 rows (aproximadamente)
DELETE FROM `categorias`;
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
	(1, 'Plantas de Interior', 'Plantas decorativas perfectas para espacios interiores del hogar u oficina'),
	(2, 'Suculentas y Cactus', 'Plantas de bajo mantenimiento que almacenan agua en sus hojas o tallos'),
	(3, 'Plantas de Follaje', 'Plantas con hojas decorativas y vistosas, ideales para ambientes con poca luz'),
	(4, 'Helechos', 'Plantas sin flores con hojas compuestas que aportan frescura y humedad'),
	(5, 'Plantas con Flores', 'Plantas que producen flores decorativas durante todo el año o por temporada'),
	(6, 'Herramientas de Riego', 'Accesorios y herramientas especializadas para el riego de plantas'),
	(7, 'Herramientas de Jardinería', 'Herramientas generales para el cuidado, poda y mantenimiento de plantas');

-- Volcando estructura para tabla ecommerce_plantas.herramientas
CREATE TABLE IF NOT EXISTS `herramientas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `tipo_herramienta` varchar(50) DEFAULT NULL COMMENT 'Ej: riego, poda, transplante',
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `herramientas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ecommerce_plantas.herramientas: ~10 rows (aproximadamente)
DELETE FROM `herramientas`;
INSERT INTO `herramientas` (`id`, `nombre`, `categoria_id`, `precio`, `stock`, `descripcion`, `imagen`, `tipo_herramienta`) VALUES
	(1, 'Regadera Moderna 5L', 6, 12.99, 50, 'Regadera de plástico resistente con diseño moderno. Capacidad de 5 litros. Boquilla larga para llegar a todas las plantas.', 'regadera.jpg', 'riego'),
	(2, 'Pulverizador Premium', 6, 8.50, 40, 'Pulverizador manual de 500ml ideal para nebulizar plantas tropicales. Boquilla ajustable para niebla fina o chorro.', 'pulverizador.jpg', 'riego'),
	(3, 'Tijeras de Poda Profesional', 7, 18.99, 30, 'Tijeras de acero inoxidable japonés. Corte preciso y limpio. Mango ergonómico antideslizante.', 'tijeras.jpg', 'poda'),
	(4, 'Set de Pala y Rastrillo', 7, 14.50, 35, 'Kit de 2 piezas: pala de mano y rastrillo. Acero inoxidable. Mango de madera de bambú.', 'set_pala.jpg', 'transplante'),
	(5, 'Medidor 3 en 1', 6, 15.99, 25, 'Medidor de humedad, pH y luz solar. No requiere baterías. Lectura instantánea para cuidado óptimo.', 'medidor.jpg', 'medición'),
	(6, 'Guantes de Jardinería', 7, 9.99, 60, 'Guantes resistentes con palma antideslizante. Protección contra espinas. Transpirables y cómodos.', 'guantes.jpg', 'protección'),
	(7, 'Maceta Autorregante 20cm', 6, 16.50, 30, 'Maceta con sistema de autorriego integrado. Autonomía de 2 semanas. Indicador de nivel de agua.', 'maceta_auto.jpg', 'macetas'),
	(8, 'Fertilizante Líquido Universal', 7, 11.99, 55, 'Fertilizante NPK equilibrado para todo tipo de plantas. 500ml. Aplicación cada 15 días.', 'fertilizante.jpg', 'nutrición'),
	(9, 'Kit de Transplante Completo', 7, 24.99, 20, 'Kit con 5 herramientas: pala, rastrillo, transplantador, pulverizador y tijeras. Estuche incluido.', 'kit_transplante.jpg', 'kit'),
	(10, 'Macetas de Terracota Set 3', 7, 18.50, 28, 'Set de 3 macetas de barro natural. Tamaños: 15cm, 18cm, 22cm. Con plato. Permiten respiración de raíces.', 'macetas_barro.jpg', 'macetas');

-- Volcando estructura para tabla ecommerce_plantas.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `nombre_cientifico` varchar(100) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `temporada` enum('verano','primavera','otoño','invierno','todo_año') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `dificultad` varchar(50) DEFAULT NULL,
  `riego` varchar(50) DEFAULT NULL,
  `es_para_ramo` tinyint(1) DEFAULT 0 COMMENT 'Si es 1, puede usarse para crear ramos personalizados',
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ecommerce_plantas.productos: ~30 rows (aproximadamente)
DELETE FROM `productos`;
INSERT INTO `productos` (`id`, `nombre`, `nombre_cientifico`, `categoria_id`, `precio`, `stock`, `temporada`, `descripcion`, `imagen`, `dificultad`, `riego`, `es_para_ramo`) VALUES
	(1, 'Monstera Deliciosa', 'Monstera deliciosa', 1, 29.99, 15, 'primavera', 'Planta tropical de hojas grandes y perforadas. Perfecta para dar un toque selvático a tu hogar. Crece rápidamente en primavera.', 'monstera.jpg', 'Fácil', 'Semanal', 0),
	(2, 'Pilea Peperomioides', 'Pilea peperomioides', 1, 19.99, 20, 'primavera', 'Conocida como la planta del dinero china. Hojas redondas y decorativas. Produce "bebés" que puedes regalar.', 'pilea.jpg', 'Fácil', 'Cada 7-10 días', 0),
	(3, 'Calathea Orbifolia', 'Calathea orbifolia', 1, 35.00, 10, 'primavera', 'Hojas redondas con rayas plateadas espectaculares. Mueve sus hojas con el ritmo circadiano. Purifica el aire.', 'calathea.jpg', 'Media', '2-3 veces/semana', 0),
	(4, 'Begonia Maculata', 'Begonia maculata', 5, 27.00, 12, 'primavera', 'Begonia ala de ángel con puntos blancos característicos. Flores rosadas en primavera-verano.', 'begonia.jpg', 'Media', '2-3 veces/semana', 1),
	(5, 'Maranta Tricolor', 'Maranta leuconeura', 1, 21.50, 15, 'primavera', 'Planta de la oración con hojas que se pliegan por la noche. Colores vivos y patrón único.', 'maranta.jpg', 'Media', '2-3 veces/semana', 0),
	(6, 'Ficus Lyrata', 'Ficus lyrata', 3, 45.00, 8, 'primavera', 'La famosa higuera de hojas de violín. Hojas grandes y brillantes. Perfecta como planta statement.', 'ficus.jpg', 'Media', 'Semanal', 0),
	(7, 'Suculenta Echeveria', 'Echeveria elegans', 2, 8.99, 35, 'primavera', 'Suculenta en forma de rosa perfecta. Colores pastel. Ideal para terrarios y composiciones.', 'echeveria.jpg', 'Fácil', 'Cada 15 días', 0),
	(8, 'Haworthia Cebra', 'Haworthia fasciata', 2, 13.50, 28, 'primavera', 'Suculenta cebra compacta con rayas blancas. Perfecta para espacios pequeños. Muy resistente.', 'haworthia.jpg', 'Fácil', 'Cada 15 días', 0),
	(9, 'Pothos Dorado', 'Epipremnum aureum', 1, 12.99, 30, 'verano', 'Planta trepadora indestructible. Purifica el aire. Crece con mucha luz en verano. Ideal para principiantes.', 'pothos.jpg', 'Muy fácil', 'Cada 10 días', 0),
	(10, 'Aloe Vera', 'Aloe barbadensis', 2, 15.00, 25, 'verano', 'Planta medicinal suculenta. Gel curativo en sus hojas. Ama el sol directo. Muy fácil de cuidar.', 'aloe.jpg', 'Fácil', 'Cada 15 días', 0),
	(11, 'Cactus San Pedro', 'Echinopsis pachanoi', 2, 22.00, 18, 'verano', 'Cactus columnar de crecimiento rápido en verano. Resiste pleno sol. Flores blancas nocturnas espectaculares.', 'cactus.jpg', 'Fácil', 'Cada 20 días', 0),
	(12, 'Costilla de Adán', 'Monstera adansonii', 1, 26.00, 14, 'verano', 'Monstera con agujeros naturales en las hojas. Trepadora vigorosa. Crece mucho en verano.', 'adansonii.jpg', 'Fácil', 'Semanal', 0),
	(13, 'Croton', 'Codiaeum variegatum', 3, 28.00, 12, 'verano', 'Hojas coloridas y brillantes en rojos, amarillos y verdes. Necesita mucha luz para mantener colores.', 'croton.jpg', 'Media', 'Semanal', 0),
	(14, 'Alocasia Amazónica', 'Alocasia amazonica', 1, 38.00, 9, 'verano', 'Oreja de elefante con hojas verde oscuro y venas blancas. Planta tropical dramática. Crece activamente en verano.', 'alocasia.jpg', 'Difícil', '2-3 veces/semana', 0),
	(15, 'Tradescantia Zebrina', 'Tradescantia zebrina', 1, 9.99, 32, 'verano', 'Amor de hombre con hojas moradas y plateadas. Crecimiento rápido. Perfecta para cestas colgantes.', 'tradescantia.jpg', 'Muy fácil', 'Semanal', 0),
	(16, 'Cinta', 'Chlorophytum comosum', 1, 10.50, 35, 'verano', 'Planta araña purificadora de aire. Produce hijuelos. Indestructible y perfecta para colgar.', 'cinta.jpg', 'Muy fácil', 'Semanal', 0),
	(17, 'Helecho de Boston', 'Nephrolepis exaltata', 4, 16.99, 22, 'otoño', 'Helecho colgante decorativo con frondes elegantes. Aporta humedad al ambiente. Perfecto para baños.', 'helecho.jpg', 'Media', '2-3 veces/semana', 0),
	(18, 'Sansevieria', 'Sansevieria trifasciata', 2, 18.50, 25, 'otoño', 'Lengua de suegra indestructible. Purifica el aire por la noche. Tolera negligencia total.', 'sansevieria.jpg', 'Muy fácil', 'Cada 15-20 días', 0),
	(19, 'Drácena Marginata', 'Dracaena marginata', 3, 32.00, 11, 'otoño', 'Drácena de bordes rojos elegante. Tronco esculpido. Purifica el aire. Perfecta para oficinas.', 'dracena.jpg', 'Fácil', 'Cada 10 días', 0),
	(20, 'Peperomia', 'Peperomia obtusifolia', 1, 12.00, 26, 'otoño', 'Planta de caucho bebé con hojas gruesas y brillantes. Compacta. Ideal para escritorios.', 'peperomia.jpg', 'Fácil', 'Cada 10 días', 0),
	(21, 'Filodendro Brasil', 'Philodendron hederaceum', 1, 14.99, 28, 'otoño', 'Filodendro de hojas variegadas en verde y amarillo. Trepadora fácil. Crece incluso en otoño.', 'filodendro.jpg', 'Muy fácil', 'Semanal', 0),
	(22, 'Anturio Rojo', 'Anthurium andraeanum', 5, 33.00, 13, 'otoño', 'Planta con flores rojas brillantes todo el año. Las "flores" son brácteas cerosas que duran meses.', 'anturio.jpg', 'Media', '2-3 veces/semana', 1),
	(23, 'Lirio de la Paz', 'Spathiphyllum wallisii', 5, 23.50, 19, 'otoño', 'Espatifilo con flores blancas elegantes. Purifica el aire excepcionalmente. Te avisa cuando necesita agua.', 'lirio.jpg', 'Fácil', '2-3 veces/semana', 1),
	(24, 'Zamioculca', 'Zamioculcas zamiifolia', 1, 24.99, 22, 'todo_año', 'ZZ plant prácticamente indestructible. Tolera poca luz y olvidos de riego. Brillante y moderna.', 'zamioculca.jpg', 'Muy fácil', 'Cada 15-20 días', 0),
	(25, 'Bambú de la Suerte', 'Dracaena sanderiana', 1, 11.50, 30, 'todo_año', 'Lucky bamboo que crece en agua o tierra. Símbolo de buena suerte. Sin mantenimiento.', 'bambu.jpg', 'Muy fácil', 'Mantener agua', 0),
	(26, 'Suculenta Jade', 'Crassula ovata', 2, 16.50, 24, 'todo_año', 'Planta del dinero con hojas carnosas. Puede vivir décadas. Tronco grueso con el tiempo.', 'jade.jpg', 'Fácil', 'Cada 15 días', 0),
	(27, 'Pothos Marble Queen', 'Epipremnum aureum', 1, 15.99, 20, 'todo_año', 'Pothos variegado blanco y verde. Trepadora elegante. Purifica el aire. Indestructible.', 'pothos_marble.jpg', 'Muy fácil', 'Cada 10 días', 0),
	(28, 'Hoya Carnosa', 'Hoya carnosa', 1, 21.00, 16, 'todo_año', 'Planta de cera con flores perfumadas. Hojas gruesas. Trepadora o colgante. Flores en racimos.', 'hoya.jpg', 'Fácil', 'Cada 10-15 días', 0),
	(29, 'Schefflera', 'Schefflera arboricola', 3, 19.99, 18, 'todo_año', 'Planta paraguas con hojas en forma de dedos. Crece rápido. Tolera poca luz.', 'schefflera.jpg', 'Fácil', 'Semanal', 0),
	(30, 'Sedum Burrito', 'Sedum burrito', 2, 14.50, 22, 'todo_año', 'Suculenta cola de burro perfecta para colgar. Hojas carnosas en cascada. Muy decorativa.', 'sedum.jpg', 'Fácil', 'Cada 15 días', 0);

-- Volcando estructura para tabla ecommerce_plantas.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ecommerce_plantas.usuarios: ~0 rows (aproximadamente)
DELETE FROM `usuarios`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
