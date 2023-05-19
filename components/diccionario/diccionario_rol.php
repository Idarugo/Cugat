<?php

$dict_msj = [
    "Rol_Ok" => "Se ha Agregado Rol",
    "Rol_Modificar" => "Se ha Modificado Rol",
    "Rol_Error" => "No se ha Podido Agregar el Rol",
    "Emptytxt" => "Se encuentran campos Vacios"
];


if ($_SESSION['Msj'] == "Rol_Ok" || $_SESSION['Msj'] == "Rol_Modificar") {
    echo '<script>
    Swal.fire({
        position: "top-center",
        icon: "success",
        title: "' . $dict_msj[$_SESSION['Msj']] . '",
        showConfirmButton: false,
        timer: 2500
    });
        </script>';
    $_SESSION['Msj'] = null;
    exit();
}



echo '<script>
Swal.fire({
    position: "top-center",
    icon: "error",
    title: "Error",
    text: "' . $dict_msj[$_SESSION['Msj']] . '",
    showConfirmButton: false,
    cancelButtonColor: "#CD8A3A",
    cancelButtonText: "Reintentar",
    showCancelButton: true
});
    </script>';
$_SESSION['Msj'] = null;
exit();
