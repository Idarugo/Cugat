<?php

$dict_msj = [
    "Usuario_Ok" => "Se ha Agregado Usuario",
    "Usuario_Error" => "No se ha Podido Agregar Usuario",
    "Usuario_Modificar" => "Se ha Modificado Perfil",
    "Emptytxt" => "Se encuentran campos Vacios",
    "Especialidad" => "No se ha seleccionado Especialidad",
];


if ($_SESSION['Msj'] == "Usuario_Ok" || $_SESSION['Msj'] == "Usuario_Modificar") {
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
