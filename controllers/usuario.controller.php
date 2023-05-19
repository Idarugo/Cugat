<?php
require_once  __DIR__ . '../../models/Usuario.php';


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
                $usua = new Usuario($rs['rut'], $rs['nombre'],  $rs['labor'],  $rs['correo'],  $rs['usuario'],  $rs['pass'], $rs['rol'], $rs['admin'], $rs['estado']);
                if ($rs['admin'] != 0 &&  $rs['admin'] != 1) {
                    $this->connectDB1->disconnect();
                    header("location:  ../pages/admin/index.php?banned");
                    return;
                }
                session_start();
                $_SESSION['usua'] = $usua;
                $this->connectDB1->disconnect();
                if ($rs['admin'] == 0) {
                    header("location:  /../Cugat/pages/public/principal.php");
                    return;
                }
                if ($rs['admin'] == 1) {
                    header("location:  /../Cugat/pages/admin/principal.php");
                    return;
                }
            }
        }
        $this->connectDB1->disconnect();
        header("location: ../pages/admin/index.php?AuthError=Credenciales no válidas");
        return;
    }


    public function registrarUsuario($rut, $nombre, $labor, $correo, $usuario, $password,  $rol, $admin, $estado)
    {
        session_start();
        $this->connectDB1->connect();
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO `usuario` VALUES ('$rut','$nombre','$labor','$correo','$usuario','$hashed_password',$rol,$admin,$estado)";
        $this->connectDB1->query($sql);
        if ($this->connectDB1->getDB()->affected_rows) {
            $this->connectDB1->disconnect();
            $_SESSION['Msj'] = "Usuario_Ok";
            header("location:  ../pages/admin/sidebar/usuario.php");
            exit();
        }
        $this->connectDB1->disconnect();
        $_SESSION['Msj'] = "Usuario_Error";
        header("location:  ../pages/admin/sidebar/usuario.php");
        exit();
    }



    public function listUsuario()
    {
        $user = array();
        $this->connectDB1->connect();
        $sql = " SELECT * FROM `usuario`";
        $st = $this->connectDB1->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $user[] = new Usuario($rs['rut'], $rs['nombre'],  $rs['labor'],  $rs['correo'],  $rs['usuario'],  $rs['pass'], $rs['rol'], $rs['admin'],  $rs['estado']);;
        }
        $this->connectDB1->disconnect();
        return $user;
    }


    public function listUsuario_admin()
    {
        $usuario = array();
        $this->connectDB1->connect();
        $sql = "SELECT U.rut, U.nombre, U.labor, U.correo, U.usuario, U.pass, R.rol, U.admin, U.estado
        FROM USUARIO U, ROL R
        WHERE U.rol = R.id";
        $st = $this->connectDB1->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $usuario[] = new Usuario($rs['rut'], $rs['nombre'], $rs['labor'], $rs['correo'], $rs['usuario'], $rs['pass'], $rs['rol'], $rs['admin'], $rs['estado']);
        }
        $this->connectDB1->disconnect();
        return $usuario;
    }
}
