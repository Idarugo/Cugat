<?php
require  __DIR__ . '../../models/Usuario.php';


class UsuarioController
{
    private $connectDB1;

    function __construct($connectDB1)
    {
        $this->connectDB1 = $connectDB1;
    }


    public function login($user, $password)
    {
        $this->connectDB1->connect();

        // Validar si el RUT está vacío
        if (empty($user)) {
            header("location: ../pages/admin/index.php?AuthError=Usuario esta Vacio");
            exit();
        }

        // Validar si la contraseña está vacía
        if (empty($password)) {
            header("location: ../pages/admin/index.php?AuthError=Contraseña esta vacio");
            exit();
        }

        $sql = "SELECT * FROM usuario WHERE usuario = '$user'";
        $resp = $this->connectDB1->query($sql);
        if ($rs = mysqli_fetch_array($resp)) {
            echo " recorriendo RS ";
            if (password_verify($password, $rs['pass'])) {
                $usua = new Usuario($rs['rut'], $rs['nombre'],  $rs['labor'],  $rs['correo'],  $rs['usuario'],  $rs['pass'],  $rs['estado']);
                if ($rs['estado'] === 0) {
                    $this->connectDB1->disconnect();
                    header("location:  ../pages/admin/index.php?banned");
                    return;
                }
                session_start();
                $_SESSION['usua'] = $usua;
                $this->connectDB1->disconnect();
                header("location:  /../Cugat/pages/admin/principal.php");
                return;
            }
        }
        $this->connectDB1->disconnect();
        header("location: ../pages/admin/index.php?AuthError=Credenciales no válidas");
        return;
    }



    public function listUsuario()
    {
        $user = array();
        $this->connectDB1->connect();
        $sql = " SELECT * FROM `usuario`";
        $st = $this->connectDB1->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $user[] = new Usuario($rs['rut'], $rs['nombre'],  $rs['labor'],  $rs['correo'],  $rs['usuario'],  $rs['pass'],  $rs['estado']);;
        }
        $this->connectDB1->disconnect();
        return $user;
    }
}
