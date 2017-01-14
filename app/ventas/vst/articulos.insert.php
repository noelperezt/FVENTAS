<?php 
require '../../../cfg/base.php';
$menu = $mproductos->getAll();
?>
<hr>
<div class="msj1"></div>
<form class="well col-sm-8 col-sm-offset-2 articuloInsert">
	<div class="form-group col-sm-7">
		<label class="bolder control-label col-sm-12">
			Producto:
		</label>
		<div class="col-sm-12">
			<select class="form-control chosenprod" name="producto">
				<option value="0-0">--</option>
				<?php foreach($menu as $a) { ?>
					<option value="<?php echo $a->prodide ?>"><?php echo $a->prodide." - ".$a->proddescri ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-3">
		<label class="bolder control-label col-sm-12">
			Cantidad:
		</label>
		<div class="col-sm-12">
			<input class="form-control" name="cantidad"> </input>
		</div>
	</div>
	<div class="form-group col-sm-2">
		<label class="bolder control-label col-sm-12">&nbsp;</label>
		<div class="col-sm-12">
			<button class="btn btn-primary"><i class="fa fa-mail-forward"></i></button>
		</div>
	</div>
	<input type="hidden" name="clieide" value="<?php echo $clieide ?>">
</form>
<script>
	$(function(){
		$('.chosenprod').chosen();
		var formulario = '.articuloInsert'
		$(formulario).validate({
			rules: {
				producto: {
					required: true,
				},
				cantidad: {
					required: true,
					number: true,
				},
			},
			 messages: {
				producto: {
					required: 'Campo obligatorio',
				},
				cantidad: {
					required: 'Campo obligatorio',
					number: 'Numérico',
				},
			},
			submitHandler: function(form) {
				$.post('app/ventas/prc/_articulos.insert.php',$(formulario).serialize(),function(data){
					if(data==1) {
						load('app/ventas/vst/articulos.lista.php','clieide=<?php echo $clieide ?>','articulos-lista');
						cerraralerta('msj1');
					} else {
						alerta('msj1','danger',data)
					}
				})
			}
		});
	})
</script>