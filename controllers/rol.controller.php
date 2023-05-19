<?php
require __DIR__ . '../../models/Rol.php';


class RolController
{
    private $connectDB1;

    function __construct($connectDB1)
    {
        $this->connectDB1 = $connectDB1;
    }



    public function registrarRol($rol)
    {
        session_start();
        $this->connectDB1->connect();
        $sql = "INSERT INTO `rol`( `rol`) VALUES ('$rol')";
        $this->connectDB1->query($sql);
        if ($this->connectDB1->getDB()->affected_rows) {
            $this->connectDB1->disconnect();
            $_SESSION['Msj'] = "Rol_Ok";
            header("location:  ../pages/admin/sidebar/rol.php");
            exit();
        }
        $this->connectDB1->disconnect();
        $_SESSION['Msj'] = "Rol_Error";
        header("location:  ../pages/admin/sidebar/rol.php");
        exit();
    }


    public function updateRoles($id, $rol)
    {
        session_start();
        $this->connectDB1->connect();
        $sql = "UPDATE `rol` SET `rol`='$rol' WHERE `id`='$id'";
        $this->connectDB1->query($sql);
        if ($this->connectDB1->getDB()->affected_rows) {
            $this->connectDB1->disconnect();
            $_SESSION['Msj'] = "Rol_Modificar";
            header("location:  ../pages/admin/sidebar/rol.php");
            exit();
        }
        $this->connectDB1->disconnect();
        $_SESSION['Msj'] = "Rol_Error";
        header("location:  ../pages/admin/sidebar/rol.php");
        exit();
    }


    public function listRoles()
    {
        $roles = array();
        $this->connectDB1->connect();
        $sql = " SELECT * FROM `rol`";
        $st = $this->connectDB1->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $roles[] = new Rol($rs['id'], $rs['rol']);;
        }
        $this->connectDB1->disconnect();
        return $roles;
    }


    public function ListRol()
    {
        $rol = array();
        $this->connectDB1->connect();
        $sql = "SELECT * FROM rol WHERE id > 1;";
        $st = $this->connectDB1->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $rol[] = new Rol($rs['id'], $rs['rol']);;
        }
        $this->connectDB1->disconnect();
        return $rol;
    }
}
