<?php
#Header unico para Admin
require_once __DIR__ . '../../models/Usuario.php';
$login = false;
$isAdmin = false;

if (isset($_SESSION['usua'])) {
    $login = true;
    $usua = $_SESSION['usua'];
} else {
    header("location:  /../Cugat/index.php");
}
?>
<header>
    <div class="logo">
        <div id="navbar-wrapper">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <nav>
        <ul>

        </ul>
    </nav>
</header>