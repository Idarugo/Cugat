function buscarPrecios() {
    let local = $("#select-local").val();
    let codigo = $("#input-codigo").val();
    let server = $("#select-local").data('server');

    $.ajax({
        type: "POST",
        url: "../controllers/buscarPrecios.controller.php",
        data: {
            local: local,
            codigo: codigo,
            server: server
        },
        success: function (data) {
            console.log(data); // Agregado para depuración
            // Actualizar la tabla con los resultados de la búsqueda
            $("#tabla-productos-fijos tbody").html(data);
        }

    });
}
