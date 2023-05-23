   <!-- Sidebar  -->
   <?php
    $usuario = $_SESSION['usua'];
    $admin = $usuario->getAdmin(); # admin
    if ($admin == 1 and $usuario->getRol() == 1) {
        echo ' 

<div class="sidebar-brand ">
    <img src="/Cugat/assets/img/logo.png" alt="Logo">
</div>

<ul class="sidebar-nav mt-5">
    <li class="active">
        <a href="/Cugat/pages/admin/principal.php"><i class="fa fa-home"></i>Principal</a>
    </li>
    <li>
        <a href="/Cugat/pages/admin/sidebar/maestro-precio.php""><i class=" fa fa-shopping-cart"></i>Maestro Producto</a>
    </li>
    <li>
        <a href="/Cugat/pages/admin/sidebar/historial.php"><i class="fa fa-history"></i>Historial</a>
    </li>
    <li>
        <a href="/Cugat/pages/admin/sidebar/rol.php"><i class="fa fa-users"></i>Rol</a>
    </li>
    <li>
        <a href="/Cugat/pages/admin/sidebar/usuario.php"><i class="fa fa-user"></i>Usuarios</a>
    </li>
    <li>
        <a href="/../Cugat/pages/cerrar_sesion.php"><i class="fa fa-sign-out-alt"></i>Cerrar Sesion</a>
    </li>
</ul>

';
    } elseif ($admin == 1) { # 1 --> ADMINISTRADOR
        echo ' 
    <div class="sidebar-brand ">
        <img src="/Cugat/assets/img/logo.png" alt="Logo">
    </div>
    
    <ul class="sidebar-nav mt-5">
        <li class="active">
            <a href="/Cugat/pages/admin/principal.php"><i class="fa fa-home"></i>Principal</a>
        </li>
        <li>
            <a href="/Cugat/pages/admin/sidebar/maestro-precio.php""><i class=" fa fa-shopping-cart"></i>Maestro Producto</a>
        </li>
        <li>
            <a href="/Cugat/pages/admin/sidebar/historial.php"><i class="fa fa-history"></i>Historial</a>
        </li>
        <li>
            <a href="/Cugat/pages/admin/sidebar/rol.php"><i class="fa fa-users"></i>Rol</a>
        </li>
        <li>
            <a href="/Cugat/pages/admin/sidebar/usuario.php"><i class="fa fa-user-circle"></i>Usuarios</a>
        </li>
        <li>
            <a href="/../Cugat/pages/cerrar_sesion.php"><i class="fa fa-sign-out-alt"></i>Cerrar Sesion</a>
        </li>
    </ul>
        ';
    } elseif ($admin == 0) { # 0 --> Usuario Cliente
        echo '

        <div class="sidebar-brand ">
        <img src="/Cugat/assets/img/logo.png" alt="Logo">
    </div>
    
    <ul class="sidebar-nav mt-5">
        <li class="active">
            <a href="/Cugat/pages/client/principal.php"><i class="fa fa-home"></i>Principal</a>
        </li>
        <li>
            <a href="/Cugat/pages/client/sidebar/maestro-precio.php""><i class=" fa fa-shopping-cart"></i>Maestro Producto</a>
        </li>
        <li>
            <a href="/Cugat/pages/client/sidebar/historial.php"><i class="fa fa-history"></i>Historial</a>
        </li>
        <li>
            <a href="/../Cugat/pages/cerrar_sesion.php"><i class="fa fa-sign-out-alt"></i>Cerrar Sesion</a>
        </li>
    </ul>

    ';
    }
    ?>