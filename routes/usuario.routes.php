<?php
require '../core/bootstraper.php';
require_once '../controllers/usuario.controller.php';
$usuario = new UsuarioController($connectDB1);
session_start();


if (isset($_POST['btnUsuarioLogin'])) {
    $usuario->login($_POST["txtUsuario"], $_POST["txtPassword"]);
}



if (isset($_POST['btnRegistrarUsuario'])) {
    if (empty($_POST["txtRut"]) || empty($_POST["txtNombre"]) || empty($_POST["txtLabor"]) || empty($_POST["txtCorreo"]) || empty($_POST["txtUsuario"]) || empty($_POST["txtPassword"] || empty($_POST["Rol"]))) {
        header("location:  ../pages/sidebar/usuario.php?txtEmptyError");
        return;
    }
    $usuario->registrarUsuario($_POST["txtRut"], $_POST["txtNombre"],  $_POST["txtLabor"], $_POST["txtCorreo"], $_POST["txtUsuario"],  $_POST["txtPassword"],  $_POST["Rol"], 2, 1);
}

if (isset($_GET["BloquearUsuario"])) {
    $rut = $_GET["BloquearUsuario"];
    $est = $usuario->conseguirEstado("estado", "usuario", "rut", $rut);
    $usuario->cambiarEstado("usuario", "estado", $est, "rut", $rut);
}



if (isset($_POST['btn_confirm'])) {
    if (empty($_POST["txtRut"]) || empty($_POST["txtNombre"]) || empty($_POST["txtLabor"]) || empty($_POST["txtCorreo"]) || empty($_POST["txtUsuario"]) || empty($_POST["txtPassword"]) || empty($_POST["Rol"])) {
        header("location:  ../pages/admin/usuario.php?txtEmptyError");
        exit();
    }
    $usuario->updateUsuario($_POST["txtRut"], $_POST["txtNombre"],  $_POST["txtLabor"], $_POST["txtCorreo"], $_POST["txtUsuario"],  $_POST["txtPassword"], 1, 1, $_POST["Rol"], 2, 1);
}
