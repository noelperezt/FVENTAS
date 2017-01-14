<div class="btn-group pull-right">
	<button class="btn btn-inverse btn-lg" onclick="modal('app/clientes/vst/clientes.insert.php','')"><i class="fa fa-plus-square"></i> Agregar Cliente</button>
	<button class="btn btn-inverse btn-lg" onclick="window.open('rpt-clientes-')"><i class="fa fa-print"></i> Imprimir</button>
	</div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="clientes-lista"></div>

<script type="text/javascript">
	load('app/clientes/vst/clientes.lista.php','','clientes-lista');
</script>