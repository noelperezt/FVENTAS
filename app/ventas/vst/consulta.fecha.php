<?php require '../../../cfg/base.php'; ?>
<form class="form-horizontal insert">
	<?php echo $fn->modalHeader('Consultar Fecha') ?>
	<div class="modal-body">
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Fecha Inicial:
			</label>
		<div class="input-group date" data-provide="datepicker" >
    <input value = <?php echo date("m/d/Y");?> type="text" class="form-control" name="fecha_i" id ="fecha_i">

    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>

	</div>
		</div>

		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Fecha Final:
			</label>
			<div class="input-group date" data-provide="datepicker" >
				<input value = <?php echo date("m/d/Y");?> type="text" class="form-control" name="fecha_f" id ="fecha_f">

				<div class="input-group-addon">
					<span class="glyphicon glyphicon-th"></span>
				</div>

			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="button" class="btn btn-primary" onclick= "consultar()">Aceptar</button>
	</div>
</form>

<script>
	
		function consultar() {
		var usr = $('#fecha_i').val();
			var usr2 = $('#fecha_f').val();
		var fechai = usr.split('/')
			var fechaf = usr2.split('/')
				cerrarmodal()
				window.open('rpt-ventasf-mesi='+fechai[0]+'&mesf='+fechaf[0]+'&diai='+fechai[1]+'&diaf='+fechaf[1]+'&anioi='+fechai[2]+'&aniof='+fechaf[2]);

			}
	
</script>