function alerta(capa,tipo,data) {
	$('.'+capa).fadeIn().html('<div class="alert alert-'+tipo+'">'+data+'</div>');
}

function cerraralerta(capa) {
	$('.'+capa).fadeOut();
}

function load(url,datos,capa) {
	$.post(url,datos,function(data){
		$('.'+capa).fadeIn().html(data);
	})
}

function modal(url,datos) {
	$.post(url,datos,function(data){
		$('.modal').modal('show');
		$('.modal .modal-dialog .modal-content').html(data);
	})
}
function cerrarmodal() {
	$('.modal').modal('hide');
}
