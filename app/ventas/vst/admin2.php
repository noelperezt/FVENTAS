<div class="btn-group pull-right">
	<button class="btn btn-inverse btn-lg" onclick="modal('app/ventas/vst/consulta.fecha.php','')"><i class="fa fa-plus-square"></i> Consultar Ventas</button>
	<button class="btn btn-inverse btn-lg" onclick="window.open('rpt-ventas-')"><i class="fa fa-print"></i> Imprimir</button>
	</div>
	</br>
	</br>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="usuarios-lista"></div>

<script type="text/javascript">
	load('app/ventas/vst/factura.lista.php','','usuarios-lista');
</script>