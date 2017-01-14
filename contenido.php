<?php 

if(isset($_GET['var'])) :
	$contenido = $musuarios->contenido($_GET['var']);
	if(count($contenido)>0) {
		if(file_exists('app/'.$contenido[0]->sumourl.'.php')) {
			echo $fn->tit($contenido[0]->sumoicono,$contenido[0]->modudescri,$contenido[0]->sumodescri);
			require 'app/'.$contenido[0]->sumourl.'.php';
		} else {
			echo '<br><div class="alert alert-danger">El archivo solicitado no existe.</div>';
		}
	} else {
		echo '<br><div class="alert alert-danger">No tiene permisos de acceso.</div>';
	}
elseif (isset($_GET['alt'])) :
	$ruta = base64_decode($_GET['alt']);
	if(file_exists('app/'.$ruta)) {
		require 'app/'.$ruta;
	} else {
		echo '<br><div class="alert alert-danger">El archivo solicitado no existe.</div>';
	}
else :
	require 'default.php';
endif;

?>