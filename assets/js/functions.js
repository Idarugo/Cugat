/* Precio */

$(".modificar_precioOferta").click(function (e) {
  e.preventDefault();
  let codigob = $(this).attr("codigo");
  let ofertap = $(this).attr("pOf");
  let cant = $(this).attr("can");
  let desd = $(this).attr("des");
  let hast = $(this).attr("has");
  $("#id_codigo").val(codigob);
  $("#pOferta").val(ofertap);
  $("#cantidad").val(cant);
  $("#desde").val(desd);
  $("#hasta").val(hast);
  $("#modal_modificarOferta").modal("show");
});




$(".eliminar_precio").click(function (e) {
  e.preventDefault();
  let id = $(this).attr("id_car");
  let nombre = $(this).attr("nm");
  $("#id_ca").val(id);
  $("#span").text(nombre);
  $("#eliminar").modal("show");
});