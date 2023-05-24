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
require_once '../../../controllers/locales.controller.php';
require_once '../../../controllers/usuario.controller.php';
require_once '../../../controllers/maestroProductos.controller.php';

$locales = new LocalesController($connectDB1);
$usuar = new UsuarioController($connectDB1);
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
    <link rel="stylesheet" href="../../../assets/styles/pages/admin/sidebar/voucher.css">
    <link rel="stylesheet" href="../../../assets/styles/components/sidebar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Voucher</title>
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
                    <h1 class="text-center">Generar Voucher</h1>
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label for="select-local" class="form-label texto">Local:</label>
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

                        <div class="col-md-1">
                            <label for="input-codigo" class="form-label texto">Caja:</label>
                            <input class="form-control form-control-sm" type="text" id="input-codigo" name="caja" maxlength="2">
                        </div>

                        <div class="col-md-2">
                            <label for="transaccion" class="form-label texto">Tipo Transacción:</label>
                            <select class="form-select" name="transaccion" id="transaccion">
                                <option value="transaccion1">Debito</option>
                                <option value="transaccion2">Crédito</option>
                                <!-- Agrega las opciones de tipo de transacción según tus necesidades -->
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="desde" class="form-label texto">Desde:</label>
                            <input type="date" id="desde" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-3">
                            <label for="hasta" class="form-label texto">Hasta:</label>
                            <input type="date" id="hasta" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-buscar">Buscar</button>
                        </div>
                    </form>


                    <table>
                        <thead>
                            <tr>
                                <th>Nº Caja</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Nº Operación</th>
                                <th>Con Autorización</th>
                                <th>Estado</th>
                                <th>Voucher</th>
                            </tr>
                        </thead>
                        <tbody id="resultado" colspan="6" class="text-center">
                        </tbody>
                    </table>
                    <div class="col-md-10">
                        <h3 class="text-center">Bajo Construccion</h3>
                        <div class="text-center">
                            <img src="../../../assets/img/mantencion.png" alt="Mantenimiento" style="max-width:100%; height:auto;">
                        </div>
                        <h5 class="text-center"> Nuestro sitio web en construccion,estamos trabajando muy duro para brindarle la mejro experiencia con este.</h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="../../../assets/js/sidebar.js"></script>
    <script src="../../../assets/js/codigoAutomatico.js"></script>
    <?php include '../../../components/footer.php'; ?>
</body>

</html>