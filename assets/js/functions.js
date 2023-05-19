/* rol*/
$(".modificar_rol").click(function (e) {
  e.preventDefault();
  let id = $(this).attr("id_rol");
  let rol = $(this).attr("rol");
  $("#id_r").val(id);
  $("#rol").val(rol);
  $("#modal_modificar").modal("show");
});


const btn = document.getElementById("btn-buscar");
const btn_limpiar = document.getElementById("btn-limpiar");
const codigo = document.getElementById("codigo_barra");
const tbody = document.getElementById("tbody_productos");
const radio_opcion = document.getElementsByName("radio_opcion");
const titulo = document.getElementById("titulo_opcion");
const input_opcion = document.getElementById("input_opcion");

for (let i = 0; i < radio_opcion.length; i++) {
  radio_opcion[i].addEventListener("change", function () {
    if (this.value === "1") {
      titulo.textContent = "Ingrese los Minutos de la Oferta";
      input_opcion.value = "";
      input_opcion.type = "number";
    } else if (this.value === "2") {
      titulo.textContent = "Ingrese la Fecha limite de la Oferta";
      input_opcion.value = "";
      input_opcion.type = "datetime-local";
    } 
  });
}
btn.addEventListener("click", function () {
  let cod = codigo.value;
  while (tbody.hasChildNodes()) {
    tbody.removeChild(tbody.firstChild);
  }
  fetch("http://localhost/cugat/Api/ApiBuscarProducto.php?codigo=" + cod)
    .then((response) => response.json())
    .then((data) => {
      if (data.length == 0) {
        const tr = document.createElement("tr");
        const td = document.createElement("td");
        td.textContent = "No Hay Productos con el Codigo";
        td.colSpan = "8";
        tr.append(td);
        tbody.append(tr);
      } else {
        const tr = document.createElement("tr");
        const td_codigo = document.createElement("td");
        const td_nombre = document.createElement("td");
        const td_p_costo = document.createElement("td");
        const td_p_p_venta = document.createElement("td");
        const td_cantidad = document.createElement("td");
        const td_local = document.createElement("td");
        const td_creacion = document.createElement("td");
        const td_editar = document.createElement("td");
        const editar = document.createElement("a");

        editar.setAttribute("cod", data[0].codigo_barra);
        editar.setAttribute("nom", data[0].nombre);
        editar.setAttribute("pventa", data[0].p_punto_venta);
        editar.setAttribute("pcost", data[0].p_costo);
        editar.href = "#";
        editar.textContent = "Editar";
        editar.className = "modificar_precio";
        editar.addEventListener("click", modalShow);

        td_codigo.textContent = data[0].codigo_barra;
        td_nombre.textContent = data[0].nombre;
        td_p_costo.textContent = data[0].p_costo;
        td_p_p_venta.textContent = data[0].p_punto_venta;
        td_cantidad.textContent = data[0].cantidad;
        td_local.textContent = data[0].local;
        td_creacion.textContent = data[0].creacion;

        td_editar.append(editar);
        tr.append(
          td_codigo,
          td_nombre,
          td_p_costo,
          td_p_p_venta,
          td_cantidad,
          td_local,
          td_creacion,
          td_editar
        );
        tbody.append(tr);
      }
    })
    .catch((error) => console.error(error));
});

let modalShow = (e) => {
    let codigobarra = e.target.getAttribute("cod");
    let nombre = e.target.getAttribute("nom");
    let pventa = e.target.getAttribute("pventa");
    $("#barra").val(codigobarra);
    $("#br").val(codigobarra);
    $("#nombre").val(nombre);
    $("#precio_antiguo").val(pventa);
  $("#modal_oferta").modal("show");
};

btn_limpiar.addEventListener("click", function () {
  codigo.value = "";
  while (tbody.hasChildNodes()) {
    tbody.removeChild(tbody.firstChild);
  }
});



