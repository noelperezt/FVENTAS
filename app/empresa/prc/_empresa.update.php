<?php 
require '../../../cfg/base.php';
$rt = $mempresa->updateEmpresa();
if ($rt==1) {
	copy($_FILES['logo']['tmp_name'], '../../../img/'.$_FILES['logo']['name']);
	header('location: ../../../index.php?var=10');
}
?>