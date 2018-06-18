-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2018 a las 17:58:15
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mode`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idadministrador` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `fk_tipo_admin` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `salt` varchar(255) NOT NULL,
  `fk_pais` varchar(10) NOT NULL,
  `fk_ccaa` varchar(10) NOT NULL,
  `fk_provincia` varchar(10) NOT NULL,
  `poblacion` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `numero_de_accesos` int(11) NOT NULL,
  `fecha_quinto_acceso` time DEFAULT NULL,
  `deshabilitar` tinyint(1) NOT NULL,
  `url_recuperar_pass` varchar(255) DEFAULT NULL,
  `fecha_url_recuperar_pass` time DEFAULT NULL,
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idadministrador`, `nombre`, `apellidos`, `dni`, `fk_tipo_admin`, `fecha_nacimiento`, `salt`, `fk_pais`, `fk_ccaa`, `fk_provincia`, `poblacion`, `direccion`, `codigo_postal`, `telefono`, `mail`, `numero_de_accesos`, `fecha_quinto_acceso`, `deshabilitar`, `url_recuperar_pass`, `fecha_url_recuperar_pass`, `leido`) VALUES
(1, 'root', 'root root', '00000000P', 'RT', '1910-10-10', '$2y$10$vxT6ZzJMk22Jv6AJ.I6sBOOUwZtyL2ms9pcg7W4jibpWv.k6o.vkG', 'ES', 'ES-AR', 'ES-TE', 'Teruel', 'root 10', 44002, 978101010, 'root@gmail.com', 0, NULL, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id_archivo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `archivo` longblob,
  `fk_campana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspecto`
--

CREATE TABLE `aspecto` (
  `id_aspecto` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `importe` decimal(10,0) DEFAULT NULL,
  `fk_campana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aspecto`
--

INSERT INTO `aspecto` (`id_aspecto`, `nombre`, `descripcion`, `importe`, `fk_campana`) VALUES
(1, 'Aspecto 1', 'Descripción del aspecto 1 de la campaña', '140', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspecto_tiene_linea_presupuestaria`
--

