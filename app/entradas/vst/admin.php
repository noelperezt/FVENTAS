<?php 
require '../../../cfg/base.php';
echo $fn->modalHeader('Entrada De productos');
?>
<div class="modal-body">
	<div class="entradas-lista"></div>
</div>
<?php echo $fn->modalFooter2() ?>
<script type="text/javascript">
	load('app/entradas/vst/entradas.lista.php','prodide=<?php echo $prodide ?>','entradas-lista');
</script>
