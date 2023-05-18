const btn = document.getElementById("btn-buscar");
const codigo = document.getElementById("input-codigo");
const local = document.getElementById("select-local");
const tbody = document.getElementById("tbody_productos");
const titulo = document.getElementById("titulo");
const tbody_pesable = document.getElementById("tbody_productos_pesables");

local.addEventListener("change", function () {
  const option = local.options[local.selectedIndex];
  titulo.textContent = option.text;
});

btn.addEventListener("click", function () {
  let cod = codigo.value;
  let cod_local = local.value;
  cod_local = cod_local == 0 ? "00" : cod_local;
  while (tbody.hasChildNodes()) {
    tbody.removeChild(tbody.firstChild);
  }
  fetch(
    "http://localhost/cugat/Api/Api_busqueda_prd_local.php?local=" +
      cod_local +
      "&codigo=" +
      cod
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.length == 0) {
        const tr = document.createElement("tr");
        const td = document.createElement("td");
        td.textContent = "No Hay Productos con el Codigo";
        td.colSpan = "5";
        tr.append(td);
        tbody.append(tr);
      } else {
        console.log(data);
        const tr = document.createElement("tr");
        const td_cod = document.createElement("td");
        const td_des = document.createElement("td");
        const td_p_costo = document.createElement("td");
        const td_p_fijo = document.createElement("td");
        const td_editar = document.createElement("td");
        const editar = document.createElement("a");

        editar.setAttribute("cod", data[0].codigo);
        editar.setAttribute("des", data[0].descripcion);
        editar.setAttribute("pfijo", data[0].precio_fijo);
        editar.setAttribute("pcost", data[0].precio_costo);
        editar.href = "#";
        editar.textContent = "Editar";
        editar.className = "modificar_precio";
        editar.addEventListener("click", modalShow);
        td_cod.textContent = data[0].codigo;
        td_des.textContent = data[0].descripcion;
        td_p_costo.textContent = data[0].precio_costo;
        td_p_fijo.textContent = data[0].precio_fijo;
        td_editar.append(editar);
        tr.append(td_cod, td_des, td_p_costo, td_p_fijo, td_editar);
        tbody.append(tr);
      }
      buscarOfertaPesable(cod_local,cod);
    })
    .catch((error) => console.error(error));
});

let modalShow = (e) => {
  let codigobarra = e.target.getAttribute("cod");
  let descripcion = e.target.getAttribute("des");
  let pfijo = e.target.getAttribute("pfijo");
  $("#id_c").val(codigobarra);
  $("#des").val(descripcion);
  $("#pfijo").val(pfijo);
  $("#modal_modificar").modal("show");
};

let buscarOfertaPesable = (cod_local, cod) => {
  while (tbody_pesable.hasChildNodes()) {
    tbody_pesable.removeChild(tbody_pesable.firstChild);
  }
  fetch(
    "http://localhost/cugat/Api/Api_busqueda_prd_psb_local.php?local=" +
      cod_local +
      "&codigo=" +
      cod
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.length == 0) {
        const tr = document.createElement("tr");
        const td = document.createElement("td");
        td.textContent = "No Hay Ofertas Pesables con el Codigo";
        td.colSpan = "6";
        tr.append(td);
        tbody_pesable.append(tr);
      } else {
        console.log(data);
        const tr = document.createElement("tr");
        const td_cantidad = document.createElement("td");
        const td_p_oferta = document.createElement("td");
        const td_desde = document.createElement("td");
        const td_hasta = document.createElement("td");
        const td_dias_restantes = document.createElement("td");

        td_p_oferta.textContent = data[0].p_oferta;
        td_cantidad.textContent = data[0].cantidad;
        td_desde.textContent = data[0].desde;
        td_hasta.textContent = data[0].hasta;
        td_dias_restantes.textContent = data[0].dias_restantes;

        tr.append(
          td_p_oferta,
          td_cantidad,
          td_desde,
          td_hasta,
          td_dias_restantes
        );
        tbody_pesable.append(tr);
      }
    })
    .catch((error) => console.error(error));
};
