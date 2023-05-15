<?php
require '../core/bootstraper.php';
require_once '../controllers/usuario.controller.php';
$usuario = new UsuarioController($connectDB1);
session_start();


if (isset($_POST['btnUsuarioLogin'])) {
    $usuario->login($_POST["txtUsuario"], $_POST["txtPassword"]);
}
