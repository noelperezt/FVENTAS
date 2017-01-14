<?php require '../../../cfg/base.php'; ?>
<form class="form-horizontal insert">
	<?php echo $fn->modalHeader('Agregar Usuario') ?>
	<div class="modal-body">
	<div class="msj"></div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Nacionalidad:
			</label>
			<div class="col-sm-9">
				<select name="nacion" class="form-control">
					<option value="V">Venezolano</option>
					<option value="E">Extranjero</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Cédula:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="cedula" maxlength = "8"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Apellidos:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="apelli" onKeypress="sololetras()"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Nombres:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="nombre" onKeypress="sololetras()"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Usuario:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="usuari"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Clave:
			</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="clave" id="clave"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Confirme:
			</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="clave2"></input>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo $fn->modalFooter(); ?>
</form>

<script>
	function sololetras(){
     if (event.keyCode >=45 && event.keyCode  <=57) event.returnValue = false;
    }
	$(function(){
		var formulario = '.insert'
		$(formulario).validate({
			rules: {
				nacion: {
					required: true,
				},
				cedula: {
					required: true,
					number: true,
				},
				apelli: {
					required: true,
				},
				nombre: {
					required: true,
				},
				usuari: {
					required: true,
				},
				clave: {
					required: true,
				},
				clave2: {
					required: true,
					equalTo: '#clave',
				},
			},
			 messages: {
				nacion: {
					required: 'Ingrese su usuario',
				},
				cedula: {
					required: 'Indique la clave',
				},
				apelli: {
					required: 'Ingrese su apellido',
				},
				nombre: {
					required: 'Ingrese su nombre',
				},
				usuari: {
					required: 'Ingrese su usuario',
				},
				clave: {
					required: 'Ingrese su clave',
				},
				clave2: {
					required: 'confirme su clave',
					equalTo: 'No coinciden las claves',
				},
			},
			submitHandler: function(form) {
				$.post('app/usuarios/prc/_usuarios.insert.php',$(formulario).serialize(),function(data){
					if(data==1) {
						load('app/usuarios/vst/usuarios.lista.php','','usuarios-lista');
						cerrarmodal()
					} else {
						alerta('msj','danger',data)
					}
				})
			}
		});
	})
</script>