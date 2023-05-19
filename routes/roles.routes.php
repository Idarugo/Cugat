<?php
require '../core/bootstraper.php';
require '../controllers/rol.controller.php';
$rol = new RolController($connectDB1);

if (isset($_POST['btnRegistrarRol'])) {
    if (empty($_POST["txtRol"])) {
        $_SESSION['Msj'] = "Emptytxt";
        header("location:  ../pages/admin/sidebar/rol.php");
        exit();
    }
    $rol->registrarRol($_POST["txtRol"]);
}


if (isset($_POST['btn_confirm'])) {
    if (empty($_POST["txt_id"]) || empty($_POST["txt_ro"])) {
        header("location:  ../pages/admin/rol.php?txtEmptyError");
        exit();
    }
    $rol->updateRoles($_POST["txt_id"], $_POST["txt_ro"]);
}
