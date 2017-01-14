<?php 
class cVentas extends mVentas {
	
	public function total($a) {
		$rt = $a->ventprecio*$a->ventcantid;
		return $rt;
	}

	public function total2($b) {
		$rt = $b->veprprecio*$b->veprcantid;
		return $rt;
	}

	public function validarVenta($stock) {
		if($stock<$_POST['cantidad']) {
			$rt = "No hay artículos suficientes en inventario para la venta";
		} else {
			$rt = 1;
		}
		return $rt;
	}
}
?>