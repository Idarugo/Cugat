<?php
require __DIR__ . '../../models/Usuario.php';


class UsuarioController
{
    private $connectDB1;

    function __construct($connectDB1)
    {
        $this->connectDB1 = $connectDB1;
    }

    public function login($usuario, $password)
    {
        $this->connectDB1->connect();

        /*Validar si el Usuario esta Vacio*/
        if (empty($usuario)) {
            header("location: ../pages/login.php?AuthError=Usuario Esta Vacio");
        }

        /*Validar si la contraseña esta vacia*/
        if (empty($password)) {
            header("location: ../pages/login.php?AuthError=Contaseña Esta Vacio");
        }

        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        $resp = $this->connectDB1->query($sql);
        if ($rs = mysqli_fetch_array($resp)) {
            if (password_verify($password, $rs['pass'])) {
                $usua = new Usuario($rs['id'], $rs['usuario'], $rs['pass'], $rs['estado']);
                if ($rs['estado'] === '0') {
                    $this->connectDB1->disconnect();
                    header("location: ../pages/login.php?banned");
                    return;
                }
                session_start();
                $_SESSION['usua'] = $usua;
                $this->connectDB1->disconnect();
                header("location:  /../Cugat/pages/maestro-precio.php");
                return;
            }
        }
        $this->connectDB1->disconnect();
        header("location: ../index.php?AuthError=Credenciales no válidas");
        return;
    }
}
