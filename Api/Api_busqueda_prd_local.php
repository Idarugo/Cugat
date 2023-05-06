<?php
require_once '../core/bootstraper.php';
require_once "../controllers/maestroProductos.controller.php";
$maestroController = new MaestroProductosController($connectDB2);
$local = $_GET['local'];
$codigo = $_GET['codigo'];
$resultado = $maestroController->buscarPrecios($local,$codigo);
header('Content-Type: application/json');
echo json_encode($resultado);