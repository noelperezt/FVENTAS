<?php 
$menu = $musuarios->opcionesMenu();
?>
<ul class="nopcionesmenu">
	<li>
  	<a href="index.php">
  		 Inicio
  	</a>
  </li>
  <li>
  	<a href="?alt=<?php echo base64_encode('usuarios/vst/micuenta.php') ?>">
  		 Mis Datos
  	</a>
  </li>
  <?php foreach($menu as $m) : ?>
    <li>
      <a href="?var=<?php echo $m->sumoide ?>">
         <?php echo $m->sumodescri ?>
      </a>
    </li>
  <?php endforeach ?>
  <li>
  	<a href="logout.php">
  		 Cerrar
  	</a>
  </li>
</ul>
