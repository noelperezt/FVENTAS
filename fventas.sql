-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2016 a las 22:16:52
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `fventas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletecliente`(`ide` INT)
begin
delete from clientes where clieide=ide;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteproducto`(`ide` INT)
BEGIN
DELETE FROM productos WHERE prodide=ide;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteproveedor`(`ide` INT)
begin
delete from proveedores where provide=ide;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteusuario`(`ide` INT)
BEGIN
DELETE FROM acceso WHERE usuaide=ide;
DELETE FROM permisos WHERE usuaide=ide;
DELETE FROM usuarios WHERE usuaide=ide;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteventa`(`ide` INT)
begin
delete from ventas where ventide=ide;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertentrada`(IN `producto` VARCHAR(70), IN `cantidad` DOUBLE, IN `proveedor` INT)
BEGIN
INSERT into entrada (prodide, entrcantid, entrfecha, provide) VALUES (producto, cantidad, now(),proveedor);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatepermiso`(`usua` INT, `sumo` INT, `valor` INT)
BEGIN
DECLARE total int;
SELECT COUNT(*) INTO total FROM permisos WHERE usuaide=usua AND sumoide=sumo;
IF total>0 THEN
UPDATE permisos SET permestado=valor WHERE usuaide=usua AND sumoide=sumo;
ELSE
INSERT INTO permisos (usuaide,sumoide,permestado) VALUES (usua, sumo, 1);
END IF;

	
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `insertarticulo`(`prod` VARCHAR(70), `cantidad` INT, `cliente` INT) RETURNS varchar(1) CHARSET utf8
BEGIN
declare response varchar(100);
declare precioprod double;
if prod=0 THEN
	set response = 'Debe indicar un producto';
else
		select prodprecio into precioprod from productos where prodide=prod;
		insert into ventas (menuide, ventprecio, factide, clieide, ventcantid, ventfecha) 

		values (prod, precioprod, 0, cliente, cantidad, now());
		set response = '1';
