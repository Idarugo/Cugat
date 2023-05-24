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
                if ($rs['estado'] == 0) {
                    session_start();
                    $_SESSION['Msj'] = "Usuario_Bloqueado";
                    $this->connectDB1->disconnect();
                    header("location: ../pages/admin/index.php");
                    exit();
                }

                $usua = new Usuario($rs['rut'], $rs['nombre'],  $rs['labor'],  $rs['correo'],  $rs['usuario'],  $rs['pass'], $rs['rol'], $rs['admin'], $rs['estado']);

                if ($rs['admin'] != 0 &&  $rs['admin'] != 1) {
                    $this->connectDB1->disconnect();
                    header("location: ../pages/admin/index.php?banned");
                    return;
                }

                session_start();
                $_SESSION['usua'] = $usua;
                $this->connectDB1->disconnect();

                if ($rs['admin'] == 0) {
                    header("location: /../Cugat/pages/public/principal.php");
                    return;
                }

                if ($rs['admin'] == 1) {
                    header("location: /../Cugat/pages/admin/principal.php");
                    return;
                }
            } else {
                // Contraseña no válida
                $this->connectDB1->disconnect();
                header("location: ../pages/admin/index.php?AuthError=Credenciales no válidas");
                return;
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
        WHERE U.rol = R.id AND U.rol !=1 ORDER BY 'rut' DESC ";
        $st = $this->connectDB1->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $usuario[] = new Usuario($rs['rut'], $rs['nombre'], $rs['labor'], $rs['correo'], $rs['usuario'], $rs['pass'], $rs['rol'], $rs['admin'], $rs['estado']);
        }
        $this->connectDB1->disconnect();
        return $usuario;
    }

    /* Estado */

    public function conseguirEstado($campo1, $tabla, $campo2, $rut)
    {
        $this->connectDB1->connect();
        $sql = "select $campo1 as estado from $tabla where $campo2='$rut'";
        $ejecutar = $this->connectDB1->query($sql);
        $val = mysqli_fetch_assoc($ejecutar);
        $this->connectDB1->disconnect();
        return $val["estado"];
    }

    public function cambiarEstado($tabla, $campo1, $est, $campo2, $rut)
    {
        if ($est == 0) {
            $est = 1;
            $_SESSION['Msj'] = "Usuario_Bloquear";
        } else {
            $est = 0;
            $_SESSION['Msj'] = "Usuario_Debloqueado";
        }
        $this->connectDB1->connect();
        $sql = "update $tabla set $campo1='$est' where $campo2='$rut'";
        $ejecutar = $this->connectDB1->query($sql);
        header("location: ../pages/admin/sidebar/usuario.php");
        exit();
    }




    public function updateUsuario($rut, $nombre, $labor, $correo, $usuario, $password,  $rol, $admin, $estado)
    {
        session_start();
        $this->connectDB1->connect();
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE `usuario` SET `nom`='$nombre',`lab`='$labor',`cor`='$correo',`usu`='$usuario',`pass`='$hashed_password',`rol`=$rol,`admin`=$admin,`est`=$estado  WHERE `rut`='$rut'";
        $this->connectDB1->query($sql);
        if ($this->connectDB1->getDB()->affected_rows) {
            $this->connectDB1->disconnect();
            $_SESSION['Msj'] = "Usuario_Modificar";
            header("location:  ../pages/admin/sidebar/usuario.php");
            exit();
        }
        $this->connectDB1->disconnect();
        $_SESSION['Msj'] = "Usuario_Error";
        header("location:  ../pages/admin/sidebar/usuario.php");
        exit();
    }
}
