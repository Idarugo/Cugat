<?php
require_once '../../models/Usuario.php';
session_start();
if (isset($_SESSION['usua'])) {
    $usuario = $_SESSION['usua'];
} else {
    header("Location: /../Cugat/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../../components/head.php' ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/styles/main.css">
    <link rel="stylesheet" href="../../assets/styles/pages/admin/principal.css">
    <link rel="stylesheet" href="../../assets/styles/components/sidebar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Principal</title>
</head>

<body>
    <?php include '../../components/headerUsuario.php' ?>
    <div id="wrapper">
        <aside id="sidebar-wrapper">
            <?php include '../../components/sidebar.php' ?>
        </aside>


        <section id="content-wrapper">
            <div class="row">

            </div>
        </section>

        <footer id="footer">
            <?php include '../../components/footer.php' ?>
        </footer>
    </div>
    <script src="../../assets/js/sidebar.js"></script>
</body>

</html>