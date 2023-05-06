$("#btn-buscar").click(function () {
    var localId = $("#select-local").val();
    var codigo = $("#input-codigo").val();
    $.ajax({
        url: "ruta/al/endpoint.php",
        method: "POST",
        data: { localId: localId, codigo: codigo },
        dataType: "html",
        success: function (data) {
            $("#tabla-productos-fijos tbody").html(data);
        }
    });
});
