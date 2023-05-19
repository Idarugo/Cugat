<?php
require_once '../../../models/Usuario.php';
session_start();
if (isset($_SESSION['usua'])) {
    $admin = $_SESSION['usua']->getAdmin();
    if ($admin != 0) {
        header("Location: /../Cugat/index.php");
    }
} else {
    header("Location: /../Cugat/index.php");
}
?>
<?php
require '../../../core/bootstraper.php';
require_once '../../../controllers/locales.controller.php';
require_once '../../../controllers/usuario.controller.php';
require_once '../../../controllers/maestroProductos.controller.php';

$locales = new LocalesController($connectDB1);
$usua = new UsuarioController($connectDB1);
$maestroProductoController = new MaestroProductosController($connectDB2);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../../../components/head.php' ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/styles/main.css">
    <link rel="stylesheet" href="../../../assets/styles/pages/admin/sidebar/historial.css">
    <link rel="stylesheet" href="../../../assets/styles/components/sidebar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Historial</title>
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
                    <h1 class="text-center">Historial de Cambio de Precio</h1>

                    <form class="form-inline">
                        <div class="form-group">
                            <label for="select-local">Local:</label>
                            <select id="select-local" class="form-select" name="select-local" required>
                                <option value="">Selecciona una opción</option>
                                <?php
                                $listLocales = $locales->listLocales();
                                foreach ($listLocales as $l) {
                                    $id = $l->getId();
                                    $nombre = $l->getNombre();
                                    $server = $l->getServer();
                                    $encryptedServer = openssl_encrypt($server, 'aes-256-cbc', 'secreta', 0, substr('1234567890123456', 0, 16));
                                    echo "<option value='$id' data-server='$encryptedServer'>$nombre</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input-codigo">Código:</label>
                            <input class="form-control form-control-sm filter-input" type="text" id="input-codigo" name="input-codigo" maxlength="13">
                        </div>

                        <div class="form-group">
                            <label for="desde">Desde:</label>
                            <input type="date" id="desde" class="form-control form-control-sm filter-input">
                        </div>

                        <div class="form-group">
                            <label for="hasta">Hasta:</label>
                            <input type="date" id="hasta" class="form-control form-control-sm filter-input">
                        </div>

                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <select id="select-usuario" class="form-select" name="select-usuario" required>
                                <option value="">Selecciona una opción</option>
                                <?php
                                $listUsuarios = $usua->listUsuario();
                                foreach ($listUsuarios as $u) {
                                    $rut = $u->getRut();
                                    $nombre = $u->getNombre();
                                    echo "<option value='$rut'>$nombre</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary form-control form-control-sm filter-input" onclick="filterTable()">Filtrar</button>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-secondary form-control form-control-sm filter-input" onclick="resetTable()">Resetear</button>
                        </div>
                    </form>


                    <table id="registroTable" class="table">
                        <tr>
                            <td><strong>Local</strong></td>
                            <td><strong>Código</strong></td>
                            <td><strong>Fecha</strong></td>
                            <td><strong>Usuario</strong></td>
                        </tr>
                        <tr>
                            <td>Local 1</td>
                            <td>Código 1</td>
                            <td>2023-05-01</td>
                            <td>Usuario 1</td>
                        </tr>
                        <tr>
                            <td>Local 2</td>
                            <td>Código 2</td>
                            <td>2023-05-02</td>
                            <td>Usuario 2</td>
                        </tr>
                        <tr>
                            <td>Local 1</td>
                            <td>Código 3</td>
                            <td>2023-05-03</td>
                            <td>Usuario 1</td>
                        </tr>
                        <tr>
                            <td>Local 3</td>
                            <td>Código 4</td>
                            <td>2023-05-04</td>
                            <td>Usuario 3</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <script src="../../../assets/js/sidebar.js"></script>
    <script src="../../../assets/js/codigoAutomatico.js"></script>
    <?php include '../../../components/footer.php'; ?>
</body>

</html>