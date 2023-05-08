const btn = document.getElementById("btn-buscar");
const codigo = document.getElementById("input-codigo");
const local = document.getElementById("select-local");
const tbody = document.getElementById("tbody_productos_pesables");
const titulo = document.getElementById("titulo");

local.addEventListener("change", function(){
    const option = local.options[local.selectedIndex];
    titulo.textContent = option.text;
})

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
        td.textContent = "No Hay Productos Pesables con el Codigo";
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
        editar.addEventListener("click", modalShow)
        td_cod.textContent = data[0].codigo;
        td_des.textContent = data[0].descripcion;
        td_p_costo.textContent = data[0].precio_costo;
        td_p_fijo.textContent = data[0].precio_fijo;
        td_editar.append(editar);
        tr.append(td_cod, td_des, td_p_costo, td_p_fijo, td_editar);
        tbody.append(tr);
      }
    })
    .catch((error) => console.error(error));
});


let modalShow = (e) =>{
  let codigobarra = e.target.getAttribute("cod");
  let pfijo = e.target.getAttribute("pfijo");
  $("#id_c").val(codigobarra);
  $("#pfijo").val(pfijo);
  $("#modal_modificarOfertaPesable").modal("show");
}