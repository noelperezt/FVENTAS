<?php 
class Funciones {

	public function tit($ico,$mod,$sbm) {
		$rt = '
			<ol class="breadcrumb col-sm-12">
			  <li><span class="fa fa-'.$ico.'"></span> <a href="#">'.$mod.'</a></li>
			  <li class="active">'.$sbm.'</li>
			</ol>';
		return $rt;
	}	

	public function modalHeader($titulo) {
		$rt = '
			<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">'.$titulo.'</h4>
		    </div>';
		return $rt;
	}

	public function modalFooter() {
		$rt = '
			<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="submit" class="btn btn-primary">Aceptar</button>
		    </div>';
		return $rt;
	}

	public function modalFooter2() {
		$rt = '
			<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		    </div>';
		return $rt;
	}

	public function selected($var,$var2) {
		$rt = (!strcmp($var, $var2)) ? 'selected' : null;
		return $rt;
	}


}
?>