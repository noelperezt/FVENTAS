<?php 
require '../../../cfg/base.php';
$stock = $mproductos->stock($_POST['producto']);
$res = $cventas->validarVenta($stock);
if ($res==1) {
	echo $mventas->insertArticulo();
} else {
	echo $res;
}
?>