<?php
require_once '../../../models/Usuario.php';
session_start();
if (isset($_SESSION['usua'])) {
    $admin = $_SESSION['usua']->getAdmin();
    if ($admin != 1) {
        header("Location: /../Cugat/index.php");
    }
} else {
    header("Location: /../Cugat/index.php");
}
?>

<?php
require '../../../core/bootstraper.php';
require '../../../controllers/usuario.controller.php';
require '../../../controllers/rol.controller.php';
require '../../../controllers/generador.controller.php';
$generadorController = new GeneradorController($connectDB1);
$usuarioController = new UsuarioController($connectDB1);
$RolUsuario = new RolController($connectDB1);
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Si no existe la variable de url sera 1
$pagina_actual = is_numeric($pagina_actual) ? $pagina_actual : 1; // Si la variable de url es texto pasa a 1
$pagina_actual =  $pagina_actual > 0 ? $pagina_actual : 1; // si la variable de url es menor a 0 es 1
$registros_por_pagina = 10; // Cantidad de registros que quieras mostrar
$indice_array = ($pagina_actual - 1); // indice de posicionamiento del array, es el parametro de la url - 1, ya que debe filtrar un array
$usuarios = $usuarioController->listUsuario_admin();
$contador = count($usuarios); // Contar Los Registros
$var = 1; // Variable que validara a futuro si tenemos datos en el arreglo para mostrar un mensaje de error
if ($contador != 0) { // validamos que el contador tenga al menos un dato
    $arreglo = $generadorController->generarDivisionSeleccion($contador, $registros_por_pagina); // se genera el arreglo con las posiciones
    $validacion = $generadorController->validarIndices($arreglo, $indice_array, $pagina_actual); // se valida el arreglo con el indice de arreglo que queramos mas la pagina actual, retornara el indice inicial del rango, el final, mas la pagina actual
    $indice_inicio = $validacion[0];
    $indice_fin = $validacion[1];
    $pagina_actual = $validacion[2];
    $total_registros = count($usuarios);
    $registros_por_pagina = $registros_por_pagina;
    $total_paginas = ceil($total_registros / $registros_por_pagina);
} else {
    $var = 0;
    $total_paginas = 0;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../../../components/head.php' ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/styles/main.css">
    <link rel="stylesheet" href="../../../assets/styles/pages/admin/sidebar/usuario.css">
    <link rel="stylesheet" href="../../../assets/styles/components/sidebar.css">
    <title>Usuario</title>
</head>

<body>
    <?php include '../../../components/headerUsuario.php' ?>
    <div id="wrapper">
        <aside id="sidebar-wrapper">
            <?php include '../../../components/sidebar.php' ?>
        </aside>
        <section id="content-wrapper">
            <div class="row">
                <div class="container container-main">
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Usuario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../../routes/usuario.routes.php" method="POST" class="row g-3 justify-content-center was-validated" enctype="multipart/form-data">
                                        <div class="col-md-10">
                                            <label for="inputName" class="form-label">Rut</label>
                                            <input type="text" name="txtRut" id="rut" class="form-control" onkeypress="return isNumber(event)" oninput="checkRut(this)" pattern="^(\d{1,2}\.)?\d{3}\.\d{3}(-|\s)?[\dkK]$" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="inputName" class="form-label">Nombre</label>
                                            <input type="name" class="form-control" id="inputName" name="txtNombre" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="inputName" class="form-label">Labor</label>
                                            <input type="name" class="form-control" id="inputName" name="txtLabor" required>
                                        </div>
                                        <div class="col-md-10">
                                            <label for="inputName" class="form-label">Correo</label>
                                            <input type="name" class="form-control" id="inputName" name="txtCorreo" required>
                                        </div>
                                        <div class="col-md-10">
                                            <label for="inputName" class="form-label">Usuario</label>
                                            <input type="name" class="form-control" id="inputName" name="txtUsuario" required>
                                        </div>
                                        <div class="col-10 mb-3" id="especialidad">
                                            <label for="inputState" class="form-label">Seleccione Rol</label>
                                            <select id="cbo_especialidad" class="form-select" name="Rol">
                                                <option value="0">Selecciona una opción</option>
                                                <?php
                                                $selectRol = $RolUsuario->ListRol();
                                                for ($i = 0; $i < count($selectRol); $i++) {
                                                    $r = $selectRol[$i];
                                                    $id = $r->getId();
                                                    $rol = $r->getRol();
                                                    echo "<option value='$id'>$rol</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-10">
                                            <label for="inputName" class="form-label">Tipo Trabajador</label><br>
                                            <input type="radio" name="opcion_s" value="1" checked> Administrador
                                            <input type="radio" name="opcion_s" value="2"> Empleador
                                        </div>
                                        <div class="col-10 mb-3">
                                            <label for="inputName" class="form-label">Contraseña</label>
                                            <input type="password" name="txtPassword" class="form-select" id="logpass" autocomplete="off" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="submit" value="Agregar" class="btn btn-primary btnAgregar" name="btnRegistrarUsuario" id="btnForm">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <div class="row g-3 justify-content-center">
                            <table class="styled-table table table-hover Table tabla">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-registrar mt-4 btnAgregar" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    + Agregar
                                </button>
                                <tr>
                                    <td><strong>Nombre</strong></td>
                                    <td><strong>Rut</strong></td>
                                    <td><strong>Correo</strong></td>
                                    <td><strong>Labor</strong></td>
                                    <td><strong>Rol</strong></td>
                                    <td><strong>Estado</strong></td>
                                    <td><strong>Bloquear</strong></td>
                                </tr>
                                <?php if ($var == 0) : ?>
                                    <tr>
                                        <td colspan="7">No Hay Datos Que Mostrar</td>
                                    </tr>
                                <?php else : ?>
                                    <?php for ($i = $indice_inicio; $i <= $indice_fin; $i++) : ?>
                                        <tr>
                                            <td><?= $usuarios[$i]->getNombre() ?></td>
                                            <td><?= $usuarios[$i]->getRut() ?></td>
                                            <td><?= $usuarios[$i]->getCorreo() ?></td>
                                            <td><?= $usuarios[$i]->getLabor() ?></td>
                                            <td><?= $usuarios[$i]->getRol() ?></td>
                                            <?php
                                            if ($usuarios[$i]->getEstado() == 0) {
                                                echo "<td>Habilitado</td>";
                                            } elseif ($usuarios[$i]->getEstado() == 1) {
                                                echo "<td>Desabilitado</td>";
                                            }
                                            ?>
                                            <td>
                                                <a href="" class="modificar_usuario" rut_usu="<?= $usuarios[$i]->getRut() ?>" nom_usu="<?= $usuarios[$i]->getNombre() ?>" cor_usu="<?= $usuarios[$i]->getCorreo() ?>" user_usu="<?= $usuarios[$i]->getUsuario() ?>" lab_usu="<?= $usuarios[$i]->getLabor() ?>" rol_usu="<?= $usuarios[$i]->getRol() ?>" pas_usu="<?= $usuarios[$i]->getPassword() ?>">Editar</a>
                                                <a href="../../../routes/usuario.routes.php?BloquearUsuario=<?= $usuarios[$i]->getRut() ?>">Bloquear</a>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                    <tr>
                                        <td colspan="7">
                                            <div class="pagination-container float-end">
                                                <ul class="pagination d-flex">
                                                    <?php if ($pagina_actual > 1) : ?>
                                                        <li class="mx-1 page-item">
                                                            <a class="page-link" href="?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
                                                        <li class="mx-1 page-item <?php if ($i == $pagina_actual) echo 'active'; ?>">
                                                            <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                                                        </li>
                                                    <?php endfor; ?>

                                                    <?php if ($pagina_actual < $total_paginas) : ?>
                                                        <li class="mx-1 page-item">
                                                            <a class="page-link" href="?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                            <?php
                                            echo "Mostrando $total_registros resultados en $total_paginas páginas.";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                            <!-- Modal -->
                            <div class="modal" id="modal_modificar">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar Usuario</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../../../routes/usuario.routes.php" method="POST" class="row g-3 justify-content-center" enctype="multipart/form-data">
                                                <div class="col-md-10">
                                                    <label for="inputName" class="form-label">Rut</label>
                                                    <input class="form-control" type="text" name="txtRut" id="rut_u" onkeypress="return isNumber(event)" oninput="checkRut(this)" pattern="^(\d{1,2}\.)?\d{3}\.\d{3}(-|\s)?[\dkK]$" disabled>
                                                    <input type="hidden" name="txt_br" id="br">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="inputName" class="form-label">Nombre</label>
                                                    <input type="name" class="form-control" id="nom_usu" name="txtNombre">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="inputName" class="form-label">Labor</label>
                                                    <input type="name" class="form-control" id="lab_u" name="txtLabor">
                                                </div>
                                                <div class="col-md-10">
                                                    <label for="inputName" class="form-label">Correo</label>
                                                    <input type="name" class="form-control" id="cor_u" name="txtCorreo">
                                                </div>
                                                <div class="col-md-10">
                                                    <label for="inputName" class="form-label">Usuario</label>
                                                    <input type="name" class="form-control" id="user_usu" name="txtUsuario">
                                                </div>
                                                <div class="col-10 mb-3">
                                                    <label for="inputState" class="form-label">Seleccione Rol</label>
                                                    <select id="rol_usu" class="form-select" name="Rol">
                                                        <option value="">Selecciona una opción</option>
                                                        <?php
                                                        $selectRol = $RolUsuario->ListRol();
                                                        for ($i = 0; $i < count($selectRol); $i++) {
                                                            $r = $selectRol[$i];
                                                            $id = $r->getId();
                                                            $rol = $r->getRol();
                                                            echo "<option value='$id'>$rol</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-10">
                                                    <label for="inputName" class="form-label">Tipo Trabajador</label><br>
                                                    <input type="radio" name="opcion_s" value="1" checked> Administrador
                                                    <input type="radio" name="opcion_s" value="2"> Empleador
                                                </div>
                                                <div class="col-10 mb-3">
                                                    <label for="inputName" class="form-label">Contraseña</label>
                                                    <input type="password" name="txtPassword" class="form-select" id="pas_usu">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" name="btn_confirm" class="btn btn-primary btnAgregar">Modificar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="../../../assets/js/sidebar.js"></script>
    <script src="../../../assets/js/functions.js"></script>
    <script src="../../../assets/js/valida_rut.js"></script>
    <?php include '../../../components/footer.php' ?>
    <?php
    if (isset($_SESSION['Msj'])) {
        include '../../../components/diccionario/diccionario_usuario.php';
    } ?>
</body>

</html>