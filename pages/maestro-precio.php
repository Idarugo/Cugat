<?php
require '../core/bootstraper.php';
require_once '../controllers/locales.controller.php';
require_once '../controllers/maestroProductos.controller.php';

$locales = new LocalesController($connectDB1);
$maestroProductoController = new MaestroProductosController($connectDB2);

// $localId = $_POST['localId'];
// $codigo = $_POST['codigo'];

// $precios = $maestroProductoController->listarMaestroProductos($localId, $codigo);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../components/head.php' ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/pages/maestro-precio.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Maestro Precio</title>
</head>

<body>
    <?php include '../components/header.php' ?>
    <div class="container container-main">
        <div class="text-center mt-5 buscar">
            <label for="select-local">Local:</label>
            <select id="select-local" class="form-select" name="select-local" required>
                <option value="">Selecciona una opción</option>
                <?php
                $listLocales = $locales->listLocales();
                for ($i = 0; $i < count($listLocales); $i++) {
                    $l = $listLocales[$i];
                    $id = $l->getId();
                    $nombre = $l->getNombre();
                    $server = $l->getServer();
                    $encryptedServer = openssl_encrypt($server, 'aes-256-cbc', 'secreta', 0, substr('1234567890123456', 0, 16));
                    echo "<option value='$id' data-server='$encryptedServer'>$nombre</option>";
                }
                ?>
            </select>

            <label for="input-codigo">Código:</label>
            <input type="text" id="input-codigo" name="input-codigo" maxlength="13">

            <button class="me-2" id="btn-buscar" type="button">Buscar</button>
            <button id="btn-limpiar" type="button">Limpiar</button>
        </div>

        <div class="table-container mt-2">
            <div class="row g-3 justify-content-center">
                <h3 id="titulo" class="titulo">Local</h3>
                <table class="styled-table table table-hover Table tabla" id="tabla-productos-fijos">
                    <thead>
                        <tr>
                            <td><strong>Código</strong></td>
                            <td><strong>Descripción</strong></td>
                            <td><strong>Precio Costo</strong></td>
                            <td><strong>Precio Fijo</strong></td>
                            <td><strong>Modificar</strong></td>
                        </tr>
                    </thead>
                    <tbody id="tbody_productos">


                    </tbody>
                </table>


                <!-- Modal -->
                <div class="modal" id="modal_modificar">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 texto" id="staticBackdropLabel">Modificar Precio</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../routes/maestro-precio.routes.php" method="POST" class="row g-3 justify-content-center" enctype="multipart/form-data">
                                    <div class="col-md-10">
                                        <input type="hidden" name="txt_codigo" id="id_c" value="">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="inputName" class="form-label texto">Precio Fijo</label>
                                        <input type="name" class="form-control" id="pfijo" name="txtPrecio">
                                    </div>
                                    <!-- <div class="col-md-10">
                                        <label for="inputDuration" class="form-label texto">Duración (minutos)</label>
                                        <input type="number" class="form-control" id="pduracion" name="txtduracion" step="1">
                                    </div> -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" name="btn_confirm" class="btn btn-primary btnAgregar">Modificar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <h3 class="titulo">Ofertas Pesables</h3>
                <table class="styled-table table table-hover Table tabla" id="tabla-productos-pesables">
                    <tr>
                        <thead>
                            <tr>
                                <th><strong>Precio oferta</strong></th>
                                <th><strong>Cantidad</strong></th>
                                <th><strong>Desde</strong></th>
                                <th><strong>Hasta</strong></th>
                                <th><strong>Tiempo restante</strong></th>
                                <th><strong>Modificar</strong></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_productos_pesables">


                        </tbody>
                </table>

                <!-- Modal -->
                <div class="modal" id="modal_modificarOfertaPesable">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 texto" id="staticBackdropLabel">Modificar Oferta Pesable</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../routes/maestro-precio.routes.php" method="POST" class="row g-3 justify-content-center" enctype="multipart/form-data">
                                    <div class="col-md-10">
                                        <input type="hidden" name="txt_codigo" id="id_codigo" value="">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="inputName" class="form-label texto">Precio Oferta</label>
                                        <input type="name" class="form-control" id="pOferta" name="txtPrecioOferta">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="inputName" class="form-label texto">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name="txtCantidad">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="fecha" class="form-label texto">Desde</label>
                                        <input type="name" class="form-control" id="desde" name="txtDesde">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="fecha" class="form-label texto">Hasta</label>
                                        <input type="name" class="form-control" id="hasta" name="txtHasta">
                                    </div>
                                    <!-- <div class="col-md-10">
                                        <label for="inputDuration" class="form-label texto">Duración (minutos)</label>
                                        <input type="number" class="form-control" id="pduracion" name="txtduracion" step="1">
                                    </div> -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" name="btn_confirmOferta" class="btn btn-primary btnAgregar">Modificar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <h3 class="titulo">Ofertas Unitarias</h3>
                <table class="styled-table table table-hover Table tabla">
                    <tr>
                        <thead>
                            <tr>
                                <th>Precio oferta</th>
                                <th>Cantidad</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Tiempo restante</th>
                                <th>Modificar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_productos_unitarias">


                        </tbody>
                </table>

                <!-- Modal -->
                <div class="modal" id="modal_modificarOfertaUnitaria">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 texto" id="staticBackdropLabel">Modificar Oferta Unitaria</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../routes/maestro-precio.routes.php" method="POST" class="row g-3 justify-content-center" enctype="multipart/form-data">
                                    <div class="col-md-10">
                                        <input type="hidden" name="txt_codigo" id="id_codigo" value="">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="inputName" class="form-label texto">Precio Oferta</label>
                                        <input type="name" class="form-control" id="pOferta" name="txtPrecioOferta">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="inputName" class="form-label texto">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name="txtCantidad">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="fecha" class="form-label texto">Desde</label>
                                        <input type="name" class="form-control" id="desde" name="txtDesde">
                                    </div>
                                    <div class="col-md-10">
                                        <label for="fecha" class="form-label texto">Hasta</label>
                                        <input type="name" class="form-control" id="hasta" name="txtHasta">
                                    </div>
                                    <!-- <div class="col-md-10">
                                        <label for="inputDuration" class="form-label texto">Duración (minutos)</label>
                                        <input type="number" class="form-control" id="pduracion" name="txtduracion" step="1">
                                    </div> -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" name="btn_confirmOferta" class="btn btn-primary btnAgregar">Modificar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php include '../components/footer.php' ?>
    <?php
    if (isset($_SESSION['Msj'])) {
        include '../components/diccionario/diccionario_maestro-precio.php';
    }
    ?>
    <script src="../assets/js/function_buscar_prd.js"></script>
    <script src="../assets/js/function_buscar_prd_psb.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/limpiar.js"></script>
    <script src="../assets/js/codigoAutomatico.js"></script>
</body>

</html>