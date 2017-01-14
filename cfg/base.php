<?php 

if(file_exists('cfg/')) {
	require 'cfg/config.php';
	require 'cfg/conexion.php';
	require 'cfg/funciones.php';
} else {
	require '../../../cfg/config.php';
	require '../../../cfg/conexion.php';
	require '../../../cfg/funciones.php';
}


$fn = new Funciones();

$mod = array(
		'usuarios',
		'productos',
		'entradas',
		'clientes',
		'ventas',
		'proveedores',
		'empresa',
	);

$sbm = array(
		array('mUsuarios','cUsuarios'),
		array('mProductos','cProductos'),
		array('mEntradas','cEntradas'),
		array('mClientes','cClientes'),
		array('mVentas','cVentas'),
		array('mProveedores','cProveedores'),
		array('mEmpresa','cEmpresa'),
	);

/**
 * Localizando archivos
 * @var [type]
 */
foreach($mod as $im=>$m) {
	$ruta1 = 'app/'.$m.'/cls/';
	$ruta2 = '../../'.$m.'/cls/';
	foreach($sbm[$im] as $is=>$s) {	
		if(file_exists($ruta1)) :
			require $ruta1.$s.'.php';
		elseif (file_exists($ruta2)) :
			require $ruta2.$s.'.php';
		else :
			$ruta3= '../cls/'.$s[0].'.php';
			require $ruta3.$s.'.php';
		endif;
	}
}

/**
 * Instanciado clases
 */

foreach($mod as $im=>$m) {
	foreach($sbm[$im] as $is=>$s) {	
		$cla = strtolower($s);
		$$cla = new $s();
	}
}
?>