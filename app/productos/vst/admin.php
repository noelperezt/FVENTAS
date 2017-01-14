<div class="btn-group pull-right">
	<button class="btn btn-inverse btn-lg" onclick="modal('app/productos/vst/productos.insert.php','')"><i class="fa fa-plus-square"></i> Agregar Nuevo Producto</button>
	<button class="btn btn-inverse btn-lg" onclick="window.open('rpt-productos-')"><i class="fa fa-plus-square"></i> Imprimir</button>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="productos-lista"></div>

<script type="text/javascript">
	load('app/productos/vst/productos.lista.php','','productos-lista');
</script>