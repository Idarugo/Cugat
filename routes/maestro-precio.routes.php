<?php
require '../core/bootstraper.php';
require_once '../controllers/maestroProductos.controller.php';
$maestroprecio = new MaestroProductosController($connectDB2);
session_start();


if (isset($_POST['btn_confirm'])) {
    if (empty($_POST["txt_codigo"]) || empty($_POST["txtPrecio"])) {
        header("location:  ../pages/maestro-precio.php?txtEmptyError");
        exit();
    }
    $maestroprecio->updatePrecio($_POST["txt_codigo"], $_POST["txtPrecio"]);
}

if (isset($_POST['btn_confirmOferta'])) {
    if (empty($_POST["txt_codigo"]) || empty($_POST["txtPrecioOferta"]) || empty($_POST["txtCantidad"]) || empty($_POST["txtDesde"]) || empty($_POST["txtHasta"])) {
        header("location:  ../pages/maestro-precio.php?txtEmptyError");
        exit();
    }
    $maestroprecio->updatePrecioOferta($_POST["txt_codigo"], $_POST["txtPrecioOferta"], $_POST["txtCantidad"], $_POST["txtDesde"], $_POST["txtHasta"]);
}