end if;
	return response;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insertcliente`(`nacion` CHAR(1), `cedula` INT, `razsoc` VARCHAR(100), `direcc` VARCHAR(255), `telefo` VARCHAR(11)) RETURNS varchar(1) CHARSET utf8
begin
declare total int;
declare repetido varchar(100);
select count(*) into total from clientes where clienacion=nacion and cliecedula=cedula;
if total>0 then 
set repetido  = 'Cliente ya registrado';
else
insert into clientes (clienacion, cliecedula, clierazsoc, cliedirecc, clietelefo)
values (nacion, cedula, razsoc, direcc, telefo);
set repetido = '1';
end if;
return repetido;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insertcliente2`(`nacion` CHAR(1), `cedula` INT, `razsoc` VARCHAR(100), `direcc` VARCHAR(255), `telefo` VARCHAR(11)) RETURNS int(1)
begin
declare total int;
declare idecliente int;
declare ide int;
select count(*) into total from clientes where clienacion=nacion and cliecedula=cedula;
if total>0 then 
select clieide into idecliente from clientes where clienacion=nacion and cliecedula=cedula;
set ide  = idecliente;
else
insert into clientes (clienacion, cliecedula, clierazsoc, cliedirecc, clietelefo)
values (nacion, cedula, razsoc, direcc, telefo);
set ide = LAST_INSERT_ID();
end if;
return ide;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insertproducto`(`producto` VARCHAR(45), `medida` INT(11), `precio` DOUBLE, `stock` INT(11), `codigo` VARCHAR(70)) RETURNS varchar(1) CHARSET latin1
BEGIN
DECLARE total int;
DECLARE repetido varchar(60);
SELECT COUNT(*) INTO total FROM productos WHERE proddescri=producto AND unmeide=medida;
IF total>0 THEN
SET repetido = 'Producto ya registrado con esa unidad de medida';
ELSE
INSERT INTO productos (prodide, proddescri, unmeide, prodprecio, prodstomin)
VALUES (codigo, producto, medida, precio, stock);
SET repetido = '1';
END IF;
RETURN repetido;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insertproveedor`(`razon` VARCHAR(50), `rif` VARCHAR(15), `direccion` VARCHAR(255), `telefono` VARCHAR(11), `correo` VARCHAR(50)) RETURNS varchar(1) CHARSET utf8
BEGIN
declare repetido varchar(100);
declare total int;
declare total2 int;
SELECT COUNT(*) into total from proveedores where provrazsoc=razon;
SELECT COUNT(*) into total2 from proveedores where provrif=rif;
if (total>0) then
set repetido = 'Nombre o razón social ya registrado';
elseif (total2>0) then
set repetido = 'RIF ya registrado';
else
insert into proveedores (provrazsoc,provrif,provdirecc,provtelefo,provcorreo)
values (razon, rif, direccion, telefono, correo);
set repetido = '1';
end if;
RETURN repetido;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insertusuario`(`nombre` VARCHAR(45), `apelli` VARCHAR(45), `nacion` CHAR, `cedula` INT, `usuari` VARCHAR(45), `clave` VARCHAR(32)) RETURNS varchar(45) CHARSET utf8
BEGIN
DECLARE total int;
DECLARE totalusu int;
DECLARE repetido VARCHAR(45);
SELECT COUNT(*) INTO total FROM usuario WHERE usuanacion=nacion AND usuacedula=cedula;
SELECT COUNT(*) INTO totalusu FROM acceso WHERE acceusuari=usuari;
IF total>0 THEN
SET repetido = 'C&eacute;dula de identidad ya registrada';
ELSEIF totalusu>0 THEN
SET repetido = 'Nombre de usuario ya registrado';
ELSE
INSERT INTO usuarios (usuanombre,usuaapelli,usuanacion,usuacedula)
VALUES (nombre, apelli, nacion, cedula);
INSERT INTO acceso (usuaide,acceusuari,acceclave,accesestado)
VALUES (last_insert_id(), usuari, clave, 1);
SET repetido = '1';
END IF;
RETURN repetido;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `stock`(`ide` VARCHAR(70)) RETURNS double
BEGIN
declare entradas double;
declare salidas double;


declare total double;
select sum(entrcantid) into entradas from entrada where prodide=ide;
select  sum(a.ventcantid) into salidas from ventas as a 
where a.menuide=ide;
if salidas>0 then
	set total = entradas-salidas;
else
	set total = entradas;
end if;
return total;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `totalpagar`(`cliente` INT, `factura` INT) RETURNS double
BEGIN
declare suma double;
SELECT sum(ventprecio*ventcantid) into suma from ventas where clieide=cliente and factide=factura;
return suma;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `updatecliente`(`nacion` CHAR(1), `cedula` INT, `razsoc` VARCHAR(100), `direcc` VARCHAR(255), `telefo` VARCHAR(11), `ide` INT) RETURNS varchar(100) CHARSET latin1
begin
declare total int;
declare repetido varchar(100);
select count(*) into total from clientes where clienacion=nacion and cliecedula=cedula and clieide!=ide;
if total>0 then 
set repetido = 'Cliente ya registrado';
else
update clientes set clienacion=nacion, cliecedula=cedula, clierazsoc=razsoc, cliedirecc=direcc, clietelefo=telefo
where clieide=ide;
set repetido = '1';
end if;
return repetido;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `updateproducto`(`producto` VARCHAR(45), `medida` INT, `ide` INT, `precio` DOUBLE, `stock` INT(11)) RETURNS varchar(60) CHARSET utf8
BEGIN
DECLARE total int;
DECLARE repetido varchar(60);
SELECT COUNT(*) INTO total FROM productos WHERE proddescri=producto  AND unmeide=medida AND prodide!=ide;
IF total>0 THEN
SET repetido = 'Producto ya registrado con esa unidad de medida';
ELSE
UPDATE productos SET proddescri=producto, unmeide=medida, prodprecio=precio, prodstomin=stock  WHERE prodide=ide;
SET repetido = '1';
END IF;
RETURN repetido;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `updateproveedor`(`razon` VARCHAR(50), `rif` VARCHAR(15), `direccion` VARCHAR(255), `telefono` INT(11), `correo` VARCHAR(50), `ide` INT) RETURNS varchar(100) CHARSET utf8
BEGIN
declare repetido varchar(100);
declare total int;
declare total2 int;
SELECT COUNT(*) into total from proveedores where provrazsoc=razon and provide!=ide;
SELECT COUNT(*) into total2 from proveedores where provrif=rif and provide!=ide;
if (total>0) then
set repetido = 'Nombre o razón social ya registrado';
elseif (total2>0) then
set repetido = 'RIF ya registrado';
else
update proveedores set provrazsoc=razon, provrif=rif, provdirecc=direccion, provtelefo=telefono, provcorreo=correo where provide=ide;
set repetido = '1';
end if;
RETURN repetido;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `updateusuario`(`nombre` VARCHAR(45), `apelli` VARCHAR(45), `nacion` CHAR, `cedula` INT, `usuari` VARCHAR(45), `clave` VARCHAR(32), `ide` INT) RETURNS varchar(45) CHARSET utf8
BEGIN
DECLARE total int;
DECLARE totalusu int;
DECLARE repetido VARCHAR(45);
SELECT COUNT(*) INTO total FROM usuario WHERE usuanacion=nacion AND usuacedula=cedula AND usuaide!=ide;
SELECT COUNT(*) INTO totalusu FROM acceso WHERE acceusuari=usuari AND usuaide!=ide;
IF total>0 THEN
SET repetido = 'C&eacute;dula de identidad ya registrada';

ELSEIF totalusu>0 THEN
SET repetido = 'Nombre de usuario ya registrado';
ELSE
UPDATE usuarios SET usuanombre=nombre, usuaapelli=apelli, usuanacion=nacion, 
usuacedula=cedula WHERE usuaide=ide;
UPDATE acceso SET acceusuari=usuari, acceclave=clave WHERE usuaide=ide;
SET repetido = '1';
END IF;
RETURN repetido;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE IF NOT EXISTS `acceso` (
  `acceide` int(11) NOT NULL,
  `usuaide` int(11) DEFAULT NULL,
  `acceusuari` varchar(45) DEFAULT NULL,
  `acceclave` varchar(32) DEFAULT NULL,
  `accesestado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`acceide`, `usuaide`, `acceusuari`, `acceclave`, `accesestado`) VALUES
