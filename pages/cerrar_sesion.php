<?php
session_start();
unset($_SESSION['usua']);
$_SESSION['Msj'] = "CerrarSesion";
header('Location: /../Cugat/index.php');
exit;
