<?php 
require '../../../cfg/base.php';
$prov = $mproveedores->getAll();
?>
<form action="" class="well insertEntrada col-sm-10 col-sm-offset-1">
	<div class="form-group col-sm-6">
		<label for="" class="col-sm-12 bolder label-control">
			Proveedor
		</label>
		<div class="col-sm-12">
			<select name="proveedor" id="" class="form-control">
				<option value=""></option>
				<?php foreach($prov as $p) : ?>
					<option value="<?php echo $p->provide ?>"><?php echo $p->provrazsoc?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-4">
		<label for="" class="col-sm-12 bolder label-control">
			Cantidad:
		</label>
		<div class="col-sm-12">
			<input type="text" class="form-control" name="cantidad">
		</div>
	</div>
	<div class="form-group col-sm-2">
		<label for="" class="col-sm-12 bolder label-control">
			&nbsp;
		</label>
		<div class="col-sm-12">
			<button class="btn btn-primary"><i class="fa fa-check"></i></button>
		</div>
	</div>
	<div class="clearfix"></div>
	<input type="hidden" name="producto" value="<?php echo $prodide ?>">
</form>
<div class="clearfix"></div>
<div class="space-10"></div>

<script>
	$(function(){
		var formulario = '.insertEntrada'
		$(formulario).validate({
			rules: {
				cantidad: {
					required: true,
					number: true,
				},
				proveedor: {
					required: true,
				},
			},
			 messages: {
				cantidad: {
					required: 'Obligatorio',
					number: 'Sólo datos numéricos',
				},
				proveedor: {
					required: 'Obligatorio',
				},
			},
			submitHandler: function(form) {
				$.post('app/entradas/prc/_entradas.insert.php',$(formulario).serialize(),function(data){
					if(data==1) {
						load('app/entradas/vst/entradas.lista.php','prodide=<?php echo $prodide ?>','entradas-lista');
						load('app/productos/vst/productos.lista.php','','productos-lista');
						cerraralerta();
					} else {
						alerta('msj','danger',data)
					}
				})
			}
		});
	})
</script>