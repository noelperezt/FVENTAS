<?php 
require 'cfg/base.php';
session_unset();
session_destroy();
$musuarios->redirecLogin();
?>