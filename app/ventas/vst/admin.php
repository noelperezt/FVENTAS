<?php 
$clientes = $mclientes->getAll();
?>
<form class="col-sm-8 col-sm-offset-2 buscarCliente">
	<div class="form-group">
		<label class="bolder col-sm-12 control-label">
			Buscar Cliente:
		</label>
		<div class="col-sm-11">
			<select class="form-control chosen" name="clieide" multiple>
				<option value=""></option>
				<?php foreach($clientes as $c) { ?>
					<option value="<?php echo $c->clieide ?>"> <?php echo $c->clienacion ?> - <?php echo $c->cliecedula ?> - <?php echo $c->clierazsoc ?> </option>
				<?php } ?>
			</select>
		</div>
		<div class="col-sm-1">
			<button class="btn btn-primary"><i class="fa fa-check"></i></button>
		</div>
	</div>
</form>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="ventas-perfil-cliente"></div>
<script type="text/javascript">
	$(function(){
		$('.chosen').chosen({
			no_results_text: "No se encontraron coincidencias. <a href='#' onclick='modal(\"app/clientes/vst/clientes.insert.2.php\",\"\")''>Registrar Cliente</a>",
			max_selected_options: 1,
		});
		var formulario = '.buscarCliente'
		$(formulario).validate({
			rules: {
				clieide: {
					required: true,
				},
			},
			 messages: {
				clieide: {
					required: 'Obligatorio',
				},
			},
			submitHandler: function(form) {
				load('app/ventas/vst/ventas.perfil.cliente.php',$(formulario).serialize(),'ventas-perfil-cliente')
			}
		});
	})
</script>