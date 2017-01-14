<?php 

class cUsuarios extends mUsuarios {

	public function estadoUsuario($var) {
		$rt = ($var==1) ? 'Activo' : 'Inactivo';
		return $rt;
	}

	public function valoresPermiso($var,$ind) {
		$texto = ($var==1) ? 'Permitido' : 'Denegado';
		$valor = ($var==1) ? 0 : 1;
		$clase = ($var==1) ? 'danger' : 'success';
		$boton = ($var==1) ? 'Denegar' : 'Permitir';
		$rt = array(
			'texto'=>$texto,
			'valor'=>$valor, 
			'clase'=>$clase, 
			'boton'=>$boton, 
			);
		return $rt[$ind];
	}
}
?>