(0, 1, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `clieide` int(11) NOT NULL AUTO_INCREMENT,
  `clienacion` char(1) DEFAULT NULL,
  `cliecedula` int(11) DEFAULT NULL,
  `clierazsoc` varchar(100) DEFAULT NULL,
  `cliedirecc` varchar(255) DEFAULT NULL,
  `clietelefo` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`clieide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`clieide`, `clienacion`, `cliecedula`, `clierazsoc`, `cliedirecc`, `clietelefo`) VALUES
(1, 'V', 24478567, 'Pedro Lopez', 'Core 8', '04245896325');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `empride` int(11) NOT NULL AUTO_INCREMENT,
  `emprrazsoc` varchar(100) DEFAULT NULL,
  `emprrif` varchar(15) DEFAULT NULL,
  `emprlogo` varchar(255) DEFAULT NULL,
  `emprlema` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`empride`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empride`, `emprrazsoc`, `emprrif`, `emprlogo`, `emprlema`) VALUES
(1, 'Electroauto Carrillo F.P', 'V04280317-7', '', 'Electricidad y ElectrÃ³nica Automotriz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE IF NOT EXISTS `entrada` (
  `entride` int(11) NOT NULL AUTO_INCREMENT,
  `prodide` varchar(70) DEFAULT NULL,
  `entrcantid` double DEFAULT NULL,
  `entrfecha` date DEFAULT NULL,
  `provide` int(11) DEFAULT NULL,
  `mapride` int(11) DEFAULT NULL,
  `entrcanmap` decimal(10,2) DEFAULT NULL COMMENT 'Cantidad de materia prima usada',
  PRIMARY KEY (`entride`),
  KEY `prodide` (`prodide`) USING BTREE,
  KEY `provide` (`provide`) USING BTREE,
  KEY `mapride` (`mapride`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`entride`, `prodide`, `entrcantid`, `entrfecha`, `provide`, `mapride`, `entrcanmap`) VALUES
(1, '1234567', 70, '2016-07-07', 1, NULL, NULL),
(2, '1234567', 200, '2016-08-25', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `entradaproductos`
--
CREATE TABLE IF NOT EXISTS `entradaproductos` (
`entrcantid` double
,`entrfecha` date
,`entride` int(11)
,`prodide` varchar(70)
,`proddescri` varchar(45)
,`unmedescri` varchar(45)
,`provrazsoc` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `factide` int(11) NOT NULL AUTO_INCREMENT,
  `clieide` int(11) DEFAULT NULL,
  `facttotal` double DEFAULT NULL,
  `factsubtot` double DEFAULT NULL,
  `factiva` double DEFAULT NULL,
  `factfecha` date DEFAULT NULL,
  `factestado` tinyint(1) NOT NULL DEFAULT '1',
  `usuaide` int(11) DEFAULT NULL,
  PRIMARY KEY (`factide`),
  KEY `clieide` (`clieide`) USING BTREE,
  KEY `usuaide` (`usuaide`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`factide`, `clieide`, `facttotal`, `factsubtot`, `factiva`, `factfecha`, `factestado`, `usuaide`) VALUES
(1, 1, 150000, 132000, 18000, '2016-07-07', 0, 1),
(2, 1, 2070000, 1821600, 248400, '2016-08-25', 0, 1),
(3, 1, 90000, 79200, 10800, '2016-08-25', 0, 1),
(4, 1, 60000, 52800, 7200, '2016-08-25', 0, 1),
(5, 1, 30000, 26400, 3600, '2016-07-07', 0, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listasubmodulos`
--
CREATE TABLE IF NOT EXISTS `listasubmodulos` (
`sumoide` int(11)
,`sumodescri` varchar(45)
,`modudescri` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `moduide` int(11) NOT NULL AUTO_INCREMENT,
  `modudescri` varchar(45) DEFAULT NULL,
  `moduvisibl` int(11) DEFAULT NULL,
  PRIMARY KEY (`moduide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`moduide`, `modudescri`, `moduvisibl`) VALUES
(1, 'Usuarios', 1),
(2, 'Personal', 0),
(3, 'Cargos', 0),
(4, 'Men&uacute;', 0),
(5, 'Productos', 1),
(6, 'Facturar', 1),
(7, 'Clientes', 1),
(8, 'Proveedores', 1),
(9, 'Empresa', 1),
(10, 'Ventas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notacredito`
--

CREATE TABLE IF NOT EXISTS `notacredito` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `idfact` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `notacredito`
--

INSERT INTO `notacredito` (`id`, `fecha`, `idfact`) VALUES
(1, '2016-08-25', 5);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `opcionesmenu`
--
CREATE TABLE IF NOT EXISTS `opcionesmenu` (
`modudescri` varchar(45)
,`sumoide` int(11)
,`sumodescri` varchar(45)
,`sumourl` varchar(100)
,`sumoicono` varchar(45)
,`usuaide` int(11)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `permide` int(11) NOT NULL AUTO_INCREMENT,
  `usuaide` int(11) DEFAULT NULL,
  `sumoide` int(11) DEFAULT NULL,
  `permestado` int(11) DEFAULT NULL,
  PRIMARY KEY (`permide`),
  KEY `usuaide` (`usuaide`) USING BTREE,
  KEY `sumoide` (`sumoide`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`permide`, `usuaide`, `sumoide`, `permestado`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 10, 1),
(15, 1, 11, 1),
(16, 1, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `prodide` varchar(70) NOT NULL,
  `cod` varchar(70) NOT NULL,
  `proddescri` varchar(45) DEFAULT NULL,
  `unmeide` int(45) DEFAULT NULL,
  `prodprecio` double DEFAULT NULL,
  `prodstomin` int(11) NOT NULL,
  PRIMARY KEY (`prodide`),
  KEY `unmeide` (`unmeide`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`prodide`, `cod`, `proddescri`, `unmeide`, `prodprecio`, `prodstomin`) VALUES
('1234567', '', 'Volante', 1, 30000, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `provide` int(11) NOT NULL AUTO_INCREMENT,
  `provrazsoc` varchar(50) DEFAULT NULL,
  `provrif` varchar(15) DEFAULT NULL,
  `provdirecc` varchar(255) DEFAULT NULL,
  `provtelefo` varchar(11) DEFAULT NULL,
  `provcorreo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`provide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`provide`, `provrazsoc`, `provrif`, `provdirecc`, `provtelefo`, `provcorreo`) VALUES
(1, 'Autorepuestos Canarias', 'J012452', 'Calle Orinoco Puerto Ordaz', '28678845', 'canarias@gmail.com'),
(3, 'Noel Perez', 'J458785968', 'Mi casa', '2147483647', 'prueba@server.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submodulos`
--

CREATE TABLE IF NOT EXISTS `submodulos` (
  `sumoide` int(11) NOT NULL AUTO_INCREMENT,
  `moduide` int(11) DEFAULT NULL,
  `sumodescri` varchar(45) DEFAULT NULL,
  `sumourl` varchar(100) DEFAULT NULL,
  `sumoicono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sumoide`),
  KEY `moduide` (`moduide`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `submodulos`
--

INSERT INTO `submodulos` (`sumoide`, `moduide`, `sumodescri`, `sumourl`, `sumoicono`) VALUES
(1, 1, 'Usuarios', 'usuarios/vst/admin', 'users'),
(2, 2, 'Personal', 'personal/vst/admin', 'users'),
(3, 3, 'Cargos', 'cargos/vst/admin', 'bars'),
(4, 4, 'Men&uacute;', 'menu/vst/admin', 'coffee'),
(5, 5, 'Inventario', 'productos/vst/admin', 'cube'),
(6, 6, 'Facturacion', 'ventas/vst/admin', 'money'),
(7, 7, 'Clientes', 'clientes/vst/admin', 'bars'),
(8, 8, 'Proveedores', 'proveedores/vst/admin', 'cube'),
(10, 9, 'Organizacion', 'empresa/vst/admin', 'gears'),
(11, 10, 'Ventas', 'ventas/vst/admin2', 'dollar'),
(12, 10, 'Anulaciones', 'ventas/vst/admin3', 'unlink');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidamedid`
--

CREATE TABLE IF NOT EXISTS `unidamedid` (
  `unmeide` int(11) NOT NULL AUTO_INCREMENT,
  `unmedescri` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`unmeide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `unidamedid`
--

INSERT INTO `unidamedid` (`unmeide`, `unmedescri`) VALUES
(1, 'Unidades'),
(2, 'Kilogramos'),
(3, 'Litros');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usuario`
--
CREATE TABLE IF NOT EXISTS `usuario` (
`usuaide` int(11)
,`usuanombre` varchar(45)
,`usuaapelli` varchar(45)
,`usuanacion` char(1)
,`usuacedula` int(11)
,`acceusuari` varchar(45)
,`acceclave` varchar(32)
,`accesestado` int(11)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuaide` int(11) NOT NULL AUTO_INCREMENT,
  `usuanombre` varchar(45) DEFAULT NULL,
  `usuaapelli` varchar(45) DEFAULT NULL,
  `usuanacion` char(1) DEFAULT NULL,
  `usuacedula` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuaide`),
  UNIQUE KEY `usuacedula_UNIQUE` (`usuacedula`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuaide`, `usuanombre`, `usuaapelli`, `usuanacion`, `usuacedula`) VALUES
(1, 'admin', 'admin', 'V', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `ventide` int(11) NOT NULL AUTO_INCREMENT,
  `menuide` varchar(70) DEFAULT NULL COMMENT 'prodide',
  `ventprecio` double DEFAULT NULL,
  `factide` int(11) DEFAULT NULL,
  `clieide` int(11) DEFAULT NULL,
  `ventcantid` int(11) DEFAULT NULL,
  `ventfecha` date DEFAULT NULL,
  PRIMARY KEY (`ventide`),
  KEY `menuide` (`menuide`) USING BTREE,
  KEY `factide` (`factide`) USING BTREE,
  KEY `clieide` (`clieide`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_productos`
--
CREATE TABLE IF NOT EXISTS `vw_productos` (
`prodide` varchar(70)
,`proddescri` varchar(45)
,`prodprecio` double
,`unmeide` int(45)
,`prodstomin` int(11)
,`unmedescri` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_ventas`
--
CREATE TABLE IF NOT EXISTS `vw_ventas` (
`ventide` int(11)
,`ventprecio` double
,`clieide` int(11)
,`factide` int(11)
,`ventcantid` int(11)
,`ventfecha` date
,`menuide` varchar(70)
,`proddescri` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `entradaproductos`
--
DROP TABLE IF EXISTS `entradaproductos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `entradaproductos` AS select `a`.`entrcantid` AS `entrcantid`,`a`.`entrfecha` AS `entrfecha`,`a`.`entride` AS `entride`,`a`.`prodide` AS `prodide`,`b`.`proddescri` AS `proddescri`,`c`.`unmedescri` AS `unmedescri`,`d`.`provrazsoc` AS `provrazsoc` from (((`entrada` `a` join `productos` `b` on((`a`.`prodide` = `b`.`prodide`))) join `unidamedid` `c` on((`b`.`unmeide` = `c`.`unmeide`))) join `proveedores` `d` on((`a`.`provide` = `d`.`provide`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `listasubmodulos`
--
DROP TABLE IF EXISTS `listasubmodulos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listasubmodulos` AS select `a`.`sumoide` AS `sumoide`,`a`.`sumodescri` AS `sumodescri`,`b`.`modudescri` AS `modudescri` from (`submodulos` `a` join `modulos` `b` on((`a`.`moduide` = `b`.`moduide`))) where (`b`.`moduvisibl` = 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `opcionesmenu`
--
DROP TABLE IF EXISTS `opcionesmenu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `opcionesmenu` AS select `c`.`modudescri` AS `modudescri`,`b`.`sumoide` AS `sumoide`,`b`.`sumodescri` AS `sumodescri`,`b`.`sumourl` AS `sumourl`,`b`.`sumoicono` AS `sumoicono`,`a`.`usuaide` AS `usuaide` from ((`permisos` `a` join `submodulos` `b` on((`a`.`sumoide` = `b`.`sumoide`))) join `modulos` `c` on((`b`.`moduide` = `c`.`moduide`))) where ((`a`.`permestado` = 1) and (`c`.`moduvisibl` = 1));

-- --------------------------------------------------------

--
-- Estructura para la vista `usuario`
--
DROP TABLE IF EXISTS `usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuario` AS select `a`.`usuaide` AS `usuaide`,`a`.`usuanombre` AS `usuanombre`,`a`.`usuaapelli` AS `usuaapelli`,`a`.`usuanacion` AS `usuanacion`,`a`.`usuacedula` AS `usuacedula`,`b`.`acceusuari` AS `acceusuari`,`b`.`acceclave` AS `acceclave`,`b`.`accesestado` AS `accesestado` from (`usuarios` `a` join `acceso` `b` on((`a`.`usuaide` = `b`.`usuaide`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_productos`
--
DROP TABLE IF EXISTS `vw_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_productos` AS select `a`.`prodide` AS `prodide`,`a`.`proddescri` AS `proddescri`,`a`.`prodprecio` AS `prodprecio`,`a`.`unmeide` AS `unmeide`,`a`.`prodstomin` AS `prodstomin`,`b`.`unmedescri` AS `unmedescri` from (`productos` `a` join `unidamedid` `b` on((`a`.`unmeide` = `b`.`unmeide`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_ventas`
--
DROP TABLE IF EXISTS `vw_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ventas` AS select `a`.`ventide` AS `ventide`,`a`.`ventprecio` AS `ventprecio`,`a`.`clieide` AS `clieide`,`a`.`factide` AS `factide`,`a`.`ventcantid` AS `ventcantid`,`a`.`ventfecha` AS `ventfecha`,`a`.`menuide` AS `menuide`,`b`.`proddescri` AS `proddescri` from (`ventas` `a` join `productos` `b` on((`a`.`menuide` = `b`.`prodide`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`clieide`) REFERENCES `clientes` (`clieide`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`usuaide`) REFERENCES `usuarios` (`usuaide`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`usuaide`) REFERENCES `usuarios` (`usuaide`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`sumoide`) REFERENCES `submodulos` (`sumoide`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`unmeide`) REFERENCES `unidamedid` (`unmeide`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `submodulos`
--
ALTER TABLE `submodulos`
  ADD CONSTRAINT `submodulos_ibfk_1` FOREIGN KEY (`moduide`) REFERENCES `modulos` (`moduide`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
