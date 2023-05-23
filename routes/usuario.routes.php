<?php
require '../core/bootstraper.php';
require_once '../controllers/usuario.controller.php';
$usuario = new UsuarioController($connectDB1);
session_start();


if (isset($_POST['btnUsuarioLogin'])) {
    $usuario->login($_POST["txtUsuario"], $_POST["txtPassword"]);
}



if (isset($_POST['btnRegistrarTrabajador'])) {
    if (empty($_POST["txtRut"]) || empty($_POST["txtLabor"]) || empty($_POST["txtCorreo"]) || empty($_POST["txtUsuario"]) || empty($_POST["txtCorreo"]) || empty($_POST["txtPassword"])) {
        header("location:  ../pages/sidebar/usuario.php?txtEmptyError");
        return;
    }
    $usuario->registrarUsuario($_POST["txtRut"], $_POST["txtLabor"], $_POST["txtCorreo"], $_POST["txtUsuario"],  $_POST["Rol"], $target_fin, 2, $_POST["txtPassword"], 0);
}

if (isset($_GET["BloquearUsuario"])) {
    $rut = $_GET["BloquearUsuario"];
    $est = $usuario->conseguirEstado("estado", "usuario", "rut", $rut);
    $usuario->cambiarEstado("usuario", "estado", $est, "rut", $rut);
}
