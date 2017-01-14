<div class="btn-group pull-right">
	<button class="btn btn-inverse btn-lg" onclick="modal('app/ventas/vst/consulta.anulaciones.fecha.php','')"><i class="fa fa-plus-square"></i> Consultar Anulaciones</button>
	<button class="btn btn-inverse btn-lg" onclick="window.open('rpt-anulaciones-')"><i class="fa fa-print"></i> Imprimir</button>
	</div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="usuarios-lista"></div>

<script type="text/javascript">
	load('app/ventas/vst/factura.listaanul.php','','usuarios-lista');
</script>