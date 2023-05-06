<?php
// Iniciar la sesión
session_start();

// Definir el diccionario de mensajes
$dict_msj = [
    "1" => "Se ha Agregado Su Precio",
    "2" => "Se ha Modificado Precio",
    "3" => "Se ha Eliminado Precio",
    "-1" => "No se ha Podido Agregar Precio al producto",
    "0" => "Se encuentran campos Vacios"
];

// Verificar si la variable de sesión $_SESSION['Msj'] tiene un valor válido
if (isset($_SESSION['Msj']) && ($_SESSION['Msj'] == "1" || $_SESSION['Msj'] == "2" || $_SESSION['Msj'] == "3")) {
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

// Si la variable de sesión $_SESSION['Msj'] no tiene un valor válido, mostrar un mensaje de error
if (isset($_SESSION['Msj'])) {
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
}