CREATE TABLE `aspecto_tiene_linea_presupuestaria` (
  `idaspecto_tiene_linea_presupuestaria` int(11) NOT NULL,
  `fk_linea_presupuestaria` int(11) DEFAULT NULL,
  `fk_aspecto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aspecto_tiene_linea_presupuestaria`
--

INSERT INTO `aspecto_tiene_linea_presupuestaria` (`idaspecto_tiene_linea_presupuestaria`, `fk_linea_presupuestaria`, `fk_aspecto`) VALUES
(1, 1, 1),
(2, 1, NULL),
(3, 1, NULL),
(4, 1, NULL),
(5, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campana`
--

CREATE TABLE `campana` (
  `id_campana` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `grupos` text NOT NULL,
  `descripcion` text,
  `estado` int(11) DEFAULT NULL COMMENT '1 - Edición \n2 - Abierto a consulta\n3 - Cerrado a consulta\n0 - Borrado/Cancelado',
  `fk_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `campana`
--

INSERT INTO `campana` (`id_campana`, `fechaInicio`, `fechaFin`, `nombre`, `grupos`, `descripcion`, `estado`, `fk_cliente`) VALUES
(0, '2018-03-11', '2018-04-11', 'Campaña 1', 'Grupos 1, 2 y 3', 'Descripción de la campaña 1', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ccaa`
--

CREATE TABLE `ccaa` (
  `idccaa` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fk_pais` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ccaa`
--

INSERT INTO `ccaa` (`idccaa`, `nombre`, `fk_pais`) VALUES
('ES-AN', 'Andalucía', 'ES'),
('ES-AR', 'Aragón', 'ES'),
('ES-AS', 'Principado de Asturias', 'ES'),
('ES-CB', 'Cantabria', 'ES'),
('ES-CE', 'Ceuta', 'ES'),
('ES-CL', 'Castilla y León', 'ES'),
('ES-CM', 'Castilla-La Mancha', 'ES'),
('ES-CN', 'Canarias', 'ES'),
('ES-CT', 'Cataluña', 'ES'),
('ES-EX', 'Extremadura', 'ES'),
('ES-GA', 'Galicia', 'ES'),
('ES-IB', 'Islas Baleares', 'ES'),
('ES-MC', 'Región de Murcia', 'ES'),
('ES-MD', 'Comunidad de Madrid', 'ES'),
('ES-ML', 'Melilla', 'ES'),
('ES-NC', 'Comunidad Foral de Navarra', 'ES'),
('ES-PV', 'País Vasco', 'ES'),
('ES-RI', 'La Rioja', 'ES'),
('ES-VC', 'Comunidad Valenciana', 'ES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1c064nujgk0i44mpn9ioqbentsbevog4', '::1', 1520811698, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303831313639383b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b69645f636c69656e74657c733a313a2231223b6e6f6d627265436c69656e74657c733a31363a22436c69656e7465205072756562612031223b6e6966436c69656e74657c733a393a22423132333431323334223b72617a6f6e536f6369616c436c69656e74657c733a333a22435031223b656d61696c436c69656e74657c733a31353a22656d61696c40656d61696c2e636f6d223b776562436c69656e74657c733a31383a227777772e776562636c69656e74652e636f6d223b6d656e73616a657c733a33353a2253652068612063726561646f20636f7272656374616d656e7465206c61206c696e6561223b5f5f63695f766172737c613a323a7b733a373a226d656e73616a65223b733a333a226f6c64223b733a31313a227469706f4d656e73616a65223b733a333a226f6c64223b7d7469706f4d656e73616a657c693a313b),
('2g1kcnu73d0uvmofgfe49201228hincu', '::1', 1520620263, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303631383135333b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b),
('41aqr9n7t6s4d79nq04b6p8fjbgrhrub', '::1', 1520510408, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303531303232373b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b6d656e73616a654c6f67696e7c623a303b5f5f63695f766172737c613a323a7b733a31323a226d656e73616a654c6f67696e223b733a333a226e6577223b733a31313a227469706f4d656e73616a65223b733a333a226e6577223b7d7469706f4d656e73616a657c693a333b),
('6gaosr1v49i8k1e4rs7voub9of5c1408', '::1', 1520808695, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303830383639353b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b69645f636c69656e74657c733a313a2231223b6e6f6d627265436c69656e74657c733a31363a22436c69656e7465205072756562612031223b6e6966436c69656e74657c733a393a22423132333431323334223b72617a6f6e536f6369616c436c69656e74657c733a333a22435031223b656d61696c436c69656e74657c733a31353a22656d61696c40656d61696c2e636f6d223b776562436c69656e74657c733a31383a227777772e776562636c69656e74652e636f6d223b),
('6i221voo9ik57iqo97u13ofg4i8hqq3k', '::1', 1520801304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303830313330343b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b69645f636c69656e74657c733a313a2231223b6e6f6d627265436c69656e74657c733a31363a22436c69656e7465205072756562612031223b6e6966436c69656e74657c733a393a22423132333431323334223b72617a6f6e536f6369616c436c69656e74657c733a333a22435031223b656d61696c436c69656e74657c733a31353a22656d61696c40656d61696c2e636f6d223b776562436c69656e74657c733a31383a227777772e776562636c69656e74652e636f6d223b),
('75thvlft4heahi1vq5dlc5d68puj6mb0', '::1', 1520801304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303830313330343b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b69645f636c69656e74657c733a313a2231223b6e6f6d627265436c69656e74657c733a31363a22436c69656e7465205072756562612031223b6e6966436c69656e74657c733a393a22423132333431323334223b72617a6f6e536f6369616c436c69656e74657c733a333a22435031223b656d61696c436c69656e74657c733a31353a22656d61696c40656d61696c2e636f6d223b776562436c69656e74657c733a31383a227777772e776562636c69656e74652e636f6d223b),
('fhs6d8r7e27ubidm36b39otaqf9s358r', '::1', 1520802664, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303830313334363b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b69645f636c69656e74657c733a313a2231223b6e6f6d627265436c69656e74657c733a31363a22436c69656e7465205072756562612031223b6e6966436c69656e74657c733a393a22423132333431323334223b72617a6f6e536f6369616c436c69656e74657c733a333a22435031223b656d61696c436c69656e74657c733a31353a22656d61696c40656d61696c2e636f6d223b776562436c69656e74657c733a31383a227777772e776562636c69656e74652e636f6d223b),
('jdf30an5cvjeq5od2v517tk05uimgnrt', '::1', 1520815650, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303831343735363b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b69645f636c69656e74657c733a313a2231223b6e6f6d627265436c69656e74657c733a31363a22436c69656e7465205072756562612031223b6e6966436c69656e74657c733a393a22423132333431323334223b72617a6f6e536f6369616c436c69656e74657c733a333a22435031223b656d61696c436c69656e74657c733a31353a22656d61696c40656d61696c2e636f6d223b776562436c69656e74657c733a31383a227777772e776562636c69656e74652e636f6d223b),
('ke4mrr1uhnej6b5cu6j522bam5b68veg', '::1', 1520505790, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303530353739303b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b6d656e73616a654c6f67696e7c623a303b5f5f63695f766172737c613a323a7b733a31323a226d656e73616a654c6f67696e223b733a333a226e6577223b733a31313a227469706f4d656e73616a65223b733a333a226e6577223b7d7469706f4d656e73616a657c693a333b),
('ksah0bhsk9lj52f1u70hg2jmebh943kr', '::1', 1521474998, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532313437343833303b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b),
('pov0e2qebos5dl0m78pqf2pn4qc3erqv', '::1', 1520814756, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303831343735363b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b69645f636c69656e74657c733a313a2231223b6e6f6d627265436c69656e74657c733a31363a22436c69656e7465205072756562612031223b6e6966436c69656e74657c733a393a22423132333431323334223b72617a6f6e536f6369616c436c69656e74657c733a333a22435031223b656d61696c436c69656e74657c733a31353a22656d61696c40656d61696c2e636f6d223b776562436c69656e74657c733a31383a227777772e776562636c69656e74652e636f6d223b),
('qfpimqf3dl4u23g26thh8ob4ifb9nane', '::1', 1520510227, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303531303232373b69645573756172696f7c733a313a2231223b6e6f6d6272655573756172696f7c733a343a22726f6f74223b646e695573756172696f7c733a393a22303030303030303050223b6d656e73616a654c6f67696e7c623a303b5f5f63695f766172737c613a323a7b733a31323a226d656e73616a654c6f67696e223b733a333a226e6577223b733a31313a227469706f4d656e73616a65223b733a333a226e6577223b7d7469706f4d656e73616a657c693a333b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `nif` varchar(45) DEFAULT NULL,
  `razonSocial` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `nif`, `razonSocial`, `email`, `web`) VALUES
(1, 'Cliente Prueba 1', 'B12341234', 'CP1', 'email@email.com', 'www.webcliente.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

CREATE TABLE `cuestionario` (
  `id_cuestionario` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `fk_campana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_fijo`
--

CREATE TABLE `item_fijo` (
  `id_item_fijo` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_variable`
--

CREATE TABLE `item_variable` (
  `id_item_variable` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `fk_campana` int(11) DEFAULT NULL,
  `fk_aspeto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_presupuestaria`
--

CREATE TABLE `linea_presupuestaria` (
  `id_linea_presupuestaria` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `importe` decimal(10,0) DEFAULT NULL,
  `fk_campana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea_presupuestaria`
--

INSERT INTO `linea_presupuestaria` (`id_linea_presupuestaria`, `nombre`, `descripcion`, `importe`, `fk_campana`) VALUES
(1, 'Linea 1', 'Descripción de la línea presupuestaria 1', '10000', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `accion` text,
  `consuluta_sql` text,
  `fk_usuario` int(11) DEFAULT NULL,
  `fk_campana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idpais` varchar(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idpais`, `nombre`, `latitud`, `longitud`) VALUES
('ES', 'España', 40.4189, -3.69194);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_campana`
--

CREATE TABLE `permiso_campana` (
  `id_permiso_campana` int(11) NOT NULL,
  `permiso_escritura` int(11) DEFAULT NULL COMMENT '0 - No, solo lectura\n1 - Sí\nSin registro, sin acceso',
  `fk_usuario` int(11) DEFAULT NULL,
  `fk_campana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idprovincia` varchar(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fk_ccaa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idprovincia`, `nombre`, `fk_ccaa`) VALUES
('ES-A', 'Alicante', 'ES-VC'),
('ES-AB', 'Albacete', 'ES-CM'),
('ES-AL', 'Almería', 'ES-AN'),
('ES-AV', 'Ávila', 'ES-CL'),
('ES-B', 'Barcelona', 'ES-CT'),
('ES-BA', 'Badajoz', 'ES-EX'),
('ES-BI', 'Vizcaya', 'ES-PV'),
('ES-BU', 'Burgos', 'ES-CL'),
('ES-C', 'A Coruña', 'ES-GA'),
('ES-CA', 'Cádiz', 'ES-AN'),
('ES-CC', 'Cáceres', 'ES-EX'),
('ES-CE', 'Ceuta', 'ES-CE'),
('ES-CO', 'Córdoba', 'ES-AN'),
('ES-CR', 'Ciudad Real', 'ES-CM'),
('ES-CS', 'Castellón', 'ES-VC'),
('ES-CU', 'Cuenca', 'ES-CM'),
('ES-GC', 'Las Palmas', 'ES-CN'),
('ES-GI', 'Gerona', 'ES-CT'),
('ES-GR', 'Granada', 'ES-AN'),
('ES-GU', 'Guadalajara', 'ES-CM'),
('ES-H', 'Huelva', 'ES-AN'),
('ES-HU', 'Huesca', 'ES-AR'),
('ES-J', 'Jaén', 'ES-AN'),
('ES-L', 'Lérida', 'ES-CT'),
('ES-LE', 'León', 'ES-CL'),
('ES-LO', 'La Rioja', 'ES-RI'),
('ES-LU', 'Lugo', 'ES-GA'),
('ES-M', 'Madrid', 'ES-MD'),
('ES-MA', 'Málaga', 'ES-AN'),
('ES-ML', 'Melilla', 'ES-ML'),
('ES-MU', 'Murcia', 'ES-MC'),
('ES-NA', 'Navarra', 'ES-NC'),
('ES-O', 'Asturias', 'ES-AS'),
('ES-OR', 'Orense', 'ES-GA'),
('ES-P', 'Palencia', 'ES-CL'),
('ES-PM', 'Baleares', 'ES-IB'),
('ES-PO', 'Pontevedra', 'ES-GA'),
('ES-S', 'Cantabria', 'ES-CB'),
('ES-SA', 'Salamanca', 'ES-CL'),
('ES-SE', 'Sevilla', 'ES-AN'),
('ES-SG', 'Segovia', 'ES-CL'),
('ES-SO', 'Soria', 'ES-CL'),
('ES-SS', 'Guipúzcoa', 'ES-PV'),
('ES-T', 'Tarragona', 'ES-CT'),
('ES-TE', 'Teruel', 'ES-AR'),
('ES-TF', 'Santa Cruz de Tenerife', 'ES-CN'),
('ES-TO', 'Toledo', 'ES-CM'),
('ES-V', 'Valencia', 'ES-VC'),
('ES-VA', 'Valladolid', 'ES-CL'),
('ES-VI', 'Álava', 'ES-PV'),
('ES-Z', 'Zaragoza', 'ES-AR'),
('ES-ZA', 'Zamora', 'ES-CL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_fijo`
--

CREATE TABLE `respuesta_fijo` (
  `id_respuesta_fijo` int(11) NOT NULL,
  `valor` int(11) DEFAULT NULL COMMENT 'Valores de 1 a 5',
  `fk_item_fijo` int(11) DEFAULT NULL,
  `fk_cuestionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_variable`
--

CREATE TABLE `respuesta_variable` (
  `id_respuesta_variable` int(11) NOT NULL,
  `valor` int(11) DEFAULT NULL COMMENT 'Valores de 1 a 5',
  `fk_item_variable` int(11) DEFAULT NULL,
  `fk_cuestionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_administrador`
--

CREATE TABLE `tipo_administrador` (
  `idtipo_administrador` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_administrador`
--

INSERT INTO `tipo_administrador` (`idtipo_administrador`, `nombre`) VALUES
('RT', 'root');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `fk_cliente` int(11) DEFAULT NULL,
  `es_administrador` int(11) DEFAULT NULL COMMENT '0- No (usuarios creados por administrador del cliente)\n1 - Sí (usuarios creados por administrador del sistema)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idadministrador`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD KEY `fk_admin_tipo_admin_idx` (`fk_tipo_admin`),
  ADD KEY `fk_admin_pais_idx` (`fk_pais`),
  ADD KEY `fk_admin_ccaa_idx` (`fk_ccaa`),
  ADD KEY `fk_admin_provincia_idx` (`fk_provincia`);

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_a_campana_idx` (`fk_campana`);

--
-- Indices de la tabla `aspecto`
--
ALTER TABLE `aspecto`
  ADD PRIMARY KEY (`id_aspecto`),
  ADD KEY `fk_a_campana_idx` (`fk_campana`);

--
-- Indices de la tabla `aspecto_tiene_linea_presupuestaria`
--
ALTER TABLE `aspecto_tiene_linea_presupuestaria`
  ADD PRIMARY KEY (`idaspecto_tiene_linea_presupuestaria`),
  ADD KEY `fk_aspecto_linea_pre_idx` (`fk_linea_presupuestaria`),
  ADD KEY `fk_aspecto_aspecto_idx` (`fk_aspecto`);

--
-- Indices de la tabla `campana`
--
ALTER TABLE `campana`
  ADD PRIMARY KEY (`id_campana`),
  ADD KEY `fk_a_cliente_idx` (`fk_cliente`);

--
-- Indices de la tabla `ccaa`
--
ALTER TABLE `ccaa`
  ADD PRIMARY KEY (`idccaa`),
  ADD KEY `fk_ccaa_pais_idx` (`fk_pais`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD PRIMARY KEY (`id_cuestionario`),
  ADD KEY `fk_a_campana_idx` (`fk_campana`);

--
-- Indices de la tabla `item_fijo`
--
ALTER TABLE `item_fijo`
  ADD PRIMARY KEY (`id_item_fijo`);

--
-- Indices de la tabla `item_variable`
--
ALTER TABLE `item_variable`
  ADD PRIMARY KEY (`id_item_variable`),
  ADD KEY `fk_a_campana_idx` (`fk_campana`),
  ADD KEY `fk_a_aspecto_idx` (`fk_aspeto`);

--
-- Indices de la tabla `linea_presupuestaria`
--
ALTER TABLE `linea_presupuestaria`
  ADD PRIMARY KEY (`id_linea_presupuestaria`),
  ADD KEY `fk_a_campana_idx` (`fk_campana`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_a_usuario_idx` (`fk_usuario`),
  ADD KEY `fk_a_campaña_idx` (`fk_campana`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idpais`);

--
-- Indices de la tabla `permiso_campana`
--
ALTER TABLE `permiso_campana`
  ADD PRIMARY KEY (`id_permiso_campana`),
  ADD KEY `fk_a_usuario_idx` (`fk_usuario`),
  ADD KEY `fk_a_campana_idx` (`fk_campana`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idprovincia`),
  ADD KEY `fk_provincia_ccaa_idx` (`fk_ccaa`);

--
-- Indices de la tabla `respuesta_fijo`
--
ALTER TABLE `respuesta_fijo`
  ADD PRIMARY KEY (`id_respuesta_fijo`),
  ADD KEY `fk_a_cuestionario_idx` (`fk_cuestionario`),
  ADD KEY `fk_a_item_fijo_idx` (`fk_item_fijo`);

--
-- Indices de la tabla `respuesta_variable`
--
ALTER TABLE `respuesta_variable`
  ADD PRIMARY KEY (`id_respuesta_variable`),
  ADD KEY `fk_a_cuestionario_idx` (`fk_cuestionario`),
  ADD KEY `fk_a_item_variable_idx` (`fk_item_variable`);

--
-- Indices de la tabla `tipo_administrador`
--
ALTER TABLE `tipo_administrador`
  ADD PRIMARY KEY (`idtipo_administrador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fkAEmpresa_idx` (`fk_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idadministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `aspecto`
--
ALTER TABLE `aspecto`
  MODIFY `id_aspecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `aspecto_tiene_linea_presupuestaria`
--
ALTER TABLE `aspecto_tiene_linea_presupuestaria`
  MODIFY `idaspecto_tiene_linea_presupuestaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  MODIFY `id_cuestionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_fijo`
--
ALTER TABLE `item_fijo`
  MODIFY `id_item_fijo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_variable`
--
ALTER TABLE `item_variable`
  MODIFY `id_item_variable` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea_presupuestaria`
--
ALTER TABLE `linea_presupuestaria`
  MODIFY `id_linea_presupuestaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `respuesta_fijo`
--
ALTER TABLE `respuesta_fijo`
  MODIFY `id_respuesta_fijo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta_variable`
--
ALTER TABLE `respuesta_variable`
  MODIFY `id_respuesta_variable` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_admin_ccaa` FOREIGN KEY (`fk_ccaa`) REFERENCES `ccaa` (`idccaa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_admin_pais` FOREIGN KEY (`fk_pais`) REFERENCES `pais` (`idpais`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_admin_provincia` FOREIGN KEY (`fk_provincia`) REFERENCES `provincia` (`idprovincia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_admin_tipo_admin` FOREIGN KEY (`fk_tipo_admin`) REFERENCES `tipo_administrador` (`idtipo_administrador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `fk_a_campana_archivo` FOREIGN KEY (`fk_campana`) REFERENCES `campana` (`id_campana`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `aspecto`
--
ALTER TABLE `aspecto`
  ADD CONSTRAINT `fk_a_campana_asp` FOREIGN KEY (`fk_campana`) REFERENCES `campana` (`id_campana`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `aspecto_tiene_linea_presupuestaria`
--
ALTER TABLE `aspecto_tiene_linea_presupuestaria`
  ADD CONSTRAINT `fk_asp_aspecto` FOREIGN KEY (`fk_aspecto`) REFERENCES `aspecto` (`id_aspecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asp_linea_pre` FOREIGN KEY (`fk_linea_presupuestaria`) REFERENCES `linea_presupuestaria` (`id_linea_presupuestaria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `campana`
--
ALTER TABLE `campana`
  ADD CONSTRAINT `fk_a_cliente` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ccaa`
--
ALTER TABLE `ccaa`
  ADD CONSTRAINT `fk_ccaa_pais` FOREIGN KEY (`fk_pais`) REFERENCES `pais` (`idpais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD CONSTRAINT `fk_a_campana_cmp` FOREIGN KEY (`fk_campana`) REFERENCES `campana` (`id_campana`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `item_variable`
--
ALTER TABLE `item_variable`
  ADD CONSTRAINT `fk_a_aspecto_item` FOREIGN KEY (`fk_aspeto`) REFERENCES `aspecto` (`id_aspecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_a_campana_item` FOREIGN KEY (`fk_campana`) REFERENCES `campana` (`id_campana`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `linea_presupuestaria`
--
ALTER TABLE `linea_presupuestaria`
  ADD CONSTRAINT `fk_a_campana` FOREIGN KEY (`fk_campana`) REFERENCES `campana` (`id_campana`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_a_campaña` FOREIGN KEY (`fk_campana`) REFERENCES `campana` (`id_campana`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_a_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso_campana`
--
ALTER TABLE `permiso_campana`
  ADD CONSTRAINT `fk_a_campana_permiso` FOREIGN KEY (`fk_campana`) REFERENCES `campana` (`id_campana`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_a_usuario_permiso` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `fk_provincia_ccaa` FOREIGN KEY (`fk_ccaa`) REFERENCES `ccaa` (`idccaa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta_fijo`
--
ALTER TABLE `respuesta_fijo`
  ADD CONSTRAINT `fk_a_cuestionario` FOREIGN KEY (`fk_cuestionario`) REFERENCES `cuestionario` (`id_cuestionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_a_item_fijo` FOREIGN KEY (`fk_item_fijo`) REFERENCES `item_fijo` (`id_item_fijo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuesta_variable`
--
ALTER TABLE `respuesta_variable`
  ADD CONSTRAINT `fk_a_cuestionario_resp_vble` FOREIGN KEY (`fk_cuestionario`) REFERENCES `cuestionario` (`id_cuestionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_a_item_variable_resp_vble` FOREIGN KEY (`fk_item_variable`) REFERENCES `item_variable` (`id_item_variable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkUsuario-Cliente` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
