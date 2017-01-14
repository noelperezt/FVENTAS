<?php 

class cProductos extends mProductos {

	public function stockMinimo($var,$tot) {
		if($tot<$var) :
			$rt = 'class="danger"';
		elseif  ($var==$tot) :
			$rt = 'class="warning"';
		else :
			$rt = '';
		endif;
		return $rt;
	}
}
?>