<div class="btn-group pull-right">
	<button class="btn btn-inverse btn-lg" onclick="modal('app/usuarios/vst/usuarios.insert.php','')"><i class="fa fa-plus-square"></i> Agregar Usuario</button>
	<button class="btn btn-inverse btn-lg" onclick="window.open('rpt-usuarios-')"><i class="fa fa-print"></i> Imprimir</button>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="usuarios-lista"></div>

<script type="text/javascript">
	load('app/usuarios/vst/usuarios.lista.php','','usuarios-lista');
</script>