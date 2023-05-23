<?php
$dict_msj = [
    "Usuario_Ok" => "Se ha Agregado Usuario",
    "Usuario_Error" => "No se ha Podido Agregar Usuario",
    "Usuario_Bloqueado" => "Usuario bloqueado",
    "Usuario_Modificar" => "Se ha Modificado Perfil",
    "Emptytxt" => "Se encuentran campos Vacios",
    "CerrarSesion" => "Se ha cerrado Sesion Exitosamente",
    "Especialidad" => "No se ha seleccionado Especialidad"
];

if ($_SESSION['Msj'] == "Usuario_Ok" || $_SESSION['Msj'] == "Usuario_Modificar" || $_SESSION['Msj'] == "CerrarSesion") {
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

if ($_SESSION['Msj'] == "Usuario_Bloqueado") {
    echo '<script>
    Swal.fire({
        position: "top-center",
        title: "' . $dict_msj[$_SESSION['Msj']] . '",
        text: "Favor de comunicarse con el departamento informático",
        icon: "warning",
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
