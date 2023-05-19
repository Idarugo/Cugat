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
require '../../../controllers/rol.controller.php';
require '../../../controllers/generador.controller.php';
$generadorController = new GeneradorController($connectDB1);
$rolController = new RolController($connectDB1);
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Si no existe la variable de url sera 1
$pagina_actual = is_numeric($pagina_actual) ? $pagina_actual : 1; // Si la variable de url es texto pasa a 1
$pagina_actual =  $pagina_actual > 0 ? $pagina_actual : 1; // si la variable de url es menor a 0 es 1
$registros_por_pagina = 10; // Cantidad de registros que quieras mostrar
$indice_array = ($pagina_actual - 1); // indice de posicionamiento del array, es el parametro de la url - 1, ya que debe filtrar un array
$rol = $rolController->listRoles();
$contador = count($rol); // Contar Los Registros
$var = 1; // Variable que validara a futuro si tenemos datos en el arreglo para mostrar un mensaje de error
if ($contador != 0) { // validamos que el contador tenga al menos un dato
    $arreglo = $generadorController->generarDivisionSeleccion($contador, $registros_por_pagina); // se genera el arreglo con las posiciones
    $validacion = $generadorController->validarIndices($arreglo, $indice_array, $pagina_actual); // se valida el arreglo con el indice de arreglo que queramos mas la pagina actual, retornara el indice inicial del rango, el final, mas la pagina actual
    $indice_inicio = $validacion[0];
    $indice_fin = $validacion[1];
    $pagina_actual = $validacion[2];
    $total_registros = count($rol);
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
    <link rel="stylesheet" href="../../../assets/styles/pages/admin/sidebar/rol.css">
    <link rel="stylesheet" href="../../../assets/styles/components/sidebar.css">
    <title>Rol</title>
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
                    <div class="modal fade" id="agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Rol</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../../routes/roles.routes.php" method="POST" class="row g-3 justify-content-center was-validated" enctype="multipart/form-data">
                                        <div class="col-md-10">
                                            <label for="inputName" class="form-label">Rol</label>
                                            <input type="name" class="form-control" id="inputName" name="txtRol" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="submit" value="Agregar" class="btn btn-primary btnAgregar" name="btnRegistrarRol" id="btnForm">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <div class="row g-3 justify-content-center">
                            <table class="styled-table table table-hover Table tabla">
                                <tr>
                                    <td><strong>Rol</strong></td>
                                    <td><strong>Editar</strong></td>
                                </tr>
                                <?php if ($var == 0) : ?>
                                    <tr>
                                        <td colspan="4">No Hay Datos Que Mostrar</td>
                                    </tr>
                                <?php else : ?>
                                    <?php for ($i = $indice_inicio; $i <= $indice_fin; $i++) : ?>
                                        <tr>
                                            <td><?= $rol[$i]->getRol() ?></td>
                                            <td><a href="" class="modificar_rol" id_rol="<?= $rol[$i]->getId() ?>" rol="<?= $rol[$i]->getRol() ?>">Editar</a></td>
                                        </tr>
                                    <?php endfor; ?>
                                    <tr>
                                        <td colspan="4">
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
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar Rol</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../../../routes/roles.routes.php" method="POST" class="row g-3 justify-content-center">
                                                <div class="col-md-10">
                                                    <input type="hidden" name="txt_id" id="id_r" value="">
                                                </div>
                                                <div class="col-md-10">
                                                    <label for="inputName" class="form-label">Rol</label>
                                                    <input type="name" class="form-control" id="rol" name="txt_ro">
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
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-registrar mt-4 btnAgregar" data-bs-toggle="modal" data-bs-target="#agregar">
                            + Agregar
                        </button>
                    </div>
                </div>



            </div>
        </section>
    </div>
    <script src="../../../assets/js/sidebar.js"></script>
    <script src="../../../assets/js/functions.js"></script>
    <?php include '../../../components/footer.php'; ?>
    <?php
    if (isset($_SESSION['Msj'])) {
        include '../../../components/diccionario/diccionario_rol.php';
    }
    ?>


</body>

</html>